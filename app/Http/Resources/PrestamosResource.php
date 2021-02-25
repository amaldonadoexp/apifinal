<?php

namespace App\Http\Resources;

use App\Http\Resources\BaseResource;


class PrestamosResource extends BaseResource
{
  
    
    public function generateLinks($request)
    {
        return [
            [
                'rel' => 'self',
                'href' => route('prestamos.index', $this->id),
            ],
        ];
    }
}