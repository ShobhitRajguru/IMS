from flask import Flask, render_template, request, jsonify
import subprocess

app = Flask(__name__)

@app.route('/')
def index():
    
    return render_template('index.html')

@app.route('/run_qr_scanner', methods=['POST'])
def run_qr_scanner():
    try:
        subprocess.run(['python', 'templates/qrscanner.py'])
        subprocess.run(['python', 'templates/mail.py'])
        subprocess.run(['python', 'templates/data.py'])
        return 'QR Scanner executed successfully!'
    except Exception as e:
        return f'Error: {str(e)}'

@app.route('/receive', methods=['POST'])
def run_qr_scanner_recieve():
    try:
        # Get lab_no from the request
        lab_no = request.form['data']
        print (lab_no)
        # Pass lab_no as an argument to the Python script
        subprocess.run(['python', 'templates/qrscanner_recieve.py', lab_no])
        subprocess.run(['python', 'templates/mail.py'])
        subprocess.run(['python', 'templates/data.py'])
        
        print("Received data from PHP:", lab_no)
        return jsonify({"message": "Data received successfully"})
    except Exception as e:
        return f'Error: {str(e)}'


@app.route('/receive2', methods=['POST'])
def receive_data():
    data = request.form['data']
    # Do whatever you want with the received data
    print("Received data from PHP:", data)
    return jsonify({"message": "Data received successfully"})

if __name__ == '__main__':
    app.run(debug=True)
