<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815144425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medecin_specialite (medecin_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_3F5A311B4F31A84 (medecin_id), INDEX IDX_3F5A311B2195E0F0 (specialite_id), PRIMARY KEY(medecin_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medecin_specialite ADD CONSTRAINT FK_3F5A311B4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medecin_specialite ADD CONSTRAINT FK_3F5A311B2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medecin DROP specialite');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE medecin_specialite');
        $this->addSql('ALTER TABLE medecin ADD specialite VARCHAR(50) NOT NULL');
    }
}
