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
$master_warga_view = new master_warga_view();

// Run the page
$master_warga_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_warga_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$master_warga_view->isExport()) { ?>
<script>
var fmaster_wargaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmaster_wargaview = currentForm = new ew.Form("fmaster_wargaview", "view");
	loadjs.done("fmaster_wargaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$master_warga_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $master_warga_view->ExportOptions->render("body") ?>
<?php $master_warga_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $master_warga_view->showPageHeader(); ?>
<?php
$master_warga_view->showMessage();
?>
<?php if (!$master_warga_view->IsModal) { ?>
<?php if (!$master_warga_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_warga_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmaster_wargaview" id="fmaster_wargaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_warga">
<input type="hidden" name="modal" value="<?php echo (int)$master_warga_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($master_warga_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_id"><?php echo $master_warga_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $master_warga_view->id->cellAttributes() ?>>
<span id="el_master_warga_id">
<span<?php echo $master_warga_view->id->viewAttributes() ?>><?php echo $master_warga_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->kk->Visible) { // kk ?>
	<tr id="r_kk">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_kk"><?php echo $master_warga_view->kk->caption() ?></span></td>
		<td data-name="kk" <?php echo $master_warga_view->kk->cellAttributes() ?>>
<span id="el_master_warga_kk">
<span<?php echo $master_warga_view->kk->viewAttributes() ?>><?php echo $master_warga_view->kk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->nik->Visible) { // nik ?>
	<tr id="r_nik">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_nik"><?php echo $master_warga_view->nik->caption() ?></span></td>
		<td data-name="nik" <?php echo $master_warga_view->nik->cellAttributes() ?>>
<span id="el_master_warga_nik">
<span<?php echo $master_warga_view->nik->viewAttributes() ?>><?php echo $master_warga_view->nik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_nama"><?php echo $master_warga_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $master_warga_view->nama->cellAttributes() ?>>
<span id="el_master_warga_nama">
<span<?php echo $master_warga_view->nama->viewAttributes() ?>><?php echo $master_warga_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->provinsi_id->Visible) { // provinsi_id ?>
	<tr id="r_provinsi_id">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_provinsi_id"><?php echo $master_warga_view->provinsi_id->caption() ?></span></td>
		<td data-name="provinsi_id" <?php echo $master_warga_view->provinsi_id->cellAttributes() ?>>
<span id="el_master_warga_provinsi_id">
<span<?php echo $master_warga_view->provinsi_id->viewAttributes() ?>><?php echo $master_warga_view->provinsi_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->kabupaten_id->Visible) { // kabupaten_id ?>
	<tr id="r_kabupaten_id">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_kabupaten_id"><?php echo $master_warga_view->kabupaten_id->caption() ?></span></td>
		<td data-name="kabupaten_id" <?php echo $master_warga_view->kabupaten_id->cellAttributes() ?>>
<span id="el_master_warga_kabupaten_id">
<span<?php echo $master_warga_view->kabupaten_id->viewAttributes() ?>><?php echo $master_warga_view->kabupaten_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->kecamatan_id->Visible) { // kecamatan_id ?>
	<tr id="r_kecamatan_id">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_kecamatan_id"><?php echo $master_warga_view->kecamatan_id->caption() ?></span></td>
		<td data-name="kecamatan_id" <?php echo $master_warga_view->kecamatan_id->cellAttributes() ?>>
<span id="el_master_warga_kecamatan_id">
<span<?php echo $master_warga_view->kecamatan_id->viewAttributes() ?>><?php echo $master_warga_view->kecamatan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->kelurahan_id->Visible) { // kelurahan_id ?>
	<tr id="r_kelurahan_id">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_kelurahan_id"><?php echo $master_warga_view->kelurahan_id->caption() ?></span></td>
		<td data-name="kelurahan_id" <?php echo $master_warga_view->kelurahan_id->cellAttributes() ?>>
<span id="el_master_warga_kelurahan_id">
<span<?php echo $master_warga_view->kelurahan_id->viewAttributes() ?>><?php echo $master_warga_view->kelurahan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->rw_id->Visible) { // rw_id ?>
	<tr id="r_rw_id">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_rw_id"><?php echo $master_warga_view->rw_id->caption() ?></span></td>
		<td data-name="rw_id" <?php echo $master_warga_view->rw_id->cellAttributes() ?>>
<span id="el_master_warga_rw_id">
<span<?php echo $master_warga_view->rw_id->viewAttributes() ?>><?php echo $master_warga_view->rw_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->rt_id->Visible) { // rt_id ?>
	<tr id="r_rt_id">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_rt_id"><?php echo $master_warga_view->rt_id->caption() ?></span></td>
		<td data-name="rt_id" <?php echo $master_warga_view->rt_id->cellAttributes() ?>>
<span id="el_master_warga_rt_id">
<span<?php echo $master_warga_view->rt_id->viewAttributes() ?>><?php echo $master_warga_view->rt_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->alamat_id->Visible) { // alamat_id ?>
	<tr id="r_alamat_id">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_alamat_id"><?php echo $master_warga_view->alamat_id->caption() ?></span></td>
		<td data-name="alamat_id" <?php echo $master_warga_view->alamat_id->cellAttributes() ?>>
<span id="el_master_warga_alamat_id">
<span<?php echo $master_warga_view->alamat_id->viewAttributes() ?>><?php echo $master_warga_view->alamat_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->nomor_rumah->Visible) { // nomor_rumah ?>
	<tr id="r_nomor_rumah">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_nomor_rumah"><?php echo $master_warga_view->nomor_rumah->caption() ?></span></td>
		<td data-name="nomor_rumah" <?php echo $master_warga_view->nomor_rumah->cellAttributes() ?>>
<span id="el_master_warga_nomor_rumah">
<span<?php echo $master_warga_view->nomor_rumah->viewAttributes() ?>><?php echo $master_warga_view->nomor_rumah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_keterangan"><?php echo $master_warga_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $master_warga_view->keterangan->cellAttributes() ?>>
<span id="el_master_warga_keterangan">
<span<?php echo $master_warga_view->keterangan->viewAttributes() ?>><?php echo $master_warga_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->status_warga_id->Visible) { // status_warga_id ?>
	<tr id="r_status_warga_id">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_status_warga_id"><?php echo $master_warga_view->status_warga_id->caption() ?></span></td>
		<td data-name="status_warga_id" <?php echo $master_warga_view->status_warga_id->cellAttributes() ?>>
<span id="el_master_warga_status_warga_id">
<span<?php echo $master_warga_view->status_warga_id->viewAttributes() ?>><?php echo $master_warga_view->status_warga_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($master_warga_view->na->Visible) { // na ?>
	<tr id="r_na">
		<td class="<?php echo $master_warga_view->TableLeftColumnClass ?>"><span id="elh_master_warga_na"><?php echo $master_warga_view->na->caption() ?></span></td>
		<td data-name="na" <?php echo $master_warga_view->na->cellAttributes() ?>>
<span id="el_master_warga_na">
<span<?php echo $master_warga_view->na->viewAttributes() ?>><?php echo $master_warga_view->na->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$master_warga_view->IsModal) { ?>
<?php if (!$master_warga_view->isExport()) { ?>
<?php echo $master_warga_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$master_warga_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$master_warga_view->isExport()) { ?>
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
$master_warga_view->terminate();
?>