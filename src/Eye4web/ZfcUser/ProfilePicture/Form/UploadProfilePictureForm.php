<?php

namespace Eye4web\ZfcUser\ProfilePicture\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class UploadProfilePictureForm extends Form implements InputFilterProviderInterface
{
    private $uploadPath;

    private $imageDimensionsOptions;

    private $imageSizeOptions;

    public function __construct($uploadPath, $imageDimensionsOptions, $imageSizeOptions)
    {
        $this->uploadPath = $uploadPath;
        $this->imageDimensionsOptions = $imageDimensionsOptions;
        $this->imageSizeOptions = $imageSizeOptions;

        parent::__construct('upload-profile-picture');

        $this->add(array(
            'name' => 'picture',
            'type'  => 'File',
            'options' => array(
                'label' => 'Profile Picture',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Button',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Upload',
                'class' => 'btn btn-success',
            ),
        ));
    }

    public function getInputFilterSpecification()
    {
        $pictureFilter = [
            'name' => 'picture',
            'required' => true,
            'filters' => [
                [
                    'name' => 'filerenameupload',
                    'options' => array(
                        'target'    => $this->uploadPath,
                        'randomize' => true,
                        'use_upload_extension' => true,
                    )
                ],

            ],
            'validators' => [
                [
                    'name' => '\Zend\Validator\File\IsImage',
                ],
            ]
        ];

        $sizeValidator = [
            'name' => '\Zend\Validator\File\Size',
            'options' => []
        ];
        foreach ($this->imageSizeOptions as $option => $value) {
            if (!is_null($value)) {
                $sizeValidator['options'][$option] = $value;
            }
        }
        $pictureFilter['validators'][] = $sizeValidator;

        $dimensionsValidator = [
            'name' => '\Zend\Validator\File\ImageSize',
            'options' => []
        ];
        foreach ($this->imageSizeOptions as $option => $value) {
            if (!is_null($value)) {
                $dimensionsValidator['options'][$option] = $value;
            }
        }
        $pictureFilter['validators'][] = $dimensionsValidator;

        $inputFilter = [$pictureFilter];

        return $inputFilter;
    }
}
