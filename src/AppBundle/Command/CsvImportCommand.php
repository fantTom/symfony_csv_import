<?php

// src/AppBundle/Command/CsvImportCommand.php
namespace AppBundle\Command;

use AppBundle\Controller\CsvController;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;


class CsvImportCommand extends ContainerAwareCommand
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Configure
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            // the name of the command (the part after "app/console")
            ->setName('csv:import')
            //arguments
            ->addArgument('path', InputArgument::REQUIRED, 'path to csv file')
            ->addArgument('test', InputArgument::OPTIONAL, 'run test')
            // the short description shown while running "php app/console list"
            ->setDescription('Import date from cvs file.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command is importing date from cvs file.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $em = $this->getContainer()->get('doctrine')->getManager();;
        $validator = $this->getContainer()->get('validator');

        try {
            $csv = new CsvController($input->getArgument('path'), $em);
            $data = $csv->open();
            $message = $csv->import(
                $data,
                $validator,
                5,
                $input->getArgument('test')
            );
        } catch (Exception $e) {
            $io->error($e->getMessage());
            die();
        }
        $io->success('Total: ' . $message[1]);
        //show report
        $io->section("Error report:");
        $io->note($message[0]);

    }
}
