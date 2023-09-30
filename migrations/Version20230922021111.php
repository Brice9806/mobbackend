<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230922021111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE magasin CHANGE numéro_magasin numero_magasin INT NOT NULL');
        $this->addSql('ALTER TABLE stop ADD trajet_id INT NOT NULL');
        $this->addSql('ALTER TABLE stop ADD CONSTRAINT FK_B95616B6D12A823 FOREIGN KEY (trajet_id) REFERENCES trajet (id)');
        $this->addSql('CREATE INDEX IDX_B95616B6D12A823 ON stop (trajet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stop DROP FOREIGN KEY FK_B95616B6D12A823');
        $this->addSql('DROP INDEX IDX_B95616B6D12A823 ON stop');
        $this->addSql('ALTER TABLE stop DROP trajet_id');
        $this->addSql('ALTER TABLE magasin CHANGE numero_magasin numéro_magasin INT NOT NULL');
    }
}
