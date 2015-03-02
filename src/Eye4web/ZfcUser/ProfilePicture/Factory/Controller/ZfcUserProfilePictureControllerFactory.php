<?php

namespace Eye4web\ZfcUser\ProfilePicture\Factory\Controller;

use Eye4web\ZfcUser\ProfilePicture\Controller\ZfcUserProfilePictureController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ZfcUserProfilePictureControllerFactory implements FactoryInterface
{
    /**
     * Create controller
     *
     * @param ServiceLocatorInterface $controllerManager
     * @return ForgotPasswordController
     */
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $controllerManager->getServiceLocator();

        $uploadForm = $serviceLocator->get('Eye4web\ZfcUser\ProfilePicture\Form\UploadProfilePictureForm');
        $profilePictureService = $serviceLocator->get('Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureService');
        $config = $serviceLocator->get('Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions');

        return new ZfcUserProfilePictureController($uploadForm, $profilePictureService, $config);
    }
}
