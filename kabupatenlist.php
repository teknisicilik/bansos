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
$kabupaten_list = new kabupaten_list();

// Run the page
$kabupaten_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kabupaten_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kabupaten_list->isExport()) { ?>
<script>
var fkabupatenlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fkabupatenlist = currentForm = new ew.Form("fkabupatenlist", "list");
	fkabupatenlist.formKeyCountName = '<?php echo $kabupaten_list->FormKeyCountName ?>';
	loadjs.done("fkabupatenlist");
});
var fkabupatenlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fkabupatenlistsrch = currentSearchForm = new ew.Form("fkabupatenlistsrch");

	// Validate function for search
	fkabupatenlistsrch.validate = function(fobj) {
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
	fkabupatenlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkabupatenlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fkabupatenlistsrch.lists["x_provinsi_id"] = <?php echo $kabupaten_list->provinsi_id->Lookup->toClientList($kabupaten_list) ?>;
	fkabupatenlistsrch.lists["x_provinsi_id"].options = <?php echo JsonEncode($kabupaten_list->provinsi_id->lookupOptions()) ?>;

	// Filters
	fkabupatenlistsrch.filterList = <?php echo $kabupaten_list->getFilterList() ?>;

	// Init search panel as collapsed
	fkabupatenlistsrch.initSearchPanel = true;
	loadjs.done("fkabupatenlistsrch");
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
<?php if (!$kabupaten_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($kabupaten_list->TotalRecords > 0 && $kabupaten_list->ExportOptions->visible()) { ?>
<?php $kabupaten_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($kabupaten_list->ImportOptions->visible()) { ?>
<?php $kabupaten_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($kabupaten_list->SearchOptions->visible()) { ?>
<?php $kabupaten_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($kabupaten_list->FilterOptions->visible()) { ?>
<?php $kabupaten_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$kabupaten_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$kabupaten_list->isExport() && !$kabupaten->CurrentAction) { ?>
<form name="fkabupatenlistsrch" id="fkabupatenlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fkabupatenlistsrch-search-panel" class="<?php echo $kabupaten_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="kabupaten">
	<div class="ew-extended-search">
<?php

// Render search row
$kabupaten->RowType = ROWTYPE_SEARCH;
$kabupaten->resetAttributes();
$kabupaten_list->renderRow();
?>
<?php if ($kabupaten_list->provinsi_id->Visible) { // provinsi_id ?>
	<?php
		$kabupaten_list->SearchColumnCount++;
		if (($kabupaten_list->SearchColumnCount - 1) % $kabupaten_list->SearchFieldsPerRow == 0) {
			$kabupaten_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $kabupaten_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_provinsi_id" class="ew-cell form-group">
		<label for="x_provinsi_id" class="ew-search-caption ew-label"><?php echo $kabupaten_list->provinsi_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_provinsi_id" id="z_provinsi_id" value="=">
</span>
		<span id="el_kabupaten_provinsi_id" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_provinsi_id"><?php echo EmptyValue(strval($kabupaten_list->provinsi_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $kabupaten_list->provinsi_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($kabupaten_list->provinsi_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($kabupaten_list->provinsi_id->ReadOnly || $kabupaten_list->provinsi_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_provinsi_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $kabupaten_list->provinsi_id->Lookup->getParamTag($kabupaten_list, "p_x_provinsi_id") ?>
<input type="hidden" data-table="kabupaten" data-field="x_provinsi_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $kabupaten_list->provinsi_id->displayValueSeparatorAttribute() ?>" name="x_provinsi_id" id="x_provinsi_id" value="<?php echo $kabupaten_list->provinsi_id->AdvancedSearch->SearchValue ?>"<?php echo $kabupaten_list->provinsi_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($kabupaten_list->SearchColumnCount % $kabupaten_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($kabupaten_list->SearchColumnCount % $kabupaten_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $kabupaten_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($kabupaten_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($kabupaten_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $kabupaten_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($kabupaten_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($kabupaten_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($kabupaten_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($kabupaten_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $kabupaten_list->showPageHeader(); ?>
<?php
$kabupaten_list->showMessage();
?>
<?php if ($kabupaten_list->TotalRecords > 0 || $kabupaten->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($kabupaten_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kabupaten">
<?php if (!$kabupaten_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$kabupaten_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kabupaten_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kabupaten_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fkabupatenlist" id="fkabupatenlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kabupaten">
<div id="gmp_kabupaten" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($kabupaten_list->TotalRecords > 0 || $kabupaten_list->isGridEdit()) { ?>
<table id="tbl_kabupatenlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$kabupaten->RowType = ROWTYPE_HEADER;

// Render list options
$kabupaten_list->renderListOptions();

// Render list options (header, left)
$kabupaten_list->ListOptions->render("header", "left");
?>
<?php if ($kabupaten_list->provinsi_id->Visible) { // provinsi_id ?>
	<?php if ($kabupaten_list->SortUrl($kabupaten_list->provinsi_id) == "") { ?>
		<th data-name="provinsi_id" class="<?php echo $kabupaten_list->provinsi_id->headerCellClass() ?>"><div id="elh_kabupaten_provinsi_id" class="kabupaten_provinsi_id"><div class="ew-table-header-caption"><?php echo $kabupaten_list->provinsi_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="provinsi_id" class="<?php echo $kabupaten_list->provinsi_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kabupaten_list->SortUrl($kabupaten_list->provinsi_id) ?>', 1);"><div id="elh_kabupaten_provinsi_id" class="kabupaten_provinsi_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kabupaten_list->provinsi_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($kabupaten_list->provinsi_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kabupaten_list->provinsi_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kabupaten_list->nama->Visible) { // nama ?>
	<?php if ($kabupaten_list->SortUrl($kabupaten_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $kabupaten_list->nama->headerCellClass() ?>"><div id="elh_kabupaten_nama" class="kabupaten_nama"><div class="ew-table-header-caption"><?php echo $kabupaten_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $kabupaten_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kabupaten_list->SortUrl($kabupaten_list->nama) ?>', 1);"><div id="elh_kabupaten_nama" class="kabupaten_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kabupaten_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kabupaten_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kabupaten_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$kabupaten_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($kabupaten_list->ExportAll && $kabupaten_list->isExport()) {
	$kabupaten_list->StopRecord = $kabupaten_list->TotalRecords;
} else {

	// Set the last record to display
	if ($kabupaten_list->TotalRecords > $kabupaten_list->StartRecord + $kabupaten_list->DisplayRecords - 1)
		$kabupaten_list->StopRecord = $kabupaten_list->StartRecord + $kabupaten_list->DisplayRecords - 1;
	else
		$kabupaten_list->StopRecord = $kabupaten_list->TotalRecords;
}
$kabupaten_list->RecordCount = $kabupaten_list->StartRecord - 1;
if ($kabupaten_list->Recordset && !$kabupaten_list->Recordset->EOF) {
	$kabupaten_list->Recordset->moveFirst();
	$selectLimit = $kabupaten_list->UseSelectLimit;
	if (!$selectLimit && $kabupaten_list->StartRecord > 1)
		$kabupaten_list->Recordset->move($kabupaten_list->StartRecord - 1);
} elseif (!$kabupaten->AllowAddDeleteRow && $kabupaten_list->StopRecord == 0) {
	$kabupaten_list->StopRecord = $kabupaten->GridAddRowCount;
}

// Initialize aggregate
$kabupaten->RowType = ROWTYPE_AGGREGATEINIT;
$kabupaten->resetAttributes();
$kabupaten_list->renderRow();
while ($kabupaten_list->RecordCount < $kabupaten_list->StopRecord) {
	$kabupaten_list->RecordCount++;
	if ($kabupaten_list->RecordCount >= $kabupaten_list->StartRecord) {
		$kabupaten_list->RowCount++;

		// Set up key count
		$kabupaten_list->KeyCount = $kabupaten_list->RowIndex;

		// Init row class and style
		$kabupaten->resetAttributes();
		$kabupaten->CssClass = "";
		if ($kabupaten_list->isGridAdd()) {
		} else {
			$kabupaten_list->loadRowValues($kabupaten_list->Recordset); // Load row values
		}
		$kabupaten->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$kabupaten->RowAttrs->merge(["data-rowindex" => $kabupaten_list->RowCount, "id" => "r" . $kabupaten_list->RowCount . "_kabupaten", "data-rowtype" => $kabupaten->RowType]);

		// Render row
		$kabupaten_list->renderRow();

		// Render list options
		$kabupaten_list->renderListOptions();
?>
	<tr <?php echo $kabupaten->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kabupaten_list->ListOptions->render("body", "left", $kabupaten_list->RowCount);
?>
	<?php if ($kabupaten_list->provinsi_id->Visible) { // provinsi_id ?>
		<td data-name="provinsi_id" <?php echo $kabupaten_list->provinsi_id->cellAttributes() ?>>
<span id="el<?php echo $kabupaten_list->RowCount ?>_kabupaten_provinsi_id">
<span<?php echo $kabupaten_list->provinsi_id->viewAttributes() ?>><?php echo $kabupaten_list->provinsi_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kabupaten_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $kabupaten_list->nama->cellAttributes() ?>>
<span id="el<?php echo $kabupaten_list->RowCount ?>_kabupaten_nama">
<span<?php echo $kabupaten_list->nama->viewAttributes() ?>><?php echo $kabupaten_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$kabupaten_list->ListOptions->render("body", "right", $kabupaten_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$kabupaten_list->isGridAdd())
		$kabupaten_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$kabupaten->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($kabupaten_list->Recordset)
	$kabupaten_list->Recordset->Close();
?>
<?php if (!$kabupaten_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$kabupaten_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kabupaten_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kabupaten_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($kabupaten_list->TotalRecords == 0 && !$kabupaten->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $kabupaten_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$kabupaten_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kabupaten_list->isExport()) { ?>
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
$kabupaten_list->terminate();
?>