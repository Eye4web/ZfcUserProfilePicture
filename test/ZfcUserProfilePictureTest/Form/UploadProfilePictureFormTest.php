<?php

namespace Eye4web\ZfcUserProfilePictureTest\Form;

use PHPUnit_Framework_TestCase;
use Eye4web\ZfcUser\ProfilePicture\Form\UploadProfilePictureForm as Form;

class UploadProfilePictureFormTest extends PHPUnit_Framework_TestCase
{
    protected $uploadProfilePictureForm;

    public function setUp()
    {
        global $testConfig;
        $this->uploadProfilePictureForm = new Form($testConfig['uploadPath'], $testConfig['dimensions'], $testConfig['size']);
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Form\UploadProfilePictureForm::__construct
     */
    public function testHasElement()
    {
        $this->assertTrue($this->uploadProfilePictureForm->has('picture'));
        $this->assertTrue($this->uploadProfilePictureForm->has('csrf'));
        $this->assertTrue($this->uploadProfilePictureForm->has('submit'));
    }

    /**
     * @covers Eye4web\ZfcUser\ProfilePicture\Form\UploadProfilePictureForm::getInputFilterSpecification
     */
    public function testHasInputFilter()
    {
        $this->assertTrue($this->uploadProfilePictureForm->getInputFilter()->has('picture'));
        $this->assertTrue($this->uploadProfilePictureForm->getInputFilter()->has('csrf'));
    }
}
