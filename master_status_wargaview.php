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
$master_status_warga_view = new master_status_warga_view();

// Run the page
$master_status_warga_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_status_warga_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$master_status_warga_view->isExport()) { ?>
<script>
var fmaster_status_wargaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmaster_status_wargaview = currentForm = new ew.Form("fmaster_status_wargaview", "view");
	loadjs.done("fmaster_status_wargaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$master_status_warga_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $master_status_warga_view->ExportOptions->render("body") ?>
<?php $master_status_warga_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $master_status_warga_view->showPageHeader(); ?>
<?php
$master_status_warga_view->showMessage();
?>
<?php if (!$master_status_warga_view->IsModal) { ?>
<?php if (!$master_status_warga_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_status_warga_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmaster_status_wargaview" id="fmaster_status_wargaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_status_warga">
<input type="hidden" name="modal" value="<?php echo (int)$master_status_warga_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($master_status_warga_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $master_status_warga_view->TableLeftColumnClass ?>"><span id="elh_master_status_warga_id"><?php echo $master_status_warga_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $master_status_warga_view->id->cellAttributes() ?>>
<span id="el_master_status_warga_id">
<span<?php echo $master_status_warga_view->id->viewAttributes() ?>><?php echo $master_status_warga_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_status_warga_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $master_status_warga_view->TableLeftColumnClass ?>"><span id="elh_master_status_warga_nama"><?php echo $master_status_warga_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $master_status_warga_view->nama->cellAttributes() ?>>
<span id="el_master_status_warga_nama">
<span<?php echo $master_status_warga_view->nama->viewAttributes() ?>><?php echo $master_status_warga_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_status_warga_view->na->Visible) { // na ?>
	<tr id="r_na">
		<td class="<?php echo $master_status_warga_view->TableLeftColumnClass ?>"><span id="elh_master_status_warga_na"><?php echo $master_status_warga_view->na->caption() ?></span></td>
		<td data-name="na" <?php echo $master_status_warga_view->na->cellAttributes() ?>>
<span id="el_master_status_warga_na">
<span<?php echo $master_status_warga_view->na->viewAttributes() ?>><?php echo $master_status_warga_view->na->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$master_status_warga_view->IsModal) { ?>
<?php if (!$master_status_warga_view->isExport()) { ?>
<?php echo $master_status_warga_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$master_status_warga_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$master_status_warga_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$master_status_warga_view->terminate();
?>