<?php
  include_once("config/config.php");
 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ilagan Law Office</title>
  
      <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

      <!-- Bootstrap core CSS -->
      <link href="css/bootstrap.css" rel="stylesheet">
      <!--external css-->
      <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

      <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">

      <!-- Custom styles for this page-->
      <link href="css/style.css" rel="stylesheet">
      <link href="css/style-responsive.css" rel="stylesheet">
      <link href="css/table-responsive.css" rel="stylesheet">


      <!-- Admin CSS -->
      <link href="css/main.css" rel="stylesheet" type="text/css"/>
      
      
  </head>
  
  <body>

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Ilagan Law Office</a>
        </div>
      	<ul class="nav navbar-nav navbar-right">
          <li><a href="" id="login-focus" data-toggle='modal' data-target='#login-modal'><span class="glyphicon glyphicon-log-in"></span> Log in</a></li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid" style="background-color: #1c1f23; height: 549px;">
      <div class="contents">
      	<img src="images/logo.png" class="img-responsive center-block">
    	<h3 style="color: white;" align="center"><i>"The safety of the people shall be the highest law"</i></h3>
      </div>
    </div>

    <footer style="background-color: #222222;">
      <p style="padding: 8px; color: white;" align="center">Ilagan Law Office, Copyright &copy; 2017</p>
    </footer>



    <!-- Login Modal -->
    <div id="login-modal" class="modal fade in" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-info-circle"></i> Login </h4>
                </div>
                <div class="modal-body">
                    <!-- Label shows if login is invalid -->
                    <label class="label label-danger" id="loginNotif"></label></br></br>
                    <form method="post" action="index-functions.php?action=login">
                        <input type="text" id="username" class="form-control login-info" placeholder="Username" name="user" required autofocus/></br>
                        <input type ="password" id="" class="form-control login-info" placeholder="Password" name="password" required /></br>
                        <button class="btn btn-primary btn-block" type="submit" name="submit" id="loginBtn"> Login </button>
                    </form>
                </div>
            </div>
        </div>
    </div>                      
    <!-- end of login modal -->


<?php
	include 'footer.php';

?>

<?php
if (isset($_GET['page'])){ 
    if($_GET['page']=="login"){
        if(!empty($_GET['msg'])){
            switch ($_GET['msg']) {
                    case 'invalid':
?>
                         <script>
                          var uName = '<?php echo $_SESSION['user'] ?>';

                          $('#loginNotif').text('Invalid username or password. Please try again.');
                          $('#username').val(uName);
                          $('#login-modal').modal('show');
                        </script>
<?php
			}	
		}
	}
}	
?>