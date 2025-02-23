<?php

namespace App\Config;

use App\Auth\DummyAuthenticator;
use App\Auth\LoginAuthentificator;
use App\Core\ErrorHandler;

/**
 * Class Configuration
 * Main configuration for the application
 * @package App\Config
 */
class Configuration
{
    /**
     * App name
     */
    public const APP_NAME = 'Vaííčko MVC FW';
    public const FW_VERSION = '2.2';

    public const TMDB_TOKEN = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhYjNjY2QwMTUyNGE0ODBlMDJhMjE3NTEyNzFlNDYzNCIsIm5iZiI6MTczMDEyNTE1OC4zNDA5OTk4LCJzdWIiOiI2NzFmOWQ2NjM0YzBmYWJkNjgxZDI0YTYiLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.vb0arYZ80wSbOkLT_OIhgz1gwb5VxU4QvHHrr6ttgDg";

    /**
     * DB settings
     */
    public const DB_HOST = 'db';  // see docker/docker-compose.yml
    public const DB_NAME = 'vaiicko_db'; // see docker/.env
    public const DB_USER = 'vaiicko_user'; // see docker/.env
    public const DB_PASS = 'dtb456'; // see docker/.env

    /**
     * URL where main page logging is. If action needs login, user will be redirected to this url
     */
    public const LOGIN_URL = '?c=auth&a=login';
    /**
     * Prefix of default view in App/Views dir. <ROOT_LAYOUT>.layout.view.php
     */
    public const ROOT_LAYOUT = 'root';
    /**
     * Add all SQL queries after app output
     */
    public const SHOW_SQL_QUERY = false;

    /**
     * Show detailed stacktrace using default exception handler. Should be used only for development.
     */
    public const SHOW_EXCEPTION_DETAILS = true;
    /**
     * Class used as authenticator. Must implement IAuthenticator
     */
    public const AUTH_CLASS = LoginAuthentificator::class;
    /**
     * Class used as error handler. Must implement IHandleError
     */
    public const ERROR_HANDLER_CLASS = ErrorHandler::class;
}
