# ICE and FIRE API

The api url is: https://anapioficeandfire.com/Documentation#books

Laravel and PHP versions used:

Laravel v9.26.1 (PHP v8.1.8)

Database used: sqlite

## Environment Variables

To run this project, you will need to replace the following environment variables to your .env file

`DB_CONNECTION` = sqlite

`DB_DATABASE` = database/database.sqlite

## API Reference

### External Books API

#### Get all external books

```http
  GET /api/external-books
```
```
{
    "status_code": 200,
    "status": "success",
    "data": 
    [
        {
            "name": "A Game of Thrones",
            "isbn": "978-0553103540",
            "authors": [
                "George R. R. Martin"
            ],
            "publisher": "Bantam Books",
            "country": "United States",
            "release_date": "1996-08-01T00:00:00",
            "number_of_pages": 694
        },
        {
            "name": "A Clash of Kings",
            "isbn": "978-0553108033",
            "authors": [
                "George R. R. Martin"
            ],
            "publisher": "Bantam Books",
            "country": "United States",
            "release_date": "1999-02-02T00:00:00",
            "number_of_pages": 768
        },
        ...
        ...
        ...
    ]
}
```
#### Get a single external books

```http
  GET /api/external-books/{id}
```
```
{
    "status_code": 200,
    "status": "success",
    "data": 
    {
        "name": "A Game of Thrones",
        "isbn": "978-0553103540",
        "authors": [
            "George R. R. Martin"
        ],
        "publisher": "Bantam Books",
        "country": "United States",
        "release_date": "1996-08-01T00:00:00",
        "number_of_pages": 694
    }
}
```
#### Filter external books by name

```http
  GET /api/external-books?name=A Game of Throne
```
```
{
    "status_code": 200,
    "status": "success",
    "data": 
    {
        "name": "A Game of Thrones",
        "isbn": "978-0553103540",
        "authors": [
            "George R. R. Martin"
        ],
        "publisher": "Bantam Books",
        "country": "United States",
        "release_date": "1996-08-01T00:00:00",
        "number_of_pages": 694
    }
}
```
### Local Book API

#### Get all books

```http
  GET /api/books
```
```
{
    "status": "success",
    "status_code": 200,
    "data":
    [
        {
            "id": 1,
            "name": "Sample Book",
            "isbn": "123-0553103540",
            "authors": "Sample Author",
            "country": "Nigeria",
            "number_of_pages": "100",
            "publisher": "Nigerian Publisher",
            "release_date": "2022-08-31T00:00:00"
        },
        {
            "id": 2,
            "name": "Sample Book",
            "isbn": "123-0553103540",
            "authors": "Sample Author",
            "country": "Nigeria",
            "number_of_pages": "100",
            "publisher": "Nigerian Publisher",
            "release_date": "2022-08-31T00:00:00"
        },
        ...
        ...
        ...
    ]
}
```
#### Getting a single book by id

```http
  GET /api/books/{id}
```
```
{
    "status": "success",
    "status_code": 200,
    "data":
    {
        "id": 1,
        "name": "Sample Book",
        "isbn": "123-0553103540",
        "authors": "Sample Author",
        "country": "Nigeria",
        "number_of_pages": "100",
        "publisher": "Nigerian Publisher",
        "release_date": "2022-08-31T00:00:00"
    }
}
```
#### Creating a Book

```http
  POST /api/books
```
```
{
    "status": "success",
    "status_code": 200,
    "data":
    {
        "id": 1,
        "name": "Sample Book",
        "isbn": "123-0553103540",
        "authors": "Sample Author",
        "country": "Nigeria",
        "number_of_pages": "100",
        "publisher": "Nigerian Publisher",
        "release_date": "2022-08-31T00:00:00"
    }
}
```
#### Updating a Book

```http
  PATCH /api/books/{id}
```
```
{
    "status": "success",
    "status_code": 201,
    "data":
    {
        "id": 1,
        "name": "Sample Book Updated",
        "isbn": "123-0553103540",
        "authors": "Sample Author",
        "country": "Nigeria",
        "number_of_pages": "100",
        "publisher": "Nigerian Publisher",
        "release_date": "2022-08-31T00:00:00"
    }
}
```
#### Deleting a book

```http
  DELETE /api/books/{id}
```
```
{
   "status_code":204,
   "status":"success",
   "message":"The book ‘Sample Book’ was deleted successfully",
   "data":[]
}
```
## Run Locally

Clone the project

```bash
  git clone https://github.com/esinniobiwaquareeb/ice-and-fire.git
```

Go to the project directory

```bash
  cd ice-and-fire
```

Install dependencies

```bash
  composer install
```

Start the server

```bash
  php artisan serve
```

## Running Tests

To run tests, run the following command

```bash
  php artisan test
```

## Test Screenshots

![Test Screenshot](https://i.ibb.co/Bnfbd1Z/Screenshot-2022-08-30-at-4-50-40-PM.png)

## API Navigations Screenshots

From here, you can easily navigate around the api without having to use test tools

![API Navigation Screenshot](https://i.ibb.co/NtzRpjx/Screenshot-2022-08-30-at-5-04-02-PM.png)
### Sample Database

The sample database named `database.sqlite` is placed at the database directory. View the content with any prefferred too or upload it to http://inloop.github.io/sqlite-viewer/

![App Screenshot](https://i.ibb.co/7CRkdq2/Screenshot-2022-08-31-at-8-23-16-AM.png)