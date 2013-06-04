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
            $pattern = sprintf('/^%s(\\\\|$)/', preg_quote($namespace));
            if (preg_match($pattern, $className)) {
                $result = $package;
                break;
            }
        }
        return $result;
    }
}
