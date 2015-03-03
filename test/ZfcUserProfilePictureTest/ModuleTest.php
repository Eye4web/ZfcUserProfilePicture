<?php
namespace Eye4web\ZfcUserProfilePictureTest\Options;

use Eye4web\ZfcUser\ProfilePicture\Module;
use PHPUnit_Framework_TestCase;
use Zend\Mvc\MvcEvent;

class ModuleTest extends PHPUnit_Framework_TestCase
{
    /** @var \Eye4web\ZfcUser\ZfcUserProfilePicture\Module */
    protected $module;

    public function setUp()
    {
        $this->module = new Module;
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Module::onBootstrap
     */
    public function testSetGetUploadPath()
    {
        $this->module->onBootstrap(new MvcEvent());
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Module::getConfig
     */
    public function testSetGetDimensions()
    {
        $this->assertInternalType('array', $this->module->getConfig());
    }
}
