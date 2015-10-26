<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Models\Book::class, 20)->create();
    }
}