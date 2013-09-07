<?php
/**
 * PHP 5
 *
 * CakePHP(tm) Tests <http://book.cakephp.org/2.0/en/development/testing.html>
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://book.cakephp.org/2.0/en/development/testing.html CakePHP(tm) Tests
 * @since         CakePHP(tm) v 1.2.0.4206
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Test\TestCase;

use Cake\Core\App;
use Cake\TestSuite\TestCase;

require_once CAKE_CORE_INCLUDE_PATH . '/autoload.php';

/**
 * AutoloaderTest class
 */
class AutoloaderTest extends TestCase {

	public function testAutoloading() {
		App::build(array(
			'Plugin' => array(CAKE . 'Test/TestApp/Plugin/'),
			'Lib' => array(CAKE . 'Test/TestApp/Plugin/TestPlugin/Lib/'),
		));

		$bogusClasses = array(
			'Beer',
			'Hash',
			'Core',
			'Core\\App',
			'Configure',
			'Model',
		);

		foreach ($bogusClasses as $class) {
			$this->assertFalse(class_exists($class));
		}

		$validClasses = array(
			'App\\Controller\\AppController',
			'App\\Model\\AppModel',
			'App\\View\\Helper\\AppHelper',
			'Cake\\Core\\App',
			'Cake\\Utility\\Security',
			'Cake\\Core\\App',
			'Cake\\Utility\\Hash',
			'TestPlugin\\Controller\\TestPluginController',
			'TestPlugin\\Model\\TestPluginComment',
			'TestPlugin\\Routing\\Route\\TestRoute',
			'TestPlugin\\Lib\\TestPluginLibrary',
			'TestPlugin\\Lib\\Custom\\Package\\CustomLibClass',
		);
		foreach ($validClasses as $class) {
			$this->assertTrue(class_exists($class), 'autoload fail: ' . $class);
		}
	}

}
