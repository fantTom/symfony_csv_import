<?php


namespace AppBundle\Controller;

use League\Csv\Reader;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductData;


class CsvController
{
    private $path;

    /**
     * @var
     */
    private $entityManager;


    public function __construct($path, $entityManager)
    {
        $this->path = $path;
        $this->entityManager = $entityManager;

    }

    public function open()
    {
        $file =  __DIR__ . '/../../../temp/' . $this->path;
        if (file_exists($file)) {
            // read cvs file
            $reader = Reader::createFromPath($file, 'r');

            $delimiters_list = $reader->fetchDelimitersOccurrence([',', '|'], 10);

            if($delimiters_list[","] > $delimiters_list["|"]){
                $reader->setDelimiter(',');
            } else {
                $reader->setDelimiter('|');
            }

            $input_bom = $reader->getInputBOM();
            //check bom
            if ($input_bom === Reader::BOM_UTF16_LE || $input_bom === Reader::BOM_UTF16_BE) {
                CharsetConverter::addTo($reader, 'utf-16', 'utf-8');
            }

            if (count($reader->fetchAll())==0) {
                return 'Invalid file!';
            }
            //cvs to object
            return $reader->fetchAssoc();

        } else {
            return "File not found!"; //Invalid file!
        }
    }

    public function import($results, $validator, $batchSize, $test)
    {
        $errorsString = [];
        $i = 0;
        //save data to database
        foreach ($results as $row) {
            $productData = new ProductData();
            $productData->setCode((string)$row['Product Code']);
            $productData->setName((string)$row['Product Name']);
            $productData->setDescription((string)$row['Product Description']);
            $productData->setStock((integer)$row['Stock']);
            $productData->setPrice((string)$row['Cost in GBP']);
            $productData->setAdder(new \DateTime('now'));
            //check if Discontinued=yes
            if ($row['Discontinued'] == 'yes') {
                $productData->setDiscontinued(new \DateTime("now"));
            }
            //validate
            $errors = $validator->validate($productData);
            if (count($errors) > 0) {
                array_push($errorsString, (string)$productData->getCode() . " - " . $errors);
                continue;
            }
            //check for duplicate entry
            $product = $this->entityManager->getRepository('AppBundle:Product')->findOneByProductCode($productData->getCode());
            if (!$product) {
                $product = new Product($productData->getName(), $productData->getCode(), $productData->getDescription(), $productData->getStock(), $productData->getPrice(), $productData->getAdder(), $productData->getDiscontinued());
            } else {
                $product->setProductName($productData->getName());
                $product->setProductDesc($productData->getDescription());
                $product->setDiscontinued($productData->getDiscontinued());
                $product->setStockLevel($productData->getStock());
                $product->setPrice($productData->getPrice());
                $product->setTimestamp();
            }
            $this->entityManager->persist($product);
            if (($i % $batchSize) === 0) {
                if ($test != 'test') {
                    $this->entityManager->flush();
                    $this->entityManager->clear();
                }
            }
            ++$i;
        }
        if ($test != 'test') {
            //synchronized with the database
            $this->entityManager->flush();
        }
        return array($errorsString, $i);
    }
}