# Filipino Food Menu API

**Project Title:** Build Your Own API – Filipino Food Menu API

**Partners:** Kyle Tan and Zarzoso

**Section:** IT2D

**Resource:** Filipino Food Menu

## Project Description

The Filipino Food Menu API is a RESTful API that manages a menu of Filipino food and beverages. The menu has three categories: Meals, Snacks, and Drinks. Users can register, log in, view food items, add new items, update existing items, delete items, and filter food items by category and availability. Each food item contains a name, category, description, price, and availability. The system uses Laravel, SQLite, and Laravel Sanctum for database management and authentication.

## Menu Categories

### Meals
- Chicken Adobo
- Sinigang
- Sisig
- Kare-Kare
- Fried Chicken

### Snacks
- Lumpia
- Turon
- Banana Cue
- Fish Balls
- Siomai

### Drinks
- Buko Juice
- Calamansi Juice
- Sago't Gulaman
- Salabat
- Gulaman

## Setup Instructions

Follow these steps to run the project from a fresh clone.

### Requirements
- PHP
- Composer
- Git
- Bruno API client

### Installation

1. Clone the project repository:

   ```bash
   git clone YOUR_GITHUB_REPOSITORY_URL
   ```

2. Open the project folder:

   ```bash
   cd cit3102-m5-filipino-food
   ```

3. Install the dependencies:

   ```bash
   composer install
   ```

4. Create the environment file:

   ```cmd
   copy .env.example .env
   ```

5. Generate the application key:

   ```bash
   php artisan key:generate
   ```

6. Configure the `.env` file to use SQLite and make sure the SQLite database file exists at `database/database.sqlite`.

7. Run the database migrations:

   ```bash
   php artisan migrate
   ```

8. Start the Laravel server:

   ```bash
   php artisan serve
   ```

9. Open Bruno and set the base URL to:

   `http://127.0.0.1:8000`

10. Register a user and log in to obtain an authentication token. Use the token for protected API requests.

## API Routes

| HTTP Verb | Path | Description | Needs Token? |
|---|---|---|---|
| POST | `/api/register` | Register a new user | No |
| POST | `/api/login` | Log in and obtain a token | No |
| POST | `/api/logout` | Log out the authenticated user | Yes |
| GET | `/api/me` | View the authenticated user's information | Yes |
| GET | `/api/foods` | View and filter menu items | Yes |
| POST | `/api/foods` | Add a new food item | Yes |
| GET | `/api/foods/{food}` | View one food item | Yes |
| PUT | `/api/foods/{food}` | Update a food item | Yes |
| DELETE | `/api/foods/{food}` | Delete a food item | Yes |

## Filtering Examples

- `GET /api/foods?category=Meals`
- `GET /api/foods?category=Snacks`
- `GET /api/foods?category=Drinks`
- `GET /api/foods?category=Meals&availability=1`

These examples show how to filter food items by category and availability.

## Bruno Test Screenshots

Insert the actual screenshots from Step 6 in this section.

1. **Register a New User — 201 Created**

   Add Screenshot 1 here.

2. **Login With That User — 200 OK**

   Add Screenshot 2 here.

3. **Get Foods Without a Token — 401 Unauthorized**

   Add Screenshot 3 here.

4. Get Foods With a Token — 200 OK

   Add Screenshot 4 here.

5. Create a Food Item — 201 Created

   Add Screenshot 5 here.

6. Create a Food Item With a Required Field Missing — 422 Unprocessable Content

   Add Screenshot 6 here.

7. Get an Existing Food Item — 200 OK

   Add Screenshot 7 here.

8. Get a Nonexistent Food Item — 404 Not Found

   Add Screenshot 8 here.

9. Update an Existing Food Item — 200 OK

   Add Screenshot 9 here.

10. Delete a Food Item — 204 No Content

    Add Screenshot 10 here.

Why Does DELETE Return 204 Instead of 200?

The HTTP status code 204 means that the request was successful and there is no response content to return. When a food item is deleted, the API removes the record from the database and sends an empty response. A 200 status code can also indicate success, but it is commonly used when the server returns a response body. The 204 status code is appropriate when the deletion succeeds without returning additional information.

Conclusion

The Filipino Food Menu API demonstrates CRUD operations, data validation, filtering, and token-based authentication using Laravel and SQLite. It organizes Filipino dishes and beverages into Meals, Snacks, and Drinks. Bruno is used to test the API endpoints and verify the expected HTTP status codes.