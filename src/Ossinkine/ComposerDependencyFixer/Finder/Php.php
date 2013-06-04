<?php

namespace Ossinkine\ComposerDependencyFixer\Finder;

use Symfony\Component\Finder\Finder;

class Php extends Finder
{
    public function __construct($path)
    {
        parent::__construct();

        $this
            ->files()
            ->name('*.php')
            ->in($path)
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
            ->exclude('vendor')
        ;
    }
}
