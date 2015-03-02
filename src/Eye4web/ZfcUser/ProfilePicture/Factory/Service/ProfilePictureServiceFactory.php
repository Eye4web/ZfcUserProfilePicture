<?php

namespace Eye4web\ZfcUser\ProfilePicture\Factory\Service;

use Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProfilePictureServiceFactory implements FactoryInterface
{
    /**
     * Create options
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ModuleOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('zfcuser_user_mapper');

        $options = new ProfilePictureService($mapper);

        return $options;
    }
}
