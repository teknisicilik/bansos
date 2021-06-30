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
$rt_list = new rt_list();

// Run the page
$rt_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rt_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rt_list->isExport()) { ?>
<script>
var frtlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	frtlist = currentForm = new ew.Form("frtlist", "list");
	frtlist.formKeyCountName = '<?php echo $rt_list->FormKeyCountName ?>';

	// Validate form
	frtlist.validate = function() {
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
			<?php if ($rt_list->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rt_list->id->caption(), $rt_list->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rt_list->rw_id->Required) { ?>
				elm = this.getElements("x" + infix + "_rw_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rt_list->rw_id->caption(), $rt_list->rw_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rt_list->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rt_list->nama->caption(), $rt_list->nama->RequiredErrorMessage)) ?>");
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
	frtlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "rw_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "nama", false)) return false;
		return true;
	}

	// Form_CustomValidate
	frtlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frtlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frtlist.lists["x_rw_id"] = <?php echo $rt_list->rw_id->Lookup->toClientList($rt_list) ?>;
	frtlist.lists["x_rw_id"].options = <?php echo JsonEncode($rt_list->rw_id->lookupOptions()) ?>;
	loadjs.done("frtlist");
});
var frtlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	frtlistsrch = currentSearchForm = new ew.Form("frtlistsrch");

	// Validate function for search
	frtlistsrch.validate = function(fobj) {
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
	frtlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frtlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frtlistsrch.lists["x_rw_id"] = <?php echo $rt_list->rw_id->Lookup->toClientList($rt_list) ?>;
	frtlistsrch.lists["x_rw_id"].options = <?php echo JsonEncode($rt_list->rw_id->lookupOptions()) ?>;

	// Filters
	frtlistsrch.filterList = <?php echo $rt_list->getFilterList() ?>;

	// Init search panel as collapsed
	frtlistsrch.initSearchPanel = true;
	loadjs.done("frtlistsrch");
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
<?php if (!$rt_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($rt_list->TotalRecords > 0 && $rt_list->ExportOptions->visible()) { ?>
<?php $rt_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($rt_list->ImportOptions->visible()) { ?>
<?php $rt_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($rt_list->SearchOptions->visible()) { ?>
<?php $rt_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($rt_list->FilterOptions->visible()) { ?>
<?php $rt_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$rt_list->isExport() || Config("EXPORT_MASTER_RECORD") && $rt_list->isExport("print")) { ?>
<?php
if ($rt_list->DbMasterFilter != "" && $rt->getCurrentMasterTable() == "rw") {
	if ($rt_list->MasterRecordExists) {
		include_once "rwmaster.php";
	}
}
?>
<?php } ?>
<?php
$rt_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$rt_list->isExport() && !$rt->CurrentAction) { ?>
<form name="frtlistsrch" id="frtlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="frtlistsrch-search-panel" class="<?php echo $rt_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="rt">
	<div class="ew-extended-search">
<?php

// Render search row
$rt->RowType = ROWTYPE_SEARCH;
$rt->resetAttributes();
$rt_list->renderRow();
?>
<?php if ($rt_list->rw_id->Visible) { // rw_id ?>
	<?php
		$rt_list->SearchColumnCount++;
		if (($rt_list->SearchColumnCount - 1) % $rt_list->SearchFieldsPerRow == 0) {
			$rt_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rt_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_rw_id" class="ew-cell form-group">
		<label for="x_rw_id" class="ew-search-caption ew-label"><?php echo $rt_list->rw_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_rw_id" id="z_rw_id" value="=">
</span>
		<span id="el_rt_rw_id" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_rw_id"><?php echo EmptyValue(strval($rt_list->rw_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $rt_list->rw_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rt_list->rw_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rt_list->rw_id->ReadOnly || $rt_list->rw_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_rw_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rt_list->rw_id->Lookup->getParamTag($rt_list, "p_x_rw_id") ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rt_list->rw_id->displayValueSeparatorAttribute() ?>" name="x_rw_id" id="x_rw_id" value="<?php echo $rt_list->rw_id->AdvancedSearch->SearchValue ?>"<?php echo $rt_list->rw_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($rt_list->SearchColumnCount % $rt_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($rt_list->SearchColumnCount % $rt_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $rt_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($rt_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($rt_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $rt_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($rt_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($rt_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($rt_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($rt_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $rt_list->showPageHeader(); ?>
<?php
$rt_list->showMessage();
?>
<?php if ($rt_list->TotalRecords > 0 || $rt->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($rt_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rt">
<?php if (!$rt_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$rt_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rt_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rt_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="frtlist" id="frtlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rt">
<?php if ($rt->getCurrentMasterTable() == "rw" && $rt->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="rw">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($rt_list->rw_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_rt" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($rt_list->TotalRecords > 0 || $rt_list->isGridEdit()) { ?>
<table id="tbl_rtlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$rt->RowType = ROWTYPE_HEADER;

// Render list options
$rt_list->renderListOptions();

// Render list options (header, left)
$rt_list->ListOptions->render("header", "left");
?>
<?php if ($rt_list->id->Visible) { // id ?>
	<?php if ($rt_list->SortUrl($rt_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $rt_list->id->headerCellClass() ?>"><div id="elh_rt_id" class="rt_id"><div class="ew-table-header-caption"><?php echo $rt_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $rt_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rt_list->SortUrl($rt_list->id) ?>', 1);"><div id="elh_rt_id" class="rt_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rt_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rt_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rt_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rt_list->rw_id->Visible) { // rw_id ?>
	<?php if ($rt_list->SortUrl($rt_list->rw_id) == "") { ?>
		<th data-name="rw_id" class="<?php echo $rt_list->rw_id->headerCellClass() ?>"><div id="elh_rt_rw_id" class="rt_rw_id"><div class="ew-table-header-caption"><?php echo $rt_list->rw_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rw_id" class="<?php echo $rt_list->rw_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rt_list->SortUrl($rt_list->rw_id) ?>', 1);"><div id="elh_rt_rw_id" class="rt_rw_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rt_list->rw_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rt_list->rw_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rt_list->rw_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rt_list->nama->Visible) { // nama ?>
	<?php if ($rt_list->SortUrl($rt_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $rt_list->nama->headerCellClass() ?>"><div id="elh_rt_nama" class="rt_nama"><div class="ew-table-header-caption"><?php echo $rt_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $rt_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rt_list->SortUrl($rt_list->nama) ?>', 1);"><div id="elh_rt_nama" class="rt_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rt_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rt_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rt_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rt_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rt_list->ExportAll && $rt_list->isExport()) {
	$rt_list->StopRecord = $rt_list->TotalRecords;
} else {

	// Set the last record to display
	if ($rt_list->TotalRecords > $rt_list->StartRecord + $rt_list->DisplayRecords - 1)
		$rt_list->StopRecord = $rt_list->StartRecord + $rt_list->DisplayRecords - 1;
	else
		$rt_list->StopRecord = $rt_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($rt->isConfirm() || $rt_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($rt_list->FormKeyCountName) && ($rt_list->isGridAdd() || $rt_list->isGridEdit() || $rt->isConfirm())) {
		$rt_list->KeyCount = $CurrentForm->getValue($rt_list->FormKeyCountName);
		$rt_list->StopRecord = $rt_list->StartRecord + $rt_list->KeyCount - 1;
	}
}
$rt_list->RecordCount = $rt_list->StartRecord - 1;
if ($rt_list->Recordset && !$rt_list->Recordset->EOF) {
	$rt_list->Recordset->moveFirst();
	$selectLimit = $rt_list->UseSelectLimit;
	if (!$selectLimit && $rt_list->StartRecord > 1)
		$rt_list->Recordset->move($rt_list->StartRecord - 1);
} elseif (!$rt->AllowAddDeleteRow && $rt_list->StopRecord == 0) {
	$rt_list->StopRecord = $rt->GridAddRowCount;
}

// Initialize aggregate
$rt->RowType = ROWTYPE_AGGREGATEINIT;
$rt->resetAttributes();
$rt_list->renderRow();
if ($rt_list->isGridAdd())
	$rt_list->RowIndex = 0;
if ($rt_list->isGridEdit())
	$rt_list->RowIndex = 0;
while ($rt_list->RecordCount < $rt_list->StopRecord) {
	$rt_list->RecordCount++;
	if ($rt_list->RecordCount >= $rt_list->StartRecord) {
		$rt_list->RowCount++;
		if ($rt_list->isGridAdd() || $rt_list->isGridEdit() || $rt->isConfirm()) {
			$rt_list->RowIndex++;
			$CurrentForm->Index = $rt_list->RowIndex;
			if ($CurrentForm->hasValue($rt_list->FormActionName) && ($rt->isConfirm() || $rt_list->EventCancelled))
				$rt_list->RowAction = strval($CurrentForm->getValue($rt_list->FormActionName));
			elseif ($rt_list->isGridAdd())
				$rt_list->RowAction = "insert";
			else
				$rt_list->RowAction = "";
		}

		// Set up key count
		$rt_list->KeyCount = $rt_list->RowIndex;

		// Init row class and style
		$rt->resetAttributes();
		$rt->CssClass = "";
		if ($rt_list->isGridAdd()) {
			$rt_list->loadRowValues(); // Load default values
		} else {
			$rt_list->loadRowValues($rt_list->Recordset); // Load row values
		}
		$rt->RowType = ROWTYPE_VIEW; // Render view
		if ($rt_list->isGridAdd()) // Grid add
			$rt->RowType = ROWTYPE_ADD; // Render add
		if ($rt_list->isGridAdd() && $rt->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$rt_list->restoreCurrentRowFormValues($rt_list->RowIndex); // Restore form values
		if ($rt_list->isGridEdit()) { // Grid edit
			if ($rt->EventCancelled)
				$rt_list->restoreCurrentRowFormValues($rt_list->RowIndex); // Restore form values
			if ($rt_list->RowAction == "insert")
				$rt->RowType = ROWTYPE_ADD; // Render add
			else
				$rt->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($rt_list->isGridEdit() && ($rt->RowType == ROWTYPE_EDIT || $rt->RowType == ROWTYPE_ADD) && $rt->EventCancelled) // Update failed
			$rt_list->restoreCurrentRowFormValues($rt_list->RowIndex); // Restore form values
		if ($rt->RowType == ROWTYPE_EDIT) // Edit row
			$rt_list->EditRowCount++;

		// Set up row id / data-rowindex
		$rt->RowAttrs->merge(["data-rowindex" => $rt_list->RowCount, "id" => "r" . $rt_list->RowCount . "_rt", "data-rowtype" => $rt->RowType]);

		// Render row
		$rt_list->renderRow();

		// Render list options
		$rt_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($rt_list->RowAction != "delete" && $rt_list->RowAction != "insertdelete" && !($rt_list->RowAction == "insert" && $rt->isConfirm() && $rt_list->emptyRow())) {
?>
	<tr <?php echo $rt->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rt_list->ListOptions->render("body", "left", $rt_list->RowCount);
?>
	<?php if ($rt_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $rt_list->id->cellAttributes() ?>>
<?php if ($rt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rt_list->RowCount ?>_rt_id" class="form-group"></span>
<input type="hidden" data-table="rt" data-field="x_id" name="o<?php echo $rt_list->RowIndex ?>_id" id="o<?php echo $rt_list->RowIndex ?>_id" value="<?php echo HtmlEncode($rt_list->id->OldValue) ?>">
<?php } ?>
<?php if ($rt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rt_list->RowCount ?>_rt_id" class="form-group">
<span<?php echo $rt_list->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rt_list->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="rt" data-field="x_id" name="x<?php echo $rt_list->RowIndex ?>_id" id="x<?php echo $rt_list->RowIndex ?>_id" value="<?php echo HtmlEncode($rt_list->id->CurrentValue) ?>">
<?php } ?>
<?php if ($rt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rt_list->RowCount ?>_rt_id">
<span<?php echo $rt_list->id->viewAttributes() ?>><?php echo $rt_list->id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rt_list->rw_id->Visible) { // rw_id ?>
		<td data-name="rw_id" <?php echo $rt_list->rw_id->cellAttributes() ?>>
<?php if ($rt->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($rt_list->rw_id->getSessionValue() != "") { ?>
<span id="el<?php echo $rt_list->RowCount ?>_rt_rw_id" class="form-group">
<span<?php echo $rt_list->rw_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rt_list->rw_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $rt_list->RowIndex ?>_rw_id" name="x<?php echo $rt_list->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_list->rw_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $rt_list->RowCount ?>_rt_rw_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $rt_list->RowIndex ?>_rw_id"><?php echo EmptyValue(strval($rt_list->rw_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rt_list->rw_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rt_list->rw_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rt_list->rw_id->ReadOnly || $rt_list->rw_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $rt_list->RowIndex ?>_rw_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rt_list->rw_id->Lookup->getParamTag($rt_list, "p_x" . $rt_list->RowIndex . "_rw_id") ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rt_list->rw_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $rt_list->RowIndex ?>_rw_id" id="x<?php echo $rt_list->RowIndex ?>_rw_id" value="<?php echo $rt_list->rw_id->CurrentValue ?>"<?php echo $rt_list->rw_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" name="o<?php echo $rt_list->RowIndex ?>_rw_id" id="o<?php echo $rt_list->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_list->rw_id->OldValue) ?>">
<?php } ?>
<?php if ($rt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($rt_list->rw_id->getSessionValue() != "") { ?>
<span id="el<?php echo $rt_list->RowCount ?>_rt_rw_id" class="form-group">
<span<?php echo $rt_list->rw_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rt_list->rw_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $rt_list->RowIndex ?>_rw_id" name="x<?php echo $rt_list->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_list->rw_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $rt_list->RowCount ?>_rt_rw_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $rt_list->RowIndex ?>_rw_id"><?php echo EmptyValue(strval($rt_list->rw_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rt_list->rw_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rt_list->rw_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rt_list->rw_id->ReadOnly || $rt_list->rw_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $rt_list->RowIndex ?>_rw_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rt_list->rw_id->Lookup->getParamTag($rt_list, "p_x" . $rt_list->RowIndex . "_rw_id") ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rt_list->rw_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $rt_list->RowIndex ?>_rw_id" id="x<?php echo $rt_list->RowIndex ?>_rw_id" value="<?php echo $rt_list->rw_id->CurrentValue ?>"<?php echo $rt_list->rw_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($rt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rt_list->RowCount ?>_rt_rw_id">
<span<?php echo $rt_list->rw_id->viewAttributes() ?>><?php echo $rt_list->rw_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rt_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $rt_list->nama->cellAttributes() ?>>
<?php if ($rt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rt_list->RowCount ?>_rt_nama" class="form-group">
<input type="text" data-table="rt" data-field="x_nama" name="x<?php echo $rt_list->RowIndex ?>_nama" id="x<?php echo $rt_list->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rt_list->nama->getPlaceHolder()) ?>" value="<?php echo $rt_list->nama->EditValue ?>"<?php echo $rt_list->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="rt" data-field="x_nama" name="o<?php echo $rt_list->RowIndex ?>_nama" id="o<?php echo $rt_list->RowIndex ?>_nama" value="<?php echo HtmlEncode($rt_list->nama->OldValue) ?>">
<?php } ?>
<?php if ($rt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rt_list->RowCount ?>_rt_nama" class="form-group">
<input type="text" data-table="rt" data-field="x_nama" name="x<?php echo $rt_list->RowIndex ?>_nama" id="x<?php echo $rt_list->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rt_list->nama->getPlaceHolder()) ?>" value="<?php echo $rt_list->nama->EditValue ?>"<?php echo $rt_list->nama->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($rt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rt_list->RowCount ?>_rt_nama">
<span<?php echo $rt_list->nama->viewAttributes() ?>><?php echo $rt_list->nama->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rt_list->ListOptions->render("body", "right", $rt_list->RowCount);
?>
	</tr>
<?php if ($rt->RowType == ROWTYPE_ADD || $rt->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["frtlist", "load"], function() {
	frtlist.updateLists(<?php echo $rt_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$rt_list->isGridAdd())
		if (!$rt_list->Recordset->EOF)
			$rt_list->Recordset->moveNext();
}
?>
<?php
	if ($rt_list->isGridAdd() || $rt_list->isGridEdit()) {
		$rt_list->RowIndex = '$rowindex$';
		$rt_list->loadRowValues();

		// Set row properties
		$rt->resetAttributes();
		$rt->RowAttrs->merge(["data-rowindex" => $rt_list->RowIndex, "id" => "r0_rt", "data-rowtype" => ROWTYPE_ADD]);
		$rt->RowAttrs->appendClass("ew-template");
		$rt->RowType = ROWTYPE_ADD;

		// Render row
		$rt_list->renderRow();

		// Render list options
		$rt_list->renderListOptions();
		$rt_list->StartRowCount = 0;
?>
	<tr <?php echo $rt->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rt_list->ListOptions->render("body", "left", $rt_list->RowIndex);
?>
	<?php if ($rt_list->id->Visible) { // id ?>
		<td data-name="id">
<span id="el$rowindex$_rt_id" class="form-group rt_id"></span>
<input type="hidden" data-table="rt" data-field="x_id" name="o<?php echo $rt_list->RowIndex ?>_id" id="o<?php echo $rt_list->RowIndex ?>_id" value="<?php echo HtmlEncode($rt_list->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rt_list->rw_id->Visible) { // rw_id ?>
		<td data-name="rw_id">
<?php if ($rt_list->rw_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_rt_rw_id" class="form-group rt_rw_id">
<span<?php echo $rt_list->rw_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rt_list->rw_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $rt_list->RowIndex ?>_rw_id" name="x<?php echo $rt_list->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_list->rw_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_rt_rw_id" class="form-group rt_rw_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $rt_list->RowIndex ?>_rw_id"><?php echo EmptyValue(strval($rt_list->rw_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rt_list->rw_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rt_list->rw_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rt_list->rw_id->ReadOnly || $rt_list->rw_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $rt_list->RowIndex ?>_rw_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rt_list->rw_id->Lookup->getParamTag($rt_list, "p_x" . $rt_list->RowIndex . "_rw_id") ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rt_list->rw_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $rt_list->RowIndex ?>_rw_id" id="x<?php echo $rt_list->RowIndex ?>_rw_id" value="<?php echo $rt_list->rw_id->CurrentValue ?>"<?php echo $rt_list->rw_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" name="o<?php echo $rt_list->RowIndex ?>_rw_id" id="o<?php echo $rt_list->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_list->rw_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rt_list->nama->Visible) { // nama ?>
		<td data-name="nama">
<span id="el$rowindex$_rt_nama" class="form-group rt_nama">
<input type="text" data-table="rt" data-field="x_nama" name="x<?php echo $rt_list->RowIndex ?>_nama" id="x<?php echo $rt_list->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rt_list->nama->getPlaceHolder()) ?>" value="<?php echo $rt_list->nama->EditValue ?>"<?php echo $rt_list->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="rt" data-field="x_nama" name="o<?php echo $rt_list->RowIndex ?>_nama" id="o<?php echo $rt_list->RowIndex ?>_nama" value="<?php echo HtmlEncode($rt_list->nama->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rt_list->ListOptions->render("body", "right", $rt_list->RowIndex);
?>
<script>
loadjs.ready(["frtlist", "load"], function() {
	frtlist.updateLists(<?php echo $rt_list->RowIndex ?>);
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
<?php if ($rt_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $rt_list->FormKeyCountName ?>" id="<?php echo $rt_list->FormKeyCountName ?>" value="<?php echo $rt_list->KeyCount ?>">
<?php echo $rt_list->MultiSelectKey ?>
<?php } ?>
<?php if ($rt_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $rt_list->FormKeyCountName ?>" id="<?php echo $rt_list->FormKeyCountName ?>" value="<?php echo $rt_list->KeyCount ?>">
<?php echo $rt_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$rt->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($rt_list->Recordset)
	$rt_list->Recordset->Close();
?>
<?php if (!$rt_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$rt_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rt_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rt_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($rt_list->TotalRecords == 0 && !$rt->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $rt_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$rt_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rt_list->isExport()) { ?>
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
$rt_list->terminate();
?>