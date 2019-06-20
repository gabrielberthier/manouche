<?php

namespace App\Core\Utilities;

class Container
{
    /**
     * This method creates a new instance of a given class
     * by using its name
     * @param string $name
     * @return object 
     * 
     */
    public function make(string $class, array $params = []): object
    {
        $reflectedClass = new \ReflectionClass($class);
        $constructor = $reflectedClass->getConstructor();
        
        $reflection = new \ReflectionClass($class);
        
        $constructor = $reflection->getConstructor();

        if (!method_exists($constructor, '__construct')) {
            return new $class;
        }

        $resolvedParameters = [];
        foreach ($constructor->getParameters() as $parameter) {
            $parameterClass = $parameter->getClass();
            $className = $parameterClass->name;
            $parameterName = $parameter->getName();
            if (null === $parameterClass) {

                // if our primitive parameter given by user we'll use it
                // if not, we'll just throw an Exception

                if (isset($params[$parameterName])) {

                    // this is just a very simple example
                    // in real world you have to check whether this parameter passed by
                    // reference or not

                    $resolvedParameters[$parameterName] = $params[$parameterName];
                } else {
                    $text = sprintf('Container could not solve %s parameter', $parameterName);
                    throw new \Exception($text);
                }
            } else {

                // this function is becoming recursive now.
                // it'll continue 'till  nothing left.

                $resolvedParameters[$parameterName] = $this->make($className);

                // we need to know which value belongs to which parameter
                // so we'll store as an associative array.

            }
        }
        return $reflection->newInstanceArgs($resolvedParameters);
    }
}
