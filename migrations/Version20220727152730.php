<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727152730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dossier (id INT AUTO_INCREMENT NOT NULL, fk_patient_id INT NOT NULL, title VARCHAR(80) NOT NULL, date_maintenant DATETIME NOT NULL, cahier_sante TINYINT(1) DEFAULT NULL, prix_avance INT DEFAULT NULL, prix_restant INT DEFAULT NULL, prix INT NOT NULL, status_dossier VARCHAR(40) NOT NULL, INDEX IDX_3D48E0379BE758EA (fk_patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier_medecin (dossier_id INT NOT NULL, medecin_id INT NOT NULL, INDEX IDX_5980BAFE611C0C56 (dossier_id), INDEX IDX_5980BAFE4F31A84 (medecin_id), PRIMARY KEY(dossier_id, medecin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dossier ADD CONSTRAINT FK_3D48E0379BE758EA FOREIGN KEY (fk_patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE dossier_medecin ADD CONSTRAINT FK_5980BAFE611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dossier_medecin ADD CONSTRAINT FK_5980BAFE4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dossier_medecin DROP FOREIGN KEY FK_5980BAFE611C0C56');
        $this->addSql('DROP TABLE dossier');
        $this->addSql('DROP TABLE dossier_medecin');
    }
}
