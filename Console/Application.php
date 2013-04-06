<?php

namespace AdrienBrault\SilexBundle\Console;

use Symfony\Bundle\FrameworkBundle\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\Kernel;

class Application extends BaseApplication
{
    public function __construct(Kernel $kernel)
    {
        parent::__construct($kernel);
    }

    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $this->getKernel()->flush();

        return parent::run($input, $output);
    }
}
