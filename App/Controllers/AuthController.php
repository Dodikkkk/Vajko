<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Core\Responses\ViewResponse;
use App\Models\User;

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    /**
     * Login a user
     * @return Response
     */
    public function login(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        $logged = null;
        if (isset($formData['submit'])) {
            $logged = $this->app->getAuth()->login($formData['login'], $formData['password']);
            if ($logged) {
                return $this->redirect($this->url("home.index"));
            }
        }

        $data = ($logged === false ? ['message' => 'Zlý login alebo heslo!'] : []);
        return $this->html($data);
    }
    /**
     * Register a user
     * @return Response
     */
    public function register(): Response
    {
        $formData = $this->app->getRequest()->getPost();

        if (isset($formData['submit'])) {
            $username = $formData['login'] ?? '';
            $password = $formData['password'] ?? '';

            if (empty($username) || empty($password)) {
                return $this->html(['message' => 'Všetky polia sú povinné!']);
            }

            $registered = $this->app->getAuth()->register($username, $password);

            if ($registered) {
                $this->app->getAuth()->login($username, $password);
                return $this->redirect($this->url("home.index"));
            } else {
                return $this->html(['message' => 'Používateľ s týmto menom už existuje!']);
            }
        }

        return $this->html([]);
    }

    /**
     * Logout a user
     * @return ViewResponse
     */
    public function logout(): Response
    {
        $this->app->getAuth()->logout();
        return $this->html();
    }
}
