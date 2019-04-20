<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190420211451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_2C420792504D470 ON route (kbs)');
        $this->addSql('ALTER TABLE track_object ADD route_id INT NOT NULL');
        $this->addSql('ALTER TABLE track_object ADD CONSTRAINT FK_E06F6A0534ECB4E6 FOREIGN KEY (route_id) REFERENCES route (id)');
        $this->addSql('CREATE INDEX IDX_E06F6A0534ECB4E6 ON track_object (route_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_2C420792504D470 ON route');
        $this->addSql('ALTER TABLE track_object DROP FOREIGN KEY FK_E06F6A0534ECB4E6');
        $this->addSql('DROP INDEX IDX_E06F6A0534ECB4E6 ON track_object');
        $this->addSql('ALTER TABLE track_object DROP route_id');
    }
}
