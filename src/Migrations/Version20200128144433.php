<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200128144433 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, civilite VARCHAR(15) DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, date_naissance DATETIME DEFAULT NULL, adresse LONGTEXT DEFAULT NULL, code_postal VARCHAR(15) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, telephone VARCHAR(250) DEFAULT NULL, mobil VARCHAR(20) DEFAULT NULL, raison_sociale VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, date_inscription DATETIME NOT NULL, motpasse VARCHAR(255) DEFAULT NULL, hash VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE actualite DROP FOREIGN KEY FK_54928197A76ED395');
        $this->addSql('ALTER TABLE biens DROP FOREIGN KEY FK_1F9004DD6B82600');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C4328B7E4006');
        $this->addSql('ALTER TABLE reserver DROP FOREIGN KEY FK_B9765E93A76ED395');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D76C50E4A');
        $this->addSql('DROP TABLE user');
    }
}
