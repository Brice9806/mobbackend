<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230921172106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE magasin (id INT AUTO_INCREMENT NOT NULL, stop_id INT NOT NULL, type_magasin VARCHAR(255) NOT NULL, nom_magasin VARCHAR(255) NOT NULL, numéro_magasin INT NOT NULL, liens_maps VARCHAR(255) NOT NULL, INDEX IDX_54AF5F273902063D (stop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stop (id INT AUTO_INCREMENT NOT NULL, ville_stop VARCHAR(255) NOT NULL, temps_stop INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trajet (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, ville_depart VARCHAR(255) NOT NULL, ville_arrive VARCHAR(255) NOT NULL, date_depart DATE NOT NULL, date_arrive DATE NOT NULL, heure_depart TIME NOT NULL, heure_arrive TIME NOT NULL, type_bus VARCHAR(255) NOT NULL, INDEX IDX_2B5BA98CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trajet_stop (trajet_id INT NOT NULL, stop_id INT NOT NULL, INDEX IDX_B69F5189D12A823 (trajet_id), INDEX IDX_B69F51893902063D (stop_id), PRIMARY KEY(trajet_id, stop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE magasin ADD CONSTRAINT FK_54AF5F273902063D FOREIGN KEY (stop_id) REFERENCES stop (id)');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE trajet_stop ADD CONSTRAINT FK_B69F5189D12A823 FOREIGN KEY (trajet_id) REFERENCES trajet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trajet_stop ADD CONSTRAINT FK_B69F51893902063D FOREIGN KEY (stop_id) REFERENCES stop (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE magasin DROP FOREIGN KEY FK_54AF5F273902063D');
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98CA76ED395');
        $this->addSql('ALTER TABLE trajet_stop DROP FOREIGN KEY FK_B69F5189D12A823');
        $this->addSql('ALTER TABLE trajet_stop DROP FOREIGN KEY FK_B69F51893902063D');
        $this->addSql('DROP TABLE magasin');
        $this->addSql('DROP TABLE stop');
        $this->addSql('DROP TABLE trajet');
        $this->addSql('DROP TABLE trajet_stop');
    }
}
