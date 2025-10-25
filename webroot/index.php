<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.8
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

require dirname(__DIR__) . '/vendor/autoload.php';

use App\Application;
use Cake\Http\Server;
use Cake\Routing\Router;

/*
 * Bootstrap CakePHP.
 *
 * Does the various bits of setup that CakePHP needs to do.
 * This includes:
 *
 * - Registering the CakePHP autoloader.
 * - Setting the default application paths.
 */
require dirname(__DIR__) . '/config/bootstrap.php';

// Initialize Router to avoid uninitialized static property errors
Router::reload();

/*
 * Create and configure the Application.
 */
$server = new Server(new Application(dirname(__DIR__) . '/config'));

/*
 * Run the request/response through the application and emit the response.
 */
$server->emit($server->run());
