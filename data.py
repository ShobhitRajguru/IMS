import pymysql
from github import Github
from github.GithubException import GithubException

# GitHub credentials
github_username = 'ShobhitRajguru'
github_token = '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'
repo_name = 'IMS'
csv_files = {
    'student_data.csv': 'SELECT * FROM students',
    'user_data.csv': 'SELECT * FROM users',
    'component_data.csv': 'SELECT * FROM components'
}

# Connect to the MySQL database
try:
    with pymysql.connect(host='localhost',
                         user='root',
                         database='ims') as connection:

        # Create a cursor object
        with connection.cursor() as cursor:

            # Initialize PyGitHub
            g = Github(github_token)

            # Get the repository
            user = g.get_user()
            repo = user.get_repo(repo_name)

            for file_name, query in csv_files.items():
                # Execute a query to get data from the respective table
                cursor.execute(query)
                results = cursor.fetchall()

                # Format the data into CSV format
                csv_content = ''
                if results:
                    headers = [desc[0] for desc in cursor.description]
                    csv_content += ','.join(headers) + '\n'
                    for row in results:
                        csv_content += ','.join(map(str, row)) + '\n'

                    # Debug: Print CSV content
                    print(f"CSV Content for '{file_name}':")
                    print(csv_content)

                    try:
                        # Attempt to get the existing file
                        existing_file = repo.get_contents(file_name)

                        # Update the file if it exists
                        repo.update_file(file_name, f"Update {file_name}", csv_content, existing_file.sha)

                        print(f"File '{file_name}' updated in GitHub repository '{repo_name}' successfully.")

                    except GithubException as e:
                        if e.status == 404:
                            # If the file doesn't exist, create a new file
                            repo.create_file(file_name, f"Add {file_name}", csv_content)
                            print(f"File '{file_name}' created in GitHub repository '{repo_name}' successfully.")
                        else:
                            # Handle other GitHub API errors
                            print(f"GitHub API error: {e}")

except pymysql.Error as e:
    print(f"MySQL Error: {e}")
except GithubException as e:
    print(f"GitHub API Error: {e}")
except Exception as e:
    print(f"Error: {e}")
