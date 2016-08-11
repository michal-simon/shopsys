<?php

namespace SS6\ShopBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use ShopSys\MigrationBundle\Component\Doctrine\Migrations\AbstractMigration;
use SS6\ShopBundle\Component\Setting\Setting;

class Version20160129122637 extends AbstractMigration {

	/**
	 * @param \Doctrine\DBAL\Schema\Schema $schema
	 */
	public function up(Schema $schema) {
		$sql = 'INSERT INTO setting_values (name, domain_id, value, type) VALUES
			(\'' . Setting::BASE_URL . '\', 1, \'http://localhost:8080\', \'string\'),
			(\'' . Setting::BASE_URL . '\', 2, \'http://2.localhost:8080\', \'string\')';
		$this->sql($sql);

		$this->sql('CREATE OR REPLACE FUNCTION get_domain_ids_by_locale(locale text) RETURNS TABLE(domain_id integer)  AS $$
			BEGIN
				CASE
					WHEN locale = \'cs\' THEN RETURN QUERY VALUES (1);
					WHEN locale = \'en\' THEN RETURN QUERY VALUES (2);
					ELSE RAISE EXCEPTION \'Locale % does not exists\', locale;
				END CASE;
			END
			$$ LANGUAGE plpgsql IMMUTABLE;');

		$this->sql('CREATE OR REPLACE FUNCTION get_domain_locale(domain_id integer) RETURNS text AS $$
			BEGIN
				CASE
					WHEN domain_id = 1 THEN RETURN \'cs\';
					WHEN domain_id = 2 THEN RETURN \'en\';
					ELSE RAISE EXCEPTION \'Domain with ID % does not exists\', domain_id;
				END CASE;
			END
			$$ LANGUAGE plpgsql IMMUTABLE;');
	}

	/**
	 * @param \Doctrine\DBAL\Schema\Schema $schema
	 */
	public function down(Schema $schema) {

	}

}
