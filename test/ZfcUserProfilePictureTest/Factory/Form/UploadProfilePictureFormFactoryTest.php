<?php

namespace Eye4web\ZfcUserProfilePictureTest\Factory\Form;

use Eye4web\ZfcUserProfilePictureTest\ConfigTest;
use Eye4web\ZfcUser\ProfilePicture\Factory\Form\UploadProfilePictureFormFactory;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class UploadProfilePictureFormFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var UploadProfilePictureFormFactory */
    protected $factory;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $factory = new UploadProfilePictureFormFactory();
        $this->factory = $factory;
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Factory\Form\UploadProfilePictureFormFactory::createService
     */
    public function testCreateService()
    {
        $options = $this->getMock('Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions');

        $options->expects($this->at(0))
                             ->method('getUploadPath')
                             ->willReturn(ConfigTest::getConfig('uploadPath'));

        $options->expects($this->at(1))
                             ->method('getDimensions')
                             ->willReturn(ConfigTest::getConfig('dimensions'));

        $options->expects($this->at(2))
                             ->method('getSize')
                             ->willReturn(ConfigTest::getConfig('size'));

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions')
                             ->willReturn($options);

        $result = $this->factory->createService($this->serviceLocator);

        $this->assertInstanceOf('Eye4web\ZfcUser\ProfilePicture\Form\UploadProfilePictureForm', $result);
    }
}
