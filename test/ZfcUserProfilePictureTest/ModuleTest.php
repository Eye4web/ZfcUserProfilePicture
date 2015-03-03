<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */
namespace Eye4web\ZfcUserProfilePictureTest\Options;

use Eye4web\ZfcUser\ProfilePicture\Module;
use PHPUnit_Framework_TestCase;
use Zend\Mvc\MvcEvent;

/**
 * This class tests Module class
 * @author Abdul Malik Ikhsan <samsonasik@gmail.com>
 */
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
        $this->assertTrue(is_array($this->module->getConfig()));
    }
}
