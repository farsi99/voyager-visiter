<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200108160939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE actualite (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, resumer LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, metas LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_54928197A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biens (id INT AUTO_INCREMENT NOT NULL, commune_id INT DEFAULT NULL, region_id INT DEFAULT NULL, proprio_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, superficie DOUBLE PRECISION DEFAULT NULL, nbre_piece INT NOT NULL, nbre_chambre INT DEFAULT NULL, salle_bain INT DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(15) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, type_bien VARCHAR(255) DEFAULT NULL, metas LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, nbre_visiteur INT DEFAULT NULL, internet TINYINT(1) DEFAULT NULL, cuisine VARCHAR(255) DEFAULT NULL, electricite VARCHAR(255) DEFAULT NULL, eau VARCHAR(255) DEFAULT NULL, climatisation TINYINT(1) NOT NULL, nbre_lit INT DEFAULT NULL, parking VARCHAR(255) DEFAULT NULL, INDEX IDX_1F9004DD131A4F72 (commune_id), INDEX IDX_1F9004DD98260155 (region_id), INDEX IDX_1F9004DD6B82600 (proprio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, actualite_id INT DEFAULT NULL, reserver_id INT DEFAULT NULL, user_id INT DEFAULT NULL, vote DOUBLE PRECISION DEFAULT NULL, contenue LONGTEXT NOT NULL, INDEX IDX_67F068BCA2843073 (actualite_id), INDEX IDX_67F068BC44A67F3 (reserver_id), INDEX IDX_67F068BCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, commune_id INT DEFAULT NULL, biens_id INT DEFAULT NULL, actualite_id INT DEFAULT NULL, vehicule_id INT DEFAULT NULL, region_id INT DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, lien VARCHAR(255) NOT NULL, INDEX IDX_C53D045F131A4F72 (commune_id), INDEX IDX_C53D045F7773350C (biens_id), INDEX IDX_C53D045FA2843073 (actualite_id), INDEX IDX_C53D045F4A4A3511 (vehicule_id), INDEX IDX_C53D045F98260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, nom_region VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserver (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, biens_id INT DEFAULT NULL, vehicule_id INT DEFAULT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, montant DOUBLE PRECISION DEFAULT NULL, date_creation DATETIME NOT NULL, INDEX IDX_B9765E93A76ED395 (user_id), INDEX IDX_B9765E937773350C (biens_id), INDEX IDX_B9765E934A4A3511 (vehicule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, civilite VARCHAR(15) DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, date_naissance DATETIME DEFAULT NULL, adresse LONGTEXT DEFAULT NULL, code_postal VARCHAR(15) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, telephone VARCHAR(250) DEFAULT NULL, mobil VARCHAR(20) DEFAULT NULL, raison_sociale VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, date_inscription DATETIME NOT NULL, motpasse VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_2DE8C6A3A76ED395 (user_id), INDEX IDX_2DE8C6A3D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, commune_id INT DEFAULT NULL, proprietaire_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, marque VARCHAR(255) DEFAULT NULL, energie VARCHAR(20) NOT NULL, kilometrage VARCHAR(125) DEFAULT NULL, annee DATETIME DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, modele VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, metas LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_292FFF1D131A4F72 (commune_id), INDEX IDX_292FFF1D76C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actualite ADD CONSTRAINT FK_54928197A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE biens ADD CONSTRAINT FK_1F9004DD131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE biens ADD CONSTRAINT FK_1F9004DD98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE biens ADD CONSTRAINT FK_1F9004DD6B82600 FOREIGN KEY (proprio_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA2843073 FOREIGN KEY (actualite_id) REFERENCES actualite (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC44A67F3 FOREIGN KEY (reserver_id) REFERENCES reserver (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F7773350C FOREIGN KEY (biens_id) REFERENCES biens (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FA2843073 FOREIGN KEY (actualite_id) REFERENCES actualite (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE reserver ADD CONSTRAINT FK_B9765E93A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reserver ADD CONSTRAINT FK_B9765E937773350C FOREIGN KEY (biens_id) REFERENCES biens (id)');
        $this->addSql('ALTER TABLE reserver ADD CONSTRAINT FK_B9765E934A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA2843073');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FA2843073');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F7773350C');
        $this->addSql('ALTER TABLE reserver DROP FOREIGN KEY FK_B9765E937773350C');
        $this->addSql('ALTER TABLE biens DROP FOREIGN KEY FK_1F9004DD131A4F72');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F131A4F72');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D131A4F72');
        $this->addSql('ALTER TABLE biens DROP FOREIGN KEY FK_1F9004DD98260155');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F98260155');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC44A67F3');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3D60322AC');
        $this->addSql('ALTER TABLE actualite DROP FOREIGN KEY FK_54928197A76ED395');
        $this->addSql('ALTER TABLE biens DROP FOREIGN KEY FK_1F9004DD6B82600');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE reserver DROP FOREIGN KEY FK_B9765E93A76ED395');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D76C50E4A');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4A4A3511');
        $this->addSql('ALTER TABLE reserver DROP FOREIGN KEY FK_B9765E934A4A3511');
        $this->addSql('DROP TABLE actualite');
        $this->addSql('DROP TABLE biens');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE reserver');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP TABLE vehicule');
    }
}
