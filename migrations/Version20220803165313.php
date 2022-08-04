<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220803165313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dossier ADD fk_specialite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dossier ADD CONSTRAINT FK_3D48E03745DF9532 FOREIGN KEY (fk_specialite_id) REFERENCES specialite (id)');
        $this->addSql('CREATE INDEX IDX_3D48E03745DF9532 ON dossier (fk_specialite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dossier DROP FOREIGN KEY FK_3D48E03745DF9532');
        $this->addSql('DROP INDEX IDX_3D48E03745DF9532 ON dossier');
        $this->addSql('ALTER TABLE dossier DROP fk_specialite_id');
    }
}
