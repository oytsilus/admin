<table class="table" id="detail_harga">
  <thead>
	<tr>
	  <th>Nama Item</th>
	  <th>Kode Item</th>
	  <th>Satuan</th>
	  <th width="14%">Harga Beli</th>
	  <th width="14%">Harga Jual</th>
	  <th width="9%">Disc (%)</th>
	  <th width="14%">Disc (Rp)</th>
	</tr>
  </thead>
  <tbody>
	<?php 
	if($num_rows > 0) {
	$no = 1;
	foreach($result as $row) {
		$params = $row['mp_id'].'|'.$row['mp_code'].'|'.$row['mp_category'].'|'.$row['mp_name'].'|'.$row['mu_code'].'|'.$row['mu_name'];
	?>
	<tr>
	  <td>
		<?php echo $row['mp_name'];?>
		<input type="hidden" id="h_params_<?php echo $row['mp_id'];?>" name="h_params[]" value="<?php echo $params;?>">
	  </td>
	  <td><?php echo $row['mp_code'];?></td>
	  <td><?php echo $row['mu_name'];?></td>
	  <td class="text-right hbeli">
		<input type="number" class="form-control" id="hbeli_<?php echo $row['mp_id'];?>" name="hbeli[]" value="<?php echo ($row['mbp_buy_price'] == 0 ? '0' : $row['mbp_buy_price']);?>" min="0">
	  </td>
	  <td class="text-right hjual">
		<input type="number" class="form-control" id="hjual_<?php echo $row['mp_id'];?>" name="hjual[]" value="<?php echo ($row['mbp_sell_price'] == 0 ? '0' : $row['mbp_sell_price']);?>" min="0">
	  </td>
	  <td class="text-right disc">
		<input type="number" class="form-control" id="disc_<?php echo $row['mp_id'];?>" name="disc[]" value="<?php echo ($row['mbp_disc'] == 0 ? '0' : $row['mbp_disc']);?>" min="0">
	  </td>
	  <td class="text-right disc2">
		<input type="number" class="form-control" id="disc2_<?php echo $row['mp_id'];?>" name="disc2[]" value="<?php echo ($row['mbp_disc_nominal'] == 0 ? '0' : $row['mbp_disc_nominal']);?>" min="0">
	  </td>
	</tr>
	<?php
	$no++;
	} // endforeach
	}
	else echo 'Belum ada item terdaftar!';
	?>
  </tbody>
</table>