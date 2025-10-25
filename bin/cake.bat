::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::
:: Bake is a shell script for running CakePHP bake script
::
:: CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
:: Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
::
:: Licensed under The MIT License
:: Redistributions of files must retain the above copyright notice.
::
:: @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
:: @link          https://cakephp.org CakePHP(tm) Project
:: @since         2.0.0
:: @license       https://opensource.org/licenses/mit-license.php MIT License
::
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

@echo off

SET app=%0
SET lib=%~dp0

php "%lib%cake" %*

echo.

exit /B %ERRORLEVEL%
