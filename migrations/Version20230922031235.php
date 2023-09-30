<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230922031235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE billet ADD trajet_id INT NOT NULL');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6D12A823 FOREIGN KEY (trajet_id) REFERENCES trajet (id)');
        $this->addSql('CREATE INDEX IDX_1F034AF6D12A823 ON billet (trajet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6D12A823');
        $this->addSql('DROP INDEX IDX_1F034AF6D12A823 ON billet');
        $this->addSql('ALTER TABLE billet DROP trajet_id');
    }
}
