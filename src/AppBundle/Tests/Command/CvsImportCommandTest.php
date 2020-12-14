<?php
namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CvsImportCommandTest extends KernelTestCase
{
	public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('cvs:import');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            // pass arguments to the helper
            'test' => 'test',

        ]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Successfull!', $output);
    }
}