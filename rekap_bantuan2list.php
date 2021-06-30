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
$rekap_bantuan2_list = new rekap_bantuan2_list();

// Run the page
$rekap_bantuan2_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekap_bantuan2_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rekap_bantuan2_list->isExport()) { ?>
<script>
var frekap_bantuan2list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	frekap_bantuan2list = currentForm = new ew.Form("frekap_bantuan2list", "list");
	frekap_bantuan2list.formKeyCountName = '<?php echo $rekap_bantuan2_list->FormKeyCountName ?>';
	loadjs.done("frekap_bantuan2list");
});
var frekap_bantuan2listsrch;
loadjs.ready("head", function() {

	// Form object for search
	frekap_bantuan2listsrch = currentSearchForm = new ew.Form("frekap_bantuan2listsrch");

	// Validate function for search
	frekap_bantuan2listsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tahun");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekap_bantuan2_list->tahun->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_kecamatan_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekap_bantuan2_list->kecamatan_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_kelurahan_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekap_bantuan2_list->kelurahan_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_rw_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekap_bantuan2_list->rw_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_rt_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekap_bantuan2_list->rt_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_alamat_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekap_bantuan2_list->alamat_id->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	frekap_bantuan2listsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frekap_bantuan2listsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frekap_bantuan2listsrch.lists["x_bansos_id"] = <?php echo $rekap_bantuan2_list->bansos_id->Lookup->toClientList($rekap_bantuan2_list) ?>;
	frekap_bantuan2listsrch.lists["x_bansos_id"].options = <?php echo JsonEncode($rekap_bantuan2_list->bansos_id->lookupOptions()) ?>;
	frekap_bantuan2listsrch.lists["x_jenis_bantuan_id"] = <?php echo $rekap_bantuan2_list->jenis_bantuan_id->Lookup->toClientList($rekap_bantuan2_list) ?>;
	frekap_bantuan2listsrch.lists["x_jenis_bantuan_id"].options = <?php echo JsonEncode($rekap_bantuan2_list->jenis_bantuan_id->lookupOptions()) ?>;
	frekap_bantuan2listsrch.lists["x_type"] = <?php echo $rekap_bantuan2_list->type->Lookup->toClientList($rekap_bantuan2_list) ?>;
	frekap_bantuan2listsrch.lists["x_type"].options = <?php echo JsonEncode($rekap_bantuan2_list->type->options(FALSE, TRUE)) ?>;
	frekap_bantuan2listsrch.lists["x_sumber_bantuan_id"] = <?php echo $rekap_bantuan2_list->sumber_bantuan_id->Lookup->toClientList($rekap_bantuan2_list) ?>;
	frekap_bantuan2listsrch.lists["x_sumber_bantuan_id"].options = <?php echo JsonEncode($rekap_bantuan2_list->sumber_bantuan_id->lookupOptions()) ?>;
	frekap_bantuan2listsrch.lists["x_kecamatan_id"] = <?php echo $rekap_bantuan2_list->kecamatan_id->Lookup->toClientList($rekap_bantuan2_list) ?>;
	frekap_bantuan2listsrch.lists["x_kecamatan_id"].options = <?php echo JsonEncode($rekap_bantuan2_list->kecamatan_id->lookupOptions()) ?>;
	frekap_bantuan2listsrch.autoSuggests["x_kecamatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	frekap_bantuan2listsrch.lists["x_kelurahan_id"] = <?php echo $rekap_bantuan2_list->kelurahan_id->Lookup->toClientList($rekap_bantuan2_list) ?>;
	frekap_bantuan2listsrch.lists["x_kelurahan_id"].options = <?php echo JsonEncode($rekap_bantuan2_list->kelurahan_id->lookupOptions()) ?>;
	frekap_bantuan2listsrch.autoSuggests["x_kelurahan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	frekap_bantuan2listsrch.lists["x_rw_id"] = <?php echo $rekap_bantuan2_list->rw_id->Lookup->toClientList($rekap_bantuan2_list) ?>;
	frekap_bantuan2listsrch.lists["x_rw_id"].options = <?php echo JsonEncode($rekap_bantuan2_list->rw_id->lookupOptions()) ?>;
	frekap_bantuan2listsrch.autoSuggests["x_rw_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	frekap_bantuan2listsrch.lists["x_rt_id"] = <?php echo $rekap_bantuan2_list->rt_id->Lookup->toClientList($rekap_bantuan2_list) ?>;
	frekap_bantuan2listsrch.lists["x_rt_id"].options = <?php echo JsonEncode($rekap_bantuan2_list->rt_id->lookupOptions()) ?>;
	frekap_bantuan2listsrch.autoSuggests["x_rt_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	frekap_bantuan2listsrch.lists["x_alamat_id"] = <?php echo $rekap_bantuan2_list->alamat_id->Lookup->toClientList($rekap_bantuan2_list) ?>;
	frekap_bantuan2listsrch.lists["x_alamat_id"].options = <?php echo JsonEncode($rekap_bantuan2_list->alamat_id->lookupOptions()) ?>;
	frekap_bantuan2listsrch.autoSuggests["x_alamat_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	frekap_bantuan2listsrch.lists["x_status_warga_id"] = <?php echo $rekap_bantuan2_list->status_warga_id->Lookup->toClientList($rekap_bantuan2_list) ?>;
	frekap_bantuan2listsrch.lists["x_status_warga_id"].options = <?php echo JsonEncode($rekap_bantuan2_list->status_warga_id->lookupOptions()) ?>;

	// Filters
	frekap_bantuan2listsrch.filterList = <?php echo $rekap_bantuan2_list->getFilterList() ?>;

	// Init search panel as collapsed
	frekap_bantuan2listsrch.initSearchPanel = true;
	loadjs.done("frekap_bantuan2listsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$rekap_bantuan2_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($rekap_bantuan2_list->TotalRecords > 0 && $rekap_bantuan2_list->ExportOptions->visible()) { ?>
<?php $rekap_bantuan2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->ImportOptions->visible()) { ?>
<?php $rekap_bantuan2_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->SearchOptions->visible()) { ?>
<?php $rekap_bantuan2_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->FilterOptions->visible()) { ?>
<?php $rekap_bantuan2_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$rekap_bantuan2_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$rekap_bantuan2_list->isExport() && !$rekap_bantuan2->CurrentAction) { ?>
<form name="frekap_bantuan2listsrch" id="frekap_bantuan2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="frekap_bantuan2listsrch-search-panel" class="<?php echo $rekap_bantuan2_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="rekap_bantuan2">
	<div class="ew-extended-search">
<?php

// Render search row
$rekap_bantuan2->RowType = ROWTYPE_SEARCH;
$rekap_bantuan2->resetAttributes();
$rekap_bantuan2_list->renderRow();
?>
<?php if ($rekap_bantuan2_list->bansos_id->Visible) { // bansos_id ?>
	<?php
		$rekap_bantuan2_list->SearchColumnCount++;
		if (($rekap_bantuan2_list->SearchColumnCount - 1) % $rekap_bantuan2_list->SearchFieldsPerRow == 0) {
			$rekap_bantuan2_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rekap_bantuan2_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_bansos_id" class="ew-cell form-group">
		<label for="x_bansos_id" class="ew-search-caption ew-label"><?php echo $rekap_bantuan2_list->bansos_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_bansos_id" id="z_bansos_id" value="=">
</span>
		<span id="el_rekap_bantuan2_bansos_id" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_bansos_id"><?php echo EmptyValue(strval($rekap_bantuan2_list->bansos_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $rekap_bantuan2_list->bansos_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekap_bantuan2_list->bansos_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rekap_bantuan2_list->bansos_id->ReadOnly || $rekap_bantuan2_list->bansos_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_bansos_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rekap_bantuan2_list->bansos_id->Lookup->getParamTag($rekap_bantuan2_list, "p_x_bansos_id") ?>
<input type="hidden" data-table="rekap_bantuan2" data-field="x_bansos_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekap_bantuan2_list->bansos_id->displayValueSeparatorAttribute() ?>" name="x_bansos_id" id="x_bansos_id" value="<?php echo $rekap_bantuan2_list->bansos_id->AdvancedSearch->SearchValue ?>"<?php echo $rekap_bantuan2_list->bansos_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($rekap_bantuan2_list->SearchColumnCount % $rekap_bantuan2_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
	<?php
		$rekap_bantuan2_list->SearchColumnCount++;
		if (($rekap_bantuan2_list->SearchColumnCount - 1) % $rekap_bantuan2_list->SearchFieldsPerRow == 0) {
			$rekap_bantuan2_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rekap_bantuan2_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_jenis_bantuan_id" class="ew-cell form-group">
		<label for="x_jenis_bantuan_id" class="ew-search-caption ew-label"><?php echo $rekap_bantuan2_list->jenis_bantuan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jenis_bantuan_id" id="z_jenis_bantuan_id" value="=">
</span>
		<span id="el_rekap_bantuan2_jenis_bantuan_id" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="rekap_bantuan2" data-field="x_jenis_bantuan_id" data-value-separator="<?php echo $rekap_bantuan2_list->jenis_bantuan_id->displayValueSeparatorAttribute() ?>" id="x_jenis_bantuan_id" name="x_jenis_bantuan_id"<?php echo $rekap_bantuan2_list->jenis_bantuan_id->editAttributes() ?>>
			<?php echo $rekap_bantuan2_list->jenis_bantuan_id->selectOptionListHtml("x_jenis_bantuan_id") ?>
		</select>
</div>
<?php echo $rekap_bantuan2_list->jenis_bantuan_id->Lookup->getParamTag($rekap_bantuan2_list, "p_x_jenis_bantuan_id") ?>
</span>
	</div>
	<?php if ($rekap_bantuan2_list->SearchColumnCount % $rekap_bantuan2_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->type->Visible) { // type ?>
	<?php
		$rekap_bantuan2_list->SearchColumnCount++;
		if (($rekap_bantuan2_list->SearchColumnCount - 1) % $rekap_bantuan2_list->SearchFieldsPerRow == 0) {
			$rekap_bantuan2_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rekap_bantuan2_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_type" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $rekap_bantuan2_list->type->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_type" id="z_type" value="=">
</span>
		<span id="el_rekap_bantuan2_type" class="ew-search-field">
<div id="tp_x_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="rekap_bantuan2" data-field="x_type" data-value-separator="<?php echo $rekap_bantuan2_list->type->displayValueSeparatorAttribute() ?>" name="x_type" id="x_type" value="{value}"<?php echo $rekap_bantuan2_list->type->editAttributes() ?>></div>
<div id="dsl_x_type" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $rekap_bantuan2_list->type->radioButtonListHtml(FALSE, "x_type") ?>
</div></div>
</span>
	</div>
	<?php if ($rekap_bantuan2_list->SearchColumnCount % $rekap_bantuan2_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
	<?php
		$rekap_bantuan2_list->SearchColumnCount++;
		if (($rekap_bantuan2_list->SearchColumnCount - 1) % $rekap_bantuan2_list->SearchFieldsPerRow == 0) {
			$rekap_bantuan2_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rekap_bantuan2_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_sumber_bantuan_id" class="ew-cell form-group">
		<label for="x_sumber_bantuan_id" class="ew-search-caption ew-label"><?php echo $rekap_bantuan2_list->sumber_bantuan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_sumber_bantuan_id" id="z_sumber_bantuan_id" value="=">
</span>
		<span id="el_rekap_bantuan2_sumber_bantuan_id" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_sumber_bantuan_id"><?php echo EmptyValue(strval($rekap_bantuan2_list->sumber_bantuan_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $rekap_bantuan2_list->sumber_bantuan_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekap_bantuan2_list->sumber_bantuan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rekap_bantuan2_list->sumber_bantuan_id->ReadOnly || $rekap_bantuan2_list->sumber_bantuan_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_sumber_bantuan_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rekap_bantuan2_list->sumber_bantuan_id->Lookup->getParamTag($rekap_bantuan2_list, "p_x_sumber_bantuan_id") ?>
<input type="hidden" data-table="rekap_bantuan2" data-field="x_sumber_bantuan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekap_bantuan2_list->sumber_bantuan_id->displayValueSeparatorAttribute() ?>" name="x_sumber_bantuan_id" id="x_sumber_bantuan_id" value="<?php echo $rekap_bantuan2_list->sumber_bantuan_id->AdvancedSearch->SearchValue ?>"<?php echo $rekap_bantuan2_list->sumber_bantuan_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($rekap_bantuan2_list->SearchColumnCount % $rekap_bantuan2_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->tahun->Visible) { // tahun ?>
	<?php
		$rekap_bantuan2_list->SearchColumnCount++;
		if (($rekap_bantuan2_list->SearchColumnCount - 1) % $rekap_bantuan2_list->SearchFieldsPerRow == 0) {
			$rekap_bantuan2_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rekap_bantuan2_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun" class="ew-cell form-group">
		<label for="x_tahun" class="ew-search-caption ew-label"><?php echo $rekap_bantuan2_list->tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun" id="z_tahun" value="=">
</span>
		<span id="el_rekap_bantuan2_tahun" class="ew-search-field">
<input type="text" data-table="rekap_bantuan2" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($rekap_bantuan2_list->tahun->getPlaceHolder()) ?>" value="<?php echo $rekap_bantuan2_list->tahun->EditValue ?>"<?php echo $rekap_bantuan2_list->tahun->editAttributes() ?>>
</span>
	</div>
	<?php if ($rekap_bantuan2_list->SearchColumnCount % $rekap_bantuan2_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->kecamatan_id->Visible) { // kecamatan_id ?>
	<?php
		$rekap_bantuan2_list->SearchColumnCount++;
		if (($rekap_bantuan2_list->SearchColumnCount - 1) % $rekap_bantuan2_list->SearchFieldsPerRow == 0) {
			$rekap_bantuan2_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rekap_bantuan2_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kecamatan_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $rekap_bantuan2_list->kecamatan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kecamatan_id" id="z_kecamatan_id" value="=">
</span>
		<span id="el_rekap_bantuan2_kecamatan_id" class="ew-search-field">
<?php
$onchange = $rekap_bantuan2_list->kecamatan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$rekap_bantuan2_list->kecamatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kecamatan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kecamatan_id" id="sv_x_kecamatan_id" value="<?php echo RemoveHtml($rekap_bantuan2_list->kecamatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($rekap_bantuan2_list->kecamatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($rekap_bantuan2_list->kecamatan_id->getPlaceHolder()) ?>"<?php echo $rekap_bantuan2_list->kecamatan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekap_bantuan2_list->kecamatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kecamatan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($rekap_bantuan2_list->kecamatan_id->ReadOnly || $rekap_bantuan2_list->kecamatan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="rekap_bantuan2" data-field="x_kecamatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekap_bantuan2_list->kecamatan_id->displayValueSeparatorAttribute() ?>" name="x_kecamatan_id" id="x_kecamatan_id" value="<?php echo HtmlEncode($rekap_bantuan2_list->kecamatan_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["frekap_bantuan2listsrch"], function() {
	frekap_bantuan2listsrch.createAutoSuggest({"id":"x_kecamatan_id","forceSelect":true});
});
</script>
<?php echo $rekap_bantuan2_list->kecamatan_id->Lookup->getParamTag($rekap_bantuan2_list, "p_x_kecamatan_id") ?>
</span>
	</div>
	<?php if ($rekap_bantuan2_list->SearchColumnCount % $rekap_bantuan2_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->kelurahan_id->Visible) { // kelurahan_id ?>
	<?php
		$rekap_bantuan2_list->SearchColumnCount++;
		if (($rekap_bantuan2_list->SearchColumnCount - 1) % $rekap_bantuan2_list->SearchFieldsPerRow == 0) {
			$rekap_bantuan2_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rekap_bantuan2_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kelurahan_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $rekap_bantuan2_list->kelurahan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kelurahan_id" id="z_kelurahan_id" value="=">
</span>
		<span id="el_rekap_bantuan2_kelurahan_id" class="ew-search-field">
<?php
$onchange = $rekap_bantuan2_list->kelurahan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$rekap_bantuan2_list->kelurahan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kelurahan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kelurahan_id" id="sv_x_kelurahan_id" value="<?php echo RemoveHtml($rekap_bantuan2_list->kelurahan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($rekap_bantuan2_list->kelurahan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($rekap_bantuan2_list->kelurahan_id->getPlaceHolder()) ?>"<?php echo $rekap_bantuan2_list->kelurahan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekap_bantuan2_list->kelurahan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kelurahan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($rekap_bantuan2_list->kelurahan_id->ReadOnly || $rekap_bantuan2_list->kelurahan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="rekap_bantuan2" data-field="x_kelurahan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekap_bantuan2_list->kelurahan_id->displayValueSeparatorAttribute() ?>" name="x_kelurahan_id" id="x_kelurahan_id" value="<?php echo HtmlEncode($rekap_bantuan2_list->kelurahan_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["frekap_bantuan2listsrch"], function() {
	frekap_bantuan2listsrch.createAutoSuggest({"id":"x_kelurahan_id","forceSelect":true});
});
</script>
<?php echo $rekap_bantuan2_list->kelurahan_id->Lookup->getParamTag($rekap_bantuan2_list, "p_x_kelurahan_id") ?>
</span>
	</div>
	<?php if ($rekap_bantuan2_list->SearchColumnCount % $rekap_bantuan2_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->rw_id->Visible) { // rw_id ?>
	<?php
		$rekap_bantuan2_list->SearchColumnCount++;
		if (($rekap_bantuan2_list->SearchColumnCount - 1) % $rekap_bantuan2_list->SearchFieldsPerRow == 0) {
			$rekap_bantuan2_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rekap_bantuan2_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_rw_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $rekap_bantuan2_list->rw_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_rw_id" id="z_rw_id" value="=">
</span>
		<span id="el_rekap_bantuan2_rw_id" class="ew-search-field">
<?php
$onchange = $rekap_bantuan2_list->rw_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$rekap_bantuan2_list->rw_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_rw_id">
	<input type="text" class="form-control" name="sv_x_rw_id" id="sv_x_rw_id" value="<?php echo RemoveHtml($rekap_bantuan2_list->rw_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($rekap_bantuan2_list->rw_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($rekap_bantuan2_list->rw_id->getPlaceHolder()) ?>"<?php echo $rekap_bantuan2_list->rw_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="rekap_bantuan2" data-field="x_rw_id" data-value-separator="<?php echo $rekap_bantuan2_list->rw_id->displayValueSeparatorAttribute() ?>" name="x_rw_id" id="x_rw_id" value="<?php echo HtmlEncode($rekap_bantuan2_list->rw_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["frekap_bantuan2listsrch"], function() {
	frekap_bantuan2listsrch.createAutoSuggest({"id":"x_rw_id","forceSelect":true});
});
</script>
<?php echo $rekap_bantuan2_list->rw_id->Lookup->getParamTag($rekap_bantuan2_list, "p_x_rw_id") ?>
</span>
	</div>
	<?php if ($rekap_bantuan2_list->SearchColumnCount % $rekap_bantuan2_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->rt_id->Visible) { // rt_id ?>
	<?php
		$rekap_bantuan2_list->SearchColumnCount++;
		if (($rekap_bantuan2_list->SearchColumnCount - 1) % $rekap_bantuan2_list->SearchFieldsPerRow == 0) {
			$rekap_bantuan2_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rekap_bantuan2_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_rt_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $rekap_bantuan2_list->rt_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_rt_id" id="z_rt_id" value="=">
</span>
		<span id="el_rekap_bantuan2_rt_id" class="ew-search-field">
<?php
$onchange = $rekap_bantuan2_list->rt_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$rekap_bantuan2_list->rt_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_rt_id">
	<input type="text" class="form-control" name="sv_x_rt_id" id="sv_x_rt_id" value="<?php echo RemoveHtml($rekap_bantuan2_list->rt_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($rekap_bantuan2_list->rt_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($rekap_bantuan2_list->rt_id->getPlaceHolder()) ?>"<?php echo $rekap_bantuan2_list->rt_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="rekap_bantuan2" data-field="x_rt_id" data-value-separator="<?php echo $rekap_bantuan2_list->rt_id->displayValueSeparatorAttribute() ?>" name="x_rt_id" id="x_rt_id" value="<?php echo HtmlEncode($rekap_bantuan2_list->rt_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["frekap_bantuan2listsrch"], function() {
	frekap_bantuan2listsrch.createAutoSuggest({"id":"x_rt_id","forceSelect":true});
});
</script>
<?php echo $rekap_bantuan2_list->rt_id->Lookup->getParamTag($rekap_bantuan2_list, "p_x_rt_id") ?>
</span>
	</div>
	<?php if ($rekap_bantuan2_list->SearchColumnCount % $rekap_bantuan2_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->alamat_id->Visible) { // alamat_id ?>
	<?php
		$rekap_bantuan2_list->SearchColumnCount++;
		if (($rekap_bantuan2_list->SearchColumnCount - 1) % $rekap_bantuan2_list->SearchFieldsPerRow == 0) {
			$rekap_bantuan2_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rekap_bantuan2_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_alamat_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $rekap_bantuan2_list->alamat_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_alamat_id" id="z_alamat_id" value="=">
</span>
		<span id="el_rekap_bantuan2_alamat_id" class="ew-search-field">
<?php
$onchange = $rekap_bantuan2_list->alamat_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$rekap_bantuan2_list->alamat_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_alamat_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_alamat_id" id="sv_x_alamat_id" value="<?php echo RemoveHtml($rekap_bantuan2_list->alamat_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($rekap_bantuan2_list->alamat_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($rekap_bantuan2_list->alamat_id->getPlaceHolder()) ?>"<?php echo $rekap_bantuan2_list->alamat_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekap_bantuan2_list->alamat_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_alamat_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($rekap_bantuan2_list->alamat_id->ReadOnly || $rekap_bantuan2_list->alamat_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="rekap_bantuan2" data-field="x_alamat_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekap_bantuan2_list->alamat_id->displayValueSeparatorAttribute() ?>" name="x_alamat_id" id="x_alamat_id" value="<?php echo HtmlEncode($rekap_bantuan2_list->alamat_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["frekap_bantuan2listsrch"], function() {
	frekap_bantuan2listsrch.createAutoSuggest({"id":"x_alamat_id","forceSelect":true});
});
</script>
<?php echo $rekap_bantuan2_list->alamat_id->Lookup->getParamTag($rekap_bantuan2_list, "p_x_alamat_id") ?>
</span>
	</div>
	<?php if ($rekap_bantuan2_list->SearchColumnCount % $rekap_bantuan2_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->status_warga_id->Visible) { // status_warga_id ?>
	<?php
		$rekap_bantuan2_list->SearchColumnCount++;
		if (($rekap_bantuan2_list->SearchColumnCount - 1) % $rekap_bantuan2_list->SearchFieldsPerRow == 0) {
			$rekap_bantuan2_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rekap_bantuan2_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_status_warga_id" class="ew-cell form-group">
		<label for="x_status_warga_id" class="ew-search-caption ew-label"><?php echo $rekap_bantuan2_list->status_warga_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_status_warga_id" id="z_status_warga_id" value="=">
</span>
		<span id="el_rekap_bantuan2_status_warga_id" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($rekap_bantuan2_list->status_warga_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $rekap_bantuan2_list->status_warga_id->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_status_warga_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $rekap_bantuan2_list->status_warga_id->radioButtonListHtml(TRUE, "x_status_warga_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_status_warga_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="rekap_bantuan2" data-field="x_status_warga_id" data-value-separator="<?php echo $rekap_bantuan2_list->status_warga_id->displayValueSeparatorAttribute() ?>" name="x_status_warga_id" id="x_status_warga_id" value="{value}"<?php echo $rekap_bantuan2_list->status_warga_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$rekap_bantuan2_list->status_warga_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $rekap_bantuan2_list->status_warga_id->Lookup->getParamTag($rekap_bantuan2_list, "p_x_status_warga_id") ?>
</span>
	</div>
	<?php if ($rekap_bantuan2_list->SearchColumnCount % $rekap_bantuan2_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($rekap_bantuan2_list->SearchColumnCount % $rekap_bantuan2_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $rekap_bantuan2_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($rekap_bantuan2_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($rekap_bantuan2_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $rekap_bantuan2_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($rekap_bantuan2_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($rekap_bantuan2_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($rekap_bantuan2_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($rekap_bantuan2_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $rekap_bantuan2_list->showPageHeader(); ?>
<?php
$rekap_bantuan2_list->showMessage();
?>
<?php if ($rekap_bantuan2_list->TotalRecords > 0 || $rekap_bantuan2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($rekap_bantuan2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rekap_bantuan2">
<?php if (!$rekap_bantuan2_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$rekap_bantuan2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rekap_bantuan2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rekap_bantuan2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="frekap_bantuan2list" id="frekap_bantuan2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekap_bantuan2">
<div id="gmp_rekap_bantuan2" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($rekap_bantuan2_list->TotalRecords > 0 || $rekap_bantuan2_list->isGridEdit()) { ?>
<table id="tbl_rekap_bantuan2list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$rekap_bantuan2->RowType = ROWTYPE_HEADER;

// Render list options
$rekap_bantuan2_list->renderListOptions();

// Render list options (header, left)
$rekap_bantuan2_list->ListOptions->render("header", "left");
?>
<?php if ($rekap_bantuan2_list->id->Visible) { // id ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $rekap_bantuan2_list->id->headerCellClass() ?>"><div id="elh_rekap_bantuan2_id" class="rekap_bantuan2_id"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $rekap_bantuan2_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->id) ?>', 1);"><div id="elh_rekap_bantuan2_id" class="rekap_bantuan2_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->bansos_id->Visible) { // bansos_id ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->bansos_id) == "") { ?>
		<th data-name="bansos_id" class="<?php echo $rekap_bantuan2_list->bansos_id->headerCellClass() ?>"><div id="elh_rekap_bantuan2_bansos_id" class="rekap_bantuan2_bansos_id"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->bansos_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bansos_id" class="<?php echo $rekap_bantuan2_list->bansos_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->bansos_id) ?>', 1);"><div id="elh_rekap_bantuan2_bansos_id" class="rekap_bantuan2_bansos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->bansos_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->bansos_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->bansos_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->jenis_bantuan_id) == "") { ?>
		<th data-name="jenis_bantuan_id" class="<?php echo $rekap_bantuan2_list->jenis_bantuan_id->headerCellClass() ?>"><div id="elh_rekap_bantuan2_jenis_bantuan_id" class="rekap_bantuan2_jenis_bantuan_id"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->jenis_bantuan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_bantuan_id" class="<?php echo $rekap_bantuan2_list->jenis_bantuan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->jenis_bantuan_id) ?>', 1);"><div id="elh_rekap_bantuan2_jenis_bantuan_id" class="rekap_bantuan2_jenis_bantuan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->jenis_bantuan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->jenis_bantuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->jenis_bantuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->type->Visible) { // type ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->type) == "") { ?>
		<th data-name="type" class="<?php echo $rekap_bantuan2_list->type->headerCellClass() ?>"><div id="elh_rekap_bantuan2_type" class="rekap_bantuan2_type"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type" class="<?php echo $rekap_bantuan2_list->type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->type) ?>', 1);"><div id="elh_rekap_bantuan2_type" class="rekap_bantuan2_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->type->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->jumlah->Visible) { // jumlah ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $rekap_bantuan2_list->jumlah->headerCellClass() ?>"><div id="elh_rekap_bantuan2_jumlah" class="rekap_bantuan2_jumlah"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $rekap_bantuan2_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->jumlah) ?>', 1);"><div id="elh_rekap_bantuan2_jumlah" class="rekap_bantuan2_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->jumlah->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->sumber_bantuan_id) == "") { ?>
		<th data-name="sumber_bantuan_id" class="<?php echo $rekap_bantuan2_list->sumber_bantuan_id->headerCellClass() ?>"><div id="elh_rekap_bantuan2_sumber_bantuan_id" class="rekap_bantuan2_sumber_bantuan_id"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->sumber_bantuan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sumber_bantuan_id" class="<?php echo $rekap_bantuan2_list->sumber_bantuan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->sumber_bantuan_id) ?>', 1);"><div id="elh_rekap_bantuan2_sumber_bantuan_id" class="rekap_bantuan2_sumber_bantuan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->sumber_bantuan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->sumber_bantuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->sumber_bantuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->pengambilan_bantuuan_id->Visible) { // pengambilan_bantuuan_id ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->pengambilan_bantuuan_id) == "") { ?>
		<th data-name="pengambilan_bantuuan_id" class="<?php echo $rekap_bantuan2_list->pengambilan_bantuuan_id->headerCellClass() ?>"><div id="elh_rekap_bantuan2_pengambilan_bantuuan_id" class="rekap_bantuan2_pengambilan_bantuuan_id"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->pengambilan_bantuuan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pengambilan_bantuuan_id" class="<?php echo $rekap_bantuan2_list->pengambilan_bantuuan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->pengambilan_bantuuan_id) ?>', 1);"><div id="elh_rekap_bantuan2_pengambilan_bantuuan_id" class="rekap_bantuan2_pengambilan_bantuuan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->pengambilan_bantuuan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->pengambilan_bantuuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->pengambilan_bantuuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->frekuensi->Visible) { // frekuensi ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->frekuensi) == "") { ?>
		<th data-name="frekuensi" class="<?php echo $rekap_bantuan2_list->frekuensi->headerCellClass() ?>"><div id="elh_rekap_bantuan2_frekuensi" class="rekap_bantuan2_frekuensi"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->frekuensi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="frekuensi" class="<?php echo $rekap_bantuan2_list->frekuensi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->frekuensi) ?>', 1);"><div id="elh_rekap_bantuan2_frekuensi" class="rekap_bantuan2_frekuensi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->frekuensi->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->frekuensi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->frekuensi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->bulan->Visible) { // bulan ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $rekap_bantuan2_list->bulan->headerCellClass() ?>"><div id="elh_rekap_bantuan2_bulan" class="rekap_bantuan2_bulan"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $rekap_bantuan2_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->bulan) ?>', 1);"><div id="elh_rekap_bantuan2_bulan" class="rekap_bantuan2_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->bulan->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->tahun->Visible) { // tahun ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $rekap_bantuan2_list->tahun->headerCellClass() ?>"><div id="elh_rekap_bantuan2_tahun" class="rekap_bantuan2_tahun"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $rekap_bantuan2_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->tahun) ?>', 1);"><div id="elh_rekap_bantuan2_tahun" class="rekap_bantuan2_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->status->Visible) { // status ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $rekap_bantuan2_list->status->headerCellClass() ?>"><div id="elh_rekap_bantuan2_status" class="rekap_bantuan2_status"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $rekap_bantuan2_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->status) ?>', 1);"><div id="elh_rekap_bantuan2_status" class="rekap_bantuan2_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->kk->Visible) { // kk ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->kk) == "") { ?>
		<th data-name="kk" class="<?php echo $rekap_bantuan2_list->kk->headerCellClass() ?>"><div id="elh_rekap_bantuan2_kk" class="rekap_bantuan2_kk"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->kk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kk" class="<?php echo $rekap_bantuan2_list->kk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->kk) ?>', 1);"><div id="elh_rekap_bantuan2_kk" class="rekap_bantuan2_kk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->kk->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->kk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->kk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->nik->Visible) { // nik ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->nik) == "") { ?>
		<th data-name="nik" class="<?php echo $rekap_bantuan2_list->nik->headerCellClass() ?>"><div id="elh_rekap_bantuan2_nik" class="rekap_bantuan2_nik"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->nik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nik" class="<?php echo $rekap_bantuan2_list->nik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->nik) ?>', 1);"><div id="elh_rekap_bantuan2_nik" class="rekap_bantuan2_nik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->nik->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->nik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->nik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->nama->Visible) { // nama ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $rekap_bantuan2_list->nama->headerCellClass() ?>"><div id="elh_rekap_bantuan2_nama" class="rekap_bantuan2_nama"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $rekap_bantuan2_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->nama) ?>', 1);"><div id="elh_rekap_bantuan2_nama" class="rekap_bantuan2_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->kecamatan_id->Visible) { // kecamatan_id ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->kecamatan_id) == "") { ?>
		<th data-name="kecamatan_id" class="<?php echo $rekap_bantuan2_list->kecamatan_id->headerCellClass() ?>"><div id="elh_rekap_bantuan2_kecamatan_id" class="rekap_bantuan2_kecamatan_id"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->kecamatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kecamatan_id" class="<?php echo $rekap_bantuan2_list->kecamatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->kecamatan_id) ?>', 1);"><div id="elh_rekap_bantuan2_kecamatan_id" class="rekap_bantuan2_kecamatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->kecamatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->kecamatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->kecamatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->kelurahan_id->Visible) { // kelurahan_id ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->kelurahan_id) == "") { ?>
		<th data-name="kelurahan_id" class="<?php echo $rekap_bantuan2_list->kelurahan_id->headerCellClass() ?>"><div id="elh_rekap_bantuan2_kelurahan_id" class="rekap_bantuan2_kelurahan_id"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->kelurahan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kelurahan_id" class="<?php echo $rekap_bantuan2_list->kelurahan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->kelurahan_id) ?>', 1);"><div id="elh_rekap_bantuan2_kelurahan_id" class="rekap_bantuan2_kelurahan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->kelurahan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->kelurahan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->kelurahan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->rw_id->Visible) { // rw_id ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->rw_id) == "") { ?>
		<th data-name="rw_id" class="<?php echo $rekap_bantuan2_list->rw_id->headerCellClass() ?>"><div id="elh_rekap_bantuan2_rw_id" class="rekap_bantuan2_rw_id"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->rw_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rw_id" class="<?php echo $rekap_bantuan2_list->rw_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->rw_id) ?>', 1);"><div id="elh_rekap_bantuan2_rw_id" class="rekap_bantuan2_rw_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->rw_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->rw_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->rw_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->rt_id->Visible) { // rt_id ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->rt_id) == "") { ?>
		<th data-name="rt_id" class="<?php echo $rekap_bantuan2_list->rt_id->headerCellClass() ?>"><div id="elh_rekap_bantuan2_rt_id" class="rekap_bantuan2_rt_id"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->rt_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rt_id" class="<?php echo $rekap_bantuan2_list->rt_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->rt_id) ?>', 1);"><div id="elh_rekap_bantuan2_rt_id" class="rekap_bantuan2_rt_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->rt_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->rt_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->rt_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->alamat_id->Visible) { // alamat_id ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->alamat_id) == "") { ?>
		<th data-name="alamat_id" class="<?php echo $rekap_bantuan2_list->alamat_id->headerCellClass() ?>"><div id="elh_rekap_bantuan2_alamat_id" class="rekap_bantuan2_alamat_id"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->alamat_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alamat_id" class="<?php echo $rekap_bantuan2_list->alamat_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->alamat_id) ?>', 1);"><div id="elh_rekap_bantuan2_alamat_id" class="rekap_bantuan2_alamat_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->alamat_id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->alamat_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->alamat_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->nomor_rumah->Visible) { // nomor_rumah ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->nomor_rumah) == "") { ?>
		<th data-name="nomor_rumah" class="<?php echo $rekap_bantuan2_list->nomor_rumah->headerCellClass() ?>"><div id="elh_rekap_bantuan2_nomor_rumah" class="rekap_bantuan2_nomor_rumah"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->nomor_rumah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nomor_rumah" class="<?php echo $rekap_bantuan2_list->nomor_rumah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->nomor_rumah) ?>', 1);"><div id="elh_rekap_bantuan2_nomor_rumah" class="rekap_bantuan2_nomor_rumah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->nomor_rumah->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->nomor_rumah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->nomor_rumah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekap_bantuan2_list->status_warga_id->Visible) { // status_warga_id ?>
	<?php if ($rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->status_warga_id) == "") { ?>
		<th data-name="status_warga_id" class="<?php echo $rekap_bantuan2_list->status_warga_id->headerCellClass() ?>"><div id="elh_rekap_bantuan2_status_warga_id" class="rekap_bantuan2_status_warga_id"><div class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->status_warga_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_warga_id" class="<?php echo $rekap_bantuan2_list->status_warga_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekap_bantuan2_list->SortUrl($rekap_bantuan2_list->status_warga_id) ?>', 1);"><div id="elh_rekap_bantuan2_status_warga_id" class="rekap_bantuan2_status_warga_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekap_bantuan2_list->status_warga_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekap_bantuan2_list->status_warga_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekap_bantuan2_list->status_warga_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rekap_bantuan2_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rekap_bantuan2_list->ExportAll && $rekap_bantuan2_list->isExport()) {
	$rekap_bantuan2_list->StopRecord = $rekap_bantuan2_list->TotalRecords;
} else {

	// Set the last record to display
	if ($rekap_bantuan2_list->TotalRecords > $rekap_bantuan2_list->StartRecord + $rekap_bantuan2_list->DisplayRecords - 1)
		$rekap_bantuan2_list->StopRecord = $rekap_bantuan2_list->StartRecord + $rekap_bantuan2_list->DisplayRecords - 1;
	else
		$rekap_bantuan2_list->StopRecord = $rekap_bantuan2_list->TotalRecords;
}
$rekap_bantuan2_list->RecordCount = $rekap_bantuan2_list->StartRecord - 1;
if ($rekap_bantuan2_list->Recordset && !$rekap_bantuan2_list->Recordset->EOF) {
	$rekap_bantuan2_list->Recordset->moveFirst();
	$selectLimit = $rekap_bantuan2_list->UseSelectLimit;
	if (!$selectLimit && $rekap_bantuan2_list->StartRecord > 1)
		$rekap_bantuan2_list->Recordset->move($rekap_bantuan2_list->StartRecord - 1);
} elseif (!$rekap_bantuan2->AllowAddDeleteRow && $rekap_bantuan2_list->StopRecord == 0) {
	$rekap_bantuan2_list->StopRecord = $rekap_bantuan2->GridAddRowCount;
}

// Initialize aggregate
$rekap_bantuan2->RowType = ROWTYPE_AGGREGATEINIT;
$rekap_bantuan2->resetAttributes();
$rekap_bantuan2_list->renderRow();
while ($rekap_bantuan2_list->RecordCount < $rekap_bantuan2_list->StopRecord) {
	$rekap_bantuan2_list->RecordCount++;
	if ($rekap_bantuan2_list->RecordCount >= $rekap_bantuan2_list->StartRecord) {
		$rekap_bantuan2_list->RowCount++;

		// Set up key count
		$rekap_bantuan2_list->KeyCount = $rekap_bantuan2_list->RowIndex;

		// Init row class and style
		$rekap_bantuan2->resetAttributes();
		$rekap_bantuan2->CssClass = "";
		if ($rekap_bantuan2_list->isGridAdd()) {
		} else {
			$rekap_bantuan2_list->loadRowValues($rekap_bantuan2_list->Recordset); // Load row values
		}
		$rekap_bantuan2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$rekap_bantuan2->RowAttrs->merge(["data-rowindex" => $rekap_bantuan2_list->RowCount, "id" => "r" . $rekap_bantuan2_list->RowCount . "_rekap_bantuan2", "data-rowtype" => $rekap_bantuan2->RowType]);

		// Render row
		$rekap_bantuan2_list->renderRow();

		// Render list options
		$rekap_bantuan2_list->renderListOptions();
?>
	<tr <?php echo $rekap_bantuan2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rekap_bantuan2_list->ListOptions->render("body", "left", $rekap_bantuan2_list->RowCount);
?>
	<?php if ($rekap_bantuan2_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $rekap_bantuan2_list->id->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_id">
<span<?php echo $rekap_bantuan2_list->id->viewAttributes() ?>><?php echo $rekap_bantuan2_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->bansos_id->Visible) { // bansos_id ?>
		<td data-name="bansos_id" <?php echo $rekap_bantuan2_list->bansos_id->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_bansos_id">
<span<?php echo $rekap_bantuan2_list->bansos_id->viewAttributes() ?>><?php echo $rekap_bantuan2_list->bansos_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
		<td data-name="jenis_bantuan_id" <?php echo $rekap_bantuan2_list->jenis_bantuan_id->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_jenis_bantuan_id">
<span<?php echo $rekap_bantuan2_list->jenis_bantuan_id->viewAttributes() ?>><?php echo $rekap_bantuan2_list->jenis_bantuan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->type->Visible) { // type ?>
		<td data-name="type" <?php echo $rekap_bantuan2_list->type->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_type">
<span<?php echo $rekap_bantuan2_list->type->viewAttributes() ?>><?php echo $rekap_bantuan2_list->type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $rekap_bantuan2_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_jumlah">
<span<?php echo $rekap_bantuan2_list->jumlah->viewAttributes() ?>><?php echo $rekap_bantuan2_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
		<td data-name="sumber_bantuan_id" <?php echo $rekap_bantuan2_list->sumber_bantuan_id->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_sumber_bantuan_id">
<span<?php echo $rekap_bantuan2_list->sumber_bantuan_id->viewAttributes() ?>><?php echo $rekap_bantuan2_list->sumber_bantuan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->pengambilan_bantuuan_id->Visible) { // pengambilan_bantuuan_id ?>
		<td data-name="pengambilan_bantuuan_id" <?php echo $rekap_bantuan2_list->pengambilan_bantuuan_id->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_pengambilan_bantuuan_id">
<span<?php echo $rekap_bantuan2_list->pengambilan_bantuuan_id->viewAttributes() ?>><?php echo $rekap_bantuan2_list->pengambilan_bantuuan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->frekuensi->Visible) { // frekuensi ?>
		<td data-name="frekuensi" <?php echo $rekap_bantuan2_list->frekuensi->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_frekuensi">
<span<?php echo $rekap_bantuan2_list->frekuensi->viewAttributes() ?>><?php echo $rekap_bantuan2_list->frekuensi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $rekap_bantuan2_list->bulan->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_bulan">
<span<?php echo $rekap_bantuan2_list->bulan->viewAttributes() ?>><?php echo $rekap_bantuan2_list->bulan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $rekap_bantuan2_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_tahun">
<span<?php echo $rekap_bantuan2_list->tahun->viewAttributes() ?>><?php echo $rekap_bantuan2_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $rekap_bantuan2_list->status->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_status">
<span<?php echo $rekap_bantuan2_list->status->viewAttributes() ?>><?php echo $rekap_bantuan2_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->kk->Visible) { // kk ?>
		<td data-name="kk" <?php echo $rekap_bantuan2_list->kk->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_kk">
<span<?php echo $rekap_bantuan2_list->kk->viewAttributes() ?>><?php echo $rekap_bantuan2_list->kk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->nik->Visible) { // nik ?>
		<td data-name="nik" <?php echo $rekap_bantuan2_list->nik->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_nik">
<span<?php echo $rekap_bantuan2_list->nik->viewAttributes() ?>><?php echo $rekap_bantuan2_list->nik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $rekap_bantuan2_list->nama->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_nama">
<span<?php echo $rekap_bantuan2_list->nama->viewAttributes() ?>><?php echo $rekap_bantuan2_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->kecamatan_id->Visible) { // kecamatan_id ?>
		<td data-name="kecamatan_id" <?php echo $rekap_bantuan2_list->kecamatan_id->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_kecamatan_id">
<span<?php echo $rekap_bantuan2_list->kecamatan_id->viewAttributes() ?>><?php echo $rekap_bantuan2_list->kecamatan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->kelurahan_id->Visible) { // kelurahan_id ?>
		<td data-name="kelurahan_id" <?php echo $rekap_bantuan2_list->kelurahan_id->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_kelurahan_id">
<span<?php echo $rekap_bantuan2_list->kelurahan_id->viewAttributes() ?>><?php echo $rekap_bantuan2_list->kelurahan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->rw_id->Visible) { // rw_id ?>
		<td data-name="rw_id" <?php echo $rekap_bantuan2_list->rw_id->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_rw_id">
<span<?php echo $rekap_bantuan2_list->rw_id->viewAttributes() ?>><?php echo $rekap_bantuan2_list->rw_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->rt_id->Visible) { // rt_id ?>
		<td data-name="rt_id" <?php echo $rekap_bantuan2_list->rt_id->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_rt_id">
<span<?php echo $rekap_bantuan2_list->rt_id->viewAttributes() ?>><?php echo $rekap_bantuan2_list->rt_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->alamat_id->Visible) { // alamat_id ?>
		<td data-name="alamat_id" <?php echo $rekap_bantuan2_list->alamat_id->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_alamat_id">
<span<?php echo $rekap_bantuan2_list->alamat_id->viewAttributes() ?>><?php echo $rekap_bantuan2_list->alamat_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->nomor_rumah->Visible) { // nomor_rumah ?>
		<td data-name="nomor_rumah" <?php echo $rekap_bantuan2_list->nomor_rumah->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_nomor_rumah">
<span<?php echo $rekap_bantuan2_list->nomor_rumah->viewAttributes() ?>><?php echo $rekap_bantuan2_list->nomor_rumah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekap_bantuan2_list->status_warga_id->Visible) { // status_warga_id ?>
		<td data-name="status_warga_id" <?php echo $rekap_bantuan2_list->status_warga_id->cellAttributes() ?>>
<span id="el<?php echo $rekap_bantuan2_list->RowCount ?>_rekap_bantuan2_status_warga_id">
<span<?php echo $rekap_bantuan2_list->status_warga_id->viewAttributes() ?>><?php echo $rekap_bantuan2_list->status_warga_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rekap_bantuan2_list->ListOptions->render("body", "right", $rekap_bantuan2_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$rekap_bantuan2_list->isGridAdd())
		$rekap_bantuan2_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$rekap_bantuan2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($rekap_bantuan2_list->Recordset)
	$rekap_bantuan2_list->Recordset->Close();
?>
<?php if (!$rekap_bantuan2_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$rekap_bantuan2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rekap_bantuan2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rekap_bantuan2_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($rekap_bantuan2_list->TotalRecords == 0 && !$rekap_bantuan2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $rekap_bantuan2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$rekap_bantuan2_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rekap_bantuan2_list->isExport()) { ?>
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
$rekap_bantuan2_list->terminate();
?>