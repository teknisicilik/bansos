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
$master_alamat_delete = new master_alamat_delete();

// Run the page
$master_alamat_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_alamat_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmaster_alamatdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmaster_alamatdelete = currentForm = new ew.Form("fmaster_alamatdelete", "delete");
	loadjs.done("fmaster_alamatdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $master_alamat_delete->showPageHeader(); ?>
<?php
$master_alamat_delete->showMessage();
?>
<form name="fmaster_alamatdelete" id="fmaster_alamatdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_alamat">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($master_alamat_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($master_alamat_delete->id->Visible) { // id ?>
		<th class="<?php echo $master_alamat_delete->id->headerCellClass() ?>"><span id="elh_master_alamat_id" class="master_alamat_id"><?php echo $master_alamat_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($master_alamat_delete->provinsi_id->Visible) { // provinsi_id ?>
		<th class="<?php echo $master_alamat_delete->provinsi_id->headerCellClass() ?>"><span id="elh_master_alamat_provinsi_id" class="master_alamat_provinsi_id"><?php echo $master_alamat_delete->provinsi_id->caption() ?></span></th>
<?php } ?>
<?php if ($master_alamat_delete->kabupaten_id->Visible) { // kabupaten_id ?>
		<th class="<?php echo $master_alamat_delete->kabupaten_id->headerCellClass() ?>"><span id="elh_master_alamat_kabupaten_id" class="master_alamat_kabupaten_id"><?php echo $master_alamat_delete->kabupaten_id->caption() ?></span></th>
<?php } ?>
<?php if ($master_alamat_delete->kecamatan_id->Visible) { // kecamatan_id ?>
		<th class="<?php echo $master_alamat_delete->kecamatan_id->headerCellClass() ?>"><span id="elh_master_alamat_kecamatan_id" class="master_alamat_kecamatan_id"><?php echo $master_alamat_delete->kecamatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($master_alamat_delete->kelurahan_id->Visible) { // kelurahan_id ?>
		<th class="<?php echo $master_alamat_delete->kelurahan_id->headerCellClass() ?>"><span id="elh_master_alamat_kelurahan_id" class="master_alamat_kelurahan_id"><?php echo $master_alamat_delete->kelurahan_id->caption() ?></span></th>
<?php } ?>
<?php if ($master_alamat_delete->rw_id->Visible) { // rw_id ?>
		<th class="<?php echo $master_alamat_delete->rw_id->headerCellClass() ?>"><span id="elh_master_alamat_rw_id" class="master_alamat_rw_id"><?php echo $master_alamat_delete->rw_id->caption() ?></span></th>
<?php } ?>
<?php if ($master_alamat_delete->rt_id->Visible) { // rt_id ?>
		<th class="<?php echo $master_alamat_delete->rt_id->headerCellClass() ?>"><span id="elh_master_alamat_rt_id" class="master_alamat_rt_id"><?php echo $master_alamat_delete->rt_id->caption() ?></span></th>
<?php } ?>
<?php if ($master_alamat_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $master_alamat_delete->nama->headerCellClass() ?>"><span id="elh_master_alamat_nama" class="master_alamat_nama"><?php echo $master_alamat_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($master_alamat_delete->na->Visible) { // na ?>
		<th class="<?php echo $master_alamat_delete->na->headerCellClass() ?>"><span id="elh_master_alamat_na" class="master_alamat_na"><?php echo $master_alamat_delete->na->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$master_alamat_delete->RecordCount = 0;
$i = 0;
while (!$master_alamat_delete->Recordset->EOF) {
	$master_alamat_delete->RecordCount++;
	$master_alamat_delete->RowCount++;

	// Set row properties
	$master_alamat->resetAttributes();
	$master_alamat->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$master_alamat_delete->loadRowValues($master_alamat_delete->Recordset);

	// Render row
	$master_alamat_delete->renderRow();
?>
	<tr <?php echo $master_alamat->rowAttributes() ?>>
<?php if ($master_alamat_delete->id->Visible) { // id ?>
		<td <?php echo $master_alamat_delete->id->cellAttributes() ?>>
<span id="el<?php echo $master_alamat_delete->RowCount ?>_master_alamat_id" class="master_alamat_id">
<span<?php echo $master_alamat_delete->id->viewAttributes() ?>><?php echo $master_alamat_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_alamat_delete->provinsi_id->Visible) { // provinsi_id ?>
		<td <?php echo $master_alamat_delete->provinsi_id->cellAttributes() ?>>
<span id="el<?php echo $master_alamat_delete->RowCount ?>_master_alamat_provinsi_id" class="master_alamat_provinsi_id">
<span<?php echo $master_alamat_delete->provinsi_id->viewAttributes() ?>><?php echo $master_alamat_delete->provinsi_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_alamat_delete->kabupaten_id->Visible) { // kabupaten_id ?>
		<td <?php echo $master_alamat_delete->kabupaten_id->cellAttributes() ?>>
<span id="el<?php echo $master_alamat_delete->RowCount ?>_master_alamat_kabupaten_id" class="master_alamat_kabupaten_id">
<span<?php echo $master_alamat_delete->kabupaten_id->viewAttributes() ?>><?php echo $master_alamat_delete->kabupaten_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_alamat_delete->kecamatan_id->Visible) { // kecamatan_id ?>
		<td <?php echo $master_alamat_delete->kecamatan_id->cellAttributes() ?>>
<span id="el<?php echo $master_alamat_delete->RowCount ?>_master_alamat_kecamatan_id" class="master_alamat_kecamatan_id">
<span<?php echo $master_alamat_delete->kecamatan_id->viewAttributes() ?>><?php echo $master_alamat_delete->kecamatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_alamat_delete->kelurahan_id->Visible) { // kelurahan_id ?>
		<td <?php echo $master_alamat_delete->kelurahan_id->cellAttributes() ?>>
<span id="el<?php echo $master_alamat_delete->RowCount ?>_master_alamat_kelurahan_id" class="master_alamat_kelurahan_id">
<span<?php echo $master_alamat_delete->kelurahan_id->viewAttributes() ?>><?php echo $master_alamat_delete->kelurahan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_alamat_delete->rw_id->Visible) { // rw_id ?>
		<td <?php echo $master_alamat_delete->rw_id->cellAttributes() ?>>
<span id="el<?php echo $master_alamat_delete->RowCount ?>_master_alamat_rw_id" class="master_alamat_rw_id">
<span<?php echo $master_alamat_delete->rw_id->viewAttributes() ?>><?php echo $master_alamat_delete->rw_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_alamat_delete->rt_id->Visible) { // rt_id ?>
		<td <?php echo $master_alamat_delete->rt_id->cellAttributes() ?>>
<span id="el<?php echo $master_alamat_delete->RowCount ?>_master_alamat_rt_id" class="master_alamat_rt_id">
<span<?php echo $master_alamat_delete->rt_id->viewAttributes() ?>><?php echo $master_alamat_delete->rt_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_alamat_delete->nama->Visible) { // nama ?>
		<td <?php echo $master_alamat_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $master_alamat_delete->RowCount ?>_master_alamat_nama" class="master_alamat_nama">
<span<?php echo $master_alamat_delete->nama->viewAttributes() ?>><?php echo $master_alamat_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_alamat_delete->na->Visible) { // na ?>
		<td <?php echo $master_alamat_delete->na->cellAttributes() ?>>
<span id="el<?php echo $master_alamat_delete->RowCount ?>_master_alamat_na" class="master_alamat_na">
<span<?php echo $master_alamat_delete->na->viewAttributes() ?>><?php echo $master_alamat_delete->na->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$master_alamat_delete->Recordset->moveNext();
}
$master_alamat_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $master_alamat_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$master_alamat_delete->showPageFooter();
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
$master_alamat_delete->terminate();
?>