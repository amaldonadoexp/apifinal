<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $resource = BookResource::class;
    
    protected $fillable = [
        'title','description', 
    ];



    public function prestamos(){
        return $this->hasMany(Prestamos::class);
    }
}
