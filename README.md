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

#### Get a single external books

```http
  GET /api/external-books/{id}
```

#### Filter external books by name

```http
  GET /api/external-books?name=A Game of Throne
```

### Local Book API

#### Get all books

```http
  GET /api/books
```

#### Getting a single book by id

```http
  GET /api/books/{id}
```

#### Creating a Book

```http
  POST /api/books
```

#### Updating a Book

```http
  PATCH /api/books/{id}
```

#### Deleting a book

```http
  DELETE /api/books/{id}
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
