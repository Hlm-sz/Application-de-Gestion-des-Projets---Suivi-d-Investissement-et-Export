<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/api/base_list/newbase' => [[['_route' => 'api_email_new', '_controller' => 'App\\Controller\\Api\\BaseApiController::newEmail'], null, ['POST' => 0], null, false, false, null]],
        '/api/contact/new' => [[['_route' => 'api_contact_new', '_controller' => 'App\\Controller\\Api\\ContactApiController::newDataProjet'], null, ['POST' => 0], null, false, false, null]],
        '/api/contact/bulksecteuredit' => [[['_route' => 'app_api_contactapi_bulksecteur', '_controller' => 'App\\Controller\\Api\\ContactApiController::bulksecteur'], null, ['DELETE' => 0], null, false, false, null]],
        '/api/contact/resetlogcompte' => [[['_route' => 'app_api_contactapi_resetlogcompte', '_controller' => 'App\\Controller\\Api\\ContactApiController::resetlogcompte'], null, ['DELETE' => 0], null, false, false, null]],
        '/api/contact/resetlogprojets' => [[['_route' => 'app_api_contactapi_resetlogprojets', '_controller' => 'App\\Controller\\Api\\ContactApiController::resetlogprojets'], null, ['DELETE' => 0], null, false, false, null]],
        '/api/contact/resetdatacomptes' => [[['_route' => 'app_api_contactapi_resetdatacomptes', '_controller' => 'App\\Controller\\Api\\ContactApiController::resetdatacomptes'], null, ['DELETE' => 0], null, false, false, null]],
        '/api/contact/resetdataprojets' => [[['_route' => 'app_api_contactapi_resetdataprojets', '_controller' => 'App\\Controller\\Api\\ContactApiController::resetdataprojets'], null, ['DELETE' => 0], null, false, false, null]],
        '/api/contact/resetallcomptes' => [[['_route' => 'app_api_contactapi_resetallcomptes', '_controller' => 'App\\Controller\\Api\\ContactApiController::resetallcomptes'], null, ['DELETE' => 0], null, false, false, null]],
        '/api/contact/resetallprojets' => [[['_route' => 'app_api_contactapi_resetallprojets', '_controller' => 'App\\Controller\\Api\\ContactApiController::resetallprojets'], null, ['DELETE' => 0], null, false, false, null]],
        '/canal' => [[['_route' => 'canal_index', '_controller' => 'App\\Controller\\CanalController::index'], null, ['GET' => 0], null, true, false, null]],
        '/canal/ajax_canal' => [[['_route' => 'ajax_canal', '_controller' => 'App\\Controller\\CanalController::ajaxListsCanal'], null, ['GET' => 0], null, false, false, null]],
        '/canal/new' => [[['_route' => 'canal_new', '_controller' => 'App\\Controller\\CanalController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/carte/visite' => [[['_route' => 'carte_visite_index', '_controller' => 'App\\Controller\\CarteVisiteController::index'], null, ['GET' => 0], null, true, false, null]],
        '/carte/visite/ajax_carte_visite' => [[['_route' => 'ajax_carte_visite', '_controller' => 'App\\Controller\\CarteVisiteController::ajaxListsCarteVisite'], null, ['POST' => 0], null, false, false, null]],
        '/carte/visite/new' => [[['_route' => 'carte_visite_new', '_controller' => 'App\\Controller\\CarteVisiteController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/comptes/importer' => [[['_route' => 'compte_importer', '_controller' => 'App\\Controller\\CompteController::import'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/comptes/comptecsv' => [[['_route' => 'compte_model_csv', '_controller' => 'App\\Controller\\CompteController::modelCSV'], null, ['GET' => 0], null, false, false, null]],
        '/comptes/filtre' => [[['_route' => 'compte_filtre', '_controller' => 'App\\Controller\\CompteController::filtre'], null, ['GET' => 0], null, false, false, null]],
        '/comptes' => [[['_route' => 'compte_index', '_controller' => 'App\\Controller\\CompteController::index'], null, ['GET' => 0], null, false, false, null]],
        '/comptes/export' => [[['_route' => 'compte_export', '_controller' => 'App\\Controller\\CompteController::exporttoexcel'], null, ['GET' => 0], null, false, false, null]],
        '/partenaires/export_partenaires' => [[['_route' => 'partenaires_export', '_controller' => 'App\\Controller\\CompteController::exporttoexcelpartenaires'], null, ['GET' => 0], null, false, false, null]],
        '/partenaires' => [[['_route' => 'partenaire_list', '_controller' => 'App\\Controller\\CompteController::partenaire_index'], null, ['GET' => 0], null, false, false, null]],
        '/comptelogall' => [[['_route' => 'compte_log_filtre_all', '_controller' => 'App\\Controller\\CompteController::comptelogfiltreall'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/comptelogfiltre' => [[['_route' => 'compte_log_filtre', '_controller' => 'App\\Controller\\CompteController::comptelogfiltre'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/addnewcontact' => [[['_route' => 'add_new_contact', '_controller' => 'App\\Controller\\CompteController::contactnewadd'], null, ['GET' => 0, 'POST' => 1], null, true, false, null]],
        '/filtrelog' => [[['_route' => 'compte_filtre_log', '_controller' => 'App\\Controller\\CompteController::filtrelog'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/contact/modelcsv' => [[['_route' => 'contact_model_csv', '_controller' => 'App\\Controller\\ContactController::modelCSV'], null, ['GET' => 0], null, false, false, null]],
        '/contact/importer' => [[['_route' => 'contact_importer', '_controller' => 'App\\Controller\\ContactController::import'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/contact/export' => [[['_route' => 'contact_export', '_controller' => 'App\\Controller\\ContactController::exporttoexcel'], null, ['GET' => 0], null, false, false, null]],
        '/contact' => [[['_route' => 'contact_index', '_controller' => 'App\\Controller\\ContactController::index'], null, ['GET' => 0], null, true, false, null]],
        '/contact/filtre' => [[['_route' => 'contact_filtre', '_controller' => 'App\\Controller\\ContactController::filtre'], null, ['GET' => 0], null, false, false, null]],
        '/contact/archive' => [[['_route' => 'contact_archive', '_controller' => 'App\\Controller\\ContactController::archive'], null, ['GET' => 0], null, false, false, null]],
        '/contact/new' => [[['_route' => 'contact_new', '_controller' => 'App\\Controller\\ContactController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/contact/autocomplete' => [[['_route' => 'city_autocomplete', '_controller' => 'App\\Controller\\ContactController::autocompleteAction'], null, null, null, false, false, null]],
        '/contact/ajax_contact' => [[['_route' => 'ajax_contact', '_controller' => 'App\\Controller\\ContactController::ajaxListsContact'], null, ['GET' => 0], null, false, false, null]],
        '/contact/ajax_contact_archive' => [[['_route' => 'ajax_contact_archive', '_controller' => 'App\\Controller\\ContactController::ajaxListsContactArchive'], null, ['GET' => 0], null, false, false, null]],
        '/etat/compte' => [[['_route' => 'etat_compte_index', '_controller' => 'App\\Controller\\EtatCompteController::index'], null, ['GET' => 0], null, true, false, null]],
        '/etat/compte/new' => [[['_route' => 'etat_compte_new', '_controller' => 'App\\Controller\\EtatCompteController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/events' => [[['_route' => 'events_index', '_controller' => 'App\\Controller\\EventController::index'], null, null, null, true, false, null]],
        '/events/event' => [[['_route' => 'event_detail', '_controller' => 'App\\Controller\\EventController::detail'], null, null, null, false, false, null]],
        '/events/new' => [[['_route' => 'events_new', '_controller' => 'App\\Controller\\EventController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/fonction' => [[['_route' => 'fonction_index', '_controller' => 'App\\Controller\\FonctionController::index'], null, ['GET' => 0], null, true, false, null]],
        '/fonction/ajax_fonction' => [[['_route' => 'ajax_fonction', '_controller' => 'App\\Controller\\FonctionController::ajaxListsFonction'], null, ['GET' => 0], null, false, false, null]],
        '/fonction/new' => [[['_route' => 'fonction_new', '_controller' => 'App\\Controller\\FonctionController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/groupe' => [[['_route' => 'groupe_index', '_controller' => 'App\\Controller\\GroupeController::index'], null, ['GET' => 0], null, true, false, null]],
        '/groupe/ajax_groupe' => [[['_route' => 'ajax_groupe', '_controller' => 'App\\Controller\\GroupeController::ajaxListsGroupe'], null, ['GET' => 0], null, false, false, null]],
        '/groupe/new' => [[['_route' => 'groupe_new', '_controller' => 'App\\Controller\\GroupeController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/imports/contacts' => [[['_route' => 'imports_contacts', '_controller' => 'App\\Controller\\ImportsController::index'], null, null, null, false, false, null]],
        '/projet/activite' => [[['_route' => 'log_projet_index', '_controller' => 'App\\Controller\\LogProjetController::index'], null, ['GET' => 0], null, true, false, null]],
        '/email' => [[['_route' => 'emails_index', '_controller' => 'App\\Controller\\MailController::index'], null, null, null, true, false, null]],
        '/email/filtre' => [[['_route' => 'emails_filtre', '_controller' => 'App\\Controller\\MailController::filterEmail'], null, ['GET' => 0], null, false, false, null]],
        '/email/new' => [[['_route' => 'new_email', '_controller' => 'App\\Controller\\MailController::new'], null, null, null, false, false, null]],
        '/email/filtre_contacts' => [[['_route' => 'contacts_filtre', '_controller' => 'App\\Controller\\MailController::contacts'], null, null, null, false, false, null]],
        '/email/sendtome' => [[['_route' => 'sendtome', '_controller' => 'App\\Controller\\MailController::send'], null, null, null, false, false, null]],
        '/actions/filtre' => [[['_route' => 'actions_filtre', '_controller' => 'App\\Controller\\PartenairesActionController::filtre'], null, ['GET' => 0], null, false, false, null]],
        '/actions/export/data' => [[['_route' => 'actions_export', '_controller' => 'App\\Controller\\PartenairesActionController::export'], null, ['GET' => 0], null, false, false, null]],
        '/pays' => [[['_route' => 'pays_index', '_controller' => 'App\\Controller\\PaysController::index'], null, ['GET' => 0], null, true, false, null]],
        '/pays/new' => [[['_route' => 'pays_new', '_controller' => 'App\\Controller\\PaysController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/pays/bulk' => [[['_route' => 'pays_bulk', '_controller' => 'App\\Controller\\PaysController::Bulk'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/permission' => [[['_route' => 'permission_index', '_controller' => 'App\\Controller\\PermissionController::index'], null, ['GET' => 0], null, true, false, null]],
        '/permission/ajax_permission' => [[['_route' => 'ajax_permission', '_controller' => 'App\\Controller\\PermissionController::ajaxListsPermission'], null, ['POST' => 0], null, false, false, null]],
        '/permission/new' => [[['_route' => 'permission_new', '_controller' => 'App\\Controller\\PermissionController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/profil' => [[['_route' => 'profils_index', '_controller' => 'App\\Controller\\ProfilsController::index'], null, ['GET' => 0], null, true, false, null]],
        '/profil/ajax_profil' => [[['_route' => 'ajax_profil', '_controller' => 'App\\Controller\\ProfilsController::ajaxListsProfil'], null, ['GET' => 0], null, false, false, null]],
        '/profil/new' => [[['_route' => 'profils_new', '_controller' => 'App\\Controller\\ProfilsController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/projets/dashbord' => [[['_route' => 'projets_dashbord', '_controller' => 'App\\Controller\\ProjetsController::dashbord'], null, ['GET' => 0], null, false, false, null]],
        '/projets/filtre' => [[['_route' => 'projets_filtre', '_controller' => 'App\\Controller\\ProjetsController::filtre'], null, ['GET' => 0], null, false, false, null]],
        '/projets/export/dataOld' => [[['_route' => 'projets_export_Old', '_controller' => 'App\\Controller\\ProjetsController::exportOld'], null, ['GET' => 0], null, false, false, null]],
        '/projets/export/data' => [[['_route' => 'projets_export', '_controller' => 'App\\Controller\\ProjetsController::export'], null, ['GET' => 0], null, false, false, null]],
        '/regions' => [[['_route' => 'regions_index', '_controller' => 'App\\Controller\\RegionsController::index'], null, ['GET' => 0], null, true, false, null]],
        '/regions/new' => [[['_route' => 'regions_new', '_controller' => 'App\\Controller\\RegionsController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/regions/bulk' => [[['_route' => 'regions_bulk', '_controller' => 'App\\Controller\\RegionsController::Bulk'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/reporting' => [[['_route' => 'reporting', '_controller' => 'App\\Controller\\ReportingController::index'], null, null, null, false, false, null]],
        '/restriction' => [[['_route' => 'restriction_index', '_controller' => 'App\\Controller\\RestrictionController::index'], null, ['GET' => 0], null, true, false, null]],
        '/restriction/ajax_restriction' => [[['_route' => 'ajax_restriction', '_controller' => 'App\\Controller\\RestrictionController::ajaxListsRestriction'], null, ['GET' => 0], null, false, false, null]],
        '/restriction/new' => [[['_route' => 'restriction_new', '_controller' => 'App\\Controller\\RestrictionController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/role' => [[['_route' => 'role_index', '_controller' => 'App\\Controller\\RoleController::index'], null, ['GET' => 0], null, true, false, null]],
        '/role/ajax_role' => [[['_route' => 'ajax_role', '_controller' => 'App\\Controller\\RoleController::ajaxListsRole'], null, ['GET' => 0], null, false, false, null]],
        '/role/new' => [[['_route' => 'role_new', '_controller' => 'App\\Controller\\RoleController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/secteur' => [[['_route' => 'secteur_index', '_controller' => 'App\\Controller\\SecteurController::index'], null, ['GET' => 0], null, true, false, null]],
        '/secteur/ajax_secteur' => [[['_route' => 'ajax_secteur', '_controller' => 'App\\Controller\\SecteurController::ajaxListsSecteur'], null, ['GET' => 0], null, false, false, null]],
        '/secteur/new' => [[['_route' => 'secteur_new', '_controller' => 'App\\Controller\\SecteurController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
        '/404' => [[['_route' => '404_page', '_controller' => 'App\\Controller\\SecurityController::page_404'], null, null, null, false, false, null]],
        '/403' => [[['_route' => '403_page', '_controller' => 'App\\Controller\\SecurityController::page_403'], null, null, null, false, false, null]],
        '/type/compte' => [[['_route' => 'type_compte_index', '_controller' => 'App\\Controller\\TypeCompteController::index'], null, ['GET' => 0], null, true, false, null]],
        '/type/compte/new' => [[['_route' => 'type_compte_new', '_controller' => 'App\\Controller\\TypeCompteController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/hello' => [[['_route' => 'type_projet_index', '_controller' => 'App\\Controller\\TypeProjetController::index'], null, ['GET' => 0], null, true, false, null]],
        '/hello/new' => [[['_route' => 'type_projet_new', '_controller' => 'App\\Controller\\TypeProjetController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/user' => [[['_route' => 'user_index', '_controller' => 'App\\Controller\\UserController::index'], null, ['GET' => 0], null, true, false, null]],
        '/user/ajax_user' => [[['_route' => 'ajax_user', '_controller' => 'App\\Controller\\UserController::ajaxListsUser'], null, ['GET' => 0], null, false, false, null]],
        '/user/new' => [[['_route' => 'user_new', '_controller' => 'App\\Controller\\UserController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/a(?'
                    .'|pi/contact/([^/]++)/edit(*:198)'
                    .'|jax_compte/([^/]++)(*:225)'
                    .'|ctions(?'
                        .'|(?:/([^/]++))?(*:256)'
                        .'|/(?'
                            .'|generate/pdf/([^/]++)(*:289)'
                            .'|action(?'
                                .'|logall(*:312)'
                                .'|/([^/]++)(*:329)'
                            .')'
                            .'|new/([^/]++)(*:350)'
                            .'|([^/]++)(?'
                                .'|(*:369)'
                            .')'
                        .')'
                    .')'
                .')'
                .'|/c(?'
                    .'|a(?'
                        .'|nal/([^/]++)(?'
                            .'|(*:405)'
                            .'|/edit(*:418)'
                            .'|(*:426)'
                        .')'
                        .'|rte/visite/([^/]++)(?'
                            .'|(*:457)'
                            .'|/edit(*:470)'
                            .'|(*:478)'
                        .')'
                    .')'
                    .'|o(?'
                        .'|mptes/(?'
                            .'|new/([^/]++)(*:513)'
                            .'|compte/([^/]++)(*:536)'
                            .'|([^/]++)(?'
                                .'|(*:555)'
                                .'|/edit(*:568)'
                                .'|(*:576)'
                            .')'
                            .'|newprospectionlog(*:602)'
                            .'|doccompte/([^/]++)(*:628)'
                        .')'
                        .'|ntact/(?'
                            .'|amdie/site(?:/([^/]++))?(*:670)'
                            .'|DataContacts/([^/]++)(*:699)'
                            .'|([^/]++)/(?'
                                .'|show(*:723)'
                                .'|detail(*:737)'
                                .'|carte/visite(*:757)'
                            .')'
                            .'|handleSearch(?:/([^/]++))?(*:792)'
                            .'|compte(?:/([^/]++))?(*:820)'
                            .'|([^/]++)(?'
                                .'|/edit(*:844)'
                                .'|(*:852)'
                            .')'
                            .'|c(?'
                                .'|hange_(?'
                                    .'|part/([^/]++)/([^/]++)(*:896)'
                                    .'|activation/([^/]++)/([^/]++)(*:932)'
                                    .'|exlusif/([^/]++)/([^/]++)(*:965)'
                                .')'
                                .'|artedelete/([^/]++)(*:993)'
                                .'|ontact_a(?'
                                    .'|ctivation(*:1021)'
                                    .'|ttribuer(*:1038)'
                                .')'
                            .')'
                            .'|generate/pdf/([^/]++)(*:1070)'
                            .'|delete_carte(*:1091)'
                            .'|listecompte(*:1111)'
                            .'|res(?'
                                .'|et(?'
                                    .'|data(?'
                                        .'|base(?'
                                            .'|(*:1145)'
                                            .'|c(?'
                                                .'|arte(*:1162)'
                                                .'|ontactdata(*:1181)'
                                            .')'
                                        .')'
                                        .'|comptes(*:1199)'
                                        .'|projets(*:1215)'
                                    .')'
                                    .'|Fonction(*:1233)'
                                    .'|p(?'
                                        .'|rojet(?'
                                            .'|data(*:1258)'
                                            .'|s(*:1268)'
                                        .')'
                                        .'|ayessiege(*:1287)'
                                    .')'
                                    .'|compte(?'
                                        .'|data(*:1310)'
                                        .'|s(*:1320)'
                                    .')'
                                    .'|log(?'
                                        .'|ocompte(*:1343)'
                                        .'|compte(*:1358)'
                                        .'|projets(*:1374)'
                                    .')'
                                    .'|all(?'
                                        .'|co(?'
                                            .'|mptes(*:1400)'
                                            .'|ntacts(*:1415)'
                                        .')'
                                        .'|projets(*:1432)'
                                    .')'
                                    .'|events(*:1448)'
                                    .'|secteurs(*:1465)'
                                    .'|import(*:1480)'
                                    .'|groupe(*:1495)'
                                    .'|role(*:1508)'
                                .')'
                                .'|te(?'
                                    .'|chetat(*:1529)'
                                    .'|user(*:1542)'
                                    .'|sec(*:1554)'
                                .')'
                            .')'
                            .'|updatecom(?'
                                .'|pte(*:1580)'
                                .'|mandes(*:1595)'
                            .')'
                            .'|bulk(?'
                                .'|fonctions(*:1621)'
                                .'|ecosystemefiliere(*:1647)'
                                .'|country(*:1663)'
                                .'|secteur(?'
                                    .'|(*:1682)'
                                    .'|s(*:1692)'
                                .')'
                            .')'
                            .'|savoiretacompte(*:1718)'
                            .'|espagne(*:1734)'
                            .'|allpayes(*:1751)'
                            .'|projetdataconf(*:1774)'
                        .')'
                    .')'
                    .'|hange_(?'
                        .'|s(?'
                            .'|tatu(?'
                                .'|ts/([^/]++)/([^/]++)(*:1825)'
                                .'|s/([^/]++)/([^/]++)(*:1853)'
                            .')'
                            .'|ignalement/([^/]++)/([^/]++)(*:1891)'
                        .')'
                        .'|princibale/([^/]++)/([^/]++)/([^/]++)(*:1938)'
                        .'|gpac/([^/]++)/([^/]++)(*:1969)'
                    .')'
                .')'
                .'|/p(?'
                    .'|a(?'
                        .'|rtenaires/(?'
                            .'|new/([^/]++)(*:2014)'
                            .'|partenaire/([^/]++)(*:2042)'
                            .'|([^/]++)(*:2059)'
                        .')'
                        .'|ys/([^/]++)(?'
                            .'|(*:2083)'
                            .'|/edit(*:2097)'
                            .'|(*:2106)'
                        .')'
                    .')'
                    .'|ro(?'
                        .'|jet(?'
                            .'|/activite/(?'
                                .'|new/([^/]++)(*:2153)'
                                .'|([^/]++)(?'
                                    .'|(*:2173)'
                                    .'|/edit(*:2187)'
                                    .'|(*:2196)'
                                .')'
                            .')'
                            .'|s(?'
                                .'|(?:/([^/]++))?(*:2225)'
                                .'|/(?'
                                    .'|generate/pdf/([^/]++)(*:2259)'
                                    .'|projet(?'
                                        .'|log(?'
                                            .'|all(*:2286)'
                                            .'|filtre(*:2301)'
                                        .')'
                                        .'|/([^/]++)(*:2320)'
                                    .')'
                                    .'|form/([^/]++)(*:2343)'
                                    .'|ajax_projet(*:2363)'
                                    .'|new(?'
                                        .'|_convertion/([^/]++)(*:2398)'
                                        .'|/([^/]++)(*:2416)'
                                    .')'
                                    .'|change_(?'
                                        .'|statuts/([^/]++)/([^/]++)(*:2461)'
                                        .'|gpac/([^/]++)/([^/]++)(*:2492)'
                                    .')'
                                    .'|remplirprovfromregion(*:2523)'
                                    .'|([^/]++)(?'
                                        .'|(*:2543)'
                                    .')'
                                    .'|l(?'
                                        .'|ogmanzana(?'
                                            .'|(*:2569)'
                                            .'|export(*:2584)'
                                            .'|sourcing(*:2601)'
                                        .')'
                                        .'|istecomptesdecision(?'
                                            .'|(*:2633)'
                                            .'|gpac(*:2646)'
                                        .')'
                                    .')'
                                    .'|gpac(?'
                                        .'|sourcing(?'
                                            .'|(*:2675)'
                                            .'|action(*:2690)'
                                        .')'
                                        .'|export(?'
                                            .'|(*:2709)'
                                            .'|action(*:2724)'
                                        .')'
                                        .'|investisseure(?'
                                            .'|(*:2750)'
                                            .'|action(*:2765)'
                                        .')'
                                    .')'
                                    .'|newfromcompte/([^/]++)/([^/]++)(*:2807)'
                                    .'|docprojet/([^/]++)(*:2834)'
                                .')'
                            .')'
                        .')'
                        .'|fil/([^/]++)(?'
                            .'|(*:2861)'
                            .'|/edit(*:2875)'
                            .'|(*:2884)'
                        .')'
                    .')'
                    .'|ermission/([^/]++)(?'
                        .'|(*:2916)'
                        .'|/edit(*:2930)'
                        .'|(*:2939)'
                    .')'
                .')'
                .'|/h(?'
                    .'|andleSearchcompte(?:/([^/]++))?(*:2986)'
                    .'|ello/(?'
                        .'|([^/]++)(?'
                            .'|(*:3014)'
                            .'|/edit(*:3028)'
                            .'|(*:3037)'
                        .')'
                        .'|resetEtat(*:3056)'
                    .')'
                .')'
                .'|/g(?'
                    .'|enerate/pdf/([^/]++)(*:3092)'
                    .'|roupe/([^/]++)(?'
                        .'|(*:3118)'
                        .'|/edit(*:3132)'
                        .'|(*:3141)'
                    .')'
                .')'
                .'|/nouveau_contact/([^/]++)(*:3177)'
                .'|/e(?'
                    .'|tat/compte/([^/]++)(?'
                        .'|(*:3213)'
                        .'|/edit(*:3227)'
                        .'|(*:3236)'
                    .')'
                    .'|vents/(?'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|event(*:3275)'
                                .'|show(*:3288)'
                            .')'
                            .'|(*:3298)'
                        .')'
                        .'|change_activation/([^/]++)/([^/]++)(*:3343)'
                        .'|generate/pdf/([^/]++)(*:3373)'
                        .'|filtre(*:3388)'
                        .'|export(*:3403)'
                        .'|deleteeven/([^/]++)(*:3431)'
                    .')'
                .')'
                .'|/fonction/([^/]++)(?'
                    .'|(*:3463)'
                    .'|/edit(*:3477)'
                    .'|(*:3486)'
                .')'
                .'|/imports/(?'
                    .'|import/([^/]++)(*:3523)'
                    .'|rollback/([^/]++)(*:3549)'
                .')'
                .'|/r(?'
                    .'|e(?'
                        .'|gions/([^/]++)(?'
                            .'|(*:3585)'
                            .'|/edit(*:3599)'
                            .'|(*:3608)'
                        .')'
                        .'|striction/([^/]++)(?'
                            .'|(*:3639)'
                            .'|/edit(*:3653)'
                            .'|(*:3662)'
                        .')'
                    .')'
                    .'|ole/([^/]++)(?'
                        .'|(*:3688)'
                        .'|/edit(*:3702)'
                        .'|(*:3711)'
                    .')'
                .')'
                .'|/secteur/([^/]++)(?'
                    .'|(*:3742)'
                    .'|/edit(*:3756)'
                    .'|(*:3765)'
                .')'
                .'|/type/compte/([^/]++)(?'
                    .'|(*:3799)'
                    .'|/edit(*:3813)'
                    .'|(*:3822)'
                .')'
                .'|/user/(?'
                    .'|([^/]++)(?'
                        .'|(*:3852)'
                        .'|/(?'
                            .'|edit(*:3869)'
                            .'|delete(*:3884)'
                        .')'
                    .')'
                    .'|handle_search_users(?:/([^/]++))?(*:3928)'
                    .'|([^/]++)/profile(*:3953)'
                .')'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        198 => [[['_route' => 'projets_edit', '_controller' => 'App\\Controller\\Api\\ContactApiController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        225 => [[['_route' => 'ajax_compte', '_controller' => 'App\\Controller\\CompteController::getCompte'], ['compte'], ['GET' => 0], null, false, true, null]],
        256 => [[['_route' => 'actions_index', 'id' => null, '_controller' => 'App\\Controller\\PartenairesActionController::index'], ['id'], ['GET' => 0], null, false, true, null]],
        289 => [[['_route' => 'actions_pdf', '_controller' => 'App\\Controller\\PartenairesActionController::generatePdf'], ['id'], ['GET' => 0], null, false, true, null]],
        312 => [[['_route' => 'actions_log_filtre_all', '_controller' => 'App\\Controller\\PartenairesActionController::projetlogfiltreall'], [], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        329 => [[['_route' => 'actions_detail', '_controller' => 'App\\Controller\\PartenairesActionController::detail_action'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        350 => [[['_route' => 'actions_new', '_controller' => 'App\\Controller\\PartenairesActionController::new'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        369 => [
            [['_route' => 'actions_show', '_controller' => 'App\\Controller\\PartenairesActionController::show'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null],
            [['_route' => 'actions_delete', '_controller' => 'App\\Controller\\PartenairesActionController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        405 => [[['_route' => 'canal_show', '_controller' => 'App\\Controller\\CanalController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        418 => [[['_route' => 'canal_edit', '_controller' => 'App\\Controller\\CanalController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        426 => [[['_route' => 'canal_delete', '_controller' => 'App\\Controller\\CanalController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        457 => [[['_route' => 'carte_visite_show', '_controller' => 'App\\Controller\\CarteVisiteController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        470 => [[['_route' => 'carte_visite_edit', '_controller' => 'App\\Controller\\CarteVisiteController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        478 => [[['_route' => 'carte_visite_delete', '_controller' => 'App\\Controller\\CarteVisiteController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        513 => [[['_route' => 'compte_new', '_controller' => 'App\\Controller\\CompteController::new'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        536 => [[['_route' => 'compte_detail', '_controller' => 'App\\Controller\\CompteController::compte'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        555 => [[['_route' => 'compte_show', '_controller' => 'App\\Controller\\CompteController::show'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        568 => [[['_route' => 'compte_edit', '_controller' => 'App\\Controller\\CompteController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        576 => [[['_route' => 'compte_delete', '_controller' => 'App\\Controller\\CompteController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        602 => [[['_route' => 'log_compteprospection', '_controller' => 'App\\Controller\\CompteController::log_compte_prospection_'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        628 => [[['_route' => 'delete_doc_compte', '_controller' => 'App\\Controller\\CompteController::deletecv'], ['id'], ['GET' => 0], null, false, true, null]],
        670 => [[['_route' => 'contact_site_amdie', 'id' => null, '_controller' => 'App\\Controller\\ContactController::site'], ['id'], ['GET' => 0], null, false, true, null]],
        699 => [[['_route' => 'contacts_data', '_controller' => 'App\\Controller\\ContactController::dataContacts'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        723 => [[['_route' => 'contact_show', '_controller' => 'App\\Controller\\ContactController::show'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        737 => [[['_route' => 'contact_detail', '_controller' => 'App\\Controller\\ContactController::detail'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        757 => [[['_route' => 'new_carte_visite', '_controller' => 'App\\Controller\\ContactController::newCarteVisite'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        792 => [[['_route' => 'handle_search', '_query' => null, '_controller' => 'App\\Controller\\ContactController::handleSearchRequest'], ['_query'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        820 => [[['_route' => 'compte_page', 'id' => null, '_controller' => 'App\\Controller\\ContactController::compteSingle'], ['id'], ['GET' => 0], null, false, true, null]],
        844 => [[['_route' => 'contact_edit', '_controller' => 'App\\Controller\\ContactController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        852 => [[['_route' => 'contact_delete', '_controller' => 'App\\Controller\\ContactController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        896 => [[['_route' => 'contact_change_part', '_controller' => 'App\\Controller\\ContactController::changepart'], ['ispart', 'contact'], ['GET' => 0], null, false, true, null]],
        932 => [[['_route' => 'contact_change_activation', '_controller' => 'App\\Controller\\ContactController::changeactivation'], ['isactive', 'contact'], ['GET' => 0], null, false, true, null]],
        965 => [[['_route' => 'contact_change_exlusif', '_controller' => 'App\\Controller\\ContactController::changeexlusif'], ['isexlusif', 'contact'], ['GET' => 0], null, false, true, null]],
        993 => [[['_route' => 'delete_carte_visite', '_controller' => 'App\\Controller\\ContactController::deletecv'], ['id'], ['GET' => 0], null, false, true, null]],
        1021 => [[['_route' => 'contact_activation', '_controller' => 'App\\Controller\\ContactController::contactactivation'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        1038 => [[['_route' => 'contact_attribuer', '_controller' => 'App\\Controller\\ContactController::contactattribuer'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        1070 => [[['_route' => 'contact_pdf', '_controller' => 'App\\Controller\\ContactController::generatePdf'], ['id'], ['GET' => 0], null, false, true, null]],
        1091 => [[['_route' => 'carte_activation', '_controller' => 'App\\Controller\\ContactController::changecarte'], [], ['POST' => 0], null, true, false, null]],
        1111 => [[['_route' => 'liste_compte', '_controller' => 'App\\Controller\\ContactController::listecompte'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        1145 => [[['_route' => 'app_contact_resetdatabase', '_controller' => 'App\\Controller\\ContactController::resetDatabase'], [], null, null, false, false, null]],
        1162 => [[['_route' => 'app_contact_resetdatabasecartevisite', '_controller' => 'App\\Controller\\ContactController::resetDatabaseCarteVisite'], [], null, null, false, false, null]],
        1181 => [[['_route' => 'app_contact_resetdatabasecontactdata', '_controller' => 'App\\Controller\\ContactController::resetDatabaseContactData'], [], null, null, false, false, null]],
        1199 => [[['_route' => 'app_contact_resetdatacomptes', '_controller' => 'App\\Controller\\ContactController::resetdatacomptes'], [], null, null, false, false, null]],
        1215 => [[['_route' => 'app_contact_resetdataprojets', '_controller' => 'App\\Controller\\ContactController::resetdataprojets'], [], null, null, false, false, null]],
        1233 => [[['_route' => 'app_contact_resetfonction', '_controller' => 'App\\Controller\\ContactController::resetFonction'], [], null, null, false, false, null]],
        1258 => [[['_route' => 'app_contact_resetprojetdata', '_controller' => 'App\\Controller\\ContactController::resetprojetdata'], [], null, null, false, false, null]],
        1268 => [[['_route' => 'app_contact_resetprojets', '_controller' => 'App\\Controller\\ContactController::resetprojets'], [], null, null, false, false, null]],
        1287 => [[['_route' => 'app_contact_resetpayessiege', '_controller' => 'App\\Controller\\ContactController::resetpayessiege'], [], null, null, false, false, null]],
        1310 => [[['_route' => 'app_contact_resetcomptedata', '_controller' => 'App\\Controller\\ContactController::resetcomptedata'], [], null, null, false, false, null]],
        1320 => [[['_route' => 'app_contact_resetcomptes', '_controller' => 'App\\Controller\\ContactController::resetcomptes'], [], null, null, false, false, null]],
        1343 => [[['_route' => 'app_contact_resetlogocompte', '_controller' => 'App\\Controller\\ContactController::resetlogocompte'], [], null, null, false, false, null]],
        1358 => [[['_route' => 'app_contact_resetlogcompte', '_controller' => 'App\\Controller\\ContactController::resetlogcompte'], [], null, null, false, false, null]],
        1374 => [[['_route' => 'app_contact_resetlogprojets', '_controller' => 'App\\Controller\\ContactController::resetlogprojets'], [], null, null, false, false, null]],
        1400 => [[['_route' => 'app_contact_resetallcomptes', '_controller' => 'App\\Controller\\ContactController::resetallcomptes'], [], null, null, false, false, null]],
        1415 => [[['_route' => 'app_contact_resetallcontact', '_controller' => 'App\\Controller\\ContactController::resetallcontact'], [], null, null, false, false, null]],
        1432 => [[['_route' => 'app_contact_resetallprojets', '_controller' => 'App\\Controller\\ContactController::resetallprojets'], [], null, null, false, false, null]],
        1448 => [[['_route' => 'app_contact_resetallevents', '_controller' => 'App\\Controller\\ContactController::resetallevents'], [], null, null, false, false, null]],
        1465 => [[['_route' => 'app_contact_resetsecteurs', '_controller' => 'App\\Controller\\ContactController::resetsecteurs'], [], null, null, false, false, null]],
        1480 => [[['_route' => 'app_contact_resetimport', '_controller' => 'App\\Controller\\ContactController::resetimport'], [], null, null, false, false, null]],
        1495 => [[['_route' => 'app_contact_resetgroupe', '_controller' => 'App\\Controller\\ContactController::resetgroupe'], [], null, null, false, false, null]],
        1508 => [[['_route' => 'app_contact_resetrole', '_controller' => 'App\\Controller\\ContactController::resetrole'], [], null, null, false, false, null]],
        1529 => [[['_route' => 'app_contact_restechetat', '_controller' => 'App\\Controller\\ContactController::restechetat'], [], null, null, false, false, null]],
        1542 => [[['_route' => 'app_contact_resteuser', '_controller' => 'App\\Controller\\ContactController::resteuser'], [], null, null, false, false, null]],
        1554 => [[['_route' => 'app_contact_restesec', '_controller' => 'App\\Controller\\ContactController::restesec'], [], null, null, false, false, null]],
        1580 => [[['_route' => 'app_contact_updatecompte', '_controller' => 'App\\Controller\\ContactController::updatecompte'], [], null, null, false, false, null]],
        1595 => [[['_route' => 'app_contact_updatecommandes', '_controller' => 'App\\Controller\\ContactController::updatecommandes'], [], null, null, false, false, null]],
        1621 => [[['_route' => 'app_contact_bulkfonctions', '_controller' => 'App\\Controller\\ContactController::bulkfonctions'], [], null, null, false, false, null]],
        1647 => [[['_route' => 'app_contact_bulkecosystemefiliere', '_controller' => 'App\\Controller\\ContactController::bulkecosystemefiliere'], [], null, null, false, false, null]],
        1663 => [[['_route' => 'app_contact_bulkcountry', '_controller' => 'App\\Controller\\ContactController::bulkcountry'], [], null, null, false, false, null]],
        1682 => [[['_route' => 'app_contact_bulksecteur', '_controller' => 'App\\Controller\\ContactController::bulksecteur'], [], ['POST' => 0], null, false, false, null]],
        1692 => [[['_route' => 'app_contact_bulksecteurs', '_controller' => 'App\\Controller\\ContactController::bulksecteurs'], [], null, null, false, false, null]],
        1718 => [[['_route' => 'app_contact_savoiretacompte', '_controller' => 'App\\Controller\\ContactController::savoiretacompte'], [], null, null, false, false, null]],
        1734 => [[['_route' => 'app_contact_espagne', '_controller' => 'App\\Controller\\ContactController::espagne'], [], null, null, false, false, null]],
        1751 => [[['_route' => 'app_contact_allpayes', '_controller' => 'App\\Controller\\ContactController::allpayes'], [], null, null, false, false, null]],
        1774 => [[['_route' => 'app_contact_projetdataconf', '_controller' => 'App\\Controller\\ContactController::projetdataconf'], [], null, null, false, false, null]],
        1825 => [[['_route' => 'compte_change_status', '_controller' => 'App\\Controller\\CompteController::switchWorkflow'], ['status', 'compte'], ['GET' => 0], null, false, true, null]],
        1853 => [[['_route' => 'compte_change_status_cp', '_controller' => 'App\\Controller\\CompteController::changestatuscompte'], ['status', 'compte'], ['GET' => 0], null, false, true, null]],
        1891 => [[['_route' => 'compte_change_signalement', '_controller' => 'App\\Controller\\CompteController::changesignal'], ['signal', 'compte'], ['GET' => 0], null, false, true, null]],
        1938 => [[['_route' => 'change_princibale', '_controller' => 'App\\Controller\\CompteController::changeprince'], ['isprin', 'contact', 'compte'], ['GET' => 0], null, false, true, null]],
        1969 => [[['_route' => 'compte_change_gpac', '_controller' => 'App\\Controller\\CompteController::changegpac'], ['isgpac', 'compte'], ['GET' => 0], null, false, true, null]],
        2014 => [[['_route' => 'part_new', '_controller' => 'App\\Controller\\CompteController::newpartenaire'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        2042 => [[['_route' => 'partenaire_detail', '_controller' => 'App\\Controller\\CompteController::partenaire'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        2059 => [[['_route' => 'partenaires_delete', '_controller' => 'App\\Controller\\CompteController::delete_partenaires'], ['id'], ['DELETE' => 0], null, false, true, null]],
        2083 => [[['_route' => 'pays_show', '_controller' => 'App\\Controller\\PaysController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2097 => [[['_route' => 'pays_edit', '_controller' => 'App\\Controller\\PaysController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2106 => [[['_route' => 'pays_delete', '_controller' => 'App\\Controller\\PaysController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        2153 => [[['_route' => 'log_projet_new', '_controller' => 'App\\Controller\\LogProjetController::new'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        2173 => [[['_route' => 'log_projet_show', '_controller' => 'App\\Controller\\LogProjetController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2187 => [[['_route' => 'log_projet_edit', '_controller' => 'App\\Controller\\LogProjetController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2196 => [[['_route' => 'log_projet_delete', '_controller' => 'App\\Controller\\LogProjetController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        2225 => [[['_route' => 'projets_index', 'id' => null, '_controller' => 'App\\Controller\\ProjetsController::index'], ['id'], ['GET' => 0], null, false, true, null]],
        2259 => [[['_route' => 'projets_pdf', '_controller' => 'App\\Controller\\ProjetsController::generatePdf'], ['id'], ['GET' => 0], null, false, true, null]],
        2286 => [[['_route' => 'projet_log_filtre_all', '_controller' => 'App\\Controller\\ProjetsController::projetlogfiltreall'], [], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2301 => [[['_route' => 'projet_log_filtre', '_controller' => 'App\\Controller\\ProjetsController::projetlogfiltre'], [], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2320 => [[['_route' => 'projets_detail', '_controller' => 'App\\Controller\\ProjetsController::detail_projet'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        2343 => [[['_route' => 'projets_form', '_controller' => 'App\\Controller\\ProjetsController::form'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        2363 => [[['_route' => 'ajax_projet', '_controller' => 'App\\Controller\\ProjetsController::ajaxListsProjet'], [], ['GET' => 0], null, false, false, null]],
        2398 => [[['_route' => 'projets_new_convertion', '_controller' => 'App\\Controller\\ProjetsController::newHistorique'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        2416 => [[['_route' => 'projets_new', '_controller' => 'App\\Controller\\ProjetsController::new'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        2461 => [[['_route' => 'projet_change_status', '_controller' => 'App\\Controller\\ProjetsController::switchWorkflow'], ['status', 'projet'], ['GET' => 0], null, false, true, null]],
        2492 => [[['_route' => 'projet_change_gpac', '_controller' => 'App\\Controller\\ProjetsController::changegpac'], ['isgpac', 'projet'], ['GET' => 0], null, false, true, null]],
        2523 => [[['_route' => 'remplir_province_from_region', '_controller' => 'App\\Controller\\ProjetsController::remplirProvinceFromRegion'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        2543 => [
            [['_route' => 'projets_show', '_controller' => 'App\\Controller\\ProjetsController::show'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null],
            [['_route' => 'projets_delete', '_controller' => 'App\\Controller\\ProjetsController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        2569 => [[['_route' => 'log_manzana', '_controller' => 'App\\Controller\\ProjetsController::log_manzana'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        2584 => [[['_route' => 'log_manzanaexport', '_controller' => 'App\\Controller\\ProjetsController::log_manzanaexport'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        2601 => [[['_route' => 'log_manzanasourcing', '_controller' => 'App\\Controller\\ProjetsController::log_manzanasour'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        2633 => [[['_route' => 'liste_comptes_decision', '_controller' => 'App\\Controller\\ProjetsController::listecomptes'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        2646 => [[['_route' => 'liste_comptes_decisiongpac', '_controller' => 'App\\Controller\\ProjetsController::listecomptesgpac'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        2675 => [[['_route' => 'gpac_sourcing', '_controller' => 'App\\Controller\\ProjetsController::gpac_sourcing'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        2690 => [[['_route' => 'gpac_sourcing_action', '_controller' => 'App\\Controller\\ProjetsController::gpac_sourcing_action'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        2709 => [[['_route' => 'gpac_export', '_controller' => 'App\\Controller\\ProjetsController::gpac_export'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        2724 => [[['_route' => 'gpac_export_action', '_controller' => 'App\\Controller\\ProjetsController::gpac_export_action'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        2750 => [[['_route' => 'gpac_investisseure', '_controller' => 'App\\Controller\\ProjetsController::gpac_investisseure'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        2765 => [[['_route' => 'gpac_investisseure_action', '_controller' => 'App\\Controller\\ProjetsController::gpac_investisseure_action'], [], ['GET' => 0, 'POST' => 1], null, true, false, null]],
        2807 => [[['_route' => 'projets_new_from_compte', '_controller' => 'App\\Controller\\ProjetsController::NewFromCompte'], ['id', 'compte'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        2834 => [[['_route' => 'delete_doc_projet', '_controller' => 'App\\Controller\\ProjetsController::deletecv'], ['id'], ['GET' => 0], null, false, true, null]],
        2861 => [[['_route' => 'profils_show', '_controller' => 'App\\Controller\\ProfilsController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2875 => [[['_route' => 'profils_edit', '_controller' => 'App\\Controller\\ProfilsController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2884 => [[['_route' => 'profils_delete', '_controller' => 'App\\Controller\\ProfilsController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        2916 => [[['_route' => 'permission_show', '_controller' => 'App\\Controller\\PermissionController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2930 => [[['_route' => 'permission_edit', '_controller' => 'App\\Controller\\PermissionController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2939 => [[['_route' => 'permission_delete', '_controller' => 'App\\Controller\\PermissionController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        2986 => [[['_route' => 'handle_search_compte', '_query' => null, '_controller' => 'App\\Controller\\CompteController::handleSearchRequest'], ['_query'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        3014 => [[['_route' => 'type_projet_show', '_controller' => 'App\\Controller\\TypeProjetController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        3028 => [[['_route' => 'type_projet_edit', '_controller' => 'App\\Controller\\TypeProjetController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3037 => [[['_route' => 'type_projet_delete', '_controller' => 'App\\Controller\\TypeProjetController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        3056 => [[['_route' => 'type_projet_hello', '_controller' => 'App\\Controller\\TypeProjetController::resetDatabaseprofilr'], [], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3092 => [[['_route' => 'compte_pdf', '_controller' => 'App\\Controller\\CompteController::generatePdf'], ['id'], ['GET' => 0], null, false, true, null]],
        3118 => [[['_route' => 'groupe_show', '_controller' => 'App\\Controller\\GroupeController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        3132 => [[['_route' => 'groupe_edit', '_controller' => 'App\\Controller\\GroupeController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3141 => [[['_route' => 'groupe_delete', '_controller' => 'App\\Controller\\GroupeController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        3177 => [[['_route' => 'nouveau_contact_compte', '_controller' => 'App\\Controller\\CompteController::NouveauContactCompte'], ['compte'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        3213 => [[['_route' => 'etat_compte_show', '_controller' => 'App\\Controller\\EtatCompteController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        3227 => [[['_route' => 'etat_compte_edit', '_controller' => 'App\\Controller\\EtatCompteController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3236 => [[['_route' => 'etat_compte_delete', '_controller' => 'App\\Controller\\EtatCompteController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        3275 => [[['_route' => 'events_detail', '_controller' => 'App\\Controller\\EventController::detaileve'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3288 => [[['_route' => 'event_show', '_controller' => 'App\\Controller\\EventController::showevent'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3298 => [[['_route' => 'event_delete', '_controller' => 'App\\Controller\\EventController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        3343 => [[['_route' => 'event_change_activation', '_controller' => 'App\\Controller\\EventController::changeactivation'], ['isactive', 'event'], ['GET' => 0], null, false, true, null]],
        3373 => [[['_route' => 'event_pdf', '_controller' => 'App\\Controller\\EventController::generatePdf'], ['id'], ['GET' => 0], null, false, true, null]],
        3388 => [[['_route' => 'event_filtre', '_controller' => 'App\\Controller\\EventController::filtre'], [], ['GET' => 0], null, false, false, null]],
        3403 => [[['_route' => 'events_export', '_controller' => 'App\\Controller\\EventController::exporttoexcel'], [], ['GET' => 0], null, false, false, null]],
        3431 => [[['_route' => 'delete_event_attache', '_controller' => 'App\\Controller\\EventController::deletecv'], ['id'], ['GET' => 0], null, false, true, null]],
        3463 => [[['_route' => 'fonction_show', '_controller' => 'App\\Controller\\FonctionController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        3477 => [[['_route' => 'fonction_edit', '_controller' => 'App\\Controller\\FonctionController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3486 => [[['_route' => 'fonction_delete', '_controller' => 'App\\Controller\\FonctionController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        3523 => [[['_route' => 'import_detail', '_controller' => 'App\\Controller\\ImportsController::detail'], ['id'], null, null, false, true, null]],
        3549 => [[['_route' => 'import_rollback', '_controller' => 'App\\Controller\\ImportsController::rollback'], ['id'], null, null, false, true, null]],
        3585 => [[['_route' => 'regions_show', '_controller' => 'App\\Controller\\RegionsController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        3599 => [[['_route' => 'regions_edit', '_controller' => 'App\\Controller\\RegionsController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3608 => [[['_route' => 'regions_delete', '_controller' => 'App\\Controller\\RegionsController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        3639 => [[['_route' => 'restriction_show', '_controller' => 'App\\Controller\\RestrictionController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        3653 => [[['_route' => 'restriction_edit', '_controller' => 'App\\Controller\\RestrictionController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3662 => [[['_route' => 'restriction_delete', '_controller' => 'App\\Controller\\RestrictionController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        3688 => [[['_route' => 'role_show', '_controller' => 'App\\Controller\\RoleController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        3702 => [[['_route' => 'role_edit', '_controller' => 'App\\Controller\\RoleController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3711 => [[['_route' => 'role_delete', '_controller' => 'App\\Controller\\RoleController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        3742 => [[['_route' => 'secteur_show', '_controller' => 'App\\Controller\\SecteurController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        3756 => [[['_route' => 'secteur_edit', '_controller' => 'App\\Controller\\SecteurController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3765 => [[['_route' => 'secteur_delete', '_controller' => 'App\\Controller\\SecteurController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        3799 => [[['_route' => 'type_compte_show', '_controller' => 'App\\Controller\\TypeCompteController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        3813 => [[['_route' => 'type_compte_edit', '_controller' => 'App\\Controller\\TypeCompteController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3822 => [[['_route' => 'type_compte_delete', '_controller' => 'App\\Controller\\TypeCompteController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        3852 => [[['_route' => 'user_show', '_controller' => 'App\\Controller\\UserController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        3869 => [[['_route' => 'user_edit', '_controller' => 'App\\Controller\\UserController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        3884 => [[['_route' => 'user_delete', '_controller' => 'App\\Controller\\UserController::delete'], ['id'], ['DELETE' => 0], null, false, false, null]],
        3928 => [[['_route' => 'handle_search_users', '_query' => null, '_controller' => 'App\\Controller\\UserController::handleSearchRequest'], ['_query'], ['POST' => 0, 'GET' => 1], null, false, true, null]],
        3953 => [
            [['_route' => 'user_edit_profile', '_controller' => 'App\\Controller\\UserController::profile'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
