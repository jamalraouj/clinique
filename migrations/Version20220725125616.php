<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725125616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(40) NOT NULL, experience LONGTEXT DEFAULT NULL, salaire DOUBLE PRECISION NOT NULL, temps_travail TIME NOT NULL, jour_travail DATE NOT NULL, image_medecin VARCHAR(200) DEFAULT NULL, specialite VARCHAR(50) NOT NULL, status_medecin VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, genre_repas VARCHAR(255) NOT NULL, nom_repas VARCHAR(255) NOT NULL, aperitifs VARCHAR(255) NOT NULL, desert VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, jour DATE NOT NULL, temps TIME NOT NULL, repas_alternative VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, family_history LONGTEXT DEFAULT NULL, profession VARCHAR(30) DEFAULT NULL, status_patient VARCHAR(20) NOT NULL, cree_en DATETIME NOT NULL, mise_a_jour_a DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, age INT NOT NULL, telephone VARCHAR(30) NOT NULL, cin VARCHAR(30) NOT NULL, address VARCHAR(100) NOT NULL, email VARCHAR(60) NOT NULL, password VARCHAR(255) NOT NULL, joindre_a DATETIME NOT NULL, derniere_conexion DATETIME NOT NULL, user_role VARCHAR(255) NOT NULL, mise_a_jour_a DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_test (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A2FE32C5E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_test');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
