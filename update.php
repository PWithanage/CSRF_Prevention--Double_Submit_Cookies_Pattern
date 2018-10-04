`<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
		<div class="col-md-6 mx-auto order-12">
			<div class="card my-5 p-3 shadow">
				<div class="card-body">
					<h5 class="card-title text-center">Update your Address</h5>
					
									<script>
                                        //this function will retrive the CSRF token from the CSRF cookie
                                        function getCookie(cname) 
                                        {
                                            var name = cname + "=";
                                            var decodedCookie = decodeURIComponent(document.cookie);
                                            var ca = decodedCookie.split(';');
                                            for(var i = 0; i <ca.length; i++) 
                                            {
                                                var c = ca[i];
                                                while (c.charAt(0) == ' ') 
                                                {
                                                    c = c.substring(1);
                                                }
                                                if (c.indexOf(name) == 0) 
                                                {
                                                    return c.substring(name.length, c.length);
                                                }
                                            }
                                            return "";
                                        }
                                        //this function set hidden CSRF input's value in the form 
                                        function submitForm(oFormElement)
                                        {
                                            document.getElementById("csrf_Token").value=getCookie("csrf_token");

                                        }
                                    </script>
									
									 <?php
                                        //check whether user loged in or not 
                                        if(isset($_COOKIE['session_cookie'])) 
                                        {
                                            echo "
                    						<form method='post' action='result.php' onsubmit='submitForm(this);'>
                                                <!-- CSRF Token -->
                                                    <input type='hidden' name='csrf_Token' id='csrf_Token' value=''>   
                                                <!--  -->	
                                                  <div class='form-group row'>
                                                	<label for='streetAddress' class='col-sm-3 col-form-label'>Street Address</label>
                                                <div class='col-sm-9'>
                                                    <input type='text' class='form-control' id='streetAddress' name='streetAddress' placeholder='Street Address' required>
                                                </div>
                                                </div>
                                              
												<div class='form-group row'>
                                                	<label for='city' class='col-sm-3 col-form-label'>City</label>
                                                <div class='col-sm-9'>
                                                    <input type='text' class='form-control' id='city' name='city' placeholder='City' required>
                                                </div>
                                                </div>
												
												<div class='form-group row'>
                                                	<label for='province' class='col-sm-3 col-form-label'>Province</label>
                                                <div class='col-sm-9'>
                                                    <input type='text' class='form-control' id='province' name='province' placeholder='Province' required>
                                                </div>
                                                </div>
												
												<div class='form-group row'>
                                                	<label for='postalCode' class='col-sm-3 col-form-label'>Postal Code</label>
                                                <div class='col-sm-9'>
                                                    <input type='text' class='form-control' id='postalCode' name='postalCode' placeholder='Postal Code' required>
                                                </div>
                                                </div>

                                                                
                                                <button type='submit' class='btn btn-primary' >Submit</button>
                                           </form>";
                                        }
                                    ?>                                    
				</div>
			</div>
		</div>								
		
        <div class="footer">
			<p>Cross Site Request Forgery Protection - Double Submit Cookie Pattern  |  IT15010636</p>
		</div>

	</body>
</html>