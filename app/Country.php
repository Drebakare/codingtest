<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name'
    ];

    public function book(){
        return $this->hasMany(Book::class);
    }

    public static function createCountry($name){
        $create_country = Country::create([
            "name" => $name,
        ]);
        return $create_country;
    }

    public static function getCountryId($name){
        $country = Country::where('name', $name)->first();
        if ($country){
            return $country->id;
        }
        else{
            $create_country = self::createCountry($name);
            return $create_country->id;
        }

    }
}
