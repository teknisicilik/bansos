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
$bantuan_delete = new bantuan_delete();

// Run the page
$bantuan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bantuan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbantuandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbantuandelete = currentForm = new ew.Form("fbantuandelete", "delete");
	loadjs.done("fbantuandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bantuan_delete->showPageHeader(); ?>
<?php
$bantuan_delete->showMessage();
?>
<form name="fbantuandelete" id="fbantuandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bantuan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($bantuan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($bantuan_delete->id->Visible) { // id ?>
		<th class="<?php echo $bantuan_delete->id->headerCellClass() ?>"><span id="elh_bantuan_id" class="bantuan_id"><?php echo $bantuan_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($bantuan_delete->bansos_id->Visible) { // bansos_id ?>
		<th class="<?php echo $bantuan_delete->bansos_id->headerCellClass() ?>"><span id="elh_bantuan_bansos_id" class="bantuan_bansos_id"><?php echo $bantuan_delete->bansos_id->caption() ?></span></th>
<?php } ?>
<?php if ($bantuan_delete->warga_id->Visible) { // warga_id ?>
		<th class="<?php echo $bantuan_delete->warga_id->headerCellClass() ?>"><span id="elh_bantuan_warga_id" class="bantuan_warga_id"><?php echo $bantuan_delete->warga_id->caption() ?></span></th>
<?php } ?>
<?php if ($bantuan_delete->na->Visible) { // na ?>
		<th class="<?php echo $bantuan_delete->na->headerCellClass() ?>"><span id="elh_bantuan_na" class="bantuan_na"><?php echo $bantuan_delete->na->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$bantuan_delete->RecordCount = 0;
$i = 0;
while (!$bantuan_delete->Recordset->EOF) {
	$bantuan_delete->RecordCount++;
	$bantuan_delete->RowCount++;

	// Set row properties
	$bantuan->resetAttributes();
	$bantuan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$bantuan_delete->loadRowValues($bantuan_delete->Recordset);

	// Render row
	$bantuan_delete->renderRow();
?>
	<tr <?php echo $bantuan->rowAttributes() ?>>
<?php if ($bantuan_delete->id->Visible) { // id ?>
		<td <?php echo $bantuan_delete->id->cellAttributes() ?>>
<span id="el<?php echo $bantuan_delete->RowCount ?>_bantuan_id" class="bantuan_id">
<span<?php echo $bantuan_delete->id->viewAttributes() ?>><?php echo $bantuan_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bantuan_delete->bansos_id->Visible) { // bansos_id ?>
		<td <?php echo $bantuan_delete->bansos_id->cellAttributes() ?>>
<span id="el<?php echo $bantuan_delete->RowCount ?>_bantuan_bansos_id" class="bantuan_bansos_id">
<span<?php echo $bantuan_delete->bansos_id->viewAttributes() ?>><?php echo $bantuan_delete->bansos_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bantuan_delete->warga_id->Visible) { // warga_id ?>
		<td <?php echo $bantuan_delete->warga_id->cellAttributes() ?>>
<span id="el<?php echo $bantuan_delete->RowCount ?>_bantuan_warga_id" class="bantuan_warga_id">
<span<?php echo $bantuan_delete->warga_id->viewAttributes() ?>><?php echo $bantuan_delete->warga_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bantuan_delete->na->Visible) { // na ?>
		<td <?php echo $bantuan_delete->na->cellAttributes() ?>>
<span id="el<?php echo $bantuan_delete->RowCount ?>_bantuan_na" class="bantuan_na">
<span<?php echo $bantuan_delete->na->viewAttributes() ?>><?php echo $bantuan_delete->na->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$bantuan_delete->Recordset->moveNext();
}
$bantuan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bantuan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$bantuan_delete->showPageFooter();
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
$bantuan_delete->terminate();
?>