<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResource;


class BookResource extends BaseResource
{
  
    
    public function generateLinks($request)
    {
        return [
            [
                'rel' => 'self',
                'href' => route('books.show', $this->id),
            ],
        ];
    }
}