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
$kecamatan_view = new kecamatan_view();

// Run the page
$kecamatan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kecamatan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kecamatan_view->isExport()) { ?>
<script>
var fkecamatanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkecamatanview = currentForm = new ew.Form("fkecamatanview", "view");
	loadjs.done("fkecamatanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kecamatan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $kecamatan_view->ExportOptions->render("body") ?>
<?php $kecamatan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $kecamatan_view->showPageHeader(); ?>
<?php
$kecamatan_view->showMessage();
?>
<?php if (!$kecamatan_view->IsModal) { ?>
<?php if (!$kecamatan_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kecamatan_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fkecamatanview" id="fkecamatanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kecamatan">
<input type="hidden" name="modal" value="<?php echo (int)$kecamatan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($kecamatan_view->idkabupaten->Visible) { // idkabupaten ?>
	<tr id="r_idkabupaten">
		<td class="<?php echo $kecamatan_view->TableLeftColumnClass ?>"><span id="elh_kecamatan_idkabupaten"><?php echo $kecamatan_view->idkabupaten->caption() ?></span></td>
		<td data-name="idkabupaten" <?php echo $kecamatan_view->idkabupaten->cellAttributes() ?>>
<span id="el_kecamatan_idkabupaten">
<span<?php echo $kecamatan_view->idkabupaten->viewAttributes() ?>><?php echo $kecamatan_view->idkabupaten->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kecamatan_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $kecamatan_view->TableLeftColumnClass ?>"><span id="elh_kecamatan_nama"><?php echo $kecamatan_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $kecamatan_view->nama->cellAttributes() ?>>
<span id="el_kecamatan_nama">
<span<?php echo $kecamatan_view->nama->viewAttributes() ?>><?php echo $kecamatan_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$kecamatan_view->IsModal) { ?>
<?php if (!$kecamatan_view->isExport()) { ?>
<?php echo $kecamatan_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$kecamatan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kecamatan_view->isExport()) { ?>
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
$kecamatan_view->terminate();
?>