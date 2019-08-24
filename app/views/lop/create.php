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
							$Lop = $this->controller->lop->getIDLop();
						?>
                        <div class="panel-heading">
                            <i class="fa fa-plus"></i> Create
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                     <form action="#" id="create-lop" method="post" >
										<div class="form-group">
											<label>Name Class <span class='text-danger'>*</span></label>
											<input dir="auto" type="text" name="name" class="form-control" maxlength="30" placeholder = "Nhập Tên" required>
										</div>
										<div class="form-group">
											<label>Giáo viên chủ nhiệm <span class='text-danger'>*</span></label>
											<select name="giaovien" class="form-control" size="1">
												<?php foreach($Lop as $value){ ?>
												<option value="<?= $value["id"] ?>"><?= $value["ten"] ?></option>
												<?php } ?>
                                            </select>
										</div>
										<div class="form-group form-actions text-right">
											<button type="submit" name="submit" value="submit" class="btn btn-success">Create</button>
										</div>
									</form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
					<div class="panel panel-default">
                    </div>
				</div>
			<!-- END Newsfeed Block -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

