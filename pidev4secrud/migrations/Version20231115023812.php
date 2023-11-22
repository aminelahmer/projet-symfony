<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115023812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planning RENAME INDEX id_coach TO IDX_D499BFF6D1DC2CFC');
        $this->addSql('ALTER TABLE rendez_vous CHANGE date_RDV date_RDV DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE rendez_vous RENAME INDEX id_client TO IDX_65E8AA0AE173B1B8');
        $this->addSql('ALTER TABLE rendez_vous RENAME INDEX id_coach TO IDX_65E8AA0AD1DC2CFC');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE planning RENAME INDEX idx_d499bff6d1dc2cfc TO id_coach');
        $this->addSql('ALTER TABLE rendez_vous CHANGE date_RDV date_RDV DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE rendez_vous RENAME INDEX idx_65e8aa0ad1dc2cfc TO id_coach');
        $this->addSql('ALTER TABLE rendez_vous RENAME INDEX idx_65e8aa0ae173b1b8 TO id_client');
    }
}
