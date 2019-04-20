<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190420091523 extends AbstractMigration
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

        $this->addSql('CREATE TABLE track_object_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, style_class VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, route_id INT DEFAULT NULL, short_name VARCHAR(16) NOT NULL, full_name VARCHAR(128) DEFAULT NULL, INDEX IDX_9F39F8B134ECB4E6 (route_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE route (id INT AUTO_INCREMENT NOT NULL, kbs INT NOT NULL, name VARCHAR(64) DEFAULT NULL, stations_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE track_object (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, station_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, kilometer DOUBLE PRECISION DEFAULT NULL, INDEX IDX_E06F6A05C54C8C93 (type_id), INDEX IDX_E06F6A0521BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B134ECB4E6 FOREIGN KEY (route_id) REFERENCES route (id)');
        $this->addSql('ALTER TABLE track_object ADD CONSTRAINT FK_E06F6A05C54C8C93 FOREIGN KEY (type_id) REFERENCES track_object_type (id)');
        $this->addSql('ALTER TABLE track_object ADD CONSTRAINT FK_E06F6A0521BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE track_object DROP FOREIGN KEY FK_E06F6A05C54C8C93');
        $this->addSql('ALTER TABLE track_object DROP FOREIGN KEY FK_E06F6A0521BDB235');
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B134ECB4E6');
        $this->addSql('DROP TABLE track_object_type');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE route');
        $this->addSql('DROP TABLE track_object');
    }
}
