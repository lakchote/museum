<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161019175509 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE billet (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, tarif_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, tarif_reduit TINYINT(1) NOT NULL, date_naissance DATE NOT NULL, INDEX IDX_1F034AF682EA2E54 (commande_id), INDEX IDX_1F034AF6357C0A59 (tarif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, is_finished TINYINT(1) NOT NULL, date_visite DATE NOT NULL, type_billet VARCHAR(255) NOT NULL, nb_billets INT NOT NULL, email_visiteur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, age_min INT NOT NULL, age_max INT NOT NULL, prix INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF6357C0A59 FOREIGN KEY (tarif_id) REFERENCES tarif (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF682EA2E54');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF6357C0A59');
        $this->addSql('DROP TABLE billet');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE tarif');
    }
}
