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
$Dashboard1_dashboard = new Dashboard1_dashboard();

// Run the page
$Dashboard1_dashboard->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Dashboard1_dashboard->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdashboard, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "dashboard";
	fdashboard = currentForm = new ew.Form("fdashboard", "dashboard");
	loadjs.done("fdashboard");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<!-- Content Container -->
<div id="ew-report" class="ew-report">
<div class="btn-toolbar ew-toolbar"></div>
<?php $Dashboard1_dashboard->showPageHeader(); ?>
<?php
$Dashboard1_dashboard->showMessage();
?>
<!-- Dashboard Container -->
<div id="ew-dashboard" class="container-fluid ew-dashboard ew-vertical">
<div class="row">
<div class="<?php echo $Dashboard1_dashboard->ItemClassNames[0] ?>">
<div id="Item1" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->chartPhrase("Report1", "chartByKecamatan", "ChartCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$Report1->chartByKecamatan->Width = 0;
$Report1->chartByKecamatan->Height = 0;
$Report1->chartByKecamatan->setParameter("clickurl", "Report1smry.php"); // Add click URL
$Report1->chartByKecamatan->DrillDownUrl = ""; // No drill down for dashboard
$Report1->chartByKecamatan->render("ew-chart-top");
?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="<?php echo $Dashboard1_dashboard->ItemClassNames[1] ?>">
<div id="Item2" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->chartPhrase("Report1", "chartByKelurahan", "ChartCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$Report1->chartByKelurahan->Width = 0;
$Report1->chartByKelurahan->Height = 0;
$Report1->chartByKelurahan->setParameter("clickurl", "Report1smry.php"); // Add click URL
$Report1->chartByKelurahan->DrillDownUrl = ""; // No drill down for dashboard
$Report1->chartByKelurahan->render("ew-chart-top");
?>
</div>
</div>
</div>
</div>
</div>
<!-- /.ew-dashboard -->
</div>
<!-- /.ew-report -->
<?php
$Dashboard1_dashboard->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$Dashboard1_dashboard->terminate();
?>