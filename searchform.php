<form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return check()" enctype="multipart/form-data">
						<input id="uploadFile" placeholder="Change Image" disabled="disabled" />
							<div class="fileUpload btn btn-primary" style="  background-color: #222d32;
							color: white;  border-radius: 7px;">
								<span>Upload</span>
								<input id="uploadBtn" onchange="check()" type="file" name="pic" class="upload" required />
							</div>
						<div id="bubble" class="bubble" >
							<p id="message" class="message" style="padding: 10px; text-align: center; color: white; border-radius: 15px" ></p>
						</div>	
						
						<input type="hidden" name="type" value="<?php echo $type; ?>" />
						
						<input type="hidden" name="key" value="<?php if(isset($_GET['key'])):
																		//extract hash
																		$key = $_GET['key'];
																		
																		//SANITIZE STRING
																		$key = filter_var($key, FILTER_SANITIZE_STRING);
																		
																		echo $key;
																		
																	  endif; ?>" />
												
						Rename <?php echo $type ?>: <input id="type" type="text" name="name" onkeyup="upperCase()"/>	<br/>
						<input type="submit"/>
					</form> 