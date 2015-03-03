<?php

namespace Eye4web\ZfcUserProfilePictureTest\Service;

use Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureService;
use Eye4web\ZfcUserProfilePictureTest\ConfigTest;
use PHPUnit_Framework_TestCase;
use ZfcUser\Entity\User;

class ProfilePictureServiceTest extends PHPUnit_Framework_TestCase
{
    /** @var PmService */
    protected $service;

    /** @var \Eye4web\ZfcUser\Pm\Mapper\PmMapperInterface */
    protected $mapper;

    public function setUp()
    {
        /** @var \Eye4web\Zf2User\Mapper\UserInterface $mapper */
        $mapper = $this->getMock('\ZfcUser\Mapper\UserInterface');
        $this->mapper = $mapper;

        $service = new ProfilePictureService($mapper);
        $this->service = $service;
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureService::__construct
     */
    public function testGetConstruct()
    {
        $service = new ProfilePictureService($this->mapper);
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureService::updateProfilePicture
     */
    public function testUpdateProfilePicture()
    {
        $profilePictureMock = $this->getMock('Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureServiceInterface');
        $profilePictureEntityMock = $this->getMock('Eye4web\ZfcUser\ProfilePicture\Entity\ProfilePictureInterface');

        $profilePictureMock->expects($this->any())
             ->method('updateProfilePicture')
             ->with(ConfigTest::getConfig()['uploadPath'], $profilePictureEntityMock)
             ->willReturn($profilePictureEntityMock);

        $this->assertInstanceOf('Eye4web\ZfcUser\ProfilePicture\Entity\ProfilePictureInterface', $this->service->updateProfilePicture(ConfigTest::getConfig()['uploadPath'], $profilePictureEntityMock));
    }
}
