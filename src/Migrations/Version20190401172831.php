<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401172831 extends AbstractMigration
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

        $this->addSql('ALTER TABLE car ADD seats_count INT NOT NULL, ADD length DOUBLE PRECISION NOT NULL, ADD weight INT NOT NULL');
        $this->addSql('ALTER TABLE motor_unit ADD seats_count INT NOT NULL, ADD total_length DOUBLE PRECISION NOT NULL, ADD continuous_output INT NOT NULL, ADD total_weight INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car DROP seats_count, DROP length, DROP weight');
        $this->addSql('ALTER TABLE motor_unit DROP seats_count, DROP total_length, DROP continuous_output, DROP total_weight');
    }
}
