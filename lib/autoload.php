<?php

/**
 * CakePHP autoloader
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake
 * @since         3.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

function cakephp_autoloader($class) {
	if (class_exists($class)) {
		return true;
	}

	$file = dirname(__FILE__) . '/'. str_replace('\\', '/', $class) . '.php';
	if (file_exists($file)) {
		return require $file;
	}

	if (strpos($class, '\\') !== false) {
		list($plugin, $class) = explode('\\', $class, 2);
	}
	$path = str_replace('\\', '/', $class);

	$libPaths = Cake\Core\App::path('Lib');
	for($i = 0, $len = count($libPaths); $i < $len; $i++) {
		$file = $libPaths[$i]. $path . '.php';
		if (file_exists($file)) {
			return require $file;
		}
	}

	if (!isset($plugin)) {
		return false;
	}

	$pluginPaths = Cake\Core\App::path('Plugin');
	for($i = 0, $len = count($pluginPaths); $i < $len; $i++) {
		$pluginPath = $pluginPaths[$i];

		$file = $pluginPath . $plugin . DS . $path . '.php';
		if (file_exists($file)) {
			return require $file;
		}
	}

	return false;
}

spl_autoload_register('cakephp_autoloader');
