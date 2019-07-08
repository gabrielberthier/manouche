<?php

namespace Manouche\HTTP\Controllers;

use Manouche\Models\UserModel;
use Psr\Http\Message\ServerRequestInterface;
use App\Core\HTTP\ControllersDependencies\BaseController;
use Zend\Diactoros\Response\RedirectResponse;

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
    public function store(ServerRequestInterface $request, $args)
    {
        // $this->user->save([
        //     'name' => $_POST['name']
        // ]);
        //$name = $args['name'];
        $arg = $request->getParsedBody();
        $this->user->setName($arg['name']);
        $this->user->save([]);
        $name = $arg['name'];
        return new RedirectResponse("/users/hello/{$name}", 301);
    }

    public function pickOne()
    {
        $users = $this->user->getAll();

        shuffle($users);

        $index = array_rand($users, 1);

        $userResult = $users[$index];

        return view("users.pickone", compact('userResult'));

    }

    public function hello(ServerRequestInterface $request, $args){
        // $name = $args['name'];
        // $this->getResponse()->getBody()->write("<h3>Hello, $name</h3>");
        $cookies = $_COOKIE;
        $cookies = implode(", ", $cookies);
        $this->getResponse()->getBody()->write("<h3>Hello, $cookies</h3>");
        return $this->getResponse();
    }
}
