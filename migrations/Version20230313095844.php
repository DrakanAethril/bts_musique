<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313095844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE lessons_slots_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE lessons_slots (id INT NOT NULL, name VARCHAR(255) NOT NULL, day INT NOT NULL, hour_start TIME(0) WITHOUT TIME ZONE NOT NULL, hour_end TIME(0) WITHOUT TIME ZONE NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE lessons_slots_id_seq CASCADE');
        $this->addSql('DROP TABLE lessons_slots');
    }
}
