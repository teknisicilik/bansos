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
$master_sumber_bantuan_view = new master_sumber_bantuan_view();

// Run the page
$master_sumber_bantuan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_sumber_bantuan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$master_sumber_bantuan_view->isExport()) { ?>
<script>
var fmaster_sumber_bantuanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmaster_sumber_bantuanview = currentForm = new ew.Form("fmaster_sumber_bantuanview", "view");
	loadjs.done("fmaster_sumber_bantuanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$master_sumber_bantuan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $master_sumber_bantuan_view->ExportOptions->render("body") ?>
<?php $master_sumber_bantuan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $master_sumber_bantuan_view->showPageHeader(); ?>
<?php
$master_sumber_bantuan_view->showMessage();
?>
<?php if (!$master_sumber_bantuan_view->IsModal) { ?>
<?php if (!$master_sumber_bantuan_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_sumber_bantuan_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmaster_sumber_bantuanview" id="fmaster_sumber_bantuanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_sumber_bantuan">
<input type="hidden" name="modal" value="<?php echo (int)$master_sumber_bantuan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($master_sumber_bantuan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $master_sumber_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_sumber_bantuan_id"><?php echo $master_sumber_bantuan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $master_sumber_bantuan_view->id->cellAttributes() ?>>
<span id="el_master_sumber_bantuan_id">
<span<?php echo $master_sumber_bantuan_view->id->viewAttributes() ?>><?php echo $master_sumber_bantuan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_sumber_bantuan_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $master_sumber_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_sumber_bantuan_nama"><?php echo $master_sumber_bantuan_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $master_sumber_bantuan_view->nama->cellAttributes() ?>>
<span id="el_master_sumber_bantuan_nama">
<span<?php echo $master_sumber_bantuan_view->nama->viewAttributes() ?>><?php echo $master_sumber_bantuan_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_sumber_bantuan_view->na->Visible) { // na ?>
	<tr id="r_na">
		<td class="<?php echo $master_sumber_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_sumber_bantuan_na"><?php echo $master_sumber_bantuan_view->na->caption() ?></span></td>
		<td data-name="na" <?php echo $master_sumber_bantuan_view->na->cellAttributes() ?>>
<span id="el_master_sumber_bantuan_na">
<span<?php echo $master_sumber_bantuan_view->na->viewAttributes() ?>><?php echo $master_sumber_bantuan_view->na->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$master_sumber_bantuan_view->IsModal) { ?>
<?php if (!$master_sumber_bantuan_view->isExport()) { ?>
<?php echo $master_sumber_bantuan_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$master_sumber_bantuan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$master_sumber_bantuan_view->isExport()) { ?>
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
$master_sumber_bantuan_view->terminate();
?>