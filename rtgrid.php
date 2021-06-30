<?php
namespace PHPMaker2020\bansos;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($rt_grid))
	$rt_grid = new rt_grid();

// Run the page
$rt_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rt_grid->Page_Render();
?>
<?php if (!$rt_grid->isExport()) { ?>
<script>
var frtgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	frtgrid = new ew.Form("frtgrid", "grid");
	frtgrid.formKeyCountName = '<?php echo $rt_grid->FormKeyCountName ?>';

	// Validate form
	frtgrid.validate = function() {
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
			<?php if ($rt_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rt_grid->id->caption(), $rt_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rt_grid->rw_id->Required) { ?>
				elm = this.getElements("x" + infix + "_rw_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rt_grid->rw_id->caption(), $rt_grid->rw_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rt_grid->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rt_grid->nama->caption(), $rt_grid->nama->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	frtgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "rw_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "nama", false)) return false;
		return true;
	}

	// Form_CustomValidate
	frtgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frtgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frtgrid.lists["x_rw_id"] = <?php echo $rt_grid->rw_id->Lookup->toClientList($rt_grid) ?>;
	frtgrid.lists["x_rw_id"].options = <?php echo JsonEncode($rt_grid->rw_id->lookupOptions()) ?>;
	loadjs.done("frtgrid");
});
</script>
<?php } ?>
<?php
$rt_grid->renderOtherOptions();
?>
<?php if ($rt_grid->TotalRecords > 0 || $rt->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($rt_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rt">
<?php if ($rt_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $rt_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="frtgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_rt" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_rtgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$rt->RowType = ROWTYPE_HEADER;

// Render list options
$rt_grid->renderListOptions();

// Render list options (header, left)
$rt_grid->ListOptions->render("header", "left");
?>
<?php if ($rt_grid->id->Visible) { // id ?>
	<?php if ($rt_grid->SortUrl($rt_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $rt_grid->id->headerCellClass() ?>"><div id="elh_rt_id" class="rt_id"><div class="ew-table-header-caption"><?php echo $rt_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $rt_grid->id->headerCellClass() ?>"><div><div id="elh_rt_id" class="rt_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rt_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rt_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rt_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rt_grid->rw_id->Visible) { // rw_id ?>
	<?php if ($rt_grid->SortUrl($rt_grid->rw_id) == "") { ?>
		<th data-name="rw_id" class="<?php echo $rt_grid->rw_id->headerCellClass() ?>"><div id="elh_rt_rw_id" class="rt_rw_id"><div class="ew-table-header-caption"><?php echo $rt_grid->rw_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rw_id" class="<?php echo $rt_grid->rw_id->headerCellClass() ?>"><div><div id="elh_rt_rw_id" class="rt_rw_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rt_grid->rw_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rt_grid->rw_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rt_grid->rw_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rt_grid->nama->Visible) { // nama ?>
	<?php if ($rt_grid->SortUrl($rt_grid->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $rt_grid->nama->headerCellClass() ?>"><div id="elh_rt_nama" class="rt_nama"><div class="ew-table-header-caption"><?php echo $rt_grid->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $rt_grid->nama->headerCellClass() ?>"><div><div id="elh_rt_nama" class="rt_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rt_grid->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($rt_grid->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rt_grid->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rt_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$rt_grid->StartRecord = 1;
$rt_grid->StopRecord = $rt_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($rt->isConfirm() || $rt_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($rt_grid->FormKeyCountName) && ($rt_grid->isGridAdd() || $rt_grid->isGridEdit() || $rt->isConfirm())) {
		$rt_grid->KeyCount = $CurrentForm->getValue($rt_grid->FormKeyCountName);
		$rt_grid->StopRecord = $rt_grid->StartRecord + $rt_grid->KeyCount - 1;
	}
}
$rt_grid->RecordCount = $rt_grid->StartRecord - 1;
if ($rt_grid->Recordset && !$rt_grid->Recordset->EOF) {
	$rt_grid->Recordset->moveFirst();
	$selectLimit = $rt_grid->UseSelectLimit;
	if (!$selectLimit && $rt_grid->StartRecord > 1)
		$rt_grid->Recordset->move($rt_grid->StartRecord - 1);
} elseif (!$rt->AllowAddDeleteRow && $rt_grid->StopRecord == 0) {
	$rt_grid->StopRecord = $rt->GridAddRowCount;
}

// Initialize aggregate
$rt->RowType = ROWTYPE_AGGREGATEINIT;
$rt->resetAttributes();
$rt_grid->renderRow();
if ($rt_grid->isGridAdd())
	$rt_grid->RowIndex = 0;
if ($rt_grid->isGridEdit())
	$rt_grid->RowIndex = 0;
while ($rt_grid->RecordCount < $rt_grid->StopRecord) {
	$rt_grid->RecordCount++;
	if ($rt_grid->RecordCount >= $rt_grid->StartRecord) {
		$rt_grid->RowCount++;
		if ($rt_grid->isGridAdd() || $rt_grid->isGridEdit() || $rt->isConfirm()) {
			$rt_grid->RowIndex++;
			$CurrentForm->Index = $rt_grid->RowIndex;
			if ($CurrentForm->hasValue($rt_grid->FormActionName) && ($rt->isConfirm() || $rt_grid->EventCancelled))
				$rt_grid->RowAction = strval($CurrentForm->getValue($rt_grid->FormActionName));
			elseif ($rt_grid->isGridAdd())
				$rt_grid->RowAction = "insert";
			else
				$rt_grid->RowAction = "";
		}

		// Set up key count
		$rt_grid->KeyCount = $rt_grid->RowIndex;

		// Init row class and style
		$rt->resetAttributes();
		$rt->CssClass = "";
		if ($rt_grid->isGridAdd()) {
			if ($rt->CurrentMode == "copy") {
				$rt_grid->loadRowValues($rt_grid->Recordset); // Load row values
				$rt_grid->setRecordKey($rt_grid->RowOldKey, $rt_grid->Recordset); // Set old record key
			} else {
				$rt_grid->loadRowValues(); // Load default values
				$rt_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$rt_grid->loadRowValues($rt_grid->Recordset); // Load row values
		}
		$rt->RowType = ROWTYPE_VIEW; // Render view
		if ($rt_grid->isGridAdd()) // Grid add
			$rt->RowType = ROWTYPE_ADD; // Render add
		if ($rt_grid->isGridAdd() && $rt->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$rt_grid->restoreCurrentRowFormValues($rt_grid->RowIndex); // Restore form values
		if ($rt_grid->isGridEdit()) { // Grid edit
			if ($rt->EventCancelled)
				$rt_grid->restoreCurrentRowFormValues($rt_grid->RowIndex); // Restore form values
			if ($rt_grid->RowAction == "insert")
				$rt->RowType = ROWTYPE_ADD; // Render add
			else
				$rt->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($rt_grid->isGridEdit() && ($rt->RowType == ROWTYPE_EDIT || $rt->RowType == ROWTYPE_ADD) && $rt->EventCancelled) // Update failed
			$rt_grid->restoreCurrentRowFormValues($rt_grid->RowIndex); // Restore form values
		if ($rt->RowType == ROWTYPE_EDIT) // Edit row
			$rt_grid->EditRowCount++;
		if ($rt->isConfirm()) // Confirm row
			$rt_grid->restoreCurrentRowFormValues($rt_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$rt->RowAttrs->merge(["data-rowindex" => $rt_grid->RowCount, "id" => "r" . $rt_grid->RowCount . "_rt", "data-rowtype" => $rt->RowType]);

		// Render row
		$rt_grid->renderRow();

		// Render list options
		$rt_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($rt_grid->RowAction != "delete" && $rt_grid->RowAction != "insertdelete" && !($rt_grid->RowAction == "insert" && $rt->isConfirm() && $rt_grid->emptyRow())) {
?>
	<tr <?php echo $rt->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rt_grid->ListOptions->render("body", "left", $rt_grid->RowCount);
?>
	<?php if ($rt_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $rt_grid->id->cellAttributes() ?>>
<?php if ($rt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rt_grid->RowCount ?>_rt_id" class="form-group"></span>
<input type="hidden" data-table="rt" data-field="x_id" name="o<?php echo $rt_grid->RowIndex ?>_id" id="o<?php echo $rt_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rt_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($rt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rt_grid->RowCount ?>_rt_id" class="form-group">
<span<?php echo $rt_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rt_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="rt" data-field="x_id" name="x<?php echo $rt_grid->RowIndex ?>_id" id="x<?php echo $rt_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rt_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($rt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rt_grid->RowCount ?>_rt_id">
<span<?php echo $rt_grid->id->viewAttributes() ?>><?php echo $rt_grid->id->getViewValue() ?></span>
</span>
<?php if (!$rt->isConfirm()) { ?>
<input type="hidden" data-table="rt" data-field="x_id" name="x<?php echo $rt_grid->RowIndex ?>_id" id="x<?php echo $rt_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rt_grid->id->FormValue) ?>">
<input type="hidden" data-table="rt" data-field="x_id" name="o<?php echo $rt_grid->RowIndex ?>_id" id="o<?php echo $rt_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rt_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rt" data-field="x_id" name="frtgrid$x<?php echo $rt_grid->RowIndex ?>_id" id="frtgrid$x<?php echo $rt_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rt_grid->id->FormValue) ?>">
<input type="hidden" data-table="rt" data-field="x_id" name="frtgrid$o<?php echo $rt_grid->RowIndex ?>_id" id="frtgrid$o<?php echo $rt_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rt_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rt_grid->rw_id->Visible) { // rw_id ?>
		<td data-name="rw_id" <?php echo $rt_grid->rw_id->cellAttributes() ?>>
<?php if ($rt->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($rt_grid->rw_id->getSessionValue() != "") { ?>
<span id="el<?php echo $rt_grid->RowCount ?>_rt_rw_id" class="form-group">
<span<?php echo $rt_grid->rw_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rt_grid->rw_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $rt_grid->RowIndex ?>_rw_id" name="x<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_grid->rw_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $rt_grid->RowCount ?>_rt_rw_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $rt_grid->RowIndex ?>_rw_id"><?php echo EmptyValue(strval($rt_grid->rw_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rt_grid->rw_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rt_grid->rw_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rt_grid->rw_id->ReadOnly || $rt_grid->rw_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $rt_grid->RowIndex ?>_rw_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rt_grid->rw_id->Lookup->getParamTag($rt_grid, "p_x" . $rt_grid->RowIndex . "_rw_id") ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rt_grid->rw_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $rt_grid->RowIndex ?>_rw_id" id="x<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo $rt_grid->rw_id->CurrentValue ?>"<?php echo $rt_grid->rw_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" name="o<?php echo $rt_grid->RowIndex ?>_rw_id" id="o<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_grid->rw_id->OldValue) ?>">
<?php } ?>
<?php if ($rt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($rt_grid->rw_id->getSessionValue() != "") { ?>
<span id="el<?php echo $rt_grid->RowCount ?>_rt_rw_id" class="form-group">
<span<?php echo $rt_grid->rw_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rt_grid->rw_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $rt_grid->RowIndex ?>_rw_id" name="x<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_grid->rw_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $rt_grid->RowCount ?>_rt_rw_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $rt_grid->RowIndex ?>_rw_id"><?php echo EmptyValue(strval($rt_grid->rw_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rt_grid->rw_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rt_grid->rw_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rt_grid->rw_id->ReadOnly || $rt_grid->rw_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $rt_grid->RowIndex ?>_rw_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rt_grid->rw_id->Lookup->getParamTag($rt_grid, "p_x" . $rt_grid->RowIndex . "_rw_id") ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rt_grid->rw_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $rt_grid->RowIndex ?>_rw_id" id="x<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo $rt_grid->rw_id->CurrentValue ?>"<?php echo $rt_grid->rw_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($rt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rt_grid->RowCount ?>_rt_rw_id">
<span<?php echo $rt_grid->rw_id->viewAttributes() ?>><?php echo $rt_grid->rw_id->getViewValue() ?></span>
</span>
<?php if (!$rt->isConfirm()) { ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" name="x<?php echo $rt_grid->RowIndex ?>_rw_id" id="x<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_grid->rw_id->FormValue) ?>">
<input type="hidden" data-table="rt" data-field="x_rw_id" name="o<?php echo $rt_grid->RowIndex ?>_rw_id" id="o<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_grid->rw_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" name="frtgrid$x<?php echo $rt_grid->RowIndex ?>_rw_id" id="frtgrid$x<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_grid->rw_id->FormValue) ?>">
<input type="hidden" data-table="rt" data-field="x_rw_id" name="frtgrid$o<?php echo $rt_grid->RowIndex ?>_rw_id" id="frtgrid$o<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_grid->rw_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rt_grid->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $rt_grid->nama->cellAttributes() ?>>
<?php if ($rt->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rt_grid->RowCount ?>_rt_nama" class="form-group">
<input type="text" data-table="rt" data-field="x_nama" name="x<?php echo $rt_grid->RowIndex ?>_nama" id="x<?php echo $rt_grid->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rt_grid->nama->getPlaceHolder()) ?>" value="<?php echo $rt_grid->nama->EditValue ?>"<?php echo $rt_grid->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="rt" data-field="x_nama" name="o<?php echo $rt_grid->RowIndex ?>_nama" id="o<?php echo $rt_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rt_grid->nama->OldValue) ?>">
<?php } ?>
<?php if ($rt->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rt_grid->RowCount ?>_rt_nama" class="form-group">
<input type="text" data-table="rt" data-field="x_nama" name="x<?php echo $rt_grid->RowIndex ?>_nama" id="x<?php echo $rt_grid->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rt_grid->nama->getPlaceHolder()) ?>" value="<?php echo $rt_grid->nama->EditValue ?>"<?php echo $rt_grid->nama->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($rt->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rt_grid->RowCount ?>_rt_nama">
<span<?php echo $rt_grid->nama->viewAttributes() ?>><?php echo $rt_grid->nama->getViewValue() ?></span>
</span>
<?php if (!$rt->isConfirm()) { ?>
<input type="hidden" data-table="rt" data-field="x_nama" name="x<?php echo $rt_grid->RowIndex ?>_nama" id="x<?php echo $rt_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rt_grid->nama->FormValue) ?>">
<input type="hidden" data-table="rt" data-field="x_nama" name="o<?php echo $rt_grid->RowIndex ?>_nama" id="o<?php echo $rt_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rt_grid->nama->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rt" data-field="x_nama" name="frtgrid$x<?php echo $rt_grid->RowIndex ?>_nama" id="frtgrid$x<?php echo $rt_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rt_grid->nama->FormValue) ?>">
<input type="hidden" data-table="rt" data-field="x_nama" name="frtgrid$o<?php echo $rt_grid->RowIndex ?>_nama" id="frtgrid$o<?php echo $rt_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rt_grid->nama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rt_grid->ListOptions->render("body", "right", $rt_grid->RowCount);
?>
	</tr>
<?php if ($rt->RowType == ROWTYPE_ADD || $rt->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["frtgrid", "load"], function() {
	frtgrid.updateLists(<?php echo $rt_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$rt_grid->isGridAdd() || $rt->CurrentMode == "copy")
		if (!$rt_grid->Recordset->EOF)
			$rt_grid->Recordset->moveNext();
}
?>
<?php
	if ($rt->CurrentMode == "add" || $rt->CurrentMode == "copy" || $rt->CurrentMode == "edit") {
		$rt_grid->RowIndex = '$rowindex$';
		$rt_grid->loadRowValues();

		// Set row properties
		$rt->resetAttributes();
		$rt->RowAttrs->merge(["data-rowindex" => $rt_grid->RowIndex, "id" => "r0_rt", "data-rowtype" => ROWTYPE_ADD]);
		$rt->RowAttrs->appendClass("ew-template");
		$rt->RowType = ROWTYPE_ADD;

		// Render row
		$rt_grid->renderRow();

		// Render list options
		$rt_grid->renderListOptions();
		$rt_grid->StartRowCount = 0;
?>
	<tr <?php echo $rt->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rt_grid->ListOptions->render("body", "left", $rt_grid->RowIndex);
?>
	<?php if ($rt_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$rt->isConfirm()) { ?>
<span id="el$rowindex$_rt_id" class="form-group rt_id"></span>
<?php } else { ?>
<span id="el$rowindex$_rt_id" class="form-group rt_id">
<span<?php echo $rt_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rt_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="rt" data-field="x_id" name="x<?php echo $rt_grid->RowIndex ?>_id" id="x<?php echo $rt_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rt_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rt" data-field="x_id" name="o<?php echo $rt_grid->RowIndex ?>_id" id="o<?php echo $rt_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($rt_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rt_grid->rw_id->Visible) { // rw_id ?>
		<td data-name="rw_id">
<?php if (!$rt->isConfirm()) { ?>
<?php if ($rt_grid->rw_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_rt_rw_id" class="form-group rt_rw_id">
<span<?php echo $rt_grid->rw_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rt_grid->rw_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $rt_grid->RowIndex ?>_rw_id" name="x<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_grid->rw_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_rt_rw_id" class="form-group rt_rw_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $rt_grid->RowIndex ?>_rw_id"><?php echo EmptyValue(strval($rt_grid->rw_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $rt_grid->rw_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rt_grid->rw_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rt_grid->rw_id->ReadOnly || $rt_grid->rw_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $rt_grid->RowIndex ?>_rw_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rt_grid->rw_id->Lookup->getParamTag($rt_grid, "p_x" . $rt_grid->RowIndex . "_rw_id") ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rt_grid->rw_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $rt_grid->RowIndex ?>_rw_id" id="x<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo $rt_grid->rw_id->CurrentValue ?>"<?php echo $rt_grid->rw_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_rt_rw_id" class="form-group rt_rw_id">
<span<?php echo $rt_grid->rw_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rt_grid->rw_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="rt" data-field="x_rw_id" name="x<?php echo $rt_grid->RowIndex ?>_rw_id" id="x<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_grid->rw_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rt" data-field="x_rw_id" name="o<?php echo $rt_grid->RowIndex ?>_rw_id" id="o<?php echo $rt_grid->RowIndex ?>_rw_id" value="<?php echo HtmlEncode($rt_grid->rw_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rt_grid->nama->Visible) { // nama ?>
		<td data-name="nama">
<?php if (!$rt->isConfirm()) { ?>
<span id="el$rowindex$_rt_nama" class="form-group rt_nama">
<input type="text" data-table="rt" data-field="x_nama" name="x<?php echo $rt_grid->RowIndex ?>_nama" id="x<?php echo $rt_grid->RowIndex ?>_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($rt_grid->nama->getPlaceHolder()) ?>" value="<?php echo $rt_grid->nama->EditValue ?>"<?php echo $rt_grid->nama->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_rt_nama" class="form-group rt_nama">
<span<?php echo $rt_grid->nama->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($rt_grid->nama->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="rt" data-field="x_nama" name="x<?php echo $rt_grid->RowIndex ?>_nama" id="x<?php echo $rt_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rt_grid->nama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rt" data-field="x_nama" name="o<?php echo $rt_grid->RowIndex ?>_nama" id="o<?php echo $rt_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($rt_grid->nama->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rt_grid->ListOptions->render("body", "right", $rt_grid->RowIndex);
?>
<script>
loadjs.ready(["frtgrid", "load"], function() {
	frtgrid.updateLists(<?php echo $rt_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($rt->CurrentMode == "add" || $rt->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $rt_grid->FormKeyCountName ?>" id="<?php echo $rt_grid->FormKeyCountName ?>" value="<?php echo $rt_grid->KeyCount ?>">
<?php echo $rt_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($rt->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $rt_grid->FormKeyCountName ?>" id="<?php echo $rt_grid->FormKeyCountName ?>" value="<?php echo $rt_grid->KeyCount ?>">
<?php echo $rt_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($rt->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="frtgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($rt_grid->Recordset)
	$rt_grid->Recordset->Close();
?>
<?php if ($rt_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $rt_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($rt_grid->TotalRecords == 0 && !$rt->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $rt_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$rt_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$rt_grid->terminate();
?>