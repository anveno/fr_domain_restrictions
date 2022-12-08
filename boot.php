<?php

///////////////////////////////////////////////////////////////////////////////////////////////////
// YForm Menüpunkt für Redakteure ausblenden

if ( (\rex::isBackend() && \rex::getUser()) && ( !\rex::getUser()->isAdmin()) ) {
    rex_extension::register('PAGES_PREPARED', function (rex_extension_point $ep) {
        $page = rex_be_controller::getPageObject('yform');
        $page->setHidden(true);
    });
}

///////////////////////////////////////////////////////////////////////////////////////////////////
// Wenn in bestimmten Gruppen, dann in Tabellen bestimmte Felder ausblenden:

if ( (\rex::isBackend() && \rex::getUser()) && ( !\rex::getUser()->isAdmin()) ) {

    if (rex_request('table_name') != rex::getTablePrefix().'yrewrite_domain_settings') {
        // Check ob es das Feld "domain" gibt
        $hasDomainField = fr_domain_restrictions::checkDomainField(rex_request('table_name'));

        if ($hasDomainField) {
            // Setze Filter
            rex_extension::register('YFORM_MANAGER_DATA_EDIT_FILTER', function ($ep) {
                $filter = $ep->getSubject();
                $filter = ['domain' => fr_domain_restrictions::restrictions()];
                return $filter;
            });

            // Lege Felder und Werte Fest, die durch die User nicht bearbeitet werden können.
            rex_extension::register('YFORM_MANAGER_DATA_EDIT_SET', function ($ep) {
                $editset = $ep->getSubject();
                $editset = ['domain' => fr_domain_restrictions::restrictions()];
                return $editset;
            });
        }
    }
    if (rex_request('table_name') == rex::getTablePrefix().'rex_yrewrite_domain_settings') {
        // Setze Filter
        rex_extension::register('YFORM_MANAGER_DATA_EDIT_FILTER', function ($ep) {
            $filter = $ep->getSubject();
            $filter = ['domain_id' => fr_domain_restrictions::restrictions()];
            return $filter;
        });
    }
}