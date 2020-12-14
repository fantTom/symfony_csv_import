<?php

// src/AppBundle/Command/CvsImportCommand.php
namespace AppBundle\Command;

use AppBundle\Entity\Tblproductdata;

use League\Csv\Reader;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;


class CvsImportCommand extends ContainerAwareCommand
{
		
	/**
     * Configure
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
	{
		$this
			// the name of the command (the part after "app/console")
			->setName('cvs:import')
	
			->addArgument('test', InputArgument::OPTIONAL, 'run test')
			// the short description shown while running "php app/console list"
			->setDescription('Import date from cvs file.')
	
			// the full command description shown when running the command with
			// the "--help" option
			->setHelp('This command is importing date from cvs file.');
	}
	
	/**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
	{
		$entityManager = $this->getContainer()->get('doctrine')->getManager();
		$io = new SymfonyStyle($input, $output);	
		
		$errorProduct = 'Product(s) that not imported to database: ';
		$successCount = 0;
		
		try {
			// read cvs file
			$reader = Reader::createFromPath('%kernel.root_dir%/../temp/stock.csv', 'r');
			$input_bom = $reader->getInputBOM();
			//check bom
			if ($input_bom === Reader::BOM_UTF16_LE || $input_bom === Reader::BOM_UTF16_BE) {
				CharsetConverter::addTo($reader, 'utf-16', 'utf-8');
			}
			//cvs to array
			$results = $reader->fetchAssoc();
		} catch (Exception $e) {
			$io->error($e->getMessage());
			die();
		}
			 
		$io->title('Import CVS file to database');
		//save data to database
		foreach ($results as $row) {
			$product = (new Tblproductdata());
			$output->write( str_pad($row['Product Code'], 20));
			if(($row['Stock']>= 10 && $row['Cost in GBP']>= 5)&& $row['Cost in GBP']<= 1000){				
				$product->setCode($row['Product Code']);				
				$product->setName($row['Product Name']);
				$product->setDescription($row['Product Description']);
				$product->setStock((int)$row['Stock']);	
				$product->setPrice($row['Cost in GBP']);				
				$product->setAdder(new \DateTime('now'));
				if ($row['Discontinued']=='yes'){
					$product->setDiscontinued(new \DateTime("now"));
				}
				try{
					$entityManager->persist($product);
				} catch (Exception $e) {
					$io->error($e->getMessage());
					continue;
				} 
				$successCount ++;
				$output->writeln('[ok]');
			}
			else{
				if(empty($row['Stock'])){
					$errorProduct .= "\n".$row['Product Code'].'  --  Stock is empty.';
				}
				if( empty($row['Cost in GBP'])){			
					$errorProduct .= "\n".$row['Product Code'].'  --  Cost is empty.';
				}
				$output->writeln('[error]');
			}			
		}
		if ($input->getArgument('test') != 'test'){
			try{
				//synchronized with the database
				$entityManager->flush();
			} catch (Exception $e) {
				$io->error($e->getMessage());
				die();				
			}
		}
		$output->writeln('Successfull!');
		
		//show report
		$io->success('Successfull! Total imported: '. $successCount . "\n". $errorProduct);
	}
}
