<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190502221328 extends AbstractMigration
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

        $this->addSql('ALTER TABLE schedule_data_holder ADD route_id INT NOT NULL, ADD service_id INT NOT NULL, ADD relation_number INT NOT NULL');
        $this->addSql('ALTER TABLE schedule_data_holder ADD CONSTRAINT FK_2ED4B36F34ECB4E6 FOREIGN KEY (route_id) REFERENCES route (id)');
        $this->addSql('ALTER TABLE schedule_data_holder ADD CONSTRAINT FK_2ED4B36FED5CA9E6 FOREIGN KEY (service_id) REFERENCES train_service (id)');
        $this->addSql('CREATE INDEX IDX_2ED4B36F34ECB4E6 ON schedule_data_holder (route_id)');
        $this->addSql('CREATE INDEX IDX_2ED4B36FED5CA9E6 ON schedule_data_holder (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE schedule_data_holder DROP FOREIGN KEY FK_2ED4B36F34ECB4E6');
        $this->addSql('ALTER TABLE schedule_data_holder DROP FOREIGN KEY FK_2ED4B36FED5CA9E6');
        $this->addSql('DROP INDEX IDX_2ED4B36F34ECB4E6 ON schedule_data_holder');
        $this->addSql('DROP INDEX IDX_2ED4B36FED5CA9E6 ON schedule_data_holder');
        $this->addSql('ALTER TABLE schedule_data_holder DROP route_id, DROP service_id, DROP relation_number');
    }
}
