from pyzbar import pyzbar
import cv2
import mysql.connector
import sys

def delete_component_from_database(component_id, lab_no):
    # Connect to the MySQL database
    connection = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="ims"
    )

    # Create a cursor object to execute queries
    cursor = connection.cursor()

    try:
        # Execute the UPDATE query
        cursor.execute("UPDATE components SET location = %s WHERE sr_no = %s", (lab_no, component_id))
        cursor.execute("UPDATE components SET _status_ = 'WORKING' WHERE sr_no = %s", (component_id,))

        # Commit the transaction
        connection.commit()
        print("Lab number updated successfully for component with ID:", component_id)
    except Exception as e:
        # Rollback the transaction if an error occurs
        connection.rollback()
        print("Error updating lab number for component with ID:", component_id)
        print("Error:", e)
    finally:
        # Close the cursor and connection
        cursor.close()
        connection.close()

def delete_component_from_database_stu(student_id):
    # Connect to the MySQL database
    connection = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="ims"
    )

    # Create a cursor object to execute queries
    cursor = connection.cursor()

    try:
        # Execute the DELETE query
        cursor.execute("DELETE FROM students WHERE student_id = %s", (student_id,))


        # Commit the transaction
        connection.commit()
        print("Component with ID {} deleted from the database.".format(student_id))
    except Exception as e:
        # Rollback the transaction if an error occurs
        connection.rollback()
        print("Error deleting component from the database:", e)
    finally:
        # Close the cursor and connection
        cursor.close()
        connection.close()

def scan_qr_code(lab_no):
    # Open the camera
    cap = cv2.VideoCapture(0)

    while True:
        # Capture frame-by-frame
        ret, frame = cap.read()

        # Find and decode QR codes
        decoded_objects = pyzbar.decode(frame)

        # Display the QR code data
        for obj in decoded_objects:
            component_id = obj.data.decode('utf-8').split('\n')[0]
            print("Data:", component_id)

            # Update the lab number in the database
            delete_component_from_database(component_id, lab_no)

            # Release the camera and close OpenCV windows
            cap.release()
            cv2.destroyAllWindows()
            return component_id

        # Display the frame
        cv2.imshow('Frame', frame)

        # Exit if 'q' is pressed
        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

    # Release the camera and close OpenCV windows
    cap.release()
    cv2.destroyAllWindows()

def scan_qr_code_stu():
    # Open the camera
    cap = cv2.VideoCapture(0)

    while True:
        # Capture frame-by-frame
        ret, frame = cap.read()

        # Find and decode QR codes
        decoded_objects = pyzbar.decode(frame)

        # Display the QR code data
        for obj in decoded_objects:
            student_id = obj.data.decode('utf-8')
            print("Data:", student_id)

            # Update the lab number in the database
            delete_component_from_database_stu(student_id)

            # Release the camera and close OpenCV windows
            cap.release()
            cv2.destroyAllWindows()
            return student_id

        # Display the frame
        cv2.imshow('Frame', frame)

        # Exit if 'q' is pressed
        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

    # Release the camera and close OpenCV windows
    cap.release()
    cv2.destroyAllWindows()

if __name__ == "__main__":
# Check if the lab_no is provided as a command-line argument
    if len(sys.argv) != 2:
        print("Usage: python qrscanner_recieve.py <lab_no>")
        sys.exit(1)

    # Extract lab_no from command-line argument
    lab_no = sys.argv[1]

    # Call scan_qr_code function with lab_no
    scanned_data = scan_qr_code(lab_no)
    print("Scanned data:", scanned_data)
    student_data = scan_qr_code_stu()
    print("Student data:", student_data)
