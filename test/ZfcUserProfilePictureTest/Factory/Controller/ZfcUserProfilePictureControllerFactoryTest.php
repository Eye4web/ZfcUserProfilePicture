<?php

namespace Eye4web\ZfcUserProfilePictureTest\Factory\Controller;

use Eye4web\ZfcUser\ProfilePicture\Factory\Controller\ZfcUserProfilePictureControllerFactory;
use Zend\Mvc\Controller\ControllerManager;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class ZfcUserProfilePictureControllerFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var ZfcUserProfilePictureControllerFactory */
    protected $factory;

    /** @var ControllerManager */
    protected $controllerManager;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var ControllerManager $controllerManager */
        $controllerManager = $this->getMock('Zend\Mvc\Controller\ControllerManager');
        $this->controllerManager = $controllerManager;

        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $controllerManager->expects($this->any())
                          ->method('getServiceLocator')
                          ->willReturn($serviceLocator);

        $factory = new ZfcUserProfilePictureControllerFactory();
        $this->factory = $factory;
    }

     /**
      * @covers Eye4web\ZfcUser\ProfilePicture\Factory\Controller\ZfcUserProfilePictureControllerFactory::createService
      */
    public function testCreateService()
    {
        $uploadProfilePictureForm = $this->getMockBuilder('Eye4web\ZfcUser\ProfilePicture\Form\UploadProfilePictureForm')
                             ->disableOriginalConstructor()
                             ->getMock();

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('Eye4web\ZfcUser\ProfilePicture\Form\UploadProfilePictureForm')
                             ->willReturn($uploadProfilePictureForm);

        $profilePictureService = $this->getMockBuilder('Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureService')
                             ->disableOriginalConstructor()
                             ->getMock();

        $this->serviceLocator->expects($this->at(1))
                             ->method('get')
                             ->with('Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureService')
                             ->willReturn($profilePictureService);

        $config = $this->getMockBuilder('Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions')
                            ->disableOriginalConstructor()
                            ->getMock();

        $this->serviceLocator->expects($this->at(2))
                             ->method('get')
                             ->with('Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions')
                             ->willReturn($config);

        $result = $this->factory->createService($this->controllerManager);

        $this->assertInstanceOf('Eye4web\ZfcUser\ProfilePicture\Controller\ZfcUserProfilePictureController', $result);
    }
}
