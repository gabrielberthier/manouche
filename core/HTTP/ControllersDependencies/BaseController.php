<?php

namespace App\Core\HTTP\ControllersDependencies;

use Psr\Http\Message\ResponseInterface;
use Twig\Environment;
use Zend\Diactoros\Response;

class BaseController 
{
     /**
     * @Inject
     * @var Environment
     */
    private $twig;
    /**
     * @Inject
     * @var Response
     */
    private $response;


    public function render(string $view, $args = []) : ResponseInterface
    {
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        $this->response->getBody()->write(
            $this->twig->render($view . '.twig', $args)
        );
        return $this->response;
    }

    public function getResponse(){
        return $this->response;
    }

    public function setResponse(ResponseInterface $response){
        $this->response = $response;
    }
}
