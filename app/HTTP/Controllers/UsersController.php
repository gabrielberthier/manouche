<?php

namespace Manouche\HTTP\Controllers;

use Manouche\Models\UserModel;
use Psr\Http\Message\ServerRequestInterface;
use App\Core\HTTP\ControllersDependencies\BaseController;

class UsersController extends BaseController
{
    /**
     * @Inject
     * @var UserModel
     */
    private $user;


    /**
     * Show all users.
     */
    public function index(ServerRequestInterface $request, $args)
    {
        $users = $this->user->getAll();

        return $this->render('users', compact('users'));
    }

    /**
     * Store a new user in the database.
     */
    public function store()
    {
        $this->user->save([
            'name' => $_POST['name']
        ]);

        return redirect('users');
    }

    public function pickOne()
    {
        $users = $this->user->getAll();

        shuffle($users);

        $index = array_rand($users, 1);

        $userResult = $users[$index];

        return view("users.pickone", compact('userResult'));

    }

    public function atest(){
        $us = $this->user;
        return view('atest-di', compact('us'));
    }
}
