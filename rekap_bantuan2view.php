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
$rekap_bantuan2_view = new rekap_bantuan2_view();

// Run the page
$rekap_bantuan2_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekap_bantuan2_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rekap_bantuan2_view->isExport()) { ?>
<script>
var frekap_bantuan2view, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	frekap_bantuan2view = currentForm = new ew.Form("frekap_bantuan2view", "view");
	loadjs.done("frekap_bantuan2view");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$rekap_bantuan2_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $rekap_bantuan2_view->ExportOptions->render("body") ?>
<?php $rekap_bantuan2_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $rekap_bantuan2_view->showPageHeader(); ?>
<?php
$rekap_bantuan2_view->showMessage();
?>
<?php if (!$rekap_bantuan2_view->IsModal) { ?>
<?php if (!$rekap_bantuan2_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rekap_bantuan2_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="frekap_bantuan2view" id="frekap_bantuan2view" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekap_bantuan2">
<input type="hidden" name="modal" value="<?php echo (int)$rekap_bantuan2_view->IsModal ?>">
<?php if (!$rekap_bantuan2_view->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="rekap_bantuan2_view"><!-- multi-page tabs -->
	<ul class="<?php echo $rekap_bantuan2_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $rekap_bantuan2_view->MultiPages->pageStyle(1) ?>" href="#tab_rekap_bantuan21" data-toggle="tab"><?php echo $rekap_bantuan2->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $rekap_bantuan2_view->MultiPages->pageStyle(2) ?>" href="#tab_rekap_bantuan22" data-toggle="tab"><?php echo $rekap_bantuan2->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$rekap_bantuan2_view->isExport()) { ?>
		<div class="tab-pane<?php echo $rekap_bantuan2_view->MultiPages->pageStyle(1) ?>" id="tab_rekap_bantuan21"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($rekap_bantuan2_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_id"><?php echo $rekap_bantuan2_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $rekap_bantuan2_view->id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_id" data-page="1">
<span<?php echo $rekap_bantuan2_view->id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->bansos_id->Visible) { // bansos_id ?>
	<tr id="r_bansos_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_bansos_id"><?php echo $rekap_bantuan2_view->bansos_id->caption() ?></span></td>
		<td data-name="bansos_id" <?php echo $rekap_bantuan2_view->bansos_id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_bansos_id" data-page="1">
<span<?php echo $rekap_bantuan2_view->bansos_id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->bansos_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
	<tr id="r_jenis_bantuan_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_jenis_bantuan_id"><?php echo $rekap_bantuan2_view->jenis_bantuan_id->caption() ?></span></td>
		<td data-name="jenis_bantuan_id" <?php echo $rekap_bantuan2_view->jenis_bantuan_id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_jenis_bantuan_id" data-page="1">
<span<?php echo $rekap_bantuan2_view->jenis_bantuan_id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->jenis_bantuan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->type->Visible) { // type ?>
	<tr id="r_type">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_type"><?php echo $rekap_bantuan2_view->type->caption() ?></span></td>
		<td data-name="type" <?php echo $rekap_bantuan2_view->type->cellAttributes() ?>>
<span id="el_rekap_bantuan2_type" data-page="1">
<span<?php echo $rekap_bantuan2_view->type->viewAttributes() ?>><?php echo $rekap_bantuan2_view->type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_jumlah"><?php echo $rekap_bantuan2_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $rekap_bantuan2_view->jumlah->cellAttributes() ?>>
<span id="el_rekap_bantuan2_jumlah" data-page="1">
<span<?php echo $rekap_bantuan2_view->jumlah->viewAttributes() ?>><?php echo $rekap_bantuan2_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
	<tr id="r_sumber_bantuan_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_sumber_bantuan_id"><?php echo $rekap_bantuan2_view->sumber_bantuan_id->caption() ?></span></td>
		<td data-name="sumber_bantuan_id" <?php echo $rekap_bantuan2_view->sumber_bantuan_id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_sumber_bantuan_id" data-page="1">
<span<?php echo $rekap_bantuan2_view->sumber_bantuan_id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->sumber_bantuan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->pengambilan_bantuuan_id->Visible) { // pengambilan_bantuuan_id ?>
	<tr id="r_pengambilan_bantuuan_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_pengambilan_bantuuan_id"><?php echo $rekap_bantuan2_view->pengambilan_bantuuan_id->caption() ?></span></td>
		<td data-name="pengambilan_bantuuan_id" <?php echo $rekap_bantuan2_view->pengambilan_bantuuan_id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_pengambilan_bantuuan_id" data-page="1">
<span<?php echo $rekap_bantuan2_view->pengambilan_bantuuan_id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->pengambilan_bantuuan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->frekuensi->Visible) { // frekuensi ?>
	<tr id="r_frekuensi">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_frekuensi"><?php echo $rekap_bantuan2_view->frekuensi->caption() ?></span></td>
		<td data-name="frekuensi" <?php echo $rekap_bantuan2_view->frekuensi->cellAttributes() ?>>
<span id="el_rekap_bantuan2_frekuensi" data-page="1">
<span<?php echo $rekap_bantuan2_view->frekuensi->viewAttributes() ?>><?php echo $rekap_bantuan2_view->frekuensi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->bulan->Visible) { // bulan ?>
	<tr id="r_bulan">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_bulan"><?php echo $rekap_bantuan2_view->bulan->caption() ?></span></td>
		<td data-name="bulan" <?php echo $rekap_bantuan2_view->bulan->cellAttributes() ?>>
<span id="el_rekap_bantuan2_bulan" data-page="1">
<span<?php echo $rekap_bantuan2_view->bulan->viewAttributes() ?>><?php echo $rekap_bantuan2_view->bulan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->tahun->Visible) { // tahun ?>
	<tr id="r_tahun">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_tahun"><?php echo $rekap_bantuan2_view->tahun->caption() ?></span></td>
		<td data-name="tahun" <?php echo $rekap_bantuan2_view->tahun->cellAttributes() ?>>
<span id="el_rekap_bantuan2_tahun" data-page="1">
<span<?php echo $rekap_bantuan2_view->tahun->viewAttributes() ?>><?php echo $rekap_bantuan2_view->tahun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->keterangan_bantuan->Visible) { // keterangan_bantuan ?>
	<tr id="r_keterangan_bantuan">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_keterangan_bantuan"><?php echo $rekap_bantuan2_view->keterangan_bantuan->caption() ?></span></td>
		<td data-name="keterangan_bantuan" <?php echo $rekap_bantuan2_view->keterangan_bantuan->cellAttributes() ?>>
<span id="el_rekap_bantuan2_keterangan_bantuan" data-page="1">
<span<?php echo $rekap_bantuan2_view->keterangan_bantuan->viewAttributes() ?>><?php echo $rekap_bantuan2_view->keterangan_bantuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_status"><?php echo $rekap_bantuan2_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $rekap_bantuan2_view->status->cellAttributes() ?>>
<span id="el_rekap_bantuan2_status" data-page="1">
<span<?php echo $rekap_bantuan2_view->status->viewAttributes() ?>><?php echo $rekap_bantuan2_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$rekap_bantuan2_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$rekap_bantuan2_view->isExport()) { ?>
		<div class="tab-pane<?php echo $rekap_bantuan2_view->MultiPages->pageStyle(2) ?>" id="tab_rekap_bantuan22"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($rekap_bantuan2_view->kk->Visible) { // kk ?>
	<tr id="r_kk">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_kk"><?php echo $rekap_bantuan2_view->kk->caption() ?></span></td>
		<td data-name="kk" <?php echo $rekap_bantuan2_view->kk->cellAttributes() ?>>
<span id="el_rekap_bantuan2_kk" data-page="2">
<span<?php echo $rekap_bantuan2_view->kk->viewAttributes() ?>><?php echo $rekap_bantuan2_view->kk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->nik->Visible) { // nik ?>
	<tr id="r_nik">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_nik"><?php echo $rekap_bantuan2_view->nik->caption() ?></span></td>
		<td data-name="nik" <?php echo $rekap_bantuan2_view->nik->cellAttributes() ?>>
<span id="el_rekap_bantuan2_nik" data-page="2">
<span<?php echo $rekap_bantuan2_view->nik->viewAttributes() ?>><?php echo $rekap_bantuan2_view->nik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_nama"><?php echo $rekap_bantuan2_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $rekap_bantuan2_view->nama->cellAttributes() ?>>
<span id="el_rekap_bantuan2_nama" data-page="2">
<span<?php echo $rekap_bantuan2_view->nama->viewAttributes() ?>><?php echo $rekap_bantuan2_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->provinsi_id->Visible) { // provinsi_id ?>
	<tr id="r_provinsi_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_provinsi_id"><?php echo $rekap_bantuan2_view->provinsi_id->caption() ?></span></td>
		<td data-name="provinsi_id" <?php echo $rekap_bantuan2_view->provinsi_id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_provinsi_id" data-page="2">
<span<?php echo $rekap_bantuan2_view->provinsi_id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->provinsi_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->kabupaten_id->Visible) { // kabupaten_id ?>
	<tr id="r_kabupaten_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_kabupaten_id"><?php echo $rekap_bantuan2_view->kabupaten_id->caption() ?></span></td>
		<td data-name="kabupaten_id" <?php echo $rekap_bantuan2_view->kabupaten_id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_kabupaten_id" data-page="2">
<span<?php echo $rekap_bantuan2_view->kabupaten_id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->kabupaten_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->kecamatan_id->Visible) { // kecamatan_id ?>
	<tr id="r_kecamatan_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_kecamatan_id"><?php echo $rekap_bantuan2_view->kecamatan_id->caption() ?></span></td>
		<td data-name="kecamatan_id" <?php echo $rekap_bantuan2_view->kecamatan_id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_kecamatan_id" data-page="2">
<span<?php echo $rekap_bantuan2_view->kecamatan_id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->kecamatan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->kelurahan_id->Visible) { // kelurahan_id ?>
	<tr id="r_kelurahan_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_kelurahan_id"><?php echo $rekap_bantuan2_view->kelurahan_id->caption() ?></span></td>
		<td data-name="kelurahan_id" <?php echo $rekap_bantuan2_view->kelurahan_id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_kelurahan_id" data-page="2">
<span<?php echo $rekap_bantuan2_view->kelurahan_id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->kelurahan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->rw_id->Visible) { // rw_id ?>
	<tr id="r_rw_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_rw_id"><?php echo $rekap_bantuan2_view->rw_id->caption() ?></span></td>
		<td data-name="rw_id" <?php echo $rekap_bantuan2_view->rw_id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_rw_id" data-page="2">
<span<?php echo $rekap_bantuan2_view->rw_id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->rw_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->rt_id->Visible) { // rt_id ?>
	<tr id="r_rt_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_rt_id"><?php echo $rekap_bantuan2_view->rt_id->caption() ?></span></td>
		<td data-name="rt_id" <?php echo $rekap_bantuan2_view->rt_id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_rt_id" data-page="2">
<span<?php echo $rekap_bantuan2_view->rt_id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->rt_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->alamat_id->Visible) { // alamat_id ?>
	<tr id="r_alamat_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_alamat_id"><?php echo $rekap_bantuan2_view->alamat_id->caption() ?></span></td>
		<td data-name="alamat_id" <?php echo $rekap_bantuan2_view->alamat_id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_alamat_id" data-page="2">
<span<?php echo $rekap_bantuan2_view->alamat_id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->alamat_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->nomor_rumah->Visible) { // nomor_rumah ?>
	<tr id="r_nomor_rumah">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_nomor_rumah"><?php echo $rekap_bantuan2_view->nomor_rumah->caption() ?></span></td>
		<td data-name="nomor_rumah" <?php echo $rekap_bantuan2_view->nomor_rumah->cellAttributes() ?>>
<span id="el_rekap_bantuan2_nomor_rumah" data-page="2">
<span<?php echo $rekap_bantuan2_view->nomor_rumah->viewAttributes() ?>><?php echo $rekap_bantuan2_view->nomor_rumah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->status_warga_id->Visible) { // status_warga_id ?>
	<tr id="r_status_warga_id">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_status_warga_id"><?php echo $rekap_bantuan2_view->status_warga_id->caption() ?></span></td>
		<td data-name="status_warga_id" <?php echo $rekap_bantuan2_view->status_warga_id->cellAttributes() ?>>
<span id="el_rekap_bantuan2_status_warga_id" data-page="2">
<span<?php echo $rekap_bantuan2_view->status_warga_id->viewAttributes() ?>><?php echo $rekap_bantuan2_view->status_warga_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan2_view->keterangan_warga->Visible) { // keterangan_warga ?>
	<tr id="r_keterangan_warga">
		<td class="<?php echo $rekap_bantuan2_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan2_keterangan_warga"><?php echo $rekap_bantuan2_view->keterangan_warga->caption() ?></span></td>
		<td data-name="keterangan_warga" <?php echo $rekap_bantuan2_view->keterangan_warga->cellAttributes() ?>>
<span id="el_rekap_bantuan2_keterangan_warga" data-page="2">
<span<?php echo $rekap_bantuan2_view->keterangan_warga->viewAttributes() ?>><?php echo $rekap_bantuan2_view->keterangan_warga->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$rekap_bantuan2_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$rekap_bantuan2_view->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$rekap_bantuan2_view->IsModal) { ?>
<?php if (!$rekap_bantuan2_view->isExport()) { ?>
<?php echo $rekap_bantuan2_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$rekap_bantuan2_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rekap_bantuan2_view->isExport()) { ?>
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
$rekap_bantuan2_view->terminate();
?>