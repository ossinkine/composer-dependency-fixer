<?php

namespace Ossinkine\ComposerDependencyFixer\NamespaceResolver;

interface NamespaceResolverInterface
{
    /**
     * @param string $className
     *
     * @return string
     */
    public function resolve($className);
}
