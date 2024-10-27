<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313142202 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acces_groupe DROP FOREIGN KEY FK_6F094F06FC05BFAD');
        $this->addSql('CREATE TABLE liste_do (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_do_compte (liste_do_id INT NOT NULL, compte_id INT NOT NULL, INDEX IDX_1890DAD54F2E0949 (liste_do_id), INDEX IDX_1890DAD5F2C56620 (compte_id), PRIMARY KEY(liste_do_id, compte_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liste_do_compte ADD CONSTRAINT FK_1890DAD54F2E0949 FOREIGN KEY (liste_do_id) REFERENCES liste_do (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_do_compte ADD CONSTRAINT FK_1890DAD5F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE acces');
        $this->addSql('DROP TABLE acces_groupe');
        $this->addSql('DROP TABLE compte_ecosysteme_filiere');
        $this->addSql('DROP TABLE data_gpac');
        $this->addSql('DROP TABLE selection');
        $this->addSql('ALTER TABLE compte_data CHANGE value value MEDIUMTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE projets_data CHANGE value value MEDIUMTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_do_compte DROP FOREIGN KEY FK_1890DAD54F2E0949');
        $this->addSql('CREATE TABLE acces (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom_constant VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_deleted TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE acces_groupe (id INT AUTO_INCREMENT NOT NULL, groupe_id INT NOT NULL, acces_id INT NOT NULL, is_acces TINYINT(1) NOT NULL, INDEX IDX_6F094F067A45358C (groupe_id), INDEX IDX_6F094F06FC05BFAD (acces_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE compte_ecosysteme_filiere (compte_id INT NOT NULL, ecosysteme_filiere_id INT NOT NULL, INDEX IDX_739590A9BA4480C3 (ecosysteme_filiere_id), INDEX IDX_739590A9F2C56620 (compte_id), PRIMARY KEY(compte_id, ecosysteme_filiere_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE data_gpac (id INT AUTO_INCREMENT NOT NULL, projet_id INT NOT NULL, cle VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C056D910C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE selection (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_deleted TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE acces_groupe ADD CONSTRAINT FK_6F094F067A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE acces_groupe ADD CONSTRAINT FK_6F094F06FC05BFAD FOREIGN KEY (acces_id) REFERENCES acces (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE compte_ecosysteme_filiere ADD CONSTRAINT FK_739590A9BA4480C3 FOREIGN KEY (ecosysteme_filiere_id) REFERENCES ecosysteme_filiere (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE compte_ecosysteme_filiere ADD CONSTRAINT FK_739590A9F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE data_gpac ADD CONSTRAINT FK_C056D910C18272 FOREIGN KEY (projet_id) REFERENCES projets (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE liste_do');
        $this->addSql('DROP TABLE liste_do_compte');
        $this->addSql('ALTER TABLE compte_data CHANGE value value MEDIUMTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE projets_data CHANGE value value MEDIUMTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
