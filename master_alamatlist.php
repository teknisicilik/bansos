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
$master_alamat_list = new master_alamat_list();

// Run the page
$master_alamat_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_alamat_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$master_alamat_list->isExport()) { ?>
<script>
var fmaster_alamatlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmaster_alamatlist = currentForm = new ew.Form("fmaster_alamatlist", "list");
	fmaster_alamatlist.formKeyCountName = '<?php echo $master_alamat_list->FormKeyCountName ?>';

	// Validate form
	fmaster_alamatlist.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($master_alamat_list->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_list->id->caption(), $master_alamat_list->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_alamat_list->provinsi_id->Required) { ?>
				elm = this.getElements("x" + infix + "_provinsi_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_list->provinsi_id->caption(), $master_alamat_list->provinsi_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_provinsi_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_alamat_list->provinsi_id->errorMessage()) ?>");
			<?php if ($master_alamat_list->kabupaten_id->Required) { ?>
				elm = this.getElements("x" + infix + "_kabupaten_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_list->kabupaten_id->caption(), $master_alamat_list->kabupaten_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kabupaten_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_alamat_list->kabupaten_id->errorMessage()) ?>");
			<?php if ($master_alamat_list->kecamatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_kecamatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_list->kecamatan_id->caption(), $master_alamat_list->kecamatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kecamatan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_alamat_list->kecamatan_id->errorMessage()) ?>");
			<?php if ($master_alamat_list->kelurahan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_kelurahan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_list->kelurahan_id->caption(), $master_alamat_list->kelurahan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kelurahan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_alamat_list->kelurahan_id->errorMessage()) ?>");
			<?php if ($master_alamat_list->rw_id->Required) { ?>
				elm = this.getElements("x" + infix + "_rw_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_list->rw_id->caption(), $master_alamat_list->rw_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_alamat_list->rt_id->Required) { ?>
				elm = this.getElements("x" + infix + "_rt_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_list->rt_id->caption(), $master_alamat_list->rt_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_alamat_list->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_list->nama->caption(), $master_alamat_list->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_alamat_list->na->Required) { ?>
				elm = this.getElements("x" + infix + "_na");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_alamat_list->na->caption(), $master_alamat_list->na->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	fmaster_alamatlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "provinsi_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "kabupaten_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "kecamatan_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "kelurahan_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "rw_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "rt_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "nama", false)) return false;
		if (ew.valueChanged(fobj, infix, "na", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fmaster_alamatlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaster_alamatlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmaster_alamatlist.lists["x_provinsi_id"] = <?php echo $master_alamat_list->provinsi_id->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlist.lists["x_provinsi_id"].options = <?php echo JsonEncode($master_alamat_list->provinsi_id->lookupOptions()) ?>;
	fmaster_alamatlist.autoSuggests["x_provinsi_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_alamatlist.lists["x_kabupaten_id"] = <?php echo $master_alamat_list->kabupaten_id->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlist.lists["x_kabupaten_id"].options = <?php echo JsonEncode($master_alamat_list->kabupaten_id->lookupOptions()) ?>;
	fmaster_alamatlist.autoSuggests["x_kabupaten_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_alamatlist.lists["x_kecamatan_id"] = <?php echo $master_alamat_list->kecamatan_id->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlist.lists["x_kecamatan_id"].options = <?php echo JsonEncode($master_alamat_list->kecamatan_id->lookupOptions()) ?>;
	fmaster_alamatlist.autoSuggests["x_kecamatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_alamatlist.lists["x_kelurahan_id"] = <?php echo $master_alamat_list->kelurahan_id->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlist.lists["x_kelurahan_id"].options = <?php echo JsonEncode($master_alamat_list->kelurahan_id->lookupOptions()) ?>;
	fmaster_alamatlist.autoSuggests["x_kelurahan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_alamatlist.lists["x_rw_id"] = <?php echo $master_alamat_list->rw_id->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlist.lists["x_rw_id"].options = <?php echo JsonEncode($master_alamat_list->rw_id->lookupOptions()) ?>;
	fmaster_alamatlist.lists["x_rt_id"] = <?php echo $master_alamat_list->rt_id->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlist.lists["x_rt_id"].options = <?php echo JsonEncode($master_alamat_list->rt_id->lookupOptions()) ?>;
	fmaster_alamatlist.lists["x_na"] = <?php echo $master_alamat_list->na->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlist.lists["x_na"].options = <?php echo JsonEncode($master_alamat_list->na->options(FALSE, TRUE)) ?>;
	loadjs.done("fmaster_alamatlist");
});
var fmaster_alamatlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmaster_alamatlistsrch = currentSearchForm = new ew.Form("fmaster_alamatlistsrch");

	// Validate function for search
	fmaster_alamatlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_provinsi_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($master_alamat_list->provinsi_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_kabupaten_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($master_alamat_list->kabupaten_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_kecamatan_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($master_alamat_list->kecamatan_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_kelurahan_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($master_alamat_list->kelurahan_id->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fmaster_alamatlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaster_alamatlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmaster_alamatlistsrch.lists["x_provinsi_id"] = <?php echo $master_alamat_list->provinsi_id->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlistsrch.lists["x_provinsi_id"].options = <?php echo JsonEncode($master_alamat_list->provinsi_id->lookupOptions()) ?>;
	fmaster_alamatlistsrch.autoSuggests["x_provinsi_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_alamatlistsrch.lists["x_kabupaten_id"] = <?php echo $master_alamat_list->kabupaten_id->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlistsrch.lists["x_kabupaten_id"].options = <?php echo JsonEncode($master_alamat_list->kabupaten_id->lookupOptions()) ?>;
	fmaster_alamatlistsrch.autoSuggests["x_kabupaten_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_alamatlistsrch.lists["x_kecamatan_id"] = <?php echo $master_alamat_list->kecamatan_id->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlistsrch.lists["x_kecamatan_id"].options = <?php echo JsonEncode($master_alamat_list->kecamatan_id->lookupOptions()) ?>;
	fmaster_alamatlistsrch.autoSuggests["x_kecamatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_alamatlistsrch.lists["x_kelurahan_id"] = <?php echo $master_alamat_list->kelurahan_id->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlistsrch.lists["x_kelurahan_id"].options = <?php echo JsonEncode($master_alamat_list->kelurahan_id->lookupOptions()) ?>;
	fmaster_alamatlistsrch.autoSuggests["x_kelurahan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmaster_alamatlistsrch.lists["x_rw_id"] = <?php echo $master_alamat_list->rw_id->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlistsrch.lists["x_rw_id"].options = <?php echo JsonEncode($master_alamat_list->rw_id->lookupOptions()) ?>;
	fmaster_alamatlistsrch.lists["x_rt_id"] = <?php echo $master_alamat_list->rt_id->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlistsrch.lists["x_rt_id"].options = <?php echo JsonEncode($master_alamat_list->rt_id->lookupOptions()) ?>;
	fmaster_alamatlistsrch.lists["x_na"] = <?php echo $master_alamat_list->na->Lookup->toClientList($master_alamat_list) ?>;
	fmaster_alamatlistsrch.lists["x_na"].options = <?php echo JsonEncode($master_alamat_list->na->options(FALSE, TRUE)) ?>;

	// Filters
	fmaster_alamatlistsrch.filterList = <?php echo $master_alamat_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmaster_alamatlistsrch.initSearchPanel = true;
	loadjs.done("fmaster_alamatlistsrch");
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
<?php if (!$master_alamat_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($master_alamat_list->TotalRecords > 0 && $master_alamat_list->ExportOptions->visible()) { ?>
<?php $master_alamat_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($master_alamat_list->ImportOptions->visible()) { ?>
<?php $master_alamat_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($master_alamat_list->SearchOptions->visible()) { ?>
<?php $master_alamat_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($master_alamat_list->FilterOptions->visible()) { ?>
<?php $master_alamat_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$master_alamat_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$master_alamat_list->isExport() && !$master_alamat->CurrentAction) { ?>
<form name="fmaster_alamatlistsrch" id="fmaster_alamatlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmaster_alamatlistsrch-search-panel" class="<?php echo $master_alamat_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="master_alamat">
	<div class="ew-extended-search">
<?php

// Render search row
$master_alamat->RowType = ROWTYPE_SEARCH;
$master_alamat->resetAttributes();
$master_alamat_list->renderRow();
?>
<?php if ($master_alamat_list->provinsi_id->Visible) { // provinsi_id ?>
	<?php
		$master_alamat_list->SearchColumnCount++;
		if (($master_alamat_list->SearchColumnCount - 1) % $master_alamat_list->SearchFieldsPerRow == 0) {
			$master_alamat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_alamat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_provinsi_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_alamat_list->provinsi_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_provinsi_id" id="z_provinsi_id" value="=">
</span>
		<span id="el_master_alamat_provinsi_id" class="ew-search-field">
<?php
$onchange = $master_alamat_list->provinsi_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_list->provinsi_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_provinsi_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_provinsi_id" id="sv_x_provinsi_id" value="<?php echo RemoveHtml($master_alamat_list->provinsi_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_alamat_list->provinsi_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_list->provinsi_id->getPlaceHolder()) ?>"<?php echo $master_alamat_list->provinsi_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->provinsi_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_provinsi_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->provinsi_id->ReadOnly || $master_alamat_list->provinsi_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_provinsi_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->provinsi_id->displayValueSeparatorAttribute() ?>" name="x_provinsi_id" id="x_provinsi_id" value="<?php echo HtmlEncode($master_alamat_list->provinsi_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatlistsrch"], function() {
	fmaster_alamatlistsrch.createAutoSuggest({"id":"x_provinsi_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_list->provinsi_id->Lookup->getParamTag($master_alamat_list, "p_x_provinsi_id") ?>
</span>
	</div>
	<?php if ($master_alamat_list->SearchColumnCount % $master_alamat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->kabupaten_id->Visible) { // kabupaten_id ?>
	<?php
		$master_alamat_list->SearchColumnCount++;
		if (($master_alamat_list->SearchColumnCount - 1) % $master_alamat_list->SearchFieldsPerRow == 0) {
			$master_alamat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_alamat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kabupaten_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_alamat_list->kabupaten_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kabupaten_id" id="z_kabupaten_id" value="=">
</span>
		<span id="el_master_alamat_kabupaten_id" class="ew-search-field">
<?php
$onchange = $master_alamat_list->kabupaten_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_list->kabupaten_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kabupaten_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kabupaten_id" id="sv_x_kabupaten_id" value="<?php echo RemoveHtml($master_alamat_list->kabupaten_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_alamat_list->kabupaten_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_list->kabupaten_id->getPlaceHolder()) ?>"<?php echo $master_alamat_list->kabupaten_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->kabupaten_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kabupaten_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->kabupaten_id->ReadOnly || $master_alamat_list->kabupaten_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kabupaten_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->kabupaten_id->displayValueSeparatorAttribute() ?>" name="x_kabupaten_id" id="x_kabupaten_id" value="<?php echo HtmlEncode($master_alamat_list->kabupaten_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatlistsrch"], function() {
	fmaster_alamatlistsrch.createAutoSuggest({"id":"x_kabupaten_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_list->kabupaten_id->Lookup->getParamTag($master_alamat_list, "p_x_kabupaten_id") ?>
</span>
	</div>
	<?php if ($master_alamat_list->SearchColumnCount % $master_alamat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->kecamatan_id->Visible) { // kecamatan_id ?>
	<?php
		$master_alamat_list->SearchColumnCount++;
		if (($master_alamat_list->SearchColumnCount - 1) % $master_alamat_list->SearchFieldsPerRow == 0) {
			$master_alamat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_alamat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kecamatan_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_alamat_list->kecamatan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kecamatan_id" id="z_kecamatan_id" value="=">
</span>
		<span id="el_master_alamat_kecamatan_id" class="ew-search-field">
<?php
$onchange = $master_alamat_list->kecamatan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_list->kecamatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kecamatan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kecamatan_id" id="sv_x_kecamatan_id" value="<?php echo RemoveHtml($master_alamat_list->kecamatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_alamat_list->kecamatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_list->kecamatan_id->getPlaceHolder()) ?>"<?php echo $master_alamat_list->kecamatan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->kecamatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kecamatan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->kecamatan_id->ReadOnly || $master_alamat_list->kecamatan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kecamatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->kecamatan_id->displayValueSeparatorAttribute() ?>" name="x_kecamatan_id" id="x_kecamatan_id" value="<?php echo HtmlEncode($master_alamat_list->kecamatan_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatlistsrch"], function() {
	fmaster_alamatlistsrch.createAutoSuggest({"id":"x_kecamatan_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_list->kecamatan_id->Lookup->getParamTag($master_alamat_list, "p_x_kecamatan_id") ?>
</span>
	</div>
	<?php if ($master_alamat_list->SearchColumnCount % $master_alamat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->kelurahan_id->Visible) { // kelurahan_id ?>
	<?php
		$master_alamat_list->SearchColumnCount++;
		if (($master_alamat_list->SearchColumnCount - 1) % $master_alamat_list->SearchFieldsPerRow == 0) {
			$master_alamat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_alamat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kelurahan_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_alamat_list->kelurahan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kelurahan_id" id="z_kelurahan_id" value="=">
</span>
		<span id="el_master_alamat_kelurahan_id" class="ew-search-field">
<?php
$onchange = $master_alamat_list->kelurahan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_list->kelurahan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kelurahan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kelurahan_id" id="sv_x_kelurahan_id" value="<?php echo RemoveHtml($master_alamat_list->kelurahan_id->EditValue) ?>" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($master_alamat_list->kelurahan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_list->kelurahan_id->getPlaceHolder()) ?>"<?php echo $master_alamat_list->kelurahan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->kelurahan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kelurahan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->kelurahan_id->ReadOnly || $master_alamat_list->kelurahan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kelurahan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->kelurahan_id->displayValueSeparatorAttribute() ?>" name="x_kelurahan_id" id="x_kelurahan_id" value="<?php echo HtmlEncode($master_alamat_list->kelurahan_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatlistsrch"], function() {
	fmaster_alamatlistsrch.createAutoSuggest({"id":"x_kelurahan_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_list->kelurahan_id->Lookup->getParamTag($master_alamat_list, "p_x_kelurahan_id") ?>
</span>
	</div>
	<?php if ($master_alamat_list->SearchColumnCount % $master_alamat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->rw_id->Visible) { // rw_id ?>
	<?php
		$master_alamat_list->SearchColumnCount++;
		if (($master_alamat_list->SearchColumnCount - 1) % $master_alamat_list->SearchFieldsPerRow == 0) {
			$master_alamat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_alamat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_rw_id" class="ew-cell form-group">
		<label for="x_rw_id" class="ew-search-caption ew-label"><?php echo $master_alamat_list->rw_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_rw_id" id="z_rw_id" value="=">
</span>
		<span id="el_master_alamat_rw_id" class="ew-search-field">
<?php $master_alamat_list->rw_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_rw_id"><?php echo EmptyValue(strval($master_alamat_list->rw_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_alamat_list->rw_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->rw_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->rw_id->ReadOnly || $master_alamat_list->rw_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_rw_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_alamat_list->rw_id->Lookup->getParamTag($master_alamat_list, "p_x_rw_id") ?>
<input type="hidden" data-table="master_alamat" data-field="x_rw_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->rw_id->displayValueSeparatorAttribute() ?>" name="x_rw_id" id="x_rw_id" value="<?php echo $master_alamat_list->rw_id->AdvancedSearch->SearchValue ?>"<?php echo $master_alamat_list->rw_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($master_alamat_list->SearchColumnCount % $master_alamat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->rt_id->Visible) { // rt_id ?>
	<?php
		$master_alamat_list->SearchColumnCount++;
		if (($master_alamat_list->SearchColumnCount - 1) % $master_alamat_list->SearchFieldsPerRow == 0) {
			$master_alamat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_alamat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_rt_id" class="ew-cell form-group">
		<label for="x_rt_id" class="ew-search-caption ew-label"><?php echo $master_alamat_list->rt_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_rt_id" id="z_rt_id" value="=">
</span>
		<span id="el_master_alamat_rt_id" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_rt_id"><?php echo EmptyValue(strval($master_alamat_list->rt_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_alamat_list->rt_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->rt_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->rt_id->ReadOnly || $master_alamat_list->rt_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_rt_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_alamat_list->rt_id->Lookup->getParamTag($master_alamat_list, "p_x_rt_id") ?>
<input type="hidden" data-table="master_alamat" data-field="x_rt_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->rt_id->displayValueSeparatorAttribute() ?>" name="x_rt_id" id="x_rt_id" value="<?php echo $master_alamat_list->rt_id->AdvancedSearch->SearchValue ?>"<?php echo $master_alamat_list->rt_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($master_alamat_list->SearchColumnCount % $master_alamat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->na->Visible) { // na ?>
	<?php
		$master_alamat_list->SearchColumnCount++;
		if (($master_alamat_list->SearchColumnCount - 1) % $master_alamat_list->SearchFieldsPerRow == 0) {
			$master_alamat_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_alamat_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_na" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_alamat_list->na->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_na" id="z_na" value="=">
</span>
		<span id="el_master_alamat_na" class="ew-search-field">
<div id="tp_x_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_alamat" data-field="x_na" data-value-separator="<?php echo $master_alamat_list->na->displayValueSeparatorAttribute() ?>" name="x_na" id="x_na" value="{value}"<?php echo $master_alamat_list->na->editAttributes() ?>></div>
<div id="dsl_x_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_alamat_list->na->radioButtonListHtml(FALSE, "x_na") ?>
</div></div>
</span>
	</div>
	<?php if ($master_alamat_list->SearchColumnCount % $master_alamat_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($master_alamat_list->SearchColumnCount % $master_alamat_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $master_alamat_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($master_alamat_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($master_alamat_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $master_alamat_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($master_alamat_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($master_alamat_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($master_alamat_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($master_alamat_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $master_alamat_list->showPageHeader(); ?>
<?php
$master_alamat_list->showMessage();
?>
<?php if ($master_alamat_list->TotalRecords > 0 || $master_alamat->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($master_alamat_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> master_alamat">
<?php if (!$master_alamat_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$master_alamat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_alamat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $master_alamat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmaster_alamatlist" id="fmaster_alamatlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_alamat">
<div id="gmp_master_alamat" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($master_alamat_list->TotalRecords > 0 || $master_alamat_list->isGridEdit()) { ?>
<table id="tbl_master_alamatlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$master_alamat->RowType = ROWTYPE_HEADER;

// Render list options
$master_alamat_list->renderListOptions();

// Render list options (header, left)
$master_alamat_list->ListOptions->render("header", "left");
?>
<?php if ($master_alamat_list->id->Visible) { // id ?>
	<?php if ($master_alamat_list->SortUrl($master_alamat_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $master_alamat_list->id->headerCellClass() ?>"><div id="elh_master_alamat_id" class="master_alamat_id"><div class="ew-table-header-caption"><?php echo $master_alamat_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $master_alamat_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_alamat_list->SortUrl($master_alamat_list->id) ?>', 1);"><div id="elh_master_alamat_id" class="master_alamat_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_alamat_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_alamat_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_alamat_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->provinsi_id->Visible) { // provinsi_id ?>
	<?php if ($master_alamat_list->SortUrl($master_alamat_list->provinsi_id) == "") { ?>
		<th data-name="provinsi_id" class="<?php echo $master_alamat_list->provinsi_id->headerCellClass() ?>"><div id="elh_master_alamat_provinsi_id" class="master_alamat_provinsi_id"><div class="ew-table-header-caption"><?php echo $master_alamat_list->provinsi_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="provinsi_id" class="<?php echo $master_alamat_list->provinsi_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_alamat_list->SortUrl($master_alamat_list->provinsi_id) ?>', 1);"><div id="elh_master_alamat_provinsi_id" class="master_alamat_provinsi_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_alamat_list->provinsi_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_alamat_list->provinsi_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_alamat_list->provinsi_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->kabupaten_id->Visible) { // kabupaten_id ?>
	<?php if ($master_alamat_list->SortUrl($master_alamat_list->kabupaten_id) == "") { ?>
		<th data-name="kabupaten_id" class="<?php echo $master_alamat_list->kabupaten_id->headerCellClass() ?>"><div id="elh_master_alamat_kabupaten_id" class="master_alamat_kabupaten_id"><div class="ew-table-header-caption"><?php echo $master_alamat_list->kabupaten_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kabupaten_id" class="<?php echo $master_alamat_list->kabupaten_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_alamat_list->SortUrl($master_alamat_list->kabupaten_id) ?>', 1);"><div id="elh_master_alamat_kabupaten_id" class="master_alamat_kabupaten_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_alamat_list->kabupaten_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_alamat_list->kabupaten_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_alamat_list->kabupaten_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->kecamatan_id->Visible) { // kecamatan_id ?>
	<?php if ($master_alamat_list->SortUrl($master_alamat_list->kecamatan_id) == "") { ?>
		<th data-name="kecamatan_id" class="<?php echo $master_alamat_list->kecamatan_id->headerCellClass() ?>"><div id="elh_master_alamat_kecamatan_id" class="master_alamat_kecamatan_id"><div class="ew-table-header-caption"><?php echo $master_alamat_list->kecamatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kecamatan_id" class="<?php echo $master_alamat_list->kecamatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_alamat_list->SortUrl($master_alamat_list->kecamatan_id) ?>', 1);"><div id="elh_master_alamat_kecamatan_id" class="master_alamat_kecamatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_alamat_list->kecamatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_alamat_list->kecamatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_alamat_list->kecamatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->kelurahan_id->Visible) { // kelurahan_id ?>
	<?php if ($master_alamat_list->SortUrl($master_alamat_list->kelurahan_id) == "") { ?>
		<th data-name="kelurahan_id" class="<?php echo $master_alamat_list->kelurahan_id->headerCellClass() ?>"><div id="elh_master_alamat_kelurahan_id" class="master_alamat_kelurahan_id"><div class="ew-table-header-caption"><?php echo $master_alamat_list->kelurahan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kelurahan_id" class="<?php echo $master_alamat_list->kelurahan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_alamat_list->SortUrl($master_alamat_list->kelurahan_id) ?>', 1);"><div id="elh_master_alamat_kelurahan_id" class="master_alamat_kelurahan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_alamat_list->kelurahan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_alamat_list->kelurahan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_alamat_list->kelurahan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->rw_id->Visible) { // rw_id ?>
	<?php if ($master_alamat_list->SortUrl($master_alamat_list->rw_id) == "") { ?>
		<th data-name="rw_id" class="<?php echo $master_alamat_list->rw_id->headerCellClass() ?>"><div id="elh_master_alamat_rw_id" class="master_alamat_rw_id"><div class="ew-table-header-caption"><?php echo $master_alamat_list->rw_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rw_id" class="<?php echo $master_alamat_list->rw_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_alamat_list->SortUrl($master_alamat_list->rw_id) ?>', 1);"><div id="elh_master_alamat_rw_id" class="master_alamat_rw_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_alamat_list->rw_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_alamat_list->rw_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_alamat_list->rw_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->rt_id->Visible) { // rt_id ?>
	<?php if ($master_alamat_list->SortUrl($master_alamat_list->rt_id) == "") { ?>
		<th data-name="rt_id" class="<?php echo $master_alamat_list->rt_id->headerCellClass() ?>"><div id="elh_master_alamat_rt_id" class="master_alamat_rt_id"><div class="ew-table-header-caption"><?php echo $master_alamat_list->rt_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rt_id" class="<?php echo $master_alamat_list->rt_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_alamat_list->SortUrl($master_alamat_list->rt_id) ?>', 1);"><div id="elh_master_alamat_rt_id" class="master_alamat_rt_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_alamat_list->rt_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_alamat_list->rt_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_alamat_list->rt_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->nama->Visible) { // nama ?>
	<?php if ($master_alamat_list->SortUrl($master_alamat_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $master_alamat_list->nama->headerCellClass() ?>"><div id="elh_master_alamat_nama" class="master_alamat_nama"><div class="ew-table-header-caption"><?php echo $master_alamat_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $master_alamat_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_alamat_list->SortUrl($master_alamat_list->nama) ?>', 1);"><div id="elh_master_alamat_nama" class="master_alamat_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_alamat_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($master_alamat_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_alamat_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_alamat_list->na->Visible) { // na ?>
	<?php if ($master_alamat_list->SortUrl($master_alamat_list->na) == "") { ?>
		<th data-name="na" class="<?php echo $master_alamat_list->na->headerCellClass() ?>"><div id="elh_master_alamat_na" class="master_alamat_na"><div class="ew-table-header-caption"><?php echo $master_alamat_list->na->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="na" class="<?php echo $master_alamat_list->na->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_alamat_list->SortUrl($master_alamat_list->na) ?>', 1);"><div id="elh_master_alamat_na" class="master_alamat_na">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_alamat_list->na->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_alamat_list->na->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_alamat_list->na->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$master_alamat_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($master_alamat_list->ExportAll && $master_alamat_list->isExport()) {
	$master_alamat_list->StopRecord = $master_alamat_list->TotalRecords;
} else {

	// Set the last record to display
	if ($master_alamat_list->TotalRecords > $master_alamat_list->StartRecord + $master_alamat_list->DisplayRecords - 1)
		$master_alamat_list->StopRecord = $master_alamat_list->StartRecord + $master_alamat_list->DisplayRecords - 1;
	else
		$master_alamat_list->StopRecord = $master_alamat_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($master_alamat->isConfirm() || $master_alamat_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($master_alamat_list->FormKeyCountName) && ($master_alamat_list->isGridAdd() || $master_alamat_list->isGridEdit() || $master_alamat->isConfirm())) {
		$master_alamat_list->KeyCount = $CurrentForm->getValue($master_alamat_list->FormKeyCountName);
		$master_alamat_list->StopRecord = $master_alamat_list->StartRecord + $master_alamat_list->KeyCount - 1;
	}
}
$master_alamat_list->RecordCount = $master_alamat_list->StartRecord - 1;
if ($master_alamat_list->Recordset && !$master_alamat_list->Recordset->EOF) {
	$master_alamat_list->Recordset->moveFirst();
	$selectLimit = $master_alamat_list->UseSelectLimit;
	if (!$selectLimit && $master_alamat_list->StartRecord > 1)
		$master_alamat_list->Recordset->move($master_alamat_list->StartRecord - 1);
} elseif (!$master_alamat->AllowAddDeleteRow && $master_alamat_list->StopRecord == 0) {
	$master_alamat_list->StopRecord = $master_alamat->GridAddRowCount;
}

// Initialize aggregate
$master_alamat->RowType = ROWTYPE_AGGREGATEINIT;
$master_alamat->resetAttributes();
$master_alamat_list->renderRow();
if ($master_alamat_list->isGridAdd())
	$master_alamat_list->RowIndex = 0;
while ($master_alamat_list->RecordCount < $master_alamat_list->StopRecord) {
	$master_alamat_list->RecordCount++;
	if ($master_alamat_list->RecordCount >= $master_alamat_list->StartRecord) {
		$master_alamat_list->RowCount++;
		if ($master_alamat_list->isGridAdd() || $master_alamat_list->isGridEdit() || $master_alamat->isConfirm()) {
			$master_alamat_list->RowIndex++;
			$CurrentForm->Index = $master_alamat_list->RowIndex;
			if ($CurrentForm->hasValue($master_alamat_list->FormActionName) && ($master_alamat->isConfirm() || $master_alamat_list->EventCancelled))
				$master_alamat_list->RowAction = strval($CurrentForm->getValue($master_alamat_list->FormActionName));
			elseif ($master_alamat_list->isGridAdd())
				$master_alamat_list->RowAction = "insert";
			else
				$master_alamat_list->RowAction = "";
		}

		// Set up key count
		$master_alamat_list->KeyCount = $master_alamat_list->RowIndex;

		// Init row class and style
		$master_alamat->resetAttributes();
		$master_alamat->CssClass = "";
		if ($master_alamat_list->isGridAdd()) {
			$master_alamat_list->loadRowValues(); // Load default values
		} else {
			$master_alamat_list->loadRowValues($master_alamat_list->Recordset); // Load row values
		}
		$master_alamat->RowType = ROWTYPE_VIEW; // Render view
		if ($master_alamat_list->isGridAdd()) // Grid add
			$master_alamat->RowType = ROWTYPE_ADD; // Render add
		if ($master_alamat_list->isGridAdd() && $master_alamat->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$master_alamat_list->restoreCurrentRowFormValues($master_alamat_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$master_alamat->RowAttrs->merge(["data-rowindex" => $master_alamat_list->RowCount, "id" => "r" . $master_alamat_list->RowCount . "_master_alamat", "data-rowtype" => $master_alamat->RowType]);

		// Render row
		$master_alamat_list->renderRow();

		// Render list options
		$master_alamat_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($master_alamat_list->RowAction != "delete" && $master_alamat_list->RowAction != "insertdelete" && !($master_alamat_list->RowAction == "insert" && $master_alamat->isConfirm() && $master_alamat_list->emptyRow())) {
?>
	<tr <?php echo $master_alamat->rowAttributes() ?>>
<?php

// Render list options (body, left)
$master_alamat_list->ListOptions->render("body", "left", $master_alamat_list->RowCount);
?>
	<?php if ($master_alamat_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $master_alamat_list->id->cellAttributes() ?>>
<?php if ($master_alamat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_id" class="form-group"></span>
<input type="hidden" data-table="master_alamat" data-field="x_id" name="o<?php echo $master_alamat_list->RowIndex ?>_id" id="o<?php echo $master_alamat_list->RowIndex ?>_id" value="<?php echo HtmlEncode($master_alamat_list->id->OldValue) ?>">
<?php } ?>
<?php if ($master_alamat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_id">
<span<?php echo $master_alamat_list->id->viewAttributes() ?>><?php echo $master_alamat_list->id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_alamat_list->provinsi_id->Visible) { // provinsi_id ?>
		<td data-name="provinsi_id" <?php echo $master_alamat_list->provinsi_id->cellAttributes() ?>>
<?php if ($master_alamat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_provinsi_id" class="form-group">
<?php
$onchange = $master_alamat_list->provinsi_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_list->provinsi_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id" id="sv_x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id" value="<?php echo RemoveHtml($master_alamat_list->provinsi_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_alamat_list->provinsi_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_list->provinsi_id->getPlaceHolder()) ?>"<?php echo $master_alamat_list->provinsi_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->provinsi_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->provinsi_id->ReadOnly || $master_alamat_list->provinsi_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_provinsi_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->provinsi_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id" id="x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id" value="<?php echo HtmlEncode($master_alamat_list->provinsi_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatlist"], function() {
	fmaster_alamatlist.createAutoSuggest({"id":"x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_list->provinsi_id->Lookup->getParamTag($master_alamat_list, "p_x" . $master_alamat_list->RowIndex . "_provinsi_id") ?>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_provinsi_id" name="o<?php echo $master_alamat_list->RowIndex ?>_provinsi_id" id="o<?php echo $master_alamat_list->RowIndex ?>_provinsi_id" value="<?php echo HtmlEncode($master_alamat_list->provinsi_id->OldValue) ?>">
<?php } ?>
<?php if ($master_alamat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_provinsi_id">
<span<?php echo $master_alamat_list->provinsi_id->viewAttributes() ?>><?php echo $master_alamat_list->provinsi_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_alamat_list->kabupaten_id->Visible) { // kabupaten_id ?>
		<td data-name="kabupaten_id" <?php echo $master_alamat_list->kabupaten_id->cellAttributes() ?>>
<?php if ($master_alamat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_kabupaten_id" class="form-group">
<?php
$onchange = $master_alamat_list->kabupaten_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_list->kabupaten_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id" id="sv_x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id" value="<?php echo RemoveHtml($master_alamat_list->kabupaten_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_alamat_list->kabupaten_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_list->kabupaten_id->getPlaceHolder()) ?>"<?php echo $master_alamat_list->kabupaten_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->kabupaten_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->kabupaten_id->ReadOnly || $master_alamat_list->kabupaten_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kabupaten_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->kabupaten_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id" id="x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id" value="<?php echo HtmlEncode($master_alamat_list->kabupaten_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatlist"], function() {
	fmaster_alamatlist.createAutoSuggest({"id":"x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_list->kabupaten_id->Lookup->getParamTag($master_alamat_list, "p_x" . $master_alamat_list->RowIndex . "_kabupaten_id") ?>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kabupaten_id" name="o<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id" id="o<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id" value="<?php echo HtmlEncode($master_alamat_list->kabupaten_id->OldValue) ?>">
<?php } ?>
<?php if ($master_alamat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_kabupaten_id">
<span<?php echo $master_alamat_list->kabupaten_id->viewAttributes() ?>><?php echo $master_alamat_list->kabupaten_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_alamat_list->kecamatan_id->Visible) { // kecamatan_id ?>
		<td data-name="kecamatan_id" <?php echo $master_alamat_list->kecamatan_id->cellAttributes() ?>>
<?php if ($master_alamat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_kecamatan_id" class="form-group">
<?php
$onchange = $master_alamat_list->kecamatan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_list->kecamatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id" id="sv_x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id" value="<?php echo RemoveHtml($master_alamat_list->kecamatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_alamat_list->kecamatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_list->kecamatan_id->getPlaceHolder()) ?>"<?php echo $master_alamat_list->kecamatan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->kecamatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->kecamatan_id->ReadOnly || $master_alamat_list->kecamatan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kecamatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->kecamatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id" id="x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id" value="<?php echo HtmlEncode($master_alamat_list->kecamatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatlist"], function() {
	fmaster_alamatlist.createAutoSuggest({"id":"x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_list->kecamatan_id->Lookup->getParamTag($master_alamat_list, "p_x" . $master_alamat_list->RowIndex . "_kecamatan_id") ?>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kecamatan_id" name="o<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id" id="o<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id" value="<?php echo HtmlEncode($master_alamat_list->kecamatan_id->OldValue) ?>">
<?php } ?>
<?php if ($master_alamat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_kecamatan_id">
<span<?php echo $master_alamat_list->kecamatan_id->viewAttributes() ?>><?php echo $master_alamat_list->kecamatan_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_alamat_list->kelurahan_id->Visible) { // kelurahan_id ?>
		<td data-name="kelurahan_id" <?php echo $master_alamat_list->kelurahan_id->cellAttributes() ?>>
<?php if ($master_alamat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_kelurahan_id" class="form-group">
<?php
$onchange = $master_alamat_list->kelurahan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_list->kelurahan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id" id="sv_x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id" value="<?php echo RemoveHtml($master_alamat_list->kelurahan_id->EditValue) ?>" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($master_alamat_list->kelurahan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_list->kelurahan_id->getPlaceHolder()) ?>"<?php echo $master_alamat_list->kelurahan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->kelurahan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->kelurahan_id->ReadOnly || $master_alamat_list->kelurahan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kelurahan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->kelurahan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id" id="x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id" value="<?php echo HtmlEncode($master_alamat_list->kelurahan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatlist"], function() {
	fmaster_alamatlist.createAutoSuggest({"id":"x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_list->kelurahan_id->Lookup->getParamTag($master_alamat_list, "p_x" . $master_alamat_list->RowIndex . "_kelurahan_id") ?>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kelurahan_id" name="o<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id" id="o<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id" value="<?php echo HtmlEncode($master_alamat_list->kelurahan_id->OldValue) ?>">
<?php } ?>
<?php if ($master_alamat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_kelurahan_id">
<span<?php echo $master_alamat_list->kelurahan_id->viewAttributes() ?>><?php echo $master_alamat_list->kelurahan_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_alamat_list->rw_id->Visible) { // rw_id ?>
		<td data-name="rw_id" <?php echo $master_alamat_list->rw_id->cellAttributes() ?>>
<?php if ($master_alamat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_rw_id" class="form-group">
<?php $master_alamat_list->rw_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $master_alamat_list->RowIndex ?>_rw_id"><?php echo EmptyValue(strval($master_alamat_list->rw_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_alamat_list->rw_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->rw_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->rw_id->ReadOnly || $master_alamat_list->rw_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_alamat_list->RowIndex ?>_rw_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_alamat_list->rw_id->Lookup->getParamTag($master_alamat_list, "p_x" . $master_alamat_list->RowIndex . "_rw_id") ?>
<input type="hidden" data-table="master_alamat" data-field="x_rw_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->rw_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_rw_id" id="x<?php echo $master_alamat_list->RowIndex ?>_rw_id" value="<?php echo $master_alamat_list->rw_id->CurrentValue ?>"<?php echo $master_alamat_list->rw_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_rw_id" name="o<?php echo $master_alamat_list->RowIndex ?>_rw_id" id="o<?php echo $master_alamat_list->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($master_alamat_list->rw_id->OldValue) ?>">
<?php } ?>
<?php if ($master_alamat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_rw_id">
<span<?php echo $master_alamat_list->rw_id->viewAttributes() ?>><?php echo $master_alamat_list->rw_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_alamat_list->rt_id->Visible) { // rt_id ?>
		<td data-name="rt_id" <?php echo $master_alamat_list->rt_id->cellAttributes() ?>>
<?php if ($master_alamat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_rt_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $master_alamat_list->RowIndex ?>_rt_id"><?php echo EmptyValue(strval($master_alamat_list->rt_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_alamat_list->rt_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->rt_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->rt_id->ReadOnly || $master_alamat_list->rt_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_alamat_list->RowIndex ?>_rt_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_alamat_list->rt_id->Lookup->getParamTag($master_alamat_list, "p_x" . $master_alamat_list->RowIndex . "_rt_id") ?>
<input type="hidden" data-table="master_alamat" data-field="x_rt_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->rt_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_rt_id" id="x<?php echo $master_alamat_list->RowIndex ?>_rt_id" value="<?php echo $master_alamat_list->rt_id->CurrentValue ?>"<?php echo $master_alamat_list->rt_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_rt_id" name="o<?php echo $master_alamat_list->RowIndex ?>_rt_id" id="o<?php echo $master_alamat_list->RowIndex ?>_rt_id" value="<?php echo HtmlEncode($master_alamat_list->rt_id->OldValue) ?>">
<?php } ?>
<?php if ($master_alamat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_rt_id">
<span<?php echo $master_alamat_list->rt_id->viewAttributes() ?>><?php echo $master_alamat_list->rt_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_alamat_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $master_alamat_list->nama->cellAttributes() ?>>
<?php if ($master_alamat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_nama" class="form-group">
<input type="text" data-table="master_alamat" data-field="x_nama" name="x<?php echo $master_alamat_list->RowIndex ?>_nama" id="x<?php echo $master_alamat_list->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_alamat_list->nama->getPlaceHolder()) ?>" value="<?php echo $master_alamat_list->nama->EditValue ?>"<?php echo $master_alamat_list->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_nama" name="o<?php echo $master_alamat_list->RowIndex ?>_nama" id="o<?php echo $master_alamat_list->RowIndex ?>_nama" value="<?php echo HtmlEncode($master_alamat_list->nama->OldValue) ?>">
<?php } ?>
<?php if ($master_alamat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_nama">
<span<?php echo $master_alamat_list->nama->viewAttributes() ?>><?php echo $master_alamat_list->nama->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_alamat_list->na->Visible) { // na ?>
		<td data-name="na" <?php echo $master_alamat_list->na->cellAttributes() ?>>
<?php if ($master_alamat->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_na" class="form-group">
<div id="tp_x<?php echo $master_alamat_list->RowIndex ?>_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_alamat" data-field="x_na" data-value-separator="<?php echo $master_alamat_list->na->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_na" id="x<?php echo $master_alamat_list->RowIndex ?>_na" value="{value}"<?php echo $master_alamat_list->na->editAttributes() ?>></div>
<div id="dsl_x<?php echo $master_alamat_list->RowIndex ?>_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_alamat_list->na->radioButtonListHtml(FALSE, "x{$master_alamat_list->RowIndex}_na") ?>
</div></div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_na" name="o<?php echo $master_alamat_list->RowIndex ?>_na" id="o<?php echo $master_alamat_list->RowIndex ?>_na" value="<?php echo HtmlEncode($master_alamat_list->na->OldValue) ?>">
<?php } ?>
<?php if ($master_alamat->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_alamat_list->RowCount ?>_master_alamat_na">
<span<?php echo $master_alamat_list->na->viewAttributes() ?>><?php echo $master_alamat_list->na->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$master_alamat_list->ListOptions->render("body", "right", $master_alamat_list->RowCount);
?>
	</tr>
<?php if ($master_alamat->RowType == ROWTYPE_ADD || $master_alamat->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fmaster_alamatlist", "load"], function() {
	fmaster_alamatlist.updateLists(<?php echo $master_alamat_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$master_alamat_list->isGridAdd())
		if (!$master_alamat_list->Recordset->EOF)
			$master_alamat_list->Recordset->moveNext();
}
?>
<?php
	if ($master_alamat_list->isGridAdd() || $master_alamat_list->isGridEdit()) {
		$master_alamat_list->RowIndex = '$rowindex$';
		$master_alamat_list->loadRowValues();

		// Set row properties
		$master_alamat->resetAttributes();
		$master_alamat->RowAttrs->merge(["data-rowindex" => $master_alamat_list->RowIndex, "id" => "r0_master_alamat", "data-rowtype" => ROWTYPE_ADD]);
		$master_alamat->RowAttrs->appendClass("ew-template");
		$master_alamat->RowType = ROWTYPE_ADD;

		// Render row
		$master_alamat_list->renderRow();

		// Render list options
		$master_alamat_list->renderListOptions();
		$master_alamat_list->StartRowCount = 0;
?>
	<tr <?php echo $master_alamat->rowAttributes() ?>>
<?php

// Render list options (body, left)
$master_alamat_list->ListOptions->render("body", "left", $master_alamat_list->RowIndex);
?>
	<?php if ($master_alamat_list->id->Visible) { // id ?>
		<td data-name="id">
<span id="el$rowindex$_master_alamat_id" class="form-group master_alamat_id"></span>
<input type="hidden" data-table="master_alamat" data-field="x_id" name="o<?php echo $master_alamat_list->RowIndex ?>_id" id="o<?php echo $master_alamat_list->RowIndex ?>_id" value="<?php echo HtmlEncode($master_alamat_list->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_alamat_list->provinsi_id->Visible) { // provinsi_id ?>
		<td data-name="provinsi_id">
<span id="el$rowindex$_master_alamat_provinsi_id" class="form-group master_alamat_provinsi_id">
<?php
$onchange = $master_alamat_list->provinsi_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_list->provinsi_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id" id="sv_x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id" value="<?php echo RemoveHtml($master_alamat_list->provinsi_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_alamat_list->provinsi_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_list->provinsi_id->getPlaceHolder()) ?>"<?php echo $master_alamat_list->provinsi_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->provinsi_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->provinsi_id->ReadOnly || $master_alamat_list->provinsi_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_provinsi_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->provinsi_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id" id="x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id" value="<?php echo HtmlEncode($master_alamat_list->provinsi_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatlist"], function() {
	fmaster_alamatlist.createAutoSuggest({"id":"x<?php echo $master_alamat_list->RowIndex ?>_provinsi_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_list->provinsi_id->Lookup->getParamTag($master_alamat_list, "p_x" . $master_alamat_list->RowIndex . "_provinsi_id") ?>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_provinsi_id" name="o<?php echo $master_alamat_list->RowIndex ?>_provinsi_id" id="o<?php echo $master_alamat_list->RowIndex ?>_provinsi_id" value="<?php echo HtmlEncode($master_alamat_list->provinsi_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_alamat_list->kabupaten_id->Visible) { // kabupaten_id ?>
		<td data-name="kabupaten_id">
<span id="el$rowindex$_master_alamat_kabupaten_id" class="form-group master_alamat_kabupaten_id">
<?php
$onchange = $master_alamat_list->kabupaten_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_list->kabupaten_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id" id="sv_x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id" value="<?php echo RemoveHtml($master_alamat_list->kabupaten_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_alamat_list->kabupaten_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_list->kabupaten_id->getPlaceHolder()) ?>"<?php echo $master_alamat_list->kabupaten_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->kabupaten_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->kabupaten_id->ReadOnly || $master_alamat_list->kabupaten_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kabupaten_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->kabupaten_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id" id="x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id" value="<?php echo HtmlEncode($master_alamat_list->kabupaten_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatlist"], function() {
	fmaster_alamatlist.createAutoSuggest({"id":"x<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_list->kabupaten_id->Lookup->getParamTag($master_alamat_list, "p_x" . $master_alamat_list->RowIndex . "_kabupaten_id") ?>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kabupaten_id" name="o<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id" id="o<?php echo $master_alamat_list->RowIndex ?>_kabupaten_id" value="<?php echo HtmlEncode($master_alamat_list->kabupaten_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_alamat_list->kecamatan_id->Visible) { // kecamatan_id ?>
		<td data-name="kecamatan_id">
<span id="el$rowindex$_master_alamat_kecamatan_id" class="form-group master_alamat_kecamatan_id">
<?php
$onchange = $master_alamat_list->kecamatan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_list->kecamatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id" id="sv_x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id" value="<?php echo RemoveHtml($master_alamat_list->kecamatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_alamat_list->kecamatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_list->kecamatan_id->getPlaceHolder()) ?>"<?php echo $master_alamat_list->kecamatan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->kecamatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->kecamatan_id->ReadOnly || $master_alamat_list->kecamatan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kecamatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->kecamatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id" id="x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id" value="<?php echo HtmlEncode($master_alamat_list->kecamatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatlist"], function() {
	fmaster_alamatlist.createAutoSuggest({"id":"x<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_list->kecamatan_id->Lookup->getParamTag($master_alamat_list, "p_x" . $master_alamat_list->RowIndex . "_kecamatan_id") ?>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kecamatan_id" name="o<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id" id="o<?php echo $master_alamat_list->RowIndex ?>_kecamatan_id" value="<?php echo HtmlEncode($master_alamat_list->kecamatan_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_alamat_list->kelurahan_id->Visible) { // kelurahan_id ?>
		<td data-name="kelurahan_id">
<span id="el$rowindex$_master_alamat_kelurahan_id" class="form-group master_alamat_kelurahan_id">
<?php
$onchange = $master_alamat_list->kelurahan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$master_alamat_list->kelurahan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id" id="sv_x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id" value="<?php echo RemoveHtml($master_alamat_list->kelurahan_id->EditValue) ?>" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($master_alamat_list->kelurahan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($master_alamat_list->kelurahan_id->getPlaceHolder()) ?>"<?php echo $master_alamat_list->kelurahan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->kelurahan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->kelurahan_id->ReadOnly || $master_alamat_list->kelurahan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kelurahan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->kelurahan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id" id="x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id" value="<?php echo HtmlEncode($master_alamat_list->kelurahan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmaster_alamatlist"], function() {
	fmaster_alamatlist.createAutoSuggest({"id":"x<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id","forceSelect":true});
});
</script>
<?php echo $master_alamat_list->kelurahan_id->Lookup->getParamTag($master_alamat_list, "p_x" . $master_alamat_list->RowIndex . "_kelurahan_id") ?>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_kelurahan_id" name="o<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id" id="o<?php echo $master_alamat_list->RowIndex ?>_kelurahan_id" value="<?php echo HtmlEncode($master_alamat_list->kelurahan_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_alamat_list->rw_id->Visible) { // rw_id ?>
		<td data-name="rw_id">
<span id="el$rowindex$_master_alamat_rw_id" class="form-group master_alamat_rw_id">
<?php $master_alamat_list->rw_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $master_alamat_list->RowIndex ?>_rw_id"><?php echo EmptyValue(strval($master_alamat_list->rw_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_alamat_list->rw_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->rw_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->rw_id->ReadOnly || $master_alamat_list->rw_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_alamat_list->RowIndex ?>_rw_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_alamat_list->rw_id->Lookup->getParamTag($master_alamat_list, "p_x" . $master_alamat_list->RowIndex . "_rw_id") ?>
<input type="hidden" data-table="master_alamat" data-field="x_rw_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->rw_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_rw_id" id="x<?php echo $master_alamat_list->RowIndex ?>_rw_id" value="<?php echo $master_alamat_list->rw_id->CurrentValue ?>"<?php echo $master_alamat_list->rw_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_rw_id" name="o<?php echo $master_alamat_list->RowIndex ?>_rw_id" id="o<?php echo $master_alamat_list->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($master_alamat_list->rw_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_alamat_list->rt_id->Visible) { // rt_id ?>
		<td data-name="rt_id">
<span id="el$rowindex$_master_alamat_rt_id" class="form-group master_alamat_rt_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $master_alamat_list->RowIndex ?>_rt_id"><?php echo EmptyValue(strval($master_alamat_list->rt_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_alamat_list->rt_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_alamat_list->rt_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_alamat_list->rt_id->ReadOnly || $master_alamat_list->rt_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_alamat_list->RowIndex ?>_rt_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_alamat_list->rt_id->Lookup->getParamTag($master_alamat_list, "p_x" . $master_alamat_list->RowIndex . "_rt_id") ?>
<input type="hidden" data-table="master_alamat" data-field="x_rt_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_alamat_list->rt_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_rt_id" id="x<?php echo $master_alamat_list->RowIndex ?>_rt_id" value="<?php echo $master_alamat_list->rt_id->CurrentValue ?>"<?php echo $master_alamat_list->rt_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_rt_id" name="o<?php echo $master_alamat_list->RowIndex ?>_rt_id" id="o<?php echo $master_alamat_list->RowIndex ?>_rt_id" value="<?php echo HtmlEncode($master_alamat_list->rt_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_alamat_list->nama->Visible) { // nama ?>
		<td data-name="nama">
<span id="el$rowindex$_master_alamat_nama" class="form-group master_alamat_nama">
<input type="text" data-table="master_alamat" data-field="x_nama" name="x<?php echo $master_alamat_list->RowIndex ?>_nama" id="x<?php echo $master_alamat_list->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_alamat_list->nama->getPlaceHolder()) ?>" value="<?php echo $master_alamat_list->nama->EditValue ?>"<?php echo $master_alamat_list->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_nama" name="o<?php echo $master_alamat_list->RowIndex ?>_nama" id="o<?php echo $master_alamat_list->RowIndex ?>_nama" value="<?php echo HtmlEncode($master_alamat_list->nama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_alamat_list->na->Visible) { // na ?>
		<td data-name="na">
<span id="el$rowindex$_master_alamat_na" class="form-group master_alamat_na">
<div id="tp_x<?php echo $master_alamat_list->RowIndex ?>_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_alamat" data-field="x_na" data-value-separator="<?php echo $master_alamat_list->na->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_alamat_list->RowIndex ?>_na" id="x<?php echo $master_alamat_list->RowIndex ?>_na" value="{value}"<?php echo $master_alamat_list->na->editAttributes() ?>></div>
<div id="dsl_x<?php echo $master_alamat_list->RowIndex ?>_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_alamat_list->na->radioButtonListHtml(FALSE, "x{$master_alamat_list->RowIndex}_na") ?>
</div></div>
</span>
<input type="hidden" data-table="master_alamat" data-field="x_na" name="o<?php echo $master_alamat_list->RowIndex ?>_na" id="o<?php echo $master_alamat_list->RowIndex ?>_na" value="<?php echo HtmlEncode($master_alamat_list->na->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$master_alamat_list->ListOptions->render("body", "right", $master_alamat_list->RowIndex);
?>
<script>
loadjs.ready(["fmaster_alamatlist", "load"], function() {
	fmaster_alamatlist.updateLists(<?php echo $master_alamat_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($master_alamat_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $master_alamat_list->FormKeyCountName ?>" id="<?php echo $master_alamat_list->FormKeyCountName ?>" value="<?php echo $master_alamat_list->KeyCount ?>">
<?php echo $master_alamat_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$master_alamat->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($master_alamat_list->Recordset)
	$master_alamat_list->Recordset->Close();
?>
<?php if (!$master_alamat_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$master_alamat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_alamat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $master_alamat_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($master_alamat_list->TotalRecords == 0 && !$master_alamat->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $master_alamat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$master_alamat_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$master_alamat_list->isExport()) { ?>
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
$master_alamat_list->terminate();
?>