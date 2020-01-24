<?php

namespace App\Http\Controllers\Web;

use App\Author;
use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function Homepage(){
        $books = Book::getLimitedBooks();
        $date = "released-date";
        if (!empty($books)) {
            $author_array_for_a_book = array();
            $authors = array();
            foreach ($books as $key => $book) {
                $get_authors = Author::getAuthors($book->id);
                foreach ($get_authors as $keys => $author) {
                    $author_array_for_a_book[$keys] = $author->name;
                }
                $authors[$key] = $author_array_for_a_book;
            }
            return view('welcome', compact('books', 'authors', 'date'));
        }
    }

    public function deleteBook($id){
        $check_book = Book::checkBookById($id);
        if ($check_book){
            $delete_book = Book::destroyBook($id);
            if ($delete_book){
                return redirect()->back()->with('success', "book successfully deleted");
            }
        }
        else{
            return redirect()->back()->with('success', "book does not exit");
        }
    }

    public function updateBook(Request $request, $id){
        $book = Book::updateBookById($request,$id);
        if ($book){
            return redirect()->back()->with('success', "book updated successfully");
        }
        else {
            return redirect()->back()->with('success', "book could not be update");
        }
    }
}
