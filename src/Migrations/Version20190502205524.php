<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190502205524 extends AbstractMigration
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

        $this->addSql('CREATE TABLE schedule_data_holder (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule_data_holder_station (schedule_data_holder_id INT NOT NULL, station_id INT NOT NULL, INDEX IDX_47931BA6B9CA2B5 (schedule_data_holder_id), INDEX IDX_47931BA21BDB235 (station_id), PRIMARY KEY(schedule_data_holder_id, station_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE train_service (id INT AUTO_INCREMENT NOT NULL, carrier_id INT NOT NULL, INDEX IDX_65B6D74921DFC797 (carrier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE schedule_data_holder_station ADD CONSTRAINT FK_47931BA6B9CA2B5 FOREIGN KEY (schedule_data_holder_id) REFERENCES schedule_data_holder (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE schedule_data_holder_station ADD CONSTRAINT FK_47931BA21BDB235 FOREIGN KEY (station_id) REFERENCES station (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE train_service ADD CONSTRAINT FK_65B6D74921DFC797 FOREIGN KEY (carrier_id) REFERENCES carrier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE schedule_data_holder_station DROP FOREIGN KEY FK_47931BA6B9CA2B5');
        $this->addSql('DROP TABLE schedule_data_holder');
        $this->addSql('DROP TABLE schedule_data_holder_station');
        $this->addSql('DROP TABLE train_service');
    }
}
