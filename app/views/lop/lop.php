
	<?php if(empty($giaovien)){ ?>
		<tr class='no-data'><td colspan='4' class='text-muted text-center'>không tìm thấy lớp</td></tr>
	<?php }else{
			foreach($giaovien as $user){?>
				<tr id="giaovien-<?= Encryption::encryptId($user["id"]); ?>">
					<td><span class="text-primary"><?= $user["ten"]; ?></span></td>
					<td><span class="text-primary"><?= $user["ten1"]; ?></span></td>
					<td><span class="text-primary"><?= $user["ten2"]; ?></span></td>
					<td class="text-center">
						<span class="pull-right btn-group btn-group-xs">
							<a href="<?= PUBLIC_ROOT . "Lop/deleteSinhvien/". urlencode(Encryption::encryptId($user["id"])); ?>"  class="btn btn-danger">
								<b>DeleteSV</b>
							</a>
							<a href="<?= PUBLIC_ROOT . "Lop/addSinhvien/". urlencode(Encryption::encryptId($user["id"])); ?>"  class="btn btn-success">
								<b>Add SV</b>
							</a>
							<a href="<?= PUBLIC_ROOT . "Lop/viewLop/". urlencode(Encryption::encryptId($user["id"]));?>"  class="btn btn-default">
								<i class="fa fa-pencil"></i>
							</a>
							<a class="btn btn-danger delete"><i class="fa fa-times"></i></a>
						</span>
					</td>
				</tr>	
	<?php }
		} ?>

		
