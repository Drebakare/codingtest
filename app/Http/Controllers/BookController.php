<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::getAllBooks();
        $data = array();
        $date = 'released-date';
        if (!empty($books)){
            $author_array_for_a_book = array();
            $authors = array();
            foreach ($books as $key => $book){
                $get_authors = Author::getAuthors($book->id);
                foreach ($get_authors as $keys =>$author){
                    $author_array_for_a_book[$keys] = $author->name;
                }
                $authors[$key] = $author_array_for_a_book;
                $data[$key] = array(
                    'id' => $book->id,
                    'name' => $book->name,
                    'isbn' => $book->isbn,
                    'author' => $authors[$key],
                    'number Of Pages' => $book->no_of_pages,
                    'publisher' => $book->publisher->name,
                    'country' => $book->country->name,
                    'release_date' => $book->$date,
                );
            }
            $response = array(
                "status_code" => 200,
                "status" => "success",
                "data" => $data
            );
            return response($response,200)->header('content-Type','application/json');
        }
        else{
            $response = array(
                "status_code" => 200,
                "status" => "success",
                "data" => $data
            );
            return response($response,200)->header('content-Type','application/json');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => 'bail|required',
            'isbn' => 'bail|required',
            'authors' => 'bail|required',
            'country' => 'bail|required',
            'number_of_pages' => 'bail|required',
            'publisher' => 'bail|required',
            'release_date' => 'bail|required',
        ]);
        $status = Book::checkBook($request);
        if($status){
            $response = array(
                "status_code" => 200,
                "status" => "success",
                "message" => "Book already exist"
            );
            return response($response,200)->header('content-Type','application/json');
        }
        else{
            $create_book = Book::createBook($request);
            if ($create_book){
                foreach ($request->authors as $author){
                    $add_authors = Author::createAuthor($author, $create_book->id);
                }
                $data = array(
                    "book" => array(
                        "name" => $request->name,
                        "isbn" => $request->isbn,
                        "authors" => $request->authors,
                        "number_of_pages" => $request->number_of_pages,
                        "publisher" => $request->publisher,
                        "country" => $request->country,
                        "release_date" => $request->release_date
                    )
                );
                $response = array(
                    "status_code" => 200,
                    "status" => "success",
                    "data" => $data
                );
                return response($response,200)->header('content-Type','application/json');
            }
            else{
                $response = array(
                    "status_code" => 200,
                    "status" => "success",
                    "message" => "Book could not be created"
                );
                return response($response,200)->header('content-Type','application/json');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $check_book = Book::checkBookById($id);
        if ($check_book){
            $book = Book::getBookById($id);
            $date = 'released-date';
            $authors = array();
            $get_authors = Author::getAuthors($book->id);
            foreach ($get_authors as $key =>$author){
                $authors[$key] = $author->name;
            }
            $data =  array(
                'id' => $book->id,
                'name' => $book->name,
                'isbn' => $book->isbn,
                'author' => $authors,
                'number Of Pages' => $book->no_of_pages,
                'publisher' => $book->publisher->name,
                'country' => $book->country->name,
                'release_date' => $book->$date,
            );

            $response = array(
                "status_code" => 200,
                "status" => "success",
                "data" => $data
            );
            return response($response,200)->header('content-Type','application/json');
        }
        else{
            $data = [];
            $response = array(
                "status_code" => 200,
                "status" => "success",
                "message" => " Book does not exist",
                "data" => $data
            );
            return response($response,200)->header('content-Type','application/json');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::updateBookById($request,$id);
        if ($book){
            $date = 'released-date';
            $authors = array();
            $get_authors = Author::getAuthors($book->id);
            foreach ($get_authors as $key =>$author){
                $authors[$key] = $author->name;
            }
            $data =  array(
                'id' => $book->id,
                'name' => $book->name,
                'isbn' => $book->isbn,
                'author' => $authors,
                'number Of Pages' => $book->no_of_pages,
                'publisher' => $book->publisher->name,
                'country' => $book->country->name,
                'release_date' => $book->$date,
            );

            $response = array(
                "status_code" => 200,
                "status" => "success",
                "message" => "The book ".$book->name." was updated successfully",
                "data" => $data
            );
            return response($response,200)->header('content-Type','application/json');
        }
        else{
            $response = array(
                "status_code" => 200,
                "status" => "success",
                "message" => "Book could not be updated",
                "data" => array()
            );
            return response($response,200)->header('content-Type','application/json');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check_book = Book::checkBookById($id);
        if ($check_book){
            $delete_book = Book::destroyBook($id);
            $data = [];
            if ($delete_book){
                $response = array(
                    "status_code" => 200,
                    "status" => "success",
                    "message" => "The book ".$delete_book->name." was deleted successfully",
                    "data" => $data
                );
                return response($response,200)->header('content-Type','application/json');
            }
        }
        else{
            $data = [];
            $response = array(
                "status_code" => 200,
                "status" => "success",
                "message" => " Book does not exist",
                "data" => $data
            );
            return response($response,200)->header('content-Type','application/json');
        }

    }
}
