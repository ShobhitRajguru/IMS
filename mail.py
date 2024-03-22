import mysql.connector
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

def fetch_student_info():
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
        # Fetch student info including email, student ID, component ID, and component name
        cursor.execute("SELECT s.gmail, s.student_id, s.component_id, c.name FROM students s JOIN components c ON s.component_id = c.id")
        rows = cursor.fetchall()
        student_info = [{'email': row[0], 'student_id': row[1], 'component_id': row[2], 'component_name': row[3]} for row in rows]
        return student_info
    except Exception as e:
        print("Error fetching student information:", e)
        return []
    finally:
        # Close the cursor and connection
        cursor.close()
        connection.close()

def send_email(sender_email, sender_password, smtp_server, receiver_email, subject, body):
    # Create message
    message = MIMEMultipart()
    message['From'] = sender_email
    message['To'] = receiver_email
    message['Subject'] = subject

    # Add body to the email
    message.attach(MIMEText(body, 'plain'))

    # Connect to the SMTP server and send the email
    try:
        server = smtplib.SMTP(smtp_server, 587)
        server.starttls()
        server.login(sender_email, sender_password)
        server.sendmail(sender_email, receiver_email, message.as_string())
        print("Email sent successfully to:", receiver_email)
    except Exception as e:
        print("Error sending email to", receiver_email)
        print("Error:", e)
    finally:
        server.quit()  # Quit the SMTP server connection

def main():
    # Fetch student information from the database
    student_info = fetch_student_info()

    # Send email to each student and to the admin
    subject_student = "ETRX LAB INVENTORY"
    subject_admin = "ETRX LAB INVENTORY - Admin Notification"
    body_student = "Dear Student,\n\nYour lab information has been updated.\nStudent ID: {student_id}\nComponent ID: {component_id}\nComponent Name: {component_name}\n\nRegards,\nETRX Dept."
    body_admin = "Dear Admin,\n\nA lab information update has been sent to the students.\n\nRegards,\nETRX Dept."

    admin_email = "2021.shobhit.rajguru@ves.ac.in"

    for info in student_info:
        # Send email to student
        student_email = info['email']
        student_body = body_student.format(student_id=info['student_id'], component_id=info['component_id'], component_name=info['component_name'])
        send_email('shobhitrajguru9903@gmail.com', 'odthytakdqdmnuhz', 'smtp.gmail.com', student_email, subject_student, student_body)

        # Send email to admin
        send_email('shobhitrajguru9903@gmail.com', 'odthytakdqdmnuhz', 'smtp.gmail.com', admin_email, subject_admin, body_admin)

if __name__ == "__main__":
    main()
