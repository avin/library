<?php
namespace App\Http\Controllers;


class PageController extends Controller
{

    public function home(){

        return redirect(route('book.index'));
    }

}