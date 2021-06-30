<?php
namespace PHPMaker2020\bansos;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($bantuan_grid))
	$bantuan_grid = new bantuan_grid();

// Run the page
$bantuan_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bantuan_grid->Page_Render();
?>
<?php if (!$bantuan_grid->isExport()) { ?>
<script>
var fbantuangrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fbantuangrid = new ew.Form("fbantuangrid", "grid");
	fbantuangrid.formKeyCountName = '<?php echo $bantuan_grid->FormKeyCountName ?>';

	// Validate form
	fbantuangrid.validate = function() {
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
			<?php if ($bantuan_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bantuan_grid->id->caption(), $bantuan_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bantuan_grid->bansos_id->Required) { ?>
				elm = this.getElements("x" + infix + "_bansos_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bantuan_grid->bansos_id->caption(), $bantuan_grid->bansos_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bantuan_grid->warga_id->Required) { ?>
				elm = this.getElements("x" + infix + "_warga_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bantuan_grid->warga_id->caption(), $bantuan_grid->warga_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bantuan_grid->na->Required) { ?>
				elm = this.getElements("x" + infix + "_na");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bantuan_grid->na->caption(), $bantuan_grid->na->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fbantuangrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "bansos_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "warga_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "na", true)) return false;
		return true;
	}

	// Form_CustomValidate
	fbantuangrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbantuangrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbantuangrid.lists["x_bansos_id"] = <?php echo $bantuan_grid->bansos_id->Lookup->toClientList($bantuan_grid) ?>;
	fbantuangrid.lists["x_bansos_id"].options = <?php echo JsonEncode($bantuan_grid->bansos_id->lookupOptions()) ?>;
	fbantuangrid.lists["x_warga_id"] = <?php echo $bantuan_grid->warga_id->Lookup->toClientList($bantuan_grid) ?>;
	fbantuangrid.lists["x_warga_id"].options = <?php echo JsonEncode($bantuan_grid->warga_id->lookupOptions()) ?>;
	fbantuangrid.lists["x_na"] = <?php echo $bantuan_grid->na->Lookup->toClientList($bantuan_grid) ?>;
	fbantuangrid.lists["x_na"].options = <?php echo JsonEncode($bantuan_grid->na->options(FALSE, TRUE)) ?>;
	loadjs.done("fbantuangrid");
});
</script>
<?php } ?>
<?php
$bantuan_grid->renderOtherOptions();
?>
<?php if ($bantuan_grid->TotalRecords > 0 || $bantuan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bantuan_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bantuan">
<?php if ($bantuan_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $bantuan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fbantuangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_bantuan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_bantuangrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bantuan->RowType = ROWTYPE_HEADER;

// Render list options
$bantuan_grid->renderListOptions();

// Render list options (header, left)
$bantuan_grid->ListOptions->render("header", "left");
?>
<?php if ($bantuan_grid->id->Visible) { // id ?>
	<?php if ($bantuan_grid->SortUrl($bantuan_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $bantuan_grid->id->headerCellClass() ?>"><div id="elh_bantuan_id" class="bantuan_id"><div class="ew-table-header-caption"><?php echo $bantuan_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $bantuan_grid->id->headerCellClass() ?>"><div><div id="elh_bantuan_id" class="bantuan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bantuan_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($bantuan_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bantuan_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bantuan_grid->bansos_id->Visible) { // bansos_id ?>
	<?php if ($bantuan_grid->SortUrl($bantuan_grid->bansos_id) == "") { ?>
		<th data-name="bansos_id" class="<?php echo $bantuan_grid->bansos_id->headerCellClass() ?>"><div id="elh_bantuan_bansos_id" class="bantuan_bansos_id"><div class="ew-table-header-caption"><?php echo $bantuan_grid->bansos_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bansos_id" class="<?php echo $bantuan_grid->bansos_id->headerCellClass() ?>"><div><div id="elh_bantuan_bansos_id" class="bantuan_bansos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bantuan_grid->bansos_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($bantuan_grid->bansos_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bantuan_grid->bansos_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bantuan_grid->warga_id->Visible) { // warga_id ?>
	<?php if ($bantuan_grid->SortUrl($bantuan_grid->warga_id) == "") { ?>
		<th data-name="warga_id" class="<?php echo $bantuan_grid->warga_id->headerCellClass() ?>"><div id="elh_bantuan_warga_id" class="bantuan_warga_id"><div class="ew-table-header-caption"><?php echo $bantuan_grid->warga_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="warga_id" class="<?php echo $bantuan_grid->warga_id->headerCellClass() ?>"><div><div id="elh_bantuan_warga_id" class="bantuan_warga_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bantuan_grid->warga_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($bantuan_grid->warga_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bantuan_grid->warga_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bantuan_grid->na->Visible) { // na ?>
	<?php if ($bantuan_grid->SortUrl($bantuan_grid->na) == "") { ?>
		<th data-name="na" class="<?php echo $bantuan_grid->na->headerCellClass() ?>"><div id="elh_bantuan_na" class="bantuan_na"><div class="ew-table-header-caption"><?php echo $bantuan_grid->na->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="na" class="<?php echo $bantuan_grid->na->headerCellClass() ?>"><div><div id="elh_bantuan_na" class="bantuan_na">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bantuan_grid->na->caption() ?></span><span class="ew-table-header-sort"><?php if ($bantuan_grid->na->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bantuan_grid->na->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bantuan_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$bantuan_grid->StartRecord = 1;
$bantuan_grid->StopRecord = $bantuan_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($bantuan->isConfirm() || $bantuan_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($bantuan_grid->FormKeyCountName) && ($bantuan_grid->isGridAdd() || $bantuan_grid->isGridEdit() || $bantuan->isConfirm())) {
		$bantuan_grid->KeyCount = $CurrentForm->getValue($bantuan_grid->FormKeyCountName);
		$bantuan_grid->StopRecord = $bantuan_grid->StartRecord + $bantuan_grid->KeyCount - 1;
	}
}
$bantuan_grid->RecordCount = $bantuan_grid->StartRecord - 1;
if ($bantuan_grid->Recordset && !$bantuan_grid->Recordset->EOF) {
	$bantuan_grid->Recordset->moveFirst();
	$selectLimit = $bantuan_grid->UseSelectLimit;
	if (!$selectLimit && $bantuan_grid->StartRecord > 1)
		$bantuan_grid->Recordset->move($bantuan_grid->StartRecord - 1);
} elseif (!$bantuan->AllowAddDeleteRow && $bantuan_grid->StopRecord == 0) {
	$bantuan_grid->StopRecord = $bantuan->GridAddRowCount;
}

// Initialize aggregate
$bantuan->RowType = ROWTYPE_AGGREGATEINIT;
$bantuan->resetAttributes();
$bantuan_grid->renderRow();
if ($bantuan_grid->isGridAdd())
	$bantuan_grid->RowIndex = 0;
if ($bantuan_grid->isGridEdit())
	$bantuan_grid->RowIndex = 0;
while ($bantuan_grid->RecordCount < $bantuan_grid->StopRecord) {
	$bantuan_grid->RecordCount++;
	if ($bantuan_grid->RecordCount >= $bantuan_grid->StartRecord) {
		$bantuan_grid->RowCount++;
		if ($bantuan_grid->isGridAdd() || $bantuan_grid->isGridEdit() || $bantuan->isConfirm()) {
			$bantuan_grid->RowIndex++;
			$CurrentForm->Index = $bantuan_grid->RowIndex;
			if ($CurrentForm->hasValue($bantuan_grid->FormActionName) && ($bantuan->isConfirm() || $bantuan_grid->EventCancelled))
				$bantuan_grid->RowAction = strval($CurrentForm->getValue($bantuan_grid->FormActionName));
			elseif ($bantuan_grid->isGridAdd())
				$bantuan_grid->RowAction = "insert";
			else
				$bantuan_grid->RowAction = "";
		}

		// Set up key count
		$bantuan_grid->KeyCount = $bantuan_grid->RowIndex;

		// Init row class and style
		$bantuan->resetAttributes();
		$bantuan->CssClass = "";
		if ($bantuan_grid->isGridAdd()) {
			if ($bantuan->CurrentMode == "copy") {
				$bantuan_grid->loadRowValues($bantuan_grid->Recordset); // Load row values
				$bantuan_grid->setRecordKey($bantuan_grid->RowOldKey, $bantuan_grid->Recordset); // Set old record key
			} else {
				$bantuan_grid->loadRowValues(); // Load default values
				$bantuan_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$bantuan_grid->loadRowValues($bantuan_grid->Recordset); // Load row values
		}
		$bantuan->RowType = ROWTYPE_VIEW; // Render view
		if ($bantuan_grid->isGridAdd()) // Grid add
			$bantuan->RowType = ROWTYPE_ADD; // Render add
		if ($bantuan_grid->isGridAdd() && $bantuan->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$bantuan_grid->restoreCurrentRowFormValues($bantuan_grid->RowIndex); // Restore form values
		if ($bantuan_grid->isGridEdit()) { // Grid edit
			if ($bantuan->EventCancelled)
				$bantuan_grid->restoreCurrentRowFormValues($bantuan_grid->RowIndex); // Restore form values
			if ($bantuan_grid->RowAction == "insert")
				$bantuan->RowType = ROWTYPE_ADD; // Render add
			else
				$bantuan->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($bantuan_grid->isGridEdit() && ($bantuan->RowType == ROWTYPE_EDIT || $bantuan->RowType == ROWTYPE_ADD) && $bantuan->EventCancelled) // Update failed
			$bantuan_grid->restoreCurrentRowFormValues($bantuan_grid->RowIndex); // Restore form values
		if ($bantuan->RowType == ROWTYPE_EDIT) // Edit row
			$bantuan_grid->EditRowCount++;
		if ($bantuan->isConfirm()) // Confirm row
			$bantuan_grid->restoreCurrentRowFormValues($bantuan_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$bantuan->RowAttrs->merge(["data-rowindex" => $bantuan_grid->RowCount, "id" => "r" . $bantuan_grid->RowCount . "_bantuan", "data-rowtype" => $bantuan->RowType]);

		// Render row
		$bantuan_grid->renderRow();

		// Render list options
		$bantuan_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($bantuan_grid->RowAction != "delete" && $bantuan_grid->RowAction != "insertdelete" && !($bantuan_grid->RowAction == "insert" && $bantuan->isConfirm() && $bantuan_grid->emptyRow())) {
?>
	<tr <?php echo $bantuan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bantuan_grid->ListOptions->render("body", "left", $bantuan_grid->RowCount);
?>
	<?php if ($bantuan_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $bantuan_grid->id->cellAttributes() ?>>
<?php if ($bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_id" class="form-group"></span>
<input type="hidden" data-table="bantuan" data-field="x_id" name="o<?php echo $bantuan_grid->RowIndex ?>_id" id="o<?php echo $bantuan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($bantuan_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($bantuan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_id" class="form-group">
<span<?php echo $bantuan_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bantuan_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="bantuan" data-field="x_id" name="x<?php echo $bantuan_grid->RowIndex ?>_id" id="x<?php echo $bantuan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($bantuan_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_id">
<span<?php echo $bantuan_grid->id->viewAttributes() ?>><?php echo $bantuan_grid->id->getViewValue() ?></span>
</span>
<?php if (!$bantuan->isConfirm()) { ?>
<input type="hidden" data-table="bantuan" data-field="x_id" name="x<?php echo $bantuan_grid->RowIndex ?>_id" id="x<?php echo $bantuan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($bantuan_grid->id->FormValue) ?>">
<input type="hidden" data-table="bantuan" data-field="x_id" name="o<?php echo $bantuan_grid->RowIndex ?>_id" id="o<?php echo $bantuan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($bantuan_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bantuan" data-field="x_id" name="fbantuangrid$x<?php echo $bantuan_grid->RowIndex ?>_id" id="fbantuangrid$x<?php echo $bantuan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($bantuan_grid->id->FormValue) ?>">
<input type="hidden" data-table="bantuan" data-field="x_id" name="fbantuangrid$o<?php echo $bantuan_grid->RowIndex ?>_id" id="fbantuangrid$o<?php echo $bantuan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($bantuan_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bantuan_grid->bansos_id->Visible) { // bansos_id ?>
		<td data-name="bansos_id" <?php echo $bantuan_grid->bansos_id->cellAttributes() ?>>
<?php if ($bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($bantuan_grid->bansos_id->getSessionValue() != "") { ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_bansos_id" class="form-group">
<span<?php echo $bantuan_grid->bansos_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bantuan_grid->bansos_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" name="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo HtmlEncode($bantuan_grid->bansos_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_bansos_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $bantuan_grid->RowIndex ?>_bansos_id"><?php echo EmptyValue(strval($bantuan_grid->bansos_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $bantuan_grid->bansos_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bantuan_grid->bansos_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($bantuan_grid->bansos_id->ReadOnly || $bantuan_grid->bansos_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $bantuan_grid->RowIndex ?>_bansos_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $bantuan_grid->bansos_id->Lookup->getParamTag($bantuan_grid, "p_x" . $bantuan_grid->RowIndex . "_bansos_id") ?>
<input type="hidden" data-table="bantuan" data-field="x_bansos_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bantuan_grid->bansos_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" id="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo $bantuan_grid->bansos_id->CurrentValue ?>"<?php echo $bantuan_grid->bansos_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="bantuan" data-field="x_bansos_id" name="o<?php echo $bantuan_grid->RowIndex ?>_bansos_id" id="o<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo HtmlEncode($bantuan_grid->bansos_id->OldValue) ?>">
<?php } ?>
<?php if ($bantuan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($bantuan_grid->bansos_id->getSessionValue() != "") { ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_bansos_id" class="form-group">
<span<?php echo $bantuan_grid->bansos_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bantuan_grid->bansos_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" name="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo HtmlEncode($bantuan_grid->bansos_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_bansos_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $bantuan_grid->RowIndex ?>_bansos_id"><?php echo EmptyValue(strval($bantuan_grid->bansos_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $bantuan_grid->bansos_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bantuan_grid->bansos_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($bantuan_grid->bansos_id->ReadOnly || $bantuan_grid->bansos_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $bantuan_grid->RowIndex ?>_bansos_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $bantuan_grid->bansos_id->Lookup->getParamTag($bantuan_grid, "p_x" . $bantuan_grid->RowIndex . "_bansos_id") ?>
<input type="hidden" data-table="bantuan" data-field="x_bansos_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bantuan_grid->bansos_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" id="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo $bantuan_grid->bansos_id->CurrentValue ?>"<?php echo $bantuan_grid->bansos_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_bansos_id">
<span<?php echo $bantuan_grid->bansos_id->viewAttributes() ?>><?php echo $bantuan_grid->bansos_id->getViewValue() ?></span>
</span>
<?php if (!$bantuan->isConfirm()) { ?>
<input type="hidden" data-table="bantuan" data-field="x_bansos_id" name="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" id="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo HtmlEncode($bantuan_grid->bansos_id->FormValue) ?>">
<input type="hidden" data-table="bantuan" data-field="x_bansos_id" name="o<?php echo $bantuan_grid->RowIndex ?>_bansos_id" id="o<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo HtmlEncode($bantuan_grid->bansos_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bantuan" data-field="x_bansos_id" name="fbantuangrid$x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" id="fbantuangrid$x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo HtmlEncode($bantuan_grid->bansos_id->FormValue) ?>">
<input type="hidden" data-table="bantuan" data-field="x_bansos_id" name="fbantuangrid$o<?php echo $bantuan_grid->RowIndex ?>_bansos_id" id="fbantuangrid$o<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo HtmlEncode($bantuan_grid->bansos_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bantuan_grid->warga_id->Visible) { // warga_id ?>
		<td data-name="warga_id" <?php echo $bantuan_grid->warga_id->cellAttributes() ?>>
<?php if ($bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_warga_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $bantuan_grid->RowIndex ?>_warga_id"><?php echo EmptyValue(strval($bantuan_grid->warga_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $bantuan_grid->warga_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bantuan_grid->warga_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($bantuan_grid->warga_id->ReadOnly || $bantuan_grid->warga_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $bantuan_grid->RowIndex ?>_warga_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $bantuan_grid->warga_id->Lookup->getParamTag($bantuan_grid, "p_x" . $bantuan_grid->RowIndex . "_warga_id") ?>
<input type="hidden" data-table="bantuan" data-field="x_warga_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bantuan_grid->warga_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $bantuan_grid->RowIndex ?>_warga_id" id="x<?php echo $bantuan_grid->RowIndex ?>_warga_id" value="<?php echo $bantuan_grid->warga_id->CurrentValue ?>"<?php echo $bantuan_grid->warga_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="bantuan" data-field="x_warga_id" name="o<?php echo $bantuan_grid->RowIndex ?>_warga_id" id="o<?php echo $bantuan_grid->RowIndex ?>_warga_id" value="<?php echo HtmlEncode($bantuan_grid->warga_id->OldValue) ?>">
<?php } ?>
<?php if ($bantuan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_warga_id" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $bantuan_grid->RowIndex ?>_warga_id"><?php echo EmptyValue(strval($bantuan_grid->warga_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $bantuan_grid->warga_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bantuan_grid->warga_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($bantuan_grid->warga_id->ReadOnly || $bantuan_grid->warga_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $bantuan_grid->RowIndex ?>_warga_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $bantuan_grid->warga_id->Lookup->getParamTag($bantuan_grid, "p_x" . $bantuan_grid->RowIndex . "_warga_id") ?>
<input type="hidden" data-table="bantuan" data-field="x_warga_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bantuan_grid->warga_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $bantuan_grid->RowIndex ?>_warga_id" id="x<?php echo $bantuan_grid->RowIndex ?>_warga_id" value="<?php echo $bantuan_grid->warga_id->CurrentValue ?>"<?php echo $bantuan_grid->warga_id->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_warga_id">
<span<?php echo $bantuan_grid->warga_id->viewAttributes() ?>><?php echo $bantuan_grid->warga_id->getViewValue() ?></span>
</span>
<?php if (!$bantuan->isConfirm()) { ?>
<input type="hidden" data-table="bantuan" data-field="x_warga_id" name="x<?php echo $bantuan_grid->RowIndex ?>_warga_id" id="x<?php echo $bantuan_grid->RowIndex ?>_warga_id" value="<?php echo HtmlEncode($bantuan_grid->warga_id->FormValue) ?>">
<input type="hidden" data-table="bantuan" data-field="x_warga_id" name="o<?php echo $bantuan_grid->RowIndex ?>_warga_id" id="o<?php echo $bantuan_grid->RowIndex ?>_warga_id" value="<?php echo HtmlEncode($bantuan_grid->warga_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bantuan" data-field="x_warga_id" name="fbantuangrid$x<?php echo $bantuan_grid->RowIndex ?>_warga_id" id="fbantuangrid$x<?php echo $bantuan_grid->RowIndex ?>_warga_id" value="<?php echo HtmlEncode($bantuan_grid->warga_id->FormValue) ?>">
<input type="hidden" data-table="bantuan" data-field="x_warga_id" name="fbantuangrid$o<?php echo $bantuan_grid->RowIndex ?>_warga_id" id="fbantuangrid$o<?php echo $bantuan_grid->RowIndex ?>_warga_id" value="<?php echo HtmlEncode($bantuan_grid->warga_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($bantuan_grid->na->Visible) { // na ?>
		<td data-name="na" <?php echo $bantuan_grid->na->cellAttributes() ?>>
<?php if ($bantuan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_na" class="form-group">
<div id="tp_x<?php echo $bantuan_grid->RowIndex ?>_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="bantuan" data-field="x_na" data-value-separator="<?php echo $bantuan_grid->na->displayValueSeparatorAttribute() ?>" name="x<?php echo $bantuan_grid->RowIndex ?>_na" id="x<?php echo $bantuan_grid->RowIndex ?>_na" value="{value}"<?php echo $bantuan_grid->na->editAttributes() ?>></div>
<div id="dsl_x<?php echo $bantuan_grid->RowIndex ?>_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $bantuan_grid->na->radioButtonListHtml(FALSE, "x{$bantuan_grid->RowIndex}_na") ?>
</div></div>
</span>
<input type="hidden" data-table="bantuan" data-field="x_na" name="o<?php echo $bantuan_grid->RowIndex ?>_na" id="o<?php echo $bantuan_grid->RowIndex ?>_na" value="<?php echo HtmlEncode($bantuan_grid->na->OldValue) ?>">
<?php } ?>
<?php if ($bantuan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_na" class="form-group">
<div id="tp_x<?php echo $bantuan_grid->RowIndex ?>_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="bantuan" data-field="x_na" data-value-separator="<?php echo $bantuan_grid->na->displayValueSeparatorAttribute() ?>" name="x<?php echo $bantuan_grid->RowIndex ?>_na" id="x<?php echo $bantuan_grid->RowIndex ?>_na" value="{value}"<?php echo $bantuan_grid->na->editAttributes() ?>></div>
<div id="dsl_x<?php echo $bantuan_grid->RowIndex ?>_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $bantuan_grid->na->radioButtonListHtml(FALSE, "x{$bantuan_grid->RowIndex}_na") ?>
</div></div>
</span>
<?php } ?>
<?php if ($bantuan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $bantuan_grid->RowCount ?>_bantuan_na">
<span<?php echo $bantuan_grid->na->viewAttributes() ?>><?php echo $bantuan_grid->na->getViewValue() ?></span>
</span>
<?php if (!$bantuan->isConfirm()) { ?>
<input type="hidden" data-table="bantuan" data-field="x_na" name="x<?php echo $bantuan_grid->RowIndex ?>_na" id="x<?php echo $bantuan_grid->RowIndex ?>_na" value="<?php echo HtmlEncode($bantuan_grid->na->FormValue) ?>">
<input type="hidden" data-table="bantuan" data-field="x_na" name="o<?php echo $bantuan_grid->RowIndex ?>_na" id="o<?php echo $bantuan_grid->RowIndex ?>_na" value="<?php echo HtmlEncode($bantuan_grid->na->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="bantuan" data-field="x_na" name="fbantuangrid$x<?php echo $bantuan_grid->RowIndex ?>_na" id="fbantuangrid$x<?php echo $bantuan_grid->RowIndex ?>_na" value="<?php echo HtmlEncode($bantuan_grid->na->FormValue) ?>">
<input type="hidden" data-table="bantuan" data-field="x_na" name="fbantuangrid$o<?php echo $bantuan_grid->RowIndex ?>_na" id="fbantuangrid$o<?php echo $bantuan_grid->RowIndex ?>_na" value="<?php echo HtmlEncode($bantuan_grid->na->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bantuan_grid->ListOptions->render("body", "right", $bantuan_grid->RowCount);
?>
	</tr>
<?php if ($bantuan->RowType == ROWTYPE_ADD || $bantuan->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fbantuangrid", "load"], function() {
	fbantuangrid.updateLists(<?php echo $bantuan_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$bantuan_grid->isGridAdd() || $bantuan->CurrentMode == "copy")
		if (!$bantuan_grid->Recordset->EOF)
			$bantuan_grid->Recordset->moveNext();
}
?>
<?php
	if ($bantuan->CurrentMode == "add" || $bantuan->CurrentMode == "copy" || $bantuan->CurrentMode == "edit") {
		$bantuan_grid->RowIndex = '$rowindex$';
		$bantuan_grid->loadRowValues();

		// Set row properties
		$bantuan->resetAttributes();
		$bantuan->RowAttrs->merge(["data-rowindex" => $bantuan_grid->RowIndex, "id" => "r0_bantuan", "data-rowtype" => ROWTYPE_ADD]);
		$bantuan->RowAttrs->appendClass("ew-template");
		$bantuan->RowType = ROWTYPE_ADD;

		// Render row
		$bantuan_grid->renderRow();

		// Render list options
		$bantuan_grid->renderListOptions();
		$bantuan_grid->StartRowCount = 0;
?>
	<tr <?php echo $bantuan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bantuan_grid->ListOptions->render("body", "left", $bantuan_grid->RowIndex);
?>
	<?php if ($bantuan_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$bantuan->isConfirm()) { ?>
<span id="el$rowindex$_bantuan_id" class="form-group bantuan_id"></span>
<?php } else { ?>
<span id="el$rowindex$_bantuan_id" class="form-group bantuan_id">
<span<?php echo $bantuan_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bantuan_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bantuan" data-field="x_id" name="x<?php echo $bantuan_grid->RowIndex ?>_id" id="x<?php echo $bantuan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($bantuan_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bantuan" data-field="x_id" name="o<?php echo $bantuan_grid->RowIndex ?>_id" id="o<?php echo $bantuan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($bantuan_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bantuan_grid->bansos_id->Visible) { // bansos_id ?>
		<td data-name="bansos_id">
<?php if (!$bantuan->isConfirm()) { ?>
<?php if ($bantuan_grid->bansos_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_bantuan_bansos_id" class="form-group bantuan_bansos_id">
<span<?php echo $bantuan_grid->bansos_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bantuan_grid->bansos_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" name="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo HtmlEncode($bantuan_grid->bansos_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_bantuan_bansos_id" class="form-group bantuan_bansos_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $bantuan_grid->RowIndex ?>_bansos_id"><?php echo EmptyValue(strval($bantuan_grid->bansos_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $bantuan_grid->bansos_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bantuan_grid->bansos_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($bantuan_grid->bansos_id->ReadOnly || $bantuan_grid->bansos_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $bantuan_grid->RowIndex ?>_bansos_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $bantuan_grid->bansos_id->Lookup->getParamTag($bantuan_grid, "p_x" . $bantuan_grid->RowIndex . "_bansos_id") ?>
<input type="hidden" data-table="bantuan" data-field="x_bansos_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bantuan_grid->bansos_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" id="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo $bantuan_grid->bansos_id->CurrentValue ?>"<?php echo $bantuan_grid->bansos_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_bantuan_bansos_id" class="form-group bantuan_bansos_id">
<span<?php echo $bantuan_grid->bansos_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bantuan_grid->bansos_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bantuan" data-field="x_bansos_id" name="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" id="x<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo HtmlEncode($bantuan_grid->bansos_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bantuan" data-field="x_bansos_id" name="o<?php echo $bantuan_grid->RowIndex ?>_bansos_id" id="o<?php echo $bantuan_grid->RowIndex ?>_bansos_id" value="<?php echo HtmlEncode($bantuan_grid->bansos_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bantuan_grid->warga_id->Visible) { // warga_id ?>
		<td data-name="warga_id">
<?php if (!$bantuan->isConfirm()) { ?>
<span id="el$rowindex$_bantuan_warga_id" class="form-group bantuan_warga_id">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $bantuan_grid->RowIndex ?>_warga_id"><?php echo EmptyValue(strval($bantuan_grid->warga_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $bantuan_grid->warga_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bantuan_grid->warga_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($bantuan_grid->warga_id->ReadOnly || $bantuan_grid->warga_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $bantuan_grid->RowIndex ?>_warga_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $bantuan_grid->warga_id->Lookup->getParamTag($bantuan_grid, "p_x" . $bantuan_grid->RowIndex . "_warga_id") ?>
<input type="hidden" data-table="bantuan" data-field="x_warga_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bantuan_grid->warga_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $bantuan_grid->RowIndex ?>_warga_id" id="x<?php echo $bantuan_grid->RowIndex ?>_warga_id" value="<?php echo $bantuan_grid->warga_id->CurrentValue ?>"<?php echo $bantuan_grid->warga_id->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_bantuan_warga_id" class="form-group bantuan_warga_id">
<span<?php echo $bantuan_grid->warga_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bantuan_grid->warga_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bantuan" data-field="x_warga_id" name="x<?php echo $bantuan_grid->RowIndex ?>_warga_id" id="x<?php echo $bantuan_grid->RowIndex ?>_warga_id" value="<?php echo HtmlEncode($bantuan_grid->warga_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bantuan" data-field="x_warga_id" name="o<?php echo $bantuan_grid->RowIndex ?>_warga_id" id="o<?php echo $bantuan_grid->RowIndex ?>_warga_id" value="<?php echo HtmlEncode($bantuan_grid->warga_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($bantuan_grid->na->Visible) { // na ?>
		<td data-name="na">
<?php if (!$bantuan->isConfirm()) { ?>
<span id="el$rowindex$_bantuan_na" class="form-group bantuan_na">
<div id="tp_x<?php echo $bantuan_grid->RowIndex ?>_na" class="ew-template"><input type="radio" class="custom-control-input" data-table="bantuan" data-field="x_na" data-value-separator="<?php echo $bantuan_grid->na->displayValueSeparatorAttribute() ?>" name="x<?php echo $bantuan_grid->RowIndex ?>_na" id="x<?php echo $bantuan_grid->RowIndex ?>_na" value="{value}"<?php echo $bantuan_grid->na->editAttributes() ?>></div>
<div id="dsl_x<?php echo $bantuan_grid->RowIndex ?>_na" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $bantuan_grid->na->radioButtonListHtml(FALSE, "x{$bantuan_grid->RowIndex}_na") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_bantuan_na" class="form-group bantuan_na">
<span<?php echo $bantuan_grid->na->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bantuan_grid->na->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="bantuan" data-field="x_na" name="x<?php echo $bantuan_grid->RowIndex ?>_na" id="x<?php echo $bantuan_grid->RowIndex ?>_na" value="<?php echo HtmlEncode($bantuan_grid->na->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="bantuan" data-field="x_na" name="o<?php echo $bantuan_grid->RowIndex ?>_na" id="o<?php echo $bantuan_grid->RowIndex ?>_na" value="<?php echo HtmlEncode($bantuan_grid->na->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bantuan_grid->ListOptions->render("body", "right", $bantuan_grid->RowIndex);
?>
<script>
loadjs.ready(["fbantuangrid", "load"], function() {
	fbantuangrid.updateLists(<?php echo $bantuan_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($bantuan->CurrentMode == "add" || $bantuan->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $bantuan_grid->FormKeyCountName ?>" id="<?php echo $bantuan_grid->FormKeyCountName ?>" value="<?php echo $bantuan_grid->KeyCount ?>">
<?php echo $bantuan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($bantuan->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $bantuan_grid->FormKeyCountName ?>" id="<?php echo $bantuan_grid->FormKeyCountName ?>" value="<?php echo $bantuan_grid->KeyCount ?>">
<?php echo $bantuan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($bantuan->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fbantuangrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bantuan_grid->Recordset)
	$bantuan_grid->Recordset->Close();
?>
<?php if ($bantuan_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $bantuan_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bantuan_grid->TotalRecords == 0 && !$bantuan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bantuan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$bantuan_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$bantuan_grid->terminate();
?>