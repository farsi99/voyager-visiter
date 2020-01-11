<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200111075250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE favoris (id INT AUTO_INCREMENT NOT NULL, booker_id INT DEFAULT NULL, bien_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_8933C4328B7E4006 (booker_id), INDEX IDX_8933C432BD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C4328B7E4006 FOREIGN KEY (booker_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432BD95B80F FOREIGN KEY (bien_id) REFERENCES biens (id)');
        $this->addSql('ALTER TABLE biens ADD latitude VARCHAR(255) DEFAULT NULL, ADD longitude VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE favoris');
        $this->addSql('ALTER TABLE biens DROP latitude, DROP longitude');
    }
}
