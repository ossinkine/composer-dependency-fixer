<?php

namespace Ossinkine\ComposerDependencyFixer\Console\Command;

use Composer\Json\JsonFile;
use Ossinkine\ComposerDependencyFixer\Finder\Php as PhpFinder;
use Ossinkine\ComposerDependencyFixer\NamespaceResolver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Fix extends Command
{
    const NAME = 'fix';

    /**
     * @var NamespaceResolver\NamespaceResolverInterface[]
     */
    protected $namespaceResolvers;

    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->setDescription('Fix composer package')
            ->setDefinition(array(
                new InputArgument('path', InputArgument::REQUIRED, 'Package path'),
            ));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');
        $composerConfigPath = realpath($path . DIRECTORY_SEPARATOR . 'composer.json');
        if (false === $composerConfigPath) {
            throw new \InvalidArgumentException(
                sprintf('"%s" is not composer package', $path)
            );
        }

        $file = new JsonFile($composerConfigPath);
        $file->validateSchema(JsonFile::LAX_SCHEMA);
        $composerConfig = $file->read();

        $packages = array();
        $files = 0;
        $finder = new PhpFinder($path);
        foreach ($finder as $file) {
            $content = file_get_contents($file->getRealpath());
            preg_match_all('/^use\s+(?P<class>[\\A-z0-9_\x7f-\xff]+)/m', $content, $matches);
            $classes = $matches['class'];
            $filePackages = array();
            foreach ($classes as $class) {
                $package = $this->resolveNamespace($class);
                if (null !== $package && !in_array($package, $filePackages)) {
                    $filePackages[] = $package;
                }
            }
            foreach ($filePackages as $package) {
                if (!array_key_exists($package, $packages)) {
                    $packages[$package] = 0;
                }
                $packages[$package]++;
            }
            $files++;
        }
        
        $currentPackage = $composerConfig['name'];
        if (array_key_exists($currentPackage, $packages)) {
            unset($packages[$currentPackage]);
        }

        $composerConfigChanged = false;
        foreach ($packages as $package => $count) {
            if ((!array_key_exists('require', $composerConfig)
                    || !array_key_exists($package, $composerConfig['require']))
                && (!array_key_exists('require-dev', $composerConfig)
                    || !array_key_exists($package, $composerConfig['require-dev']))
            ) {
                if ($count === $files) {
                    if (!array_key_exists('require', $composerConfig)) {
                        $composerConfig['require'] = array();
                    }
                    $composerConfig['require'][$package] = '*';
                } else {
                    if (!array_key_exists('require-dev', $composerConfig)) {
                        $composerConfig['require-dev'] = array();
                    }
                    $composerConfig['require-dev'][$package] = '*';
                    if (!array_key_exists('suggest', $composerConfig)) {
                        $composerConfig['suggest'] = array();
                    }
                    if (!array_key_exists($package, $composerConfig['suggest'])) {
                        $composerConfig['suggest'][$package] = $package;
                    }
                }
                $composerConfigChanged = true;
            }
        }

        if ($composerConfigChanged) {
            $file = new JsonFile($composerConfigPath);
            $file->write($composerConfig);
        }
    }

    /**
     * @return NamespaceResolver\NamespaceResolverInterface[]
     */
    protected function getNamespaceResolvers()
    {
        if (null === $this->namespaceResolvers) {
            $this->namespaceResolvers = array(
                new NamespaceResolver\ZendComponent(),
            );
        }

        return $this->namespaceResolvers;
    }

    /**
     * @param string $className
     *
     * @return null|string
     */
    protected function resolveNamespace($className)
    {
        $result = null;
        foreach ($this->getNamespaceResolvers() as $namespaceResolver) {
            $result = $namespaceResolver->resolve($className);
            if (null !== $result) {
                break;
            }
        }

        return $result;
    }
}
