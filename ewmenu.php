<?php
namespace PHPMaker2020\bansos;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
$topMenu->addMenuItem(11, "mi_cari_bantuan", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "cari_bantuan.php", -1, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}cari_bantuan.php'), FALSE, FALSE, "fa fa-search", "", TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(11, "mi_cari_bantuan", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "cari_bantuan.php", -1, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}cari_bantuan.php'), FALSE, FALSE, "fa fa-search", "", TRUE);
$sideMenu->addMenuItem(35, "mi_Crosstab2", $MenuLanguage->MenuPhrase("35", "MenuText"), $MenuRelativePath . "Crosstab2ctb.php", -1, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}Crosstab2'), FALSE, FALSE, "fa fa-line-chart", "", FALSE);
$sideMenu->addMenuItem(34, "mi_rekap_bantuan2", $MenuLanguage->MenuPhrase("34", "MenuText"), $MenuRelativePath . "rekap_bantuan2list.php", -1, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}rekap_bantuan2'), FALSE, FALSE, "fa fa-bar-chart", "", FALSE);
$sideMenu->addMenuItem(2, "mi_bantuan", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "bantuanlist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}bantuan'), FALSE, FALSE, "fa fa-handshake-o", "", FALSE);
$sideMenu->addMenuItem(4, "mi_master_warga", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "master_wargalist.php", -1, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}master_warga'), FALSE, FALSE, "fa fa-users", "", FALSE);
$sideMenu->addMenuItem(5, "mci_Data_Master", $MenuLanguage->MenuPhrase("5", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(29, "mi_master_sumber_bantuan", $MenuLanguage->MenuPhrase("29", "MenuText"), $MenuRelativePath . "master_sumber_bantuanlist.php", 5, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}master_sumber_bantuan'), FALSE, FALSE, "fa fa-list-ul", "", FALSE);
$sideMenu->addMenuItem(6, "mi_master_jenis_bantuan", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "master_jenis_bantuanlist.php", 5, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}master_jenis_bantuan'), FALSE, FALSE, "fa fa-list-ul", "", FALSE);
$sideMenu->addMenuItem(30, "mi_master_pengambilan_bantuan", $MenuLanguage->MenuPhrase("30", "MenuText"), $MenuRelativePath . "master_pengambilan_bantuanlist.php", 5, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}master_pengambilan_bantuan'), FALSE, FALSE, "fa fa-list-ul", "", FALSE);
$sideMenu->addMenuItem(3, "mi_master_bantuan", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "master_bantuanlist.php", 5, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}master_bantuan'), FALSE, FALSE, "fa fa-table", "", FALSE);
$sideMenu->addMenuItem(31, "mi_master_status_warga", $MenuLanguage->MenuPhrase("31", "MenuText"), $MenuRelativePath . "master_status_wargalist.php", 5, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}master_status_warga'), FALSE, FALSE, "fa fa-list-ul", "", FALSE);
$sideMenu->addMenuItem(25, "mci_Data_Wilayah", $MenuLanguage->MenuPhrase("25", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(13, "mi_kabupaten", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "kabupatenlist.php", 25, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}kabupaten'), FALSE, FALSE, "fa fa-angle-double-right text-warning", "", FALSE);
$sideMenu->addMenuItem(14, "mi_kecamatan", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "kecamatanlist.php", 25, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}kecamatan'), FALSE, FALSE, "fa fa-angle-double-right text-success", "", FALSE);
$sideMenu->addMenuItem(12, "mi_desa", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "desalist.php", 25, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}desa'), FALSE, FALSE, "fa fa-angle-double-right text-info", "", FALSE);
$sideMenu->addMenuItem(17, "mi_rw", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "rwlist.php?cmd=resetall", 25, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}rw'), FALSE, FALSE, "fa fa-angle-double-right text-secondary", "", FALSE);
$sideMenu->addMenuItem(16, "mi_rt", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "rtlist.php?cmd=resetall", 25, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}rt'), FALSE, FALSE, "fa fa-angle-double-right text-primary", "", FALSE);
$sideMenu->addMenuItem(1, "mi_master_alamat", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "master_alamatlist.php", 25, "", IsLoggedIn() || AllowListMenu('{43B9593C-AF46-4926-9D51-8DAD45DAA7A2}master_alamat'), FALSE, FALSE, "fa fa-angle-double-right text-indigo", "", FALSE);
echo $sideMenu->toScript();
?>