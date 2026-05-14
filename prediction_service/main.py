from fastapi import FastAPI
import pandas as pd
from sklearn.linear_model import LinearRegression
import mysql.connector
from mysql.connector import Error
import uvicorn
import os

app = FastAPI()

def get_db_connection():
    try:
        connection = mysql.connector.connect(
            host="127.0.0.1",
            user="root",
            password="",
            database="queuesense",
            port=3307
        )
        return connection
    except Error as e:
        print(f"Error connecting to MySQL: {e}")
        return None

def train_model():
    conn = get_db_connection()
    if not conn:
        return None
        
    try:
        query = """
            SELECT t.service_id, s.wait_time 
            FROM statistics_logs s
            JOIN tickets t ON s.ticket_id = t.id
            WHERE s.wait_time IS NOT NULL
        """
        df = pd.read_sql(query, conn)
        conn.close()

        if len(df) < 10:
            print("Not enough data to train model. Using fallback logic.")
            return None

        # Features: Service ID (simplified for now)
        X = df[['service_id']]
        y = df['wait_time']

        model = LinearRegression()
        model.fit(X, y)
        return model
    except Exception as e:
        print(f"Error during training: {e}")
        return None

# Initial model training
model = train_model()

@app.get("/predict")
def predict_wait_time(service_id: int, queue_length: int):
    global model
    
    # Try to retrain if no model exists (e.g., initial start or data just became available)
    if model is None:
        model = train_model()
        
    if model is None:
        # Fallback: Default average time per service (e.g., 10 minutes * queue_length)
        # In a real scenario, this could be fetched from the 'services' table directly
        return {"estimated_wait_time": queue_length * 10}

    try:
        # Predict base wait time for this service based on history
        base_time_seconds = model.predict([[service_id]])[0]
        
        # Ensure non-negative and reasonable minimum
        if base_time_seconds < 60:
            base_time_seconds = 600 # Default to 10 mins if history is too short/skewed
            
        # Total wait = base historic time for service * number of people ahead
        total_wait_minutes = (base_time_seconds * max(1, queue_length)) / 60
        
        return {"estimated_wait_time": round(total_wait_minutes)}
    except Exception as e:
        print(f"Prediction error: {e}")
        return {"estimated_wait_time": queue_length * 10}

@app.get("/health")
def health_check():
    return {"status": "ok", "model_loaded": model is not None}

if __name__ == "__main__":
    uvicorn.run(app, host="127.0.0.1", port=8000)
