<?php declare(strict_types=1);

namespace Manouche\HTTP\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use App\Core\HTTP\Authenticate\Auth;
use Firebase\JWT\SignatureInvalidException;
use \UnexpectedValueException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Psr\Http\Message\ResponseInterface;

class AuthenticateMiddleware implements MiddlewareInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler):ResponseInterface
    {
        
        $cookies = $request->getCookieParams();

        if(isset($cookies["jazz_token"]))
        {
            try{
                Auth::decode($cookies["jazz_token"]);
            }
            catch(ExpiredException | BeforeValidException | UnexpectedValueException | SignatureInvalidException $ex){
                Auth::jwtDestroy();
                return new RedirectResponse("/");
            }
        }
        return($handler->handle($request));
    }
}