<?php

/**
 * Test suite bootstrap for CakePHP.
 *
 * This function is used to find the location of CakePHP whether CakePHP
 * has been installed as a dependency of the application, or the application
 * is itself installed as a dependency of CakePHP.
 */

 /**
  * @strict
  */
declare(strict_types=1);

/**
 * Test suite bootstrap for CakePHP.
 *
 * This function is used to find the location of CakePHP whether CakePHP
 * has been installed as a dependency of the application, or the application
 * is itself installed as a dependency of CakePHP.
 */

use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\TestSuite\Fixture\SchemaLoader;

$findRoot = function ($root) {
    do {
        $lastRoot = $root;
        $root = dirname($root);
        if (is_dir($root . '/vendor/cakephp/cakephp')) {
            return $root;
        }
    } while ($root !== $lastRoot);

    throw new Exception('Cannot find the root of the application, unable to run tests');
};
$root = $findRoot(__FILE__);
unset($findRoot);

chdir($root);

require_once $root . '/vendor/autoload.php';
require_once $root . '/config/bootstrap.php';

$_SERVER['PHP_SELF'] = '/';
