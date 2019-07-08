<?php

namespace App\Core\ViewComponents;

use Twig\TwigFunction;
use ReflectionClass;
use Twig\Extension\AbstractExtension;
use App\Core\HTTP\Authenticate\Auth;

class AuthStaticCaller extends AbstractExtension
{
    /**
     * Auth class name
     *
     * @var string
     */
    private $authName = Auth::class;

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new TwigFunction('auth_do', [$this, 'callStaticMethod']),
            new TwigFunction('auth_get', [$this, 'getStaticProperty']),
        );
    }
    public function callStaticMethod($method, array $args = [])
    {
        $refl = new \reflectionClass($this->authName);
        // Check that method is static AND public
        if ($refl->hasMethod($method) && $refl->getMethod($method)->isStatic() && $refl->getMethod($method)->isPublic()) {
            return call_user_func_array($this->authName.'::'.$method, $args);
        }
        throw new \RuntimeException(sprintf('Invalid static method call for class %s and method %s', $this->authName, $method));
    }

    public function getStaticProperty($property)
    {
        $refl = new ReflectionClass($this->authName);
        // Check that property is static AND public
        if ($refl->hasProperty($property) && $refl->getProperty($property)->isStatic() && $refl->getProperty($property)->isPublic()) {
            return $refl->getProperty($property)->getValue();
        }
        throw new \RuntimeException(sprintf('Invalid static property get for class %s and property %s', $this->authName, $property));
    }
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'authstatic';
    }
}