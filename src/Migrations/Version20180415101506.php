<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180415101506 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE category_entity ADD COLUMN hidden BOOLEAN');  // NOT NULL
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment_entity AS SELECT id, comment FROM comment_entity');
        $this->addSql('DROP TABLE comment_entity');
        $this->addSql('CREATE TABLE comment_entity (id INTEGER NOT NULL, user_id INTEGER NOT NULL, content CLOB NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_C43B1C7AA76ED395 FOREIGN KEY (user_id) REFERENCES user_entity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO comment_entity (id, content) SELECT id, comment FROM __temp__comment_entity');
        $this->addSql('DROP TABLE __temp__comment_entity');
        $this->addSql('CREATE INDEX IDX_C43B1C7AA76ED395 ON comment_entity (user_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__film_entity AS SELECT id, name, description FROM film_entity');
        $this->addSql('DROP TABLE film_entity');
        $this->addSql('CREATE TABLE film_entity (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO film_entity (id, name, description) SELECT id, name, description FROM __temp__film_entity');
        $this->addSql('DROP TABLE __temp__film_entity');
        $this->addSql('DROP INDEX IDX_D7479B71B5E9236E');
        $this->addSql('DROP INDEX IDX_D7479B714645AF6D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__film_entity_category_entity AS SELECT film_entity_id, category_entity_id FROM film_entity_category_entity');
        $this->addSql('DROP TABLE film_entity_category_entity');
        $this->addSql('CREATE TABLE film_entity_category_entity (film_entity_id INTEGER NOT NULL, category_entity_id INTEGER NOT NULL, PRIMARY KEY(film_entity_id, category_entity_id), CONSTRAINT FK_D7479B71B5E9236E FOREIGN KEY (film_entity_id) REFERENCES film_entity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D7479B714645AF6D FOREIGN KEY (category_entity_id) REFERENCES category_entity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO film_entity_category_entity (film_entity_id, category_entity_id) SELECT film_entity_id, category_entity_id FROM __temp__film_entity_category_entity');
        $this->addSql('DROP TABLE __temp__film_entity_category_entity');
        $this->addSql('CREATE INDEX IDX_D7479B71B5E9236E ON film_entity_category_entity (film_entity_id)');
        $this->addSql('CREATE INDEX IDX_D7479B714645AF6D ON film_entity_category_entity (category_entity_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__category_entity AS SELECT id, name FROM category_entity');
        $this->addSql('DROP TABLE category_entity');
        $this->addSql('CREATE TABLE category_entity (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO category_entity (id, name) SELECT id, name FROM __temp__category_entity');
        $this->addSql('DROP TABLE __temp__category_entity');
        $this->addSql('DROP INDEX IDX_C43B1C7AA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__comment_entity AS SELECT id, content FROM comment_entity');
        $this->addSql('DROP TABLE comment_entity');
        $this->addSql('CREATE TABLE comment_entity (id INTEGER NOT NULL, comment CLOB NOT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO comment_entity (id, comment) SELECT id, content FROM __temp__comment_entity');
        $this->addSql('DROP TABLE __temp__comment_entity');
        $this->addSql('CREATE TEMPORARY TABLE __temp__film_entity AS SELECT id, name, description FROM film_entity');
        $this->addSql('DROP TABLE film_entity');
        $this->addSql('CREATE TABLE film_entity (id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO film_entity (id, name, description) SELECT id, name, description FROM __temp__film_entity');
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
