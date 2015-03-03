<?php

namespace Eye4web\ZfcUserProfilePictureTest\Options;

use Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions;
use PHPUnit_Framework_TestCase;
use Eye4web\ZfcUserProfilePictureTest\ConfigTest;

class ModuleOptionsTest extends PHPUnit_Framework_TestCase
{
    /** @var \Eye4web\ZfcUser\ZfcUserProfilePicture\Options\ModuleOptions */
    protected $options;

    public function setUp()
    {
        $options = new ModuleOptions([]);
        $this->options = $options;
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions::setUploadPath
     * @covers Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions::getUploadPath
     */
    public function testSetGetUploadPath()
    {
        $this->options->setUploadPath(ConfigTest::getConfig()['uploadPath']);
        $this->assertEquals('public/upload/user/profilepicture', $this->options->getUploadPath());
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions::setDimensions
     * @covers Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions::getDimensions
     */
    public function testSetGetDimensions()
    {
        $this->options->setDimensions(ConfigTest::getConfig()['dimensions']);
        $this->assertEquals([
            'minWidth'  => 200,
            'maxWidth'  => 1000,
            'minHeight' => 200,
            'maxHeight' => 1000,
        ], $this->options->getDimensions());
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions::setSize
     * @covers Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions::getSize
     */
    public function testSetGetSize()
    {
        $this->options->setSize(ConfigTest::getConfig()['size']);
        $this->assertEquals([
            'min' => '100Kb',
            'max' => '4Mb',
        ], $this->options->getSize());
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions::setChangeSuccessRoute
     * @covers Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions::getChangeSuccessRoute
     */
    public function testSetGetChangeSuccessRoute()
    {
        $this->options->setChangeSuccessRoute(ConfigTest::getConfig()['changeSuccessRoute']);
        $this->assertEquals('zfcuser', $this->options->getChangeSuccessRoute());
    }
}
