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
        $commandTester0 = new CommandTester($command);
        $commandTester1 = new CommandTester($command);
        $commandTester2 = new CommandTester($command);
        $commandTester3 = new CommandTester($command);

        // pass arguments to the helper
        $commandTester0->execute(['path' => 'stock.csv', 'test' => 'test']);
        $commandTester1->execute(['path' => 'stock1.csv', 'test' => 'test']);
        $commandTester2->execute(['path' => 'stock2.csv', 'test' => 'test']);
        $commandTester3->execute(['path' => 'stock3.csv', 'test' => 'test']);

        // the output of the command in the console
        $output0 = $commandTester0->getDisplay();
        $output1 = $commandTester1->getDisplay();
        $output2 = $commandTester1->getDisplay();
        $output3 = $commandTester1->getDisplay();

        $this->assertContains('Successful!', $output0);
        $this->assertContains('Invalid file!', $output1);
        $this->assertContains('Successful!', $output2);
        $this->assertContains('File not found!', $output3);
    }
}