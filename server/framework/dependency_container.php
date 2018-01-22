<?php
namespace Framework;

class DependencyContainer
{
    private $container = [];
    private $singleton_instances = [];

    public function register($name, $resolver, $singleton = true)
    {
        $this->container[$name] = [$resolver, $singleton];
        return $this;
    }

    public function resolve($name)
    {
        if (array_key_exists($name, $this->container)) {
            [$resolver, $is_singleton] = $this->container[$name];
            if ($is_singleton) {
                if (!array_key_exists($name, $this->singleton_instances)) {
                    $this->singleton_instances[$name] = $this->get_instance($resolver);
                }

                return $this->singleton_instances[$name];
            }
            return $this->get_instance($resolver);
        }

        throw new \Exception("No dependency with name <$name> is registered.");
    }

    private function get_instance($resolver)
    {
        if (is_callable($resolver)) {
            return $resolver($this);
        }
        if (is_object($resolver)) {
            return $resolver;
        }

        $reflection = new \ReflectionClass($resolver);
        $arguments = [];
        $constructor = $reflection->getConstructor();

        if (!is_null($constructor)) {
            $arguments_info = $constructor->getParameters();
            foreach ($arguments_info as $argument_info) {
                try {
                    $arguments[] = $this->resolve($argument_info->name);
                } catch (\Exception $exception) {
                    if ($argument_info->isOptional()) {
                        $arguments[] = $argument_info->getDefaultValue();
                    } else {
                        throw $exception;
                    }
                }
            }
        }

        return $reflection->newInstanceArgs($arguments);
    }
}
