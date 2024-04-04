import cv2
from pyzbar.pyzbar import decode
import mysql.connector
from datetime import datetime

# Connect to the MySQL database
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="ims"
)
cursor = conn.cursor()

# Set to keep track of scanned QR codes
scanned_qr_codes = set()

def read_qr_code():
    cap = cv2.VideoCapture(0)  # Initialize camera capture
    
    while True:
        ret, frame = cap.read()  # Read frame from the camera
        
        # Decode QR code
        decoded_objects = decode(frame)
        for obj in decoded_objects:
            data = obj.data.decode('utf-8')
            print("QR Code Data:", data)
            
            # Insert data into the database table if QR code hasn't been scanned before
            if data not in scanned_qr_codes:
                try:

                    status_value = "'WORKING'"  # Default value for _status_ column

                    # Construct the SQL query with conditional insertion for _status_ column
                    sql = "INSERT INTO components (sr_no, name, category, origin_lab, last_entry_date, _status_) " \
                        f"VALUES (%s, %s, %s, %s, %s, CASE WHEN _status_ IS NULL THEN {status_value} ELSE _status_ END)"
                    
                    # Get the current date and time
                    current_time = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
                    
                    # Split the decoded data into fields
                    sr_no, name, category, origin_lab = data.split('\n')
                    
                    # Execute the SQL statement
                    cursor.execute(sql, (sr_no, name, category, origin_lab, current_time))
                    
                    # Commit the transaction
                    conn.commit()
                    
                    # Add scanned QR code to the set
                    scanned_qr_codes.add(data)
                    
                    print("Data inserted successfully.")
                except mysql.connector.Error as e:
                    print("Error inserting data:", e)
        
        cv2.imshow('QR Code Scanner', frame)  # Display the captured frame

        if len(scanned_qr_codes) == 1:  # Change 1 to the desired number of QR codes to scan
            break  # Exit the loop
        
        # Check for key press to exit the loop
        if cv2.waitKey(1) & 0xFF == ord('q'):  # Press 'q' to exit
            break
    
    # Release the camera and close all OpenCV windows
    cap.release()
    cv2.destroyAllWindows()
    conn.close()

if __name__ == "__main__":
    read_qr_code()
