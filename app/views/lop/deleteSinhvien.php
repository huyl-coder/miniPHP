        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Lớp</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
			   <div class="col-sm-2 col-lg-2"></div>
               <div class="col-sm-8 col-lg-8">
					<div class="panel panel-default">
						<?php
							$sinhvien = $this->controller->lop->deleteSV($sinhvienId);
						?>
                        <div class="panel-heading">
                            <i class="fa fa-times"></i> Delete Sinh Viên
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                     <form action="#" id="form-xoa-sinhvien" method="post" >
										<?php if(empty($sinhvien)){ ?>
											<div class='text-muted text-center'>không tìm thấy sinh viên</div>
										<?php exit; } ?>
										<div class="form-group">
											<label>Delete Sinh Viên <span class='text-danger'>*</span></label>
											<select name="name" class="form-control" size="1">
                                                <?php foreach($sinhvien as $value){ ?>
														<option value="<?= $value['id'];?>"><?= $value["ten"] ?></option>
                                                <?php } ?>
                                            </select>
										</div>
										<div class="form-group form-actions text-right">
											<button type="submit" name="submit" value="submit" class="btn btn-md btn-danger">
												<i class="fa fa-times"></i> delete
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
