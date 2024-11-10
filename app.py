from flask import Flask, render_template, request, redirect, url_for, jsonify
import sqlite3
import os

app = Flask(__name__)

# Path to the SQLite database
DATABASE = os.path.join(os.getcwd(), 'users.db')

# Helper function to connect to the SQLite database
def get_db_connection():
    conn = sqlite3.connect(DATABASE)
    conn.row_factory = sqlite3.Row  # To access rows as dictionaries
    return conn

# Home route (serve the index.html)
@app.route('/')
def index():
    return app.send_static_file('index.html')

# Registration route (serve the register.html)
@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        name = request.form['name']
        email = request.form['email']
        birthday = request.form['birthday']
        gender = request.form['gender']
        phone = request.form['phone']
        password = request.form['password']

        # Save the user in the database
        conn = get_db_connection()
        conn.execute(
            'INSERT INTO users (name, email, birthday, gender, phone, password) VALUES (?, ?, ?, ?, ?, ?)',
            (name, email, birthday, gender, phone, password)
        )
        conn.commit()
        conn.close()
        
        return redirect(url_for('login'))

    return app.send_static_file('register.html')

# Login route (serve the login.html)
@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        email = request.form['email']
        password = request.form['password']
        
        # Check if the user exists in the database
        conn = get_db_connection()
        user = conn.execute('SELECT * FROM users WHERE email = ? AND password = ?', (email, password)).fetchone()
        conn.close()

        if user:
            return jsonify({"message": f"Welcome {user['name']}!"})
        else:
            return jsonify({"message": "Invalid credentials. Please try again."}), 401

    return app.send_static_file('login.html')

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
