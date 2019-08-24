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
							$sinhvien = $this->controller->lop->getSV();
						?>
                        <div class="panel-heading">
                           <i class="fa fa-plus"></i> ADD Sinh Viên
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                     <form action="#" id="form-add-sinhvien" method="post" >
										<div class="form-group">
											<label>Add Sinh Viên <span class='text-danger'>*</span></label>
											<select name="name" class="form-control" size="1">
                                                <?php foreach($sinhvien as $value){ ?>
														<option value="<?= $value['id'];?>"><?= $value["ten"] ?></option>
                                                <?php } ?>
                                            </select>
										</div>
										<div class="form-group form-actions text-right">
											<button type="submit" name="submit" value="submit" class="btn btn-md btn-success">
												<i class="fa fa-check"></i> ADD
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
