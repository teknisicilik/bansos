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
$rw_delete = new rw_delete();

// Run the page
$rw_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rw_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frwdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	frwdelete = currentForm = new ew.Form("frwdelete", "delete");
	loadjs.done("frwdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rw_delete->showPageHeader(); ?>
<?php
$rw_delete->showMessage();
?>
<form name="frwdelete" id="frwdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rw">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($rw_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($rw_delete->id->Visible) { // id ?>
		<th class="<?php echo $rw_delete->id->headerCellClass() ?>"><span id="elh_rw_id" class="rw_id"><?php echo $rw_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($rw_delete->desa_id->Visible) { // desa_id ?>
		<th class="<?php echo $rw_delete->desa_id->headerCellClass() ?>"><span id="elh_rw_desa_id" class="rw_desa_id"><?php echo $rw_delete->desa_id->caption() ?></span></th>
<?php } ?>
<?php if ($rw_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $rw_delete->nama->headerCellClass() ?>"><span id="elh_rw_nama" class="rw_nama"><?php echo $rw_delete->nama->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$rw_delete->RecordCount = 0;
$i = 0;
while (!$rw_delete->Recordset->EOF) {
	$rw_delete->RecordCount++;
	$rw_delete->RowCount++;

	// Set row properties
	$rw->resetAttributes();
	$rw->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$rw_delete->loadRowValues($rw_delete->Recordset);

	// Render row
	$rw_delete->renderRow();
?>
	<tr <?php echo $rw->rowAttributes() ?>>
<?php if ($rw_delete->id->Visible) { // id ?>
		<td <?php echo $rw_delete->id->cellAttributes() ?>>
<span id="el<?php echo $rw_delete->RowCount ?>_rw_id" class="rw_id">
<span<?php echo $rw_delete->id->viewAttributes() ?>><?php echo $rw_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rw_delete->desa_id->Visible) { // desa_id ?>
		<td <?php echo $rw_delete->desa_id->cellAttributes() ?>>
<span id="el<?php echo $rw_delete->RowCount ?>_rw_desa_id" class="rw_desa_id">
<span<?php echo $rw_delete->desa_id->viewAttributes() ?>><?php echo $rw_delete->desa_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rw_delete->nama->Visible) { // nama ?>
		<td <?php echo $rw_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $rw_delete->RowCount ?>_rw_nama" class="rw_nama">
<span<?php echo $rw_delete->nama->viewAttributes() ?>><?php echo $rw_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$rw_delete->Recordset->moveNext();
}
$rw_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rw_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$rw_delete->showPageFooter();
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
$rw_delete->terminate();
?>