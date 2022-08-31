<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    public function testRoot()
    {
        $response = $this->get('/api');

        $response->assertStatus(200);
    }

    // Unit Test for Getting all External Books starts here
    public function testExternalBooks() {
        $response = $this->json('GET', 'api/external-books');
        $response->assertStatus(200);
        $response->assertJsonFragment (
            [
                "name"=> "A Game of Thrones",
                "isbn"=> "978-0553103540",
                "authors"=> [
                    "George R. R. Martin"
                ],
                "publisher"=> "Bantam Books",
                "country"=> "United States",
                "number_of_pages"=> 694,
                "release_date"=> "1996-08-01T00:00:00"
            ]

        );

    }
    // Unit Test for Getting all External Books ends here

    // Unit Test for Getting a Single External Book starts here
    public function testSingleExternalBook() {
        $response = $this->json('GET', 'api/external-books/1');
        $response->assertStatus(200);
        $response->assertJsonFragment (
            [
                "status_code"=> 200,
                "name"=> "A Game of Thrones",
                "isbn"=> "978-0553103540",
                "authors"=> [
                "George R. R. Martin"
                ],
                "publisher"=> "Bantam Books",
                "country"=> "United States",
                "number_of_pages"=> 694,
                "release_date"=> "1996-08-01T00:00:00"
            ]

        );

    }
    // Unit Test for Getting a Single External Book ends here

    // Unit Test for Getting a Single External Book starts here
    public function testFilteringExternalBook() {
        $response = $this->json('GET', 'api/external-books?name=A Game of Thrones');
        $response->assertStatus(200);
        $response->assertJsonFragment (
            [
                "status_code"=> 200,
                "name"=> "A Game of Thrones",
                "isbn"=> "978-0553103540",
                "authors"=> [
                "George R. R. Martin"
                ],
                "publisher"=> "Bantam Books",
                "country"=> "United States",
                "number_of_pages"=> 694,
                "release_date"=> "1996-08-01T00:00:00"
            ]

        );

    }
    // Unit Test for Getting a Single External Book ends here


    // Unit Test for Creating a Local Book Starts here
    public function testCreateLocalBook() {
        $data = [
            "name" => "Book From Test Case",
            "isbn" => "123-320000067",
            "authors" => [
                "John Doe Test Case"
            ],
            "number_of_pages" => 850,
            "publisher" => "Acme Books  Series",
            "country" => "United Union",
            "release_date" => "2019-08-01"
        ];

        $response = $this->json('POST', '/api/v1/books',$data);
        $response->assertStatus(201);
        $response->assertJsonFragment($data);
        $response->assertJson(["status" => "success"]);
    }
    // Unit Test for Creating a Local Book ends here


    // TEST for Updating Local Book starts here
    public function testUpdateLocalBook() {
        $response = $this->json('GET', '/api/v1/books');
        $response->assertStatus(200);

        $book = json_decode($response->getContent(), true)['data'][0];
        $book_id = $book['id'];
        $data = [

            "name" => 'Book From Test Case',
            "isbn" => "123-320000067",
            "authors" => [
                "John Doe Test Case"
            ],
            "number_of_pages" => 850,
            "publisher" => "Acme Books  Series",
            "country" => "United Union",
            "release_date" => "2019-08-01"
        ];
        $response = $this->json('PATCH', '/api/v1/books/'.$book['id'], $data);

        $name = $book['name'];

        $response->assertStatus(200);
        $response->assertJson(['data' =>"The book $book_id was updated successfully"]);
        $response->assertJson(["status" => "success"]);
    }
    // TEST for Updating Local Book ends here


    // Unit Test for Deleting Local Book starts here
    public function testDeleteLocalBook() {
        $response = $this->json('GET', '/api/v1/books');
        $response->assertStatus(200);
        $book = json_decode($response->getContent(), true)['data'][0];
        $response = $this->json('DELETE', '/api/v1/books/'.$book['id']);
        $response->assertStatus(200);
        $name = $book['name'];
        $response->assertJson(["data" => "The book $name was deleted successfully"]);
        $response->assertJson(["status" => "success"]);
    }
    // Unit Test for Deleting Local Book ends here


    //  Unit Test for Getting Local Books starts here
     
    public function testLocalBooks() {
        $response = $this->json('GET', 'api/v1/books');
        $response->assertStatus(200);
        $response->assertJson(["status" => "success"]);
        $book = json_decode($response->getContent(), true)['data'];
        self::assertIsArray($book);
    }
    // Unit Test for Getting Local Books ends here


}
