<?php

namespace PHPMaker2023\crudperumdautama;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(43, "mci_Dep._Publikasi", $MenuLanguage->MenuPhrase("43", "MenuText"), "", -1, "", true, false, true, "fa1 fa-newspaper", "", false, true);
$sideMenu->addMenuItem(243, "mci_Jurnalisme", $MenuLanguage->MenuPhrase("243", "MenuText"), "", 43, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(1, "mi_beritas", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "BeritasList", 243, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(18, "mi_kategori_beritas", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "KategoriBeritasList", 243, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(86, "mci_Bidang_Usaha", $MenuLanguage->MenuPhrase("86", "MenuText"), "", 43, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(36, "mi_sectors", $MenuLanguage->MenuPhrase("36", "MenuText"), $MenuRelativePath . "SectorsList", 86, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(34, "mi_sector_categories", $MenuLanguage->MenuPhrase("34", "MenuText"), $MenuRelativePath . "SectorCategoriesList", 86, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(126, "mci_Proyek_dan_Investasi", $MenuLanguage->MenuPhrase("126", "MenuText"), "", 43, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(31, "mi_projects", $MenuLanguage->MenuPhrase("31", "MenuText"), $MenuRelativePath . "ProjectsList", 126, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(203, "mci_Data_Pendukung_Proyek", $MenuLanguage->MenuPhrase("203", "MenuText"), "", 126, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(28, "mi_project_investors", $MenuLanguage->MenuPhrase("28", "MenuText"), $MenuRelativePath . "ProjectInvestorsList?cmd=resetall", 203, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(27, "mi_project_files", $MenuLanguage->MenuPhrase("27", "MenuText"), $MenuRelativePath . "ProjectFilesList?cmd=resetall", 203, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(15, "mi_investors", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "InvestorsList", 203, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(166, "mci_Referensi", $MenuLanguage->MenuPhrase("166", "MenuText"), "", 126, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(26, "mi_project_categories", $MenuLanguage->MenuPhrase("26", "MenuText"), $MenuRelativePath . "ProjectCategoriesList", 166, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(29, "mi_project_providers", $MenuLanguage->MenuPhrase("29", "MenuText"), $MenuRelativePath . "ProjectProvidersList", 166, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(14, "mi_funding_sources", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "FundingSourcesList", 166, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(30, "mi_project_statuses", $MenuLanguage->MenuPhrase("30", "MenuText"), $MenuRelativePath . "ProjectStatusesList", 166, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(127, "mci_Dep._Akuntansi", $MenuLanguage->MenuPhrase("127", "MenuText"), "", -1, "", true, false, true, "fa-solid fa-calculator", "", false, true);
$sideMenu->addMenuItem(292, "mci_SetUp_System", $MenuLanguage->MenuPhrase("292", "MenuText"), "", 127, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(22, "mi_organization", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "OrganizationList", 292, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(6, "mi_departements", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "DepartementsList", 292, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(7, "mi_division", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "DivisionList", 292, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(2, "mi_chart_of_accounts", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "ChartOfAccountsList", 292, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(41, "mi_transaction_type", $MenuLanguage->MenuPhrase("41", "MenuText"), $MenuRelativePath . "TransactionTypeList", 292, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(17, "mi_items_categories", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "ItemsCategoriesList", 292, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(16, "mi_items", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "ItemsList", 292, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(3, "mi_companies", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "CompaniesList", 292, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(4, "mi_contacts", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "ContactsList", 292, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(5, "mi_customers", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "CustomersList", 292, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(293, "mci_Accounting_Proses", $MenuLanguage->MenuPhrase("293", "MenuText"), "", 127, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(40, "mi_transaction", $MenuLanguage->MenuPhrase("40", "MenuText"), $MenuRelativePath . "TransactionList", 293, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(39, "mi_taxes", $MenuLanguage->MenuPhrase("39", "MenuText"), $MenuRelativePath . "TaxesList", 293, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(294, "mci_Dokumen_Transaksi", $MenuLanguage->MenuPhrase("294", "MenuText"), "", 127, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(12, "mi_documents", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "DocumentsList", 294, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(8, "mi_document_histories", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "DocumentHistoriesList", 294, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(10, "mi_document_items", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "DocumentItemsList", 294, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(9, "mi_document_item_taxes", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "DocumentItemTaxesList", 294, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(11, "mi_document_totals", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "DocumentTotalsList", 294, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(340, "mci_Dep._Pemasaran", $MenuLanguage->MenuPhrase("340", "MenuText"), "", -1, "", true, false, true, "<fa-solid fa-shop", "", false, true);
$sideMenu->addMenuItem(38, "mi_sessions", $MenuLanguage->MenuPhrase("38", "MenuText"), $MenuRelativePath . "SessionsList", 340, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(356, "mci_Dep._Operasional", $MenuLanguage->MenuPhrase("356", "MenuText"), "", -1, "", true, false, true, "fa-solid fa-puzzle-piece", "", false, true);
$sideMenu->addMenuItem(19, "mi_migrations", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "MigrationsList", 356, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(325, "mci_Dep.SDM/HRM", $MenuLanguage->MenuPhrase("325", "MenuText"), "", -1, "", true, false, true, "fa-solid fa-people-group", "", false, true);
$sideMenu->addMenuItem(42, "mi_users", $MenuLanguage->MenuPhrase("42", "MenuText"), $MenuRelativePath . "UsersList", 325, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(339, "mci_Dep._IT", $MenuLanguage->MenuPhrase("339", "MenuText"), "", -1, "", true, false, true, "fa-solid fa-desktop", "", false, true);
$sideMenu->addMenuItem(128, "mci_Sys_Admin", $MenuLanguage->MenuPhrase("128", "MenuText"), "", 339, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(13, "mi_failed_jobs", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "FailedJobsList", 128, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(20, "mi_model_has_permissions", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "ModelHasPermissionsList", 128, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(21, "mi_model_has_roles", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "ModelHasRolesList", 128, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(23, "mi_password_reset_tokens", $MenuLanguage->MenuPhrase("23", "MenuText"), $MenuRelativePath . "PasswordResetTokensList", 128, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(24, "mi_permissions2", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "Permissions2List", 128, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(25, "mi_personal_access_tokens", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "PersonalAccessTokensList", 128, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(32, "mi_role_has_permissions", $MenuLanguage->MenuPhrase("32", "MenuText"), $MenuRelativePath . "RoleHasPermissionsList", 128, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(33, "mi_roles", $MenuLanguage->MenuPhrase("33", "MenuText"), $MenuRelativePath . "RolesList", 128, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(37, "mi_services", $MenuLanguage->MenuPhrase("37", "MenuText"), $MenuRelativePath . "ServicesList", -1, "", true, false, false, "", "", false, true);
echo $sideMenu->toScript();
