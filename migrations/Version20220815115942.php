<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815115942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chambre (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(15) NOT NULL, status INT NOT NULL, type VARCHAR(20) NOT NULL, description VARCHAR(255) DEFAULT NULL, creer_a DATETIME NOT NULL, mise_a_jour_a DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lit (id INT AUTO_INCREMENT NOT NULL, fk_chambre_id INT NOT NULL, nombre VARCHAR(20) NOT NULL, status VARCHAR(20) NOT NULL, prix INT NOT NULL, creer_a DATETIME NOT NULL, mise_a_jour_a DATETIME NOT NULL, INDEX IDX_5DDB8E9D6B79B5C7 (fk_chambre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lit ADD CONSTRAINT FK_5DDB8E9D6B79B5C7 FOREIGN KEY (fk_chambre_id) REFERENCES chambre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lit DROP FOREIGN KEY FK_5DDB8E9D6B79B5C7');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE lit');
    }
}
