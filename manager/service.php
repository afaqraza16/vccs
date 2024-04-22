<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Services | VCCS</title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
	
	<?php 
		require_once("../classes/managerClass.php");
		session_start();
		if(!isset($_SESSION['manager_id']) || empty($_SESSION['manager_id'])){
			header('Location: ./login.php');	
		}
		$manager = new manager($_SESSION['manager_id']);
		
	 ?>

	
	<!-- Navbar -->
	<?php include_once('navbar.php') ?>
	<!-- Sidebar -->
	<?php include_once('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Services
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-gear"></i> Home</a></li>
        <li class="active">Services</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		
		<div class="row">
			<div class="col-md-4">
				<script type="text/javascript">
			$(document).ready(function(){
				
				$('#submitbtn').on('click',function(){
					
					var name= $('#serviceName').val();

					var information = 'name='+name; 
					
					if(name == ""){
						alert("Please Add Service Name");
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/addService.php',
							data:information,
							success:function(html){
								$('#result_msg').html(html);
							}
						}); 
					}
				});

			
		});
		</script>
			 <!-- Small boxes (Stat box) -->
		 <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Add Service</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                        
                <form id="frm" name="frm" method="post" >
                  
				  <div class="box-body">
                    
					
					<div class="form-group">
                      <label for="serviceName">Service Name </label>
                      <input id="serviceName" name="serviceName" placeholder="Type your Service Name Here" type="text" pattern="[a-zA-Z\s]+" maxlength="50" required="required" class="form-control" >
                    </div>
					  
					
					</br>
					  <div class="box-footer">
						  
						<input id="submitbtn" name="submitbtn" type="button" value="Add Service" class="btn btn-primary" >
						 
						<br/>
					  </div>
					
					</div>
				</form>
				  <div id='result_msg'></div>
              </div>
                </div>
                
                  </div>
                
              </div>
			</div>
			<div class="col-md-8">
				<!-- Small boxes (Stat box) -->
		  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">All Service Information</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
						<div class="">

				
					  <div class="box-body  table-responsive">
						
						<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>name</th>
						<th>No. of Products</th>
						<th></th>
                      </tr>
                    </thead>
                    <tbody>
                      
					  <?php
						foreach($manager->outlite->service as $service){
					  ?>
					  
					  <tr>
					    <td>#<?php echo htmlspecialchars($service->id); ?></td>
                        <td><?php echo htmlspecialchars($service->name); ?></td>
						<td><?php echo sizeof($service->product); ?></td>
						  
						<td>
							<a type="button" href="./updateService.php?id=<?php echo htmlspecialchars($service->id); ?>" class="btn btn-success btn-sm">Update</a>
							<a type="button" href="./deleteService.php?id=<?php echo htmlspecialchars($service->id); ?>" class="btn btn-danger btn-sm">Delete</a>
							
						</td>
						  
                      </tr>
					  
                      <?php } ?>
					  
                    	</tbody>
                  	</table>
						  </div></div>
 					</div>
                  </div>
                
                </div>
                
            </div> 
			</div>
		</div>
	
		  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<?php include_once('footer.php') ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include_once('script.php') ?>
</body>
</html>
