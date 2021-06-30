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
$master_status_warga_list = new master_status_warga_list();

// Run the page
$master_status_warga_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$master_status_warga_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$master_status_warga_list->isExport()) { ?>
<script>
var fmaster_status_wargalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmaster_status_wargalist = currentForm = new ew.Form("fmaster_status_wargalist", "list");
	fmaster_status_wargalist.formKeyCountName = '<?php echo $master_status_warga_list->FormKeyCountName ?>';
	loadjs.done("fmaster_status_wargalist");
});
var fmaster_status_wargalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmaster_status_wargalistsrch = currentSearchForm = new ew.Form("fmaster_status_wargalistsrch");

	// Validate function for search
	fmaster_status_wargalistsrch.validate = function(fobj) {
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
	fmaster_status_wargalistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaster_status_wargalistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmaster_status_wargalistsrch.lists["x_na"] = <?php echo $master_status_warga_list->na->Lookup->toClientList($master_status_warga_list) ?>;
	fmaster_status_wargalistsrch.lists["x_na"].options = <?php echo JsonEncode($master_status_warga_list->na->options(FALSE, TRUE)) ?>;

	// Filters
	fmaster_status_wargalistsrch.filterList = <?php echo $master_status_warga_list->getFilterList() ?>;
	loadjs.done("fmaster_status_wargalistsrch");
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
<?php if (!$master_status_warga_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($master_status_warga_list->TotalRecords > 0 && $master_status_warga_list->ExportOptions->visible()) { ?>
<?php $master_status_warga_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($master_status_warga_list->ImportOptions->visible()) { ?>
<?php $master_status_warga_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($master_status_warga_list->SearchOptions->visible()) { ?>
<?php $master_status_warga_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($master_status_warga_list->FilterOptions->visible()) { ?>
<?php $master_status_warga_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$master_status_warga_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$master_status_warga_list->isExport() && !$master_status_warga->CurrentAction) { ?>
<form name="fmaster_status_wargalistsrch" id="fmaster_status_wargalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmaster_status_wargalistsrch-search-panel" class="<?php echo $master_status_warga_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="master_status_warga">
	<div class="ew-extended-search">
<?php

// Render search row
$master_status_warga->RowType = ROWTYPE_SEARCH;
$master_status_warga->resetAttributes();
$master_status_warga_list->renderRow();
?>
<?php if ($master_status_warga_list->na->Visible) { // na ?>
	<?php
		$master_status_warga_list->SearchColumnCount++;
		if (($master_status_warga_list->SearchColumnCount - 1) % $master_status_warga_list->SearchFieldsPerRow == 0) {
			$master_status_warga_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $master_status_warga_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_na" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $master_status_warga_list->na->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_na" id="z_na" value="=">
</span>
		<span id="el_master_status_warga_na" class="ew-search-field">
<div id="tp_x_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="master_status_warga" data-field="x_na" data-value-separator="<?php echo $master_status_warga_list->na->displayValueSeparatorAttribute() ?>" name="x_na" id="x_na" value="{value}"<?php echo $master_status_warga_list->na->editAttributes() ?>></div>
<div id="dsl_x_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $master_status_warga_list->na->radioButtonListHtml(FALSE, "x_na") ?>
</div></div>
</span>
	</div>
	<?php if ($master_status_warga_list->SearchColumnCount % $master_status_warga_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($master_status_warga_list->SearchColumnCount % $master_status_warga_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $master_status_warga_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($master_status_warga_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($master_status_warga_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $master_status_warga_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($master_status_warga_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($master_status_warga_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($master_status_warga_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($master_status_warga_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $master_status_warga_list->showPageHeader(); ?>
<?php
$master_status_warga_list->showMessage();
?>
<?php if ($master_status_warga_list->TotalRecords > 0 || $master_status_warga->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($master_status_warga_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> master_status_warga">
<?php if (!$master_status_warga_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$master_status_warga_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_status_warga_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $master_status_warga_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmaster_status_wargalist" id="fmaster_status_wargalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="master_status_warga">
<div id="gmp_master_status_warga" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($master_status_warga_list->TotalRecords > 0 || $master_status_warga_list->isGridEdit()) { ?>
<table id="tbl_master_status_wargalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$master_status_warga->RowType = ROWTYPE_HEADER;

// Render list options
$master_status_warga_list->renderListOptions();

// Render list options (header, left)
$master_status_warga_list->ListOptions->render("header", "left");
?>
<?php if ($master_status_warga_list->id->Visible) { // id ?>
	<?php if ($master_status_warga_list->SortUrl($master_status_warga_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $master_status_warga_list->id->headerCellClass() ?>"><div id="elh_master_status_warga_id" class="master_status_warga_id"><div class="ew-table-header-caption"><?php echo $master_status_warga_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $master_status_warga_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_status_warga_list->SortUrl($master_status_warga_list->id) ?>', 1);"><div id="elh_master_status_warga_id" class="master_status_warga_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_status_warga_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_status_warga_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_status_warga_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_status_warga_list->nama->Visible) { // nama ?>
	<?php if ($master_status_warga_list->SortUrl($master_status_warga_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $master_status_warga_list->nama->headerCellClass() ?>"><div id="elh_master_status_warga_nama" class="master_status_warga_nama"><div class="ew-table-header-caption"><?php echo $master_status_warga_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $master_status_warga_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_status_warga_list->SortUrl($master_status_warga_list->nama) ?>', 1);"><div id="elh_master_status_warga_nama" class="master_status_warga_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_status_warga_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($master_status_warga_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_status_warga_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($master_status_warga_list->na->Visible) { // na ?>
	<?php if ($master_status_warga_list->SortUrl($master_status_warga_list->na) == "") { ?>
		<th data-name="na" class="<?php echo $master_status_warga_list->na->headerCellClass() ?>"><div id="elh_master_status_warga_na" class="master_status_warga_na"><div class="ew-table-header-caption"><?php echo $master_status_warga_list->na->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="na" class="<?php echo $master_status_warga_list->na->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $master_status_warga_list->SortUrl($master_status_warga_list->na) ?>', 1);"><div id="elh_master_status_warga_na" class="master_status_warga_na">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $master_status_warga_list->na->caption() ?></span><span class="ew-table-header-sort"><?php if ($master_status_warga_list->na->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($master_status_warga_list->na->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$master_status_warga_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($master_status_warga_list->ExportAll && $master_status_warga_list->isExport()) {
	$master_status_warga_list->StopRecord = $master_status_warga_list->TotalRecords;
} else {

	// Set the last record to display
	if ($master_status_warga_list->TotalRecords > $master_status_warga_list->StartRecord + $master_status_warga_list->DisplayRecords - 1)
		$master_status_warga_list->StopRecord = $master_status_warga_list->StartRecord + $master_status_warga_list->DisplayRecords - 1;
	else
		$master_status_warga_list->StopRecord = $master_status_warga_list->TotalRecords;
}
$master_status_warga_list->RecordCount = $master_status_warga_list->StartRecord - 1;
if ($master_status_warga_list->Recordset && !$master_status_warga_list->Recordset->EOF) {
	$master_status_warga_list->Recordset->moveFirst();
	$selectLimit = $master_status_warga_list->UseSelectLimit;
	if (!$selectLimit && $master_status_warga_list->StartRecord > 1)
		$master_status_warga_list->Recordset->move($master_status_warga_list->StartRecord - 1);
} elseif (!$master_status_warga->AllowAddDeleteRow && $master_status_warga_list->StopRecord == 0) {
	$master_status_warga_list->StopRecord = $master_status_warga->GridAddRowCount;
}

// Initialize aggregate
$master_status_warga->RowType = ROWTYPE_AGGREGATEINIT;
$master_status_warga->resetAttributes();
$master_status_warga_list->renderRow();
while ($master_status_warga_list->RecordCount < $master_status_warga_list->StopRecord) {
	$master_status_warga_list->RecordCount++;
	if ($master_status_warga_list->RecordCount >= $master_status_warga_list->StartRecord) {
		$master_status_warga_list->RowCount++;

		// Set up key count
		$master_status_warga_list->KeyCount = $master_status_warga_list->RowIndex;

		// Init row class and style
		$master_status_warga->resetAttributes();
		$master_status_warga->CssClass = "";
		if ($master_status_warga_list->isGridAdd()) {
		} else {
			$master_status_warga_list->loadRowValues($master_status_warga_list->Recordset); // Load row values
		}
		$master_status_warga->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$master_status_warga->RowAttrs->merge(["data-rowindex" => $master_status_warga_list->RowCount, "id" => "r" . $master_status_warga_list->RowCount . "_master_status_warga", "data-rowtype" => $master_status_warga->RowType]);

		// Render row
		$master_status_warga_list->renderRow();

		// Render list options
		$master_status_warga_list->renderListOptions();
?>
	<tr <?php echo $master_status_warga->rowAttributes() ?>>
<?php

// Render list options (body, left)
$master_status_warga_list->ListOptions->render("body", "left", $master_status_warga_list->RowCount);
?>
	<?php if ($master_status_warga_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $master_status_warga_list->id->cellAttributes() ?>>
<span id="el<?php echo $master_status_warga_list->RowCount ?>_master_status_warga_id">
<span<?php echo $master_status_warga_list->id->viewAttributes() ?>><?php echo $master_status_warga_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_status_warga_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $master_status_warga_list->nama->cellAttributes() ?>>
<span id="el<?php echo $master_status_warga_list->RowCount ?>_master_status_warga_nama">
<span<?php echo $master_status_warga_list->nama->viewAttributes() ?>><?php echo $master_status_warga_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($master_status_warga_list->na->Visible) { // na ?>
		<td data-name="na" <?php echo $master_status_warga_list->na->cellAttributes() ?>>
<span id="el<?php echo $master_status_warga_list->RowCount ?>_master_status_warga_na">
<span<?php echo $master_status_warga_list->na->viewAttributes() ?>><?php echo $master_status_warga_list->na->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$master_status_warga_list->ListOptions->render("body", "right", $master_status_warga_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$master_status_warga_list->isGridAdd())
		$master_status_warga_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$master_status_warga->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($master_status_warga_list->Recordset)
	$master_status_warga_list->Recordset->Close();
?>
<?php if (!$master_status_warga_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$master_status_warga_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $master_status_warga_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $master_status_warga_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($master_status_warga_list->TotalRecords == 0 && !$master_status_warga->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $master_status_warga_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$master_status_warga_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$master_status_warga_list->isExport()) { ?>
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
$master_status_warga_list->terminate();
?>