<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Helpers\APIHelper;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
class BookController extends Controller
{
    protected $apiHandler;
    public function __construct(APIHelper $apiHandler)
    {
        $this->apiHandler = $apiHandler;
    }

    public function showSingleExternalBook($id)
    {
        $data = $this->apiHandler->findExternalBookById($id);
        return $data;
    }

    public function getExternalBooks(Request $request) {
        $params = [];
        if($request->has("name")){
            $params += [ "name" => $request->input("name")]; 
        }

        if($request->has("country")){
            $params += [ "country" => $request->input("country")]; 
        }
        if($request->has("publisher")){
            $params += [ "publisher" => $request->input("publisher")]; 
        }
        if($request->has("release_date")){
            $params += [ "release_date" => $request->input("release_date")]; 
        }
        $response = $this->apiHandler->getAllExternalBooks($params);
        $books = $response["body"];
        if($books !== FALSE){           
            return response()->json([
                "status_code"=>200, 
                "status"=>"success",
                "data" => (new BookResource($books, true))->withOnly(['name', 'isbn', 'authors','publisher', 'country','release_date', 'number_of_pages']),
            ], 200);
        }
        else{
            return response()->json([                
                "status_code"=>404,
                "Status"=>"Resource not found",
                "data"=>[]
            ], 404);
        }
    }

    public function books(Request $request){
        $method = $request->method();
        if ($method == 'POST') {
            $book = Book::create([
                'name'            => $request->name,
                'authors'         => $request->authors,
                'country'         => $request->country,
                'number_of_pages' => $request->number_of_pages,
                'publisher'       => $request->publisher,
                'release_date'    => $request->release_date,
                'isbn'            => $request->isbn,
            ]);
            unset($book->created_at, $book->updated_at);
            return $this->apiHandler->handleResponse($book, 201, 'success');
        }
        if($method == 'GET') {
            $books = Book::get();
            foreach($books as $key => $item){
                //remove created_at and updated_at from output array to conform with output required
                unset( $books[$key]->created_at, $books[$key]->updated_at);
            }
            return $this->apiHandler->handleResponse($books, 200, 'success');
        }
    }

    public function update(Request $request, $id) {
        $book = Book::where("id",$id)->first();
        $book = $book->update([
            "name" => $request->name,
            "isbn" => $request->isbn,
            "authors" => $request->authors,
            "country" => $request->country,
            "number_of_pages" => $request->number_of_pages,
            "publisher" => $request->publisher,
            "release_date" => $request->release_date,
        ]);
        // if book is truthy
        if ($book) {
            $status = "success";
            $message = "The book $id was updated successfully";
            $responseType = 200;
        } else {
            $status = "failure";
            $message = "The resource you are looking for could not be found!";
            $responseType = 401;
        }
        return $this->apiHandler->handleResponse($message, $responseType, $status);
    }

    public function show($id)
    {
        $book = Book::where('id', $id)->first();
        if ($book){
            // remove book id, created_at and updated_at from the output
            unset($book->created_at,$book->updated_at);
            $status = "success";
            $responseType = 200;
            $data = $book;
        } else {
            $status = "success";
            $responseType = 401;
            $data = [];
        }
        return $this->apiHandler->handleResponse($data, $responseType, $status);
    }

    public function delete($id)
    {
        $book = Book::where('id', $id)->first();
        if($book){
            $book->delete();
            $status = "success";
            $message = "The book $book->name was deleted successfully";
            $responseType = 200;

        } else {
            $status = "success";
            $message = "The requested book could not be found";
            $responseType = 404;
        }
        return $this->apiHandler->handleResponse($message, $responseType,$status);

    }
}