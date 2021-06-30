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
$desa_view = new desa_view();

// Run the page
$desa_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$desa_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$desa_view->isExport()) { ?>
<script>
var fdesaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdesaview = currentForm = new ew.Form("fdesaview", "view");
	loadjs.done("fdesaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$desa_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $desa_view->ExportOptions->render("body") ?>
<?php $desa_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $desa_view->showPageHeader(); ?>
<?php
$desa_view->showMessage();
?>
<?php if (!$desa_view->IsModal) { ?>
<?php if (!$desa_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $desa_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdesaview" id="fdesaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="desa">
<input type="hidden" name="modal" value="<?php echo (int)$desa_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($desa_view->kecamatan_id->Visible) { // kecamatan_id ?>
	<tr id="r_kecamatan_id">
		<td class="<?php echo $desa_view->TableLeftColumnClass ?>"><span id="elh_desa_kecamatan_id"><?php echo $desa_view->kecamatan_id->caption() ?></span></td>
		<td data-name="kecamatan_id" <?php echo $desa_view->kecamatan_id->cellAttributes() ?>>
<span id="el_desa_kecamatan_id">
<span<?php echo $desa_view->kecamatan_id->viewAttributes() ?>><?php echo $desa_view->kecamatan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($desa_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $desa_view->TableLeftColumnClass ?>"><span id="elh_desa_nama"><?php echo $desa_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $desa_view->nama->cellAttributes() ?>>
<span id="el_desa_nama">
<span<?php echo $desa_view->nama->viewAttributes() ?>><?php echo $desa_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($desa_view->kodepos->Visible) { // kodepos ?>
	<tr id="r_kodepos">
		<td class="<?php echo $desa_view->TableLeftColumnClass ?>"><span id="elh_desa_kodepos"><?php echo $desa_view->kodepos->caption() ?></span></td>
		<td data-name="kodepos" <?php echo $desa_view->kodepos->cellAttributes() ?>>
<span id="el_desa_kodepos">
<span<?php echo $desa_view->kodepos->viewAttributes() ?>><?php echo $desa_view->kodepos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$desa_view->IsModal) { ?>
<?php if (!$desa_view->isExport()) { ?>
<?php echo $desa_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("rw", explode(",", $desa->getCurrentDetailTable())) && $rw->DetailView) {
?>
<?php if ($desa->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("rw", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "rwgrid.php" ?>
<?php } ?>
</form>
<?php
$desa_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$desa_view->isExport()) { ?>
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
$desa_view->terminate();
?>