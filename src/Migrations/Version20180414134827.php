<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180414134827 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE film_entity ADD COLUMN description CLOB');
        $this->addSql('DROP INDEX IDX_D7479B714645AF6D');
        $this->addSql('DROP INDEX IDX_D7479B71B5E9236E');
        $this->addSql('CREATE TEMPORARY TABLE __temp__film_entity_category_entity AS SELECT film_entity_id, category_entity_id FROM film_entity_category_entity');
        $this->addSql('DROP TABLE film_entity_category_entity');
        $this->addSql('CREATE TABLE film_entity_category_entity (film_entity_id INTEGER NOT NULL, category_entity_id INTEGER NOT NULL, PRIMARY KEY(film_entity_id, category_entity_id), CONSTRAINT FK_D7479B71B5E9236E FOREIGN KEY (film_entity_id) REFERENCES film_entity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D7479B714645AF6D FOREIGN KEY (category_entity_id) REFERENCES category_entity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO film_entity_category_entity (film_entity_id, category_entity_id) SELECT film_entity_id, category_entity_id FROM __temp__film_entity_category_entity');
        $this->addSql('DROP TABLE __temp__film_entity_category_entity');
        $this->addSql('CREATE INDEX IDX_D7479B714645AF6D ON film_entity_category_entity (category_entity_id)');
        $this->addSql('CREATE INDEX IDX_D7479B71B5E9236E ON film_entity_category_entity (film_entity_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__film_entity AS SELECT id, name FROM film_entity');
        $this->addSql('DROP TABLE film_entity');
        $this->addSql('CREATE TABLE film_entity (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO film_entity (id, name) SELECT id, name FROM __temp__film_entity');
        $this->addSql('DROP TABLE __temp__film_entity');
        $this->addSql('DROP INDEX IDX_D7479B71B5E9236E');
        $this->addSql('DROP INDEX IDX_D7479B714645AF6D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__film_entity_category_entity AS SELECT film_entity_id, category_entity_id FROM film_entity_category_entity');
        $this->addSql('DROP TABLE film_entity_category_entity');
        $this->addSql('CREATE TABLE film_entity_category_entity (film_entity_id INTEGER NOT NULL, category_entity_id INTEGER NOT NULL, PRIMARY KEY(film_entity_id, category_entity_id))');
        $this->addSql('INSERT INTO film_entity_category_entity (film_entity_id, category_entity_id) SELECT film_entity_id, category_entity_id FROM __temp__film_entity_category_entity');
        $this->addSql('DROP TABLE __temp__film_entity_category_entity');
        $this->addSql('CREATE INDEX IDX_D7479B71B5E9236E ON film_entity_category_entity (film_entity_id)');
        $this->addSql('CREATE INDEX IDX_D7479B714645AF6D ON film_entity_category_entity (category_entity_id)');
    }
}
