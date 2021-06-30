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
$rt_preview = new rt_preview();

// Run the page
$rt_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rt_preview->Page_Render();
?>
<?php $rt_preview->showPageHeader(); ?>
<?php if ($rt_preview->TotalRecords > 0) { ?>
<div class="card ew-grid rt"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$rt_preview->renderListOptions();

// Render list options (header, left)
$rt_preview->ListOptions->render("header", "left");
?>
<?php if ($rt_preview->id->Visible) { // id ?>
	<?php if ($rt->SortUrl($rt_preview->id) == "") { ?>
		<th class="<?php echo $rt_preview->id->headerCellClass() ?>"><?php echo $rt_preview->id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $rt_preview->id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($rt_preview->id->Name) ?>" data-sort-order="<?php echo $rt_preview->SortField == $rt_preview->id->Name && $rt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rt_preview->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rt_preview->SortField == $rt_preview->id->Name) { ?><?php if ($rt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rt_preview->rw_id->Visible) { // rw_id ?>
	<?php if ($rt->SortUrl($rt_preview->rw_id) == "") { ?>
		<th class="<?php echo $rt_preview->rw_id->headerCellClass() ?>"><?php echo $rt_preview->rw_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $rt_preview->rw_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($rt_preview->rw_id->Name) ?>" data-sort-order="<?php echo $rt_preview->SortField == $rt_preview->rw_id->Name && $rt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rt_preview->rw_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($rt_preview->SortField == $rt_preview->rw_id->Name) { ?><?php if ($rt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rt_preview->nama->Visible) { // nama ?>
	<?php if ($rt->SortUrl($rt_preview->nama) == "") { ?>
		<th class="<?php echo $rt_preview->nama->headerCellClass() ?>"><?php echo $rt_preview->nama->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $rt_preview->nama->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($rt_preview->nama->Name) ?>" data-sort-order="<?php echo $rt_preview->SortField == $rt_preview->nama->Name && $rt_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rt_preview->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($rt_preview->SortField == $rt_preview->nama->Name) { ?><?php if ($rt_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rt_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rt_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$rt_preview->RecCount = 0;
$rt_preview->RowCount = 0;
while ($rt_preview->Recordset && !$rt_preview->Recordset->EOF) {

	// Init row class and style
	$rt_preview->RecCount++;
	$rt_preview->RowCount++;
	$rt_preview->CssStyle = "";
	$rt_preview->loadListRowValues($rt_preview->Recordset);

	// Render row
	$rt->RowType = ROWTYPE_PREVIEW; // Preview record
	$rt_preview->resetAttributes();
	$rt_preview->renderListRow();

	// Render list options
	$rt_preview->renderListOptions();
?>
	<tr <?php echo $rt->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rt_preview->ListOptions->render("body", "left", $rt_preview->RowCount);
?>
<?php if ($rt_preview->id->Visible) { // id ?>
		<!-- id -->
		<td<?php echo $rt_preview->id->cellAttributes() ?>>
<span<?php echo $rt_preview->id->viewAttributes() ?>><?php echo $rt_preview->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($rt_preview->rw_id->Visible) { // rw_id ?>
		<!-- rw_id -->
		<td<?php echo $rt_preview->rw_id->cellAttributes() ?>>
<span<?php echo $rt_preview->rw_id->viewAttributes() ?>><?php echo $rt_preview->rw_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($rt_preview->nama->Visible) { // nama ?>
		<!-- nama -->
		<td<?php echo $rt_preview->nama->cellAttributes() ?>>
<span<?php echo $rt_preview->nama->viewAttributes() ?>><?php echo $rt_preview->nama->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$rt_preview->ListOptions->render("body", "right", $rt_preview->RowCount);
?>
	</tr>
<?php
	$rt_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $rt_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($rt_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($rt_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$rt_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($rt_preview->Recordset)
	$rt_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$rt_preview->terminate();
?>