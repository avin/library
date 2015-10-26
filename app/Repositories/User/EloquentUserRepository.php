<?php

namespace App\Repositories\User;


use App\Models\Book;
use App\Models\User;
use App\Repositories\EloquentBaseRepository;
use Auth;
use Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class EloquentUserRepository extends EloquentBaseRepository implements UserRepositoryInterface
{

    protected $user;


    public function __construct(Model $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }

    /**
     * Update model
     *
     * @param $model
     * @param array $input
     * @return object object of model
     */
    public function update($model, array $input)
    {
        array_except($input, array('password_confirmation', 'email'));

        // Except password if it's empty
        if (! array_get($input, 'password')) {
            $input = array_except($input, array('password'));
        } else {
            $input['password'] = Hash::make($input['password']);
        }
        $model->fill($input);
        return $model->save();
    }

    /**
     * Create a new user in the database.
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        $user = $this->user->newInstance($data);
        $user->password = Hash::make($data['password']);
        $user->save();

        return $user;
    }

    public function search($search){
        $query = $this->user->where('name', 'like', "%$search%")->orWhere('email', 'like', "%$search%");
        return $this->get($query);
    }

    public function getFavoriteBooks($user){
        return $user->favoriteBooks()->paginate(Config::get('app.perPage'));
    }

    public function addFavoriteBook($user, $book){
        return $user->favoriteBooks()->attach($book->id);
    }

    public function deleteFavoriteBook($user, $book){
        return $user->favoriteBooks()->detach($book->id);
    }
}