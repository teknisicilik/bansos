<?php
namespace PHPMaker2020\bansos;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$cari_bantuan = new cari_bantuan();

// Run the page
$cari_bantuan->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
include("custom/cari_bantuan.php");
?>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$cari_bantuan->terminate();
?>