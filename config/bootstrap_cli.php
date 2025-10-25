<?php
declare(strict_types=1);

/*
 * Additional bootstrapping and configuration for CLI environments should
 * be put here.
 */

use Cake\Core\Configure;

// Set the fullBaseUrl to allow URL generation in shell commands.
// This is useful when sending emails from shells.
Configure::write('App.fullBaseUrl', 'http://localhost');
