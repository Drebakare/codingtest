<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;

class Book extends Model
{
    protected $fillable = [
        'name', 'isbn', 'country_id', 'no_of_pages', 'publisher_id', 'released-date'
    ];
    public function authors(){
        return $this->hasMany(Author::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function publisher(){
        return $this->belongsTo(publisher::class);
    }

    public static function checkBook($request){
        $status = Book::where(['name' => $request->name,"isbn" => $request->isbn ])->first();
        if ($status){
            return true;
        }
        else{
            return false;
        }
    }

    public static function checkBookById($id){
        $status = Book::where("id", $id)->first();
        if ($status){
            return true;
        }
        else{
            return false;
        }
    }

    public static function createBook($request){
        $get_publisher_id = Publisher::getPublisherId($request->publisher);
        $get_country_id = Country::getCountryId($request->country);
        $create_book = Book::create([
            "name" => $request->name,
            "isbn" => $request->isbn,
            "country_id" => $get_country_id,
            "no_of_pages" => $request->number_of_pages,
            "publisher_id" => $get_publisher_id,
            "released-date" => $request->release_date,
        ]);
        return $create_book;
    }

    public static function getAllBooks(){
        $books = Book::get();
        return $books;
    }

    public static function getLimitedBooks(){
        $books = Book::orderBy('id', 'asc')->get();
        if (count($books) > 10){
            $books = $books->take(10);
        }

        return $books;
    }

    public static function updateBookById($request,$id){
        $book = Book::where('id', $id)->first();
        if ($request->name != null){
            $book->name = $request->name;
        }
        if ($request->isbn != null){
            $book->isbn = $request->isbn;
        }
        if ($request->country != null){
            $get_country = Country::getCountryId($request->country);
            $book->country_id = $get_country;
        }
        if ($request->number_of_pages != null){
            $book->no_of_pages = $request->number_of_pages;
        }
        if ($request->publisher != null){
            $get_publisher = Publisher::getPublisherId($request->publisher);
            $book->publisher_id = $get_publisher;
        }
        if ($request->release_date != null){
            $date = "released-date";
            $book->$date = $request->release_date;
        }
        if ($request->authors != null){
            $status = DB::table('authors')->where('book_id', $book->id)->delete();
            foreach ($request->authors as $author){
                $add_authors = Author::createAuthor($author, $book->id);
            }
        }
        $book->save();
        return $book;
    }



    public static function destroyBook($id){
        $book = Book::where('id', $id)->first();
        $delete_authors = DB::table('authors')->where('book_id', $id)->delete();
        if ($delete_authors){
            $delete_book = DB::table('books')->where('id', $id)->delete();
            if ($delete_book){
                return $book;
            }
            else{
                return false;
            }

        }
        else{
            return false;
        }
    }

    public static function getBookById($id){
        $book = Book::where('id', $id)->first();
        return $book;
    }
}
