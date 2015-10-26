<?php
namespace App\Models;


class Book extends BaseModel
{


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}