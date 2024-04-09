## Project description:
This project is a web application developed using Symfony 6 and Docker, featuring a console command for fetching posts from the REST API https://jsonplaceholder.typicode.com, an authentication system for accessing a webpage that lists these posts with the ability to delete them, and its own REST API endpoint to retrieve posts stored in a local database.

## How it works:
Data Fetching: Through a custom console command, the application fetches posts along with the authors' names from https://jsonplaceholder.typicode.com and stores them in the local database.
User Interface: A secured webpage /lista displays a list of fetched posts. Users can delete any post from this list. Access to this page requires login credentials.
REST API: The application exposes a GET endpoint /posts that allows fetching posts data as JSON directly from the local database.

## Login Credentials:
Username: admin <br/>
Password: test

## Tasks:
1. The application is to download posts using the console command (ending /posts) and the REST API https://jsonplaceholder.typicode.com and saving them to the database along with the name and surname of the author (downloaded in the story from the ending /users)
2. The application on the /list subpage should display a list of downloaded posts with the option of deleting them from the local database. This subpage is to be available after logging in - please use the built-in authorization modules.
3. With the help of the platform API, the application is to provide the /posts suffix with the GET method to retrieve posts from the local database.
