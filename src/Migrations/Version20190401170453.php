<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401170453 extends AbstractMigration
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

        $this->addSql('CREATE TABLE motor_unit (id INT AUTO_INCREMENT NOT NULL, carrier_id INT DEFAULT NULL, producer_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_10FB2D3A21DFC797 (carrier_id), INDEX IDX_10FB2D3A89B658FE (producer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carrier (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, short_name VARCHAR(16) DEFAULT NULL, country_iban_code VARCHAR(2) NOT NULL, website VARCHAR(255) NOT NULL, logo_file_path VARCHAR(255) DEFAULT NULL, shortcode VARCHAR(6) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producer (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, short_name VARCHAR(16) DEFAULT NULL, logo_file_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE motor_unit ADD CONSTRAINT FK_10FB2D3A21DFC797 FOREIGN KEY (carrier_id) REFERENCES carrier (id)');
        $this->addSql('ALTER TABLE motor_unit ADD CONSTRAINT FK_10FB2D3A89B658FE FOREIGN KEY (producer_id) REFERENCES producer (id)');
        $this->addSql('ALTER TABLE engine ADD carrier_id INT NOT NULL, ADD producer_id INT NOT NULL');
        $this->addSql('ALTER TABLE engine ADD CONSTRAINT FK_E8A81A8D21DFC797 FOREIGN KEY (carrier_id) REFERENCES carrier (id)');
        $this->addSql('ALTER TABLE engine ADD CONSTRAINT FK_E8A81A8D89B658FE FOREIGN KEY (producer_id) REFERENCES producer (id)');
        $this->addSql('CREATE INDEX IDX_E8A81A8D21DFC797 ON engine (carrier_id)');
        $this->addSql('CREATE INDEX IDX_E8A81A8D89B658FE ON engine (producer_id)');
        $this->addSql('ALTER TABLE car ADD producer_id INT NOT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D89B658FE FOREIGN KEY (producer_id) REFERENCES producer (id)');
        $this->addSql('CREATE INDEX IDX_773DE69D89B658FE ON car (producer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE engine DROP FOREIGN KEY FK_E8A81A8D21DFC797');
        $this->addSql('ALTER TABLE motor_unit DROP FOREIGN KEY FK_10FB2D3A21DFC797');
        $this->addSql('ALTER TABLE engine DROP FOREIGN KEY FK_E8A81A8D89B658FE');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D89B658FE');
        $this->addSql('ALTER TABLE motor_unit DROP FOREIGN KEY FK_10FB2D3A89B658FE');
        $this->addSql('DROP TABLE motor_unit');
        $this->addSql('DROP TABLE carrier');
        $this->addSql('DROP TABLE producer');
        $this->addSql('DROP INDEX IDX_773DE69D89B658FE ON car');
        $this->addSql('ALTER TABLE car DROP producer_id');
        $this->addSql('DROP INDEX IDX_E8A81A8D21DFC797 ON engine');
        $this->addSql('DROP INDEX IDX_E8A81A8D89B658FE ON engine');
        $this->addSql('ALTER TABLE engine DROP carrier_id, DROP producer_id');
    }
}
