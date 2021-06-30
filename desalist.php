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
$desa_list = new desa_list();

// Run the page
$desa_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$desa_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$desa_list->isExport()) { ?>
<script>
var fdesalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdesalist = currentForm = new ew.Form("fdesalist", "list");
	fdesalist.formKeyCountName = '<?php echo $desa_list->FormKeyCountName ?>';
	loadjs.done("fdesalist");
});
var fdesalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdesalistsrch = currentSearchForm = new ew.Form("fdesalistsrch");

	// Validate function for search
	fdesalistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdesalistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdesalistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdesalistsrch.lists["x_kecamatan_id"] = <?php echo $desa_list->kecamatan_id->Lookup->toClientList($desa_list) ?>;
	fdesalistsrch.lists["x_kecamatan_id"].options = <?php echo JsonEncode($desa_list->kecamatan_id->lookupOptions()) ?>;

	// Filters
	fdesalistsrch.filterList = <?php echo $desa_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdesalistsrch.initSearchPanel = true;
	loadjs.done("fdesalistsrch");
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
<?php if (!$desa_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($desa_list->TotalRecords > 0 && $desa_list->ExportOptions->visible()) { ?>
<?php $desa_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($desa_list->ImportOptions->visible()) { ?>
<?php $desa_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($desa_list->SearchOptions->visible()) { ?>
<?php $desa_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($desa_list->FilterOptions->visible()) { ?>
<?php $desa_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$desa_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$desa_list->isExport() && !$desa->CurrentAction) { ?>
<form name="fdesalistsrch" id="fdesalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdesalistsrch-search-panel" class="<?php echo $desa_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="desa">
	<div class="ew-extended-search">
<?php

// Render search row
$desa->RowType = ROWTYPE_SEARCH;
$desa->resetAttributes();
$desa_list->renderRow();
?>
<?php if ($desa_list->kecamatan_id->Visible) { // kecamatan_id ?>
	<?php
		$desa_list->SearchColumnCount++;
		if (($desa_list->SearchColumnCount - 1) % $desa_list->SearchFieldsPerRow == 0) {
			$desa_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $desa_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_kecamatan_id" class="ew-cell form-group">
		<label for="x_kecamatan_id" class="ew-search-caption ew-label"><?php echo $desa_list->kecamatan_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kecamatan_id" id="z_kecamatan_id" value="=">
</span>
		<span id="el_desa_kecamatan_id" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_kecamatan_id"><?php echo EmptyValue(strval($desa_list->kecamatan_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $desa_list->kecamatan_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($desa_list->kecamatan_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($desa_list->kecamatan_id->ReadOnly || $desa_list->kecamatan_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_kecamatan_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $desa_list->kecamatan_id->Lookup->getParamTag($desa_list, "p_x_kecamatan_id") ?>
<input type="hidden" data-table="desa" data-field="x_kecamatan_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $desa_list->kecamatan_id->displayValueSeparatorAttribute() ?>" name="x_kecamatan_id" id="x_kecamatan_id" value="<?php echo $desa_list->kecamatan_id->AdvancedSearch->SearchValue ?>"<?php echo $desa_list->kecamatan_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($desa_list->SearchColumnCount % $desa_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($desa_list->SearchColumnCount % $desa_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $desa_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($desa_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($desa_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $desa_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($desa_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($desa_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($desa_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($desa_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $desa_list->showPageHeader(); ?>
<?php
$desa_list->showMessage();
?>
<?php if ($desa_list->TotalRecords > 0 || $desa->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($desa_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> desa">
<?php if (!$desa_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$desa_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $desa_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $desa_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdesalist" id="fdesalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="desa">
<div id="gmp_desa" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($desa_list->TotalRecords > 0 || $desa_list->isGridEdit()) { ?>
<table id="tbl_desalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$desa->RowType = ROWTYPE_HEADER;

// Render list options
$desa_list->renderListOptions();

// Render list options (header, left)
$desa_list->ListOptions->render("header", "left");
?>
<?php if ($desa_list->kecamatan_id->Visible) { // kecamatan_id ?>
	<?php if ($desa_list->SortUrl($desa_list->kecamatan_id) == "") { ?>
		<th data-name="kecamatan_id" class="<?php echo $desa_list->kecamatan_id->headerCellClass() ?>"><div id="elh_desa_kecamatan_id" class="desa_kecamatan_id"><div class="ew-table-header-caption"><?php echo $desa_list->kecamatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kecamatan_id" class="<?php echo $desa_list->kecamatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $desa_list->SortUrl($desa_list->kecamatan_id) ?>', 1);"><div id="elh_desa_kecamatan_id" class="desa_kecamatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $desa_list->kecamatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($desa_list->kecamatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($desa_list->kecamatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($desa_list->nama->Visible) { // nama ?>
	<?php if ($desa_list->SortUrl($desa_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $desa_list->nama->headerCellClass() ?>"><div id="elh_desa_nama" class="desa_nama"><div class="ew-table-header-caption"><?php echo $desa_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $desa_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $desa_list->SortUrl($desa_list->nama) ?>', 1);"><div id="elh_desa_nama" class="desa_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $desa_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($desa_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($desa_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($desa_list->kodepos->Visible) { // kodepos ?>
	<?php if ($desa_list->SortUrl($desa_list->kodepos) == "") { ?>
		<th data-name="kodepos" class="<?php echo $desa_list->kodepos->headerCellClass() ?>"><div id="elh_desa_kodepos" class="desa_kodepos"><div class="ew-table-header-caption"><?php echo $desa_list->kodepos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kodepos" class="<?php echo $desa_list->kodepos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $desa_list->SortUrl($desa_list->kodepos) ?>', 1);"><div id="elh_desa_kodepos" class="desa_kodepos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $desa_list->kodepos->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($desa_list->kodepos->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($desa_list->kodepos->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$desa_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($desa_list->ExportAll && $desa_list->isExport()) {
	$desa_list->StopRecord = $desa_list->TotalRecords;
} else {

	// Set the last record to display
	if ($desa_list->TotalRecords > $desa_list->StartRecord + $desa_list->DisplayRecords - 1)
		$desa_list->StopRecord = $desa_list->StartRecord + $desa_list->DisplayRecords - 1;
	else
		$desa_list->StopRecord = $desa_list->TotalRecords;
}
$desa_list->RecordCount = $desa_list->StartRecord - 1;
if ($desa_list->Recordset && !$desa_list->Recordset->EOF) {
	$desa_list->Recordset->moveFirst();
	$selectLimit = $desa_list->UseSelectLimit;
	if (!$selectLimit && $desa_list->StartRecord > 1)
		$desa_list->Recordset->move($desa_list->StartRecord - 1);
} elseif (!$desa->AllowAddDeleteRow && $desa_list->StopRecord == 0) {
	$desa_list->StopRecord = $desa->GridAddRowCount;
}

// Initialize aggregate
$desa->RowType = ROWTYPE_AGGREGATEINIT;
$desa->resetAttributes();
$desa_list->renderRow();
while ($desa_list->RecordCount < $desa_list->StopRecord) {
	$desa_list->RecordCount++;
	if ($desa_list->RecordCount >= $desa_list->StartRecord) {
		$desa_list->RowCount++;

		// Set up key count
		$desa_list->KeyCount = $desa_list->RowIndex;

		// Init row class and style
		$desa->resetAttributes();
		$desa->CssClass = "";
		if ($desa_list->isGridAdd()) {
		} else {
			$desa_list->loadRowValues($desa_list->Recordset); // Load row values
		}
		$desa->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$desa->RowAttrs->merge(["data-rowindex" => $desa_list->RowCount, "id" => "r" . $desa_list->RowCount . "_desa", "data-rowtype" => $desa->RowType]);

		// Render row
		$desa_list->renderRow();

		// Render list options
		$desa_list->renderListOptions();
?>
	<tr <?php echo $desa->rowAttributes() ?>>
<?php

// Render list options (body, left)
$desa_list->ListOptions->render("body", "left", $desa_list->RowCount);
?>
	<?php if ($desa_list->kecamatan_id->Visible) { // kecamatan_id ?>
		<td data-name="kecamatan_id" <?php echo $desa_list->kecamatan_id->cellAttributes() ?>>
<span id="el<?php echo $desa_list->RowCount ?>_desa_kecamatan_id">
<span<?php echo $desa_list->kecamatan_id->viewAttributes() ?>><?php echo $desa_list->kecamatan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($desa_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $desa_list->nama->cellAttributes() ?>>
<span id="el<?php echo $desa_list->RowCount ?>_desa_nama">
<span<?php echo $desa_list->nama->viewAttributes() ?>><?php echo $desa_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($desa_list->kodepos->Visible) { // kodepos ?>
		<td data-name="kodepos" <?php echo $desa_list->kodepos->cellAttributes() ?>>
<span id="el<?php echo $desa_list->RowCount ?>_desa_kodepos">
<span<?php echo $desa_list->kodepos->viewAttributes() ?>><?php echo $desa_list->kodepos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$desa_list->ListOptions->render("body", "right", $desa_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$desa_list->isGridAdd())
		$desa_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$desa->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($desa_list->Recordset)
	$desa_list->Recordset->Close();
?>
<?php if (!$desa_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$desa_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $desa_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $desa_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($desa_list->TotalRecords == 0 && !$desa->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $desa_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$desa_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$desa_list->isExport()) { ?>
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
$desa_list->terminate();
?>