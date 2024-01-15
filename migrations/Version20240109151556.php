<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109151556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE pays pays VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE verified_at verified_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE roles roles JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE colis CHANGE poids poids VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande CHANGE date_commande date_commande DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE adresse_destination adresse_destination VARCHAR(255) DEFAULT NULL, CHANGE pays_destination pays_destination VARCHAR(255) DEFAULT NULL, CHANGE pays_expedition pays_expedition VARCHAR(255) DEFAULT NULL, CHANGE adresse_expedition adresse_expedition VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE telephone telephone VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE frais_expedition CHANGE tarif tarif VARCHAR(255) DEFAULT NULL, CHANGE pays_expedition pays_expedition VARCHAR(255) DEFAULT NULL, CHANGE pays_destination pays_destination VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE url url VARCHAR(255) DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE path path VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE information_colis CHANGE statut statut VARCHAR(255) DEFAULT NULL, CHANGE date_heure_changement date_heure_changement DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE reservation CHANGE numero_suivi numero_suivi VARCHAR(255) DEFAULT NULL, CHANGE statut_paiement statut_paiement VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE suivi_colis CHANGE statut statut VARCHAR(255) DEFAULT NULL, CHANGE date_heure_suivi date_heure_suivi DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE numero_suivi numero_suivi VARCHAR(255) DEFAULT NULL, CHANGE localisation_actuelle localisation_actuelle VARCHAR(255) DEFAULT NULL, CHANGE itineraire_prevu itineraire_prevu VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE type_emballage CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client CHANGE adresse adresse VARCHAR(255) DEFAULT \'NULL\', CHANGE pays pays VARCHAR(255) DEFAULT \'NULL\', CHANGE created_at created_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\', CHANGE verified_at verified_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\', CHANGE roles roles LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE colis CHANGE poids poids VARCHAR(255) DEFAULT \'NULL\', CHANGE description description VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE commande CHANGE date_commande date_commande DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\', CHANGE adresse_destination adresse_destination VARCHAR(255) DEFAULT \'NULL\', CHANGE pays_destination pays_destination VARCHAR(255) DEFAULT \'NULL\', CHANGE pays_expedition pays_expedition VARCHAR(255) DEFAULT \'NULL\', CHANGE adresse_expedition adresse_expedition VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE contact CHANGE telephone telephone VARCHAR(20) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE frais_expedition CHANGE tarif tarif VARCHAR(255) DEFAULT \'NULL\', CHANGE pays_expedition pays_expedition VARCHAR(255) DEFAULT \'NULL\', CHANGE pays_destination pays_destination VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE image CHANGE url url VARCHAR(255) DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\', CHANGE path path VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE information_colis CHANGE statut statut VARCHAR(255) DEFAULT \'NULL\', CHANGE date_heure_changement date_heure_changement DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE reservation CHANGE numero_suivi numero_suivi VARCHAR(255) DEFAULT \'NULL\', CHANGE statut_paiement statut_paiement VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE suivi_colis CHANGE statut statut VARCHAR(255) DEFAULT \'NULL\', CHANGE date_heure_suivi date_heure_suivi DATETIME DEFAULT \'NULL\' COMMENT \'(DC2Type:datetime_immutable)\', CHANGE numero_suivi numero_suivi VARCHAR(255) DEFAULT \'NULL\', CHANGE localisation_actuelle localisation_actuelle VARCHAR(255) DEFAULT \'NULL\', CHANGE itineraire_prevu itineraire_prevu VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE type_emballage CHANGE nom nom VARCHAR(255) DEFAULT \'NULL\', CHANGE description description VARCHAR(255) DEFAULT \'NULL\'');
    }
}
