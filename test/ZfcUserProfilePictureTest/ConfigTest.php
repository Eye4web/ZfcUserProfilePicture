<?php

namespace Eye4web\ZfcUserProfilePictureTest;

class ConfigTest
{
    public static function getConfig()
    {
        return [
            'uploadPath' => 'public/upload/user/profilepicture',
            'dimensions' => [
                'minWidth'  => 200,
                'maxWidth'  => 1000,
                'minHeight' => 200,
                'maxHeight' => 1000,
            ],
            'size' => [
                'min' => '100Kb',
                'max' => '4Mb',
            ],
            'changeSuccessRoute' => 'zfcuser'
        ];
    }
}
