from flask import Flask, render_template, request, jsonify, redirect, url_for
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
        subprocess.run(['python', 'templates/mail.py'])
        subprocess.run(['python', 'templates/qrscanner_recieve.py', lab_no])
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

@app.route('/form', methods=['GET', 'POST'])
def form():
    if request.method == 'POST':
        # Redirect to generate_qr route with form data
        return redirect(url_for('generate_qr', 
                                sr_no=request.form['sr_no'], 
                                name=request.form['name'],
                                category=request.form['category'],
                                #last_entry_date=request.form['last_entry_date'],
                                origin_lab=request.form['origin_lab'],
                                #location=request.form['location'],
                                #status=request.form['_status_']
                                ))
    else:
        return render_template('form.html')

@app.route('/generate_qr', methods=['GET', 'POST'])
def generate_qr():
    if request.method == 'GET':
        # Retrieve form data
        sr_no = request.args.get('sr_no')
        name = request.args.get('name')
        category = request.args.get('category')
        #last_entry_date = request.args.get('last_entry_date')
        origin_lab = request.args.get('origin_lab')
        #location = request.args.get('location')
        #status = request.args.get('status')

        # Run generate_qr.py script with form data as arguments
        subprocess.run(['python', 'templates/generate_qr.py', 
                        sr_no, 
                        name, 
                        category, 
                        #last_entry_date, 
                        origin_lab, 
                        #location, 
                        #status
                        ])

        return redirect(url_for('form'))
    else:
        return 'Method not allowed', 405

@app.route('/masterform', methods=['GET', 'POST'])
def masterform():
    if request.method == 'POST':
        try:
            subprocess.run(['python', 'templates/master_recieve.py'])
            return 'Master receive script executed successfully!'
        except Exception as e:
            return f'Error: {str(e)}'
    else:
        return render_template('masterform.html')

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)
