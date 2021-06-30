<?php
namespace PHPMaker2020\bansos;
?>
<?php if ($rw->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_rwmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($rw->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $rw->TableLeftColumnClass ?>"><?php echo $rw->id->caption() ?></td>
			<td <?php echo $rw->id->cellAttributes() ?>>
<span id="el_rw_id">
<span<?php echo $rw->id->viewAttributes() ?>><?php echo $rw->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rw->desa_id->Visible) { // desa_id ?>
		<tr id="r_desa_id">
			<td class="<?php echo $rw->TableLeftColumnClass ?>"><?php echo $rw->desa_id->caption() ?></td>
			<td <?php echo $rw->desa_id->cellAttributes() ?>>
<span id="el_rw_desa_id">
<span<?php echo $rw->desa_id->viewAttributes() ?>><?php echo $rw->desa_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rw->nama->Visible) { // nama ?>
		<tr id="r_nama">
			<td class="<?php echo $rw->TableLeftColumnClass ?>"><?php echo $rw->nama->caption() ?></td>
			<td <?php echo $rw->nama->cellAttributes() ?>>
<span id="el_rw_nama">
<span<?php echo $rw->nama->viewAttributes() ?>><?php echo $rw->nama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>