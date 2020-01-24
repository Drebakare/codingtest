<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillable = [
        'name'
    ];
    public function book(){
        return $this->hasMany(Book::class);
    }

    public static function createPublisher($name){
        $create_publisher = Publisher::create([
            "name" => $name,
        ]);
        return $create_publisher;
    }

    public static function getPublisherId($name){
        $check_publisher = Publisher::where('name', $name)->first();
        if ($check_publisher){
            return $check_publisher->id;
        }
        else{
            $create_publisher = self::createPublisher($name);
            return $create_publisher->id;

        }
    }

}

