<?php

class fr_domain_restrictions
{
    public static function restrictions(): string
    {
        // Erlaubte Domains des Benutzers bzw. der Benutzer-Rolle
        $allowedDomains = yrewrite_domain_settings::getAllowedDomains();

        // Ein User kann mehrere Rollen und > mehreren Domains < zugeordnet sein,
        $filterdomains = array();
        foreach ($allowedDomains as $allowedDomain) {
            $filterdomains[] = $allowedDomain['id'];
        }

        $restrictions = implode(',', $filterdomains);

        return $restrictions;
    }

    public static function checkDomainField($table): bool
    {
        if ($table) {

            // prüfen ob die Tabelle ein Feld namens "domain" hat
            $sql = rex_sql::factory();
            $sql->setQuery("SHOW COLUMNS FROM `$table` LIKE 'domain'");

            if ($sql->getRows()) {
                return true;
            }

        }

        return false;
    }


}