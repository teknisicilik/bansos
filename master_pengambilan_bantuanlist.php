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
$master_pengambilan_bantuan_list = new master_pengambilan_bantuan_list();

// Run the page
$master_pengambilan_bantuan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_pengambilan_bantuan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$master_pengambilan_bantuan_list->isExport()) { ?>
<script>
var fmaster_pengambilan_bantuanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmaster_pengambilan_bantuanlist = currentForm = new ew.Form("fmaster_pengambilan_bantuanlist", "list");
	fmaster_pengambilan_bantuanlist.formKeyCountName = '<?php echo $master_pengambilan_bantuan_list->FormKeyCountName ?>';
	loadjs.done("fmaster_pengambilan_bantuanlist");
});
var fmaster_pengambilan_bantuanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmaster_pengambilan_bantuanlistsrch = currentSearchForm = new ew.Form("fmaster_pengambilan_bantuanlistsrch");

	// Dynamic selection lists
	// Filters

	fmaster_pengambilan_bantuanlistsrch.filterList = <?php echo $master_pengambilan_bantuan_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmaster_pengambilan_bantuanlistsrch.initSearchPanel = true;
	loadjs.done("fmaster_pengambilan_bantuanlistsrch");
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
<?php if (!$master_pengambilan_bantuan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($master_pengambilan_bantuan_list->TotalRecords > 0 && $master_pengambilan_bantuan_list->ExportOptions->visible()) { ?>
<?php $master_pengambilan_bantuan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($master_pengambilan_bantuan_list->ImportOptions->visible()) { ?>
<?php $master_pengambilan_bantuan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($master_pengambilan_bantuan_list->SearchOptions->visible()) { ?>
<?php $master_pengambilan_bantuan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($master_pengambilan_bantuan_list->FilterOptions->visible()) { ?>
<?php $master_pengambilan_bantuan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$master_pengambilan_bantuan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$master_pengambilan_bantuan_list->isExport() && !$master_pengambilan_bantuan->CurrentAction) { ?>
<form name="fmaster_pengambilan_bantuanlistsrch" id="fmaster_pengambilan_bantuanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmaster_pengambilan_bantuanlistsrch-search-panel" class="<?php echo $master_pengambilan_bantuan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="master_pengambilan_bantuan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $master_pengambilan_bantuan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($master_pengambilan_bantuan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($master_pengambilan_bantuan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $master_pengambilan_bantuan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($master_pengambilan_bantuan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($master_pengambilan_bantuan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($master_pengambilan_bantuan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($master_pengambilan_bantuan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $master_pengambilan_bantuan_list->showPageHeader(); ?>
<?php
$master_pengambilan_bantuan_list->showMessage();
?>
<?php if ($master_pengambilan_bantuan_list->TotalRecords > 0 || $master_pengambilan_bantuan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($master_pengambilan_bantuan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> master_pengambilan_bantuan">
<?php if (!$master_pengambilan_bantuan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$master_pengambilan_bantuan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_pengambilan_bantuan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $master_pengambilan_bantuan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmaster_pengambilan_bantuanlist" id="fmaster_pengambilan_bantuanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_pengambilan_bantuan">
<div id="gmp_master_pengambilan_bantuan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($master_pengambilan_bantuan_list->TotalRecords > 0 || $master_pengambilan_bantuan_list->isGridEdit()) { ?>
<table id="tbl_master_pengambilan_bantuanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$master_pengambilan_bantuan->RowType = ROWTYPE_HEADER;

// Render list options
$master_pengambilan_bantuan_list->renderListOptions();

// Render list options (header, left)
$master_pengambilan_bantuan_list->ListOptions->render("header", "left");
?>
<?php if ($master_pengambilan_bantuan_list->id->Visible) { // id ?>
	<?php if ($master_pengambilan_bantuan_list->SortUrl($master_pengambilan_bantuan_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $master_pengambilan_bantuan_list->id->headerCellClass() ?>"><div id="elh_master_pengambilan_bantuan_id" class="master_pengambilan_bantuan_id"><div class="ew-table-header-caption"><?php echo $master_pengambilan_bantuan_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $master_pengambilan_bantuan_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_pengambilan_bantuan_list->SortUrl($master_pengambilan_bantuan_list->id) ?>', 1);"><div id="elh_master_pengambilan_bantuan_id" class="master_pengambilan_bantuan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_pengambilan_bantuan_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_pengambilan_bantuan_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_pengambilan_bantuan_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_pengambilan_bantuan_list->nama->Visible) { // nama ?>
	<?php if ($master_pengambilan_bantuan_list->SortUrl($master_pengambilan_bantuan_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $master_pengambilan_bantuan_list->nama->headerCellClass() ?>"><div id="elh_master_pengambilan_bantuan_nama" class="master_pengambilan_bantuan_nama"><div class="ew-table-header-caption"><?php echo $master_pengambilan_bantuan_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $master_pengambilan_bantuan_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_pengambilan_bantuan_list->SortUrl($master_pengambilan_bantuan_list->nama) ?>', 1);"><div id="elh_master_pengambilan_bantuan_nama" class="master_pengambilan_bantuan_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_pengambilan_bantuan_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($master_pengambilan_bantuan_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_pengambilan_bantuan_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_pengambilan_bantuan_list->na->Visible) { // na ?>
	<?php if ($master_pengambilan_bantuan_list->SortUrl($master_pengambilan_bantuan_list->na) == "") { ?>
		<th data-name="na" class="<?php echo $master_pengambilan_bantuan_list->na->headerCellClass() ?>"><div id="elh_master_pengambilan_bantuan_na" class="master_pengambilan_bantuan_na"><div class="ew-table-header-caption"><?php echo $master_pengambilan_bantuan_list->na->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="na" class="<?php echo $master_pengambilan_bantuan_list->na->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_pengambilan_bantuan_list->SortUrl($master_pengambilan_bantuan_list->na) ?>', 1);"><div id="elh_master_pengambilan_bantuan_na" class="master_pengambilan_bantuan_na">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_pengambilan_bantuan_list->na->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_pengambilan_bantuan_list->na->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_pengambilan_bantuan_list->na->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$master_pengambilan_bantuan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($master_pengambilan_bantuan_list->ExportAll && $master_pengambilan_bantuan_list->isExport()) {
	$master_pengambilan_bantuan_list->StopRecord = $master_pengambilan_bantuan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($master_pengambilan_bantuan_list->TotalRecords > $master_pengambilan_bantuan_list->StartRecord + $master_pengambilan_bantuan_list->DisplayRecords - 1)
		$master_pengambilan_bantuan_list->StopRecord = $master_pengambilan_bantuan_list->StartRecord + $master_pengambilan_bantuan_list->DisplayRecords - 1;
	else
		$master_pengambilan_bantuan_list->StopRecord = $master_pengambilan_bantuan_list->TotalRecords;
}
$master_pengambilan_bantuan_list->RecordCount = $master_pengambilan_bantuan_list->StartRecord - 1;
if ($master_pengambilan_bantuan_list->Recordset && !$master_pengambilan_bantuan_list->Recordset->EOF) {
	$master_pengambilan_bantuan_list->Recordset->moveFirst();
	$selectLimit = $master_pengambilan_bantuan_list->UseSelectLimit;
	if (!$selectLimit && $master_pengambilan_bantuan_list->StartRecord > 1)
		$master_pengambilan_bantuan_list->Recordset->move($master_pengambilan_bantuan_list->StartRecord - 1);
} elseif (!$master_pengambilan_bantuan->AllowAddDeleteRow && $master_pengambilan_bantuan_list->StopRecord == 0) {
	$master_pengambilan_bantuan_list->StopRecord = $master_pengambilan_bantuan->GridAddRowCount;
}

// Initialize aggregate
$master_pengambilan_bantuan->RowType = ROWTYPE_AGGREGATEINIT;
$master_pengambilan_bantuan->resetAttributes();
$master_pengambilan_bantuan_list->renderRow();
while ($master_pengambilan_bantuan_list->RecordCount < $master_pengambilan_bantuan_list->StopRecord) {
	$master_pengambilan_bantuan_list->RecordCount++;
	if ($master_pengambilan_bantuan_list->RecordCount >= $master_pengambilan_bantuan_list->StartRecord) {
		$master_pengambilan_bantuan_list->RowCount++;

		// Set up key count
		$master_pengambilan_bantuan_list->KeyCount = $master_pengambilan_bantuan_list->RowIndex;

		// Init row class and style
		$master_pengambilan_bantuan->resetAttributes();
		$master_pengambilan_bantuan->CssClass = "";
		if ($master_pengambilan_bantuan_list->isGridAdd()) {
		} else {
			$master_pengambilan_bantuan_list->loadRowValues($master_pengambilan_bantuan_list->Recordset); // Load row values
		}
		$master_pengambilan_bantuan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$master_pengambilan_bantuan->RowAttrs->merge(["data-rowindex" => $master_pengambilan_bantuan_list->RowCount, "id" => "r" . $master_pengambilan_bantuan_list->RowCount . "_master_pengambilan_bantuan", "data-rowtype" => $master_pengambilan_bantuan->RowType]);

		// Render row
		$master_pengambilan_bantuan_list->renderRow();

		// Render list options
		$master_pengambilan_bantuan_list->renderListOptions();
?>
	<tr <?php echo $master_pengambilan_bantuan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$master_pengambilan_bantuan_list->ListOptions->render("body", "left", $master_pengambilan_bantuan_list->RowCount);
?>
	<?php if ($master_pengambilan_bantuan_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $master_pengambilan_bantuan_list->id->cellAttributes() ?>>
<span id="el<?php echo $master_pengambilan_bantuan_list->RowCount ?>_master_pengambilan_bantuan_id">
<span<?php echo $master_pengambilan_bantuan_list->id->viewAttributes() ?>><?php echo $master_pengambilan_bantuan_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_pengambilan_bantuan_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $master_pengambilan_bantuan_list->nama->cellAttributes() ?>>
<span id="el<?php echo $master_pengambilan_bantuan_list->RowCount ?>_master_pengambilan_bantuan_nama">
<span<?php echo $master_pengambilan_bantuan_list->nama->viewAttributes() ?>><?php echo $master_pengambilan_bantuan_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_pengambilan_bantuan_list->na->Visible) { // na ?>
		<td data-name="na" <?php echo $master_pengambilan_bantuan_list->na->cellAttributes() ?>>
<span id="el<?php echo $master_pengambilan_bantuan_list->RowCount ?>_master_pengambilan_bantuan_na">
<span<?php echo $master_pengambilan_bantuan_list->na->viewAttributes() ?>><?php echo $master_pengambilan_bantuan_list->na->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$master_pengambilan_bantuan_list->ListOptions->render("body", "right", $master_pengambilan_bantuan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$master_pengambilan_bantuan_list->isGridAdd())
		$master_pengambilan_bantuan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$master_pengambilan_bantuan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($master_pengambilan_bantuan_list->Recordset)
	$master_pengambilan_bantuan_list->Recordset->Close();
?>
<?php if (!$master_pengambilan_bantuan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$master_pengambilan_bantuan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_pengambilan_bantuan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $master_pengambilan_bantuan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($master_pengambilan_bantuan_list->TotalRecords == 0 && !$master_pengambilan_bantuan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $master_pengambilan_bantuan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$master_pengambilan_bantuan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$master_pengambilan_bantuan_list->isExport()) { ?>
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
$master_pengambilan_bantuan_list->terminate();
?>