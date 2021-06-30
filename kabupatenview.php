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
$kabupaten_view = new kabupaten_view();

// Run the page
$kabupaten_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kabupaten_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kabupaten_view->isExport()) { ?>
<script>
var fkabupatenview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkabupatenview = currentForm = new ew.Form("fkabupatenview", "view");
	loadjs.done("fkabupatenview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kabupaten_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $kabupaten_view->ExportOptions->render("body") ?>
<?php $kabupaten_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $kabupaten_view->showPageHeader(); ?>
<?php
$kabupaten_view->showMessage();
?>
<?php if (!$kabupaten_view->IsModal) { ?>
<?php if (!$kabupaten_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kabupaten_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fkabupatenview" id="fkabupatenview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kabupaten">
<input type="hidden" name="modal" value="<?php echo (int)$kabupaten_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($kabupaten_view->provinsi_id->Visible) { // provinsi_id ?>
	<tr id="r_provinsi_id">
		<td class="<?php echo $kabupaten_view->TableLeftColumnClass ?>"><span id="elh_kabupaten_provinsi_id"><?php echo $kabupaten_view->provinsi_id->caption() ?></span></td>
		<td data-name="provinsi_id" <?php echo $kabupaten_view->provinsi_id->cellAttributes() ?>>
<span id="el_kabupaten_provinsi_id">
<span<?php echo $kabupaten_view->provinsi_id->viewAttributes() ?>><?php echo $kabupaten_view->provinsi_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kabupaten_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $kabupaten_view->TableLeftColumnClass ?>"><span id="elh_kabupaten_nama"><?php echo $kabupaten_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $kabupaten_view->nama->cellAttributes() ?>>
<span id="el_kabupaten_nama">
<span<?php echo $kabupaten_view->nama->viewAttributes() ?>><?php echo $kabupaten_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$kabupaten_view->IsModal) { ?>
<?php if (!$kabupaten_view->isExport()) { ?>
<?php echo $kabupaten_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$kabupaten_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kabupaten_view->isExport()) { ?>
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
$kabupaten_view->terminate();
?>