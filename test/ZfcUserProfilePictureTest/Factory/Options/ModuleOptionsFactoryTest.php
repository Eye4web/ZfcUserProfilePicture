<?php

namespace Eye4web\Zf2UserPmTest\Factory\Options;

use Eye4web\ZfcUser\ProfilePicture\Factory\Options\ModuleOptionsFactory;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var ModuleOptionsFactory */
    protected $factory;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $factory = new ModuleOptionsFactory();
        $this->factory = $factory;
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Factory\Options\ModuleOptionsFactory::createService
     */
    public function testCreateServiceWithoutConfig()
    {
        $config = [];

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('Config')
                             ->willReturn($config);

        $result = $this->factory->createService($this->serviceLocator);

        $this->assertInstanceOf('Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptionsInterface', $result);
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Factory\Options\ModuleOptionsFactory::createService
     */
    public function testCreateServiceWithConfig()
    {
        $config = [
            'eye4web' => [
                'zfcuser' => [
                    'profilepicture' => [
                    ],
                ],
            ],
        ];

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('Config')
                             ->willReturn($config);

        $result = $this->factory->createService($this->serviceLocator);

        $this->assertInstanceOf('Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptionsInterface', $result);
    }
}
