<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230918011146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE billet (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, paiement_id INT NOT NULL, jour_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, paye TINYINT(1) NOT NULL, nom_prenom_passager VARCHAR(255) NOT NULL, INDEX IDX_1F034AF6A76ED395 (user_id), UNIQUE INDEX UNIQ_1F034AF62A4C4478 (paiement_id), INDEX IDX_1F034AF6220C6AD0 (jour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bus (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, immatriculation VARCHAR(255) NOT NULL, type_bus VARCHAR(255) NOT NULL, INDEX IDX_2F566B69A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bus_voyage (bus_id INT NOT NULL, voyage_id INT NOT NULL, INDEX IDX_F5B11D7A2546731D (bus_id), INDEX IDX_F5B11D7A68C9E5AF (voyage_id), PRIMARY KEY(bus_id, voyage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horaire (id INT AUTO_INCREMENT NOT NULL, heure_depart TIME NOT NULL, heure_arrive TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horaire_jour (horaire_id INT NOT NULL, jour_id INT NOT NULL, INDEX IDX_8279C49D58C54515 (horaire_id), INDEX IDX_8279C49D220C6AD0 (jour_id), PRIMARY KEY(horaire_id, jour_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jour (id INT AUTO_INCREMENT NOT NULL, date_depart DATE NOT NULL, date_arrive DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE magasin (id INT AUTO_INCREMENT NOT NULL, ville_id INT NOT NULL, type_magasin VARCHAR(255) NOT NULL, nom_magasin VARCHAR(255) NOT NULL, numero_magasin INT NOT NULL, INDEX IDX_54AF5F27A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, mode_paiement VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, date_paiement DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', heure_paiement TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trajets (id INT AUTO_INCREMENT NOT NULL, voyage_id INT NOT NULL, horaire_id INT NOT NULL, depart VARCHAR(255) NOT NULL, arrive VARCHAR(255) NOT NULL, duree TIME NOT NULL, INDEX IDX_FF2B5BA968C9E5AF (voyage_id), INDEX IDX_FF2B5BA958C54515 (horaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom_ville VARCHAR(255) NOT NULL, lien_maps VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, horaire_id INT NOT NULL, ville_depart VARCHAR(255) NOT NULL, ville_arrive VARCHAR(255) NOT NULL, point_stop VARCHAR(255) NOT NULL, temps_stop TIME NOT NULL, INDEX IDX_3F9D895558C54515 (horaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_user (voyage_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1D011EC768C9E5AF (voyage_id), INDEX IDX_1D011EC7A76ED395 (user_id), PRIMARY KEY(voyage_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_ville (voyage_id INT NOT NULL, ville_id INT NOT NULL, INDEX IDX_4953E52C68C9E5AF (voyage_id), INDEX IDX_4953E52CA73F0036 (ville_id), PRIMARY KEY(voyage_id, ville_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF62A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id)');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6220C6AD0 FOREIGN KEY (jour_id) REFERENCES jour (id)');
        $this->addSql('ALTER TABLE bus ADD CONSTRAINT FK_2F566B69A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bus_voyage ADD CONSTRAINT FK_F5B11D7A2546731D FOREIGN KEY (bus_id) REFERENCES bus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bus_voyage ADD CONSTRAINT FK_F5B11D7A68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE horaire_jour ADD CONSTRAINT FK_8279C49D58C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE horaire_jour ADD CONSTRAINT FK_8279C49D220C6AD0 FOREIGN KEY (jour_id) REFERENCES jour (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE magasin ADD CONSTRAINT FK_54AF5F27A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE trajets ADD CONSTRAINT FK_FF2B5BA968C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE trajets ADD CONSTRAINT FK_FF2B5BA958C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D895558C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id)');
        $this->addSql('ALTER TABLE voyage_user ADD CONSTRAINT FK_1D011EC768C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_user ADD CONSTRAINT FK_1D011EC7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_ville ADD CONSTRAINT FK_4953E52C68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_ville ADD CONSTRAINT FK_4953E52CA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6A76ED395');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF62A4C4478');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6220C6AD0');
        $this->addSql('ALTER TABLE bus DROP FOREIGN KEY FK_2F566B69A76ED395');
        $this->addSql('ALTER TABLE bus_voyage DROP FOREIGN KEY FK_F5B11D7A2546731D');
        $this->addSql('ALTER TABLE bus_voyage DROP FOREIGN KEY FK_F5B11D7A68C9E5AF');
        $this->addSql('ALTER TABLE horaire_jour DROP FOREIGN KEY FK_8279C49D58C54515');
        $this->addSql('ALTER TABLE horaire_jour DROP FOREIGN KEY FK_8279C49D220C6AD0');
        $this->addSql('ALTER TABLE magasin DROP FOREIGN KEY FK_54AF5F27A73F0036');
        $this->addSql('ALTER TABLE trajets DROP FOREIGN KEY FK_FF2B5BA968C9E5AF');
        $this->addSql('ALTER TABLE trajets DROP FOREIGN KEY FK_FF2B5BA958C54515');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D895558C54515');
        $this->addSql('ALTER TABLE voyage_user DROP FOREIGN KEY FK_1D011EC768C9E5AF');
        $this->addSql('ALTER TABLE voyage_user DROP FOREIGN KEY FK_1D011EC7A76ED395');
        $this->addSql('ALTER TABLE voyage_ville DROP FOREIGN KEY FK_4953E52C68C9E5AF');
        $this->addSql('ALTER TABLE voyage_ville DROP FOREIGN KEY FK_4953E52CA73F0036');
        $this->addSql('DROP TABLE billet');
        $this->addSql('DROP TABLE bus');
        $this->addSql('DROP TABLE bus_voyage');
        $this->addSql('DROP TABLE horaire');
        $this->addSql('DROP TABLE horaire_jour');
        $this->addSql('DROP TABLE jour');
        $this->addSql('DROP TABLE magasin');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE trajets');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE voyage');
        $this->addSql('DROP TABLE voyage_user');
        $this->addSql('DROP TABLE voyage_ville');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
