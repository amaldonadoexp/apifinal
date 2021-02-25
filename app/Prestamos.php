<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamos extends Model
{
    protected $resource = PrestamosResource::class;

    protected $fillable = [
        'user_id', 'book_id', 
    ];
    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function book(){
        return $this->belongsToMany(Book::class);
    }
}
