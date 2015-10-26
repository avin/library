<?php
namespace App\Http\Controllers;


use App\Http\Requests\Book\IndexRequest;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Auth;

class BookController extends Controller
{

    protected $bookRepository;
    protected $userRepository;

    /**
     * BookController constructor.
     */
    public function __construct(BookRepositoryInterface $bookRepository, UserRepositoryInterface $userRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->userRepository = $userRepository;
    }

    public function index(IndexRequest $request){

        if ($request->search){
            $books = $this->bookRepository->search($request->search);
        } else {
            $books = $this->bookRepository->get();
        }


        return view('front.book.index', compact('books'));
    }

    public function indexFavorite(){
        $books = $this->userRepository->getFavoriteBooks(Auth::user());

        $favorite = true;
        return view('front.book.index', compact('books', 'favorite'));
    }

    public function show($id){

        $book = $this->bookRepository->byId($id);
        if (! $book){
            abort(404);
        }

        return view('front.book.show', compact('book'));
    }

    public function addFavorite($id){
        $book = $this->bookRepository->byId($id);
        if (! $book){
            abort(404);
        }

        $this->userRepository->addFavoriteBook(Auth::user(), $book);
        return back();
    }

    public function deleteFavorite($id){
        $book = $this->bookRepository->byId($id);
        if (! $book){
            abort(404);
        }

        $this->userRepository->deleteFavoriteBook(Auth::user(), $book);
        return back();
    }

}