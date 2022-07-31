<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220726151138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD fk_patient INT DEFAULT NULL, ADD fk_medecin INT DEFAULT NULL, ADD fk_admin INT DEFAULT NULL, ADD fk_super_admin INT DEFAULT NULL, ADD fk_secretary INT DEFAULT NULL, ADD fk_nurse INT DEFAULT NULL, ADD fk_restaurant INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP fk_patient, DROP fk_medecin, DROP fk_admin, DROP fk_super_admin, DROP fk_secretary, DROP fk_nurse, DROP fk_restaurant');
    }
}
