<?php

namespace App\Repositories\Book;

use App\Repositories\EloquentBaseRepository;
use Illuminate\Database\Eloquent\Model;


class EloquentBookRepository extends EloquentBaseRepository implements BookRepositoryInterface
{

    protected $book;

    public function __construct(Model $book)
    {
        parent::__construct($book);
        $this->book = $book;
    }


    public function search($search){
        $query = $this->book->where('name', 'like', "%$search%")->orWhere('author', 'like', "%$search%")->orWhere('year', '=', $search);
        return $this->get($query);
    }
}