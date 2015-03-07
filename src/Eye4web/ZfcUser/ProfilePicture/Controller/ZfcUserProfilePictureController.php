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

namespace Eye4web\ZfcUser\ProfilePicture\Controller;

use Eye4web\ZfcUser\ProfilePicture\Options\ModuleOptionsInterface;
use Eye4web\ZfcUser\ProfilePicture\Service\ProfilePictureServiceInterface;
use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ZfcUserProfilePictureController extends AbstractActionController
{
    private $uploadForm;

    private $profilePictureService;

    private $config;

    public function __construct($uploadForm, ProfilePictureServiceInterface $profilePictureService, ModuleOptionsInterface $config)
    {
        $this->uploadForm = $uploadForm;
        $this->profilePictureService = $profilePictureService;
        $this->config = $config;
    }

    // @codeCoverageIgnoreStart
    public function changeUrlAction()
    {

    }
    // @codeCoverageIgnoreEnd

    public function changeUploadAction()
    {
        $form = $this->uploadForm;

        $viewModel = new ViewModel([
            'form' => $form,
        ]);

        $prg = $this->fileprg($form);
        if ($prg instanceof Response) {
            return $prg;
        } elseif (is_array($prg)) {
            if ($form->isValid()) {
                $data = $form->getData();
                $user = $this->ZfcUserAuthentication()->getIdentity();
                $this->profilePictureService->updateProfilePicture($data['picture']['tmp_name'], $user);

                return $this->redirect()->toRoute($this->config->getChangeSuccessRoute());
            }
        }

        return $viewModel;
    }
}
