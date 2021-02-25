<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResource;


class UserResource extends BaseResource
{
  
    public function generateLinks($request)
    {
        return [
            [
                'rel' => 'self',
                'href' => route('users.show', $this->id),
            ],
        ];
    }
}