<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230922022138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trajet_stop DROP FOREIGN KEY FK_B69F51893902063D');
        $this->addSql('ALTER TABLE trajet_stop DROP FOREIGN KEY FK_B69F5189D12A823');
        $this->addSql('DROP TABLE trajet_stop');
        $this->addSql('ALTER TABLE stop DROP FOREIGN KEY FK_B95616B6D12A823');
        $this->addSql('DROP INDEX IDX_B95616B6D12A823 ON stop');
        $this->addSql('ALTER TABLE stop DROP trajet_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE trajet_stop (trajet_id INT NOT NULL, stop_id INT NOT NULL, INDEX IDX_B69F5189D12A823 (trajet_id), INDEX IDX_B69F51893902063D (stop_id), PRIMARY KEY(trajet_id, stop_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE trajet_stop ADD CONSTRAINT FK_B69F51893902063D FOREIGN KEY (stop_id) REFERENCES stop (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trajet_stop ADD CONSTRAINT FK_B69F5189D12A823 FOREIGN KEY (trajet_id) REFERENCES trajet (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stop ADD trajet_id INT NOT NULL');
        $this->addSql('ALTER TABLE stop ADD CONSTRAINT FK_B95616B6D12A823 FOREIGN KEY (trajet_id) REFERENCES trajet (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B95616B6D12A823 ON stop (trajet_id)');
    }
}
