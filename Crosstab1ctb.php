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
$Crosstab1_crosstab = new Crosstab1_crosstab();

// Run the page
$Crosstab1_crosstab->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Crosstab1_crosstab->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Crosstab1_crosstab->isExport() && !$Crosstab1_crosstab->DrillDown && !$DashboardReport) { ?>
<script>
var fcrosstab, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	fcrosstab = currentForm = new ew.Form("fcrosstab", "crosstab");
	currentPageID = ew.PAGE_ID = "crosstab";

	// Validate function for search
	fcrosstab.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tahun_bantuan");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Crosstab1_crosstab->tahun_bantuan->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_kecamatan_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Crosstab1_crosstab->kecamatan_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_kelurahan_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Crosstab1_crosstab->kelurahan_id->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcrosstab.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcrosstab.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcrosstab.lists["x_bantuan_id"] = <?php echo $Crosstab1_crosstab->bantuan_id->Lookup->toClientList($Crosstab1_crosstab) ?>;
	fcrosstab.lists["x_bantuan_id"].options = <?php echo JsonEncode($Crosstab1_crosstab->bantuan_id->lookupOptions()) ?>;
	fcrosstab.lists["x_jenis_bantuan_id"] = <?php echo $Crosstab1_crosstab->jenis_bantuan_id->Lookup->toClientList($Crosstab1_crosstab) ?>;
	fcrosstab.lists["x_jenis_bantuan_id"].options = <?php echo JsonEncode($Crosstab1_crosstab->jenis_bantuan_id->lookupOptions()) ?>;
	fcrosstab.lists["x_kecamatan_id"] = <?php echo $Crosstab1_crosstab->kecamatan_id->Lookup->toClientList($Crosstab1_crosstab) ?>;
	fcrosstab.lists["x_kecamatan_id"].options = <?php echo JsonEncode($Crosstab1_crosstab->kecamatan_id->lookupOptions()) ?>;
	fcrosstab.autoSuggests["x_kecamatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcrosstab.lists["x_kelurahan_id"] = <?php echo $Crosstab1_crosstab->kelurahan_id->Lookup->toClientList($Crosstab1_crosstab) ?>;
	fcrosstab.lists["x_kelurahan_id"].options = <?php echo JsonEncode($Crosstab1_crosstab->kelurahan_id->lookupOptions()) ?>;
	fcrosstab.autoSuggests["x_kelurahan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcrosstab.lists["x_rw_id"] = <?php echo $Crosstab1_crosstab->rw_id->Lookup->toClientList($Crosstab1_crosstab) ?>;
	fcrosstab.lists["x_rw_id"].options = <?php echo JsonEncode($Crosstab1_crosstab->rw_id->lookupOptions()) ?>;
	fcrosstab.lists["x_rt_id"] = <?php echo $Crosstab1_crosstab->rt_id->Lookup->toClientList($Crosstab1_crosstab) ?>;
	fcrosstab.lists["x_rt_id"].options = <?php echo JsonEncode($Crosstab1_crosstab->rt_id->lookupOptions()) ?>;

	// Filters
	fcrosstab.filterList = <?php echo $Crosstab1_crosstab->getFilterList() ?>;

	// Init search panel as collapsed
	fcrosstab.initSearchPanel = true;
	loadjs.done("fcrosstab");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Crosstab1_crosstab->isExport() || $Crosstab1_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Crosstab1_crosstab->ShowCurrentFilter) { ?>
<?php $Crosstab1_crosstab->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Crosstab1_crosstab->DrillDownInPanel) {
	$Crosstab1_crosstab->ExportOptions->render("body");
	$Crosstab1_crosstab->SearchOptions->render("body");
	$Crosstab1_crosstab->FilterOptions->render("body");
}
?>
</div>
<?php $Crosstab1_crosstab->showPageHeader(); ?>
<?php
$Crosstab1_crosstab->showMessage();
?>
<?php if ((!$Crosstab1_crosstab->isExport() || $Crosstab1_crosstab->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Crosstab1_crosstab->isExport() || $Crosstab1_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Crosstab1_crosstab->CenterContentClass ?>">
<?php } ?>
<?php if ($Crosstab1_crosstab->ShowDrillDownFilter) { ?>
<?php $Crosstab1_crosstab->showDrillDownList() ?>
<?php } ?>
<!-- Crosstab report (begin) -->
<div id="report_crosstab">
<?php if (!$Crosstab1_crosstab->isExport() && !$Crosstab1_crosstab->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Crosstab1_crosstab->isExport() && !$Crosstab1->CurrentAction) { ?>
<form name="fcrosstab" id="fcrosstab" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcrosstab-search-panel" class="<?php echo $Crosstab1_crosstab->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Crosstab1">
	<div class="ew-extended-search">
<?php

// Render search row
$Crosstab1->RowType = ROWTYPE_SEARCH;
$Crosstab1->resetAttributes();
$Crosstab1_crosstab->renderRow();
?>
<?php if ($Crosstab1_crosstab->bantuan_id->Visible) { // bantuan_id ?>
	<?php
		$Crosstab1_crosstab->SearchColumnCount++;
		if (($Crosstab1_crosstab->SearchColumnCount - 1) % $Crosstab1_crosstab->SearchFieldsPerRow == 0) {
			$Crosstab1_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Crosstab1_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_bantuan_id" class="ew-cell form-group">
		<label for="x_bantuan_id" class="ew-search-caption ew-label"><?php echo $Crosstab1_crosstab->bantuan_id->caption() ?></label>
		<span id="el_Crosstab1_bantuan_id" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_bantuan_id"><?php echo EmptyValue(strval($Crosstab1_crosstab->bantuan_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Crosstab1_crosstab->bantuan_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($Crosstab1_crosstab->bantuan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($Crosstab1_crosstab->bantuan_id->ReadOnly || $Crosstab1_crosstab->bantuan_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_bantuan_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $Crosstab1_crosstab->bantuan_id->Lookup->getParamTag($Crosstab1_crosstab, "p_x_bantuan_id") ?>
<input type="hidden" data-table="Crosstab1" data-field="x_bantuan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $Crosstab1_crosstab->bantuan_id->displayValueSeparatorAttribute() ?>" name="x_bantuan_id" id="x_bantuan_id" value="<?php echo $Crosstab1_crosstab->bantuan_id->AdvancedSearch->SearchValue ?>"<?php echo $Crosstab1_crosstab->bantuan_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($Crosstab1_crosstab->SearchColumnCount % $Crosstab1_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Crosstab1_crosstab->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
	<?php
		$Crosstab1_crosstab->SearchColumnCount++;
		if (($Crosstab1_crosstab->SearchColumnCount - 1) % $Crosstab1_crosstab->SearchFieldsPerRow == 0) {
			$Crosstab1_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Crosstab1_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_jenis_bantuan_id" class="ew-cell form-group">
		<label for="x_jenis_bantuan_id" class="ew-search-caption ew-label"><?php echo $Crosstab1_crosstab->jenis_bantuan_id->caption() ?></label>
		<span id="el_Crosstab1_jenis_bantuan_id" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Crosstab1" data-field="x_jenis_bantuan_id" data-value-separator="<?php echo $Crosstab1_crosstab->jenis_bantuan_id->displayValueSeparatorAttribute() ?>" id="x_jenis_bantuan_id" name="x_jenis_bantuan_id"<?php echo $Crosstab1_crosstab->jenis_bantuan_id->editAttributes() ?>>
			<?php echo $Crosstab1_crosstab->jenis_bantuan_id->selectOptionListHtml("x_jenis_bantuan_id") ?>
		</select>
</div>
<?php echo $Crosstab1_crosstab->jenis_bantuan_id->Lookup->getParamTag($Crosstab1_crosstab, "p_x_jenis_bantuan_id") ?>
</span>
	</div>
	<?php if ($Crosstab1_crosstab->SearchColumnCount % $Crosstab1_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Crosstab1_crosstab->tahun_bantuan->Visible) { // tahun_bantuan ?>
	<?php
		$Crosstab1_crosstab->SearchColumnCount++;
		if (($Crosstab1_crosstab->SearchColumnCount - 1) % $Crosstab1_crosstab->SearchFieldsPerRow == 0) {
			$Crosstab1_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Crosstab1_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun_bantuan" class="ew-cell form-group">
		<label for="x_tahun_bantuan" class="ew-search-caption ew-label"><?php echo $Crosstab1_crosstab->tahun_bantuan->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun_bantuan" id="z_tahun_bantuan" value="=">
</span>
		<span id="el_Crosstab1_tahun_bantuan" class="ew-search-field">
<input type="text" data-table="Crosstab1" data-field="x_tahun_bantuan" name="x_tahun_bantuan" id="x_tahun_bantuan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($Crosstab1_crosstab->tahun_bantuan->getPlaceHolder()) ?>" value="<?php echo $Crosstab1_crosstab->tahun_bantuan->EditValue ?>"<?php echo $Crosstab1_crosstab->tahun_bantuan->editAttributes() ?>>
</span>
	</div>
	<?php if ($Crosstab1_crosstab->SearchColumnCount % $Crosstab1_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Crosstab1_crosstab->kecamatan_id->Visible) { // kecamatan_id ?>
	<?php
		$Crosstab1_crosstab->SearchColumnCount++;
		if (($Crosstab1_crosstab->SearchColumnCount - 1) % $Crosstab1_crosstab->SearchFieldsPerRow == 0) {
			$Crosstab1_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Crosstab1_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kecamatan_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $Crosstab1_crosstab->kecamatan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kecamatan_id" id="z_kecamatan_id" value="=">
</span>
		<span id="el_Crosstab1_kecamatan_id" class="ew-search-field">
<?php
$onchange = $Crosstab1_crosstab->kecamatan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Crosstab1_crosstab->kecamatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kecamatan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kecamatan_id" id="sv_x_kecamatan_id" value="<?php echo RemoveHtml($Crosstab1_crosstab->kecamatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($Crosstab1_crosstab->kecamatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($Crosstab1_crosstab->kecamatan_id->getPlaceHolder()) ?>"<?php echo $Crosstab1_crosstab->kecamatan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($Crosstab1_crosstab->kecamatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kecamatan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($Crosstab1_crosstab->kecamatan_id->ReadOnly || $Crosstab1_crosstab->kecamatan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="Crosstab1" data-field="x_kecamatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $Crosstab1_crosstab->kecamatan_id->displayValueSeparatorAttribute() ?>" name="x_kecamatan_id" id="x_kecamatan_id" value="<?php echo HtmlEncode($Crosstab1_crosstab->kecamatan_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcrosstab"], function() {
	fcrosstab.createAutoSuggest({"id":"x_kecamatan_id","forceSelect":true});
});
</script>
<?php echo $Crosstab1_crosstab->kecamatan_id->Lookup->getParamTag($Crosstab1_crosstab, "p_x_kecamatan_id") ?>
</span>
	</div>
	<?php if ($Crosstab1_crosstab->SearchColumnCount % $Crosstab1_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Crosstab1_crosstab->kelurahan_id->Visible) { // kelurahan_id ?>
	<?php
		$Crosstab1_crosstab->SearchColumnCount++;
		if (($Crosstab1_crosstab->SearchColumnCount - 1) % $Crosstab1_crosstab->SearchFieldsPerRow == 0) {
			$Crosstab1_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Crosstab1_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kelurahan_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $Crosstab1_crosstab->kelurahan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kelurahan_id" id="z_kelurahan_id" value="=">
</span>
		<span id="el_Crosstab1_kelurahan_id" class="ew-search-field">
<?php
$onchange = $Crosstab1_crosstab->kelurahan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Crosstab1_crosstab->kelurahan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kelurahan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kelurahan_id" id="sv_x_kelurahan_id" value="<?php echo RemoveHtml($Crosstab1_crosstab->kelurahan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($Crosstab1_crosstab->kelurahan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($Crosstab1_crosstab->kelurahan_id->getPlaceHolder()) ?>"<?php echo $Crosstab1_crosstab->kelurahan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($Crosstab1_crosstab->kelurahan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kelurahan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($Crosstab1_crosstab->kelurahan_id->ReadOnly || $Crosstab1_crosstab->kelurahan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="Crosstab1" data-field="x_kelurahan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $Crosstab1_crosstab->kelurahan_id->displayValueSeparatorAttribute() ?>" name="x_kelurahan_id" id="x_kelurahan_id" value="<?php echo HtmlEncode($Crosstab1_crosstab->kelurahan_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcrosstab"], function() {
	fcrosstab.createAutoSuggest({"id":"x_kelurahan_id","forceSelect":true});
});
</script>
<?php echo $Crosstab1_crosstab->kelurahan_id->Lookup->getParamTag($Crosstab1_crosstab, "p_x_kelurahan_id") ?>
</span>
	</div>
	<?php if ($Crosstab1_crosstab->SearchColumnCount % $Crosstab1_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Crosstab1_crosstab->rw_id->Visible) { // rw_id ?>
	<?php
		$Crosstab1_crosstab->SearchColumnCount++;
		if (($Crosstab1_crosstab->SearchColumnCount - 1) % $Crosstab1_crosstab->SearchFieldsPerRow == 0) {
			$Crosstab1_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Crosstab1_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_rw_id" class="ew-cell form-group">
		<label for="x_rw_id" class="ew-search-caption ew-label"><?php echo $Crosstab1_crosstab->rw_id->caption() ?></label>
		<span id="el_Crosstab1_rw_id" class="ew-search-field">
<?php $Crosstab1_crosstab->rw_id->EditAttrs->prepend("onclick", "ew.updateOptions.call(this);"); ?>
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($Crosstab1_crosstab->rw_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $Crosstab1_crosstab->rw_id->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_rw_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $Crosstab1_crosstab->rw_id->radioButtonListHtml(TRUE, "x_rw_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_rw_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="Crosstab1" data-field="x_rw_id" data-value-separator="<?php echo $Crosstab1_crosstab->rw_id->displayValueSeparatorAttribute() ?>" name="x_rw_id" id="x_rw_id" value="{value}"<?php echo $Crosstab1_crosstab->rw_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$Crosstab1_crosstab->rw_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $Crosstab1_crosstab->rw_id->Lookup->getParamTag($Crosstab1_crosstab, "p_x_rw_id") ?>
</span>
	</div>
	<?php if ($Crosstab1_crosstab->SearchColumnCount % $Crosstab1_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Crosstab1_crosstab->rt_id->Visible) { // rt_id ?>
	<?php
		$Crosstab1_crosstab->SearchColumnCount++;
		if (($Crosstab1_crosstab->SearchColumnCount - 1) % $Crosstab1_crosstab->SearchFieldsPerRow == 0) {
			$Crosstab1_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Crosstab1_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_rt_id" class="ew-cell form-group">
		<label for="x_rt_id" class="ew-search-caption ew-label"><?php echo $Crosstab1_crosstab->rt_id->caption() ?></label>
		<span id="el_Crosstab1_rt_id" class="ew-search-field">
<?php $Crosstab1_crosstab->rt_id->EditAttrs->prepend("onclick", "ew.updateOptions.call(this);"); ?>
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($Crosstab1_crosstab->rt_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $Crosstab1_crosstab->rt_id->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_rt_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $Crosstab1_crosstab->rt_id->radioButtonListHtml(TRUE, "x_rt_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_rt_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="Crosstab1" data-field="x_rt_id" data-value-separator="<?php echo $Crosstab1_crosstab->rt_id->displayValueSeparatorAttribute() ?>" name="x_rt_id" id="x_rt_id" value="{value}"<?php echo $Crosstab1_crosstab->rt_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$Crosstab1_crosstab->rt_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $Crosstab1_crosstab->rt_id->Lookup->getParamTag($Crosstab1_crosstab, "p_x_rt_id") ?>
</span>
	</div>
	<?php if ($Crosstab1_crosstab->SearchColumnCount % $Crosstab1_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Crosstab1_crosstab->SearchColumnCount % $Crosstab1_crosstab->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Crosstab1_crosstab->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Crosstab1_crosstab->GroupCount <= count($Crosstab1_crosstab->GroupRecords) && $Crosstab1_crosstab->GroupCount <= $Crosstab1_crosstab->DisplayGroups) {
?>
<?php

	// Show header
	if ($Crosstab1_crosstab->ShowHeader) {
?>
<?php if ($Crosstab1_crosstab->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Crosstab1_crosstab->TotalGroups > 0) { ?>
<?php if (!$Crosstab1_crosstab->isExport() && !($Crosstab1_crosstab->DrillDown && $Crosstab1_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Crosstab1_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php echo $Crosstab1_crosstab->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$Crosstab1_crosstab->isExport("word") && !$Crosstab1_crosstab->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Crosstab1_crosstab->ReportTableStyle ?>>
<?php if (!$Crosstab1_crosstab->isExport() && !($Crosstab1_crosstab->DrillDown && $Crosstab1_crosstab->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Crosstab1_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Crosstab1" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Crosstab1_crosstab->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Crosstab1_crosstab->GroupColumnCount > 0) { ?>
		<td class="ew-rpt-col-summary" colspan="<?php echo $Crosstab1_crosstab->GroupColumnCount ?>"><div><?php echo $Crosstab1_crosstab->renderSummaryCaptions() ?></div></td>
<?php } ?>
		<td class="ew-rpt-col-header" colspan="<?php echo @$Crosstab1_crosstab->ColumnSpan ?>">
			<div class="ew-table-header-btn">
				<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->tahun_bantuan->caption() ?></span>
			</div>
		</td>
	</tr>
	<tr class="ew-table-header">
<?php if ($Crosstab1_crosstab->jenis_bantuan_id->Visible) { ?>
	<td data-field="jenis_bantuan_id">
<?php if ($Crosstab1_crosstab->sortUrl($Crosstab1_crosstab->jenis_bantuan_id) == "") { ?>
		<div class="ew-table-header-btn Crosstab1_jenis_bantuan_id">
			<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->jenis_bantuan_id->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Crosstab1_jenis_bantuan_id" onclick="ew.sort(event, '<?php echo $Crosstab1_crosstab->sortUrl($Crosstab1_crosstab->jenis_bantuan_id) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->jenis_bantuan_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Crosstab1_crosstab->jenis_bantuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Crosstab1_crosstab->jenis_bantuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Crosstab1_crosstab->bantuan_id->Visible) { ?>
	<td data-field="bantuan_id">
<?php if ($Crosstab1_crosstab->sortUrl($Crosstab1_crosstab->bantuan_id) == "") { ?>
		<div class="ew-table-header-btn Crosstab1_bantuan_id">
			<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->bantuan_id->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Crosstab1_bantuan_id" onclick="ew.sort(event, '<?php echo $Crosstab1_crosstab->sortUrl($Crosstab1_crosstab->bantuan_id) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->bantuan_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Crosstab1_crosstab->bantuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Crosstab1_crosstab->bantuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Crosstab1_crosstab->kecamatan_id->Visible) { ?>
	<td data-field="kecamatan_id">
<?php if ($Crosstab1_crosstab->sortUrl($Crosstab1_crosstab->kecamatan_id) == "") { ?>
		<div class="ew-table-header-btn Crosstab1_kecamatan_id">
			<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->kecamatan_id->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Crosstab1_kecamatan_id" onclick="ew.sort(event, '<?php echo $Crosstab1_crosstab->sortUrl($Crosstab1_crosstab->kecamatan_id) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->kecamatan_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Crosstab1_crosstab->kecamatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Crosstab1_crosstab->kecamatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Crosstab1_crosstab->kelurahan_id->Visible) { ?>
	<td data-field="kelurahan_id">
<?php if ($Crosstab1_crosstab->sortUrl($Crosstab1_crosstab->kelurahan_id) == "") { ?>
		<div class="ew-table-header-btn Crosstab1_kelurahan_id">
			<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->kelurahan_id->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Crosstab1_kelurahan_id" onclick="ew.sort(event, '<?php echo $Crosstab1_crosstab->sortUrl($Crosstab1_crosstab->kelurahan_id) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->kelurahan_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Crosstab1_crosstab->kelurahan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Crosstab1_crosstab->kelurahan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Crosstab1_crosstab->rw_id->Visible) { ?>
	<td data-field="rw_id">
<?php if ($Crosstab1_crosstab->sortUrl($Crosstab1_crosstab->rw_id) == "") { ?>
		<div class="ew-table-header-btn Crosstab1_rw_id">
			<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->rw_id->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Crosstab1_rw_id" onclick="ew.sort(event, '<?php echo $Crosstab1_crosstab->sortUrl($Crosstab1_crosstab->rw_id) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->rw_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Crosstab1_crosstab->rw_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Crosstab1_crosstab->rw_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Crosstab1_crosstab->rt_id->Visible) { ?>
	<td data-field="rt_id">
<?php if ($Crosstab1_crosstab->sortUrl($Crosstab1_crosstab->rt_id) == "") { ?>
		<div class="ew-table-header-btn Crosstab1_rt_id">
			<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->rt_id->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Crosstab1_rt_id" onclick="ew.sort(event, '<?php echo $Crosstab1_crosstab->sortUrl($Crosstab1_crosstab->rt_id) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Crosstab1_crosstab->rt_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Crosstab1_crosstab->rt_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Crosstab1_crosstab->rt_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntval = count($Crosstab1_crosstab->Columns);
	for ($iy = 1; $iy < $cntval; $iy++) {
		if ($Crosstab1_crosstab->Columns[$iy]->Visible) {
			$Crosstab1_crosstab->SummaryCurrentValues[$iy-1] = $Crosstab1_crosstab->Columns[$iy]->Caption;
			$Crosstab1_crosstab->SummaryViewValues[$iy-1] = $Crosstab1_crosstab->SummaryCurrentValues[$iy-1];
?>
		<td class="ew-table-header"<?php echo $Crosstab1_crosstab->tahun_bantuan->cellAttributes() ?>><div<?php echo $Crosstab1_crosstab->tahun_bantuan->viewAttributes() ?>><?php echo $Crosstab1_crosstab->SummaryViewValues[$iy-1]; ?></div></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
		<td class="ew-table-header"<?php echo $Crosstab1_crosstab->tahun_bantuan->cellAttributes() ?>><div<?php echo $Crosstab1_crosstab->tahun_bantuan->viewAttributes() ?>><?php echo $Crosstab1_crosstab->renderSummaryCaptions() ?></div></td>
	</tr>
</thead>
<tbody>
<?php
		if ($Crosstab1_crosstab->TotalGroups == 0)
			break; // Show header only
		$Crosstab1_crosstab->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Crosstab1_crosstab->jenis_bantuan_id, $Crosstab1_crosstab->getSqlFirstGroupField(), $Crosstab1_crosstab->jenis_bantuan_id->groupValue(), $Crosstab1_crosstab->Dbid);
	if ($Crosstab1_crosstab->PageFirstGroupFilter != "") $Crosstab1_crosstab->PageFirstGroupFilter .= " OR ";
	$Crosstab1_crosstab->PageFirstGroupFilter .= $where;
	if ($Crosstab1_crosstab->Filter != "")
		$where = "($Crosstab1_crosstab->Filter) AND ($where)";
	$sql = BuildReportSql(str_replace("{DistinctColumnFields}", $Crosstab1_crosstab->DistinctColumnFields, $Crosstab1_crosstab->getSqlSelect()), $Crosstab1_crosstab->getSqlWhere(), $Crosstab1_crosstab->getSqlGroupBy(), "", $Crosstab1_crosstab->getSqlOrderBy(), $where, $Crosstab1_crosstab->Sort);
	$rs = $Crosstab1_crosstab->getRecordset($sql);
	$Crosstab1_crosstab->DetailRecords = $rs ? $rs->getRows() : [];
	$Crosstab1_crosstab->DetailRecordCount = count($Crosstab1_crosstab->DetailRecords);

	// Load detail records
	$Crosstab1_crosstab->jenis_bantuan_id->Records = &$Crosstab1_crosstab->DetailRecords;
	$Crosstab1_crosstab->jenis_bantuan_id->LevelBreak = TRUE; // Set field level break
	$Crosstab1_crosstab->bantuan_id->getDistinctValues($Crosstab1_crosstab->jenis_bantuan_id->Records);
	foreach ($Crosstab1_crosstab->bantuan_id->DistinctValues as $bantuan_id) { // Load records for this distinct value
		$Crosstab1_crosstab->bantuan_id->setGroupValue($bantuan_id); // Set group value
		$Crosstab1_crosstab->bantuan_id->getDistinctRecords($Crosstab1_crosstab->jenis_bantuan_id->Records, $Crosstab1_crosstab->bantuan_id->groupValue());
		$Crosstab1_crosstab->bantuan_id->LevelBreak = TRUE; // Set field level break
	$Crosstab1_crosstab->kecamatan_id->getDistinctValues($Crosstab1_crosstab->bantuan_id->Records);
	foreach ($Crosstab1_crosstab->kecamatan_id->DistinctValues as $kecamatan_id) { // Load records for this distinct value
		$Crosstab1_crosstab->kecamatan_id->setGroupValue($kecamatan_id); // Set group value
		$Crosstab1_crosstab->kecamatan_id->getDistinctRecords($Crosstab1_crosstab->bantuan_id->Records, $Crosstab1_crosstab->kecamatan_id->groupValue());
		$Crosstab1_crosstab->kecamatan_id->LevelBreak = TRUE; // Set field level break
	$Crosstab1_crosstab->kelurahan_id->getDistinctValues($Crosstab1_crosstab->kecamatan_id->Records);
	foreach ($Crosstab1_crosstab->kelurahan_id->DistinctValues as $kelurahan_id) { // Load records for this distinct value
		$Crosstab1_crosstab->kelurahan_id->setGroupValue($kelurahan_id); // Set group value
		$Crosstab1_crosstab->kelurahan_id->getDistinctRecords($Crosstab1_crosstab->kecamatan_id->Records, $Crosstab1_crosstab->kelurahan_id->groupValue());
		$Crosstab1_crosstab->kelurahan_id->LevelBreak = TRUE; // Set field level break
	$Crosstab1_crosstab->rw_id->getDistinctValues($Crosstab1_crosstab->kelurahan_id->Records);
	foreach ($Crosstab1_crosstab->rw_id->DistinctValues as $rw_id) { // Load records for this distinct value
		$Crosstab1_crosstab->rw_id->setGroupValue($rw_id); // Set group value
		$Crosstab1_crosstab->rw_id->getDistinctRecords($Crosstab1_crosstab->kelurahan_id->Records, $Crosstab1_crosstab->rw_id->groupValue());
		$Crosstab1_crosstab->rw_id->LevelBreak = TRUE; // Set field level break
	$Crosstab1_crosstab->rt_id->getDistinctValues($Crosstab1_crosstab->rw_id->Records);
	foreach ($Crosstab1_crosstab->rt_id->DistinctValues as $rt_id) { // Load records for this distinct value
		$Crosstab1_crosstab->rt_id->setGroupValue($rt_id); // Set group value
		$Crosstab1_crosstab->rt_id->getDistinctRecords($Crosstab1_crosstab->rw_id->Records, $Crosstab1_crosstab->rt_id->groupValue());
		$Crosstab1_crosstab->rt_id->LevelBreak = TRUE; // Set field level break
	foreach ($Crosstab1_crosstab->rt_id->Records as $record) {
		$Crosstab1_crosstab->RecordCount++;
		$Crosstab1_crosstab->RecordIndex++;
		$Crosstab1_crosstab->loadRowValues($record);

		// Render row
		$Crosstab1_crosstab->resetAttributes();
		$Crosstab1_crosstab->RowType = ROWTYPE_DETAIL;
		$Crosstab1_crosstab->renderRow();
?>
	<tr<?php echo $Crosstab1_crosstab->rowAttributes(); ?>>
<?php if ($Crosstab1_crosstab->jenis_bantuan_id->Visible) { ?>
		<!-- jenis_bantuan_id -->
		<td data-field="jenis_bantuan_id"<?php echo $Crosstab1_crosstab->jenis_bantuan_id->cellAttributes(); ?>><span<?php echo $Crosstab1_crosstab->jenis_bantuan_id->viewAttributes() ?>><?php echo $Crosstab1_crosstab->jenis_bantuan_id->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Crosstab1_crosstab->bantuan_id->Visible) { ?>
		<!-- bantuan_id -->
		<td data-field="bantuan_id"<?php echo $Crosstab1_crosstab->bantuan_id->cellAttributes(); ?>><span<?php echo $Crosstab1_crosstab->bantuan_id->viewAttributes() ?>><?php echo $Crosstab1_crosstab->bantuan_id->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Crosstab1_crosstab->kecamatan_id->Visible) { ?>
		<!-- kecamatan_id -->
		<td data-field="kecamatan_id"<?php echo $Crosstab1_crosstab->kecamatan_id->cellAttributes(); ?>><span<?php echo $Crosstab1_crosstab->kecamatan_id->viewAttributes() ?>><?php echo $Crosstab1_crosstab->kecamatan_id->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Crosstab1_crosstab->kelurahan_id->Visible) { ?>
		<!-- kelurahan_id -->
		<td data-field="kelurahan_id"<?php echo $Crosstab1_crosstab->kelurahan_id->cellAttributes(); ?>><span<?php echo $Crosstab1_crosstab->kelurahan_id->viewAttributes() ?>><?php echo $Crosstab1_crosstab->kelurahan_id->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Crosstab1_crosstab->rw_id->Visible) { ?>
		<!-- rw_id -->
		<td data-field="rw_id"<?php echo $Crosstab1_crosstab->rw_id->cellAttributes(); ?>><span<?php echo $Crosstab1_crosstab->rw_id->viewAttributes() ?>><?php echo $Crosstab1_crosstab->rw_id->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Crosstab1_crosstab->rt_id->Visible) { ?>
		<!-- rt_id -->
		<td data-field="rt_id"<?php echo $Crosstab1_crosstab->rt_id->cellAttributes(); ?>><span<?php echo $Crosstab1_crosstab->rt_id->viewAttributes() ?>><?php echo $Crosstab1_crosstab->rt_id->GroupViewValue ?></span></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
		$cntcol = count($Crosstab1_crosstab->SummaryViewValues);
		for ($iy = 1; $iy <= $cntcol; $iy++) {
			$colShow = ($iy <= $Crosstab1_crosstab->ColumnCount) ? $Crosstab1_crosstab->Columns[$iy]->Visible : TRUE;
			$colDesc = ($iy <= $Crosstab1_crosstab->ColumnCount) ? $Crosstab1_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
			if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Crosstab1_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Crosstab1_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
			}
		}
?>
<!-- Dynamic columns end -->
	</tr>
<?php
	}
	} // End group level 5
	} // End group level 4
	} // End group level 3
	} // End group level 2
	} // End group level 1
?>
<?php if ($Crosstab1_crosstab->TotalGroups > 0) { ?>
<?php
	$Crosstab1_crosstab->getSummaryValues($Crosstab1_crosstab->jenis_bantuan_id->Records); // Get crosstab summaries from records
	$Crosstab1_crosstab->resetAttributes();
	$Crosstab1_crosstab->RowType = ROWTYPE_TOTAL;
	$Crosstab1_crosstab->RowTotalType = ROWTOTAL_GROUP;
	$Crosstab1_crosstab->RowTotalSubType = ROWTOTAL_FOOTER;
	$Crosstab1_crosstab->RowGroupLevel = 1;
	$Crosstab1_crosstab->renderRow();
?>
	<!-- Summary jenis_bantuan_id (level 1) -->
	<tr<?php echo $Crosstab1_crosstab->rowAttributes(); ?>>
		<td colspan="<?php echo ($Crosstab1_crosstab->GroupColumnCount - 0) ?>"<?php echo $Crosstab1_crosstab->jenis_bantuan_id->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Crosstab1_crosstab->jenis_bantuan_id->GroupViewValue, $Crosstab1_crosstab->jenis_bantuan_id->caption()], $Language->phrase("CtbSumHead")) ?></td>
<!-- Dynamic columns begin -->
<?php
	$cntcol = count($Crosstab1_crosstab->SummaryViewValues);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$colShow = ($iy <= $Crosstab1_crosstab->ColumnCount) ? $Crosstab1_crosstab->Columns[$iy]->Visible : TRUE;
		$colDesc = ($iy <= $Crosstab1_crosstab->ColumnCount) ? $Crosstab1_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
		if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Crosstab1_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Crosstab1_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
	</tr>
<?php } ?>
<?php
?>
<?php

	// Next group
	$Crosstab1_crosstab->loadGroupRowValues();

	// Show header if page break
	if ($Crosstab1_crosstab->isExport())
		$Crosstab1_crosstab->ShowHeader = ($Crosstab1_crosstab->ExportPageBreakCount == 0) ? FALSE : ($Crosstab1_crosstab->GroupCount % $Crosstab1_crosstab->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Crosstab1_crosstab->ShowHeader)
		$Crosstab1_crosstab->Page_Breaking($Crosstab1_crosstab->ShowHeader, $Crosstab1_crosstab->PageBreakContent);
	$Crosstab1_crosstab->GroupCount++;
} // End while
?>
<?php if ($Crosstab1_crosstab->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php if (($Crosstab1_crosstab->StopGroup - $Crosstab1_crosstab->StartGroup + 1) != $Crosstab1_crosstab->TotalGroups) { ?>
<?php
	$Crosstab1_crosstab->resetAttributes();
	$Crosstab1_crosstab->RowType = ROWTYPE_TOTAL;
	$Crosstab1_crosstab->RowTotalType = ROWTOTAL_PAGE;
	$Crosstab1_crosstab->RowAttrs["class"] = "ew-rpt-page-summary";
	$Crosstab1_crosstab->renderRow();
?>
	<!-- Page Summary -->
	<tr<?php echo $Crosstab1_crosstab->rowAttributes(); ?>>
<?php if ($Crosstab1_crosstab->GroupColumnCount > 0) { ?>
	<td colspan="<?php echo $Crosstab1_crosstab->GroupColumnCount ?>"><?php echo $Crosstab1_crosstab->renderSummaryCaptions("page") ?></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntcol = count($Crosstab1_crosstab->SummaryViewValues);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$colShow = ($iy <= $Crosstab1_crosstab->ColumnCount) ? $Crosstab1_crosstab->Columns[$iy]->Visible : TRUE;
		$colDesc = ($iy <= $Crosstab1_crosstab->ColumnCount) ? $Crosstab1_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
		if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Crosstab1_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Crosstab1_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
	</tr>
<?php } ?>
<?php
	$Crosstab1_crosstab->resetAttributes();
	$Crosstab1_crosstab->RowType = ROWTYPE_TOTAL;
	$Crosstab1_crosstab->RowTotalType = ROWTOTAL_GRAND;
	$Crosstab1_crosstab->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Crosstab1_crosstab->renderRow();
?>
	<!-- Grand Total -->
	<tr<?php echo $Crosstab1_crosstab->rowAttributes(); ?>>
<?php if ($Crosstab1_crosstab->GroupColumnCount > 0) { ?>
	<td colspan="<?php echo $Crosstab1_crosstab->GroupColumnCount ?>"><?php echo $Crosstab1_crosstab->renderSummaryCaptions("grand") ?></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntcol = count($Crosstab1_crosstab->SummaryViewValues);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$colShow = ($iy <= $Crosstab1_crosstab->ColumnCount) ? $Crosstab1_crosstab->Columns[$iy]->Visible : TRUE;
		$colDesc = ($iy <= $Crosstab1_crosstab->ColumnCount) ? $Crosstab1_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
		if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Crosstab1_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Crosstab1_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
	</tr>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Crosstab1_crosstab->TotalGroups > 0) { ?>
<?php if (!$Crosstab1_crosstab->isExport() && !($Crosstab1_crosstab->DrillDown && $Crosstab1_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Crosstab1_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-crosstab -->
<!-- Crosstab report (end) -->
<?php if ((!$Crosstab1_crosstab->isExport() || $Crosstab1_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Crosstab1_crosstab->isExport() || $Crosstab1_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Crosstab1_crosstab->isExport() || $Crosstab1_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Crosstab1_crosstab->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Crosstab1_crosstab->isExport() && !$Crosstab1_crosstab->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "footer.php"; ?>
<?php } ?>
<?php
$Crosstab1_crosstab->terminate();
?>