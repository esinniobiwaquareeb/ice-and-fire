<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class  APIHelper {
  protected $client;
  protected  $baseUrl;
  private $books;
  public function __construct(Client $client)
  {
      $this->client = $client;
      $this->baseUrl = "https://www.anapioficeandfire.com/api";
  }


  public function findExternalBookById($id)
  {
      return $this->endpointRequest("/books/$id");
  }

  public function endpointRequest($url)
  {
      try {
          $response = $this->client->request('GET', $this->baseUrl.$url);
      } catch (\Exception $e) {
          return [];
      }

      return $this->response_handler($response->getBody()->getContents());
  }

  public function response_handler($response)
  {
      if ($response) { 
        $response = json_decode($response, true);
        unset($response['url'], $response['characters'], $response['povCharacters'], $response['mediaType']);
        $response['number_of_pages'] = $response['numberOfPages'];
        unset($response['numberOfPages']);
        $response['release_date'] = $response['released'];
        unset($response['released']);
        return response()->json([ 'status_code'=>200 , 'data' => $response,], 200);
      }
      return [];
  }

  public function handleResponse($response, $responseType, $statusMessage)
  {
      if ($response) {
          return response()->json([ 'status' => $statusMessage, 'status_code'=>$responseType , 'data' => $response], $responseType);
      }
      return [];
  }

  public function getAllExternalBooks($params = []){
      $url = $this->baseUrl."/books";

      if(count($params) > 0){
          $url .= '?';
          // append other url params
          $first = true;
          foreach( $params as $key => $param){
              $url .= ($first ? '' : '&') . $key . '=' . $param;
              $first = false;
          }
      }
      try {
          $client = new Client();
          $response = $client->request('GET', $url);
          if($response->getStatusCode() == 200){
            // $response
            $books = json_decode($response->getBody());

            foreach($books as $key => $item){
                // unset unneeded keys
                unset($books[$key]->url);
                unset($books[$key]->characters);
                unset($books[$key]->povCharacters);
                unset($books[$key]->mediaType);
                $books[$key]->number_of_pages = $books[$key]->numberOfPages;
                unset($books[$key]->numberOfPages);
                $books[$key]->release_date = $books[$key]->released;
                unset($books[$key]->released);  
            }
              return [
                  "headers" => $response->getHeaders(),
                  "body" => $books,
              ];
          }
          else{
              return ["error" => "Failed to fetch data"];
          }
      }
      catch(RuntimeException $e){
          $this->handleError($e);
      }
  }    
}