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
$master_bantuan_delete = new master_bantuan_delete();

// Run the page
$master_bantuan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_bantuan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmaster_bantuandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmaster_bantuandelete = currentForm = new ew.Form("fmaster_bantuandelete", "delete");
	loadjs.done("fmaster_bantuandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $master_bantuan_delete->showPageHeader(); ?>
<?php
$master_bantuan_delete->showMessage();
?>
<form name="fmaster_bantuandelete" id="fmaster_bantuandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_bantuan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($master_bantuan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($master_bantuan_delete->id->Visible) { // id ?>
		<th class="<?php echo $master_bantuan_delete->id->headerCellClass() ?>"><span id="elh_master_bantuan_id" class="master_bantuan_id"><?php echo $master_bantuan_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($master_bantuan_delete->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
		<th class="<?php echo $master_bantuan_delete->jenis_bantuan_id->headerCellClass() ?>"><span id="elh_master_bantuan_jenis_bantuan_id" class="master_bantuan_jenis_bantuan_id"><?php echo $master_bantuan_delete->jenis_bantuan_id->caption() ?></span></th>
<?php } ?>
<?php if ($master_bantuan_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $master_bantuan_delete->nama->headerCellClass() ?>"><span id="elh_master_bantuan_nama" class="master_bantuan_nama"><?php echo $master_bantuan_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($master_bantuan_delete->type->Visible) { // type ?>
		<th class="<?php echo $master_bantuan_delete->type->headerCellClass() ?>"><span id="elh_master_bantuan_type" class="master_bantuan_type"><?php echo $master_bantuan_delete->type->caption() ?></span></th>
<?php } ?>
<?php if ($master_bantuan_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $master_bantuan_delete->jumlah->headerCellClass() ?>"><span id="elh_master_bantuan_jumlah" class="master_bantuan_jumlah"><?php echo $master_bantuan_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($master_bantuan_delete->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
		<th class="<?php echo $master_bantuan_delete->sumber_bantuan_id->headerCellClass() ?>"><span id="elh_master_bantuan_sumber_bantuan_id" class="master_bantuan_sumber_bantuan_id"><?php echo $master_bantuan_delete->sumber_bantuan_id->caption() ?></span></th>
<?php } ?>
<?php if ($master_bantuan_delete->pengambilan_bantuuan_id->Visible) { // pengambilan_bantuuan_id ?>
		<th class="<?php echo $master_bantuan_delete->pengambilan_bantuuan_id->headerCellClass() ?>"><span id="elh_master_bantuan_pengambilan_bantuuan_id" class="master_bantuan_pengambilan_bantuuan_id"><?php echo $master_bantuan_delete->pengambilan_bantuuan_id->caption() ?></span></th>
<?php } ?>
<?php if ($master_bantuan_delete->frekuensi->Visible) { // frekuensi ?>
		<th class="<?php echo $master_bantuan_delete->frekuensi->headerCellClass() ?>"><span id="elh_master_bantuan_frekuensi" class="master_bantuan_frekuensi"><?php echo $master_bantuan_delete->frekuensi->caption() ?></span></th>
<?php } ?>
<?php if ($master_bantuan_delete->bulan->Visible) { // bulan ?>
		<th class="<?php echo $master_bantuan_delete->bulan->headerCellClass() ?>"><span id="elh_master_bantuan_bulan" class="master_bantuan_bulan"><?php echo $master_bantuan_delete->bulan->caption() ?></span></th>
<?php } ?>
<?php if ($master_bantuan_delete->tahun->Visible) { // tahun ?>
		<th class="<?php echo $master_bantuan_delete->tahun->headerCellClass() ?>"><span id="elh_master_bantuan_tahun" class="master_bantuan_tahun"><?php echo $master_bantuan_delete->tahun->caption() ?></span></th>
<?php } ?>
<?php if ($master_bantuan_delete->status->Visible) { // status ?>
		<th class="<?php echo $master_bantuan_delete->status->headerCellClass() ?>"><span id="elh_master_bantuan_status" class="master_bantuan_status"><?php echo $master_bantuan_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($master_bantuan_delete->na->Visible) { // na ?>
		<th class="<?php echo $master_bantuan_delete->na->headerCellClass() ?>"><span id="elh_master_bantuan_na" class="master_bantuan_na"><?php echo $master_bantuan_delete->na->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$master_bantuan_delete->RecordCount = 0;
$i = 0;
while (!$master_bantuan_delete->Recordset->EOF) {
	$master_bantuan_delete->RecordCount++;
	$master_bantuan_delete->RowCount++;

	// Set row properties
	$master_bantuan->resetAttributes();
	$master_bantuan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$master_bantuan_delete->loadRowValues($master_bantuan_delete->Recordset);

	// Render row
	$master_bantuan_delete->renderRow();
?>
	<tr <?php echo $master_bantuan->rowAttributes() ?>>
<?php if ($master_bantuan_delete->id->Visible) { // id ?>
		<td <?php echo $master_bantuan_delete->id->cellAttributes() ?>>
<span id="el<?php echo $master_bantuan_delete->RowCount ?>_master_bantuan_id" class="master_bantuan_id">
<span<?php echo $master_bantuan_delete->id->viewAttributes() ?>><?php echo $master_bantuan_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_bantuan_delete->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
		<td <?php echo $master_bantuan_delete->jenis_bantuan_id->cellAttributes() ?>>
<span id="el<?php echo $master_bantuan_delete->RowCount ?>_master_bantuan_jenis_bantuan_id" class="master_bantuan_jenis_bantuan_id">
<span<?php echo $master_bantuan_delete->jenis_bantuan_id->viewAttributes() ?>><?php echo $master_bantuan_delete->jenis_bantuan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_bantuan_delete->nama->Visible) { // nama ?>
		<td <?php echo $master_bantuan_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $master_bantuan_delete->RowCount ?>_master_bantuan_nama" class="master_bantuan_nama">
<span<?php echo $master_bantuan_delete->nama->viewAttributes() ?>><?php echo $master_bantuan_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_bantuan_delete->type->Visible) { // type ?>
		<td <?php echo $master_bantuan_delete->type->cellAttributes() ?>>
<span id="el<?php echo $master_bantuan_delete->RowCount ?>_master_bantuan_type" class="master_bantuan_type">
<span<?php echo $master_bantuan_delete->type->viewAttributes() ?>><?php echo $master_bantuan_delete->type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_bantuan_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $master_bantuan_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $master_bantuan_delete->RowCount ?>_master_bantuan_jumlah" class="master_bantuan_jumlah">
<span<?php echo $master_bantuan_delete->jumlah->viewAttributes() ?>><?php echo $master_bantuan_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_bantuan_delete->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
		<td <?php echo $master_bantuan_delete->sumber_bantuan_id->cellAttributes() ?>>
<span id="el<?php echo $master_bantuan_delete->RowCount ?>_master_bantuan_sumber_bantuan_id" class="master_bantuan_sumber_bantuan_id">
<span<?php echo $master_bantuan_delete->sumber_bantuan_id->viewAttributes() ?>><?php echo $master_bantuan_delete->sumber_bantuan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_bantuan_delete->pengambilan_bantuuan_id->Visible) { // pengambilan_bantuuan_id ?>
		<td <?php echo $master_bantuan_delete->pengambilan_bantuuan_id->cellAttributes() ?>>
<span id="el<?php echo $master_bantuan_delete->RowCount ?>_master_bantuan_pengambilan_bantuuan_id" class="master_bantuan_pengambilan_bantuuan_id">
<span<?php echo $master_bantuan_delete->pengambilan_bantuuan_id->viewAttributes() ?>><?php echo $master_bantuan_delete->pengambilan_bantuuan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_bantuan_delete->frekuensi->Visible) { // frekuensi ?>
		<td <?php echo $master_bantuan_delete->frekuensi->cellAttributes() ?>>
<span id="el<?php echo $master_bantuan_delete->RowCount ?>_master_bantuan_frekuensi" class="master_bantuan_frekuensi">
<span<?php echo $master_bantuan_delete->frekuensi->viewAttributes() ?>><?php echo $master_bantuan_delete->frekuensi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_bantuan_delete->bulan->Visible) { // bulan ?>
		<td <?php echo $master_bantuan_delete->bulan->cellAttributes() ?>>
<span id="el<?php echo $master_bantuan_delete->RowCount ?>_master_bantuan_bulan" class="master_bantuan_bulan">
<span<?php echo $master_bantuan_delete->bulan->viewAttributes() ?>><?php echo $master_bantuan_delete->bulan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_bantuan_delete->tahun->Visible) { // tahun ?>
		<td <?php echo $master_bantuan_delete->tahun->cellAttributes() ?>>
<span id="el<?php echo $master_bantuan_delete->RowCount ?>_master_bantuan_tahun" class="master_bantuan_tahun">
<span<?php echo $master_bantuan_delete->tahun->viewAttributes() ?>><?php echo $master_bantuan_delete->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_bantuan_delete->status->Visible) { // status ?>
		<td <?php echo $master_bantuan_delete->status->cellAttributes() ?>>
<span id="el<?php echo $master_bantuan_delete->RowCount ?>_master_bantuan_status" class="master_bantuan_status">
<span<?php echo $master_bantuan_delete->status->viewAttributes() ?>><?php echo $master_bantuan_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($master_bantuan_delete->na->Visible) { // na ?>
		<td <?php echo $master_bantuan_delete->na->cellAttributes() ?>>
<span id="el<?php echo $master_bantuan_delete->RowCount ?>_master_bantuan_na" class="master_bantuan_na">
<span<?php echo $master_bantuan_delete->na->viewAttributes() ?>><?php echo $master_bantuan_delete->na->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$master_bantuan_delete->Recordset->moveNext();
}
$master_bantuan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $master_bantuan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$master_bantuan_delete->showPageFooter();
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
$master_bantuan_delete->terminate();
?>