        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sinh Viên</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
			   <div class="col-sm-2 col-lg-2"></div>
               <div class="col-sm-8 col-lg-8">
					<div class="panel panel-default">
						<?php
							$sinhvien = $this->controller->sinhvien->getSinhvienID($sinhvienId);
						?>
                        <div class="panel-heading">
                            <i class="fa fa-pencil"></i> Update Sinh Viên
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                     <form action="#" id="form-update-sinhvien" method="post" >
										<div class="form-group">
											<label>Name <span class='text-danger'>*</span></label>
											<input dir="auto" type="text" name="name" class="form-control" minlength="3" maxlength="30" value="<?= $sinhvien["ten"]; ?>" placeholder = "Nhập Tên" required>
										</div>
										<div class="form-group">
											<label>Ngày Sinh <span class='text-danger'>*</span></label>
											<input dir="auto" type="text" name="ngaysinh" id="datepicker" class="form-control" maxlength="30" value="<?= $sinhvien["ngaysinh"]; ?>" placeholder = "Nhập Ngày Sinh" required>
										</div>
										<div class="form-group">
											<label>Nơi Sinh <span class='text-danger'>*</span></label>
											<input dir="auto" type="text" name="diachi" class="form-control" maxlength="30" value="<?= $sinhvien["diachi"]; ?>" placeholder = "Nhập Nơi Sinh" required>
										</div>
										<div class="form-group form-actions text-right">
											<button type="submit" name="submit" value="submit" class="btn btn-md btn-primary">
												<i class="fa fa-check"></i> Update
											</button>
										</div>
									</form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
				</div>
			<!-- END Profile Block -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
