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
WriteHeader(FALSE, "utf-8");

// Create page object
$rw_preview = new rw_preview();

// Run the page
$rw_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rw_preview->Page_Render();
?>
<?php $rw_preview->showPageHeader(); ?>
<?php if ($rw_preview->TotalRecords > 0) { ?>
<div class="card ew-grid rw"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$rw_preview->renderListOptions();

// Render list options (header, left)
$rw_preview->ListOptions->render("header", "left");
?>
<?php if ($rw_preview->id->Visible) { // id ?>
	<?php if ($rw->SortUrl($rw_preview->id) == "") { ?>
		<th class="<?php echo $rw_preview->id->headerCellClass() ?>"><?php echo $rw_preview->id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $rw_preview->id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($rw_preview->id->Name) ?>" data-sort-order="<?php echo $rw_preview->SortField == $rw_preview->id->Name && $rw_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rw_preview->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rw_preview->SortField == $rw_preview->id->Name) { ?><?php if ($rw_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rw_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rw_preview->desa_id->Visible) { // desa_id ?>
	<?php if ($rw->SortUrl($rw_preview->desa_id) == "") { ?>
		<th class="<?php echo $rw_preview->desa_id->headerCellClass() ?>"><?php echo $rw_preview->desa_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $rw_preview->desa_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($rw_preview->desa_id->Name) ?>" data-sort-order="<?php echo $rw_preview->SortField == $rw_preview->desa_id->Name && $rw_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rw_preview->desa_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rw_preview->SortField == $rw_preview->desa_id->Name) { ?><?php if ($rw_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rw_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rw_preview->nama->Visible) { // nama ?>
	<?php if ($rw->SortUrl($rw_preview->nama) == "") { ?>
		<th class="<?php echo $rw_preview->nama->headerCellClass() ?>"><?php echo $rw_preview->nama->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $rw_preview->nama->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($rw_preview->nama->Name) ?>" data-sort-order="<?php echo $rw_preview->SortField == $rw_preview->nama->Name && $rw_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rw_preview->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($rw_preview->SortField == $rw_preview->nama->Name) { ?><?php if ($rw_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rw_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rw_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$rw_preview->RecCount = 0;
$rw_preview->RowCount = 0;
while ($rw_preview->Recordset && !$rw_preview->Recordset->EOF) {

	// Init row class and style
	$rw_preview->RecCount++;
	$rw_preview->RowCount++;
	$rw_preview->CssStyle = "";
	$rw_preview->loadListRowValues($rw_preview->Recordset);

	// Render row
	$rw->RowType = ROWTYPE_PREVIEW; // Preview record
	$rw_preview->resetAttributes();
	$rw_preview->renderListRow();

	// Render list options
	$rw_preview->renderListOptions();
?>
	<tr <?php echo $rw->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rw_preview->ListOptions->render("body", "left", $rw_preview->RowCount);
?>
<?php if ($rw_preview->id->Visible) { // id ?>
		<!-- id -->
		<td<?php echo $rw_preview->id->cellAttributes() ?>>
<span<?php echo $rw_preview->id->viewAttributes() ?>><?php echo $rw_preview->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($rw_preview->desa_id->Visible) { // desa_id ?>
		<!-- desa_id -->
		<td<?php echo $rw_preview->desa_id->cellAttributes() ?>>
<span<?php echo $rw_preview->desa_id->viewAttributes() ?>><?php echo $rw_preview->desa_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($rw_preview->nama->Visible) { // nama ?>
		<!-- nama -->
		<td<?php echo $rw_preview->nama->cellAttributes() ?>>
<span<?php echo $rw_preview->nama->viewAttributes() ?>><?php echo $rw_preview->nama->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$rw_preview->ListOptions->render("body", "right", $rw_preview->RowCount);
?>
	</tr>
<?php
	$rw_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $rw_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($rw_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($rw_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$rw_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($rw_preview->Recordset)
	$rw_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$rw_preview->terminate();
?>