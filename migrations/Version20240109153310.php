<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109153310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', verified_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_verified TINYINT(1) DEFAULT NULL, roles JSON DEFAULT NULL, UNIQUE INDEX UNIQ_C7440455E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colis (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, poids VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, delivery_cost DOUBLE PRECISION NOT NULL, weight DOUBLE PRECISION NOT NULL, moyen_paiement VARCHAR(255) NOT NULL, INDEX IDX_470BDFF9B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, type_emballage_id INT NOT NULL, frais_expedition_id INT NOT NULL, date_commande DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', statut VARCHAR(255) NOT NULL, poids VARCHAR(255) NOT NULL, adresse_destination VARCHAR(255) DEFAULT NULL, pays_destination VARCHAR(255) DEFAULT NULL, pays_expedition VARCHAR(255) DEFAULT NULL, adresse_expedition VARCHAR(255) DEFAULT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), INDEX IDX_6EEAA67DFF3D0233 (type_emballage_id), INDEX IDX_6EEAA67DCE39C9BD (frais_expedition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(20) DEFAULT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE frais_expedition (id INT AUTO_INCREMENT NOT NULL, tarif VARCHAR(255) DEFAULT NULL, pays_expedition VARCHAR(255) DEFAULT NULL, pays_destination VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(255) NOT NULL, path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE information_colis (id INT AUTO_INCREMENT NOT NULL, suivi_colis_id INT DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, date_heure_changement DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_242C1B29EB1F1DE3 (suivi_colis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, type_emballage_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, nom_dest VARCHAR(255) NOT NULL, prenom_dest VARCHAR(255) NOT NULL, numero_dest VARCHAR(255) NOT NULL, adresse_dest VARCHAR(255) NOT NULL, pays_dest VARCHAR(255) NOT NULL, moyen_paiement VARCHAR(255) NOT NULL, delivery_cost DOUBLE PRECISION NOT NULL, weight DOUBLE PRECISION NOT NULL, numero_suivi VARCHAR(255) DEFAULT NULL, reservation_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', statut_paiement VARCHAR(255) DEFAULT NULL, INDEX IDX_42C84955FF3D0233 (type_emballage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suivi_colis (id INT AUTO_INCREMENT NOT NULL, colis_id INT DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, date_heure_suivi DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', numero_suivi VARCHAR(255) DEFAULT NULL, localisation_actuelle VARCHAR(255) DEFAULT NULL, itineraire_prevu VARCHAR(255) DEFAULT NULL, INDEX IDX_E407FFDA4D268D70 (colis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_emballage (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, recommandations LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE colis ADD CONSTRAINT FK_470BDFF9B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFF3D0233 FOREIGN KEY (type_emballage_id) REFERENCES type_emballage (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DCE39C9BD FOREIGN KEY (frais_expedition_id) REFERENCES frais_expedition (id)');
        $this->addSql('ALTER TABLE information_colis ADD CONSTRAINT FK_242C1B29EB1F1DE3 FOREIGN KEY (suivi_colis_id) REFERENCES suivi_colis (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955FF3D0233 FOREIGN KEY (type_emballage_id) REFERENCES type_emballage (id)');
        $this->addSql('ALTER TABLE suivi_colis ADD CONSTRAINT FK_E407FFDA4D268D70 FOREIGN KEY (colis_id) REFERENCES colis (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE colis DROP FOREIGN KEY FK_470BDFF9B83297E7');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DFF3D0233');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DCE39C9BD');
        $this->addSql('ALTER TABLE information_colis DROP FOREIGN KEY FK_242C1B29EB1F1DE3');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955FF3D0233');
        $this->addSql('ALTER TABLE suivi_colis DROP FOREIGN KEY FK_E407FFDA4D268D70');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE colis');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE frais_expedition');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE information_colis');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE suivi_colis');
        $this->addSql('DROP TABLE type_emballage');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
