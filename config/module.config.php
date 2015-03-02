<?php
return [
    'router' => [
        'routes' => [
            'zfcuser' => [
                'child_routes' => [
                    'profilepicture' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/profile-picture',
                            'defaults' => [
                                'controller' => 'Eye4web\ZfcUser\ProfilePicture\Controller\ZfcUserProfilePictureController',
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'change' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/change',
                                ],
                                'may_terminate' => false,
                                'child_routes' => [
                                    'upload' => [
                                        'type' => 'Literal',
                                        'options' => [
                                            'route' => '/upload',
                                            'defaults' => [
                                                'action'     => 'changeUpload',
                                            ],
                                        ],
                                    ],
                                ]
                            ],
                        ]
                    ],
                ]
            ]
        ],
    ],
    'service_manager' => array(
        'factories' => array(
            'Eye4web\ZfcUser\ProfilePicture\Form\UploadProfilePictureForm'
                => 'Eye4web\ZfcUser\ProfilePicture\Factory\Form\UploadProfilePictureFormFactory',
            'Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptions'
                => 'Eye4web\ZfcUser\ProfilePicture\Factory\Options\ModuleOptionsFactory',
            'Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureService'
                => 'Eye4web\ZfcUser\ProfilePicture\Factory\Service\ProfilePictureServiceFactory'
        ),
    ),
    'controllers' => array(
        'factories' => [
            'Eye4web\ZfcUser\ProfilePicture\Controller\ZfcUserProfilePictureController'
                => 'Eye4web\ZfcUser\ProfilePicture\Factory\Controller\ZfcUserProfilePictureControllerFactory'
        ]
    ),
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
