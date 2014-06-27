<?php

namespace PrestaShop;

use Symfony\Component\Console\Application;

class CommandLineTool extends Application
{
	public function __construct()
	{
		parent::__construct();

		$this->add(new Command\InitShop());
		$this->add(new Command\Install());
	}
}