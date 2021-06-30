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
$rw_view = new rw_view();

// Run the page
$rw_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rw_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rw_view->isExport()) { ?>
<script>
var frwview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	frwview = currentForm = new ew.Form("frwview", "view");
	loadjs.done("frwview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$rw_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $rw_view->ExportOptions->render("body") ?>
<?php $rw_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $rw_view->showPageHeader(); ?>
<?php
$rw_view->showMessage();
?>
<?php if (!$rw_view->IsModal) { ?>
<?php if (!$rw_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rw_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="frwview" id="frwview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rw">
<input type="hidden" name="modal" value="<?php echo (int)$rw_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($rw_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $rw_view->TableLeftColumnClass ?>"><span id="elh_rw_id"><?php echo $rw_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $rw_view->id->cellAttributes() ?>>
<span id="el_rw_id">
<span<?php echo $rw_view->id->viewAttributes() ?>><?php echo $rw_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rw_view->desa_id->Visible) { // desa_id ?>
	<tr id="r_desa_id">
		<td class="<?php echo $rw_view->TableLeftColumnClass ?>"><span id="elh_rw_desa_id"><?php echo $rw_view->desa_id->caption() ?></span></td>
		<td data-name="desa_id" <?php echo $rw_view->desa_id->cellAttributes() ?>>
<span id="el_rw_desa_id">
<span<?php echo $rw_view->desa_id->viewAttributes() ?>><?php echo $rw_view->desa_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rw_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $rw_view->TableLeftColumnClass ?>"><span id="elh_rw_nama"><?php echo $rw_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $rw_view->nama->cellAttributes() ?>>
<span id="el_rw_nama">
<span<?php echo $rw_view->nama->viewAttributes() ?>><?php echo $rw_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$rw_view->IsModal) { ?>
<?php if (!$rw_view->isExport()) { ?>
<?php echo $rw_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("rt", explode(",", $rw->getCurrentDetailTable())) && $rt->DetailView) {
?>
<?php if ($rw->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("rt", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "rtgrid.php" ?>
<?php } ?>
</form>
<?php
$rw_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rw_view->isExport()) { ?>
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
$rw_view->terminate();
?>