<?php

namespace Ossinkine\ComposerDependencyFixer\NamespaceResolver;

abstract class AbstractNamespaceResolver implements NamespaceResolverInterface
{
    /**
     * @return array
     */
    abstract public function getMap();

    /**
     * @param string $className
     *
     * @return null|string
     */
    public function resolve($className)
    {
        $result = null;
        foreach ($this->getMap() as $namespace => $package) {
            if (strpos($className, $namespace . '\\') === 0) {
                $result = $package;
                break;
            }
        }

        return $result;
    }
}
