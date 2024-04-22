<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login | VCCS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
	  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
	  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
	  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
	  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
	
	<?php
	session_start();
	if(isset($_SESSION['manager_id']) && !empty($_SESSION['manager_id'])){
		header('Location: ./index.php');	
	}	
	?>
  <body class="login-page" > 
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>VCCS</b> Manager</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body" >
	    <h3 class="login-box-msg" >Login to start</h3>
		  
        <form method="post" action="">
		
          <div class="form-group has-feedback">
            <input id="login_email" name="login_email" type="email" class="form-control" placeholder="Your Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
        
			<div class="form-group has-feedback">
            <input id="login_pass" name="login_pass" type="password" class="form-control" placeholder="Your Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
		  <div class="row">
            <div class="col-xs-8">    
                                     
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" id="login_btn" name="login_btn" class="btn btn-primary btn-block btn-flat">log In</button>
            </div><!-- /.col -->
          </div>
		  
        </form>
		<br/>
		<center>
		<?php

			if(isset($_POST['login_btn'])){
					
					if(isset($_POST['login_email']) && isset($_POST['login_pass'])){
					
						$Email = $_POST['login_email'];
						$Password = $_POST['login_pass'];
					
						if(!empty($Email) && !empty($Password)){
							include("../classes/DBmanager.php");
							$obj = new DBmanager();
							$obj -> view("SELECT * FROM user_t WHERE user_t.email='".$Email."' AND user_t.role_id = (SELECT role_t.id FROM role_t WHERE role_t.name = 'manager')");
							if($row = $obj->pstmt->fetch()){
								if($row['password'] == $Password){
									
									$obj -> view("SELECT * FROM outlite_t WHERE outlite_t.id='".$row['id']."'");
									if($row = $obj->pstmt->fetch()){
										
										$userID = $row['id'];
										$_SESSION['manager_id'] = $userID;
										header('Location: ./index.php');
										
									}else{
										echo "<div class='alert alert-danger alert-dismissable'>
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
											<h4><i class='icon fa fa-ban'></i> Alert!</h4>
											Outlet not exist for You.
										  </div>";
									}
									
									
									
								}else{
									echo "<div class='alert alert-danger alert-dismissable'>
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
											<h4><i class='icon fa fa-ban'></i> Alert!</h4>
											Invalid Email/Password!
										  </div>";
								}
										
							}else{
								echo "<div class='alert alert-danger alert-dismissable'>
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
											<h4><i class='icon fa fa-ban'></i> Alert!</h4>
											Email Not Exist!
										  </div>";	
							}
							
							
							
						}else{
							echo "<div class='alert alert-danger alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									<h4><i class='icon fa fa-ban'></i> Alert!</h4>
									All fields are required!
								  </div>";	
						}
					
					}else{
						echo "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								<h4><i class='icon fa fa-ban'></i> Alert!</h4>
								All fields are required!
							  </div>";	
					}
					
					//echo 'Sign In Button is clicked.';
					
				}
			
		?>
		</center>
        
      </div>
    </div>

    <!-- jQuery 3 -->
	<script src="../bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- iCheck -->
	<script src="../plugins/iCheck/icheck.min.js"></script>
	<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' /* optional */
		});
	  });
	</script>
	
	
	<script>
	function myFunction() {
		var popup = document.getElementById("myPopup");
		popup.classList.toggle("show");
	}
	</script>

  </body>
</html>