<?php
namespace PHPMaker2020\bansos;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($rw_grid))
	$rw_grid = new rw_grid();

// Run the page
$rw_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rw_grid->Page_Render();
?>
<?php if (!$rw_grid->isExport()) { ?>
<script>
var frwgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	frwgrid = new ew.Form("frwgrid", "grid");
	frwgrid.formKeyCountName = '<?php echo $rw_grid->FormKeyCountName ?>';

	// Validate form
	frwgrid.validate = function() {
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
			<?php if ($rw_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rw_grid->id->caption(), $rw_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rw_grid->desa_id->Required) { ?>
				elm = this.getElements("x" + infix + "_desa_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rw_grid->desa_id->caption(), $rw_grid->desa_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rw_grid->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rw_grid->nama->caption(), $rw_grid->nama->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	frwgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "desa_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "nama", false)) return false;
		return true;
	}

	// Form_CustomValidate
	frwgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frwgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frwgrid.lists["x_desa_id"] = <?php echo $rw_grid->desa_id->Lookup->toClientList($rw_grid) ?>;
	frwgrid.lists["x_desa_id"].options = <?php echo JsonEncode($rw_grid->desa_id->lookupOptions()) ?>;
	loadjs.done("frwgrid");
});
</script>
<?php } ?>
<?php
$rw_grid->renderOtherOptions();
?>
<?php if ($rw_grid->TotalRecords > 0 || $rw->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($rw_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rw">
<?php if ($rw_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $rw_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="frwgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_rw" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_rwgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$rw->RowType = ROWTYPE_HEADER;

// Render list options
$rw_grid->renderListOptions();

// Render list options (header, left)
$rw_grid->ListOptions->render("header", "left");
?>
<?php if ($rw_grid->id->Visible) { // id ?>
	<?php if ($rw_grid->SortUrl($rw_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $rw_grid->id->headerCellClass() ?>"><div id="elh_rw_id" class="rw_id"><div class="ew-table-header-caption"><?php echo $rw_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $rw_grid->id->headerCellClass() ?>"><div><div id="elh_rw_id" class="rw_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rw_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rw_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rw_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rw_grid->desa_id->Visible) { // desa_id ?>
	<?php if ($rw_grid->SortUrl($rw_grid->desa_id) == "") { ?>
		<th data-name="desa_id" class="<?php echo $rw_grid->desa_id->headerCellClass() ?>"><div id="elh_rw_desa_id" class="rw_desa_id"><div class="ew-table-header-caption"><?php echo $rw_grid->desa_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="desa_id" class="<?php echo $rw_grid->desa_id->headerCellClass() ?>"><div><div id="elh_rw_desa_id" class="rw_desa_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rw_grid->desa_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rw_grid->desa_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rw_grid->desa_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rw_grid->nama->Visible) { // nama ?>
	<?php if ($rw_grid->SortUrl($rw_grid->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $rw_grid->nama->headerCellClass() ?>"><div id="elh_rw_nama" class="rw_nama"><div class="ew-table-header-caption"><?php echo $rw_grid->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $rw_grid->nama->headerCellClass() ?>"><div><div id="elh_rw_nama" class="rw_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rw_grid->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($rw_grid->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rw_grid->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rw_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$rw_grid->StartRecord = 1;
$rw_grid->StopRecord = $rw_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($rw->isConfirm() || $rw_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($rw_grid->FormKeyCountName) && ($rw_grid->isGridAdd() || $rw_grid->isGridEdit() || $rw->isConfirm())) {
		$rw_grid->KeyCount = $CurrentForm->getValue($rw_grid->FormKeyCountName);
		$rw_grid->StopRecord = $rw_grid->StartRecord + $rw_grid->KeyCount - 1;
	}
}
$rw_grid->RecordCount = $rw_grid->StartRecord - 1;
if ($rw_grid->Recordset && !$rw_grid->Recordset->EOF) {
	$rw_grid->Recordset->moveFirst();
	$selectLimit = $rw_grid->UseSelectLimit;
	if (!$selectLimit && $rw_grid->StartRecord > 1)
		$rw_grid->Recordset->move($rw_grid->StartRecord - 1);
} elseif (!$rw->AllowAddDeleteRow && $rw_grid->StopRecord == 0) {
	$rw_grid->StopRecord = $rw->GridAddRowCount;
}

// Initialize aggregate
$rw->RowType = ROWTYPE_AGGREGATEINIT;
$rw->resetAttributes();
$rw_grid->renderRow();
if ($rw_grid->isGridAdd())
	$rw_grid->RowIndex = 0;
if ($rw_grid->isGridEdit())
	$rw_grid->RowIndex = 0;
while ($rw_grid->RecordCount < $rw_grid->StopRecord) {
	$rw_grid->RecordCount++;
	if ($rw_grid->RecordCount >= $rw_grid->StartRecord) {
		$rw_grid->RowCount++;
		if ($rw_grid->isGridAdd() || $rw_grid->isGridEdit() || $rw->isConfirm()) {
			$rw_grid->RowIndex++;
			$CurrentForm->Index = $rw_grid->RowIndex;
			if ($CurrentForm->hasValue($rw_grid->FormActionName) && ($rw->isConfirm() || $rw_grid->EventCancelled))
				$rw_grid->RowAction = strval($CurrentForm->getValue($rw_grid->FormActionName));
			elseif ($rw_grid->isGridAdd())
				$rw_grid->RowAction = "insert";
			else
				$rw_grid->RowAction = "";
		}

		// Set up key count
		$rw_grid->KeyCount = $rw_grid->RowIndex;

		// Init row class and style
		$rw->resetAttributes();
		$rw->CssClass = "";
		if ($rw_grid->isGridAdd()) {
			if ($rw->CurrentMode == "copy") {
				$rw_grid->loadRowValues($rw_grid->Recordset); // Load row values
				$rw_grid->setRecordKey($rw_grid->RowOldKey, $rw_grid->Recordset); // Set old record key
			} else {
				$rw_grid->loadRowValues(); // Load default values
				$rw_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$rw_grid->loadRowValues($rw_grid->Recordset); // Load row values
		}
		$rw->RowType = ROWTYPE_VIEW; // Render view
		if ($rw_grid->isGridAdd()) // Grid add
			$rw->RowType = ROWTYPE_ADD; // Render add
		if ($rw_grid->isGridAdd() && $rw->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$rw_grid->restoreCurrentRowFormValues($rw_grid->RowIndex); // Restore form values
		if ($rw_grid->isGridEdit()) { // Grid edit
			if ($rw->EventCancelled)
				$rw_grid->restoreCurrentRowFormValues($rw_grid->RowIndex); // Restore form values
			if ($rw_grid->RowAction == "insert")
				$rw->RowType = ROWTYPE_ADD; // Render add
			else
				$rw->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($rw_grid->isGridEdit() && ($rw->RowType == ROWTYPE_EDIT || $rw->RowType == ROWTYPE_ADD) && $rw->EventCancelled) // Update failed
			$rw_grid->restoreCurrentRowFormValues($rw_grid->RowIndex); // Restore form values
		if ($rw->RowType == ROWTYPE_EDIT) // Edit row
			$rw_grid->EditRowCount++;
		if ($rw->isConfirm()) // Confirm row
			$rw_grid->restoreCurrentRowFormValues($rw_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$rw->RowAttrs->merge(["data-rowindex" => $rw_grid->RowCount, "id" => "r" . $rw_grid->RowCount . "_rw", "data-rowtype" => $rw->RowType]);

		// Render row
		$rw_grid->renderRow();

		// Render list options
		$rw_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($rw_grid->RowAction != "delete" && $rw_grid->RowAction != "insertdelete" && !($rw_grid->RowAction == "insert" && $rw->isConfirm() && $rw_grid->emptyRow())) {
?>
	<tr <?php echo $rw->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rw_grid->ListOptions->render("body", "left", $rw_grid->RowCount);
?>
	<?php if ($rw_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $rw_grid->id->cellAttributes() ?>>
<?php if ($rw->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rw_grid->RowCount ?>_rw_id" class="form-group"></span>
<input type="hidden" data-table="rw" data-field="x_id" name="o<?php echo $rw_grid->RowIndex ?>_id" id="o<?php echo $rw_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rw_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($rw->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rw_grid->RowCount ?>_rw_id" class="form-group">
<span<?php echo $rw_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rw_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="rw" data-field="x_id" name="x<?php echo $rw_grid->RowIndex ?>_id" id="x<?php echo $rw_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rw_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($rw->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rw_grid->RowCount ?>_rw_id">
<span<?php echo $rw_grid->id->viewAttributes() ?>><?php echo $rw_grid->id->getViewValue() ?></span>
</span>
<?php if (!$rw->isConfirm()) { ?>
<input type="hidden" data-table="rw" data-field="x_id" name="x<?php echo $rw_grid->RowIndex ?>_id" id="x<?php echo $rw_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rw_grid->id->FormValue) ?>">
<input type="hidden" data-table="rw" data-field="x_id" name="o<?php echo $rw_grid->RowIndex ?>_id" id="o<?php echo $rw_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rw_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rw" data-field="x_id" name="frwgrid$x<?php echo $rw_grid->RowIndex ?>_id" id="frwgrid$x<?php echo $rw_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rw_grid->id->FormValue) ?>">
<input type="hidden" data-table="rw" data-field="x_id" name="frwgrid$o<?php echo $rw_grid->RowIndex ?>_id" id="frwgrid$o<?php echo $rw_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rw_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rw_grid->desa_id->Visible) { // desa_id ?>
		<td data-name="desa_id" <?php echo $rw_grid->desa_id->cellAttributes() ?>>
<?php if ($rw->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($rw_grid->desa_id->getSessionValue() != "") { ?>
<span id="el<?php echo $rw_grid->RowCount ?>_rw_desa_id" class="form-group">
<span<?php echo $rw_grid->desa_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rw_grid->desa_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $rw_grid->RowIndex ?>_desa_id" name="x<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_grid->desa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $rw_grid->RowCount ?>_rw_desa_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $rw_grid->RowIndex ?>_desa_id"><?php echo EmptyValue(strval($rw_grid->desa_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rw_grid->desa_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rw_grid->desa_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rw_grid->desa_id->ReadOnly || $rw_grid->desa_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $rw_grid->RowIndex ?>_desa_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rw_grid->desa_id->Lookup->getParamTag($rw_grid, "p_x" . $rw_grid->RowIndex . "_desa_id") ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rw_grid->desa_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $rw_grid->RowIndex ?>_desa_id" id="x<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo $rw_grid->desa_id->CurrentValue ?>"<?php echo $rw_grid->desa_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" name="o<?php echo $rw_grid->RowIndex ?>_desa_id" id="o<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_grid->desa_id->OldValue) ?>">
<?php } ?>
<?php if ($rw->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($rw_grid->desa_id->getSessionValue() != "") { ?>
<span id="el<?php echo $rw_grid->RowCount ?>_rw_desa_id" class="form-group">
<span<?php echo $rw_grid->desa_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rw_grid->desa_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $rw_grid->RowIndex ?>_desa_id" name="x<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_grid->desa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $rw_grid->RowCount ?>_rw_desa_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $rw_grid->RowIndex ?>_desa_id"><?php echo EmptyValue(strval($rw_grid->desa_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rw_grid->desa_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rw_grid->desa_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rw_grid->desa_id->ReadOnly || $rw_grid->desa_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $rw_grid->RowIndex ?>_desa_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rw_grid->desa_id->Lookup->getParamTag($rw_grid, "p_x" . $rw_grid->RowIndex . "_desa_id") ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rw_grid->desa_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $rw_grid->RowIndex ?>_desa_id" id="x<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo $rw_grid->desa_id->CurrentValue ?>"<?php echo $rw_grid->desa_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($rw->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rw_grid->RowCount ?>_rw_desa_id">
<span<?php echo $rw_grid->desa_id->viewAttributes() ?>><?php echo $rw_grid->desa_id->getViewValue() ?></span>
</span>
<?php if (!$rw->isConfirm()) { ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" name="x<?php echo $rw_grid->RowIndex ?>_desa_id" id="x<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_grid->desa_id->FormValue) ?>">
<input type="hidden" data-table="rw" data-field="x_desa_id" name="o<?php echo $rw_grid->RowIndex ?>_desa_id" id="o<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_grid->desa_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" name="frwgrid$x<?php echo $rw_grid->RowIndex ?>_desa_id" id="frwgrid$x<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_grid->desa_id->FormValue) ?>">
<input type="hidden" data-table="rw" data-field="x_desa_id" name="frwgrid$o<?php echo $rw_grid->RowIndex ?>_desa_id" id="frwgrid$o<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_grid->desa_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rw_grid->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $rw_grid->nama->cellAttributes() ?>>
<?php if ($rw->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rw_grid->RowCount ?>_rw_nama" class="form-group">
<input type="text" data-table="rw" data-field="x_nama" name="x<?php echo $rw_grid->RowIndex ?>_nama" id="x<?php echo $rw_grid->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rw_grid->nama->getPlaceHolder()) ?>" value="<?php echo $rw_grid->nama->EditValue ?>"<?php echo $rw_grid->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="rw" data-field="x_nama" name="o<?php echo $rw_grid->RowIndex ?>_nama" id="o<?php echo $rw_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rw_grid->nama->OldValue) ?>">
<?php } ?>
<?php if ($rw->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rw_grid->RowCount ?>_rw_nama" class="form-group">
<input type="text" data-table="rw" data-field="x_nama" name="x<?php echo $rw_grid->RowIndex ?>_nama" id="x<?php echo $rw_grid->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rw_grid->nama->getPlaceHolder()) ?>" value="<?php echo $rw_grid->nama->EditValue ?>"<?php echo $rw_grid->nama->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($rw->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rw_grid->RowCount ?>_rw_nama">
<span<?php echo $rw_grid->nama->viewAttributes() ?>><?php echo $rw_grid->nama->getViewValue() ?></span>
</span>
<?php if (!$rw->isConfirm()) { ?>
<input type="hidden" data-table="rw" data-field="x_nama" name="x<?php echo $rw_grid->RowIndex ?>_nama" id="x<?php echo $rw_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rw_grid->nama->FormValue) ?>">
<input type="hidden" data-table="rw" data-field="x_nama" name="o<?php echo $rw_grid->RowIndex ?>_nama" id="o<?php echo $rw_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rw_grid->nama->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rw" data-field="x_nama" name="frwgrid$x<?php echo $rw_grid->RowIndex ?>_nama" id="frwgrid$x<?php echo $rw_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rw_grid->nama->FormValue) ?>">
<input type="hidden" data-table="rw" data-field="x_nama" name="frwgrid$o<?php echo $rw_grid->RowIndex ?>_nama" id="frwgrid$o<?php echo $rw_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rw_grid->nama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rw_grid->ListOptions->render("body", "right", $rw_grid->RowCount);
?>
	</tr>
<?php if ($rw->RowType == ROWTYPE_ADD || $rw->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["frwgrid", "load"], function() {
	frwgrid.updateLists(<?php echo $rw_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$rw_grid->isGridAdd() || $rw->CurrentMode == "copy")
		if (!$rw_grid->Recordset->EOF)
			$rw_grid->Recordset->moveNext();
}
?>
<?php
	if ($rw->CurrentMode == "add" || $rw->CurrentMode == "copy" || $rw->CurrentMode == "edit") {
		$rw_grid->RowIndex = '$rowindex$';
		$rw_grid->loadRowValues();

		// Set row properties
		$rw->resetAttributes();
		$rw->RowAttrs->merge(["data-rowindex" => $rw_grid->RowIndex, "id" => "r0_rw", "data-rowtype" => ROWTYPE_ADD]);
		$rw->RowAttrs->appendClass("ew-template");
		$rw->RowType = ROWTYPE_ADD;

		// Render row
		$rw_grid->renderRow();

		// Render list options
		$rw_grid->renderListOptions();
		$rw_grid->StartRowCount = 0;
?>
	<tr <?php echo $rw->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rw_grid->ListOptions->render("body", "left", $rw_grid->RowIndex);
?>
	<?php if ($rw_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$rw->isConfirm()) { ?>
<span id="el$rowindex$_rw_id" class="form-group rw_id"></span>
<?php } else { ?>
<span id="el$rowindex$_rw_id" class="form-group rw_id">
<span<?php echo $rw_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rw_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="rw" data-field="x_id" name="x<?php echo $rw_grid->RowIndex ?>_id" id="x<?php echo $rw_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rw_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rw" data-field="x_id" name="o<?php echo $rw_grid->RowIndex ?>_id" id="o<?php echo $rw_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rw_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rw_grid->desa_id->Visible) { // desa_id ?>
		<td data-name="desa_id">
<?php if (!$rw->isConfirm()) { ?>
<?php if ($rw_grid->desa_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_rw_desa_id" class="form-group rw_desa_id">
<span<?php echo $rw_grid->desa_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rw_grid->desa_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $rw_grid->RowIndex ?>_desa_id" name="x<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_grid->desa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_rw_desa_id" class="form-group rw_desa_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $rw_grid->RowIndex ?>_desa_id"><?php echo EmptyValue(strval($rw_grid->desa_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rw_grid->desa_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rw_grid->desa_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rw_grid->desa_id->ReadOnly || $rw_grid->desa_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $rw_grid->RowIndex ?>_desa_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rw_grid->desa_id->Lookup->getParamTag($rw_grid, "p_x" . $rw_grid->RowIndex . "_desa_id") ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rw_grid->desa_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $rw_grid->RowIndex ?>_desa_id" id="x<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo $rw_grid->desa_id->CurrentValue ?>"<?php echo $rw_grid->desa_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_rw_desa_id" class="form-group rw_desa_id">
<span<?php echo $rw_grid->desa_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rw_grid->desa_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="rw" data-field="x_desa_id" name="x<?php echo $rw_grid->RowIndex ?>_desa_id" id="x<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_grid->desa_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rw" data-field="x_desa_id" name="o<?php echo $rw_grid->RowIndex ?>_desa_id" id="o<?php echo $rw_grid->RowIndex ?>_desa_id" value="<?php echo HtmlEncode($rw_grid->desa_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rw_grid->nama->Visible) { // nama ?>
		<td data-name="nama">
<?php if (!$rw->isConfirm()) { ?>
<span id="el$rowindex$_rw_nama" class="form-group rw_nama">
<input type="text" data-table="rw" data-field="x_nama" name="x<?php echo $rw_grid->RowIndex ?>_nama" id="x<?php echo $rw_grid->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rw_grid->nama->getPlaceHolder()) ?>" value="<?php echo $rw_grid->nama->EditValue ?>"<?php echo $rw_grid->nama->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_rw_nama" class="form-group rw_nama">
<span<?php echo $rw_grid->nama->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rw_grid->nama->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="rw" data-field="x_nama" name="x<?php echo $rw_grid->RowIndex ?>_nama" id="x<?php echo $rw_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rw_grid->nama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rw" data-field="x_nama" name="o<?php echo $rw_grid->RowIndex ?>_nama" id="o<?php echo $rw_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rw_grid->nama->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rw_grid->ListOptions->render("body", "right", $rw_grid->RowIndex);
?>
<script>
loadjs.ready(["frwgrid", "load"], function() {
	frwgrid.updateLists(<?php echo $rw_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($rw->CurrentMode == "add" || $rw->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $rw_grid->FormKeyCountName ?>" id="<?php echo $rw_grid->FormKeyCountName ?>" value="<?php echo $rw_grid->KeyCount ?>">
<?php echo $rw_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($rw->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $rw_grid->FormKeyCountName ?>" id="<?php echo $rw_grid->FormKeyCountName ?>" value="<?php echo $rw_grid->KeyCount ?>">
<?php echo $rw_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($rw->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="frwgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($rw_grid->Recordset)
	$rw_grid->Recordset->Close();
?>
<?php if ($rw_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $rw_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($rw_grid->TotalRecords == 0 && !$rw->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $rw_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$rw_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$rw_grid->terminate();
?>