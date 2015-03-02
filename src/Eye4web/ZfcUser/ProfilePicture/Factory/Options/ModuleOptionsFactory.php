<?php

namespace Eye4web\ZfcUser\ProfilePicture\Factory\Options;

use Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * Create options
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ModuleOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        $profilePictureConfig = [];

        if (isset($config['eye4web']['zfcuser']['profilepicture'])) {
            $profilePictureConfig = $config['eye4web']['zfcuser']['profilepicture'];
        }

        $options = new ModuleOptions($profilePictureConfig);

        return $options;
    }
}
