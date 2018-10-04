<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Double Submit Cookie Pattern</title>

        <link rel="stylesheet"  href="./public/css/bootstrap.min.css">
        <script src="./public/js/jquery-3.3.1.min.js"></script>
   
    </head>
    <body>
        <nav class="navbar navbar-light bg-light">
            <ul class="nav justify-content-end">
				<?php 
                    if(isset($_COOKIE['session_cookie'])) 
                    {
                        echo "<li class='nav-item'>
                                <a class='nav-link active' href='logout.php'>Logout</a>
                            </li>";
                    }
                ?>
            </ul>
        </nav>
        <div class="col-md-5 mx-auto order-12">
				<div class="card my-5 p-3 shadow">
					<div class="card-body" align="center">		

									<?php
                						if(isset($_COOKIE['session_cookie']))
                						{
                							session_start();
                						      //check whether the token in the post ethod equals to the token in the session
                                        	if ($_POST['csrf_Token'] == $_COOKIE['csrf_token']) 
                							{
                								$streetAddress=$_POST['streetAddress'];
                								$city=$_POST['city'];
                								$province=$_POST['province'];
                								$postal_code=$_POST['postalCode'];
												
												echo "<h5 class='card-title text-center'>Updated Successfully</h5>";
                								echo "<div class='alert alert-primary' role='alert'>".$streetAddress."</div>";
                								echo "<div class='alert alert-primary' role='alert'>".$city."</div>";
                								echo "<div class='alert alert-primary' role='alert'>".$province."</div>";
                								echo "<div class='alert alert-primary' role='alert'>".$postal_code."</div>";
												echo "<div class='alert alert-info' role='alert'>Address is updated successfully.</div>";
                							}
                							else
                							{
                								echo "<div class='alert alert-secondary' role='alert'>ERROR Updating Address !!!</div>";
                							}
                						}
            						?>
					</div>
				</div>
			</div>
    </body>
</html>