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
$rw_list = new rw_list();

// Run the page
$rw_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rw_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rw_list->isExport()) { ?>
<script>
var frwlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	frwlist = currentForm = new ew.Form("frwlist", "list");
	frwlist.formKeyCountName = '<?php echo $rw_list->FormKeyCountName ?>';

	// Validate form
	frwlist.validate = function() {
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
			<?php if ($rw_list->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rw_list->id->caption(), $rw_list->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rw_list->desa_id->Required) { ?>
				elm = this.getElements("x" + infix + "_desa_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rw_list->desa_id->caption(), $rw_list->desa_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rw_list->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rw_list->nama->caption(), $rw_list->nama->RequiredErrorMessage)) ?>");
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
	frwlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "desa_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "nama", false)) return false;
		return true;
	}

	// Form_CustomValidate
	frwlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frwlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frwlist.lists["x_desa_id"] = <?php echo $rw_list->desa_id->Lookup->toClientList($rw_list) ?>;
	frwlist.lists["x_desa_id"].options = <?php echo JsonEncode($rw_list->desa_id->lookupOptions()) ?>;
	loadjs.done("frwlist");
});
var frwlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	frwlistsrch = currentSearchForm = new ew.Form("frwlistsrch");

	// Validate function for search
	frwlistsrch.validate = function(fobj) {
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
	frwlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frwlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frwlistsrch.lists["x_desa_id"] = <?php echo $rw_list->desa_id->Lookup->toClientList($rw_list) ?>;
	frwlistsrch.lists["x_desa_id"].options = <?php echo JsonEncode($rw_list->desa_id->lookupOptions()) ?>;

	// Filters
	frwlistsrch.filterList = <?php echo $rw_list->getFilterList() ?>;

	// Init search panel as collapsed
	frwlistsrch.initSearchPanel = true;
	loadjs.done("frwlistsrch");
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
<?php if (!$rw_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($rw_list->TotalRecords > 0 && $rw_list->ExportOptions->visible()) { ?>
<?php $rw_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($rw_list->ImportOptions->visible()) { ?>
<?php $rw_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($rw_list->SearchOptions->visible()) { ?>
<?php $rw_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($rw_list->FilterOptions->visible()) { ?>
<?php $rw_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$rw_list->isExport() || Config("EXPORT_MASTER_RECORD") && $rw_list->isExport("print")) { ?>
<?php
if ($rw_list->DbMasterFilter != "" && $rw->getCurrentMasterTable() == "desa") {
	if ($rw_list->MasterRecordExists) {
		include_once "desamaster.php";
	}
}
?>
<?php } ?>
<?php
$rw_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$rw_list->isExport() && !$rw->CurrentAction) { ?>
<form name="frwlistsrch" id="frwlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="frwlistsrch-search-panel" class="<?php echo $rw_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="rw">
	<div class="ew-extended-search">
<?php

// Render search row
$rw->RowType = ROWTYPE_SEARCH;
$rw->resetAttributes();
$rw_list->renderRow();
?>
<?php if ($rw_list->desa_id->Visible) { // desa_id ?>
	<?php
		$rw_list->SearchColumnCount++;
		if (($rw_list->SearchColumnCount - 1) % $rw_list->SearchFieldsPerRow == 0) {
			$rw_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $rw_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_desa_id" class="ew-cell form-group">
		<label for="x_desa_id" class="ew-search-caption ew-label"><?php echo $rw_list->desa_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_desa_id" id="z_desa_id" value="=">
</span>
		<span id="el_rw_desa_id" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_desa_id"><?php echo EmptyValue(strval($rw_list->desa_id->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $rw_list->desa_id->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rw_list->desa_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rw_list->desa_id->ReadOnly || $rw_list->desa_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_desa_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rw_list->desa_id->Lookup->getParamTag($rw_list, "p_x_desa_id") ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rw_list->desa_id->displayValueSeparatorAttribute() ?>" name="x_desa_id" id="x_desa_id" value="<?php echo $rw_list->desa_id->AdvancedSearch->SearchValue ?>"<?php echo $rw_list->desa_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($rw_list->SearchColumnCount % $rw_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($rw_list->SearchColumnCount % $rw_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $rw_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($rw_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($rw_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $rw_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($rw_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($rw_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($rw_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($rw_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $rw_list->showPageHeader(); ?>
<?php
$rw_list->showMessage();
?>
<?php if ($rw_list->TotalRecords > 0 || $rw->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($rw_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rw">
<?php if (!$rw_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$rw_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rw_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rw_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="frwlist" id="frwlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rw">
<?php if ($rw->getCurrentMasterTable() == "desa" && $rw->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="desa">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($rw_list->desa_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_rw" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($rw_list->TotalRecords > 0 || $rw_list->isGridEdit()) { ?>
<table id="tbl_rwlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$rw->RowType = ROWTYPE_HEADER;

// Render list options
$rw_list->renderListOptions();

// Render list options (header, left)
$rw_list->ListOptions->render("header", "left");
?>
<?php if ($rw_list->id->Visible) { // id ?>
	<?php if ($rw_list->SortUrl($rw_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $rw_list->id->headerCellClass() ?>"><div id="elh_rw_id" class="rw_id"><div class="ew-table-header-caption"><?php echo $rw_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $rw_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rw_list->SortUrl($rw_list->id) ?>', 1);"><div id="elh_rw_id" class="rw_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rw_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rw_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rw_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rw_list->desa_id->Visible) { // desa_id ?>
	<?php if ($rw_list->SortUrl($rw_list->desa_id) == "") { ?>
		<th data-name="desa_id" class="<?php echo $rw_list->desa_id->headerCellClass() ?>"><div id="elh_rw_desa_id" class="rw_desa_id"><div class="ew-table-header-caption"><?php echo $rw_list->desa_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="desa_id" class="<?php echo $rw_list->desa_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rw_list->SortUrl($rw_list->desa_id) ?>', 1);"><div id="elh_rw_desa_id" class="rw_desa_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rw_list->desa_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rw_list->desa_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rw_list->desa_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rw_list->nama->Visible) { // nama ?>
	<?php if ($rw_list->SortUrl($rw_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $rw_list->nama->headerCellClass() ?>"><div id="elh_rw_nama" class="rw_nama"><div class="ew-table-header-caption"><?php echo $rw_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $rw_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rw_list->SortUrl($rw_list->nama) ?>', 1);"><div id="elh_rw_nama" class="rw_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rw_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($rw_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rw_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rw_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rw_list->ExportAll && $rw_list->isExport()) {
	$rw_list->StopRecord = $rw_list->TotalRecords;
} else {

	// Set the last record to display
	if ($rw_list->TotalRecords > $rw_list->StartRecord + $rw_list->DisplayRecords - 1)
		$rw_list->StopRecord = $rw_list->StartRecord + $rw_list->DisplayRecords - 1;
	else
		$rw_list->StopRecord = $rw_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($rw->isConfirm() || $rw_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($rw_list->FormKeyCountName) && ($rw_list->isGridAdd() || $rw_list->isGridEdit() || $rw->isConfirm())) {
		$rw_list->KeyCount = $CurrentForm->getValue($rw_list->FormKeyCountName);
		$rw_list->StopRecord = $rw_list->StartRecord + $rw_list->KeyCount - 1;
	}
}
$rw_list->RecordCount = $rw_list->StartRecord - 1;
if ($rw_list->Recordset && !$rw_list->Recordset->EOF) {
	$rw_list->Recordset->moveFirst();
	$selectLimit = $rw_list->UseSelectLimit;
	if (!$selectLimit && $rw_list->StartRecord > 1)
		$rw_list->Recordset->move($rw_list->StartRecord - 1);
} elseif (!$rw->AllowAddDeleteRow && $rw_list->StopRecord == 0) {
	$rw_list->StopRecord = $rw->GridAddRowCount;
}

// Initialize aggregate
$rw->RowType = ROWTYPE_AGGREGATEINIT;
$rw->resetAttributes();
$rw_list->renderRow();
if ($rw_list->isGridAdd())
	$rw_list->RowIndex = 0;
if ($rw_list->isGridEdit())
	$rw_list->RowIndex = 0;
while ($rw_list->RecordCount < $rw_list->StopRecord) {
	$rw_list->RecordCount++;
	if ($rw_list->RecordCount >= $rw_list->StartRecord) {
		$rw_list->RowCount++;
		if ($rw_list->isGridAdd() || $rw_list->isGridEdit() || $rw->isConfirm()) {
			$rw_list->RowIndex++;
			$CurrentForm->Index = $rw_list->RowIndex;
			if ($CurrentForm->hasValue($rw_list->FormActionName) && ($rw->isConfirm() || $rw_list->EventCancelled))
				$rw_list->RowAction = strval($CurrentForm->getValue($rw_list->FormActionName));
			elseif ($rw_list->isGridAdd())
				$rw_list->RowAction = "insert";
			else
				$rw_list->RowAction = "";
		}

		// Set up key count
		$rw_list->KeyCount = $rw_list->RowIndex;

		// Init row class and style
		$rw->resetAttributes();
		$rw->CssClass = "";
		if ($rw_list->isGridAdd()) {
			$rw_list->loadRowValues(); // Load default values
		} else {
			$rw_list->loadRowValues($rw_list->Recordset); // Load row values
		}
		$rw->RowType = ROWTYPE_VIEW; // Render view
		if ($rw_list->isGridAdd()) // Grid add
			$rw->RowType = ROWTYPE_ADD; // Render add
		if ($rw_list->isGridAdd() && $rw->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$rw_list->restoreCurrentRowFormValues($rw_list->RowIndex); // Restore form values
		if ($rw_list->isGridEdit()) { // Grid edit
			if ($rw->EventCancelled)
				$rw_list->restoreCurrentRowFormValues($rw_list->RowIndex); // Restore form values
			if ($rw_list->RowAction == "insert")
				$rw->RowType = ROWTYPE_ADD; // Render add
			else
				$rw->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($rw_list->isGridEdit() && ($rw->RowType == ROWTYPE_EDIT || $rw->RowType == ROWTYPE_ADD) && $rw->EventCancelled) // Update failed
			$rw_list->restoreCurrentRowFormValues($rw_list->RowIndex); // Restore form values
		if ($rw->RowType == ROWTYPE_EDIT) // Edit row
			$rw_list->EditRowCount++;

		// Set up row id / data-rowindex
		$rw->RowAttrs->merge(["data-rowindex" => $rw_list->RowCount, "id" => "r" . $rw_list->RowCount . "_rw", "data-rowtype" => $rw->RowType]);

		// Render row
		$rw_list->renderRow();

		// Render list options
		$rw_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($rw_list->RowAction != "delete" && $rw_list->RowAction != "insertdelete" && !($rw_list->RowAction == "insert" && $rw->isConfirm() && $rw_list->emptyRow())) {
?>
	<tr <?php echo $rw->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rw_list->ListOptions->render("body", "left", $rw_list->RowCount);
?>
	<?php if ($rw_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $rw_list->id->cellAttributes() ?>>
<?php if ($rw->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rw_list->RowCount ?>_rw_id" class="form-group"></span>
<input type="hidden" data-table="rw" data-field="x_id" name="o<?php echo $rw_list->RowIndex ?>_id" id="o<?php echo $rw_list->RowIndex ?>_id" value="<?php echo HtmlEncode($rw_list->id->OldValue) ?>">
<?php } ?>
<?php if ($rw->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rw_list->RowCount ?>_rw_id" class="form-group">
<span<?php echo $rw_list->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rw_list->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="rw" data-field="x_id" name="x<?php echo $rw_list->RowIndex ?>_id" id="x<?php echo $rw_list->RowIndex ?>_id" value="<?php echo HtmlEncode($rw_list->id->CurrentValue) ?>">
<?php } ?>
<?php if ($rw->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rw_list->RowCount ?>_rw_id">
<span<?php echo $rw_list->id->viewAttributes() ?>><?php echo $rw_list->id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rw_list->desa_id->Visible) { // desa_id ?>
		<td data-name="desa_id" <?php echo $rw_list->desa_id->cellAttributes() ?>>
<?php if ($rw->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($rw_list->desa_id->getSessionValue() != "") { ?>
<span id="el<?php echo $rw_list->RowCount ?>_rw_desa_id" class="form-group">
<span<?php echo $rw_list->desa_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rw_list->desa_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $rw_list->RowIndex ?>_desa_id" name="x<?php echo $rw_list->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_list->desa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $rw_list->RowCount ?>_rw_desa_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $rw_list->RowIndex ?>_desa_id"><?php echo EmptyValue(strval($rw_list->desa_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rw_list->desa_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rw_list->desa_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rw_list->desa_id->ReadOnly || $rw_list->desa_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $rw_list->RowIndex ?>_desa_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rw_list->desa_id->Lookup->getParamTag($rw_list, "p_x" . $rw_list->RowIndex . "_desa_id") ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rw_list->desa_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $rw_list->RowIndex ?>_desa_id" id="x<?php echo $rw_list->RowIndex ?>_desa_id" value="<?php echo $rw_list->desa_id->CurrentValue ?>"<?php echo $rw_list->desa_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" name="o<?php echo $rw_list->RowIndex ?>_desa_id" id="o<?php echo $rw_list->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_list->desa_id->OldValue) ?>">
<?php } ?>
<?php if ($rw->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($rw_list->desa_id->getSessionValue() != "") { ?>
<span id="el<?php echo $rw_list->RowCount ?>_rw_desa_id" class="form-group">
<span<?php echo $rw_list->desa_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rw_list->desa_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $rw_list->RowIndex ?>_desa_id" name="x<?php echo $rw_list->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_list->desa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $rw_list->RowCount ?>_rw_desa_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $rw_list->RowIndex ?>_desa_id"><?php echo EmptyValue(strval($rw_list->desa_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rw_list->desa_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rw_list->desa_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rw_list->desa_id->ReadOnly || $rw_list->desa_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $rw_list->RowIndex ?>_desa_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rw_list->desa_id->Lookup->getParamTag($rw_list, "p_x" . $rw_list->RowIndex . "_desa_id") ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rw_list->desa_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $rw_list->RowIndex ?>_desa_id" id="x<?php echo $rw_list->RowIndex ?>_desa_id" value="<?php echo $rw_list->desa_id->CurrentValue ?>"<?php echo $rw_list->desa_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($rw->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rw_list->RowCount ?>_rw_desa_id">
<span<?php echo $rw_list->desa_id->viewAttributes() ?>><?php echo $rw_list->desa_id->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rw_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $rw_list->nama->cellAttributes() ?>>
<?php if ($rw->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rw_list->RowCount ?>_rw_nama" class="form-group">
<input type="text" data-table="rw" data-field="x_nama" name="x<?php echo $rw_list->RowIndex ?>_nama" id="x<?php echo $rw_list->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rw_list->nama->getPlaceHolder()) ?>" value="<?php echo $rw_list->nama->EditValue ?>"<?php echo $rw_list->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="rw" data-field="x_nama" name="o<?php echo $rw_list->RowIndex ?>_nama" id="o<?php echo $rw_list->RowIndex ?>_nama" value="<?php echo HtmlEncode($rw_list->nama->OldValue) ?>">
<?php } ?>
<?php if ($rw->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rw_list->RowCount ?>_rw_nama" class="form-group">
<input type="text" data-table="rw" data-field="x_nama" name="x<?php echo $rw_list->RowIndex ?>_nama" id="x<?php echo $rw_list->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rw_list->nama->getPlaceHolder()) ?>" value="<?php echo $rw_list->nama->EditValue ?>"<?php echo $rw_list->nama->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($rw->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rw_list->RowCount ?>_rw_nama">
<span<?php echo $rw_list->nama->viewAttributes() ?>><?php echo $rw_list->nama->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rw_list->ListOptions->render("body", "right", $rw_list->RowCount);
?>
	</tr>
<?php if ($rw->RowType == ROWTYPE_ADD || $rw->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["frwlist", "load"], function() {
	frwlist.updateLists(<?php echo $rw_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$rw_list->isGridAdd())
		if (!$rw_list->Recordset->EOF)
			$rw_list->Recordset->moveNext();
}
?>
<?php
	if ($rw_list->isGridAdd() || $rw_list->isGridEdit()) {
		$rw_list->RowIndex = '$rowindex$';
		$rw_list->loadRowValues();

		// Set row properties
		$rw->resetAttributes();
		$rw->RowAttrs->merge(["data-rowindex" => $rw_list->RowIndex, "id" => "r0_rw", "data-rowtype" => ROWTYPE_ADD]);
		$rw->RowAttrs->appendClass("ew-template");
		$rw->RowType = ROWTYPE_ADD;

		// Render row
		$rw_list->renderRow();

		// Render list options
		$rw_list->renderListOptions();
		$rw_list->StartRowCount = 0;
?>
	<tr <?php echo $rw->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rw_list->ListOptions->render("body", "left", $rw_list->RowIndex);
?>
	<?php if ($rw_list->id->Visible) { // id ?>
		<td data-name="id">
<span id="el$rowindex$_rw_id" class="form-group rw_id"></span>
<input type="hidden" data-table="rw" data-field="x_id" name="o<?php echo $rw_list->RowIndex ?>_id" id="o<?php echo $rw_list->RowIndex ?>_id" value="<?php echo HtmlEncode($rw_list->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rw_list->desa_id->Visible) { // desa_id ?>
		<td data-name="desa_id">
<?php if ($rw_list->desa_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_rw_desa_id" class="form-group rw_desa_id">
<span<?php echo $rw_list->desa_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rw_list->desa_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $rw_list->RowIndex ?>_desa_id" name="x<?php echo $rw_list->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_list->desa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_rw_desa_id" class="form-group rw_desa_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $rw_list->RowIndex ?>_desa_id"><?php echo EmptyValue(strval($rw_list->desa_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rw_list->desa_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rw_list->desa_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rw_list->desa_id->ReadOnly || $rw_list->desa_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $rw_list->RowIndex ?>_desa_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rw_list->desa_id->Lookup->getParamTag($rw_list, "p_x" . $rw_list->RowIndex . "_desa_id") ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rw_list->desa_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $rw_list->RowIndex ?>_desa_id" id="x<?php echo $rw_list->RowIndex ?>_desa_id" value="<?php echo $rw_list->desa_id->CurrentValue ?>"<?php echo $rw_list->desa_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" name="o<?php echo $rw_list->RowIndex ?>_desa_id" id="o<?php echo $rw_list->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_list->desa_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rw_list->nama->Visible) { // nama ?>
		<td data-name="nama">
<span id="el$rowindex$_rw_nama" class="form-group rw_nama">
<input type="text" data-table="rw" data-field="x_nama" name="x<?php echo $rw_list->RowIndex ?>_nama" id="x<?php echo $rw_list->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rw_list->nama->getPlaceHolder()) ?>" value="<?php echo $rw_list->nama->EditValue ?>"<?php echo $rw_list->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="rw" data-field="x_nama" name="o<?php echo $rw_list->RowIndex ?>_nama" id="o<?php echo $rw_list->RowIndex ?>_nama" value="<?php echo HtmlEncode($rw_list->nama->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rw_list->ListOptions->render("body", "right", $rw_list->RowIndex);
?>
<script>
loadjs.ready(["frwlist", "load"], function() {
	frwlist.updateLists(<?php echo $rw_list->RowIndex ?>);
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
<?php if ($rw_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $rw_list->FormKeyCountName ?>" id="<?php echo $rw_list->FormKeyCountName ?>" value="<?php echo $rw_list->KeyCount ?>">
<?php echo $rw_list->MultiSelectKey ?>
<?php } ?>
<?php if ($rw_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $rw_list->FormKeyCountName ?>" id="<?php echo $rw_list->FormKeyCountName ?>" value="<?php echo $rw_list->KeyCount ?>">
<?php echo $rw_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$rw->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($rw_list->Recordset)
	$rw_list->Recordset->Close();
?>
<?php if (!$rw_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$rw_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rw_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rw_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($rw_list->TotalRecords == 0 && !$rw->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $rw_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$rw_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rw_list->isExport()) { ?>
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
$rw_list->terminate();
?>