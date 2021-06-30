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
$provinsi_view = new provinsi_view();

// Run the page
$provinsi_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$provinsi_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$provinsi_view->isExport()) { ?>
<script>
var fprovinsiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fprovinsiview = currentForm = new ew.Form("fprovinsiview", "view");
	loadjs.done("fprovinsiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$provinsi_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $provinsi_view->ExportOptions->render("body") ?>
<?php $provinsi_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $provinsi_view->showPageHeader(); ?>
<?php
$provinsi_view->showMessage();
?>
<?php if (!$provinsi_view->IsModal) { ?>
<?php if (!$provinsi_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $provinsi_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fprovinsiview" id="fprovinsiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="provinsi">
<input type="hidden" name="modal" value="<?php echo (int)$provinsi_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($provinsi_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $provinsi_view->TableLeftColumnClass ?>"><span id="elh_provinsi_nama"><?php echo $provinsi_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $provinsi_view->nama->cellAttributes() ?>>
<span id="el_provinsi_nama">
<span<?php echo $provinsi_view->nama->viewAttributes() ?>><?php echo $provinsi_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$provinsi_view->IsModal) { ?>
<?php if (!$provinsi_view->isExport()) { ?>
<?php echo $provinsi_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$provinsi_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$provinsi_view->isExport()) { ?>
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
$provinsi_view->terminate();
?>