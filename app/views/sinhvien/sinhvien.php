
	<?php if(empty($sinhvien)){ ?>
		<tr class='no-data'><td colspan='4' class='text-muted text-center'>không tìm thấy sinh viên</td></tr>
	
	<?php }else{
			foreach($sinhvien as $user){?>
				<tr id="sinhvien-<?= Encryption::encryptId($user["id"]); ?>">
					<td><span class="text-primary"><?= $user["ten"]; ?></span></td>
					<td><span class="text-primary"><?= $user["ngaysinh"]; ?></span></td>
					<td><span class="text-primary"><?= $user["diachi"]; ?></span></td>
					<td class="text-right">
						<span class="pull-right btn-group btn-group-xs">
							<a href="<?= PUBLIC_ROOT . "Sinhvien/viewSinhvien/". urlencode(Encryption::encryptId($user["id"]));?>"  class="btn btn-default">
								<i class="fa fa-pencil"></i>
							</a>
							<a class="btn btn-danger delete"><i class="fa fa-times"></i></a>
						</span>
					</td>
				</tr>	
	<?php }
		}?>

		
