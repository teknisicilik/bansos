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
$Crosstab2_crosstab = new Crosstab2_crosstab();

// Run the page
$Crosstab2_crosstab->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Crosstab2_crosstab->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Crosstab2_crosstab->isExport() && !$Crosstab2_crosstab->DrillDown && !$DashboardReport) { ?>
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
		elm = this.getElements("x" + infix + "_tahun");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Crosstab2_crosstab->tahun->errorMessage()) ?>");

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
	fcrosstab.lists["x_bansos_id"] = <?php echo $Crosstab2_crosstab->bansos_id->Lookup->toClientList($Crosstab2_crosstab) ?>;
	fcrosstab.lists["x_bansos_id"].options = <?php echo JsonEncode($Crosstab2_crosstab->bansos_id->lookupOptions()) ?>;
	fcrosstab.lists["x_jenis_bantuan_id"] = <?php echo $Crosstab2_crosstab->jenis_bantuan_id->Lookup->toClientList($Crosstab2_crosstab) ?>;
	fcrosstab.lists["x_jenis_bantuan_id"].options = <?php echo JsonEncode($Crosstab2_crosstab->jenis_bantuan_id->lookupOptions()) ?>;
	fcrosstab.lists["x_type"] = <?php echo $Crosstab2_crosstab->type->Lookup->toClientList($Crosstab2_crosstab) ?>;
	fcrosstab.lists["x_type"].options = <?php echo JsonEncode($Crosstab2_crosstab->type->options(FALSE, TRUE)) ?>;

	// Filters
	fcrosstab.filterList = <?php echo $Crosstab2_crosstab->getFilterList() ?>;

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
<?php if ((!$Crosstab2_crosstab->isExport() || $Crosstab2_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Crosstab2_crosstab->ShowCurrentFilter) { ?>
<?php $Crosstab2_crosstab->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Crosstab2_crosstab->DrillDownInPanel) {
	$Crosstab2_crosstab->ExportOptions->render("body");
	$Crosstab2_crosstab->SearchOptions->render("body");
	$Crosstab2_crosstab->FilterOptions->render("body");
}
?>
</div>
<?php $Crosstab2_crosstab->showPageHeader(); ?>
<?php
$Crosstab2_crosstab->showMessage();
?>
<?php if ((!$Crosstab2_crosstab->isExport() || $Crosstab2_crosstab->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Crosstab2_crosstab->isExport() || $Crosstab2_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Crosstab2_crosstab->CenterContentClass ?>">
<?php } ?>
<?php if ($Crosstab2_crosstab->ShowDrillDownFilter) { ?>
<?php $Crosstab2_crosstab->showDrillDownList() ?>
<?php } ?>
<!-- Crosstab report (begin) -->
<div id="report_crosstab">
<?php if (!$Crosstab2_crosstab->isExport() && !$Crosstab2_crosstab->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Crosstab2_crosstab->isExport() && !$Crosstab2->CurrentAction) { ?>
<form name="fcrosstab" id="fcrosstab" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcrosstab-search-panel" class="<?php echo $Crosstab2_crosstab->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Crosstab2">
	<div class="ew-extended-search">
<?php

// Render search row
$Crosstab2->RowType = ROWTYPE_SEARCH;
$Crosstab2->resetAttributes();
$Crosstab2_crosstab->renderRow();
?>
<?php if ($Crosstab2_crosstab->bansos_id->Visible) { // bansos_id ?>
	<?php
		$Crosstab2_crosstab->SearchColumnCount++;
		if (($Crosstab2_crosstab->SearchColumnCount - 1) % $Crosstab2_crosstab->SearchFieldsPerRow == 0) {
			$Crosstab2_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Crosstab2_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_bansos_id" class="ew-cell form-group">
		<label for="x_bansos_id" class="ew-search-caption ew-label"><?php echo $Crosstab2_crosstab->bansos_id->caption() ?></label>
		<span id="el_Crosstab2_bansos_id" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_bansos_id"><?php echo EmptyValue(strval($Crosstab2_crosstab->bansos_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Crosstab2_crosstab->bansos_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($Crosstab2_crosstab->bansos_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($Crosstab2_crosstab->bansos_id->ReadOnly || $Crosstab2_crosstab->bansos_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_bansos_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $Crosstab2_crosstab->bansos_id->Lookup->getParamTag($Crosstab2_crosstab, "p_x_bansos_id") ?>
<input type="hidden" data-table="Crosstab2" data-field="x_bansos_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $Crosstab2_crosstab->bansos_id->displayValueSeparatorAttribute() ?>" name="x_bansos_id" id="x_bansos_id" value="<?php echo $Crosstab2_crosstab->bansos_id->AdvancedSearch->SearchValue ?>"<?php echo $Crosstab2_crosstab->bansos_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($Crosstab2_crosstab->SearchColumnCount % $Crosstab2_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Crosstab2_crosstab->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
	<?php
		$Crosstab2_crosstab->SearchColumnCount++;
		if (($Crosstab2_crosstab->SearchColumnCount - 1) % $Crosstab2_crosstab->SearchFieldsPerRow == 0) {
			$Crosstab2_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Crosstab2_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_jenis_bantuan_id" class="ew-cell form-group">
		<label for="x_jenis_bantuan_id" class="ew-search-caption ew-label"><?php echo $Crosstab2_crosstab->jenis_bantuan_id->caption() ?></label>
		<span id="el_Crosstab2_jenis_bantuan_id" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($Crosstab2_crosstab->jenis_bantuan_id->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $Crosstab2_crosstab->jenis_bantuan_id->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_jenis_bantuan_id" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $Crosstab2_crosstab->jenis_bantuan_id->radioButtonListHtml(TRUE, "x_jenis_bantuan_id") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_jenis_bantuan_id" class="ew-template"><input type="radio" class="custom-control-input" data-table="Crosstab2" data-field="x_jenis_bantuan_id" data-value-separator="<?php echo $Crosstab2_crosstab->jenis_bantuan_id->displayValueSeparatorAttribute() ?>" name="x_jenis_bantuan_id" id="x_jenis_bantuan_id" value="{value}"<?php echo $Crosstab2_crosstab->jenis_bantuan_id->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$Crosstab2_crosstab->jenis_bantuan_id->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $Crosstab2_crosstab->jenis_bantuan_id->Lookup->getParamTag($Crosstab2_crosstab, "p_x_jenis_bantuan_id") ?>
</span>
	</div>
	<?php if ($Crosstab2_crosstab->SearchColumnCount % $Crosstab2_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Crosstab2_crosstab->type->Visible) { // type ?>
	<?php
		$Crosstab2_crosstab->SearchColumnCount++;
		if (($Crosstab2_crosstab->SearchColumnCount - 1) % $Crosstab2_crosstab->SearchFieldsPerRow == 0) {
			$Crosstab2_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Crosstab2_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_type" class="ew-cell form-group">
		<label for="x_type" class="ew-search-caption ew-label"><?php echo $Crosstab2_crosstab->type->caption() ?></label>
		<span id="el_Crosstab2_type" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($Crosstab2_crosstab->type->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $Crosstab2_crosstab->type->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_type" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $Crosstab2_crosstab->type->radioButtonListHtml(TRUE, "x_type") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="Crosstab2" data-field="x_type" data-value-separator="<?php echo $Crosstab2_crosstab->type->displayValueSeparatorAttribute() ?>" name="x_type" id="x_type" value="{value}"<?php echo $Crosstab2_crosstab->type->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$Crosstab2_crosstab->type->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
</span>
	</div>
	<?php if ($Crosstab2_crosstab->SearchColumnCount % $Crosstab2_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Crosstab2_crosstab->tahun->Visible) { // tahun ?>
	<?php
		$Crosstab2_crosstab->SearchColumnCount++;
		if (($Crosstab2_crosstab->SearchColumnCount - 1) % $Crosstab2_crosstab->SearchFieldsPerRow == 0) {
			$Crosstab2_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Crosstab2_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun" class="ew-cell form-group">
		<label for="x_tahun" class="ew-search-caption ew-label"><?php echo $Crosstab2_crosstab->tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun" id="z_tahun" value="=">
</span>
		<span id="el_Crosstab2_tahun" class="ew-search-field">
<input type="text" data-table="Crosstab2" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($Crosstab2_crosstab->tahun->getPlaceHolder()) ?>" value="<?php echo $Crosstab2_crosstab->tahun->EditValue ?>"<?php echo $Crosstab2_crosstab->tahun->editAttributes() ?>>
</span>
	</div>
	<?php if ($Crosstab2_crosstab->SearchColumnCount % $Crosstab2_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Crosstab2_crosstab->SearchColumnCount % $Crosstab2_crosstab->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Crosstab2_crosstab->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Crosstab2_crosstab->GroupCount <= count($Crosstab2_crosstab->GroupRecords) && $Crosstab2_crosstab->GroupCount <= $Crosstab2_crosstab->DisplayGroups) {
?>
<?php

	// Show header
	if ($Crosstab2_crosstab->ShowHeader) {
?>
<?php if ($Crosstab2_crosstab->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Crosstab2_crosstab->TotalGroups > 0) { ?>
<?php if (!$Crosstab2_crosstab->isExport() && !($Crosstab2_crosstab->DrillDown && $Crosstab2_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Crosstab2_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php echo $Crosstab2_crosstab->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$Crosstab2_crosstab->isExport("word") && !$Crosstab2_crosstab->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Crosstab2_crosstab->ReportTableStyle ?>>
<?php if (!$Crosstab2_crosstab->isExport() && !($Crosstab2_crosstab->DrillDown && $Crosstab2_crosstab->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Crosstab2_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Crosstab2" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Crosstab2_crosstab->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Crosstab2_crosstab->GroupColumnCount > 0) { ?>
		<td class="ew-rpt-col-summary" colspan="<?php echo $Crosstab2_crosstab->GroupColumnCount ?>"><div><?php echo $Crosstab2_crosstab->renderSummaryCaptions() ?></div></td>
<?php } ?>
		<td class="ew-rpt-col-header" colspan="<?php echo @$Crosstab2_crosstab->ColumnSpan ?>">
			<div class="ew-table-header-btn">
				<span class="ew-table-header-caption"><?php echo $Crosstab2_crosstab->tahun->caption() ?></span>
			</div>
		</td>
	</tr>
	<tr class="ew-table-header">
<?php if ($Crosstab2_crosstab->bansos_id->Visible) { ?>
	<td data-field="bansos_id">
<?php if ($Crosstab2_crosstab->sortUrl($Crosstab2_crosstab->bansos_id) == "") { ?>
		<div class="ew-table-header-btn Crosstab2_bansos_id">
			<span class="ew-table-header-caption"><?php echo $Crosstab2_crosstab->bansos_id->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Crosstab2_bansos_id" onclick="ew.sort(event, '<?php echo $Crosstab2_crosstab->sortUrl($Crosstab2_crosstab->bansos_id) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Crosstab2_crosstab->bansos_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Crosstab2_crosstab->bansos_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Crosstab2_crosstab->bansos_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Crosstab2_crosstab->jenis_bantuan_id->Visible) { ?>
	<td data-field="jenis_bantuan_id">
<?php if ($Crosstab2_crosstab->sortUrl($Crosstab2_crosstab->jenis_bantuan_id) == "") { ?>
		<div class="ew-table-header-btn Crosstab2_jenis_bantuan_id">
			<span class="ew-table-header-caption"><?php echo $Crosstab2_crosstab->jenis_bantuan_id->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Crosstab2_jenis_bantuan_id" onclick="ew.sort(event, '<?php echo $Crosstab2_crosstab->sortUrl($Crosstab2_crosstab->jenis_bantuan_id) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Crosstab2_crosstab->jenis_bantuan_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Crosstab2_crosstab->jenis_bantuan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Crosstab2_crosstab->jenis_bantuan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Crosstab2_crosstab->type->Visible) { ?>
	<td data-field="type">
<?php if ($Crosstab2_crosstab->sortUrl($Crosstab2_crosstab->type) == "") { ?>
		<div class="ew-table-header-btn Crosstab2_type">
			<span class="ew-table-header-caption"><?php echo $Crosstab2_crosstab->type->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Crosstab2_type" onclick="ew.sort(event, '<?php echo $Crosstab2_crosstab->sortUrl($Crosstab2_crosstab->type) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Crosstab2_crosstab->type->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Crosstab2_crosstab->type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Crosstab2_crosstab->type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntval = count($Crosstab2_crosstab->Columns);
	for ($iy = 1; $iy < $cntval; $iy++) {
		if ($Crosstab2_crosstab->Columns[$iy]->Visible) {
			$Crosstab2_crosstab->SummaryCurrentValues[$iy-1] = $Crosstab2_crosstab->Columns[$iy]->Caption;
			$Crosstab2_crosstab->SummaryViewValues[$iy-1] = $Crosstab2_crosstab->SummaryCurrentValues[$iy-1];
?>
		<td class="ew-table-header"<?php echo $Crosstab2_crosstab->tahun->cellAttributes() ?>><div<?php echo $Crosstab2_crosstab->tahun->viewAttributes() ?>><?php echo $Crosstab2_crosstab->SummaryViewValues[$iy-1]; ?></div></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
		<td class="ew-table-header"<?php echo $Crosstab2_crosstab->tahun->cellAttributes() ?>><div<?php echo $Crosstab2_crosstab->tahun->viewAttributes() ?>><?php echo $Crosstab2_crosstab->renderSummaryCaptions() ?></div></td>
	</tr>
</thead>
<tbody>
<?php
		if ($Crosstab2_crosstab->TotalGroups == 0)
			break; // Show header only
		$Crosstab2_crosstab->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Crosstab2_crosstab->bansos_id, $Crosstab2_crosstab->getSqlFirstGroupField(), $Crosstab2_crosstab->bansos_id->groupValue(), $Crosstab2_crosstab->Dbid);
	if ($Crosstab2_crosstab->PageFirstGroupFilter != "") $Crosstab2_crosstab->PageFirstGroupFilter .= " OR ";
	$Crosstab2_crosstab->PageFirstGroupFilter .= $where;
	if ($Crosstab2_crosstab->Filter != "")
		$where = "($Crosstab2_crosstab->Filter) AND ($where)";
	$sql = BuildReportSql(str_replace("{DistinctColumnFields}", $Crosstab2_crosstab->DistinctColumnFields, $Crosstab2_crosstab->getSqlSelect()), $Crosstab2_crosstab->getSqlWhere(), $Crosstab2_crosstab->getSqlGroupBy(), "", $Crosstab2_crosstab->getSqlOrderBy(), $where, $Crosstab2_crosstab->Sort);
	$rs = $Crosstab2_crosstab->getRecordset($sql);
	$Crosstab2_crosstab->DetailRecords = $rs ? $rs->getRows() : [];
	$Crosstab2_crosstab->DetailRecordCount = count($Crosstab2_crosstab->DetailRecords);

	// Load detail records
	$Crosstab2_crosstab->bansos_id->Records = &$Crosstab2_crosstab->DetailRecords;
	$Crosstab2_crosstab->bansos_id->LevelBreak = TRUE; // Set field level break
	$Crosstab2_crosstab->jenis_bantuan_id->getDistinctValues($Crosstab2_crosstab->bansos_id->Records);
	foreach ($Crosstab2_crosstab->jenis_bantuan_id->DistinctValues as $jenis_bantuan_id) { // Load records for this distinct value
		$Crosstab2_crosstab->jenis_bantuan_id->setGroupValue($jenis_bantuan_id); // Set group value
		$Crosstab2_crosstab->jenis_bantuan_id->getDistinctRecords($Crosstab2_crosstab->bansos_id->Records, $Crosstab2_crosstab->jenis_bantuan_id->groupValue());
		$Crosstab2_crosstab->jenis_bantuan_id->LevelBreak = TRUE; // Set field level break
	$Crosstab2_crosstab->type->getDistinctValues($Crosstab2_crosstab->jenis_bantuan_id->Records);
	foreach ($Crosstab2_crosstab->type->DistinctValues as $type) { // Load records for this distinct value
		$Crosstab2_crosstab->type->setGroupValue($type); // Set group value
		$Crosstab2_crosstab->type->getDistinctRecords($Crosstab2_crosstab->jenis_bantuan_id->Records, $Crosstab2_crosstab->type->groupValue());
		$Crosstab2_crosstab->type->LevelBreak = TRUE; // Set field level break
	foreach ($Crosstab2_crosstab->type->Records as $record) {
		$Crosstab2_crosstab->RecordCount++;
		$Crosstab2_crosstab->RecordIndex++;
		$Crosstab2_crosstab->loadRowValues($record);

		// Render row
		$Crosstab2_crosstab->resetAttributes();
		$Crosstab2_crosstab->RowType = ROWTYPE_DETAIL;
		$Crosstab2_crosstab->renderRow();
?>
	<tr<?php echo $Crosstab2_crosstab->rowAttributes(); ?>>
<?php if ($Crosstab2_crosstab->bansos_id->Visible) { ?>
		<!-- bansos_id -->
		<td data-field="bansos_id"<?php echo $Crosstab2_crosstab->bansos_id->cellAttributes(); ?>><span<?php echo $Crosstab2_crosstab->bansos_id->viewAttributes() ?>><?php echo $Crosstab2_crosstab->bansos_id->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Crosstab2_crosstab->jenis_bantuan_id->Visible) { ?>
		<!-- jenis_bantuan_id -->
		<td data-field="jenis_bantuan_id"<?php echo $Crosstab2_crosstab->jenis_bantuan_id->cellAttributes(); ?>><span<?php echo $Crosstab2_crosstab->jenis_bantuan_id->viewAttributes() ?>><?php echo $Crosstab2_crosstab->jenis_bantuan_id->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Crosstab2_crosstab->type->Visible) { ?>
		<!-- type -->
		<td data-field="type"<?php echo $Crosstab2_crosstab->type->cellAttributes(); ?>><span<?php echo $Crosstab2_crosstab->type->viewAttributes() ?>><?php echo $Crosstab2_crosstab->type->GroupViewValue ?></span></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
		$cntcol = count($Crosstab2_crosstab->SummaryViewValues);
		for ($iy = 1; $iy <= $cntcol; $iy++) {
			$colShow = ($iy <= $Crosstab2_crosstab->ColumnCount) ? $Crosstab2_crosstab->Columns[$iy]->Visible : TRUE;
			$colDesc = ($iy <= $Crosstab2_crosstab->ColumnCount) ? $Crosstab2_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
			if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Crosstab2_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Crosstab2_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
			}
		}
?>
<!-- Dynamic columns end -->
	</tr>
<?php
	}
	} // End group level 2
?>
<?php if ($Crosstab2_crosstab->TotalGroups > 0) { ?>
<?php
	$Crosstab2_crosstab->getSummaryValues($Crosstab2_crosstab->jenis_bantuan_id->Records); // Get crosstab summaries from records
	$Crosstab2_crosstab->resetAttributes();
	$Crosstab2_crosstab->RowType = ROWTYPE_TOTAL;
	$Crosstab2_crosstab->RowTotalType = ROWTOTAL_GROUP;
	$Crosstab2_crosstab->RowTotalSubType = ROWTOTAL_FOOTER;
	$Crosstab2_crosstab->RowGroupLevel = 2;
	$Crosstab2_crosstab->renderRow();
?>
	<!-- Summary jenis_bantuan_id (level 2) -->
	<tr<?php echo $Crosstab2_crosstab->rowAttributes(); ?>>
		<td data-field="bansos_id"<?php echo $Crosstab2_crosstab->bansos_id->cellAttributes() ?>>&nbsp;</td>
		<td colspan="<?php echo ($Crosstab2_crosstab->GroupColumnCount - 1) ?>"<?php echo $Crosstab2_crosstab->jenis_bantuan_id->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Crosstab2_crosstab->jenis_bantuan_id->GroupViewValue, $Crosstab2_crosstab->jenis_bantuan_id->caption()], $Language->phrase("CtbSumHead")) ?></td>
<!-- Dynamic columns begin -->
<?php
	$cntcol = count($Crosstab2_crosstab->SummaryViewValues);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$colShow = ($iy <= $Crosstab2_crosstab->ColumnCount) ? $Crosstab2_crosstab->Columns[$iy]->Visible : TRUE;
		$colDesc = ($iy <= $Crosstab2_crosstab->ColumnCount) ? $Crosstab2_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
		if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Crosstab2_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Crosstab2_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
	</tr>
<?php } ?>
<?php
	} // End group level 1
?>
<?php if ($Crosstab2_crosstab->TotalGroups > 0) { ?>
<?php
	$Crosstab2_crosstab->getSummaryValues($Crosstab2_crosstab->bansos_id->Records); // Get crosstab summaries from records
	$Crosstab2_crosstab->resetAttributes();
	$Crosstab2_crosstab->RowType = ROWTYPE_TOTAL;
	$Crosstab2_crosstab->RowTotalType = ROWTOTAL_GROUP;
	$Crosstab2_crosstab->RowTotalSubType = ROWTOTAL_FOOTER;
	$Crosstab2_crosstab->RowGroupLevel = 1;
	$Crosstab2_crosstab->renderRow();
?>
	<!-- Summary bansos_id (level 1) -->
	<tr<?php echo $Crosstab2_crosstab->rowAttributes(); ?>>
		<td colspan="<?php echo ($Crosstab2_crosstab->GroupColumnCount - 0) ?>"<?php echo $Crosstab2_crosstab->bansos_id->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Crosstab2_crosstab->bansos_id->GroupViewValue, $Crosstab2_crosstab->bansos_id->caption()], $Language->phrase("CtbSumHead")) ?></td>
<!-- Dynamic columns begin -->
<?php
	$cntcol = count($Crosstab2_crosstab->SummaryViewValues);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$colShow = ($iy <= $Crosstab2_crosstab->ColumnCount) ? $Crosstab2_crosstab->Columns[$iy]->Visible : TRUE;
		$colDesc = ($iy <= $Crosstab2_crosstab->ColumnCount) ? $Crosstab2_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
		if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Crosstab2_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Crosstab2_crosstab->renderSummaryFields($iy-1) ?></td>
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
	$Crosstab2_crosstab->loadGroupRowValues();

	// Show header if page break
	if ($Crosstab2_crosstab->isExport())
		$Crosstab2_crosstab->ShowHeader = ($Crosstab2_crosstab->ExportPageBreakCount == 0) ? FALSE : ($Crosstab2_crosstab->GroupCount % $Crosstab2_crosstab->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Crosstab2_crosstab->ShowHeader)
		$Crosstab2_crosstab->Page_Breaking($Crosstab2_crosstab->ShowHeader, $Crosstab2_crosstab->PageBreakContent);
	$Crosstab2_crosstab->GroupCount++;
} // End while
?>
<?php if ($Crosstab2_crosstab->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php if (($Crosstab2_crosstab->StopGroup - $Crosstab2_crosstab->StartGroup + 1) != $Crosstab2_crosstab->TotalGroups) { ?>
<?php
	$Crosstab2_crosstab->resetAttributes();
	$Crosstab2_crosstab->RowType = ROWTYPE_TOTAL;
	$Crosstab2_crosstab->RowTotalType = ROWTOTAL_PAGE;
	$Crosstab2_crosstab->RowAttrs["class"] = "ew-rpt-page-summary";
	$Crosstab2_crosstab->renderRow();
?>
	<!-- Page Summary -->
	<tr<?php echo $Crosstab2_crosstab->rowAttributes(); ?>>
<?php if ($Crosstab2_crosstab->GroupColumnCount > 0) { ?>
	<td colspan="<?php echo $Crosstab2_crosstab->GroupColumnCount ?>"><?php echo $Crosstab2_crosstab->renderSummaryCaptions("page") ?></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntcol = count($Crosstab2_crosstab->SummaryViewValues);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$colShow = ($iy <= $Crosstab2_crosstab->ColumnCount) ? $Crosstab2_crosstab->Columns[$iy]->Visible : TRUE;
		$colDesc = ($iy <= $Crosstab2_crosstab->ColumnCount) ? $Crosstab2_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
		if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Crosstab2_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Crosstab2_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
	</tr>
<?php } ?>
<?php
	$Crosstab2_crosstab->resetAttributes();
	$Crosstab2_crosstab->RowType = ROWTYPE_TOTAL;
	$Crosstab2_crosstab->RowTotalType = ROWTOTAL_GRAND;
	$Crosstab2_crosstab->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Crosstab2_crosstab->renderRow();
?>
	<!-- Grand Total -->
	<tr<?php echo $Crosstab2_crosstab->rowAttributes(); ?>>
<?php if ($Crosstab2_crosstab->GroupColumnCount > 0) { ?>
	<td colspan="<?php echo $Crosstab2_crosstab->GroupColumnCount ?>"><?php echo $Crosstab2_crosstab->renderSummaryCaptions("grand") ?></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntcol = count($Crosstab2_crosstab->SummaryViewValues);
	for ($iy = 1; $iy <= $cntcol; $iy++) {
		$colShow = ($iy <= $Crosstab2_crosstab->ColumnCount) ? $Crosstab2_crosstab->Columns[$iy]->Visible : TRUE;
		$colDesc = ($iy <= $Crosstab2_crosstab->ColumnCount) ? $Crosstab2_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
		if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Crosstab2_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Crosstab2_crosstab->renderSummaryFields($iy-1) ?></td>
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
<?php if ($Crosstab2_crosstab->TotalGroups > 0) { ?>
<?php if (!$Crosstab2_crosstab->isExport() && !($Crosstab2_crosstab->DrillDown && $Crosstab2_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Crosstab2_crosstab->Pager->render() ?>
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
<?php if ((!$Crosstab2_crosstab->isExport() || $Crosstab2_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Crosstab2_crosstab->isExport() || $Crosstab2_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Crosstab2_crosstab->isExport() || $Crosstab2_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Crosstab2_crosstab->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Crosstab2_crosstab->isExport() && !$Crosstab2_crosstab->DrillDown && !$DashboardReport) { ?>
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
$Crosstab2_crosstab->terminate();
?>