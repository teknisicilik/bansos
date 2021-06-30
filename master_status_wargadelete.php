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
$master_status_warga_delete = new master_status_warga_delete();

// Run the page
$master_status_warga_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_status_warga_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmaster_status_wargadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmaster_status_wargadelete = currentForm = new ew.Form("fmaster_status_wargadelete", "delete");
	loadjs.done("fmaster_status_wargadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $master_status_warga_delete->showPageHeader(); ?>
<?php
$master_status_warga_delete->showMessage();
?>
<form name="fmaster_status_wargadelete" id="fmaster_status_wargadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_status_warga">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($master_status_warga_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($master_status_warga_delete->id->Visible) { // id ?>
		<th class="<?php echo $master_status_warga_delete->id->headerCellClass() ?>"><span id="elh_master_status_warga_id" class="master_status_warga_id"><?php echo $master_status_warga_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($master_status_warga_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $master_status_warga_delete->nama->headerCellClass() ?>"><span id="elh_master_status_warga_nama" class="master_status_warga_nama"><?php echo $master_status_warga_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($master_status_warga_delete->na->Visible) { // na ?>
		<th class="<?php echo $master_status_warga_delete->na->headerCellClass() ?>"><span id="elh_master_status_warga_na" class="master_status_warga_na"><?php echo $master_status_warga_delete->na->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$master_status_warga_delete->RecordCount = 0;
$i = 0;
while (!$master_status_warga_delete->Recordset->EOF) {
	$master_status_warga_delete->RecordCount++;
	$master_status_warga_delete->RowCount++;

	// Set row properties
	$master_status_warga->resetAttributes();
	$master_status_warga->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$master_status_warga_delete->loadRowValues($master_status_warga_delete->Recordset);

	// Render row
	$master_status_warga_delete->renderRow();
?>
	<tr <?php echo $master_status_warga->rowAttributes() ?>>
<?php if ($master_status_warga_delete->id->Visible) { // id ?>
		<td <?php echo $master_status_warga_delete->id->cellAttributes() ?>>
<span id="el<?php echo $master_status_warga_delete->RowCount ?>_master_status_warga_id" class="master_status_warga_id">
<span<?php echo $master_status_warga_delete->id->viewAttributes() ?>><?php echo $master_status_warga_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_status_warga_delete->nama->Visible) { // nama ?>
		<td <?php echo $master_status_warga_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $master_status_warga_delete->RowCount ?>_master_status_warga_nama" class="master_status_warga_nama">
<span<?php echo $master_status_warga_delete->nama->viewAttributes() ?>><?php echo $master_status_warga_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_status_warga_delete->na->Visible) { // na ?>
		<td <?php echo $master_status_warga_delete->na->cellAttributes() ?>>
<span id="el<?php echo $master_status_warga_delete->RowCount ?>_master_status_warga_na" class="master_status_warga_na">
<span<?php echo $master_status_warga_delete->na->viewAttributes() ?>><?php echo $master_status_warga_delete->na->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$master_status_warga_delete->Recordset->moveNext();
}
$master_status_warga_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $master_status_warga_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$master_status_warga_delete->showPageFooter();
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
$master_status_warga_delete->terminate();
?>