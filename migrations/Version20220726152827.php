<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220726152827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD fk_patient_id INT DEFAULT NULL, ADD fk_medecin_id INT DEFAULT NULL, DROP fk_patient, DROP fk_medecin, DROP fk_admin, DROP fk_super_admin, DROP fk_secretary, DROP fk_nurse, DROP fk_restaurant');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499BE758EA FOREIGN KEY (fk_patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F49DD017 FOREIGN KEY (fk_medecin_id) REFERENCES medecin (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6499BE758EA ON user (fk_patient_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F49DD017 ON user (fk_medecin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499BE758EA');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F49DD017');
        $this->addSql('DROP INDEX UNIQ_8D93D6499BE758EA ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649F49DD017 ON user');
        $this->addSql('ALTER TABLE user ADD fk_patient INT DEFAULT NULL, ADD fk_medecin INT DEFAULT NULL, ADD fk_admin INT DEFAULT NULL, ADD fk_super_admin INT DEFAULT NULL, ADD fk_secretary INT DEFAULT NULL, ADD fk_nurse INT DEFAULT NULL, ADD fk_restaurant INT DEFAULT NULL, DROP fk_patient_id, DROP fk_medecin_id');
    }
}
