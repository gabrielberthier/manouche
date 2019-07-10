<?php

namespace App\Core\HTTP\ControllersDependencies;

use Psr\Http\Message\ResponseInterface;
use Twig\Environment;
use Zend\Diactoros\Response;
use App\Core\HTTP\Validate\ManoucheValidator as Validator;
use App\Core\HTTP\Validate\ValidateInterface;
use Manouche\HTTP\Validate\Exceptions\ValidationException;

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

    /**
     * Validates entries
     * @Inject
     * @var Validator
     */
    private $validator;


    protected function render(string $view, $args = []): ResponseInterface
    {
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        $this->response->getBody()->write(
            $this->twig->render($view . '.twig', $args)
        );
        return $this->response;
    }

    protected function getResponse()
    {
        return $this->response;
    }

    protected function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * Validates user entries
     *
     * @param array $data
     * @param ValidateInterface $rule
     * @return $this
     */
    protected function verify(array $data, ValidateInterface $rule)
    {
        if ($this->validator->validate($data, $rule)) 
        {
            return $this;
        }
        throw new ValidationException(
            "Os campos requeridos não foram preenchidos corretamente",
            ['errors' => $this->validator->getErrors()->toArray()]
        );
    }
}
