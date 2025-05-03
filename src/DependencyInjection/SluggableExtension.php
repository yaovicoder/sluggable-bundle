<?php

namespace YIC\SluggableBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class SluggableExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configDir = $this->getConfigDirectory();
        $loader = new YamlFileLoader($container, new FileLocator($configDir));
        
        // Load all required config files
        $this->loadConfigurationFiles($loader, $configDir);
        
    }       
    
    private function getConfigDirectory(): string
    {
        if (is_dir($dir = __DIR__.'/../../config')) {
            return $dir;
        }
    }
    
    private function loadConfigurationFiles(YamlFileLoader $loader, string $configDir): void
    {
        $files = [
            'services.yaml',
            'packages/sensio_framework_extra.yaml',
        ];
        
        foreach ($files as $file) {
            if (file_exists("$configDir/$file")) {
                $loader->load($file);
            }
        }
    }
}