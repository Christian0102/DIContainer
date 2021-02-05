<?php

class Container
{
    /**
     * @var array */

    protected $instances = [];


    public function set($abstract, $concrete = NULL)
    {
        if ($concrete === NULL) {
            $concrete = $abstract;
        }
        $this->instances[$abstract] = $concrete;
    }


    public function get($abstract, $parameters = [])
    {
        if (!isset($this->instances[$abstract])) {
            $this->set($abstract);
        }
        return $this->resolve($this->instances[$abstract], $parameters);
    }

    public function resolve($concrete, $parametrs)
    {
        if ($concrete instanceof Closure) {
            return $concrete($this, $parametrs);
        }
        $reflector = new ReflectionClass($concrete);

        if (!$reflector->isInstantiable()) {
            throw new Exception("Class {$concrete} is not instatiable");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return $reflector->newInstance();
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependecies($parameters);

        return $reflector->newInstanceArgs($dependencies);
    }

    public function getDependecies($parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            
            $dependency = $parameter->getClass();
            if ($dependency === NULL) {
                //Check if default parameter is availaible
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Can not resolve class dependency {$parameter->name}");
                }
            } else {
                $dependencies[] = $this->get($dependency->name);
            }
        }
        return $dependencies;
    }
}
