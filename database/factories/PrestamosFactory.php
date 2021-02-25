<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\User;
use App\Prestamos;
use Faker\Generator as Faker;

$factory->define(Prestamos::class, function (Faker $faker) {
    return [
       'user_id'=> factory(User::class),
       'book_id'=> factory(Book::class),

    ];
});
