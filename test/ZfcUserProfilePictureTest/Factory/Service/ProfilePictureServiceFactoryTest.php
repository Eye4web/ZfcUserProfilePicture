<?php

namespace Eye4web\Zf2UserPmTest\Factory\Service;

use Eye4web\ZfcUser\ProfilePicture\Factory\Service\ProfilePictureServiceFactory;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProfilePictureServiceFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var ProfilePictureServiceFactory */
    protected $factory;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $factory = new ProfilePictureServiceFactory();
        $this->factory = $factory;
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Factory\Service\ProfilePictureServiceFactory::createService
     */
    public function testCreateService()
    {
        $userMapper = $this->getMock('ZfcUser\Mapper\UserInterface');

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('zfcuser_user_mapper')
                             ->willReturn($userMapper);

        $result = $this->factory->createService($this->serviceLocator);

        $this->assertInstanceOf('Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureServiceInterface', $result);
    }
}
