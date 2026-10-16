
# Filipino Food Menu API

**Project Title:** Build Your Own API – Filipino Food Menu API

**Partners:** Kyle Tan and Jaira Zarzoso

**Section:** IT2E

**Resource:** Filipino Food Menu

## Setup Instructions

Requirements: PHP, Composer, Git, and Bruno.

1. Clone the repository:

   `git clone YOUR_GITHUB_REPOSITORY_URL`

2. Open the project folder: 

   `cd cit3102-m5-filipino-food`

3. Enter the Laravel app folder:

   `cd filipino-food`

4. Install dependencies:

   `composer install`

5. Create the environment file on Windows:

   `copy .env.example .env`

6. Generate the application key:

   `php artisan key:generate`

7. Configure SQLite in `.env` and make sure `database/database.sqlite` exists. If it does not exist, create it first:

   `type nul > database\database.sqlite`

8. Run migrations:

   `php artisan migrate`

9. Start the server:

   `php artisan serve`

10. Set the Bruno base URL to `http://127.0.0.1:8000`.

11. Register and log in to obtain a token for protected routes.

## API Routes

| Method | Path | Description | Needs Token? |
|---|---|---|---|
| POST | `/api/register` | Register a user | No |
| POST | `/api/login` | Log in and get a token | No |
| POST | `/api/logout` | Log out | Yes |
| GET | `/api/me` | View user information | Yes |
| GET | `/api/foods` | List and filter menu items | Yes |
| POST | `/api/foods` | Add a food item | Yes |
| GET | `/api/foods/{food}` | View one food item | Yes |
| PUT | `/api/foods/{food}` | Update a food item | Yes |
| DELETE | `/api/foods/{food}` | Delete a food item | Yes |


## Bruno Test Screenshots

Insert the actual screenshots from Step 6 in this section.

1. Register a new user — 201 Created
   ![Register Screenshot](cf5083b1-c15d-41cf-8747-9ae7fe1d463c.jpg)
2. Login with that user — 200 OK
   ![Login Screenshot](10d0e7bf-5136-441d-9224-6c649fdc8e33.jpg)
3. Get foods without a token — 401 Unauthorized
   ![get food without token Screenshot](bdaa1def-fa09-4b91-824b-e2ff9b017126.jpg)
4. Get foods with a token — 200 OK
   ![get food with token Screenshot](9e812d1c-ac68-4abe-b89d-de76043710ec.jpg)
5. Create a food item — 201 Created
   ![create Screenshot](fc5415eb-e283-449d-a485-f4cdb9393380.jpg)
6. Create a food item with a required field missing — 422 Unprocessable Content
   ![with required field missing Screenshot](a98c7721-87d4-476b-8282-f9ab01743717.jpg)
7. Get an existing food item — 200 OK
   ![existing Screenshot](cf02ecd6-39bf-4fde-8359-6a32fdfd6c1c.jpg)
8. Get a nonexistent food item — 404 Not Found
   ![none existent Screenshot](d83d287e-9962-4455-a92b-7e5beb46ea19.jpg)
9. Update an existing food item — 200 OK
   ![update Screenshot](066ebbcc-fae0-4e1e-9561-9505ca6a4d65.jpg)
10. Delete a food item — 204 No Content
   ![delete Screenshot](d68e7501-8d74-44c2-9d0d-0127867e41f1.jpg)


## Why Does DELETE Return 204 Instead of 200?

The HTTP status code 204 means that the request was successful and there is no response content to return. When a food item is deleted, the API removes the record from the database and sends an empty response. A 200 status code can also indicate success, but it is commonly used when the server returns a response body. The 204 status code is appropriate when the deletion succeeds without returning additional information.
