<?php

use const Webimpress\HttpMiddlewareCompatibility\HANDLER_METHOD;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Webimpress\HttpMiddlewareCompatibility\HandlerInterface as DelegateInterface;
use Webimpress\HttpMiddlewareCompatibility\MiddlewareInterface;
use Zend\Diactoros\Stream;


class OutputBufferMiddleware implements MiddlewareInterface
{
    const APPEND = 'append';
    const PREPEND = 'prepend';
 
    protected $style;
 
    /**
     * Constructor
     *
     * @param string $style Either "append" or "prepend"
     */
    public function __construct(string $style = 'prepend')
    {
        if (!is_string($style) || !in_array($style, [static::APPEND, static::PREPEND])) {
            throw new \InvalidArgumentException('Invalid style. Must be one of: append, prepend');
        }
 
        $this->style = $style;
    }
 
    /**
     * Append or Prepend any data in the output buffer to the repsonse
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate) : ResponseInterface
    {
        try {
            ob_start();
            $response = $delegate->{HANDLER_METHOD}($request);
            $output = ob_get_clean();
        } catch (\Throwable $e) {
            ob_end_clean();
            throw $e;
        }
 
        if (!empty($output) && $response->getBody()->isWritable()) {
            if ($this->style === static::PREPEND) {
                $body = new Stream('php://temp', 'wb+');
                $body->write($output . "\n" . $response->getBody());
                $response = $response->withBody($body);
            } elseif ($this->style === static::APPEND) {
                $response->getBody()->write($output);
            }
        }
 
        return $response;
    }
}