<?php
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
        );

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__) . '/var/cache/' . $this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__) . '/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/config/parameters.yml');
        $loader->load($this->getRootDir() . '/config/console-commands.yml');
        $loader->load($this->getRootDir() . '/config/use-cases.yml');
        $loader->load($this->getRootDir() . '/config/services-domain.yml');
        $loader->load($this->getRootDir() . '/config/data-transformers-application.yml');
        $loader->load($this->getRootDir() . '/config/data-transformers-infrastructure.yml');
    }
}
