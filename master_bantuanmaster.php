<?php
namespace PHPMaker2020\bansos;
?>
<?php if ($master_bantuan->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_master_bantuanmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($master_bantuan->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $master_bantuan->TableLeftColumnClass ?>"><?php echo $master_bantuan->id->caption() ?></td>
			<td <?php echo $master_bantuan->id->cellAttributes() ?>>
<span id="el_master_bantuan_id">
<span<?php echo $master_bantuan->id->viewAttributes() ?>><?php echo $master_bantuan->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($master_bantuan->jenis_bantuan_id->Visible) { // jenis_bantuan_id ?>
		<tr id="r_jenis_bantuan_id">
			<td class="<?php echo $master_bantuan->TableLeftColumnClass ?>"><?php echo $master_bantuan->jenis_bantuan_id->caption() ?></td>
			<td <?php echo $master_bantuan->jenis_bantuan_id->cellAttributes() ?>>
<span id="el_master_bantuan_jenis_bantuan_id">
<span<?php echo $master_bantuan->jenis_bantuan_id->viewAttributes() ?>><?php echo $master_bantuan->jenis_bantuan_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($master_bantuan->nama->Visible) { // nama ?>
		<tr id="r_nama">
			<td class="<?php echo $master_bantuan->TableLeftColumnClass ?>"><?php echo $master_bantuan->nama->caption() ?></td>
			<td <?php echo $master_bantuan->nama->cellAttributes() ?>>
<span id="el_master_bantuan_nama">
<span<?php echo $master_bantuan->nama->viewAttributes() ?>><?php echo $master_bantuan->nama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($master_bantuan->type->Visible) { // type ?>
		<tr id="r_type">
			<td class="<?php echo $master_bantuan->TableLeftColumnClass ?>"><?php echo $master_bantuan->type->caption() ?></td>
			<td <?php echo $master_bantuan->type->cellAttributes() ?>>
<span id="el_master_bantuan_type">
<span<?php echo $master_bantuan->type->viewAttributes() ?>><?php echo $master_bantuan->type->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($master_bantuan->jumlah->Visible) { // jumlah ?>
		<tr id="r_jumlah">
			<td class="<?php echo $master_bantuan->TableLeftColumnClass ?>"><?php echo $master_bantuan->jumlah->caption() ?></td>
			<td <?php echo $master_bantuan->jumlah->cellAttributes() ?>>
<span id="el_master_bantuan_jumlah">
<span<?php echo $master_bantuan->jumlah->viewAttributes() ?>><?php echo $master_bantuan->jumlah->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($master_bantuan->sumber_bantuan_id->Visible) { // sumber_bantuan_id ?>
		<tr id="r_sumber_bantuan_id">
			<td class="<?php echo $master_bantuan->TableLeftColumnClass ?>"><?php echo $master_bantuan->sumber_bantuan_id->caption() ?></td>
			<td <?php echo $master_bantuan->sumber_bantuan_id->cellAttributes() ?>>
<span id="el_master_bantuan_sumber_bantuan_id">
<span<?php echo $master_bantuan->sumber_bantuan_id->viewAttributes() ?>><?php echo $master_bantuan->sumber_bantuan_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($master_bantuan->pengambilan_bantuuan_id->Visible) { // pengambilan_bantuuan_id ?>
		<tr id="r_pengambilan_bantuuan_id">
			<td class="<?php echo $master_bantuan->TableLeftColumnClass ?>"><?php echo $master_bantuan->pengambilan_bantuuan_id->caption() ?></td>
			<td <?php echo $master_bantuan->pengambilan_bantuuan_id->cellAttributes() ?>>
<span id="el_master_bantuan_pengambilan_bantuuan_id">
<span<?php echo $master_bantuan->pengambilan_bantuuan_id->viewAttributes() ?>><?php echo $master_bantuan->pengambilan_bantuuan_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($master_bantuan->frekuensi->Visible) { // frekuensi ?>
		<tr id="r_frekuensi">
			<td class="<?php echo $master_bantuan->TableLeftColumnClass ?>"><?php echo $master_bantuan->frekuensi->caption() ?></td>
			<td <?php echo $master_bantuan->frekuensi->cellAttributes() ?>>
<span id="el_master_bantuan_frekuensi">
<span<?php echo $master_bantuan->frekuensi->viewAttributes() ?>><?php echo $master_bantuan->frekuensi->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($master_bantuan->bulan->Visible) { // bulan ?>
		<tr id="r_bulan">
			<td class="<?php echo $master_bantuan->TableLeftColumnClass ?>"><?php echo $master_bantuan->bulan->caption() ?></td>
			<td <?php echo $master_bantuan->bulan->cellAttributes() ?>>
<span id="el_master_bantuan_bulan">
<span<?php echo $master_bantuan->bulan->viewAttributes() ?>><?php echo $master_bantuan->bulan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($master_bantuan->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $master_bantuan->TableLeftColumnClass ?>"><?php echo $master_bantuan->tahun->caption() ?></td>
			<td <?php echo $master_bantuan->tahun->cellAttributes() ?>>
<span id="el_master_bantuan_tahun">
<span<?php echo $master_bantuan->tahun->viewAttributes() ?>><?php echo $master_bantuan->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($master_bantuan->status->Visible) { // status ?>
		<tr id="r_status">
			<td class="<?php echo $master_bantuan->TableLeftColumnClass ?>"><?php echo $master_bantuan->status->caption() ?></td>
			<td <?php echo $master_bantuan->status->cellAttributes() ?>>
<span id="el_master_bantuan_status">
<span<?php echo $master_bantuan->status->viewAttributes() ?>><?php echo $master_bantuan->status->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($master_bantuan->na->Visible) { // na ?>
		<tr id="r_na">
			<td class="<?php echo $master_bantuan->TableLeftColumnClass ?>"><?php echo $master_bantuan->na->caption() ?></td>
			<td <?php echo $master_bantuan->na->cellAttributes() ?>>
<span id="el_master_bantuan_na">
<span<?php echo $master_bantuan->na->viewAttributes() ?>><?php echo $master_bantuan->na->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>