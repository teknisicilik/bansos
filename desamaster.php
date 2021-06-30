<?php
namespace PHPMaker2020\bansos;
?>
<?php if ($desa->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_desamaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($desa->kecamatan_id->Visible) { // kecamatan_id ?>
		<tr id="r_kecamatan_id">
			<td class="<?php echo $desa->TableLeftColumnClass ?>"><?php echo $desa->kecamatan_id->caption() ?></td>
			<td <?php echo $desa->kecamatan_id->cellAttributes() ?>>
<span id="el_desa_kecamatan_id">
<span<?php echo $desa->kecamatan_id->viewAttributes() ?>><?php echo $desa->kecamatan_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($desa->nama->Visible) { // nama ?>
		<tr id="r_nama">
			<td class="<?php echo $desa->TableLeftColumnClass ?>"><?php echo $desa->nama->caption() ?></td>
			<td <?php echo $desa->nama->cellAttributes() ?>>
<span id="el_desa_nama">
<span<?php echo $desa->nama->viewAttributes() ?>><?php echo $desa->nama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($desa->kodepos->Visible) { // kodepos ?>
		<tr id="r_kodepos">
			<td class="<?php echo $desa->TableLeftColumnClass ?>"><?php echo $desa->kodepos->caption() ?></td>
			<td <?php echo $desa->kodepos->cellAttributes() ?>>
<span id="el_desa_kodepos">
<span<?php echo $desa->kodepos->viewAttributes() ?>><?php echo $desa->kodepos->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>