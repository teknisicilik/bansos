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
$provinsi_list = new provinsi_list();

// Run the page
$provinsi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$provinsi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$provinsi_list->isExport()) { ?>
<script>
var fprovinsilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprovinsilist = currentForm = new ew.Form("fprovinsilist", "list");
	fprovinsilist.formKeyCountName = '<?php echo $provinsi_list->FormKeyCountName ?>';
	loadjs.done("fprovinsilist");
});
var fprovinsilistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprovinsilistsrch = currentSearchForm = new ew.Form("fprovinsilistsrch");

	// Dynamic selection lists
	// Filters

	fprovinsilistsrch.filterList = <?php echo $provinsi_list->getFilterList() ?>;

	// Init search panel as collapsed
	fprovinsilistsrch.initSearchPanel = true;
	loadjs.done("fprovinsilistsrch");
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
<?php if (!$provinsi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($provinsi_list->TotalRecords > 0 && $provinsi_list->ExportOptions->visible()) { ?>
<?php $provinsi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($provinsi_list->ImportOptions->visible()) { ?>
<?php $provinsi_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($provinsi_list->SearchOptions->visible()) { ?>
<?php $provinsi_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($provinsi_list->FilterOptions->visible()) { ?>
<?php $provinsi_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$provinsi_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$provinsi_list->isExport() && !$provinsi->CurrentAction) { ?>
<form name="fprovinsilistsrch" id="fprovinsilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprovinsilistsrch-search-panel" class="<?php echo $provinsi_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="provinsi">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $provinsi_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($provinsi_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($provinsi_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $provinsi_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($provinsi_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($provinsi_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($provinsi_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($provinsi_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $provinsi_list->showPageHeader(); ?>
<?php
$provinsi_list->showMessage();
?>
<?php if ($provinsi_list->TotalRecords > 0 || $provinsi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($provinsi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> provinsi">
<?php if (!$provinsi_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$provinsi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $provinsi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $provinsi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprovinsilist" id="fprovinsilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="provinsi">
<div id="gmp_provinsi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($provinsi_list->TotalRecords > 0 || $provinsi_list->isGridEdit()) { ?>
<table id="tbl_provinsilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$provinsi->RowType = ROWTYPE_HEADER;

// Render list options
$provinsi_list->renderListOptions();

// Render list options (header, left)
$provinsi_list->ListOptions->render("header", "left");
?>
<?php if ($provinsi_list->nama->Visible) { // nama ?>
	<?php if ($provinsi_list->SortUrl($provinsi_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $provinsi_list->nama->headerCellClass() ?>"><div id="elh_provinsi_nama" class="provinsi_nama"><div class="ew-table-header-caption"><?php echo $provinsi_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $provinsi_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $provinsi_list->SortUrl($provinsi_list->nama) ?>', 1);"><div id="elh_provinsi_nama" class="provinsi_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $provinsi_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($provinsi_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($provinsi_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$provinsi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($provinsi_list->ExportAll && $provinsi_list->isExport()) {
	$provinsi_list->StopRecord = $provinsi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($provinsi_list->TotalRecords > $provinsi_list->StartRecord + $provinsi_list->DisplayRecords - 1)
		$provinsi_list->StopRecord = $provinsi_list->StartRecord + $provinsi_list->DisplayRecords - 1;
	else
		$provinsi_list->StopRecord = $provinsi_list->TotalRecords;
}
$provinsi_list->RecordCount = $provinsi_list->StartRecord - 1;
if ($provinsi_list->Recordset && !$provinsi_list->Recordset->EOF) {
	$provinsi_list->Recordset->moveFirst();
	$selectLimit = $provinsi_list->UseSelectLimit;
	if (!$selectLimit && $provinsi_list->StartRecord > 1)
		$provinsi_list->Recordset->move($provinsi_list->StartRecord - 1);
} elseif (!$provinsi->AllowAddDeleteRow && $provinsi_list->StopRecord == 0) {
	$provinsi_list->StopRecord = $provinsi->GridAddRowCount;
}

// Initialize aggregate
$provinsi->RowType = ROWTYPE_AGGREGATEINIT;
$provinsi->resetAttributes();
$provinsi_list->renderRow();
while ($provinsi_list->RecordCount < $provinsi_list->StopRecord) {
	$provinsi_list->RecordCount++;
	if ($provinsi_list->RecordCount >= $provinsi_list->StartRecord) {
		$provinsi_list->RowCount++;

		// Set up key count
		$provinsi_list->KeyCount = $provinsi_list->RowIndex;

		// Init row class and style
		$provinsi->resetAttributes();
		$provinsi->CssClass = "";
		if ($provinsi_list->isGridAdd()) {
		} else {
			$provinsi_list->loadRowValues($provinsi_list->Recordset); // Load row values
		}
		$provinsi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$provinsi->RowAttrs->merge(["data-rowindex" => $provinsi_list->RowCount, "id" => "r" . $provinsi_list->RowCount . "_provinsi", "data-rowtype" => $provinsi->RowType]);

		// Render row
		$provinsi_list->renderRow();

		// Render list options
		$provinsi_list->renderListOptions();
?>
	<tr <?php echo $provinsi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$provinsi_list->ListOptions->render("body", "left", $provinsi_list->RowCount);
?>
	<?php if ($provinsi_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $provinsi_list->nama->cellAttributes() ?>>
<span id="el<?php echo $provinsi_list->RowCount ?>_provinsi_nama">
<span<?php echo $provinsi_list->nama->viewAttributes() ?>><?php echo $provinsi_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$provinsi_list->ListOptions->render("body", "right", $provinsi_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$provinsi_list->isGridAdd())
		$provinsi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$provinsi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($provinsi_list->Recordset)
	$provinsi_list->Recordset->Close();
?>
<?php if (!$provinsi_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$provinsi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $provinsi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $provinsi_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($provinsi_list->TotalRecords == 0 && !$provinsi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $provinsi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$provinsi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$provinsi_list->isExport()) { ?>
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
$provinsi_list->terminate();
?>