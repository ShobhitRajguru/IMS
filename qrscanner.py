from pyzbar import pyzbar
import cv2
import mysql.connector

def delete_component_from_database(component_id):
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
        #cursor.execute("UPDATE components SET location = NULL WHERE sr_no = %s", (component_id,))
        cursor.execute("UPDATE components SET _status_ = 'ISSUED' WHERE sr_no = %s", (component_id,))

        # Commit the transaction
        connection.commit()
        print("Component with ID {} deleted from the database.".format(component_id))
    except Exception as e:
        # Rollback the transaction if an error occurs
        connection.rollback()
        print("Error deleting component from the database:", e)
    finally:
        # Close the cursor and connection
        cursor.close()
        connection.close()


def delete_component_from_database_stu(component_id, student_id, gmail, contact, classs):
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
        cursor.execute("INSERT INTO students (student_id, component_id, gmail, contact, classs) VALUES (%s, %s, %s, %s, %s)", (student_id, component_id, gmail, contact, classs))
        cursor.execute("UPDATE components SET location = %s WHERE sr_no = %s", (student_id, component_id,))

        # Commit the transaction
        connection.commit()
        print("Lab number updated successfully for student with ID:", student_id)
    except Exception as e:
        # Rollback the transaction if an error occurs
        connection.rollback()
        print("Error updating lab number for student with ID:", student_id)
        print("Error:", e)
    finally:
        # Close the cursor and connection
        cursor.close()
        connection.close()

def scan_qr_code():
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

            # Delete the component from the database
            delete_component_from_database(component_id)

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

def scan_qr_code_stu(component_id):
    # Open the camera
    cap = cv2.VideoCapture(0)

    while True:
        # Capture frame-by-frame
        ret, frame = cap.read()

        # Find and decode QR codes
        decoded_objects = pyzbar.decode(frame)

        # Process each decoded object
        for obj in decoded_objects:
            data = obj.data.decode('utf-8')
            print("Data:", data)

            # Split the data into individual lines
            lines = data.split('\n')
            if len(lines) >= 4:
                student_id = lines[0].strip()
                gmail = lines[1].strip()
                contact = lines[2].strip()
                class_name = lines[3].strip()

                print("Student ID:", student_id)
                print("Gmail:", gmail)
                print("Contact:", contact)
                print("Class:", class_name)

                # Delete the component from the database
                delete_component_from_database_stu(component_id, student_id, gmail, contact, class_name)

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
    component_data = scan_qr_code()
    print("Component data:", component_data)
    student_data = scan_qr_code_stu(component_data)
    print("Student data:", student_data)
    
