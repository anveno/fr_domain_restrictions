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
// Wenn in bestimmten Gruppen, dann in Tabellen das Feld domain_id deaktivieren:

if ( (\rex::isBackend() && \rex::getUser()) && ( !\rex::getUser()->isAdmin()) ) {
    // Check ob es das Feld "domain_id" gibt
    $hasDomainField = fr_domain_restrictions::checkDomainField(rex_request('table_name'));

    if ($hasDomainField) {
        // Setze Filter
        rex_extension::register('YFORM_MANAGER_DATA_EDIT_FILTER', function ($ep) {
            $filter = $ep->getSubject();
            $filter = ['domain_id' => fr_domain_restrictions::restrictions()];
            return $filter;
        });

        // Lege Felder und Werte Fest, die durch die User nicht bearbeitet werden können.
        rex_extension::register('YFORM_MANAGER_DATA_EDIT_SET', function ($ep) {
            $editset = $ep->getSubject();
            $editset = ['domain_id' => fr_domain_restrictions::restrictions()];
            return $editset;
        });
    }
}