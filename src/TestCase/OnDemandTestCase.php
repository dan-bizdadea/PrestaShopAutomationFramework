<?php

namespace PrestaShop\PSTAF\TestCase;

use PrestaShop\PSTAF\Shop;
use PrestaShop\PSTAF\SeleniumManager;
use PrestaShop\PSTAF\OnDemand\HomePage;
use PrestaShop\PSTAF\Helper\FileSystem as FS;

class OnDemandTestCase extends TestCase
{
	protected $homePage;

	public function getSecrets()
	{
		$class = explode('\\', get_called_class());
		$class = end($class);

		$path = FS::join($this->getTestPath(), $class.'.secrets.json');

		if (file_exists($path)) {
			return json_decode(file_get_contents($path), true);
		} else {
			return [];
		}
	}

    public function setUp()
    {
        $this->shop = static::getShop();
        $this->browser = static::getBrowser();
        
        if (!$this->homePage) {
        	$this->homePage = new HomePage($this->browser, $this->getSecrets());
        }
    }

    public function tearDown()
    {
        // Do nothing
    }

    public static function setUpBeforeClass()
    {
        SeleniumManager::ensureSeleniumIsRunning();
    }

    public static function tearDownAfterClass()
    {
       
    }
}
