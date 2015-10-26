<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Admin\User\IndexRequest;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Repositories\User\UserRepositoryInterface;
use Flash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;
    protected $categoryRepository;

    function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(IndexRequest $request)
    {
        if ($request->search){
            $users = $this->userRepository->search($request->search);
        } else {
            $users = $this->userRepository->get();
        }
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->byId($id);
        if (! $user){
            abort(404);
        }

        return view('admin.user.edit', compact('user'));
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
        $user = $this->userRepository->byId($id);
        if (! $user){
            abort(404);
        }

        if ($this->userRepository->update($user, $request->all())){
            Flash::success('Successfully updated');
        } else {
            Flash::error('Save error');
        }

        return redirect()->route('admin.user.index');
    }

    public function delete($id){
        $user = $this->userRepository->byId($id);
        if (! $user){
            abort(404);
        }

        return view('admin.user.delete', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->byId($id);
        if (! $user){
            abort(404);
        }

        if ($this->userRepository->delete($user)){
            Flash::success('Книга успешно удалена');
        } else {
            Flash::error('Ошибка удаления');
        }

        return redirect()->route('admin.user.index');
    }
}
