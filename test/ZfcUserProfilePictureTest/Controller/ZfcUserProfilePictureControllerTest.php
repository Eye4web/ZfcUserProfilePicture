<?php

namespace Eye4web\ZfcUserProfilePictureTest\Controller;

use Eye4web\ZfcUser\ProfilePicture\Controller\ZfcUserProfilePictureController;
use Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptionsInterface;
use Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureServiceInterface;
use Eye4web\ZfcUser\ProfilePicture\Form\UploadProfilePictureForm;
use PHPUnit_Framework_TestCase;
use Zend\Http\Response;
use Zend\Stdlib\Parameters;
use ZfcUser\Entity\User as UserIdentity;

class ZfcUserProfilePictureControllerTest extends PHPUnit_Framework_TestCase
{
    /** @var ZfcUserProfilePictureController */
    protected $controller;

    /** @var UploadProfilePictureForm */
    protected $uploadProfilePictureForm;

    /** @var ProfilePictureServiceInterface */
    protected $profilePictureService;

    /** @var \Zend\Mvc\Controller\PluginManager */
    protected $pluginManager;

    protected $zfcUserAuthenticationPlugin;

    /** @var \Eye4web\ZfcUser\Pm\Options\ModuleOptions */
    protected $moduleOptions;

    /** @var \Zend\EventManager\EventManager */
    protected $eventManager;

    public $pluginManagerPlugins = [];

    public function setUp()
    {
        /** @var UploadProfilePictureForm $uploadProfilePictureForm */
        $uploadProfilePictureForm = $this->getMockBuilder('Eye4web\ZfcUser\ProfilePicture\Form\UploadProfilePictureForm')
                             ->disableOriginalConstructor()
                             ->getMock();
        $this->uploadProfilePictureForm = $uploadProfilePictureForm;

        /** @var \Eye4web\ZfcUser\Pm\Options\ModuleOptions $moduleOptions */
        $moduleOptions = $this->getMockBuilder('Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptionsInterface')
                               ->disableOriginalConstructor()
                               ->getMock();
        $this->moduleOptions = $moduleOptions;

        /** @var \Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureServiceInterface $profilePictureService */
        $profilePictureService = $this->getMockBuilder('Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureServiceInterface')
                               ->disableOriginalConstructor()
                               ->getMock();
        $this->profilePictureService = $profilePictureService;

        $this->zfcUserAuthenticationPlugin = $this->getMock('ZfcUser\Controller\Plugin\ZfcUserAuthentication');

        /** @var \Zend\Mvc\Controller\PluginManager */
        $pluginManager = $this->getMock('Zend\Mvc\Controller\PluginManager', array('get'));
        $pluginManager->expects($this->any())
                      ->method('get')
                      ->will($this->returnCallback(array($this, 'helperMockCallbackPluginManagerGet')));
        $this->pluginManager = $pluginManager;

        $eventManager = $this->getMock('Zend\EventManager\EventManager');
        $this->eventManager = $eventManager;

        $controller = new ZfcUserProfilePictureController(
            $uploadProfilePictureForm,
            $profilePictureService,
            $moduleOptions
        );

        $controller->setPluginManager($pluginManager);
        $controller->setEventManager($eventManager);

        $this->controller = $controller;
    }

    public function testChangeUploadWithoutPostMethodAction()
    {
        $controller = $this->controller;
        $controller->changeUploadAction();
    }

    /**
     *
     * @dataProvider providerTestChangeUploadAction
     */
    public function testChangeUploadWithPostMethodAction($fileRedirectGetReturn, $isValid)
    {
        $controller = $this->controller;
        $this->setUpZfcUserAuthenticationPlugin(array(
            'hasIdentity'=>true
        ));
        $response = new Response();

        $prg = $this->getMock('Zend\Mvc\Controller\Plugin\FilePostRedirectGet');
        $this->pluginManagerPlugins['prg'] = $prg;

        $prg->expects($this->any())
            ->method('__invoke')
            ->with($this->uploadProfilePictureForm, 'zfcuser/profilepicture/change/upload')
            ->will($this->returnValue($fileRedirectGetReturn));

        if ($fileRedirectGetReturn !== false && !($fileRedirectGetReturn instanceof Response)) {

            $this->uploadProfilePictureForm->expects($this->any())
                ->method('setData')
                ->with($fileRedirectGetReturn);

            $this->uploadProfilePictureForm->expects($this->any())
                ->method('isValid')
                ->will($this->returnValue((bool) $isValid));

            if ($isValid) {
                $this->uploadProfilePictureForm->expects($this->any())
                    ->method('getData')
                    ->will($this->returnValue($fileRedirectGetReturn));

                $mockIdentity = $this->getMock('ZfcUser\Entity\UserInterface');
                $authService = $this->getMock('Zend\Authentication\AuthenticationService');
                $authService->expects($this->any())
                            ->method('getIdentity')
                            ->will($this->returnValue($mockIdentity));

                $this->profilePictureService->expects($this->any())
                    ->method('updateProfilePicture')
                    ->with($fileRedirectGetReturn['picture']['tmp_name'], $mockIdentity);


                $redirect = $this->getMock('Zend\Mvc\Controller\Plugin\Redirect');
                $redirect->expects($this->any())
                         ->method('toRoute')
                         ->with('zfcuser')
                         ->will($this->returnValue($response));

                $this->pluginManagerPlugins['redirect']= $redirect;
            }
        }

        $result = $controller->changeUploadAction();
        $exceptedReturn = null;

        if ($fileRedirectGetReturn instanceof Response) {
            $this->assertInstanceOf('Zend\Http\Response', $fileRedirectGetReturn);
        }  else {

        }
    }

    public function providerTestChangeUploadAction()
    {
        return array(
            //   $fileRedirectGetReturn, $isValid
            array(new Response(),  null),
            array(new Response(),  null),

            array(false,           null),
            array(false,           null),

            array(['picture' => ['tmp_name' => 'foo.jpg']],   false),
            array(['picture' => ['tmp_name' => 'foo.jpg']],   false),

            array(['picture' => ['tmp_name' => 'foo.jpg']],   true),
            array(['picture' => ['tmp_name' => 'foo.jpg']],   true),

            array(['picture' => ['tmp_name' => 'foo.jpg']],   true),
            array(['picture' => ['tmp_name' => 'foo.jpg']],   true),
        );
    }

    public function helperMockCallbackPluginManagerGet($key)
    {
        return (array_key_exists($key, $this->pluginManagerPlugins))
            ? $this->pluginManagerPlugins[$key]
            : null;
    }

    public function setUpZfcUserAuthenticationPlugin($option)
    {
        if (array_key_exists('hasIdentity', $option)) {
            $return = (is_callable($option['hasIdentity']))
                ? $this->returnCallback($option['hasIdentity'])
                : $this->returnValue($option['hasIdentity']);
            $this->zfcUserAuthenticationPlugin->expects($this->any())
                ->method('hasIdentity')
                ->will($return);
        }

        if (array_key_exists('getAuthAdapter', $option)) {
            $return = (is_callable($option['getAuthAdapter']))
                ? $this->returnCallback($option['getAuthAdapter'])
                : $this->returnValue($option['getAuthAdapter']);

            $this->zfcUserAuthenticationPlugin->expects($this->any())
                ->method('getAuthAdapter')
                ->will($return);
        }

        if (array_key_exists('getAuthService', $option)) {
            $return = (is_callable($option['getAuthService']))
                ? $this->returnCallback($option['getAuthService'])
                : $this->returnValue($option['getAuthService']);

            $this->zfcUserAuthenticationPlugin->expects($this->any())
                ->method('getAuthService')
                ->will($return);
        }

        $this->pluginManagerPlugins['zfcUserAuthentication'] = $this->zfcUserAuthenticationPlugin;

        return $this->zfcUserAuthenticationPlugin;
    }
}
