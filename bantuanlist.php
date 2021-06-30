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
$bantuan_list = new bantuan_list();

// Run the page
$bantuan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bantuan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bantuan_list->isExport()) { ?>
<script>
var fbantuanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbantuanlist = currentForm = new ew.Form("fbantuanlist", "list");
	fbantuanlist.formKeyCountName = '<?php echo $bantuan_list->FormKeyCountName ?>';
	loadjs.done("fbantuanlist");
});
var fbantuanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbantuanlistsrch = currentSearchForm = new ew.Form("fbantuanlistsrch");

	// Validate function for search
	fbantuanlistsrch.validate = function(fobj) {
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
	fbantuanlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbantuanlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbantuanlistsrch.lists["x_bansos_id"] = <?php echo $bantuan_list->bansos_id->Lookup->toClientList($bantuan_list) ?>;
	fbantuanlistsrch.lists["x_bansos_id"].options = <?php echo JsonEncode($bantuan_list->bansos_id->lookupOptions()) ?>;
	fbantuanlistsrch.lists["x_warga_id"] = <?php echo $bantuan_list->warga_id->Lookup->toClientList($bantuan_list) ?>;
	fbantuanlistsrch.lists["x_warga_id"].options = <?php echo JsonEncode($bantuan_list->warga_id->lookupOptions()) ?>;
	fbantuanlistsrch.lists["x_na"] = <?php echo $bantuan_list->na->Lookup->toClientList($bantuan_list) ?>;
	fbantuanlistsrch.lists["x_na"].options = <?php echo JsonEncode($bantuan_list->na->options(FALSE, TRUE)) ?>;

	// Filters
	fbantuanlistsrch.filterList = <?php echo $bantuan_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbantuanlistsrch.initSearchPanel = true;
	loadjs.done("fbantuanlistsrch");
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
<?php if (!$bantuan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($bantuan_list->TotalRecords > 0 && $bantuan_list->ExportOptions->visible()) { ?>
<?php $bantuan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($bantuan_list->ImportOptions->visible()) { ?>
<?php $bantuan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($bantuan_list->SearchOptions->visible()) { ?>
<?php $bantuan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($bantuan_list->FilterOptions->visible()) { ?>
<?php $bantuan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$bantuan_list->isExport() || Config("EXPORT_MASTER_RECORD") && $bantuan_list->isExport("print")) { ?>
<?php
if ($bantuan_list->DbMasterFilter != "" && $bantuan->getCurrentMasterTable() == "master_bantuan") {
	if ($bantuan_list->MasterRecordExists) {
		include_once "master_bantuanmaster.php";
	}
}
?>
<?php } ?>
<?php
$bantuan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$bantuan_list->isExport() && !$bantuan->CurrentAction) { ?>
<form name="fbantuanlistsrch" id="fbantuanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbantuanlistsrch-search-panel" class="<?php echo $bantuan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bantuan">
	<div class="ew-extended-search">
<?php

// Render search row
$bantuan->RowType = ROWTYPE_SEARCH;
$bantuan->resetAttributes();
$bantuan_list->renderRow();
?>
<?php if ($bantuan_list->bansos_id->Visible) { // bansos_id ?>
	<?php
		$bantuan_list->SearchColumnCount++;
		if (($bantuan_list->SearchColumnCount - 1) % $bantuan_list->SearchFieldsPerRow == 0) {
			$bantuan_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $bantuan_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_bansos_id" class="ew-cell form-group">
		<label for="x_bansos_id" class="ew-search-caption ew-label"><?php echo $bantuan_list->bansos_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_bansos_id" id="z_bansos_id" value="=">
</span>
		<span id="el_bantuan_bansos_id" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_bansos_id"><?php echo EmptyValue(strval($bantuan_list->bansos_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $bantuan_list->bansos_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bantuan_list->bansos_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($bantuan_list->bansos_id->ReadOnly || $bantuan_list->bansos_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_bansos_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $bantuan_list->bansos_id->Lookup->getParamTag($bantuan_list, "p_x_bansos_id") ?>
<input type="hidden" data-table="bantuan" data-field="x_bansos_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bantuan_list->bansos_id->displayValueSeparatorAttribute() ?>" name="x_bansos_id" id="x_bansos_id" value="<?php echo $bantuan_list->bansos_id->AdvancedSearch->SearchValue ?>"<?php echo $bantuan_list->bansos_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($bantuan_list->SearchColumnCount % $bantuan_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($bantuan_list->warga_id->Visible) { // warga_id ?>
	<?php
		$bantuan_list->SearchColumnCount++;
		if (($bantuan_list->SearchColumnCount - 1) % $bantuan_list->SearchFieldsPerRow == 0) {
			$bantuan_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $bantuan_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_warga_id" class="ew-cell form-group">
		<label for="x_warga_id" class="ew-search-caption ew-label"><?php echo $bantuan_list->warga_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_warga_id" id="z_warga_id" value="=">
</span>
		<span id="el_bantuan_warga_id" class="ew-search-field">
<input type="text" data-table="bantuan" data-field="x_warga_id" name="x_warga_id" id="x_warga_id" size="30" placeholder="<?php echo HtmlEncode($bantuan_list->warga_id->getPlaceHolder()) ?>" value="<?php echo $bantuan_list->warga_id->EditValue ?>"<?php echo $bantuan_list->warga_id->editAttributes() ?>>
<?php echo $bantuan_list->warga_id->Lookup->getParamTag($bantuan_list, "p_x_warga_id") ?>
</span>
	</div>
	<?php if ($bantuan_list->SearchColumnCount % $bantuan_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($bantuan_list->na->Visible) { // na ?>
	<?php
		$bantuan_list->SearchColumnCount++;
		if (($bantuan_list->SearchColumnCount - 1) % $bantuan_list->SearchFieldsPerRow == 0) {
			$bantuan_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $bantuan_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_na" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $bantuan_list->na->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_na" id="z_na" value="=">
</span>
		<span id="el_bantuan_na" class="ew-search-field">
<div id="tp_x_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="bantuan" data-field="x_na" data-value-separator="<?php echo $bantuan_list->na->displayValueSeparatorAttribute() ?>" name="x_na" id="x_na" value="{value}"<?php echo $bantuan_list->na->editAttributes() ?>></div>
<div id="dsl_x_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $bantuan_list->na->radioButtonListHtml(FALSE, "x_na") ?>
</div></div>
</span>
	</div>
	<?php if ($bantuan_list->SearchColumnCount % $bantuan_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($bantuan_list->SearchColumnCount % $bantuan_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $bantuan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($bantuan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($bantuan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $bantuan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($bantuan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($bantuan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($bantuan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($bantuan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $bantuan_list->showPageHeader(); ?>
<?php
$bantuan_list->showMessage();
?>
<?php if ($bantuan_list->TotalRecords > 0 || $bantuan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bantuan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bantuan">
<?php if (!$bantuan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$bantuan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bantuan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bantuan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbantuanlist" id="fbantuanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bantuan">
<?php if ($bantuan->getCurrentMasterTable() == "master_bantuan" && $bantuan->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="master_bantuan">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($bantuan_list->bansos_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_bantuan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($bantuan_list->TotalRecords > 0 || $bantuan_list->isGridEdit()) { ?>
<table id="tbl_bantuanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bantuan->RowType = ROWTYPE_HEADER;

// Render list options
$bantuan_list->renderListOptions();

// Render list options (header, left)
$bantuan_list->ListOptions->render("header", "left");
?>
<?php if ($bantuan_list->id->Visible) { // id ?>
	<?php if ($bantuan_list->SortUrl($bantuan_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $bantuan_list->id->headerCellClass() ?>"><div id="elh_bantuan_id" class="bantuan_id"><div class="ew-table-header-caption"><?php echo $bantuan_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $bantuan_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bantuan_list->SortUrl($bantuan_list->id) ?>', 1);"><div id="elh_bantuan_id" class="bantuan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bantuan_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($bantuan_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bantuan_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bantuan_list->bansos_id->Visible) { // bansos_id ?>
	<?php if ($bantuan_list->SortUrl($bantuan_list->bansos_id) == "") { ?>
		<th data-name="bansos_id" class="<?php echo $bantuan_list->bansos_id->headerCellClass() ?>"><div id="elh_bantuan_bansos_id" class="bantuan_bansos_id"><div class="ew-table-header-caption"><?php echo $bantuan_list->bansos_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bansos_id" class="<?php echo $bantuan_list->bansos_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bantuan_list->SortUrl($bantuan_list->bansos_id) ?>', 1);"><div id="elh_bantuan_bansos_id" class="bantuan_bansos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bantuan_list->bansos_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($bantuan_list->bansos_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bantuan_list->bansos_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bantuan_list->warga_id->Visible) { // warga_id ?>
	<?php if ($bantuan_list->SortUrl($bantuan_list->warga_id) == "") { ?>
		<th data-name="warga_id" class="<?php echo $bantuan_list->warga_id->headerCellClass() ?>"><div id="elh_bantuan_warga_id" class="bantuan_warga_id"><div class="ew-table-header-caption"><?php echo $bantuan_list->warga_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="warga_id" class="<?php echo $bantuan_list->warga_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bantuan_list->SortUrl($bantuan_list->warga_id) ?>', 1);"><div id="elh_bantuan_warga_id" class="bantuan_warga_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bantuan_list->warga_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($bantuan_list->warga_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bantuan_list->warga_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bantuan_list->na->Visible) { // na ?>
	<?php if ($bantuan_list->SortUrl($bantuan_list->na) == "") { ?>
		<th data-name="na" class="<?php echo $bantuan_list->na->headerCellClass() ?>"><div id="elh_bantuan_na" class="bantuan_na"><div class="ew-table-header-caption"><?php echo $bantuan_list->na->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="na" class="<?php echo $bantuan_list->na->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bantuan_list->SortUrl($bantuan_list->na) ?>', 1);"><div id="elh_bantuan_na" class="bantuan_na">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bantuan_list->na->caption() ?></span><span class="ew-table-header-sort"><?php if ($bantuan_list->na->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bantuan_list->na->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bantuan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($bantuan_list->ExportAll && $bantuan_list->isExport()) {
	$bantuan_list->StopRecord = $bantuan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($bantuan_list->TotalRecords > $bantuan_list->StartRecord + $bantuan_list->DisplayRecords - 1)
		$bantuan_list->StopRecord = $bantuan_list->StartRecord + $bantuan_list->DisplayRecords - 1;
	else
		$bantuan_list->StopRecord = $bantuan_list->TotalRecords;
}
$bantuan_list->RecordCount = $bantuan_list->StartRecord - 1;
if ($bantuan_list->Recordset && !$bantuan_list->Recordset->EOF) {
	$bantuan_list->Recordset->moveFirst();
	$selectLimit = $bantuan_list->UseSelectLimit;
	if (!$selectLimit && $bantuan_list->StartRecord > 1)
		$bantuan_list->Recordset->move($bantuan_list->StartRecord - 1);
} elseif (!$bantuan->AllowAddDeleteRow && $bantuan_list->StopRecord == 0) {
	$bantuan_list->StopRecord = $bantuan->GridAddRowCount;
}

// Initialize aggregate
$bantuan->RowType = ROWTYPE_AGGREGATEINIT;
$bantuan->resetAttributes();
$bantuan_list->renderRow();
while ($bantuan_list->RecordCount < $bantuan_list->StopRecord) {
	$bantuan_list->RecordCount++;
	if ($bantuan_list->RecordCount >= $bantuan_list->StartRecord) {
		$bantuan_list->RowCount++;

		// Set up key count
		$bantuan_list->KeyCount = $bantuan_list->RowIndex;

		// Init row class and style
		$bantuan->resetAttributes();
		$bantuan->CssClass = "";
		if ($bantuan_list->isGridAdd()) {
		} else {
			$bantuan_list->loadRowValues($bantuan_list->Recordset); // Load row values
		}
		$bantuan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$bantuan->RowAttrs->merge(["data-rowindex" => $bantuan_list->RowCount, "id" => "r" . $bantuan_list->RowCount . "_bantuan", "data-rowtype" => $bantuan->RowType]);

		// Render row
		$bantuan_list->renderRow();

		// Render list options
		$bantuan_list->renderListOptions();
?>
	<tr <?php echo $bantuan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bantuan_list->ListOptions->render("body", "left", $bantuan_list->RowCount);
?>
	<?php if ($bantuan_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $bantuan_list->id->cellAttributes() ?>>
<span id="el<?php echo $bantuan_list->RowCount ?>_bantuan_id">
<span<?php echo $bantuan_list->id->viewAttributes() ?>><?php echo $bantuan_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bantuan_list->bansos_id->Visible) { // bansos_id ?>
		<td data-name="bansos_id" <?php echo $bantuan_list->bansos_id->cellAttributes() ?>>
<span id="el<?php echo $bantuan_list->RowCount ?>_bantuan_bansos_id">
<span<?php echo $bantuan_list->bansos_id->viewAttributes() ?>><?php echo $bantuan_list->bansos_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bantuan_list->warga_id->Visible) { // warga_id ?>
		<td data-name="warga_id" <?php echo $bantuan_list->warga_id->cellAttributes() ?>>
<span id="el<?php echo $bantuan_list->RowCount ?>_bantuan_warga_id">
<span<?php echo $bantuan_list->warga_id->viewAttributes() ?>><?php echo $bantuan_list->warga_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bantuan_list->na->Visible) { // na ?>
		<td data-name="na" <?php echo $bantuan_list->na->cellAttributes() ?>>
<span id="el<?php echo $bantuan_list->RowCount ?>_bantuan_na">
<span<?php echo $bantuan_list->na->viewAttributes() ?>><?php echo $bantuan_list->na->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bantuan_list->ListOptions->render("body", "right", $bantuan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$bantuan_list->isGridAdd())
		$bantuan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$bantuan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bantuan_list->Recordset)
	$bantuan_list->Recordset->Close();
?>
<?php if (!$bantuan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$bantuan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bantuan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bantuan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bantuan_list->TotalRecords == 0 && !$bantuan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bantuan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$bantuan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bantuan_list->isExport()) { ?>
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
$bantuan_list->terminate();
?>