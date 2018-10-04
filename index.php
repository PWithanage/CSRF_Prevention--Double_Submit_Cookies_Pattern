<!doctype html>
<html >
  <head>
     <meta charset="utf-8">

    <title>Double Submit Cookie Pattern</title>

    <link rel="stylesheet"  href="./public/css/bootstrap.min.css">
    <script src="./public/js/jquery-3.3.1.min.js"></script>

	<style>
		.footer {
		   position: fixed;
		   left: 0;
		   bottom: 0;
		   width: 100%;
		   background-color: #cdced0;
		   color: black;
		   text-align: center;
		}
	</style>
  </head>
  <body >
    <nav class="navbar navbar-light bg-light">
            <a class='nav-link active' href='index.php'>Online Shopping</a>
        </nav>
			<div class="col-md-4 mx-auto order-12">
				<div class="card my-5 p-3 shadow">
					<div class="card-body">
						<h5 class="card-title text-center">Sign In</h5>

						<!-- Sign in Form - Here I have used hardcoded credentials as username=admin & password=admin -->
						<form class="mt-5 mb-3" action="index.php" method="POST" enctype='multipart/form-data'>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" value="admin" required autofocus/>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" value="admin" required/>
							</div>
							<button type="submit" class="btn btn-primary btn-block mt-5" id="submit" name="submit">Login</button>
						</form>
					</div>
				</div>
			</div>
			
		<div class="footer">
			<p>Cross Site Request Forgery Protection - Double Submit Cookie Pattern  |  IT15010636</p>
		</div>
  </body>
</html>

<!--After User clicks login button credeintials will be submitted through a POST request.-->
<?php
	
  if(isset($_POST['submit']))
  {
    //Invoke login function
	login();
  }

	//Login function validates the user input credentials
	function login()
	{
		$username='admin';
		$password='admin';

		$input_username = $_POST['username'];
		$input_pwd = $_POST['password'];
		
		if(($input_username == $username)&&($input_pwd == $password))
		{
			//After the user validation, session is started
			session_set_cookie_params(300);
			session_start();
			session_regenerate_id();

			//create the session cookie
			setcookie('session_cookie', session_id(), time() + 300, '/');

			//Create the CSRF token for the session and store in the memory
			$_SESSION['CSRF_Token'] = generateToken();

			//User is redirected to the update address page
			header("Location:update.php");
			exit;
		}
		else
		{
			//if credentials are invalid
			echo "<script>alert('Credentials are invalid!')</script>";
		}
	}
	
  //Generate CSRF token in server side
  function generateToken()
  {
	 return sha1(base64_encode(openssl_random_pseudo_bytes(30)));
  }
?>
