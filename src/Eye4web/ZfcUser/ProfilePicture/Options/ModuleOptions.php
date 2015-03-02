<?php

namespace Eye4web\ZfcUser\ProfilePicture\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements
    ModuleOptionsInterface
{
    /**
     * Turn off strict options mode
     */
    protected $__strictMode__ = false;

    /**
     * @var string
     */
    protected $uploadPath = '';

    /**
     * @var array
     * Null means no restriction
     */
    protected $dimensions = [
        'minWidth'  => null,
        'maxWidth'  => null,
        'minHeight' => null,
        'maxHeight' => null,
    ];

    /**
     * @var array
     * Null means no restriction
     */
    protected $size = [
        'min' => null,
        'max' => null,
    ];

    protected $changeSuccessRoute = 'zfcuser';

    /**
     * @return string
     */
    public function getUploadPath()
    {
        return $this->uploadPath;
    }

    /**
     * @param string $uploadPath
     */
    public function setUploadPath($uploadPath)
    {
        $this->uploadPath = $uploadPath;
    }

    /**
     * @return array
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param array $dimensions
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;
    }

    /**
     * @return array
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param array $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getChangeSuccessRoute()
    {
        return $this->changeSuccessRoute;
    }

    /**
     * @param string $changeSuccessRoute
     */
    public function setChangeSuccessRoute($changeSuccessRoute)
    {
        $this->changeSuccessRoute = $changeSuccessRoute;
    }
}
