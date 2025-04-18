from flask import Flask, request, jsonify, render_template
import requests
import mysql.connector

app = Flask(__name__)

# MySQL connection config
db_config = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "voting_db"
}

@app.route('/')
def home():
    return render_template('record.html')

@app.route('/get_candidates', methods=['GET'])
def get_candidates():
    # Fetch from PHP backend
    response = requests.get('http://localhost/vote.php')  # Adjust if hosted elsewhere
    candidates = response.json()
    return jsonify(candidates)

@app.route('/store_vote', methods=['POST'])
def store_vote():
    data = request.get_json()
    candidate_id = data.get('candidate_id')

    conn = mysql.connector.connect(**db_config)
    cursor = conn.cursor()

    query = "INSERT INTO votecount (candidate_id) VALUES (%s)"
    cursor.execute(query, (candidate_id,))
    conn.commit()

    cursor.close()
    conn.close()

    return jsonify({"message": "Vote stored successfully!"})

if __name__ == '__main__':
    app.run(debug=True)
