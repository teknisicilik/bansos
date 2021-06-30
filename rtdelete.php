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
$rt_delete = new rt_delete();

// Run the page
$rt_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rt_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frtdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	frtdelete = currentForm = new ew.Form("frtdelete", "delete");
	loadjs.done("frtdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rt_delete->showPageHeader(); ?>
<?php
$rt_delete->showMessage();
?>
<form name="frtdelete" id="frtdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rt">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($rt_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($rt_delete->id->Visible) { // id ?>
		<th class="<?php echo $rt_delete->id->headerCellClass() ?>"><span id="elh_rt_id" class="rt_id"><?php echo $rt_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($rt_delete->rw_id->Visible) { // rw_id ?>
		<th class="<?php echo $rt_delete->rw_id->headerCellClass() ?>"><span id="elh_rt_rw_id" class="rt_rw_id"><?php echo $rt_delete->rw_id->caption() ?></span></th>
<?php } ?>
<?php if ($rt_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $rt_delete->nama->headerCellClass() ?>"><span id="elh_rt_nama" class="rt_nama"><?php echo $rt_delete->nama->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$rt_delete->RecordCount = 0;
$i = 0;
while (!$rt_delete->Recordset->EOF) {
	$rt_delete->RecordCount++;
	$rt_delete->RowCount++;

	// Set row properties
	$rt->resetAttributes();
	$rt->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$rt_delete->loadRowValues($rt_delete->Recordset);

	// Render row
	$rt_delete->renderRow();
?>
	<tr <?php echo $rt->rowAttributes() ?>>
<?php if ($rt_delete->id->Visible) { // id ?>
		<td <?php echo $rt_delete->id->cellAttributes() ?>>
<span id="el<?php echo $rt_delete->RowCount ?>_rt_id" class="rt_id">
<span<?php echo $rt_delete->id->viewAttributes() ?>><?php echo $rt_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rt_delete->rw_id->Visible) { // rw_id ?>
		<td <?php echo $rt_delete->rw_id->cellAttributes() ?>>
<span id="el<?php echo $rt_delete->RowCount ?>_rt_rw_id" class="rt_rw_id">
<span<?php echo $rt_delete->rw_id->viewAttributes() ?>><?php echo $rt_delete->rw_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rt_delete->nama->Visible) { // nama ?>
		<td <?php echo $rt_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $rt_delete->RowCount ?>_rt_nama" class="rt_nama">
<span<?php echo $rt_delete->nama->viewAttributes() ?>><?php echo $rt_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$rt_delete->Recordset->moveNext();
}
$rt_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rt_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$rt_delete->showPageFooter();
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
$rt_delete->terminate();
?>