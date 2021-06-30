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
$Report1_summary = new Report1_summary();

// Run the page
$Report1_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Report1_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Report1_summary->isExport() && !$Report1_summary->DrillDown && !$DashboardReport) { ?>
<script>
var fsummary, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	fsummary = currentForm = new ew.Form("fsummary", "summary");
	currentPageID = ew.PAGE_ID = "summary";

	// Validate function for search
	fsummary.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tahun_bantuan");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Report1_summary->tahun_bantuan->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_kecamatan_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Report1_summary->kecamatan_id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_kelurahan_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Report1_summary->kelurahan_id->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fsummary.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsummary.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fsummary.lists["x_jenis_bantuan_id"] = <?php echo $Report1_summary->jenis_bantuan_id->Lookup->toClientList($Report1_summary) ?>;
	fsummary.lists["x_jenis_bantuan_id"].options = <?php echo JsonEncode($Report1_summary->jenis_bantuan_id->lookupOptions()) ?>;
	fsummary.lists["x_bantuan_id"] = <?php echo $Report1_summary->bantuan_id->Lookup->toClientList($Report1_summary) ?>;
	fsummary.lists["x_bantuan_id"].options = <?php echo JsonEncode($Report1_summary->bantuan_id->lookupOptions()) ?>;
	fsummary.lists["x_type"] = <?php echo $Report1_summary->type->Lookup->toClientList($Report1_summary) ?>;
	fsummary.lists["x_type"].options = <?php echo JsonEncode($Report1_summary->type->options(FALSE, TRUE)) ?>;
	fsummary.lists["x_kecamatan_id"] = <?php echo $Report1_summary->kecamatan_id->Lookup->toClientList($Report1_summary) ?>;
	fsummary.lists["x_kecamatan_id"].options = <?php echo JsonEncode($Report1_summary->kecamatan_id->lookupOptions()) ?>;
	fsummary.autoSuggests["x_kecamatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fsummary.lists["x_kelurahan_id"] = <?php echo $Report1_summary->kelurahan_id->Lookup->toClientList($Report1_summary) ?>;
	fsummary.lists["x_kelurahan_id"].options = <?php echo JsonEncode($Report1_summary->kelurahan_id->lookupOptions()) ?>;
	fsummary.autoSuggests["x_kelurahan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fsummary.lists["x_rw_id"] = <?php echo $Report1_summary->rw_id->Lookup->toClientList($Report1_summary) ?>;
	fsummary.lists["x_rw_id"].options = <?php echo JsonEncode($Report1_summary->rw_id->lookupOptions()) ?>;
	fsummary.lists["x_rt_id"] = <?php echo $Report1_summary->rt_id->Lookup->toClientList($Report1_summary) ?>;
	fsummary.lists["x_rt_id"].options = <?php echo JsonEncode($Report1_summary->rt_id->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $Report1_summary->getFilterList() ?>;

	// Init search panel as collapsed
	fsummary.initSearchPanel = true;
	loadjs.done("fsummary");
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
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Report1_summary->ShowCurrentFilter) { ?>
<?php $Report1_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Report1_summary->DrillDownInPanel) {
	$Report1_summary->ExportOptions->render("body");
	$Report1_summary->SearchOptions->render("body");
	$Report1_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Report1_summary->showPageHeader(); ?>
<?php
$Report1_summary->showMessage();
?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Top Container -->
<div class="row">
	<div id="ew-top" class="<?php echo $Report1_summary->TopContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($Report1_summary->isExport("print") || $Report1_summary->isExport("pdf") || $Report1_summary->isExport("email") || $Report1_summary->isExport("excel") && Config("USE_PHPEXCEL") || $Report1_summary->isExport("word") && Config("USE_PHPWORD")) && $Report1_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$Report1_summary->Page_Breaking($Report1_summary->ExportChartPageBreak, $Report1_summary->PageBreakContent);
		$Report1->chartByKecamatan->PageBreakType = "after"; // Page break type
		$Report1->chartByKecamatan->PageBreak = $Report1_summary->ExportChartPageBreak;
		$Report1->chartByKecamatan->PageBreakContent = $Report1_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$Report1->chartByKecamatan->DrillDownInPanel = $Report1_summary->DrillDownInPanel;
	$Report1->chartByKecamatan->render("ew-chart-top");
}
?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($Report1_summary->isExport("print") || $Report1_summary->isExport("pdf") || $Report1_summary->isExport("email") || $Report1_summary->isExport("excel") && Config("USE_PHPEXCEL") || $Report1_summary->isExport("word") && Config("USE_PHPWORD")) && $Report1_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$Report1_summary->Page_Breaking($Report1_summary->ExportChartPageBreak, $Report1_summary->PageBreakContent);
		$Report1->chartByKelurahan->PageBreakType = "after"; // Page break type
		$Report1->chartByKelurahan->PageBreak = $Report1_summary->ExportChartPageBreak;
		$Report1->chartByKelurahan->PageBreakContent = $Report1_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$Report1->chartByKelurahan->DrillDownInPanel = $Report1_summary->DrillDownInPanel;
	$Report1->chartByKelurahan->render("ew-chart-top");
}
?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
	</div>
</div>
<!-- /#ew-top -->
<?php } ?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Report1_summary->CenterContentClass ?>">
<?php } ?>
<?php if ($Report1_summary->ShowDrillDownFilter) { ?>
<?php $Report1_summary->showDrillDownList() ?>
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Report1_summary->isExport() && !$Report1_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Report1_summary->isExport() && !$Report1->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Report1_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Report1">
	<div class="ew-extended-search">
<?php

// Render search row
$Report1->RowType = ROWTYPE_SEARCH;
$Report1->resetAttributes();
$Report1_summary->renderRow();
?>
<?php if ($Report1_summary->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
	<?php
		$Report1_summary->SearchColumnCount++;
		if (($Report1_summary->SearchColumnCount - 1) % $Report1_summary->SearchFieldsPerRow == 0) {
			$Report1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_jenis_bantuan_id" class="ew-cell form-group">
		<label for="x_jenis_bantuan_id" class="ew-search-caption ew-label"><?php echo $Report1_summary->jenis_bantuan_id->caption() ?></label>
		<span id="el_Report1_jenis_bantuan_id" class="ew-search-field">
<?php $Report1_summary->jenis_bantuan_id->EditAttrs->prepend("onclick", "ew.updateOptions.call(this);"); ?>
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($Report1_summary->jenis_bantuan_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $Report1_summary->jenis_bantuan_id->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_jenis_bantuan_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $Report1_summary->jenis_bantuan_id->radioButtonListHtml(TRUE, "x_jenis_bantuan_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_jenis_bantuan_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="Report1" data-field="x_jenis_bantuan_id" data-value-separator="<?php echo $Report1_summary->jenis_bantuan_id->displayValueSeparatorAttribute() ?>" name="x_jenis_bantuan_id" id="x_jenis_bantuan_id" value="{value}"<?php echo $Report1_summary->jenis_bantuan_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$Report1_summary->jenis_bantuan_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $Report1_summary->jenis_bantuan_id->Lookup->getParamTag($Report1_summary, "p_x_jenis_bantuan_id") ?>
</span>
	</div>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->bantuan_id->Visible) { // bantuan_id ?>
	<?php
		$Report1_summary->SearchColumnCount++;
		if (($Report1_summary->SearchColumnCount - 1) % $Report1_summary->SearchFieldsPerRow == 0) {
			$Report1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_bantuan_id" class="ew-cell form-group">
		<label for="x_bantuan_id" class="ew-search-caption ew-label"><?php echo $Report1_summary->bantuan_id->caption() ?></label>
		<span id="el_Report1_bantuan_id" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_bantuan_id"><?php echo EmptyValue(strval($Report1_summary->bantuan_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Report1_summary->bantuan_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($Report1_summary->bantuan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($Report1_summary->bantuan_id->ReadOnly || $Report1_summary->bantuan_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_bantuan_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $Report1_summary->bantuan_id->Lookup->getParamTag($Report1_summary, "p_x_bantuan_id") ?>
<input type="hidden" data-table="Report1" data-field="x_bantuan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $Report1_summary->bantuan_id->displayValueSeparatorAttribute() ?>" name="x_bantuan_id" id="x_bantuan_id" value="<?php echo $Report1_summary->bantuan_id->AdvancedSearch->SearchValue ?>"<?php echo $Report1_summary->bantuan_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->type->Visible) { // type ?>
	<?php
		$Report1_summary->SearchColumnCount++;
		if (($Report1_summary->SearchColumnCount - 1) % $Report1_summary->SearchFieldsPerRow == 0) {
			$Report1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_type" class="ew-cell form-group">
		<label for="x_type" class="ew-search-caption ew-label"><?php echo $Report1_summary->type->caption() ?></label>
		<span id="el_Report1_type" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($Report1_summary->type->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $Report1_summary->type->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_type" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $Report1_summary->type->radioButtonListHtml(TRUE, "x_type") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="Report1" data-field="x_type" data-value-separator="<?php echo $Report1_summary->type->displayValueSeparatorAttribute() ?>" name="x_type" id="x_type" value="{value}"<?php echo $Report1_summary->type->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$Report1_summary->type->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
</span>
	</div>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->tahun_bantuan->Visible) { // tahun_bantuan ?>
	<?php
		$Report1_summary->SearchColumnCount++;
		if (($Report1_summary->SearchColumnCount - 1) % $Report1_summary->SearchFieldsPerRow == 0) {
			$Report1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun_bantuan" class="ew-cell form-group">
		<label for="x_tahun_bantuan" class="ew-search-caption ew-label"><?php echo $Report1_summary->tahun_bantuan->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun_bantuan" id="z_tahun_bantuan" value="=">
</span>
		<span id="el_Report1_tahun_bantuan" class="ew-search-field">
<input type="text" data-table="Report1" data-field="x_tahun_bantuan" name="x_tahun_bantuan" id="x_tahun_bantuan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($Report1_summary->tahun_bantuan->getPlaceHolder()) ?>" value="<?php echo $Report1_summary->tahun_bantuan->EditValue ?>"<?php echo $Report1_summary->tahun_bantuan->editAttributes() ?>>
</span>
	</div>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->kecamatan_id->Visible) { // kecamatan_id ?>
	<?php
		$Report1_summary->SearchColumnCount++;
		if (($Report1_summary->SearchColumnCount - 1) % $Report1_summary->SearchFieldsPerRow == 0) {
			$Report1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kecamatan_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $Report1_summary->kecamatan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kecamatan_id" id="z_kecamatan_id" value="=">
</span>
		<span id="el_Report1_kecamatan_id" class="ew-search-field">
<?php
$onchange = $Report1_summary->kecamatan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Report1_summary->kecamatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kecamatan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kecamatan_id" id="sv_x_kecamatan_id" value="<?php echo RemoveHtml($Report1_summary->kecamatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($Report1_summary->kecamatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($Report1_summary->kecamatan_id->getPlaceHolder()) ?>"<?php echo $Report1_summary->kecamatan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($Report1_summary->kecamatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kecamatan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($Report1_summary->kecamatan_id->ReadOnly || $Report1_summary->kecamatan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="Report1" data-field="x_kecamatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $Report1_summary->kecamatan_id->displayValueSeparatorAttribute() ?>" name="x_kecamatan_id" id="x_kecamatan_id" value="<?php echo HtmlEncode($Report1_summary->kecamatan_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fsummary"], function() {
	fsummary.createAutoSuggest({"id":"x_kecamatan_id","forceSelect":true});
});
</script>
<?php echo $Report1_summary->kecamatan_id->Lookup->getParamTag($Report1_summary, "p_x_kecamatan_id") ?>
</span>
	</div>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->kelurahan_id->Visible) { // kelurahan_id ?>
	<?php
		$Report1_summary->SearchColumnCount++;
		if (($Report1_summary->SearchColumnCount - 1) % $Report1_summary->SearchFieldsPerRow == 0) {
			$Report1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kelurahan_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $Report1_summary->kelurahan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kelurahan_id" id="z_kelurahan_id" value="=">
</span>
		<span id="el_Report1_kelurahan_id" class="ew-search-field">
<?php
$onchange = $Report1_summary->kelurahan_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Report1_summary->kelurahan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_kelurahan_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_kelurahan_id" id="sv_x_kelurahan_id" value="<?php echo RemoveHtml($Report1_summary->kelurahan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($Report1_summary->kelurahan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($Report1_summary->kelurahan_id->getPlaceHolder()) ?>"<?php echo $Report1_summary->kelurahan_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($Report1_summary->kelurahan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_kelurahan_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($Report1_summary->kelurahan_id->ReadOnly || $Report1_summary->kelurahan_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="Report1" data-field="x_kelurahan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $Report1_summary->kelurahan_id->displayValueSeparatorAttribute() ?>" name="x_kelurahan_id" id="x_kelurahan_id" value="<?php echo HtmlEncode($Report1_summary->kelurahan_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fsummary"], function() {
	fsummary.createAutoSuggest({"id":"x_kelurahan_id","forceSelect":true});
});
</script>
<?php echo $Report1_summary->kelurahan_id->Lookup->getParamTag($Report1_summary, "p_x_kelurahan_id") ?>
</span>
	</div>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->rw_id->Visible) { // rw_id ?>
	<?php
		$Report1_summary->SearchColumnCount++;
		if (($Report1_summary->SearchColumnCount - 1) % $Report1_summary->SearchFieldsPerRow == 0) {
			$Report1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_rw_id" class="ew-cell form-group">
		<label for="x_rw_id" class="ew-search-caption ew-label"><?php echo $Report1_summary->rw_id->caption() ?></label>
		<span id="el_Report1_rw_id" class="ew-search-field">
<?php $Report1_summary->rw_id->EditAttrs->prepend("onclick", "ew.updateOptions.call(this);"); ?>
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($Report1_summary->rw_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $Report1_summary->rw_id->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_rw_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $Report1_summary->rw_id->radioButtonListHtml(TRUE, "x_rw_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_rw_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="Report1" data-field="x_rw_id" data-value-separator="<?php echo $Report1_summary->rw_id->displayValueSeparatorAttribute() ?>" name="x_rw_id" id="x_rw_id" value="{value}"<?php echo $Report1_summary->rw_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$Report1_summary->rw_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $Report1_summary->rw_id->Lookup->getParamTag($Report1_summary, "p_x_rw_id") ?>
</span>
	</div>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->rt_id->Visible) { // rt_id ?>
	<?php
		$Report1_summary->SearchColumnCount++;
		if (($Report1_summary->SearchColumnCount - 1) % $Report1_summary->SearchFieldsPerRow == 0) {
			$Report1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_rt_id" class="ew-cell form-group">
		<label for="x_rt_id" class="ew-search-caption ew-label"><?php echo $Report1_summary->rt_id->caption() ?></label>
		<span id="el_Report1_rt_id" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($Report1_summary->rt_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $Report1_summary->rt_id->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_rt_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $Report1_summary->rt_id->radioButtonListHtml(TRUE, "x_rt_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_rt_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="Report1" data-field="x_rt_id" data-value-separator="<?php echo $Report1_summary->rt_id->displayValueSeparatorAttribute() ?>" name="x_rt_id" id="x_rt_id" value="{value}"<?php echo $Report1_summary->rt_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$Report1_summary->rt_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $Report1_summary->rt_id->Lookup->getParamTag($Report1_summary, "p_x_rt_id") ?>
</span>
	</div>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Report1_summary->GroupCount <= count($Report1_summary->GroupRecords) && $Report1_summary->GroupCount <= $Report1_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Report1_summary->ShowHeader) {
?>
<?php if ($Report1_summary->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Report1_summary->TotalGroups > 0) { ?>
<?php if (!$Report1_summary->isExport() && !($Report1_summary->DrillDown && $Report1_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Report1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php echo $Report1_summary->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$Report1_summary->isExport("word") && !$Report1_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Report1_summary->ReportTableStyle ?>>
<?php if (!$Report1_summary->isExport() && !($Report1_summary->DrillDown && $Report1_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Report1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Report1" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Report1_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Report1_summary->jenis_bantuan_id->Visible) { ?>
	<?php if ($Report1_summary->jenis_bantuan_id->ShowGroupHeaderAsRow) { ?>
	<th data-name="jenis_bantuan_id">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Report1_summary->sortUrl($Report1_summary->jenis_bantuan_id) == "") { ?>
	<th data-name="jenis_bantuan_id" class="<?php echo $Report1_summary->jenis_bantuan_id->headerCellClass() ?>"><div class="Report1_jenis_bantuan_id"><div class="ew-table-header-caption"><?php echo $Report1_summary->jenis_bantuan_id->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="jenis_bantuan_id" class="<?php echo $Report1_summary->jenis_bantuan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->jenis_bantuan_id) ?>', 1);"><div class="Report1_jenis_bantuan_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->jenis_bantuan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->jenis_bantuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->jenis_bantuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->bantuan_id->Visible) { ?>
	<?php if ($Report1_summary->bantuan_id->ShowGroupHeaderAsRow) { ?>
	<th data-name="bantuan_id">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Report1_summary->sortUrl($Report1_summary->bantuan_id) == "") { ?>
	<th data-name="bantuan_id" class="<?php echo $Report1_summary->bantuan_id->headerCellClass() ?>"><div class="Report1_bantuan_id"><div class="ew-table-header-caption"><?php echo $Report1_summary->bantuan_id->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="bantuan_id" class="<?php echo $Report1_summary->bantuan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->bantuan_id) ?>', 1);"><div class="Report1_bantuan_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->bantuan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->bantuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->bantuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->type->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->type) == "") { ?>
	<th data-name="type" class="<?php echo $Report1_summary->type->headerCellClass() ?>"><div class="Report1_type"><div class="ew-table-header-caption"><?php echo $Report1_summary->type->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="type" class="<?php echo $Report1_summary->type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->type) ?>', 1);"><div class="Report1_type">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->type->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->tahun_bantuan->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->tahun_bantuan) == "") { ?>
	<th data-name="tahun_bantuan" class="<?php echo $Report1_summary->tahun_bantuan->headerCellClass() ?>"><div class="Report1_tahun_bantuan"><div class="ew-table-header-caption"><?php echo $Report1_summary->tahun_bantuan->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="tahun_bantuan" class="<?php echo $Report1_summary->tahun_bantuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->tahun_bantuan) ?>', 1);"><div class="Report1_tahun_bantuan">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->tahun_bantuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->tahun_bantuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->tahun_bantuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->kk->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->kk) == "") { ?>
	<th data-name="kk" class="<?php echo $Report1_summary->kk->headerCellClass() ?>"><div class="Report1_kk"><div class="ew-table-header-caption"><?php echo $Report1_summary->kk->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="kk" class="<?php echo $Report1_summary->kk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->kk) ?>', 1);"><div class="Report1_kk">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->kk->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->kk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->kk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->nik->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->nik) == "") { ?>
	<th data-name="nik" class="<?php echo $Report1_summary->nik->headerCellClass() ?>"><div class="Report1_nik"><div class="ew-table-header-caption"><?php echo $Report1_summary->nik->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="nik" class="<?php echo $Report1_summary->nik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->nik) ?>', 1);"><div class="Report1_nik">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->nik->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->nik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->nik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->nama->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->nama) == "") { ?>
	<th data-name="nama" class="<?php echo $Report1_summary->nama->headerCellClass() ?>"><div class="Report1_nama"><div class="ew-table-header-caption"><?php echo $Report1_summary->nama->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="nama" class="<?php echo $Report1_summary->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->nama) ?>', 1);"><div class="Report1_nama">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->kecamatan_id->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->kecamatan_id) == "") { ?>
	<th data-name="kecamatan_id" class="<?php echo $Report1_summary->kecamatan_id->headerCellClass() ?>"><div class="Report1_kecamatan_id"><div class="ew-table-header-caption"><?php echo $Report1_summary->kecamatan_id->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="kecamatan_id" class="<?php echo $Report1_summary->kecamatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->kecamatan_id) ?>', 1);"><div class="Report1_kecamatan_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->kecamatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->kecamatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->kecamatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->kelurahan_id->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->kelurahan_id) == "") { ?>
	<th data-name="kelurahan_id" class="<?php echo $Report1_summary->kelurahan_id->headerCellClass() ?>"><div class="Report1_kelurahan_id"><div class="ew-table-header-caption"><?php echo $Report1_summary->kelurahan_id->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="kelurahan_id" class="<?php echo $Report1_summary->kelurahan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->kelurahan_id) ?>', 1);"><div class="Report1_kelurahan_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->kelurahan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->kelurahan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->kelurahan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->rw_id->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->rw_id) == "") { ?>
	<th data-name="rw_id" class="<?php echo $Report1_summary->rw_id->headerCellClass() ?>"><div class="Report1_rw_id"><div class="ew-table-header-caption"><?php echo $Report1_summary->rw_id->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="rw_id" class="<?php echo $Report1_summary->rw_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->rw_id) ?>', 1);"><div class="Report1_rw_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->rw_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->rw_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->rw_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->rt_id->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->rt_id) == "") { ?>
	<th data-name="rt_id" class="<?php echo $Report1_summary->rt_id->headerCellClass() ?>"><div class="Report1_rt_id"><div class="ew-table-header-caption"><?php echo $Report1_summary->rt_id->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="rt_id" class="<?php echo $Report1_summary->rt_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->rt_id) ?>', 1);"><div class="Report1_rt_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->rt_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->rt_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->rt_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->nama_kecamatan->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->nama_kecamatan) == "") { ?>
	<th data-name="nama_kecamatan" class="<?php echo $Report1_summary->nama_kecamatan->headerCellClass() ?>"><div class="Report1_nama_kecamatan"><div class="ew-table-header-caption"><?php echo $Report1_summary->nama_kecamatan->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="nama_kecamatan" class="<?php echo $Report1_summary->nama_kecamatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->nama_kecamatan) ?>', 1);"><div class="Report1_nama_kecamatan">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->nama_kecamatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->nama_kecamatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->nama_kecamatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->nama_kelurahan->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->nama_kelurahan) == "") { ?>
	<th data-name="nama_kelurahan" class="<?php echo $Report1_summary->nama_kelurahan->headerCellClass() ?>"><div class="Report1_nama_kelurahan"><div class="ew-table-header-caption"><?php echo $Report1_summary->nama_kelurahan->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="nama_kelurahan" class="<?php echo $Report1_summary->nama_kelurahan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->nama_kelurahan) ?>', 1);"><div class="Report1_nama_kelurahan">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->nama_kelurahan->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->nama_kelurahan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->nama_kelurahan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->nama_rw->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->nama_rw) == "") { ?>
	<th data-name="nama_rw" class="<?php echo $Report1_summary->nama_rw->headerCellClass() ?>"><div class="Report1_nama_rw"><div class="ew-table-header-caption"><?php echo $Report1_summary->nama_rw->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="nama_rw" class="<?php echo $Report1_summary->nama_rw->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->nama_rw) ?>', 1);"><div class="Report1_nama_rw">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->nama_rw->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->nama_rw->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->nama_rw->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->nama_rt->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->nama_rt) == "") { ?>
	<th data-name="nama_rt" class="<?php echo $Report1_summary->nama_rt->headerCellClass() ?>"><div class="Report1_nama_rt"><div class="ew-table-header-caption"><?php echo $Report1_summary->nama_rt->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="nama_rt" class="<?php echo $Report1_summary->nama_rt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->nama_rt) ?>', 1);"><div class="Report1_nama_rt">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->nama_rt->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->nama_rt->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->nama_rt->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Report1_summary->TotalGroups == 0)
			break; // Show header only
		$Report1_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Report1_summary->jenis_bantuan_id, $Report1_summary->getSqlFirstGroupField(), $Report1_summary->jenis_bantuan_id->groupValue(), $Report1_summary->Dbid);
	if ($Report1_summary->PageFirstGroupFilter != "") $Report1_summary->PageFirstGroupFilter .= " OR ";
	$Report1_summary->PageFirstGroupFilter .= $where;
	if ($Report1_summary->Filter != "")
		$where = "($Report1_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Report1_summary->getSqlSelect(), $Report1_summary->getSqlWhere(), $Report1_summary->getSqlGroupBy(), $Report1_summary->getSqlHaving(), $Report1_summary->getSqlOrderBy(), $where, $Report1_summary->Sort);
	$rs = $Report1_summary->getRecordset($sql);
	$Report1_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Report1_summary->DetailRecordCount = count($Report1_summary->DetailRecords);

	// Load detail records
	$Report1_summary->jenis_bantuan_id->Records = &$Report1_summary->DetailRecords;
	$Report1_summary->jenis_bantuan_id->LevelBreak = TRUE; // Set field level break
		$Report1_summary->GroupCounter[1] = $Report1_summary->GroupCount;
		$Report1_summary->jenis_bantuan_id->getCnt($Report1_summary->jenis_bantuan_id->Records); // Get record count
?>
<?php if ($Report1_summary->jenis_bantuan_id->Visible && $Report1_summary->jenis_bantuan_id->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Report1_summary->resetAttributes();
		$Report1_summary->RowType = ROWTYPE_TOTAL;
		$Report1_summary->RowTotalType = ROWTOTAL_GROUP;
		$Report1_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Report1_summary->RowGroupLevel = 1;
		$Report1_summary->renderRow();
?>
	<tr<?php echo $Report1_summary->rowAttributes(); ?>>
<?php if ($Report1_summary->jenis_bantuan_id->Visible) { ?>
		<td data-field="jenis_bantuan_id"<?php echo $Report1_summary->jenis_bantuan_id->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="jenis_bantuan_id" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Report1_summary->jenis_bantuan_id->cellAttributes() ?>>
<?php if ($Report1_summary->sortUrl($Report1_summary->jenis_bantuan_id) == "") { ?>
		<span class="ew-summary-caption Report1_jenis_bantuan_id"><span class="ew-table-header-caption"><?php echo $Report1_summary->jenis_bantuan_id->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Report1_jenis_bantuan_id" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->jenis_bantuan_id) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Report1_summary->jenis_bantuan_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Report1_summary->jenis_bantuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->jenis_bantuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Report1_summary->jenis_bantuan_id->viewAttributes() ?>><?php echo $Report1_summary->jenis_bantuan_id->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Report1_summary->jenis_bantuan_id->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Report1_summary->bantuan_id->getDistinctValues($Report1_summary->jenis_bantuan_id->Records);
	$Report1_summary->setGroupCount(count($Report1_summary->bantuan_id->DistinctValues), $Report1_summary->GroupCounter[1]);
	$Report1_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($Report1_summary->bantuan_id->DistinctValues as $bantuan_id) { // Load records for this distinct value
		$Report1_summary->bantuan_id->setGroupValue($bantuan_id); // Set group value
		$Report1_summary->bantuan_id->getDistinctRecords($Report1_summary->jenis_bantuan_id->Records, $Report1_summary->bantuan_id->groupValue());
		$Report1_summary->bantuan_id->LevelBreak = TRUE; // Set field level break
		$Report1_summary->GroupCounter[2]++;
		$Report1_summary->bantuan_id->getCnt($Report1_summary->bantuan_id->Records); // Get record count
		$Report1_summary->setGroupCount($Report1_summary->bantuan_id->Count, $Report1_summary->GroupCounter[1], $Report1_summary->GroupCounter[2]);
?>
<?php if ($Report1_summary->bantuan_id->Visible && $Report1_summary->bantuan_id->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Report1_summary->bantuan_id->setDbValue($bantuan_id); // Set current value for bantuan_id
		$Report1_summary->resetAttributes();
		$Report1_summary->RowType = ROWTYPE_TOTAL;
		$Report1_summary->RowTotalType = ROWTOTAL_GROUP;
		$Report1_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Report1_summary->RowGroupLevel = 2;
		$Report1_summary->renderRow();
?>
	<tr<?php echo $Report1_summary->rowAttributes(); ?>>
<?php if ($Report1_summary->jenis_bantuan_id->Visible) { ?>
		<td data-field="jenis_bantuan_id"<?php echo $Report1_summary->jenis_bantuan_id->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Report1_summary->bantuan_id->Visible) { ?>
		<td data-field="bantuan_id"<?php echo $Report1_summary->bantuan_id->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="bantuan_id" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $Report1_summary->bantuan_id->cellAttributes() ?>>
<?php if ($Report1_summary->sortUrl($Report1_summary->bantuan_id) == "") { ?>
		<span class="ew-summary-caption Report1_bantuan_id"><span class="ew-table-header-caption"><?php echo $Report1_summary->bantuan_id->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Report1_bantuan_id" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->bantuan_id) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Report1_summary->bantuan_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Report1_summary->bantuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->bantuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Report1_summary->bantuan_id->viewAttributes() ?>><?php echo $Report1_summary->bantuan_id->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Report1_summary->bantuan_id->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Report1_summary->RecordCount = 0; // Reset record count
	foreach ($Report1_summary->bantuan_id->Records as $record) {
		$Report1_summary->RecordCount++;
		$Report1_summary->RecordIndex++;
		$Report1_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Report1_summary->resetAttributes();
		$Report1_summary->RowType = ROWTYPE_DETAIL;
		$Report1_summary->renderRow();
?>
	<tr<?php echo $Report1_summary->rowAttributes(); ?>>
<?php if ($Report1_summary->jenis_bantuan_id->Visible) { ?>
	<?php if ($Report1_summary->jenis_bantuan_id->ShowGroupHeaderAsRow) { ?>
		<td data-field="jenis_bantuan_id"<?php echo $Report1_summary->jenis_bantuan_id->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="jenis_bantuan_id"<?php echo $Report1_summary->jenis_bantuan_id->cellAttributes(); ?>><span<?php echo $Report1_summary->jenis_bantuan_id->viewAttributes() ?>><?php echo $Report1_summary->jenis_bantuan_id->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->bantuan_id->Visible) { ?>
	<?php if ($Report1_summary->bantuan_id->ShowGroupHeaderAsRow) { ?>
		<td data-field="bantuan_id"<?php echo $Report1_summary->bantuan_id->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="bantuan_id"<?php echo $Report1_summary->bantuan_id->cellAttributes(); ?>><span<?php echo $Report1_summary->bantuan_id->viewAttributes() ?>><?php echo $Report1_summary->bantuan_id->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->type->Visible) { ?>
		<td data-field="type"<?php echo $Report1_summary->type->cellAttributes() ?>>
<span<?php echo $Report1_summary->type->viewAttributes() ?>><?php echo $Report1_summary->type->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->tahun_bantuan->Visible) { ?>
		<td data-field="tahun_bantuan"<?php echo $Report1_summary->tahun_bantuan->cellAttributes() ?>>
<span<?php echo $Report1_summary->tahun_bantuan->viewAttributes() ?>><?php echo $Report1_summary->tahun_bantuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->kk->Visible) { ?>
		<td data-field="kk"<?php echo $Report1_summary->kk->cellAttributes() ?>>
<span<?php echo $Report1_summary->kk->viewAttributes() ?>><?php echo $Report1_summary->kk->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->nik->Visible) { ?>
		<td data-field="nik"<?php echo $Report1_summary->nik->cellAttributes() ?>>
<span<?php echo $Report1_summary->nik->viewAttributes() ?>><?php echo $Report1_summary->nik->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->nama->Visible) { ?>
		<td data-field="nama"<?php echo $Report1_summary->nama->cellAttributes() ?>>
<span<?php echo $Report1_summary->nama->viewAttributes() ?>><?php echo $Report1_summary->nama->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->kecamatan_id->Visible) { ?>
		<td data-field="kecamatan_id"<?php echo $Report1_summary->kecamatan_id->cellAttributes() ?>>
<span<?php echo $Report1_summary->kecamatan_id->viewAttributes() ?>><?php echo $Report1_summary->kecamatan_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->kelurahan_id->Visible) { ?>
		<td data-field="kelurahan_id"<?php echo $Report1_summary->kelurahan_id->cellAttributes() ?>>
<span<?php echo $Report1_summary->kelurahan_id->viewAttributes() ?>><?php echo $Report1_summary->kelurahan_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->rw_id->Visible) { ?>
		<td data-field="rw_id"<?php echo $Report1_summary->rw_id->cellAttributes() ?>>
<span<?php echo $Report1_summary->rw_id->viewAttributes() ?>><?php echo $Report1_summary->rw_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->rt_id->Visible) { ?>
		<td data-field="rt_id"<?php echo $Report1_summary->rt_id->cellAttributes() ?>>
<span<?php echo $Report1_summary->rt_id->viewAttributes() ?>><?php echo $Report1_summary->rt_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->nama_kecamatan->Visible) { ?>
		<td data-field="nama_kecamatan"<?php echo $Report1_summary->nama_kecamatan->cellAttributes() ?>>
<span<?php echo $Report1_summary->nama_kecamatan->viewAttributes() ?>><?php echo $Report1_summary->nama_kecamatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->nama_kelurahan->Visible) { ?>
		<td data-field="nama_kelurahan"<?php echo $Report1_summary->nama_kelurahan->cellAttributes() ?>>
<span<?php echo $Report1_summary->nama_kelurahan->viewAttributes() ?>><?php echo $Report1_summary->nama_kelurahan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->nama_rw->Visible) { ?>
		<td data-field="nama_rw"<?php echo $Report1_summary->nama_rw->cellAttributes() ?>>
<span<?php echo $Report1_summary->nama_rw->viewAttributes() ?>><?php echo $Report1_summary->nama_rw->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->nama_rt->Visible) { ?>
		<td data-field="nama_rt"<?php echo $Report1_summary->nama_rt->cellAttributes() ?>>
<span<?php echo $Report1_summary->nama_rt->viewAttributes() ?>><?php echo $Report1_summary->nama_rt->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
	} // End group level 1
?>
<?php

	// Next group
	$Report1_summary->loadGroupRowValues();

	// Show header if page break
	if ($Report1_summary->isExport())
		$Report1_summary->ShowHeader = ($Report1_summary->ExportPageBreakCount == 0) ? FALSE : ($Report1_summary->GroupCount % $Report1_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Report1_summary->ShowHeader)
		$Report1_summary->Page_Breaking($Report1_summary->ShowHeader, $Report1_summary->PageBreakContent);
	$Report1_summary->GroupCount++;
} // End while
?>
<?php if ($Report1_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php if (($Report1_summary->StopGroup - $Report1_summary->StartGroup + 1) != $Report1_summary->TotalGroups) { ?>
<?php
	$Report1_summary->resetAttributes();
	$Report1_summary->RowType = ROWTYPE_TOTAL;
	$Report1_summary->RowTotalType = ROWTOTAL_PAGE;
	$Report1_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Report1_summary->RowAttrs["class"] = "ew-rpt-page-summary";
	$Report1_summary->renderRow();
?>
<?php if ($Report1_summary->jenis_bantuan_id->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Report1_summary->rowAttributes(); ?>><td colspan="<?php echo ($Report1_summary->GroupColumnCount + $Report1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Report1_summary->PageTotalCount, 0); ?></span>)</span></td></tr>
<?php } else { ?>
	<tr<?php echo $Report1_summary->rowAttributes(); ?>><td colspan="<?php echo ($Report1_summary->GroupColumnCount + $Report1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Report1_summary->PageTotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
<?php } ?>
<?php
	$Report1_summary->resetAttributes();
	$Report1_summary->RowType = ROWTYPE_TOTAL;
	$Report1_summary->RowTotalType = ROWTOTAL_GRAND;
	$Report1_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Report1_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Report1_summary->renderRow();
?>
<?php if ($Report1_summary->jenis_bantuan_id->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Report1_summary->rowAttributes() ?>><td colspan="<?php echo ($Report1_summary->GroupColumnCount + $Report1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Report1_summary->TotalCount, 0); ?></span>)</span></td></tr>
<?php } else { ?>
	<tr<?php echo $Report1_summary->rowAttributes() ?>><td colspan="<?php echo ($Report1_summary->GroupColumnCount + $Report1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Report1_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Report1_summary->TotalGroups > 0) { ?>
<?php if (!$Report1_summary->isExport() && !($Report1_summary->DrillDown && $Report1_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Report1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Report1_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Report1_summary->isExport() && !$Report1_summary->DrillDown && !$DashboardReport) { ?>
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
$Report1_summary->terminate();
?>