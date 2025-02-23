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
                return $this->html(['message' => 'All fields are required!']);
            }

            if (strlen($username) > 32) {
                return $this->html(['message' => 'Username can have maximum 32 characters!']);
            }

            for ($i = 0; $i < strlen($username); $i++) {
                if (!ctype_alnum($username[$i])) {
                    return $this->html(['message' => 'Invalid characters! Only letters and numbers are allowed!']);
                }
            }

            $registered = $this->app->getAuth()->register($username, $password);

            if ($registered) {
                $this->app->getAuth()->login($username, $password);
                return $this->redirect($this->url("home.index"));
            } else {
                return $this->html(['message' => 'User already exists!']);
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
