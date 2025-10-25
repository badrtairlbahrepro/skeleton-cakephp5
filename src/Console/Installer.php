<?php

declare(strict_types=1);

namespace App\Console;

use Cake\Utility\Security;
use Composer\Script\Event;
use Exception;

/**
 * Provides installation hooks for when this application is installed via
 * composer. Customize this class to suit your needs.
 */
class Installer
{
    /**
     * Does some routine installation tasks so people don't have to.
     *
     * @param \Composer\Script\Event $event The composer event object.
     * @return void
     * @throws \Exception Exception raised by validator.
     */
    public static function postInstall(Event $event): void
    {
        $io = $event->getIO();

        $rootDir = dirname(dirname(__DIR__));

        static::createAppLocalConfig($rootDir, $io);
        static::createWritableDirectories($rootDir, $io);

        static::setSecuritySalt($rootDir, $io);

        if (class_exists('\Cake\Codeception\Console\Installer')) {
            \Cake\Codeception\Console\Installer::customizeCodeceptionBinary($event);
        }
    }

    /**
     * Create the config/app_local.php file if it does not exist.
     *
     * @param string $dir The application's root directory.
     * @param \Composer\IO\IOInterface $io IO interface to write to console.
     * @return void
     */
    public static function createAppLocalConfig(string $dir, $io): void
    {
        $appConfig = $dir . '/config/app_local.php';
        $defaultConfig = $dir . '/config/app_local.example.php';

        if (!file_exists($appConfig)) {
            copy($defaultConfig, $appConfig);
            $io->write('Created `config/app_local.php` file');
        }
    }

    /**
     * Create the `logs` and `tmp` directories.
     *
     * @param string $dir The application's root directory.
     * @param \Composer\IO\IOInterface $io IO interface to write to console.
     * @return void
     */
    public static function createWritableDirectories(string $dir, $io): void
    {
        $paths = [
            'logs',
            'tmp',
            'tmp/cache',
            'tmp/cache/models',
            'tmp/cache/persistent',
            'tmp/cache/views',
            'tmp/sessions',
            'tmp/tests',
        ];

        foreach ($paths as $path) {
            $path = $dir . '/' . $path;
            if (!file_exists($path)) {
                mkdir($path, 0770, true);
            }
        }

        $io->write('Created writable directories');
    }

    /**
     * Set globally unique security salt.
     *
     * @param string $dir The application's root directory.
     * @param \Composer\IO\IOInterface $io IO interface to write to console.
     * @return void
     */
    public static function setSecuritySalt(string $dir, $io): void
    {
        $config = $dir . '/config/app_local.php';
        $content = file_get_contents($config);

        $newKey = hash('sha256', Security::randomBytes(64));
        $content = str_replace('__SALT__', $newKey, $content, $count);

        if ($count == 0) {
            $io->write('No Security.salt placeholder to replace.');

            return;
        }

        $result = file_put_contents($config, $content);
        if ($result) {
            $io->write('Updated Security.salt value in config/app_local.php');

            return;
        }
        $io->write('Unable to update Security.salt value.');
    }
}
