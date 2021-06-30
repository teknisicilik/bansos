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
$master_bantuan_view = new master_bantuan_view();

// Run the page
$master_bantuan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_bantuan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$master_bantuan_view->isExport()) { ?>
<script>
var fmaster_bantuanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmaster_bantuanview = currentForm = new ew.Form("fmaster_bantuanview", "view");
	loadjs.done("fmaster_bantuanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$master_bantuan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $master_bantuan_view->ExportOptions->render("body") ?>
<?php $master_bantuan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $master_bantuan_view->showPageHeader(); ?>
<?php
$master_bantuan_view->showMessage();
?>
<?php if (!$master_bantuan_view->IsModal) { ?>
<?php if (!$master_bantuan_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_bantuan_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmaster_bantuanview" id="fmaster_bantuanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_bantuan">
<input type="hidden" name="modal" value="<?php echo (int)$master_bantuan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($master_bantuan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_id"><?php echo $master_bantuan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $master_bantuan_view->id->cellAttributes() ?>>
<span id="el_master_bantuan_id">
<span<?php echo $master_bantuan_view->id->viewAttributes() ?>><?php echo $master_bantuan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_bantuan_view->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
	<tr id="r_jenis_bantuan_id">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_jenis_bantuan_id"><?php echo $master_bantuan_view->jenis_bantuan_id->caption() ?></span></td>
		<td data-name="jenis_bantuan_id" <?php echo $master_bantuan_view->jenis_bantuan_id->cellAttributes() ?>>
<span id="el_master_bantuan_jenis_bantuan_id">
<span<?php echo $master_bantuan_view->jenis_bantuan_id->viewAttributes() ?>><?php echo $master_bantuan_view->jenis_bantuan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_bantuan_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_nama"><?php echo $master_bantuan_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $master_bantuan_view->nama->cellAttributes() ?>>
<span id="el_master_bantuan_nama">
<span<?php echo $master_bantuan_view->nama->viewAttributes() ?>><?php echo $master_bantuan_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_bantuan_view->type->Visible) { // type ?>
	<tr id="r_type">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_type"><?php echo $master_bantuan_view->type->caption() ?></span></td>
		<td data-name="type" <?php echo $master_bantuan_view->type->cellAttributes() ?>>
<span id="el_master_bantuan_type">
<span<?php echo $master_bantuan_view->type->viewAttributes() ?>><?php echo $master_bantuan_view->type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_bantuan_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_jumlah"><?php echo $master_bantuan_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $master_bantuan_view->jumlah->cellAttributes() ?>>
<span id="el_master_bantuan_jumlah">
<span<?php echo $master_bantuan_view->jumlah->viewAttributes() ?>><?php echo $master_bantuan_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_bantuan_view->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
	<tr id="r_sumber_bantuan_id">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_sumber_bantuan_id"><?php echo $master_bantuan_view->sumber_bantuan_id->caption() ?></span></td>
		<td data-name="sumber_bantuan_id" <?php echo $master_bantuan_view->sumber_bantuan_id->cellAttributes() ?>>
<span id="el_master_bantuan_sumber_bantuan_id">
<span<?php echo $master_bantuan_view->sumber_bantuan_id->viewAttributes() ?>><?php echo $master_bantuan_view->sumber_bantuan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_bantuan_view->pengambilan_bantuuan_id->Visible) { // pengambilan_bantuuan_id ?>
	<tr id="r_pengambilan_bantuuan_id">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_pengambilan_bantuuan_id"><?php echo $master_bantuan_view->pengambilan_bantuuan_id->caption() ?></span></td>
		<td data-name="pengambilan_bantuuan_id" <?php echo $master_bantuan_view->pengambilan_bantuuan_id->cellAttributes() ?>>
<span id="el_master_bantuan_pengambilan_bantuuan_id">
<span<?php echo $master_bantuan_view->pengambilan_bantuuan_id->viewAttributes() ?>><?php echo $master_bantuan_view->pengambilan_bantuuan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_bantuan_view->frekuensi->Visible) { // frekuensi ?>
	<tr id="r_frekuensi">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_frekuensi"><?php echo $master_bantuan_view->frekuensi->caption() ?></span></td>
		<td data-name="frekuensi" <?php echo $master_bantuan_view->frekuensi->cellAttributes() ?>>
<span id="el_master_bantuan_frekuensi">
<span<?php echo $master_bantuan_view->frekuensi->viewAttributes() ?>><?php echo $master_bantuan_view->frekuensi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_bantuan_view->bulan->Visible) { // bulan ?>
	<tr id="r_bulan">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_bulan"><?php echo $master_bantuan_view->bulan->caption() ?></span></td>
		<td data-name="bulan" <?php echo $master_bantuan_view->bulan->cellAttributes() ?>>
<span id="el_master_bantuan_bulan">
<span<?php echo $master_bantuan_view->bulan->viewAttributes() ?>><?php echo $master_bantuan_view->bulan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_bantuan_view->tahun->Visible) { // tahun ?>
	<tr id="r_tahun">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_tahun"><?php echo $master_bantuan_view->tahun->caption() ?></span></td>
		<td data-name="tahun" <?php echo $master_bantuan_view->tahun->cellAttributes() ?>>
<span id="el_master_bantuan_tahun">
<span<?php echo $master_bantuan_view->tahun->viewAttributes() ?>><?php echo $master_bantuan_view->tahun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_bantuan_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_keterangan"><?php echo $master_bantuan_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $master_bantuan_view->keterangan->cellAttributes() ?>>
<span id="el_master_bantuan_keterangan">
<span<?php echo $master_bantuan_view->keterangan->viewAttributes() ?>><?php echo $master_bantuan_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_bantuan_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_status"><?php echo $master_bantuan_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $master_bantuan_view->status->cellAttributes() ?>>
<span id="el_master_bantuan_status">
<span<?php echo $master_bantuan_view->status->viewAttributes() ?>><?php echo $master_bantuan_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_bantuan_view->na->Visible) { // na ?>
	<tr id="r_na">
		<td class="<?php echo $master_bantuan_view->TableLeftColumnClass ?>"><span id="elh_master_bantuan_na"><?php echo $master_bantuan_view->na->caption() ?></span></td>
		<td data-name="na" <?php echo $master_bantuan_view->na->cellAttributes() ?>>
<span id="el_master_bantuan_na">
<span<?php echo $master_bantuan_view->na->viewAttributes() ?>><?php echo $master_bantuan_view->na->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$master_bantuan_view->IsModal) { ?>
<?php if (!$master_bantuan_view->isExport()) { ?>
<?php echo $master_bantuan_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("bantuan", explode(",", $master_bantuan->getCurrentDetailTable())) && $bantuan->DetailView) {
?>
<?php if ($master_bantuan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("bantuan", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "bantuangrid.php" ?>
<?php } ?>
</form>
<?php
$master_bantuan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$master_bantuan_view->isExport()) { ?>
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
$master_bantuan_view->terminate();
?>