<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Admin\Book\IndexRequest;
use App\Http\Requests\Admin\Book\StoreRequest;
use App\Http\Requests\Admin\Book\UpdateRequest;
use App\Repositories\Book\BookRepositoryInterface;
use Flash;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookRepository;
    protected $categoryRepository;

    function __construct(
        BookRepositoryInterface $bookRepository
    )
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(IndexRequest $request)
    {
        if ($request->search){
            $books = $this->bookRepository->search($request->search);
        } else {
            $books = $this->bookRepository->get();
        }
        return view('admin.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.book.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        if ($this->bookRepository->create($request->all())){
            Flash::success('Книга успешно добавлена');
        } else {
            Flash::error('Ошибка сохренения');
        }

        return redirect()->route('admin.book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $book = $this->bookRepository->byId($id);
        if (! $book){
            abort(404);
        }

        return view('admin.book.show',  compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $book = $this->bookRepository->byId($id);
        if (! $book){
            abort(404);
        }

        return view('admin.book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $book = $this->bookRepository->byId($id);
        if (! $book){
            abort(404);
        }

        if ($this->bookRepository->update($book, $request->all())){
            Flash::success('Successfully updated');
        } else {
            Flash::error('Save error');
        }

        return redirect()->route('admin.book.index');
    }

    public function delete($id){
        $book = $this->bookRepository->byId($id);
        if (! $book){
            abort(404);
        }

        return view('admin.book.delete', compact('book'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $book = $this->bookRepository->byId($id);
        if (! $book){
            abort(404);
        }

        if ($this->bookRepository->delete($book)){
            Flash::success('Книга успешно удалена');
        } else {
            Flash::error('Ошибка удаления');
        }

        return redirect()->route('admin.book.index');
    }
}
