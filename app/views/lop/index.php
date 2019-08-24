
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
                        <div class="panel-heading">
							<div class="pull-right">
								<a href="<?= PUBLIC_ROOT . "downloads/lop"?>" data-toggle="tooltip" title="Download Users" class="btn btn-alt btn-xs btn-danger excel">
									<i class="fa fa-print"></i>
								</a>
							</div>
                            <i class="fa fa-search"></i> Search
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="#" id="form-search-lop" method="post" >
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input dir="auto" type="text" name="name" class="form-control" maxlength="30" placeholder = "Nhập Tên">
                                        </div>
										<div class="form-group">
											<label>Giáo Viên</label>
                                            <input dir="auto" type="text" name="giaovien" class="form-control" maxlength="30" placeholder = "Nhập Giáo Viên">
                                        </div>
										<div class="form-group">
											<label>Sinh Viên</label>
                                            <input dir="auto" type="text" name="sinhvien" class="form-control" maxlength="30" placeholder = "Nhập Sinh Viên">
                                        </div>
										<div class="form-group form-actions text-right">
											<button type="submit" name="submit" value="submit" class="btn btn-sm btn-primary">Search</button>
										</div>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
					
					<hr>
					<!-- Users Block -->
					<div class="panel panel-default">
						<!-- Users Title -->
						<div class="panel-heading">
							<i class="fa fa-users"></i> List
						</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <div class="table-responsive">
                                <table id="list-lop" class="table table-hover">
                                    <thead>
                                        <tr>
											<th>Name</th>
											<th>Giáo Viên Chủ Nhiệm</th>
											<th>Sinh Viên</th>
											<th class="text-right"><i class="fa fa-cog"></i></th>
										</tr>
                                    </thead>
                                    <tbody>
										<?php 
											$usersData = $this->controller->lop->getLop();
											echo $this->render(Config::get('VIEWS_PATH') . "lop/lop.php", array("giaovien" => $usersData["giaovien"]));
										?>
                                    </tbody>
                                </table>
                            </div>
							<div class="text-right">
								<a href="<?= PUBLIC_ROOT . "Lop/add" ?>"  class="btn btn-success">
									<b>Add</b>
								</a>
							</div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
				</div>
			<!-- END Newsfeed Block -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

