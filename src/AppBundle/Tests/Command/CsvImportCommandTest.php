<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CsvImportCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $kernel->boot();

        $application = new Application($kernel);

        $command = $application->find('cvs:import');
        $commandTester = new CommandTester($command);

        // pass arguments to the helper
        $commandTester->execute(['path' => 'stock.csv', 'test' => 'test']);

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Successfull!', $output);
    }
}