<?php
			defined('BASEPATH') OR exit('No direct script access allowed');
			include_once 'application/controllers/login.php';

	?><!DOCTYPE html>
<html lang="en">
				<head>
					<meta charset="utf-8">
					
					<link href="">
					
					<title> ARU Home</title>


				</head>
				
				
				<div id="wrapper">
					<body																								
													<header> 
													
													
																	<div id="headerLeft"> Logo	</div> 
																	<div id="headerCenter"> Heading and Nav Bar</div>
																	<div id="headerRight"> Mini-Login</div>
																				
													</header>
													
													
										<div id="contentFrame">

										
										<content>
													<center><h2>Login</h2> </center>
										</content>

										 <?php
												
															echo validation_errors();
													
																		echo form_open('login/login_validation');
																					echo '<p> Username: </p>';
																					echo form_input('username');
																						echo '</br>';
																						echo '</br>';
																					echo '<p>Password: </p>';    
																					echo form_password('password');
																						echo '</br>';
																						echo '</br>';
																					echo form_submit('loginSubmit', 'Login');    
																							
																		echo form_close();
											
											
											?>
							
											<?php
												if($this->session->userdata('is_loggedIn')){
											?>
											<label id="welcomeLbl"> Welcome <?php echo $this->session->userdata('username');?> </label> 
											<br>
											<a href='<?php  echo base_url(). "index.php/main/logout" ?>'>Logout</a>
												<?php
													echo '<br>';
												?>
												<?php
													}else{
										 
																?>
															<label id="welcomeLbl"> Welcome Guest!</label>
															<?php
																	}
													?>

                                                                                                                                        <?php
                                                                                                                                                
                                                                                                                                                date_default_timezone_set("America/New_York");
                                                                                                                                                
                                                                                                                                        echo '<br>';
                                                                                                                                        
                                                                                                                                        
                                                                                                                                    
                                                                                                                                                
                                                                                                                                        
                                                                                                                                        ?>
											<?php
														   /*
															for($i = 1; $i <= 100; $i++){
																
																if($i % 3 == 0 ){
																		 echo "<br>","Fizz "; 
																}else if ($i % 5 == 0){

																	echo "<br>","Buzz ";
																	
																}else{
																	
																	echo "<br>",$i; 
																	
																}
																
															}
														   */

											?>
										</div>

				</body>
			
			</div>

</html>