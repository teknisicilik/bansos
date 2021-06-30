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
$master_bantuan_list = new master_bantuan_list();

// Run the page
$master_bantuan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_bantuan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$master_bantuan_list->isExport()) { ?>
<script>
var fmaster_bantuanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmaster_bantuanlist = currentForm = new ew.Form("fmaster_bantuanlist", "list");
	fmaster_bantuanlist.formKeyCountName = '<?php echo $master_bantuan_list->FormKeyCountName ?>';

	// Validate form
	fmaster_bantuanlist.validate = function() {
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
			<?php if ($master_bantuan_list->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_list->id->caption(), $master_bantuan_list->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_list->jenis_bantuan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_bantuan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_list->jenis_bantuan_id->caption(), $master_bantuan_list->jenis_bantuan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_list->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_list->nama->caption(), $master_bantuan_list->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_list->type->Required) { ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_list->type->caption(), $master_bantuan_list->type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_list->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_list->jumlah->caption(), $master_bantuan_list->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_list->sumber_bantuan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sumber_bantuan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_list->sumber_bantuan_id->caption(), $master_bantuan_list->sumber_bantuan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_list->pengambilan_bantuuan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_pengambilan_bantuuan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_list->pengambilan_bantuuan_id->caption(), $master_bantuan_list->pengambilan_bantuuan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_list->frekuensi->Required) { ?>
				elm = this.getElements("x" + infix + "_frekuensi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_list->frekuensi->caption(), $master_bantuan_list->frekuensi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_list->bulan->Required) { ?>
				elm = this.getElements("x" + infix + "_bulan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_list->bulan->caption(), $master_bantuan_list->bulan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_list->tahun->Required) { ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_list->tahun->caption(), $master_bantuan_list->tahun->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tahun");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($master_bantuan_list->tahun->errorMessage()) ?>");
			<?php if ($master_bantuan_list->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_list->status->caption(), $master_bantuan_list->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($master_bantuan_list->na->Required) { ?>
				elm = this.getElements("x" + infix + "_na");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $master_bantuan_list->na->caption(), $master_bantuan_list->na->RequiredErrorMessage)) ?>");
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
	fmaster_bantuanlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "jenis_bantuan_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "nama", false)) return false;
		if (ew.valueChanged(fobj, infix, "type", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlah", false)) return false;
		if (ew.valueChanged(fobj, infix, "sumber_bantuan_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "pengambilan_bantuuan_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "frekuensi", false)) return false;
		if (ew.valueChanged(fobj, infix, "bulan", false)) return false;
		if (ew.valueChanged(fobj, infix, "tahun", false)) return false;
		if (ew.valueChanged(fobj, infix, "status", false)) return false;
		if (ew.valueChanged(fobj, infix, "na", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fmaster_bantuanlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaster_bantuanlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmaster_bantuanlist.lists["x_jenis_bantuan_id"] = <?php echo $master_bantuan_list->jenis_bantuan_id->Lookup->toClientList($master_bantuan_list) ?>;
	fmaster_bantuanlist.lists["x_jenis_bantuan_id"].options = <?php echo JsonEncode($master_bantuan_list->jenis_bantuan_id->lookupOptions()) ?>;
	fmaster_bantuanlist.lists["x_type"] = <?php echo $master_bantuan_list->type->Lookup->toClientList($master_bantuan_list) ?>;
	fmaster_bantuanlist.lists["x_type"].options = <?php echo JsonEncode($master_bantuan_list->type->options(FALSE, TRUE)) ?>;
	fmaster_bantuanlist.lists["x_sumber_bantuan_id"] = <?php echo $master_bantuan_list->sumber_bantuan_id->Lookup->toClientList($master_bantuan_list) ?>;
	fmaster_bantuanlist.lists["x_sumber_bantuan_id"].options = <?php echo JsonEncode($master_bantuan_list->sumber_bantuan_id->lookupOptions()) ?>;
	fmaster_bantuanlist.lists["x_pengambilan_bantuuan_id"] = <?php echo $master_bantuan_list->pengambilan_bantuuan_id->Lookup->toClientList($master_bantuan_list) ?>;
	fmaster_bantuanlist.lists["x_pengambilan_bantuuan_id"].options = <?php echo JsonEncode($master_bantuan_list->pengambilan_bantuuan_id->lookupOptions()) ?>;
	fmaster_bantuanlist.lists["x_bulan"] = <?php echo $master_bantuan_list->bulan->Lookup->toClientList($master_bantuan_list) ?>;
	fmaster_bantuanlist.lists["x_bulan"].options = <?php echo JsonEncode($master_bantuan_list->bulan->options(FALSE, TRUE)) ?>;
	fmaster_bantuanlist.lists["x_status"] = <?php echo $master_bantuan_list->status->Lookup->toClientList($master_bantuan_list) ?>;
	fmaster_bantuanlist.lists["x_status"].options = <?php echo JsonEncode($master_bantuan_list->status->options(FALSE, TRUE)) ?>;
	fmaster_bantuanlist.lists["x_na"] = <?php echo $master_bantuan_list->na->Lookup->toClientList($master_bantuan_list) ?>;
	fmaster_bantuanlist.lists["x_na"].options = <?php echo JsonEncode($master_bantuan_list->na->options(FALSE, TRUE)) ?>;
	loadjs.done("fmaster_bantuanlist");
});
var fmaster_bantuanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmaster_bantuanlistsrch = currentSearchForm = new ew.Form("fmaster_bantuanlistsrch");

	// Validate function for search
	fmaster_bantuanlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tahun");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($master_bantuan_list->tahun->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fmaster_bantuanlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaster_bantuanlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmaster_bantuanlistsrch.lists["x_jenis_bantuan_id"] = <?php echo $master_bantuan_list->jenis_bantuan_id->Lookup->toClientList($master_bantuan_list) ?>;
	fmaster_bantuanlistsrch.lists["x_jenis_bantuan_id"].options = <?php echo JsonEncode($master_bantuan_list->jenis_bantuan_id->lookupOptions()) ?>;
	fmaster_bantuanlistsrch.lists["x_type"] = <?php echo $master_bantuan_list->type->Lookup->toClientList($master_bantuan_list) ?>;
	fmaster_bantuanlistsrch.lists["x_type"].options = <?php echo JsonEncode($master_bantuan_list->type->options(FALSE, TRUE)) ?>;
	fmaster_bantuanlistsrch.lists["x_sumber_bantuan_id"] = <?php echo $master_bantuan_list->sumber_bantuan_id->Lookup->toClientList($master_bantuan_list) ?>;
	fmaster_bantuanlistsrch.lists["x_sumber_bantuan_id"].options = <?php echo JsonEncode($master_bantuan_list->sumber_bantuan_id->lookupOptions()) ?>;
	fmaster_bantuanlistsrch.lists["x_na"] = <?php echo $master_bantuan_list->na->Lookup->toClientList($master_bantuan_list) ?>;
	fmaster_bantuanlistsrch.lists["x_na"].options = <?php echo JsonEncode($master_bantuan_list->na->options(FALSE, TRUE)) ?>;

	// Filters
	fmaster_bantuanlistsrch.filterList = <?php echo $master_bantuan_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmaster_bantuanlistsrch.initSearchPanel = true;
	loadjs.done("fmaster_bantuanlistsrch");
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
<?php if (!$master_bantuan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($master_bantuan_list->TotalRecords > 0 && $master_bantuan_list->ExportOptions->visible()) { ?>
<?php $master_bantuan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($master_bantuan_list->ImportOptions->visible()) { ?>
<?php $master_bantuan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($master_bantuan_list->SearchOptions->visible()) { ?>
<?php $master_bantuan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($master_bantuan_list->FilterOptions->visible()) { ?>
<?php $master_bantuan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$master_bantuan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$master_bantuan_list->isExport() && !$master_bantuan->CurrentAction) { ?>
<form name="fmaster_bantuanlistsrch" id="fmaster_bantuanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmaster_bantuanlistsrch-search-panel" class="<?php echo $master_bantuan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="master_bantuan">
	<div class="ew-extended-search">
<?php

// Render search row
$master_bantuan->RowType = ROWTYPE_SEARCH;
$master_bantuan->resetAttributes();
$master_bantuan_list->renderRow();
?>
<?php if ($master_bantuan_list->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
	<?php
		$master_bantuan_list->SearchColumnCount++;
		if (($master_bantuan_list->SearchColumnCount - 1) % $master_bantuan_list->SearchFieldsPerRow == 0) {
			$master_bantuan_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_bantuan_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_jenis_bantuan_id" class="ew-cell form-group">
		<label for="x_jenis_bantuan_id" class="ew-search-caption ew-label"><?php echo $master_bantuan_list->jenis_bantuan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jenis_bantuan_id" id="z_jenis_bantuan_id" value="=">
</span>
		<span id="el_master_bantuan_jenis_bantuan_id" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="master_bantuan" data-field="x_jenis_bantuan_id" data-value-separator="<?php echo $master_bantuan_list->jenis_bantuan_id->displayValueSeparatorAttribute() ?>" id="x_jenis_bantuan_id" name="x_jenis_bantuan_id"<?php echo $master_bantuan_list->jenis_bantuan_id->editAttributes() ?>>
			<?php echo $master_bantuan_list->jenis_bantuan_id->selectOptionListHtml("x_jenis_bantuan_id") ?>
		</select>
</div>
<?php echo $master_bantuan_list->jenis_bantuan_id->Lookup->getParamTag($master_bantuan_list, "p_x_jenis_bantuan_id") ?>
</span>
	</div>
	<?php if ($master_bantuan_list->SearchColumnCount % $master_bantuan_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->type->Visible) { // type ?>
	<?php
		$master_bantuan_list->SearchColumnCount++;
		if (($master_bantuan_list->SearchColumnCount - 1) % $master_bantuan_list->SearchFieldsPerRow == 0) {
			$master_bantuan_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_bantuan_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_type" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_bantuan_list->type->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_type" id="z_type" value="=">
</span>
		<span id="el_master_bantuan_type" class="ew-search-field">
<div id="tp_x_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_bantuan" data-field="x_type" data-value-separator="<?php echo $master_bantuan_list->type->displayValueSeparatorAttribute() ?>" name="x_type" id="x_type" value="{value}"<?php echo $master_bantuan_list->type->editAttributes() ?>></div>
<div id="dsl_x_type" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_bantuan_list->type->radioButtonListHtml(FALSE, "x_type") ?>
</div></div>
</span>
	</div>
	<?php if ($master_bantuan_list->SearchColumnCount % $master_bantuan_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
	<?php
		$master_bantuan_list->SearchColumnCount++;
		if (($master_bantuan_list->SearchColumnCount - 1) % $master_bantuan_list->SearchFieldsPerRow == 0) {
			$master_bantuan_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_bantuan_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_sumber_bantuan_id" class="ew-cell form-group">
		<label for="x_sumber_bantuan_id" class="ew-search-caption ew-label"><?php echo $master_bantuan_list->sumber_bantuan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_sumber_bantuan_id" id="z_sumber_bantuan_id" value="=">
</span>
		<span id="el_master_bantuan_sumber_bantuan_id" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_sumber_bantuan_id"><?php echo EmptyValue(strval($master_bantuan_list->sumber_bantuan_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_bantuan_list->sumber_bantuan_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_bantuan_list->sumber_bantuan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_bantuan_list->sumber_bantuan_id->ReadOnly || $master_bantuan_list->sumber_bantuan_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_sumber_bantuan_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_bantuan_list->sumber_bantuan_id->Lookup->getParamTag($master_bantuan_list, "p_x_sumber_bantuan_id") ?>
<input type="hidden" data-table="master_bantuan" data-field="x_sumber_bantuan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_bantuan_list->sumber_bantuan_id->displayValueSeparatorAttribute() ?>" name="x_sumber_bantuan_id" id="x_sumber_bantuan_id" value="<?php echo $master_bantuan_list->sumber_bantuan_id->AdvancedSearch->SearchValue ?>"<?php echo $master_bantuan_list->sumber_bantuan_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($master_bantuan_list->SearchColumnCount % $master_bantuan_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->tahun->Visible) { // tahun ?>
	<?php
		$master_bantuan_list->SearchColumnCount++;
		if (($master_bantuan_list->SearchColumnCount - 1) % $master_bantuan_list->SearchFieldsPerRow == 0) {
			$master_bantuan_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_bantuan_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun" class="ew-cell form-group">
		<label for="x_tahun" class="ew-search-caption ew-label"><?php echo $master_bantuan_list->tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun" id="z_tahun" value="=">
</span>
		<span id="el_master_bantuan_tahun" class="ew-search-field">
<input type="text" data-table="master_bantuan" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_bantuan_list->tahun->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_list->tahun->EditValue ?>"<?php echo $master_bantuan_list->tahun->editAttributes() ?>>
</span>
	</div>
	<?php if ($master_bantuan_list->SearchColumnCount % $master_bantuan_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->na->Visible) { // na ?>
	<?php
		$master_bantuan_list->SearchColumnCount++;
		if (($master_bantuan_list->SearchColumnCount - 1) % $master_bantuan_list->SearchFieldsPerRow == 0) {
			$master_bantuan_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_bantuan_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_na" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_bantuan_list->na->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_na" id="z_na" value="=">
</span>
		<span id="el_master_bantuan_na" class="ew-search-field">
<div id="tp_x_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_bantuan" data-field="x_na" data-value-separator="<?php echo $master_bantuan_list->na->displayValueSeparatorAttribute() ?>" name="x_na" id="x_na" value="{value}"<?php echo $master_bantuan_list->na->editAttributes() ?>></div>
<div id="dsl_x_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_bantuan_list->na->radioButtonListHtml(FALSE, "x_na") ?>
</div></div>
</span>
	</div>
	<?php if ($master_bantuan_list->SearchColumnCount % $master_bantuan_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($master_bantuan_list->SearchColumnCount % $master_bantuan_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $master_bantuan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($master_bantuan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($master_bantuan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $master_bantuan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($master_bantuan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($master_bantuan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($master_bantuan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($master_bantuan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $master_bantuan_list->showPageHeader(); ?>
<?php
$master_bantuan_list->showMessage();
?>
<?php if ($master_bantuan_list->TotalRecords > 0 || $master_bantuan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($master_bantuan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> master_bantuan">
<?php if (!$master_bantuan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$master_bantuan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_bantuan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $master_bantuan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmaster_bantuanlist" id="fmaster_bantuanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_bantuan">
<div id="gmp_master_bantuan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($master_bantuan_list->TotalRecords > 0 || $master_bantuan_list->isGridEdit()) { ?>
<table id="tbl_master_bantuanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$master_bantuan->RowType = ROWTYPE_HEADER;

// Render list options
$master_bantuan_list->renderListOptions();

// Render list options (header, left)
$master_bantuan_list->ListOptions->render("header", "left");
?>
<?php if ($master_bantuan_list->id->Visible) { // id ?>
	<?php if ($master_bantuan_list->SortUrl($master_bantuan_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $master_bantuan_list->id->headerCellClass() ?>"><div id="elh_master_bantuan_id" class="master_bantuan_id"><div class="ew-table-header-caption"><?php echo $master_bantuan_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $master_bantuan_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_bantuan_list->SortUrl($master_bantuan_list->id) ?>', 1);"><div id="elh_master_bantuan_id" class="master_bantuan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_bantuan_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_bantuan_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_bantuan_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
	<?php if ($master_bantuan_list->SortUrl($master_bantuan_list->jenis_bantuan_id) == "") { ?>
		<th data-name="jenis_bantuan_id" class="<?php echo $master_bantuan_list->jenis_bantuan_id->headerCellClass() ?>"><div id="elh_master_bantuan_jenis_bantuan_id" class="master_bantuan_jenis_bantuan_id"><div class="ew-table-header-caption"><?php echo $master_bantuan_list->jenis_bantuan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_bantuan_id" class="<?php echo $master_bantuan_list->jenis_bantuan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_bantuan_list->SortUrl($master_bantuan_list->jenis_bantuan_id) ?>', 1);"><div id="elh_master_bantuan_jenis_bantuan_id" class="master_bantuan_jenis_bantuan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_bantuan_list->jenis_bantuan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_bantuan_list->jenis_bantuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_bantuan_list->jenis_bantuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->nama->Visible) { // nama ?>
	<?php if ($master_bantuan_list->SortUrl($master_bantuan_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $master_bantuan_list->nama->headerCellClass() ?>"><div id="elh_master_bantuan_nama" class="master_bantuan_nama"><div class="ew-table-header-caption"><?php echo $master_bantuan_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $master_bantuan_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_bantuan_list->SortUrl($master_bantuan_list->nama) ?>', 1);"><div id="elh_master_bantuan_nama" class="master_bantuan_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_bantuan_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($master_bantuan_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_bantuan_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->type->Visible) { // type ?>
	<?php if ($master_bantuan_list->SortUrl($master_bantuan_list->type) == "") { ?>
		<th data-name="type" class="<?php echo $master_bantuan_list->type->headerCellClass() ?>"><div id="elh_master_bantuan_type" class="master_bantuan_type"><div class="ew-table-header-caption"><?php echo $master_bantuan_list->type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type" class="<?php echo $master_bantuan_list->type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_bantuan_list->SortUrl($master_bantuan_list->type) ?>', 1);"><div id="elh_master_bantuan_type" class="master_bantuan_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_bantuan_list->type->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_bantuan_list->type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_bantuan_list->type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->jumlah->Visible) { // jumlah ?>
	<?php if ($master_bantuan_list->SortUrl($master_bantuan_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $master_bantuan_list->jumlah->headerCellClass() ?>"><div id="elh_master_bantuan_jumlah" class="master_bantuan_jumlah"><div class="ew-table-header-caption"><?php echo $master_bantuan_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $master_bantuan_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_bantuan_list->SortUrl($master_bantuan_list->jumlah) ?>', 1);"><div id="elh_master_bantuan_jumlah" class="master_bantuan_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_bantuan_list->jumlah->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($master_bantuan_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_bantuan_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
	<?php if ($master_bantuan_list->SortUrl($master_bantuan_list->sumber_bantuan_id) == "") { ?>
		<th data-name="sumber_bantuan_id" class="<?php echo $master_bantuan_list->sumber_bantuan_id->headerCellClass() ?>"><div id="elh_master_bantuan_sumber_bantuan_id" class="master_bantuan_sumber_bantuan_id"><div class="ew-table-header-caption"><?php echo $master_bantuan_list->sumber_bantuan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sumber_bantuan_id" class="<?php echo $master_bantuan_list->sumber_bantuan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_bantuan_list->SortUrl($master_bantuan_list->sumber_bantuan_id) ?>', 1);"><div id="elh_master_bantuan_sumber_bantuan_id" class="master_bantuan_sumber_bantuan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_bantuan_list->sumber_bantuan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_bantuan_list->sumber_bantuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_bantuan_list->sumber_bantuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->pengambilan_bantuuan_id->Visible) { // pengambilan_bantuuan_id ?>
	<?php if ($master_bantuan_list->SortUrl($master_bantuan_list->pengambilan_bantuuan_id) == "") { ?>
		<th data-name="pengambilan_bantuuan_id" class="<?php echo $master_bantuan_list->pengambilan_bantuuan_id->headerCellClass() ?>"><div id="elh_master_bantuan_pengambilan_bantuuan_id" class="master_bantuan_pengambilan_bantuuan_id"><div class="ew-table-header-caption"><?php echo $master_bantuan_list->pengambilan_bantuuan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pengambilan_bantuuan_id" class="<?php echo $master_bantuan_list->pengambilan_bantuuan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_bantuan_list->SortUrl($master_bantuan_list->pengambilan_bantuuan_id) ?>', 1);"><div id="elh_master_bantuan_pengambilan_bantuuan_id" class="master_bantuan_pengambilan_bantuuan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_bantuan_list->pengambilan_bantuuan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_bantuan_list->pengambilan_bantuuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_bantuan_list->pengambilan_bantuuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->frekuensi->Visible) { // frekuensi ?>
	<?php if ($master_bantuan_list->SortUrl($master_bantuan_list->frekuensi) == "") { ?>
		<th data-name="frekuensi" class="<?php echo $master_bantuan_list->frekuensi->headerCellClass() ?>"><div id="elh_master_bantuan_frekuensi" class="master_bantuan_frekuensi"><div class="ew-table-header-caption"><?php echo $master_bantuan_list->frekuensi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="frekuensi" class="<?php echo $master_bantuan_list->frekuensi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_bantuan_list->SortUrl($master_bantuan_list->frekuensi) ?>', 1);"><div id="elh_master_bantuan_frekuensi" class="master_bantuan_frekuensi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_bantuan_list->frekuensi->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($master_bantuan_list->frekuensi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_bantuan_list->frekuensi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->bulan->Visible) { // bulan ?>
	<?php if ($master_bantuan_list->SortUrl($master_bantuan_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $master_bantuan_list->bulan->headerCellClass() ?>"><div id="elh_master_bantuan_bulan" class="master_bantuan_bulan"><div class="ew-table-header-caption"><?php echo $master_bantuan_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $master_bantuan_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_bantuan_list->SortUrl($master_bantuan_list->bulan) ?>', 1);"><div id="elh_master_bantuan_bulan" class="master_bantuan_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_bantuan_list->bulan->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_bantuan_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_bantuan_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->tahun->Visible) { // tahun ?>
	<?php if ($master_bantuan_list->SortUrl($master_bantuan_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $master_bantuan_list->tahun->headerCellClass() ?>"><div id="elh_master_bantuan_tahun" class="master_bantuan_tahun"><div class="ew-table-header-caption"><?php echo $master_bantuan_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $master_bantuan_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_bantuan_list->SortUrl($master_bantuan_list->tahun) ?>', 1);"><div id="elh_master_bantuan_tahun" class="master_bantuan_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_bantuan_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_bantuan_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_bantuan_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->status->Visible) { // status ?>
	<?php if ($master_bantuan_list->SortUrl($master_bantuan_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $master_bantuan_list->status->headerCellClass() ?>"><div id="elh_master_bantuan_status" class="master_bantuan_status"><div class="ew-table-header-caption"><?php echo $master_bantuan_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $master_bantuan_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_bantuan_list->SortUrl($master_bantuan_list->status) ?>', 1);"><div id="elh_master_bantuan_status" class="master_bantuan_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_bantuan_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_bantuan_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_bantuan_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_bantuan_list->na->Visible) { // na ?>
	<?php if ($master_bantuan_list->SortUrl($master_bantuan_list->na) == "") { ?>
		<th data-name="na" class="<?php echo $master_bantuan_list->na->headerCellClass() ?>"><div id="elh_master_bantuan_na" class="master_bantuan_na"><div class="ew-table-header-caption"><?php echo $master_bantuan_list->na->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="na" class="<?php echo $master_bantuan_list->na->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_bantuan_list->SortUrl($master_bantuan_list->na) ?>', 1);"><div id="elh_master_bantuan_na" class="master_bantuan_na">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_bantuan_list->na->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_bantuan_list->na->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_bantuan_list->na->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$master_bantuan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($master_bantuan_list->ExportAll && $master_bantuan_list->isExport()) {
	$master_bantuan_list->StopRecord = $master_bantuan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($master_bantuan_list->TotalRecords > $master_bantuan_list->StartRecord + $master_bantuan_list->DisplayRecords - 1)
		$master_bantuan_list->StopRecord = $master_bantuan_list->StartRecord + $master_bantuan_list->DisplayRecords - 1;
	else
		$master_bantuan_list->StopRecord = $master_bantuan_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($master_bantuan->isConfirm() || $master_bantuan_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($master_bantuan_list->FormKeyCountName) && ($master_bantuan_list->isGridAdd() || $master_bantuan_list->isGridEdit() || $master_bantuan->isConfirm())) {
		$master_bantuan_list->KeyCount = $CurrentForm->getValue($master_bantuan_list->FormKeyCountName);
		$master_bantuan_list->StopRecord = $master_bantuan_list->StartRecord + $master_bantuan_list->KeyCount - 1;
	}
}
$master_bantuan_list->RecordCount = $master_bantuan_list->StartRecord - 1;
if ($master_bantuan_list->Recordset && !$master_bantuan_list->Recordset->EOF) {
	$master_bantuan_list->Recordset->moveFirst();
	$selectLimit = $master_bantuan_list->UseSelectLimit;
	if (!$selectLimit && $master_bantuan_list->StartRecord > 1)
		$master_bantuan_list->Recordset->move($master_bantuan_list->StartRecord - 1);
} elseif (!$master_bantuan->AllowAddDeleteRow && $master_bantuan_list->StopRecord == 0) {
	$master_bantuan_list->StopRecord = $master_bantuan->GridAddRowCount;
}

// Initialize aggregate
$master_bantuan->RowType = ROWTYPE_AGGREGATEINIT;
$master_bantuan->resetAttributes();
$master_bantuan_list->renderRow();
if ($master_bantuan_list->isGridAdd())
	$master_bantuan_list->RowIndex = 0;
while ($master_bantuan_list->RecordCount < $master_bantuan_list->StopRecord) {
	$master_bantuan_list->RecordCount++;
	if ($master_bantuan_list->RecordCount >= $master_bantuan_list->StartRecord) {
		$master_bantuan_list->RowCount++;
		if ($master_bantuan_list->isGridAdd() || $master_bantuan_list->isGridEdit() || $master_bantuan->isConfirm()) {
			$master_bantuan_list->RowIndex++;
			$CurrentForm->Index = $master_bantuan_list->RowIndex;
			if ($CurrentForm->hasValue($master_bantuan_list->FormActionName) && ($master_bantuan->isConfirm() || $master_bantuan_list->EventCancelled))
				$master_bantuan_list->RowAction = strval($CurrentForm->getValue($master_bantuan_list->FormActionName));
			elseif ($master_bantuan_list->isGridAdd())
				$master_bantuan_list->RowAction = "insert";
			else
				$master_bantuan_list->RowAction = "";
		}

		// Set up key count
		$master_bantuan_list->KeyCount = $master_bantuan_list->RowIndex;

		// Init row class and style
		$master_bantuan->resetAttributes();
		$master_bantuan->CssClass = "";
		if ($master_bantuan_list->isGridAdd()) {
			$master_bantuan_list->loadRowValues(); // Load default values
		} else {
			$master_bantuan_list->loadRowValues($master_bantuan_list->Recordset); // Load row values
		}
		$master_bantuan->RowType = ROWTYPE_VIEW; // Render view
		if ($master_bantuan_list->isGridAdd()) // Grid add
			$master_bantuan->RowType = ROWTYPE_ADD; // Render add
		if ($master_bantuan_list->isGridAdd() && $master_bantuan->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$master_bantuan_list->restoreCurrentRowFormValues($master_bantuan_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$master_bantuan->RowAttrs->merge(["data-rowindex" => $master_bantuan_list->RowCount, "id" => "r" . $master_bantuan_list->RowCount . "_master_bantuan", "data-rowtype" => $master_bantuan->RowType]);

		// Render row
		$master_bantuan_list->renderRow();

		// Render list options
		$master_bantuan_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($master_bantuan_list->RowAction != "delete" && $master_bantuan_list->RowAction != "insertdelete" && !($master_bantuan_list->RowAction == "insert" && $master_bantuan->isConfirm() && $master_bantuan_list->emptyRow())) {
?>
	<tr <?php echo $master_bantuan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$master_bantuan_list->ListOptions->render("body", "left", $master_bantuan_list->RowCount);
?>
	<?php if ($master_bantuan_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $master_bantuan_list->id->cellAttributes() ?>>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_id" class="form-group"></span>
<input type="hidden" data-table="master_bantuan" data-field="x_id" name="o<?php echo $master_bantuan_list->RowIndex ?>_id" id="o<?php echo $master_bantuan_list->RowIndex ?>_id" value="<?php echo HtmlEncode($master_bantuan_list->id->OldValue) ?>">
<?php } ?>
<?php if ($master_bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_id">
<span<?php echo $master_bantuan_list->id->viewAttributes() ?>><?php echo $master_bantuan_list->id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
		<td data-name="jenis_bantuan_id" <?php echo $master_bantuan_list->jenis_bantuan_id->cellAttributes() ?>>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_jenis_bantuan_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="master_bantuan" data-field="x_jenis_bantuan_id" data-value-separator="<?php echo $master_bantuan_list->jenis_bantuan_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $master_bantuan_list->RowIndex ?>_jenis_bantuan_id" name="x<?php echo $master_bantuan_list->RowIndex ?>_jenis_bantuan_id"<?php echo $master_bantuan_list->jenis_bantuan_id->editAttributes() ?>>
			<?php echo $master_bantuan_list->jenis_bantuan_id->selectOptionListHtml("x{$master_bantuan_list->RowIndex}_jenis_bantuan_id") ?>
		</select>
</div>
<?php echo $master_bantuan_list->jenis_bantuan_id->Lookup->getParamTag($master_bantuan_list, "p_x" . $master_bantuan_list->RowIndex . "_jenis_bantuan_id") ?>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_jenis_bantuan_id" name="o<?php echo $master_bantuan_list->RowIndex ?>_jenis_bantuan_id" id="o<?php echo $master_bantuan_list->RowIndex ?>_jenis_bantuan_id" value="<?php echo HtmlEncode($master_bantuan_list->jenis_bantuan_id->OldValue) ?>">
<?php } ?>
<?php if ($master_bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_jenis_bantuan_id">
<span<?php echo $master_bantuan_list->jenis_bantuan_id->viewAttributes() ?>><?php echo $master_bantuan_list->jenis_bantuan_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $master_bantuan_list->nama->cellAttributes() ?>>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_nama" class="form-group">
<input type="text" data-table="master_bantuan" data-field="x_nama" name="x<?php echo $master_bantuan_list->RowIndex ?>_nama" id="x<?php echo $master_bantuan_list->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_bantuan_list->nama->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_list->nama->EditValue ?>"<?php echo $master_bantuan_list->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_nama" name="o<?php echo $master_bantuan_list->RowIndex ?>_nama" id="o<?php echo $master_bantuan_list->RowIndex ?>_nama" value="<?php echo HtmlEncode($master_bantuan_list->nama->OldValue) ?>">
<?php } ?>
<?php if ($master_bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_nama">
<span<?php echo $master_bantuan_list->nama->viewAttributes() ?>><?php echo $master_bantuan_list->nama->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->type->Visible) { // type ?>
		<td data-name="type" <?php echo $master_bantuan_list->type->cellAttributes() ?>>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_type" class="form-group">
<div id="tp_x<?php echo $master_bantuan_list->RowIndex ?>_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_bantuan" data-field="x_type" data-value-separator="<?php echo $master_bantuan_list->type->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_bantuan_list->RowIndex ?>_type" id="x<?php echo $master_bantuan_list->RowIndex ?>_type" value="{value}"<?php echo $master_bantuan_list->type->editAttributes() ?>></div>
<div id="dsl_x<?php echo $master_bantuan_list->RowIndex ?>_type" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_bantuan_list->type->radioButtonListHtml(FALSE, "x{$master_bantuan_list->RowIndex}_type") ?>
</div></div>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_type" name="o<?php echo $master_bantuan_list->RowIndex ?>_type" id="o<?php echo $master_bantuan_list->RowIndex ?>_type" value="<?php echo HtmlEncode($master_bantuan_list->type->OldValue) ?>">
<?php } ?>
<?php if ($master_bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_type">
<span<?php echo $master_bantuan_list->type->viewAttributes() ?>><?php echo $master_bantuan_list->type->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $master_bantuan_list->jumlah->cellAttributes() ?>>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_jumlah" class="form-group">
<input type="text" data-table="master_bantuan" data-field="x_jumlah" name="x<?php echo $master_bantuan_list->RowIndex ?>_jumlah" id="x<?php echo $master_bantuan_list->RowIndex ?>_jumlah" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_bantuan_list->jumlah->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_list->jumlah->EditValue ?>"<?php echo $master_bantuan_list->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_jumlah" name="o<?php echo $master_bantuan_list->RowIndex ?>_jumlah" id="o<?php echo $master_bantuan_list->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($master_bantuan_list->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($master_bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_jumlah">
<span<?php echo $master_bantuan_list->jumlah->viewAttributes() ?>><?php echo $master_bantuan_list->jumlah->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
		<td data-name="sumber_bantuan_id" <?php echo $master_bantuan_list->sumber_bantuan_id->cellAttributes() ?>>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_sumber_bantuan_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $master_bantuan_list->RowIndex ?>_sumber_bantuan_id"><?php echo EmptyValue(strval($master_bantuan_list->sumber_bantuan_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_bantuan_list->sumber_bantuan_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_bantuan_list->sumber_bantuan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_bantuan_list->sumber_bantuan_id->ReadOnly || $master_bantuan_list->sumber_bantuan_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_bantuan_list->RowIndex ?>_sumber_bantuan_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_bantuan_list->sumber_bantuan_id->Lookup->getParamTag($master_bantuan_list, "p_x" . $master_bantuan_list->RowIndex . "_sumber_bantuan_id") ?>
<input type="hidden" data-table="master_bantuan" data-field="x_sumber_bantuan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_bantuan_list->sumber_bantuan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_bantuan_list->RowIndex ?>_sumber_bantuan_id" id="x<?php echo $master_bantuan_list->RowIndex ?>_sumber_bantuan_id" value="<?php echo $master_bantuan_list->sumber_bantuan_id->CurrentValue ?>"<?php echo $master_bantuan_list->sumber_bantuan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_sumber_bantuan_id" name="o<?php echo $master_bantuan_list->RowIndex ?>_sumber_bantuan_id" id="o<?php echo $master_bantuan_list->RowIndex ?>_sumber_bantuan_id" value="<?php echo HtmlEncode($master_bantuan_list->sumber_bantuan_id->OldValue) ?>">
<?php } ?>
<?php if ($master_bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_sumber_bantuan_id">
<span<?php echo $master_bantuan_list->sumber_bantuan_id->viewAttributes() ?>><?php echo $master_bantuan_list->sumber_bantuan_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->pengambilan_bantuuan_id->Visible) { // pengambilan_bantuuan_id ?>
		<td data-name="pengambilan_bantuuan_id" <?php echo $master_bantuan_list->pengambilan_bantuuan_id->cellAttributes() ?>>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_pengambilan_bantuuan_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $master_bantuan_list->RowIndex ?>_pengambilan_bantuuan_id"><?php echo EmptyValue(strval($master_bantuan_list->pengambilan_bantuuan_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_bantuan_list->pengambilan_bantuuan_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_bantuan_list->pengambilan_bantuuan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_bantuan_list->pengambilan_bantuuan_id->ReadOnly || $master_bantuan_list->pengambilan_bantuuan_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_bantuan_list->RowIndex ?>_pengambilan_bantuuan_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_bantuan_list->pengambilan_bantuuan_id->Lookup->getParamTag($master_bantuan_list, "p_x" . $master_bantuan_list->RowIndex . "_pengambilan_bantuuan_id") ?>
<input type="hidden" data-table="master_bantuan" data-field="x_pengambilan_bantuuan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_bantuan_list->pengambilan_bantuuan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_bantuan_list->RowIndex ?>_pengambilan_bantuuan_id" id="x<?php echo $master_bantuan_list->RowIndex ?>_pengambilan_bantuuan_id" value="<?php echo $master_bantuan_list->pengambilan_bantuuan_id->CurrentValue ?>"<?php echo $master_bantuan_list->pengambilan_bantuuan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_pengambilan_bantuuan_id" name="o<?php echo $master_bantuan_list->RowIndex ?>_pengambilan_bantuuan_id" id="o<?php echo $master_bantuan_list->RowIndex ?>_pengambilan_bantuuan_id" value="<?php echo HtmlEncode($master_bantuan_list->pengambilan_bantuuan_id->OldValue) ?>">
<?php } ?>
<?php if ($master_bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_pengambilan_bantuuan_id">
<span<?php echo $master_bantuan_list->pengambilan_bantuuan_id->viewAttributes() ?>><?php echo $master_bantuan_list->pengambilan_bantuuan_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->frekuensi->Visible) { // frekuensi ?>
		<td data-name="frekuensi" <?php echo $master_bantuan_list->frekuensi->cellAttributes() ?>>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_frekuensi" class="form-group">
<input type="text" data-table="master_bantuan" data-field="x_frekuensi" name="x<?php echo $master_bantuan_list->RowIndex ?>_frekuensi" id="x<?php echo $master_bantuan_list->RowIndex ?>_frekuensi" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_bantuan_list->frekuensi->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_list->frekuensi->EditValue ?>"<?php echo $master_bantuan_list->frekuensi->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_frekuensi" name="o<?php echo $master_bantuan_list->RowIndex ?>_frekuensi" id="o<?php echo $master_bantuan_list->RowIndex ?>_frekuensi" value="<?php echo HtmlEncode($master_bantuan_list->frekuensi->OldValue) ?>">
<?php } ?>
<?php if ($master_bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_frekuensi">
<span<?php echo $master_bantuan_list->frekuensi->viewAttributes() ?>><?php echo $master_bantuan_list->frekuensi->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $master_bantuan_list->bulan->cellAttributes() ?>>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_bulan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="master_bantuan" data-field="x_bulan" data-value-separator="<?php echo $master_bantuan_list->bulan->displayValueSeparatorAttribute() ?>" id="x<?php echo $master_bantuan_list->RowIndex ?>_bulan" name="x<?php echo $master_bantuan_list->RowIndex ?>_bulan"<?php echo $master_bantuan_list->bulan->editAttributes() ?>>
			<?php echo $master_bantuan_list->bulan->selectOptionListHtml("x{$master_bantuan_list->RowIndex}_bulan") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_bulan" name="o<?php echo $master_bantuan_list->RowIndex ?>_bulan" id="o<?php echo $master_bantuan_list->RowIndex ?>_bulan" value="<?php echo HtmlEncode($master_bantuan_list->bulan->OldValue) ?>">
<?php } ?>
<?php if ($master_bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_bulan">
<span<?php echo $master_bantuan_list->bulan->viewAttributes() ?>><?php echo $master_bantuan_list->bulan->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $master_bantuan_list->tahun->cellAttributes() ?>>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_tahun" class="form-group">
<input type="text" data-table="master_bantuan" data-field="x_tahun" name="x<?php echo $master_bantuan_list->RowIndex ?>_tahun" id="x<?php echo $master_bantuan_list->RowIndex ?>_tahun" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_bantuan_list->tahun->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_list->tahun->EditValue ?>"<?php echo $master_bantuan_list->tahun->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_tahun" name="o<?php echo $master_bantuan_list->RowIndex ?>_tahun" id="o<?php echo $master_bantuan_list->RowIndex ?>_tahun" value="<?php echo HtmlEncode($master_bantuan_list->tahun->OldValue) ?>">
<?php } ?>
<?php if ($master_bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_tahun">
<span<?php echo $master_bantuan_list->tahun->viewAttributes() ?>><?php echo $master_bantuan_list->tahun->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $master_bantuan_list->status->cellAttributes() ?>>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_status" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="master_bantuan" data-field="x_status" data-value-separator="<?php echo $master_bantuan_list->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $master_bantuan_list->RowIndex ?>_status" name="x<?php echo $master_bantuan_list->RowIndex ?>_status"<?php echo $master_bantuan_list->status->editAttributes() ?>>
			<?php echo $master_bantuan_list->status->selectOptionListHtml("x{$master_bantuan_list->RowIndex}_status") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_status" name="o<?php echo $master_bantuan_list->RowIndex ?>_status" id="o<?php echo $master_bantuan_list->RowIndex ?>_status" value="<?php echo HtmlEncode($master_bantuan_list->status->OldValue) ?>">
<?php } ?>
<?php if ($master_bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_status">
<span<?php echo $master_bantuan_list->status->viewAttributes() ?>><?php echo $master_bantuan_list->status->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->na->Visible) { // na ?>
		<td data-name="na" <?php echo $master_bantuan_list->na->cellAttributes() ?>>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_na" class="form-group">
<div id="tp_x<?php echo $master_bantuan_list->RowIndex ?>_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_bantuan" data-field="x_na" data-value-separator="<?php echo $master_bantuan_list->na->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_bantuan_list->RowIndex ?>_na" id="x<?php echo $master_bantuan_list->RowIndex ?>_na" value="{value}"<?php echo $master_bantuan_list->na->editAttributes() ?>></div>
<div id="dsl_x<?php echo $master_bantuan_list->RowIndex ?>_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_bantuan_list->na->radioButtonListHtml(FALSE, "x{$master_bantuan_list->RowIndex}_na") ?>
</div></div>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_na" name="o<?php echo $master_bantuan_list->RowIndex ?>_na" id="o<?php echo $master_bantuan_list->RowIndex ?>_na" value="<?php echo HtmlEncode($master_bantuan_list->na->OldValue) ?>">
<?php } ?>
<?php if ($master_bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $master_bantuan_list->RowCount ?>_master_bantuan_na">
<span<?php echo $master_bantuan_list->na->viewAttributes() ?>><?php echo $master_bantuan_list->na->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$master_bantuan_list->ListOptions->render("body", "right", $master_bantuan_list->RowCount);
?>
	</tr>
<?php if ($master_bantuan->RowType == ROWTYPE_ADD || $master_bantuan->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fmaster_bantuanlist", "load"], function() {
	fmaster_bantuanlist.updateLists(<?php echo $master_bantuan_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$master_bantuan_list->isGridAdd())
		if (!$master_bantuan_list->Recordset->EOF)
			$master_bantuan_list->Recordset->moveNext();
}
?>
<?php
	if ($master_bantuan_list->isGridAdd() || $master_bantuan_list->isGridEdit()) {
		$master_bantuan_list->RowIndex = '$rowindex$';
		$master_bantuan_list->loadRowValues();

		// Set row properties
		$master_bantuan->resetAttributes();
		$master_bantuan->RowAttrs->merge(["data-rowindex" => $master_bantuan_list->RowIndex, "id" => "r0_master_bantuan", "data-rowtype" => ROWTYPE_ADD]);
		$master_bantuan->RowAttrs->appendClass("ew-template");
		$master_bantuan->RowType = ROWTYPE_ADD;

		// Render row
		$master_bantuan_list->renderRow();

		// Render list options
		$master_bantuan_list->renderListOptions();
		$master_bantuan_list->StartRowCount = 0;
?>
	<tr <?php echo $master_bantuan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$master_bantuan_list->ListOptions->render("body", "left", $master_bantuan_list->RowIndex);
?>
	<?php if ($master_bantuan_list->id->Visible) { // id ?>
		<td data-name="id">
<span id="el$rowindex$_master_bantuan_id" class="form-group master_bantuan_id"></span>
<input type="hidden" data-table="master_bantuan" data-field="x_id" name="o<?php echo $master_bantuan_list->RowIndex ?>_id" id="o<?php echo $master_bantuan_list->RowIndex ?>_id" value="<?php echo HtmlEncode($master_bantuan_list->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
		<td data-name="jenis_bantuan_id">
<span id="el$rowindex$_master_bantuan_jenis_bantuan_id" class="form-group master_bantuan_jenis_bantuan_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="master_bantuan" data-field="x_jenis_bantuan_id" data-value-separator="<?php echo $master_bantuan_list->jenis_bantuan_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $master_bantuan_list->RowIndex ?>_jenis_bantuan_id" name="x<?php echo $master_bantuan_list->RowIndex ?>_jenis_bantuan_id"<?php echo $master_bantuan_list->jenis_bantuan_id->editAttributes() ?>>
			<?php echo $master_bantuan_list->jenis_bantuan_id->selectOptionListHtml("x{$master_bantuan_list->RowIndex}_jenis_bantuan_id") ?>
		</select>
</div>
<?php echo $master_bantuan_list->jenis_bantuan_id->Lookup->getParamTag($master_bantuan_list, "p_x" . $master_bantuan_list->RowIndex . "_jenis_bantuan_id") ?>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_jenis_bantuan_id" name="o<?php echo $master_bantuan_list->RowIndex ?>_jenis_bantuan_id" id="o<?php echo $master_bantuan_list->RowIndex ?>_jenis_bantuan_id" value="<?php echo HtmlEncode($master_bantuan_list->jenis_bantuan_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->nama->Visible) { // nama ?>
		<td data-name="nama">
<span id="el$rowindex$_master_bantuan_nama" class="form-group master_bantuan_nama">
<input type="text" data-table="master_bantuan" data-field="x_nama" name="x<?php echo $master_bantuan_list->RowIndex ?>_nama" id="x<?php echo $master_bantuan_list->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_bantuan_list->nama->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_list->nama->EditValue ?>"<?php echo $master_bantuan_list->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_nama" name="o<?php echo $master_bantuan_list->RowIndex ?>_nama" id="o<?php echo $master_bantuan_list->RowIndex ?>_nama" value="<?php echo HtmlEncode($master_bantuan_list->nama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->type->Visible) { // type ?>
		<td data-name="type">
<span id="el$rowindex$_master_bantuan_type" class="form-group master_bantuan_type">
<div id="tp_x<?php echo $master_bantuan_list->RowIndex ?>_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_bantuan" data-field="x_type" data-value-separator="<?php echo $master_bantuan_list->type->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_bantuan_list->RowIndex ?>_type" id="x<?php echo $master_bantuan_list->RowIndex ?>_type" value="{value}"<?php echo $master_bantuan_list->type->editAttributes() ?>></div>
<div id="dsl_x<?php echo $master_bantuan_list->RowIndex ?>_type" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_bantuan_list->type->radioButtonListHtml(FALSE, "x{$master_bantuan_list->RowIndex}_type") ?>
</div></div>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_type" name="o<?php echo $master_bantuan_list->RowIndex ?>_type" id="o<?php echo $master_bantuan_list->RowIndex ?>_type" value="<?php echo HtmlEncode($master_bantuan_list->type->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<span id="el$rowindex$_master_bantuan_jumlah" class="form-group master_bantuan_jumlah">
<input type="text" data-table="master_bantuan" data-field="x_jumlah" name="x<?php echo $master_bantuan_list->RowIndex ?>_jumlah" id="x<?php echo $master_bantuan_list->RowIndex ?>_jumlah" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_bantuan_list->jumlah->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_list->jumlah->EditValue ?>"<?php echo $master_bantuan_list->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_jumlah" name="o<?php echo $master_bantuan_list->RowIndex ?>_jumlah" id="o<?php echo $master_bantuan_list->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($master_bantuan_list->jumlah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
		<td data-name="sumber_bantuan_id">
<span id="el$rowindex$_master_bantuan_sumber_bantuan_id" class="form-group master_bantuan_sumber_bantuan_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $master_bantuan_list->RowIndex ?>_sumber_bantuan_id"><?php echo EmptyValue(strval($master_bantuan_list->sumber_bantuan_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_bantuan_list->sumber_bantuan_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_bantuan_list->sumber_bantuan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_bantuan_list->sumber_bantuan_id->ReadOnly || $master_bantuan_list->sumber_bantuan_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_bantuan_list->RowIndex ?>_sumber_bantuan_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_bantuan_list->sumber_bantuan_id->Lookup->getParamTag($master_bantuan_list, "p_x" . $master_bantuan_list->RowIndex . "_sumber_bantuan_id") ?>
<input type="hidden" data-table="master_bantuan" data-field="x_sumber_bantuan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_bantuan_list->sumber_bantuan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_bantuan_list->RowIndex ?>_sumber_bantuan_id" id="x<?php echo $master_bantuan_list->RowIndex ?>_sumber_bantuan_id" value="<?php echo $master_bantuan_list->sumber_bantuan_id->CurrentValue ?>"<?php echo $master_bantuan_list->sumber_bantuan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_sumber_bantuan_id" name="o<?php echo $master_bantuan_list->RowIndex ?>_sumber_bantuan_id" id="o<?php echo $master_bantuan_list->RowIndex ?>_sumber_bantuan_id" value="<?php echo HtmlEncode($master_bantuan_list->sumber_bantuan_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->pengambilan_bantuuan_id->Visible) { // pengambilan_bantuuan_id ?>
		<td data-name="pengambilan_bantuuan_id">
<span id="el$rowindex$_master_bantuan_pengambilan_bantuuan_id" class="form-group master_bantuan_pengambilan_bantuuan_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $master_bantuan_list->RowIndex ?>_pengambilan_bantuuan_id"><?php echo EmptyValue(strval($master_bantuan_list->pengambilan_bantuuan_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $master_bantuan_list->pengambilan_bantuuan_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($master_bantuan_list->pengambilan_bantuuan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($master_bantuan_list->pengambilan_bantuuan_id->ReadOnly || $master_bantuan_list->pengambilan_bantuuan_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $master_bantuan_list->RowIndex ?>_pengambilan_bantuuan_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $master_bantuan_list->pengambilan_bantuuan_id->Lookup->getParamTag($master_bantuan_list, "p_x" . $master_bantuan_list->RowIndex . "_pengambilan_bantuuan_id") ?>
<input type="hidden" data-table="master_bantuan" data-field="x_pengambilan_bantuuan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $master_bantuan_list->pengambilan_bantuuan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_bantuan_list->RowIndex ?>_pengambilan_bantuuan_id" id="x<?php echo $master_bantuan_list->RowIndex ?>_pengambilan_bantuuan_id" value="<?php echo $master_bantuan_list->pengambilan_bantuuan_id->CurrentValue ?>"<?php echo $master_bantuan_list->pengambilan_bantuuan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_pengambilan_bantuuan_id" name="o<?php echo $master_bantuan_list->RowIndex ?>_pengambilan_bantuuan_id" id="o<?php echo $master_bantuan_list->RowIndex ?>_pengambilan_bantuuan_id" value="<?php echo HtmlEncode($master_bantuan_list->pengambilan_bantuuan_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->frekuensi->Visible) { // frekuensi ?>
		<td data-name="frekuensi">
<span id="el$rowindex$_master_bantuan_frekuensi" class="form-group master_bantuan_frekuensi">
<input type="text" data-table="master_bantuan" data-field="x_frekuensi" name="x<?php echo $master_bantuan_list->RowIndex ?>_frekuensi" id="x<?php echo $master_bantuan_list->RowIndex ?>_frekuensi" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($master_bantuan_list->frekuensi->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_list->frekuensi->EditValue ?>"<?php echo $master_bantuan_list->frekuensi->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_frekuensi" name="o<?php echo $master_bantuan_list->RowIndex ?>_frekuensi" id="o<?php echo $master_bantuan_list->RowIndex ?>_frekuensi" value="<?php echo HtmlEncode($master_bantuan_list->frekuensi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan">
<span id="el$rowindex$_master_bantuan_bulan" class="form-group master_bantuan_bulan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="master_bantuan" data-field="x_bulan" data-value-separator="<?php echo $master_bantuan_list->bulan->displayValueSeparatorAttribute() ?>" id="x<?php echo $master_bantuan_list->RowIndex ?>_bulan" name="x<?php echo $master_bantuan_list->RowIndex ?>_bulan"<?php echo $master_bantuan_list->bulan->editAttributes() ?>>
			<?php echo $master_bantuan_list->bulan->selectOptionListHtml("x{$master_bantuan_list->RowIndex}_bulan") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_bulan" name="o<?php echo $master_bantuan_list->RowIndex ?>_bulan" id="o<?php echo $master_bantuan_list->RowIndex ?>_bulan" value="<?php echo HtmlEncode($master_bantuan_list->bulan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun">
<span id="el$rowindex$_master_bantuan_tahun" class="form-group master_bantuan_tahun">
<input type="text" data-table="master_bantuan" data-field="x_tahun" name="x<?php echo $master_bantuan_list->RowIndex ?>_tahun" id="x<?php echo $master_bantuan_list->RowIndex ?>_tahun" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($master_bantuan_list->tahun->getPlaceHolder()) ?>" value="<?php echo $master_bantuan_list->tahun->EditValue ?>"<?php echo $master_bantuan_list->tahun->editAttributes() ?>>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_tahun" name="o<?php echo $master_bantuan_list->RowIndex ?>_tahun" id="o<?php echo $master_bantuan_list->RowIndex ?>_tahun" value="<?php echo HtmlEncode($master_bantuan_list->tahun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->status->Visible) { // status ?>
		<td data-name="status">
<span id="el$rowindex$_master_bantuan_status" class="form-group master_bantuan_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="master_bantuan" data-field="x_status" data-value-separator="<?php echo $master_bantuan_list->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $master_bantuan_list->RowIndex ?>_status" name="x<?php echo $master_bantuan_list->RowIndex ?>_status"<?php echo $master_bantuan_list->status->editAttributes() ?>>
			<?php echo $master_bantuan_list->status->selectOptionListHtml("x{$master_bantuan_list->RowIndex}_status") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_status" name="o<?php echo $master_bantuan_list->RowIndex ?>_status" id="o<?php echo $master_bantuan_list->RowIndex ?>_status" value="<?php echo HtmlEncode($master_bantuan_list->status->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($master_bantuan_list->na->Visible) { // na ?>
		<td data-name="na">
<span id="el$rowindex$_master_bantuan_na" class="form-group master_bantuan_na">
<div id="tp_x<?php echo $master_bantuan_list->RowIndex ?>_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_bantuan" data-field="x_na" data-value-separator="<?php echo $master_bantuan_list->na->displayValueSeparatorAttribute() ?>" name="x<?php echo $master_bantuan_list->RowIndex ?>_na" id="x<?php echo $master_bantuan_list->RowIndex ?>_na" value="{value}"<?php echo $master_bantuan_list->na->editAttributes() ?>></div>
<div id="dsl_x<?php echo $master_bantuan_list->RowIndex ?>_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_bantuan_list->na->radioButtonListHtml(FALSE, "x{$master_bantuan_list->RowIndex}_na") ?>
</div></div>
</span>
<input type="hidden" data-table="master_bantuan" data-field="x_na" name="o<?php echo $master_bantuan_list->RowIndex ?>_na" id="o<?php echo $master_bantuan_list->RowIndex ?>_na" value="<?php echo HtmlEncode($master_bantuan_list->na->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$master_bantuan_list->ListOptions->render("body", "right", $master_bantuan_list->RowIndex);
?>
<script>
loadjs.ready(["fmaster_bantuanlist", "load"], function() {
	fmaster_bantuanlist.updateLists(<?php echo $master_bantuan_list->RowIndex ?>);
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
<?php if ($master_bantuan_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $master_bantuan_list->FormKeyCountName ?>" id="<?php echo $master_bantuan_list->FormKeyCountName ?>" value="<?php echo $master_bantuan_list->KeyCount ?>">
<?php echo $master_bantuan_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$master_bantuan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($master_bantuan_list->Recordset)
	$master_bantuan_list->Recordset->Close();
?>
<?php if (!$master_bantuan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$master_bantuan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_bantuan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $master_bantuan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($master_bantuan_list->TotalRecords == 0 && !$master_bantuan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $master_bantuan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$master_bantuan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$master_bantuan_list->isExport()) { ?>
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
$master_bantuan_list->terminate();
?>