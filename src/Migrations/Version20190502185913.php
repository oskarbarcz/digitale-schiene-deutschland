<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190502185913 extends AbstractMigration
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

        $this->addSql('CREATE TABLE distance (id INT AUTO_INCREMENT NOT NULL, station_a_id INT NOT NULL, station_b_id INT NOT NULL, meters INT NOT NULL, minutes INT NOT NULL, INDEX IDX_1C929A81D5ED7465 (station_a_id), INDEX IDX_1C929A81C758DB8B (station_b_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE distance ADD CONSTRAINT FK_1C929A81D5ED7465 FOREIGN KEY (station_a_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE distance ADD CONSTRAINT FK_1C929A81C758DB8B FOREIGN KEY (station_b_id) REFERENCES station (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE distance');
    }
}
