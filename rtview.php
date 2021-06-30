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
$rt_view = new rt_view();

// Run the page
$rt_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rt_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rt_view->isExport()) { ?>
<script>
var frtview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	frtview = currentForm = new ew.Form("frtview", "view");
	loadjs.done("frtview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$rt_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $rt_view->ExportOptions->render("body") ?>
<?php $rt_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $rt_view->showPageHeader(); ?>
<?php
$rt_view->showMessage();
?>
<?php if (!$rt_view->IsModal) { ?>
<?php if (!$rt_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rt_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="frtview" id="frtview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rt">
<input type="hidden" name="modal" value="<?php echo (int)$rt_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($rt_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $rt_view->TableLeftColumnClass ?>"><span id="elh_rt_id"><?php echo $rt_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $rt_view->id->cellAttributes() ?>>
<span id="el_rt_id">
<span<?php echo $rt_view->id->viewAttributes() ?>><?php echo $rt_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rt_view->rw_id->Visible) { // rw_id ?>
	<tr id="r_rw_id">
		<td class="<?php echo $rt_view->TableLeftColumnClass ?>"><span id="elh_rt_rw_id"><?php echo $rt_view->rw_id->caption() ?></span></td>
		<td data-name="rw_id" <?php echo $rt_view->rw_id->cellAttributes() ?>>
<span id="el_rt_rw_id">
<span<?php echo $rt_view->rw_id->viewAttributes() ?>><?php echo $rt_view->rw_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rt_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $rt_view->TableLeftColumnClass ?>"><span id="elh_rt_nama"><?php echo $rt_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $rt_view->nama->cellAttributes() ?>>
<span id="el_rt_nama">
<span<?php echo $rt_view->nama->viewAttributes() ?>><?php echo $rt_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$rt_view->IsModal) { ?>
<?php if (!$rt_view->isExport()) { ?>
<?php echo $rt_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$rt_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rt_view->isExport()) { ?>
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
$rt_view->terminate();
?>