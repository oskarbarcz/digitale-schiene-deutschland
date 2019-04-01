<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401124840 extends AbstractMigration
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

        $this->addSql('CREATE TABLE consist (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consist_engine (consist_id INT NOT NULL, engine_id INT NOT NULL, INDEX IDX_EE163A0AAEB50E2B (consist_id), INDEX IDX_EE163A0AE78C9C0A (engine_id), PRIMARY KEY(consist_id, engine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consist_car (consist_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_B0FBC240AEB50E2B (consist_id), INDEX IDX_B0FBC240C3C6F69F (car_id), PRIMARY KEY(consist_id, car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consist_engine ADD CONSTRAINT FK_EE163A0AAEB50E2B FOREIGN KEY (consist_id) REFERENCES consist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consist_engine ADD CONSTRAINT FK_EE163A0AE78C9C0A FOREIGN KEY (engine_id) REFERENCES engine (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consist_car ADD CONSTRAINT FK_B0FBC240AEB50E2B FOREIGN KEY (consist_id) REFERENCES consist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consist_car ADD CONSTRAINT FK_B0FBC240C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE consist_engine DROP FOREIGN KEY FK_EE163A0AAEB50E2B');
        $this->addSql('ALTER TABLE consist_car DROP FOREIGN KEY FK_B0FBC240AEB50E2B');
        $this->addSql('DROP TABLE consist');
        $this->addSql('DROP TABLE consist_engine');
        $this->addSql('DROP TABLE consist_car');
    }
}
