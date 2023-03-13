<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313091952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE instruments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE instruments (id INT NOT NULL, name VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE instruments_users (instruments_id INT NOT NULL, users_id INT NOT NULL, PRIMARY KEY(instruments_id, users_id))');
        $this->addSql('CREATE INDEX IDX_A21019D51EC49357 ON instruments_users (instruments_id)');
        $this->addSql('CREATE INDEX IDX_A21019D567B3B43D ON instruments_users (users_id)');
        $this->addSql('ALTER TABLE instruments_users ADD CONSTRAINT FK_A21019D51EC49357 FOREIGN KEY (instruments_id) REFERENCES instruments (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE instruments_users ADD CONSTRAINT FK_A21019D567B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE instruments_id_seq CASCADE');
        $this->addSql('ALTER TABLE instruments_users DROP CONSTRAINT FK_A21019D51EC49357');
        $this->addSql('ALTER TABLE instruments_users DROP CONSTRAINT FK_A21019D567B3B43D');
        $this->addSql('DROP TABLE instruments');
        $this->addSql('DROP TABLE instruments_users');
    }
}
