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
$rekap_bantuan_view = new rekap_bantuan_view();

// Run the page
$rekap_bantuan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekap_bantuan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rekap_bantuan_view->isExport()) { ?>
<script>
var frekap_bantuanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	frekap_bantuanview = currentForm = new ew.Form("frekap_bantuanview", "view");
	loadjs.done("frekap_bantuanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$rekap_bantuan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $rekap_bantuan_view->ExportOptions->render("body") ?>
<?php $rekap_bantuan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $rekap_bantuan_view->showPageHeader(); ?>
<?php
$rekap_bantuan_view->showMessage();
?>
<?php if (!$rekap_bantuan_view->IsModal) { ?>
<?php if (!$rekap_bantuan_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rekap_bantuan_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="frekap_bantuanview" id="frekap_bantuanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekap_bantuan">
<input type="hidden" name="modal" value="<?php echo (int)$rekap_bantuan_view->IsModal ?>">
<?php if (!$rekap_bantuan_view->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="rekap_bantuan_view"><!-- multi-page tabs -->
	<ul class="<?php echo $rekap_bantuan_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $rekap_bantuan_view->MultiPages->pageStyle(1) ?>" href="#tab_rekap_bantuan1" data-toggle="tab"><?php echo $rekap_bantuan->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $rekap_bantuan_view->MultiPages->pageStyle(2) ?>" href="#tab_rekap_bantuan2" data-toggle="tab"><?php echo $rekap_bantuan->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$rekap_bantuan_view->isExport()) { ?>
		<div class="tab-pane<?php echo $rekap_bantuan_view->MultiPages->pageStyle(1) ?>" id="tab_rekap_bantuan1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($rekap_bantuan_view->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
	<tr id="r_jenis_bantuan_id">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_jenis_bantuan_id"><?php echo $rekap_bantuan_view->jenis_bantuan_id->caption() ?></span></td>
		<td data-name="jenis_bantuan_id" <?php echo $rekap_bantuan_view->jenis_bantuan_id->cellAttributes() ?>>
<span id="el_rekap_bantuan_jenis_bantuan_id" data-page="1">
<span<?php echo $rekap_bantuan_view->jenis_bantuan_id->viewAttributes() ?>><?php echo $rekap_bantuan_view->jenis_bantuan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->bantuan_id->Visible) { // bantuan_id ?>
	<tr id="r_bantuan_id">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_bantuan_id"><?php echo $rekap_bantuan_view->bantuan_id->caption() ?></span></td>
		<td data-name="bantuan_id" <?php echo $rekap_bantuan_view->bantuan_id->cellAttributes() ?>>
<span id="el_rekap_bantuan_bantuan_id" data-page="1">
<span<?php echo $rekap_bantuan_view->bantuan_id->viewAttributes() ?>><?php echo $rekap_bantuan_view->bantuan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->type->Visible) { // type ?>
	<tr id="r_type">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_type"><?php echo $rekap_bantuan_view->type->caption() ?></span></td>
		<td data-name="type" <?php echo $rekap_bantuan_view->type->cellAttributes() ?>>
<span id="el_rekap_bantuan_type" data-page="1">
<span<?php echo $rekap_bantuan_view->type->viewAttributes() ?>><?php echo $rekap_bantuan_view->type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_jumlah"><?php echo $rekap_bantuan_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $rekap_bantuan_view->jumlah->cellAttributes() ?>>
<span id="el_rekap_bantuan_jumlah" data-page="1">
<span<?php echo $rekap_bantuan_view->jumlah->viewAttributes() ?>><?php echo $rekap_bantuan_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
	<tr id="r_sumber_bantuan_id">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_sumber_bantuan_id"><?php echo $rekap_bantuan_view->sumber_bantuan_id->caption() ?></span></td>
		<td data-name="sumber_bantuan_id" <?php echo $rekap_bantuan_view->sumber_bantuan_id->cellAttributes() ?>>
<span id="el_rekap_bantuan_sumber_bantuan_id" data-page="1">
<span<?php echo $rekap_bantuan_view->sumber_bantuan_id->viewAttributes() ?>><?php echo $rekap_bantuan_view->sumber_bantuan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->pengambilan_bantuuan_id->Visible) { // pengambilan_bantuuan_id ?>
	<tr id="r_pengambilan_bantuuan_id">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_pengambilan_bantuuan_id"><?php echo $rekap_bantuan_view->pengambilan_bantuuan_id->caption() ?></span></td>
		<td data-name="pengambilan_bantuuan_id" <?php echo $rekap_bantuan_view->pengambilan_bantuuan_id->cellAttributes() ?>>
<span id="el_rekap_bantuan_pengambilan_bantuuan_id" data-page="1">
<span<?php echo $rekap_bantuan_view->pengambilan_bantuuan_id->viewAttributes() ?>><?php echo $rekap_bantuan_view->pengambilan_bantuuan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->tahun_bantuan->Visible) { // tahun_bantuan ?>
	<tr id="r_tahun_bantuan">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_tahun_bantuan"><?php echo $rekap_bantuan_view->tahun_bantuan->caption() ?></span></td>
		<td data-name="tahun_bantuan" <?php echo $rekap_bantuan_view->tahun_bantuan->cellAttributes() ?>>
<span id="el_rekap_bantuan_tahun_bantuan" data-page="1">
<span<?php echo $rekap_bantuan_view->tahun_bantuan->viewAttributes() ?>><?php echo $rekap_bantuan_view->tahun_bantuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->keterangan_bantuan->Visible) { // keterangan_bantuan ?>
	<tr id="r_keterangan_bantuan">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_keterangan_bantuan"><?php echo $rekap_bantuan_view->keterangan_bantuan->caption() ?></span></td>
		<td data-name="keterangan_bantuan" <?php echo $rekap_bantuan_view->keterangan_bantuan->cellAttributes() ?>>
<span id="el_rekap_bantuan_keterangan_bantuan" data-page="1">
<span<?php echo $rekap_bantuan_view->keterangan_bantuan->viewAttributes() ?>><?php echo $rekap_bantuan_view->keterangan_bantuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->status_bantuan->Visible) { // status_bantuan ?>
	<tr id="r_status_bantuan">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_status_bantuan"><?php echo $rekap_bantuan_view->status_bantuan->caption() ?></span></td>
		<td data-name="status_bantuan" <?php echo $rekap_bantuan_view->status_bantuan->cellAttributes() ?>>
<span id="el_rekap_bantuan_status_bantuan" data-page="1">
<span<?php echo $rekap_bantuan_view->status_bantuan->viewAttributes() ?>><?php echo $rekap_bantuan_view->status_bantuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$rekap_bantuan_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$rekap_bantuan_view->isExport()) { ?>
		<div class="tab-pane<?php echo $rekap_bantuan_view->MultiPages->pageStyle(2) ?>" id="tab_rekap_bantuan2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($rekap_bantuan_view->kk->Visible) { // kk ?>
	<tr id="r_kk">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_kk"><?php echo $rekap_bantuan_view->kk->caption() ?></span></td>
		<td data-name="kk" <?php echo $rekap_bantuan_view->kk->cellAttributes() ?>>
<span id="el_rekap_bantuan_kk" data-page="2">
<span<?php echo $rekap_bantuan_view->kk->viewAttributes() ?>><?php echo $rekap_bantuan_view->kk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->nik->Visible) { // nik ?>
	<tr id="r_nik">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_nik"><?php echo $rekap_bantuan_view->nik->caption() ?></span></td>
		<td data-name="nik" <?php echo $rekap_bantuan_view->nik->cellAttributes() ?>>
<span id="el_rekap_bantuan_nik" data-page="2">
<span<?php echo $rekap_bantuan_view->nik->viewAttributes() ?>><?php echo $rekap_bantuan_view->nik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_nama"><?php echo $rekap_bantuan_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $rekap_bantuan_view->nama->cellAttributes() ?>>
<span id="el_rekap_bantuan_nama" data-page="2">
<span<?php echo $rekap_bantuan_view->nama->viewAttributes() ?>><?php echo $rekap_bantuan_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->provinsi_id->Visible) { // provinsi_id ?>
	<tr id="r_provinsi_id">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_provinsi_id"><?php echo $rekap_bantuan_view->provinsi_id->caption() ?></span></td>
		<td data-name="provinsi_id" <?php echo $rekap_bantuan_view->provinsi_id->cellAttributes() ?>>
<span id="el_rekap_bantuan_provinsi_id" data-page="2">
<span<?php echo $rekap_bantuan_view->provinsi_id->viewAttributes() ?>><?php echo $rekap_bantuan_view->provinsi_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->kabupaten_id->Visible) { // kabupaten_id ?>
	<tr id="r_kabupaten_id">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_kabupaten_id"><?php echo $rekap_bantuan_view->kabupaten_id->caption() ?></span></td>
		<td data-name="kabupaten_id" <?php echo $rekap_bantuan_view->kabupaten_id->cellAttributes() ?>>
<span id="el_rekap_bantuan_kabupaten_id" data-page="2">
<span<?php echo $rekap_bantuan_view->kabupaten_id->viewAttributes() ?>><?php echo $rekap_bantuan_view->kabupaten_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->kecamatan_id->Visible) { // kecamatan_id ?>
	<tr id="r_kecamatan_id">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_kecamatan_id"><?php echo $rekap_bantuan_view->kecamatan_id->caption() ?></span></td>
		<td data-name="kecamatan_id" <?php echo $rekap_bantuan_view->kecamatan_id->cellAttributes() ?>>
<span id="el_rekap_bantuan_kecamatan_id" data-page="2">
<span<?php echo $rekap_bantuan_view->kecamatan_id->viewAttributes() ?>><?php echo $rekap_bantuan_view->kecamatan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->kelurahan_id->Visible) { // kelurahan_id ?>
	<tr id="r_kelurahan_id">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_kelurahan_id"><?php echo $rekap_bantuan_view->kelurahan_id->caption() ?></span></td>
		<td data-name="kelurahan_id" <?php echo $rekap_bantuan_view->kelurahan_id->cellAttributes() ?>>
<span id="el_rekap_bantuan_kelurahan_id" data-page="2">
<span<?php echo $rekap_bantuan_view->kelurahan_id->viewAttributes() ?>><?php echo $rekap_bantuan_view->kelurahan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->rw_id->Visible) { // rw_id ?>
	<tr id="r_rw_id">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_rw_id"><?php echo $rekap_bantuan_view->rw_id->caption() ?></span></td>
		<td data-name="rw_id" <?php echo $rekap_bantuan_view->rw_id->cellAttributes() ?>>
<span id="el_rekap_bantuan_rw_id" data-page="2">
<span<?php echo $rekap_bantuan_view->rw_id->viewAttributes() ?>><?php echo $rekap_bantuan_view->rw_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->rt_id->Visible) { // rt_id ?>
	<tr id="r_rt_id">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_rt_id"><?php echo $rekap_bantuan_view->rt_id->caption() ?></span></td>
		<td data-name="rt_id" <?php echo $rekap_bantuan_view->rt_id->cellAttributes() ?>>
<span id="el_rekap_bantuan_rt_id" data-page="2">
<span<?php echo $rekap_bantuan_view->rt_id->viewAttributes() ?>><?php echo $rekap_bantuan_view->rt_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->alamat_id->Visible) { // alamat_id ?>
	<tr id="r_alamat_id">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_alamat_id"><?php echo $rekap_bantuan_view->alamat_id->caption() ?></span></td>
		<td data-name="alamat_id" <?php echo $rekap_bantuan_view->alamat_id->cellAttributes() ?>>
<span id="el_rekap_bantuan_alamat_id" data-page="2">
<span<?php echo $rekap_bantuan_view->alamat_id->viewAttributes() ?>><?php echo $rekap_bantuan_view->alamat_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekap_bantuan_view->nomor_rumah->Visible) { // nomor_rumah ?>
	<tr id="r_nomor_rumah">
		<td class="<?php echo $rekap_bantuan_view->TableLeftColumnClass ?>"><span id="elh_rekap_bantuan_nomor_rumah"><?php echo $rekap_bantuan_view->nomor_rumah->caption() ?></span></td>
		<td data-name="nomor_rumah" <?php echo $rekap_bantuan_view->nomor_rumah->cellAttributes() ?>>
<span id="el_rekap_bantuan_nomor_rumah" data-page="2">
<span<?php echo $rekap_bantuan_view->nomor_rumah->viewAttributes() ?>><?php echo $rekap_bantuan_view->nomor_rumah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$rekap_bantuan_view->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$rekap_bantuan_view->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$rekap_bantuan_view->IsModal) { ?>
<?php if (!$rekap_bantuan_view->isExport()) { ?>
<?php echo $rekap_bantuan_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$rekap_bantuan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rekap_bantuan_view->isExport()) { ?>
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
$rekap_bantuan_view->terminate();
?>