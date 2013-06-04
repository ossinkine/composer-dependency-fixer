<?php

namespace Ossinkine\ComposerDependencyFixer\Console;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    const VERSION = 0.1;

    public function __construct()
    {
        parent::__construct('Composer Dependency Fixer', self::VERSION);

        $this->add(new Command\Fix());
    }
}
