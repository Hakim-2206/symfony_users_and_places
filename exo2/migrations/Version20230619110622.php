<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230619110622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture ADD file VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD modified_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE place_id place_id INT NOT NULL, CHANGE filename title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE place DROP photos, CHANGE user_id user_id INT NOT NULL, CHANGE latitude latitude NUMERIC(11, 8) NOT NULL, CHANGE longitude longitude NUMERIC(11, 8) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE modified_at modified_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE slug slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE place RENAME INDEX idx_feaf6c55a76ed395 TO IDX_741D53CDA76ED395');
        $this->addSql('ALTER TABLE user ADD lastname VARCHAR(150) NOT NULL, DROP name, CHANGE firstname firstname VARCHAR(150) NOT NULL, CHANGE username username VARCHAR(150) DEFAULT NULL, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture ADD filename VARCHAR(255) NOT NULL, DROP title, DROP file, DROP created_at, DROP modified_at, CHANGE place_id place_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE place ADD photos VARCHAR(255) NOT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE latitude latitude DOUBLE PRECISION NOT NULL, CHANGE longitude longitude DOUBLE PRECISION NOT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE modified_at modified_at DATETIME DEFAULT NULL, CHANGE slug slug VARCHAR(120) DEFAULT NULL');
        $this->addSql('ALTER TABLE place RENAME INDEX idx_741d53cda76ed395 TO IDX_FEAF6C55A76ED395');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL, DROP lastname, CHANGE email email VARCHAR(255) NOT NULL, CHANGE firstname firstname VARCHAR(255) NOT NULL, CHANGE username username VARCHAR(255) NOT NULL');
    }
}
