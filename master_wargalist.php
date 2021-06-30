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
$master_warga_list = new master_warga_list();

// Run the page
$master_warga_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_warga_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$master_warga_list->isExport()) { ?>
<script>
var fmaster_wargalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmaster_wargalist = currentForm = new ew.Form("fmaster_wargalist", "list");
	fmaster_wargalist.formKeyCountName = '<?php echo $master_warga_list->FormKeyCountName ?>';
	loadjs.done("fmaster_wargalist");
});
var fmaster_wargalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmaster_wargalistsrch = currentSearchForm = new ew.Form("fmaster_wargalistsrch");

	// Validate function for search
	fmaster_wargalistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_kecamatan_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($master_warga_list->kecamatan_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_kelurahan_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($master_warga_list->kelurahan_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_rw_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($master_warga_list->rw_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_rt_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($master_warga_list->rt_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_alamat_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($master_warga_list->alamat_id->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fmaster_wargalistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaster_wargalistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmaster_wargalistsrch.lists["x_kecamatan_id"] = <?php echo $master_warga_list->kecamatan_id->Lookup->toClientList($master_warga_list) ?>;
	fmaster_wargalistsrch.lists["x_kecamatan_id"].options = <?php echo JsonEncode($master_warga_list->kecamatan_id->lookupOptions()) ?>;
	fmaster_wargalistsrch.autoSuggests["x_kecamatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_wargalistsrch.lists["x_kelurahan_id"] = <?php echo $master_warga_list->kelurahan_id->Lookup->toClientList($master_warga_list) ?>;
	fmaster_wargalistsrch.lists["x_kelurahan_id"].options = <?php echo JsonEncode($master_warga_list->kelurahan_id->lookupOptions()) ?>;
	fmaster_wargalistsrch.autoSuggests["x_kelurahan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_wargalistsrch.lists["x_rw_id"] = <?php echo $master_warga_list->rw_id->Lookup->toClientList($master_warga_list) ?>;
	fmaster_wargalistsrch.lists["x_rw_id"].options = <?php echo JsonEncode($master_warga_list->rw_id->lookupOptions()) ?>;
	fmaster_wargalistsrch.autoSuggests["x_rw_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_wargalistsrch.lists["x_rt_id"] = <?php echo $master_warga_list->rt_id->Lookup->toClientList($master_warga_list) ?>;
	fmaster_wargalistsrch.lists["x_rt_id"].options = <?php echo JsonEncode($master_warga_list->rt_id->lookupOptions()) ?>;
	fmaster_wargalistsrch.autoSuggests["x_rt_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_wargalistsrch.lists["x_alamat_id"] = <?php echo $master_warga_list->alamat_id->Lookup->toClientList($master_warga_list) ?>;
	fmaster_wargalistsrch.lists["x_alamat_id"].options = <?php echo JsonEncode($master_warga_list->alamat_id->lookupOptions()) ?>;
	fmaster_wargalistsrch.autoSuggests["x_alamat_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_wargalistsrch.lists["x_status_warga_id"] = <?php echo $master_warga_list->status_warga_id->Lookup->toClientList($master_warga_list) ?>;
	fmaster_wargalistsrch.lists["x_status_warga_id"].options = <?php echo JsonEncode($master_warga_list->status_warga_id->lookupOptions()) ?>;
	fmaster_wargalistsrch.lists["x_na"] = <?php echo $master_warga_list->na->Lookup->toClientList($master_warga_list) ?>;
	fmaster_wargalistsrch.lists["x_na"].options = <?php echo JsonEncode($master_warga_list->na->options(FALSE, TRUE)) ?>;

	// Filters
	fmaster_wargalistsrch.filterList = <?php echo $master_warga_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmaster_wargalistsrch.initSearchPanel = true;
	loadjs.done("fmaster_wargalistsrch");
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
<?php if (!$master_warga_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($master_warga_list->TotalRecords > 0 && $master_warga_list->ExportOptions->visible()) { ?>
<?php $master_warga_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($master_warga_list->ImportOptions->visible()) { ?>
<?php $master_warga_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($master_warga_list->SearchOptions->visible()) { ?>
<?php $master_warga_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($master_warga_list->FilterOptions->visible()) { ?>
<?php $master_warga_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$master_warga_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$master_warga_list->isExport() && !$master_warga->CurrentAction) { ?>
<form name="fmaster_wargalistsrch" id="fmaster_wargalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmaster_wargalistsrch-search-panel" class="<?php echo $master_warga_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="master_warga">
	<div class="ew-extended-search">
<?php

// Render search row
$master_warga->RowType = ROWTYPE_SEARCH;
$master_warga->resetAttributes();
$master_warga_list->renderRow();
?>
<?php if ($master_warga_list->kecamatan_id->Visible) { // kecamatan_id ?>
	<?php
		$master_warga_list->SearchColumnCount++;
		if (($master_warga_list->SearchColumnCount - 1) % $master_warga_list->SearchFieldsPerRow == 0) {
			$master_warga_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_warga_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kecamatan_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_warga_list->kecamatan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kecamatan_id" id="z_kecamatan_id" value="=">
</span>
		<span id="el_master_warga_kecamatan_id" class="ew-search-field">
<?php
$onchange = $master_warga_list->kecamatan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_warga_list->kecamatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kecamatan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kecamatan_id" id="sv_x_kecamatan_id" value="<?php echo RemoveHtml($master_warga_list->kecamatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_warga_list->kecamatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_warga_list->kecamatan_id->getPlaceHolder()) ?>"<?php echo $master_warga_list->kecamatan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_warga_list->kecamatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kecamatan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_warga_list->kecamatan_id->ReadOnly || $master_warga_list->kecamatan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_warga" data-field="x_kecamatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_warga_list->kecamatan_id->displayValueSeparatorAttribute() ?>" name="x_kecamatan_id" id="x_kecamatan_id" value="<?php echo HtmlEncode($master_warga_list->kecamatan_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_wargalistsrch"], function() {
	fmaster_wargalistsrch.createAutoSuggest({"id":"x_kecamatan_id","forceSelect":true});
});
</script>
<?php echo $master_warga_list->kecamatan_id->Lookup->getParamTag($master_warga_list, "p_x_kecamatan_id") ?>
</span>
	</div>
	<?php if ($master_warga_list->SearchColumnCount % $master_warga_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->kelurahan_id->Visible) { // kelurahan_id ?>
	<?php
		$master_warga_list->SearchColumnCount++;
		if (($master_warga_list->SearchColumnCount - 1) % $master_warga_list->SearchFieldsPerRow == 0) {
			$master_warga_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_warga_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kelurahan_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_warga_list->kelurahan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kelurahan_id" id="z_kelurahan_id" value="=">
</span>
		<span id="el_master_warga_kelurahan_id" class="ew-search-field">
<?php
$onchange = $master_warga_list->kelurahan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_warga_list->kelurahan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kelurahan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kelurahan_id" id="sv_x_kelurahan_id" value="<?php echo RemoveHtml($master_warga_list->kelurahan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_warga_list->kelurahan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_warga_list->kelurahan_id->getPlaceHolder()) ?>"<?php echo $master_warga_list->kelurahan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_warga_list->kelurahan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kelurahan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_warga_list->kelurahan_id->ReadOnly || $master_warga_list->kelurahan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_warga" data-field="x_kelurahan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_warga_list->kelurahan_id->displayValueSeparatorAttribute() ?>" name="x_kelurahan_id" id="x_kelurahan_id" value="<?php echo HtmlEncode($master_warga_list->kelurahan_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_wargalistsrch"], function() {
	fmaster_wargalistsrch.createAutoSuggest({"id":"x_kelurahan_id","forceSelect":true});
});
</script>
<?php echo $master_warga_list->kelurahan_id->Lookup->getParamTag($master_warga_list, "p_x_kelurahan_id") ?>
</span>
	</div>
	<?php if ($master_warga_list->SearchColumnCount % $master_warga_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->rw_id->Visible) { // rw_id ?>
	<?php
		$master_warga_list->SearchColumnCount++;
		if (($master_warga_list->SearchColumnCount - 1) % $master_warga_list->SearchFieldsPerRow == 0) {
			$master_warga_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_warga_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_rw_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_warga_list->rw_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_rw_id" id="z_rw_id" value="=">
</span>
		<span id="el_master_warga_rw_id" class="ew-search-field">
<?php
$onchange = $master_warga_list->rw_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_warga_list->rw_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_rw_id">
	<input type="text" class="form-control" name="sv_x_rw_id" id="sv_x_rw_id" value="<?php echo RemoveHtml($master_warga_list->rw_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_warga_list->rw_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_warga_list->rw_id->getPlaceHolder()) ?>"<?php echo $master_warga_list->rw_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_warga" data-field="x_rw_id" data-value-separator="<?php echo $master_warga_list->rw_id->displayValueSeparatorAttribute() ?>" name="x_rw_id" id="x_rw_id" value="<?php echo HtmlEncode($master_warga_list->rw_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_wargalistsrch"], function() {
	fmaster_wargalistsrch.createAutoSuggest({"id":"x_rw_id","forceSelect":true});
});
</script>
<?php echo $master_warga_list->rw_id->Lookup->getParamTag($master_warga_list, "p_x_rw_id") ?>
</span>
	</div>
	<?php if ($master_warga_list->SearchColumnCount % $master_warga_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->rt_id->Visible) { // rt_id ?>
	<?php
		$master_warga_list->SearchColumnCount++;
		if (($master_warga_list->SearchColumnCount - 1) % $master_warga_list->SearchFieldsPerRow == 0) {
			$master_warga_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_warga_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_rt_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_warga_list->rt_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_rt_id" id="z_rt_id" value="=">
</span>
		<span id="el_master_warga_rt_id" class="ew-search-field">
<?php
$onchange = $master_warga_list->rt_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_warga_list->rt_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_rt_id">
	<input type="text" class="form-control" name="sv_x_rt_id" id="sv_x_rt_id" value="<?php echo RemoveHtml($master_warga_list->rt_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_warga_list->rt_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_warga_list->rt_id->getPlaceHolder()) ?>"<?php echo $master_warga_list->rt_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_warga" data-field="x_rt_id" data-value-separator="<?php echo $master_warga_list->rt_id->displayValueSeparatorAttribute() ?>" name="x_rt_id" id="x_rt_id" value="<?php echo HtmlEncode($master_warga_list->rt_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_wargalistsrch"], function() {
	fmaster_wargalistsrch.createAutoSuggest({"id":"x_rt_id","forceSelect":true});
});
</script>
<?php echo $master_warga_list->rt_id->Lookup->getParamTag($master_warga_list, "p_x_rt_id") ?>
</span>
	</div>
	<?php if ($master_warga_list->SearchColumnCount % $master_warga_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->alamat_id->Visible) { // alamat_id ?>
	<?php
		$master_warga_list->SearchColumnCount++;
		if (($master_warga_list->SearchColumnCount - 1) % $master_warga_list->SearchFieldsPerRow == 0) {
			$master_warga_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_warga_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_alamat_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_warga_list->alamat_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_alamat_id" id="z_alamat_id" value="=">
</span>
		<span id="el_master_warga_alamat_id" class="ew-search-field">
<?php
$onchange = $master_warga_list->alamat_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_warga_list->alamat_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_alamat_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_alamat_id" id="sv_x_alamat_id" value="<?php echo RemoveHtml($master_warga_list->alamat_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_warga_list->alamat_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_warga_list->alamat_id->getPlaceHolder()) ?>"<?php echo $master_warga_list->alamat_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_warga_list->alamat_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_alamat_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_warga_list->alamat_id->ReadOnly || $master_warga_list->alamat_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_warga" data-field="x_alamat_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_warga_list->alamat_id->displayValueSeparatorAttribute() ?>" name="x_alamat_id" id="x_alamat_id" value="<?php echo HtmlEncode($master_warga_list->alamat_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_wargalistsrch"], function() {
	fmaster_wargalistsrch.createAutoSuggest({"id":"x_alamat_id","forceSelect":true});
});
</script>
<?php echo $master_warga_list->alamat_id->Lookup->getParamTag($master_warga_list, "p_x_alamat_id") ?>
</span>
	</div>
	<?php if ($master_warga_list->SearchColumnCount % $master_warga_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->status_warga_id->Visible) { // status_warga_id ?>
	<?php
		$master_warga_list->SearchColumnCount++;
		if (($master_warga_list->SearchColumnCount - 1) % $master_warga_list->SearchFieldsPerRow == 0) {
			$master_warga_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_warga_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_status_warga_id" class="ew-cell form-group">
		<label for="x_status_warga_id" class="ew-search-caption ew-label"><?php echo $master_warga_list->status_warga_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_status_warga_id" id="z_status_warga_id" value="=">
</span>
		<span id="el_master_warga_status_warga_id" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($master_warga_list->status_warga_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $master_warga_list->status_warga_id->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_status_warga_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $master_warga_list->status_warga_id->radioButtonListHtml(TRUE, "x_status_warga_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_status_warga_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_warga" data-field="x_status_warga_id" data-value-separator="<?php echo $master_warga_list->status_warga_id->displayValueSeparatorAttribute() ?>" name="x_status_warga_id" id="x_status_warga_id" value="{value}"<?php echo $master_warga_list->status_warga_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$master_warga_list->status_warga_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $master_warga_list->status_warga_id->Lookup->getParamTag($master_warga_list, "p_x_status_warga_id") ?>
</span>
	</div>
	<?php if ($master_warga_list->SearchColumnCount % $master_warga_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->na->Visible) { // na ?>
	<?php
		$master_warga_list->SearchColumnCount++;
		if (($master_warga_list->SearchColumnCount - 1) % $master_warga_list->SearchFieldsPerRow == 0) {
			$master_warga_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_warga_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_na" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_warga_list->na->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_na" id="z_na" value="=">
</span>
		<span id="el_master_warga_na" class="ew-search-field">
<div id="tp_x_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_warga" data-field="x_na" data-value-separator="<?php echo $master_warga_list->na->displayValueSeparatorAttribute() ?>" name="x_na" id="x_na" value="{value}"<?php echo $master_warga_list->na->editAttributes() ?>></div>
<div id="dsl_x_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_warga_list->na->radioButtonListHtml(FALSE, "x_na") ?>
</div></div>
</span>
	</div>
	<?php if ($master_warga_list->SearchColumnCount % $master_warga_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($master_warga_list->SearchColumnCount % $master_warga_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $master_warga_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($master_warga_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($master_warga_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $master_warga_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($master_warga_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($master_warga_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($master_warga_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($master_warga_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $master_warga_list->showPageHeader(); ?>
<?php
$master_warga_list->showMessage();
?>
<?php if ($master_warga_list->TotalRecords > 0 || $master_warga->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($master_warga_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> master_warga">
<?php if (!$master_warga_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$master_warga_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_warga_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $master_warga_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmaster_wargalist" id="fmaster_wargalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_warga">
<div id="gmp_master_warga" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($master_warga_list->TotalRecords > 0 || $master_warga_list->isGridEdit()) { ?>
<table id="tbl_master_wargalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$master_warga->RowType = ROWTYPE_HEADER;

// Render list options
$master_warga_list->renderListOptions();

// Render list options (header, left)
$master_warga_list->ListOptions->render("header", "left");
?>
<?php if ($master_warga_list->id->Visible) { // id ?>
	<?php if ($master_warga_list->SortUrl($master_warga_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $master_warga_list->id->headerCellClass() ?>"><div id="elh_master_warga_id" class="master_warga_id"><div class="ew-table-header-caption"><?php echo $master_warga_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $master_warga_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_warga_list->SortUrl($master_warga_list->id) ?>', 1);"><div id="elh_master_warga_id" class="master_warga_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_warga_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_warga_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_warga_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->kk->Visible) { // kk ?>
	<?php if ($master_warga_list->SortUrl($master_warga_list->kk) == "") { ?>
		<th data-name="kk" class="<?php echo $master_warga_list->kk->headerCellClass() ?>"><div id="elh_master_warga_kk" class="master_warga_kk"><div class="ew-table-header-caption"><?php echo $master_warga_list->kk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kk" class="<?php echo $master_warga_list->kk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_warga_list->SortUrl($master_warga_list->kk) ?>', 1);"><div id="elh_master_warga_kk" class="master_warga_kk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_warga_list->kk->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($master_warga_list->kk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_warga_list->kk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->nik->Visible) { // nik ?>
	<?php if ($master_warga_list->SortUrl($master_warga_list->nik) == "") { ?>
		<th data-name="nik" class="<?php echo $master_warga_list->nik->headerCellClass() ?>"><div id="elh_master_warga_nik" class="master_warga_nik"><div class="ew-table-header-caption"><?php echo $master_warga_list->nik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nik" class="<?php echo $master_warga_list->nik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_warga_list->SortUrl($master_warga_list->nik) ?>', 1);"><div id="elh_master_warga_nik" class="master_warga_nik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_warga_list->nik->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($master_warga_list->nik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_warga_list->nik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->nama->Visible) { // nama ?>
	<?php if ($master_warga_list->SortUrl($master_warga_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $master_warga_list->nama->headerCellClass() ?>"><div id="elh_master_warga_nama" class="master_warga_nama"><div class="ew-table-header-caption"><?php echo $master_warga_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $master_warga_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_warga_list->SortUrl($master_warga_list->nama) ?>', 1);"><div id="elh_master_warga_nama" class="master_warga_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_warga_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($master_warga_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_warga_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->kecamatan_id->Visible) { // kecamatan_id ?>
	<?php if ($master_warga_list->SortUrl($master_warga_list->kecamatan_id) == "") { ?>
		<th data-name="kecamatan_id" class="<?php echo $master_warga_list->kecamatan_id->headerCellClass() ?>"><div id="elh_master_warga_kecamatan_id" class="master_warga_kecamatan_id"><div class="ew-table-header-caption"><?php echo $master_warga_list->kecamatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kecamatan_id" class="<?php echo $master_warga_list->kecamatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_warga_list->SortUrl($master_warga_list->kecamatan_id) ?>', 1);"><div id="elh_master_warga_kecamatan_id" class="master_warga_kecamatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_warga_list->kecamatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_warga_list->kecamatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_warga_list->kecamatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->kelurahan_id->Visible) { // kelurahan_id ?>
	<?php if ($master_warga_list->SortUrl($master_warga_list->kelurahan_id) == "") { ?>
		<th data-name="kelurahan_id" class="<?php echo $master_warga_list->kelurahan_id->headerCellClass() ?>"><div id="elh_master_warga_kelurahan_id" class="master_warga_kelurahan_id"><div class="ew-table-header-caption"><?php echo $master_warga_list->kelurahan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kelurahan_id" class="<?php echo $master_warga_list->kelurahan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_warga_list->SortUrl($master_warga_list->kelurahan_id) ?>', 1);"><div id="elh_master_warga_kelurahan_id" class="master_warga_kelurahan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_warga_list->kelurahan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_warga_list->kelurahan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_warga_list->kelurahan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->rw_id->Visible) { // rw_id ?>
	<?php if ($master_warga_list->SortUrl($master_warga_list->rw_id) == "") { ?>
		<th data-name="rw_id" class="<?php echo $master_warga_list->rw_id->headerCellClass() ?>"><div id="elh_master_warga_rw_id" class="master_warga_rw_id"><div class="ew-table-header-caption"><?php echo $master_warga_list->rw_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rw_id" class="<?php echo $master_warga_list->rw_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_warga_list->SortUrl($master_warga_list->rw_id) ?>', 1);"><div id="elh_master_warga_rw_id" class="master_warga_rw_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_warga_list->rw_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_warga_list->rw_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_warga_list->rw_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->rt_id->Visible) { // rt_id ?>
	<?php if ($master_warga_list->SortUrl($master_warga_list->rt_id) == "") { ?>
		<th data-name="rt_id" class="<?php echo $master_warga_list->rt_id->headerCellClass() ?>"><div id="elh_master_warga_rt_id" class="master_warga_rt_id"><div class="ew-table-header-caption"><?php echo $master_warga_list->rt_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rt_id" class="<?php echo $master_warga_list->rt_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_warga_list->SortUrl($master_warga_list->rt_id) ?>', 1);"><div id="elh_master_warga_rt_id" class="master_warga_rt_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_warga_list->rt_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_warga_list->rt_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_warga_list->rt_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->alamat_id->Visible) { // alamat_id ?>
	<?php if ($master_warga_list->SortUrl($master_warga_list->alamat_id) == "") { ?>
		<th data-name="alamat_id" class="<?php echo $master_warga_list->alamat_id->headerCellClass() ?>"><div id="elh_master_warga_alamat_id" class="master_warga_alamat_id"><div class="ew-table-header-caption"><?php echo $master_warga_list->alamat_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alamat_id" class="<?php echo $master_warga_list->alamat_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_warga_list->SortUrl($master_warga_list->alamat_id) ?>', 1);"><div id="elh_master_warga_alamat_id" class="master_warga_alamat_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_warga_list->alamat_id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($master_warga_list->alamat_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_warga_list->alamat_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->nomor_rumah->Visible) { // nomor_rumah ?>
	<?php if ($master_warga_list->SortUrl($master_warga_list->nomor_rumah) == "") { ?>
		<th data-name="nomor_rumah" class="<?php echo $master_warga_list->nomor_rumah->headerCellClass() ?>"><div id="elh_master_warga_nomor_rumah" class="master_warga_nomor_rumah"><div class="ew-table-header-caption"><?php echo $master_warga_list->nomor_rumah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nomor_rumah" class="<?php echo $master_warga_list->nomor_rumah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_warga_list->SortUrl($master_warga_list->nomor_rumah) ?>', 1);"><div id="elh_master_warga_nomor_rumah" class="master_warga_nomor_rumah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_warga_list->nomor_rumah->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($master_warga_list->nomor_rumah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_warga_list->nomor_rumah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->status_warga_id->Visible) { // status_warga_id ?>
	<?php if ($master_warga_list->SortUrl($master_warga_list->status_warga_id) == "") { ?>
		<th data-name="status_warga_id" class="<?php echo $master_warga_list->status_warga_id->headerCellClass() ?>"><div id="elh_master_warga_status_warga_id" class="master_warga_status_warga_id"><div class="ew-table-header-caption"><?php echo $master_warga_list->status_warga_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_warga_id" class="<?php echo $master_warga_list->status_warga_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_warga_list->SortUrl($master_warga_list->status_warga_id) ?>', 1);"><div id="elh_master_warga_status_warga_id" class="master_warga_status_warga_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_warga_list->status_warga_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_warga_list->status_warga_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_warga_list->status_warga_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_warga_list->na->Visible) { // na ?>
	<?php if ($master_warga_list->SortUrl($master_warga_list->na) == "") { ?>
		<th data-name="na" class="<?php echo $master_warga_list->na->headerCellClass() ?>"><div id="elh_master_warga_na" class="master_warga_na"><div class="ew-table-header-caption"><?php echo $master_warga_list->na->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="na" class="<?php echo $master_warga_list->na->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_warga_list->SortUrl($master_warga_list->na) ?>', 1);"><div id="elh_master_warga_na" class="master_warga_na">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_warga_list->na->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_warga_list->na->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_warga_list->na->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$master_warga_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($master_warga_list->ExportAll && $master_warga_list->isExport()) {
	$master_warga_list->StopRecord = $master_warga_list->TotalRecords;
} else {

	// Set the last record to display
	if ($master_warga_list->TotalRecords > $master_warga_list->StartRecord + $master_warga_list->DisplayRecords - 1)
		$master_warga_list->StopRecord = $master_warga_list->StartRecord + $master_warga_list->DisplayRecords - 1;
	else
		$master_warga_list->StopRecord = $master_warga_list->TotalRecords;
}
$master_warga_list->RecordCount = $master_warga_list->StartRecord - 1;
if ($master_warga_list->Recordset && !$master_warga_list->Recordset->EOF) {
	$master_warga_list->Recordset->moveFirst();
	$selectLimit = $master_warga_list->UseSelectLimit;
	if (!$selectLimit && $master_warga_list->StartRecord > 1)
		$master_warga_list->Recordset->move($master_warga_list->StartRecord - 1);
} elseif (!$master_warga->AllowAddDeleteRow && $master_warga_list->StopRecord == 0) {
	$master_warga_list->StopRecord = $master_warga->GridAddRowCount;
}

// Initialize aggregate
$master_warga->RowType = ROWTYPE_AGGREGATEINIT;
$master_warga->resetAttributes();
$master_warga_list->renderRow();
while ($master_warga_list->RecordCount < $master_warga_list->StopRecord) {
	$master_warga_list->RecordCount++;
	if ($master_warga_list->RecordCount >= $master_warga_list->StartRecord) {
		$master_warga_list->RowCount++;

		// Set up key count
		$master_warga_list->KeyCount = $master_warga_list->RowIndex;

		// Init row class and style
		$master_warga->resetAttributes();
		$master_warga->CssClass = "";
		if ($master_warga_list->isGridAdd()) {
		} else {
			$master_warga_list->loadRowValues($master_warga_list->Recordset); // Load row values
		}
		$master_warga->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$master_warga->RowAttrs->merge(["data-rowindex" => $master_warga_list->RowCount, "id" => "r" . $master_warga_list->RowCount . "_master_warga", "data-rowtype" => $master_warga->RowType]);

		// Render row
		$master_warga_list->renderRow();

		// Render list options
		$master_warga_list->renderListOptions();
?>
	<tr <?php echo $master_warga->rowAttributes() ?>>
<?php

// Render list options (body, left)
$master_warga_list->ListOptions->render("body", "left", $master_warga_list->RowCount);
?>
	<?php if ($master_warga_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $master_warga_list->id->cellAttributes() ?>>
<span id="el<?php echo $master_warga_list->RowCount ?>_master_warga_id">
<span<?php echo $master_warga_list->id->viewAttributes() ?>><?php echo $master_warga_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_warga_list->kk->Visible) { // kk ?>
		<td data-name="kk" <?php echo $master_warga_list->kk->cellAttributes() ?>>
<span id="el<?php echo $master_warga_list->RowCount ?>_master_warga_kk">
<span<?php echo $master_warga_list->kk->viewAttributes() ?>><?php echo $master_warga_list->kk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_warga_list->nik->Visible) { // nik ?>
		<td data-name="nik" <?php echo $master_warga_list->nik->cellAttributes() ?>>
<span id="el<?php echo $master_warga_list->RowCount ?>_master_warga_nik">
<span<?php echo $master_warga_list->nik->viewAttributes() ?>><?php echo $master_warga_list->nik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_warga_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $master_warga_list->nama->cellAttributes() ?>>
<span id="el<?php echo $master_warga_list->RowCount ?>_master_warga_nama">
<span<?php echo $master_warga_list->nama->viewAttributes() ?>><?php echo $master_warga_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_warga_list->kecamatan_id->Visible) { // kecamatan_id ?>
		<td data-name="kecamatan_id" <?php echo $master_warga_list->kecamatan_id->cellAttributes() ?>>
<span id="el<?php echo $master_warga_list->RowCount ?>_master_warga_kecamatan_id">
<span<?php echo $master_warga_list->kecamatan_id->viewAttributes() ?>><?php echo $master_warga_list->kecamatan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_warga_list->kelurahan_id->Visible) { // kelurahan_id ?>
		<td data-name="kelurahan_id" <?php echo $master_warga_list->kelurahan_id->cellAttributes() ?>>
<span id="el<?php echo $master_warga_list->RowCount ?>_master_warga_kelurahan_id">
<span<?php echo $master_warga_list->kelurahan_id->viewAttributes() ?>><?php echo $master_warga_list->kelurahan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_warga_list->rw_id->Visible) { // rw_id ?>
		<td data-name="rw_id" <?php echo $master_warga_list->rw_id->cellAttributes() ?>>
<span id="el<?php echo $master_warga_list->RowCount ?>_master_warga_rw_id">
<span<?php echo $master_warga_list->rw_id->viewAttributes() ?>><?php echo $master_warga_list->rw_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_warga_list->rt_id->Visible) { // rt_id ?>
		<td data-name="rt_id" <?php echo $master_warga_list->rt_id->cellAttributes() ?>>
<span id="el<?php echo $master_warga_list->RowCount ?>_master_warga_rt_id">
<span<?php echo $master_warga_list->rt_id->viewAttributes() ?>><?php echo $master_warga_list->rt_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_warga_list->alamat_id->Visible) { // alamat_id ?>
		<td data-name="alamat_id" <?php echo $master_warga_list->alamat_id->cellAttributes() ?>>
<span id="el<?php echo $master_warga_list->RowCount ?>_master_warga_alamat_id">
<span<?php echo $master_warga_list->alamat_id->viewAttributes() ?>><?php echo $master_warga_list->alamat_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_warga_list->nomor_rumah->Visible) { // nomor_rumah ?>
		<td data-name="nomor_rumah" <?php echo $master_warga_list->nomor_rumah->cellAttributes() ?>>
<span id="el<?php echo $master_warga_list->RowCount ?>_master_warga_nomor_rumah">
<span<?php echo $master_warga_list->nomor_rumah->viewAttributes() ?>><?php echo $master_warga_list->nomor_rumah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_warga_list->status_warga_id->Visible) { // status_warga_id ?>
		<td data-name="status_warga_id" <?php echo $master_warga_list->status_warga_id->cellAttributes() ?>>
<span id="el<?php echo $master_warga_list->RowCount ?>_master_warga_status_warga_id">
<span<?php echo $master_warga_list->status_warga_id->viewAttributes() ?>><?php echo $master_warga_list->status_warga_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_warga_list->na->Visible) { // na ?>
		<td data-name="na" <?php echo $master_warga_list->na->cellAttributes() ?>>
<span id="el<?php echo $master_warga_list->RowCount ?>_master_warga_na">
<span<?php echo $master_warga_list->na->viewAttributes() ?>><?php echo $master_warga_list->na->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$master_warga_list->ListOptions->render("body", "right", $master_warga_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$master_warga_list->isGridAdd())
		$master_warga_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$master_warga->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($master_warga_list->Recordset)
	$master_warga_list->Recordset->Close();
?>
<?php if (!$master_warga_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$master_warga_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_warga_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $master_warga_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($master_warga_list->TotalRecords == 0 && !$master_warga->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $master_warga_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$master_warga_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$master_warga_list->isExport()) { ?>
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
$master_warga_list->terminate();
?>