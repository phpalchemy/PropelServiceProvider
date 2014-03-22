<?php

/**
 * This file is part of the PropelServiceProvider package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace Alchemy\Tests\Propel;

use Alchemy\Service\Provider\PropelServiceProvider;
use Alchemy\Application;

/**
 * PropelProvider test cases.
 *
 * @author Erik Amaru Ortiz <aortiz.erik@gmail.com>
 */
class PropelServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!class_exists('\Propel')) {
            $this->markTestSkipped('Propel has to be installed.');
        }
    }

    public function testRegisterWithProperties()
    {
        $app = new Application();
        $app->register(new PropelServiceProvider(), array(
            'propel.path'           => __DIR__ . '/../../../../vendor/propel/propel1/runtime/lib',
            'propel.config_file'    => __DIR__ . '/PropelFixtures/FixtFull/build/conf/myproject-conf.php',
            'propel.model_path'     => __DIR__ . '/PropelFixtures/FixtFull/build/classes',
        ));

        $this->assertTrue(class_exists('Propel'), 'Propel class does not exist.');
        $this->assertGreaterThan(strpos(get_include_path(), $app['propel.model_path']), 1);
    }
}
