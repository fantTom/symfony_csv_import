<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20201212190526 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
		
		//add columns
        $table = $schema->getTable('tblProductData');
        $table->addColumn('stock_level', 'integer')->setNotnull(false);
        $table->addColumn('price', 'integer')->setNotnull(false);

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
		//drop columns
        $this->addSql('ALTER TABLE tblProductData DROP COLUMN price');
        $this->addSql('ALTER TABLE tblProductData DROP COLUMN stock_level');

    }
}
