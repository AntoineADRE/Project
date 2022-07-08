<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706091116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auteur_produit (auteur_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_97872F4260BB6FE6 (auteur_id), INDEX IDX_97872F42F347EFB (produit_id), PRIMARY KEY(auteur_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_sous_categorie (categorie_id INT NOT NULL, sous_categorie_id INT NOT NULL, INDEX IDX_C47E5A14BCF5E72D (categorie_id), INDEX IDX_C47E5A14365BF48 (sous_categorie_id), PRIMARY KEY(categorie_id, sous_categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, imager_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_C53D045F6CF36280 (imager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_panier (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, produit_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_A235783DF77D927C (panier_id), UNIQUE INDEX UNIQ_A235783DF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, item_panier_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, code_barre VARCHAR(255) NOT NULL, date_sortie VARCHAR(255) NOT NULL, quantite INT NOT NULL, INDEX IDX_29A5EC27BCF5E72D (categorie_id), UNIQUE INDEX UNIQ_29A5EC27FBA7848C (item_panier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auteur_produit ADD CONSTRAINT FK_97872F4260BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE auteur_produit ADD CONSTRAINT FK_97872F42F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_sous_categorie ADD CONSTRAINT FK_C47E5A14BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_sous_categorie ADD CONSTRAINT FK_C47E5A14365BF48 FOREIGN KEY (sous_categorie_id) REFERENCES sous_categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F6CF36280 FOREIGN KEY (imager_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE item_panier ADD CONSTRAINT FK_A235783DF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE item_panier ADD CONSTRAINT FK_A235783DF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27FBA7848C FOREIGN KEY (item_panier_id) REFERENCES item_panier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE auteur_produit DROP FOREIGN KEY FK_97872F4260BB6FE6');
        $this->addSql('ALTER TABLE categorie_sous_categorie DROP FOREIGN KEY FK_C47E5A14BCF5E72D');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27FBA7848C');
        $this->addSql('ALTER TABLE item_panier DROP FOREIGN KEY FK_A235783DF77D927C');
        $this->addSql('ALTER TABLE auteur_produit DROP FOREIGN KEY FK_97872F42F347EFB');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F6CF36280');
        $this->addSql('ALTER TABLE item_panier DROP FOREIGN KEY FK_A235783DF347EFB');
        $this->addSql('ALTER TABLE categorie_sous_categorie DROP FOREIGN KEY FK_C47E5A14365BF48');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE auteur_produit');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_sous_categorie');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE item_panier');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE sous_categorie');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
