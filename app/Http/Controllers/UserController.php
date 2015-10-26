<?php
namespace App\Http\Controllers;

use App\Http\Requests\User\SaveProfileRequest;
use App\Repositories\User\UserRepositoryInterface;
use Auth;
use Flash;

class UserController extends Controller
{

    protected $userRepository;

    function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Получить страницу настроек пользователя
     */
    public function getProfile(){
        $user = Auth::user();

        return view('front.user.profile', compact('user'));
    }

    /**
     * Сохранить основные настройки
     * @param SaveProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveProfile(SaveProfileRequest $request){
        $user = Auth::user();
        $this->userRepository->updateProfile($user, $request->only('name', 'password'));

        Flash::success('Данные обновлены');
        return redirect()->route('user.profile.index');
    }

    /**
     * Получить страницу избранных объектов пользователя
     */
    public function getFavorites(){
        $user = Auth::user();
        return view('front.user.favorites', compact('user'));
    }

}