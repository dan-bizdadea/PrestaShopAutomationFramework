<?php

namespace PrestaShop\PSTAF;

use Symfony\Component\Console\Application;

class CommandLineTool extends Application
{
    public function __construct()
    {
        parent::__construct();

        $this->add(new Command\ProjectInit());
        $this->add(new Command\ProjectClean());
        $this->add(new Command\Install());
        $this->add(new Command\StartSelenium());
        $this->add(new Command\StopSelenium());
        $this->add(new Command\RestartSelenium());
        $this->add(new Command\SeleniumStatus());
        $this->add(new Command\RunTest());
        $this->add(new Command\ShopAddOrUpdateLanguage());
        $this->add(new Command\DatabaseDump());
        $this->add(new Command\DatabaseLoad());
        $this->add(new Command\ReportsServer());
    }
}
