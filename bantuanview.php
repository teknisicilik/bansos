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
$bantuan_view = new bantuan_view();

// Run the page
$bantuan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bantuan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bantuan_view->isExport()) { ?>
<script>
var fbantuanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fbantuanview = currentForm = new ew.Form("fbantuanview", "view");
	loadjs.done("fbantuanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$bantuan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $bantuan_view->ExportOptions->render("body") ?>
<?php $bantuan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $bantuan_view->showPageHeader(); ?>
<?php
$bantuan_view->showMessage();
?>
<?php if (!$bantuan_view->IsModal) { ?>
<?php if (!$bantuan_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bantuan_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbantuanview" id="fbantuanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bantuan">
<input type="hidden" name="modal" value="<?php echo (int)$bantuan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($bantuan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $bantuan_view->TableLeftColumnClass ?>"><span id="elh_bantuan_id"><?php echo $bantuan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $bantuan_view->id->cellAttributes() ?>>
<span id="el_bantuan_id">
<span<?php echo $bantuan_view->id->viewAttributes() ?>><?php echo $bantuan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bantuan_view->bansos_id->Visible) { // bansos_id ?>
	<tr id="r_bansos_id">
		<td class="<?php echo $bantuan_view->TableLeftColumnClass ?>"><span id="elh_bantuan_bansos_id"><?php echo $bantuan_view->bansos_id->caption() ?></span></td>
		<td data-name="bansos_id" <?php echo $bantuan_view->bansos_id->cellAttributes() ?>>
<span id="el_bantuan_bansos_id">
<span<?php echo $bantuan_view->bansos_id->viewAttributes() ?>><?php echo $bantuan_view->bansos_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bantuan_view->warga_id->Visible) { // warga_id ?>
	<tr id="r_warga_id">
		<td class="<?php echo $bantuan_view->TableLeftColumnClass ?>"><span id="elh_bantuan_warga_id"><?php echo $bantuan_view->warga_id->caption() ?></span></td>
		<td data-name="warga_id" <?php echo $bantuan_view->warga_id->cellAttributes() ?>>
<span id="el_bantuan_warga_id">
<span<?php echo $bantuan_view->warga_id->viewAttributes() ?>><?php echo $bantuan_view->warga_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bantuan_view->na->Visible) { // na ?>
	<tr id="r_na">
		<td class="<?php echo $bantuan_view->TableLeftColumnClass ?>"><span id="elh_bantuan_na"><?php echo $bantuan_view->na->caption() ?></span></td>
		<td data-name="na" <?php echo $bantuan_view->na->cellAttributes() ?>>
<span id="el_bantuan_na">
<span<?php echo $bantuan_view->na->viewAttributes() ?>><?php echo $bantuan_view->na->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$bantuan_view->IsModal) { ?>
<?php if (!$bantuan_view->isExport()) { ?>
<?php echo $bantuan_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$bantuan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bantuan_view->isExport()) { ?>
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
$bantuan_view->terminate();
?>