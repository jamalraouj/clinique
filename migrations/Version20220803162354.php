<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220803162354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sous_specialitee (id INT AUTO_INCREMENT NOT NULL, fk_specialite_id INT NOT NULL, nom VARCHAR(60) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_43672DB345DF9532 (fk_specialite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(60) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sous_specialitee ADD CONSTRAINT FK_43672DB345DF9532 FOREIGN KEY (fk_specialite_id) REFERENCES specialite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_specialitee DROP FOREIGN KEY FK_43672DB345DF9532');
        $this->addSql('DROP TABLE sous_specialitee');
        $this->addSql('DROP TABLE specialite');
    }
}
