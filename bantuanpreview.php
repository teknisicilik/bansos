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
$bantuan_preview = new bantuan_preview();

// Run the page
$bantuan_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bantuan_preview->Page_Render();
?>
<?php $bantuan_preview->showPageHeader(); ?>
<?php if ($bantuan_preview->TotalRecords > 0) { ?>
<div class="card ew-grid bantuan"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$bantuan_preview->renderListOptions();

// Render list options (header, left)
$bantuan_preview->ListOptions->render("header", "left");
?>
<?php if ($bantuan_preview->id->Visible) { // id ?>
	<?php if ($bantuan->SortUrl($bantuan_preview->id) == "") { ?>
		<th class="<?php echo $bantuan_preview->id->headerCellClass() ?>"><?php echo $bantuan_preview->id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bantuan_preview->id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bantuan_preview->id->Name) ?>" data-sort-order="<?php echo $bantuan_preview->SortField == $bantuan_preview->id->Name && $bantuan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bantuan_preview->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($bantuan_preview->SortField == $bantuan_preview->id->Name) { ?><?php if ($bantuan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bantuan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bantuan_preview->bansos_id->Visible) { // bansos_id ?>
	<?php if ($bantuan->SortUrl($bantuan_preview->bansos_id) == "") { ?>
		<th class="<?php echo $bantuan_preview->bansos_id->headerCellClass() ?>"><?php echo $bantuan_preview->bansos_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bantuan_preview->bansos_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bantuan_preview->bansos_id->Name) ?>" data-sort-order="<?php echo $bantuan_preview->SortField == $bantuan_preview->bansos_id->Name && $bantuan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bantuan_preview->bansos_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($bantuan_preview->SortField == $bantuan_preview->bansos_id->Name) { ?><?php if ($bantuan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bantuan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bantuan_preview->warga_id->Visible) { // warga_id ?>
	<?php if ($bantuan->SortUrl($bantuan_preview->warga_id) == "") { ?>
		<th class="<?php echo $bantuan_preview->warga_id->headerCellClass() ?>"><?php echo $bantuan_preview->warga_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bantuan_preview->warga_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bantuan_preview->warga_id->Name) ?>" data-sort-order="<?php echo $bantuan_preview->SortField == $bantuan_preview->warga_id->Name && $bantuan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bantuan_preview->warga_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($bantuan_preview->SortField == $bantuan_preview->warga_id->Name) { ?><?php if ($bantuan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bantuan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bantuan_preview->na->Visible) { // na ?>
	<?php if ($bantuan->SortUrl($bantuan_preview->na) == "") { ?>
		<th class="<?php echo $bantuan_preview->na->headerCellClass() ?>"><?php echo $bantuan_preview->na->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $bantuan_preview->na->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($bantuan_preview->na->Name) ?>" data-sort-order="<?php echo $bantuan_preview->SortField == $bantuan_preview->na->Name && $bantuan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bantuan_preview->na->caption() ?></span><span class="ew-table-header-sort"><?php if ($bantuan_preview->SortField == $bantuan_preview->na->Name) { ?><?php if ($bantuan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bantuan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bantuan_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$bantuan_preview->RecCount = 0;
$bantuan_preview->RowCount = 0;
while ($bantuan_preview->Recordset && !$bantuan_preview->Recordset->EOF) {

	// Init row class and style
	$bantuan_preview->RecCount++;
	$bantuan_preview->RowCount++;
	$bantuan_preview->CssStyle = "";
	$bantuan_preview->loadListRowValues($bantuan_preview->Recordset);

	// Render row
	$bantuan->RowType = ROWTYPE_PREVIEW; // Preview record
	$bantuan_preview->resetAttributes();
	$bantuan_preview->renderListRow();

	// Render list options
	$bantuan_preview->renderListOptions();
?>
	<tr <?php echo $bantuan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bantuan_preview->ListOptions->render("body", "left", $bantuan_preview->RowCount);
?>
<?php if ($bantuan_preview->id->Visible) { // id ?>
		<!-- id -->
		<td<?php echo $bantuan_preview->id->cellAttributes() ?>>
<span<?php echo $bantuan_preview->id->viewAttributes() ?>><?php echo $bantuan_preview->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bantuan_preview->bansos_id->Visible) { // bansos_id ?>
		<!-- bansos_id -->
		<td<?php echo $bantuan_preview->bansos_id->cellAttributes() ?>>
<span<?php echo $bantuan_preview->bansos_id->viewAttributes() ?>><?php echo $bantuan_preview->bansos_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bantuan_preview->warga_id->Visible) { // warga_id ?>
		<!-- warga_id -->
		<td<?php echo $bantuan_preview->warga_id->cellAttributes() ?>>
<span<?php echo $bantuan_preview->warga_id->viewAttributes() ?>><?php echo $bantuan_preview->warga_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($bantuan_preview->na->Visible) { // na ?>
		<!-- na -->
		<td<?php echo $bantuan_preview->na->cellAttributes() ?>>
<span<?php echo $bantuan_preview->na->viewAttributes() ?>><?php echo $bantuan_preview->na->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$bantuan_preview->ListOptions->render("body", "right", $bantuan_preview->RowCount);
?>
	</tr>
<?php
	$bantuan_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $bantuan_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($bantuan_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($bantuan_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$bantuan_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($bantuan_preview->Recordset)
	$bantuan_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$bantuan_preview->terminate();
?>