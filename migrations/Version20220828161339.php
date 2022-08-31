<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220828161339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE anamnese (id INT AUTO_INCREMENT NOT NULL, fk_patient_id INT DEFAULT NULL, coeur LONGTEXT DEFAULT NULL, systeme_pulmonaire LONGTEXT DEFAULT NULL, systeme_digestif LONGTEXT DEFAULT NULL, systeme_uro_gyneco LONGTEXT DEFAULT NULL, systeme_locomoteur LONGTEXT DEFAULT NULL, remarques LONGTEXT DEFAULT NULL, other LONGTEXT DEFAULT NULL, INDEX IDX_ACCF11EE9BE758EA (fk_patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anamnese ADD CONSTRAINT FK_ACCF11EE9BE758EA FOREIGN KEY (fk_patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE dossier ADD analyses LONGTEXT DEFAULT NULL, ADD allergie LONGTEXT DEFAULT NULL, ADD drogues VARCHAR(30) DEFAULT NULL, ADD type_de_sang VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE anamnese');
        $this->addSql('ALTER TABLE dossier DROP analyses, DROP allergie, DROP drogues, DROP type_de_sang');
    }
}
