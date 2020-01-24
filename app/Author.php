<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Author extends Model
{
    protected $fillable = [
        'name', 'book_id'
    ];
    public function book(){
        return $this->belongsTo(Book::class);
    }

    public static function createAuthor($name, $book_id){
        $create_author = Author::create([
            "name" => $name,
            'book_id' => $book_id,
        ]);

        if ($create_author){
            return true;
        }
        else{
            return false;
        }
    }

    public static function getAuthors($book_id){
        $authors = Author::where('book_id', $book_id)->get();
        return $authors;
    }
}
