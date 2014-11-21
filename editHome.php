<?php
	require_once("includes/init.php");
?>
<!DOCTYPE html>
 <html lang="en">
   <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Get Your Photos Edited</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="images/favicon.ico" type="image/pp-icon"/>
	<link href="css/style_edit.css" rel="stylesheet">
	<link href="css/reset.css" rel="stylesheet">
	<link href="css/font-awesome.css" rel="stylesheet" type="text/css"  media="all" />
	<link rel="stylesheet" href="css/modal.css">
	<link rel="stylesheet" href="css/menu.css">
	<link rel="stylesheet" href="css/progressbar.css">
	</head>
	<body>
	<div id="logobkg">
	<a href="index.php">
	<!--<p><span id="one">PHOTO</span><span id="two">PUDDLE</span></p>-->
	<img id="instr1" src="images/pp1.png" onmouseover="this.src='images/pp2.png'" onmouseout="this.src='images/pp1.png'"/>
	</a>
	</div>
			
			
		<div id="container" >
		  
		 <!-- <img id="bannerimg" src="./images/banner.png" onmouseover="this.src='images/banner.png'" onmouseout="this.src='images/bannero.jpg'"  /> -->
		  <div id='banner2' >
		  	<img src="images/banner.png" alt="How it works?">
		  </div>
		   
  
			<div class="wrapm">

				
				<div id='basictable' class='table1 whitehover'  >
					<div id="togglebasictable">
						<div id='largerhead1' class='greenc zfix'>BASIC</div>
						<div id='smallerhead1' class='greenc zfix'>Editing</div>
						<div id='basicprice' class='text-center pricing greenc'>Unlimited Uploads <span class='text-bold'>Rs <?php echo BASIC_PRICE;?>/photo</span></div>
						<p id="tri2"></p>
					</div>
					<div class='infolist'>
					<ul class='wrap3 zfix' >
					   
							<li><span>Adding filters.</span></li>
							<li><span>Image cropping and resizing.</span></li>
							<li><span>Image sharpening.</span></li>
							<li><span>Adjust contrast,brightness and saturation.</span></li>
							<li><span>Creative Blurring.</span></li>
							<li><span>Red-eye Removal</span></li>
							<li><span>Black and White</span></li>
							<li class="no"><span>Selective Colorization.</span></li>
							<li class="no"><span>Skin repair and smoothening.</span></li>
							<li class="no"><span>Remove Unwanted Objects/People.</span></li>
							<li class="no"><span>Change Background.</span></li>
							<li class="no"><span>Collage and Creative Framing.</span></li>
					</ul>
					</div>
					<div class='text-center'>
				  <div style=' margin-top:2%;'>
					<?php 
					if(!is_dir("./pictures/sample/basic/before"))
						mkdir("./pictures/sample/basic/before",0777,true);
					$files = scandir("./pictures/sample/basic/before");
					if(is_array($files))
						foreach($files as $file)
							if($file!='.' && $file!='..'):?>
					 <div class='photodiv'>
					 <div class='frontpart card' style="background-image:url('pictures/sample/basic/after/<?php echo $file;?>')"></div>
					 <div class='backpart card basicpics' data-pic="<?php echo $file;?>" style="background-image:url('pictures/sample/basic/before/<?php echo $file;?>')"></div>
					 </div>
					<?php endif;?>
					<br>
				  </div>
					<button id='basicup' class="button1 round-corners zfix modalButton" data-modal='basic-upload-photos'>Select</button>
					</div>
					
				</div>

				<div id='vline1' class='zfix'></div>
			  
				<div id='advancedtable' class='table2 whitehover' >
					<div id='toggleadvtable'>
						<div id='largerhead2' class='bluec zfix'>ADVANCED</div>
						<div id='smallerhead2' class='bluec zfix'>Editing</div>
						<div id='advprice'class='text-center pricing bluec'>Unlimited Uploads <span class='text-bold'>Rs <?php echo ADVANCED_PRICE;?>/photo</span></div>
						<p id="tri3"></p>
					</div>
					<div class='infolist'>
					<ul class='wrap3 zfix' >
					   
						   <li><span>Adding filters.</span></li>
							<li><span>Image cropping and resizing.</span></li>
							<li><span>Image sharpening.</span></li>
							<li><span>Adjust contrast,brightness and saturation.</span></li>
							<li><span>Creative Blurring.</span></li>
							<li><span>Over-flash Removal.</span></li>
							<li><span>Enhanced Black and White.</span></li>
							<li><span>Selective Colorization.</span></li>
							<li><span>Skin repair and smoothening.</span></li>
							<li><span>Remove Unwanted Objects/People.</span></li>
							<li><span>Change Background.</span></li>
							<li><span>Collage and Creative Framing.</span></li>

					</ul>
					</div>
					<div class='text-center'>
				  <div style=' margin-top:2%;'>
					<?php 
					if(!is_dir("./pictures/sample/advanced/before"))
						mkdir("./pictures/sample/advanced/before",0777,true);
					$files = scandir("./pictures/sample/advanced/before");
					if(is_array($files))
						foreach($files as $file)
							if($file!='.' && $file!='..'):?>
					 <div class='photodiv'>
					 <div class='frontpart card' style="background-image:url('pictures/sample/advanced/after/<?php echo $file;?>')"></div>
					 <div class='backpart card advancedpics' data-pic="<?php echo $file;?>" style="background-image:url('pictures/sample/advanced/before/<?php echo $file;?>')"></div>
					 </div>
					 <?php endif;?>	
					<br>
				  </div>
					<button id='advup' class="button2 round-corners zfix modalButton" data-modal='basic-upload-photos'>Select</button>
					</div>
				</div>
				 
				
			   
				<!-- Use Hash-Bang to maintain scroll position when closing modal -->
				<a href="#!" class="modal-close" title="Close this modal" data-dismiss="modal" style="font-size:0;">&times;</a>
				</section>
				<!-- ********************************************************************************************************************* -->
				<div id='popupProgress' style="visibility:hidden">
					<div class='uploadStage'>Your photos are being uploaded</div>
					<div class="progressNumber">
					   <div class='greenbar' style="width:75%;"></div><div class='bluebar' style='width:25%;'></div>
					   <div class='uploadper'>25<span style='color:#3399CC'>%</span></div>
				   </div>
				   <a href='#basic-uploading'>Click to open window</a>
				   <div style="clear:both"></div>
				</div>


				<div id='footer'>
					<div id="nav" >
						<div class='wrap4'>	 
						<div id="lefter">
							<nav id='navleft' class="menu" class='wrap4'>
							<ul class="block-menu">
								<!--<li class="b1 divider bubble-float-bottom"><a href="#" style="text-decoration: none;">Hire a Photographer</a></li> -->
								<li class="b1 divider"><a href="about.html" class='three-d' style="text-decoration: none;"><div class='fullheight underflipmenu'>About</div>
									<span aria-hidden="true" class="three-d-box">
										<span class="front">About</span>
										<span class="back">About</span>
									</span>
								</a></li>
								<li class="b1 divider"><a href="contact.html" class='three-d' style="text-decoration: none;"><div class=' fullheight underflipmenu'>Contact</div>
									<span aria-hidden="true" class="three-d-box">
										<span class="front">Contact</span>
										<span class="back">Contact</span>
									</span>
								</a></li>
								<li class="b1 divider"><a href="faq.html" class='three-d' style="text-decoration: none;"><div class='fullheight underflipmenu'>FAQs</div>
									<span aria-hidden="true" class="three-d-box">
										<span class="front">FAQs</span>
										<span class="back">FAQs</span>
									</span>
								</a></li>
								<li class="b1 divider"><a href="policies.html" class='three-d' style="text-decoration: none;"><div class='fullheight underflipmenu'>Policies</div>
									<span aria-hidden="true" class="three-d-box">
										<span class="front">Policies</span>
										<span class="back">Policies</span>
									</span>
								</a></li>
								<li class="b1 divider"><a href="editSignin.php" class='three-d' style="text-decoration: none;"><div class='fullheight underflipmenu'>Editor</div>
									<span aria-hidden="true" class="three-d-box">
										<span class="front">Editor</span>
										<span class="back">Editor</span>
									</span>
								</a></li>
							  <!-- <li class="b1 divider"><a href="editsignin.php" style="text-decoration: none;">Editor(?)</a></li>-->
							</ul>
							</nav>
						</div>
			
						</div>
					</div>
					<a href='hhtp://www.photopuddle.com/index.php' class='footerlogo'/></a>
		 			 <p id="copyright">&copy; PhotoPuddle 2014<p>
				</div>

			</div>

				  <!-- *************************************************************** -->
				<!--1st modal starts here --> 
			  <section class="semantic-content" id="basic-upload-photos" data-order="1" tabindex="-1" role="dialog" aria-labelledby="modal-label1" aria-hidden="true">
				<div class="modal-inner">
				<header>
					<a href='#!'><div id='closebutton' href='#!' title="Close this modal" data-dismiss="modal">&times;</div></a>
				   <div class='largermodalhead greenc'>BASIC</div>
					<div class='smallermodalhead greenc'>EDITING</div>
				</header>
				<div class="modal-content" class='wrap_modal'>
				<form id="projectDetails" enctype="multipart/form-data" method="post">
				   <div class="row" >
					 <label for="fileToUpload" > <div class='label_upload'>Upload your pictures</div></label>
					 <div class='post_upload'></div>
					 <input class='fade' type="file" form="fileForm" name="fileToUpload[]" id="fileToUpload" accept="image/*" onchange="fileSelected();" multiple/>
					 <input class='fade' type="hidden" name="mode" id="formMode"/>
					 <input class='fade' type="hidden" name="projid" id="formProjId"/>
				   </div>
			   <div id='projdet'>Customer Information</div>
				   <center>Project Name: <input type='text' name="name" id="projectName" required placeholder='Give a name to this project' /><br>
				   Email: <input type="email" name="email" id="userEmail" autocomplete required placeholder="Enter your email address"/><br /><br/><br/></center>
				   <div style='text-align:center; margin-top:-50px;'>Instructions for the Editor:<br>
				   <textarea id='projinstrfeditor' name='instructions' placeholder='Type the instructions for the editor, who would work on your photos...' ></textarea></div>
			   </form>
			   <form id="fileForm"></form>
				</div>
				<footer>
					  <button  class='bfooterb round-corners modalButton' id="uploadButton" onclick="uploadFile()" data-modal="basic-uploading">Next</button>
					 <button  class='footerb round-corners modalCloseButton'>Close</button>
				</footer>
				</div>
				<!-- Use Hash-Bang to maintain scroll position when closing modal -->
				<a href="#!" class="modal-close" title="Close this modal" data-dismiss="modal" style="font-size:0;">&times;</a>
			  </section>
				<!-- ********************************************************************************************************************* -->
				<!-- 2nd modal starts here --> 
			  <section class="semantic-content" id="basic-uploading" data-order="2" tabindex="-1" role="dialog" aria-labelledby="modal-label2" aria-hidden="true">
				<div class="modal-inner">
				<header>
					<a href='#!'><div id='closebutton' href='#!' title="Close this modal" data-dismiss="modal">&times;</div></a>
				   <div class='largermodalhead greenc'>BASIC</div>
					<div class='smallermodalhead greenc'>EDITING</div>
				</header>
				<div class="modal-content" class='wrap_modal'>
					
				<!-- Change the value to the current percentage uploaded in the span -->
				   <div class="uploadStage">Uploading Photos. Please wait...</div>
				   <div class="progressNumber">
					   <div class='greenbar' style="width:25%;"></div><div class='bluebar' style='width:75%;'></div>
					   <div class='uploadper'>25<span style='color:#3399CC'>%</span></div>
					   <br/><button class="cancelUpload buttonset1">Cancel upload</button>
				   </div>
					<div style='width:94%; position:relative; margin:auto; font-size:20px; margin-top:15px;'>Meanwhile, you may give a preference for who edits your photos :</div><div class='ibox'>For the first 12 hours, your project will be open to only the editors you give preference to.</div>
					<div id='editorlist'>
					
					<!-- Refer to this for duplication -->
							<div data-id='0' style="visibility:hidden" class="editor" data-chosen="false">
								<div id="editorsf">
									<h1 id='EditorName'>Jimmy Falcon1</h1>
									x Successes, y Failed
								</div>
								
								<div id='givePreference'>
									<img class="star" onclick="prefToggle(this)" src="./images/unselected.png">
									<img class="fade"  src="./images/selected.png">
								</div>
								
								<div id="editorsampleimgs">
								<div class='infinite-hor'>
								<?php
									if(!is_dir("pictures/tests"))
										mkdir("pictures/tests",0777,true);
									$files = scandir("pictures/tests");
									if(is_array($files))
										foreach($files as $file)
											if($file!='.' && $file!='..'):?>
									<a class="testpiclink" >
									   <div class='esi testpic'>
										   <img  class='boright test'/>
										   <img  class='edited'/>
									   </div>
									</a>
								<?php endif;?>
								</div>
								</div>
								<div style="clear:both" id="clearDiv"></div>
							</div>
							<!-- ---------------------------------------------------------- -->
						   <div data-id='0' style="visibility:hidden" class="editor" data-chosen="false">
								<div id="editorsf">
									<h1 id='EditorName'>Jimmy Falcon2</h1>
									x Successes, y Failed
								</div>
								
								<div id='givePreference'>
									<img class="star" onclick="prefToggle(this)" src="./images/unselected.png">
									<img class="fade"  src="./images/selected.png">
								</div>
								
								<div id="editorsampleimgs">
								<div class='infinite-hor'>
								<?php
									if(!is_dir("pictures/tests"))
										mkdir("pictures/tests",0777,true);
									$files = scandir("pictures/tests");
									if(is_array($files))
										foreach($files as $file)
											if($file!='.' && $file!='..'):?>
									<a class="testpiclink" >
									   <div class='esi testpic'>
										   <img  class='boright test'/>
										   <img  class='edited'/>
									   </div>
									</a>
								<?php endif;?>
								</div>
								</div>
								<div style="clear:both" id="clearDiv"></div>
							</div>
							  
							<!-- ---------------------------------------------------------- -->
							<div data-id='0' style="visibility:hidden" class="editor" data-chosen="false">
								<div id="editorsf">
									<h1 id='EditorName'>Jimmy Falcon3</h1>
									x Successes, y Failed
								</div>
								
								<div id='givePreference'>
									<img class="star" onclick="prefToggle(this)" src="./images/unselected.png">
									<img class="fade"  src="./images/selected.png">
								</div>
								
								<div id="editorsampleimgs">
								<div class='infinite-hor'>
								<?php
									if(!is_dir("pictures/tests"))
										mkdir("pictures/tests",0777,true);
									$files = scandir("pictures/tests");
									if(is_array($files))
										foreach($files as $file)
											if($file!='.' && $file!='..'):?>
									<a class="testpiclink" >
									   <div class='esi testpic'>
										   <img  class='boright test'/>
										   <img  class='edited'/>
									   </div>
									</a>
								<?php endif;?>
								</div>
								</div>
								<div style="clear:both" id="clearDiv"></div>
							</div>
							
							<!-- ---------------------------------------------------------- -->
				</div>
				</div>
				<footer>
					   <button class="footerb round-corners" style="float:left" onclick='moreEditors()'>More editors</button>
					   <button id="previewButton" class='bfooterb round-corners modalButton' data-modal='basic-imagesprev'>Next</button>
					<button  class='footerb round-corners modalCloseButton'>Cancel</button>
				</footer>
				</div>
				<!-- Use Hash-Bang to maintain scroll position when closing modal -->
				<a href="#!" class="modal-close" title="Close this modal" data-dismiss="modal" style="font-size:0;">&times;</a>
			  </section>
				<!-- ********************************************************************************************************************* -->
			   <!-- 2.5th basic modal starts here --> 
<!--			  <section class="semantic-content" data-order="2" id="basic-testprev" tabindex="-1" role="dialog" aria-labelledby="modal-label4" aria-hidden="true">
				<div class="modal-inner">
				<header>
				   <a href='#basic-uploading'><div id='closebutton' href='#basic-uploading' title="Close this modal" data-dismiss="modal">&times;</div></a>
					<div class='largermodalhead greenc'>BASIC</div>
					<div class='smallermodalhead greenc'>EDITING</div>
				</header>
				<div class="modal-content" class='wrap_modal'>
			   
				<div id='lefttestbtn' onclick="changeTestPic(-1)"><img src="./images/arrowleft.png"></div>
				<div id='righttestbtn' onclick="changeTestPic(1)"><img src="./images/arrowright.png"></div>
					<div id='slider1' class='edtrsmpl'>
					   <img id="prevtestpic" class='beforeeimg' src="./images/dummy2.jpg">
					   <img id="preveditedpic" class='aftereimg' src="./images/dummy2.jpg">
					</div>
				   
				</div>
				<footer>
						<button class='footerb round-corners modalButton' data-modal='basic-uploading' style='float:left;'>Back</button>
					
				</footer>
				</div>
				<!-- Use Hash-Bang to maintain scroll position when closing modal -->
				<a href="#basic-uploading" class="modal-close" title="Close this modal"
					data-dismiss="modal">&times;</a>
			  </section>-->
				<!-- ********************************************************************************************************************* -->
				 <!-- 3rd modal starts here --> 
			  <section class="semantic-content" id="basic-imagesprev" data-order="3" tabindex="-1" role="dialog" aria-labelledby="modal-label3" aria-hidden="true">
				<div class="modal-inner">
				<header>
					<a href='#!'><div id='closebutton' href='#!' title="Close this modal" data-dismiss="modal">&times;</div></a>
					<div class='largermodalhead greenc'>BASIC</div>
					<div class='smallermodalhead greenc'>EDITING</div>
				</header>
				<div class="modal-content" class='wrap_modal'>
				<label for="fileToUpload"><div id='pushl' class='label_upload' >Add more pictures</div></label>
				<div style="clear:both; width:100%;height:15px;"></div>
				<div id="uploaddiv" style="visibility:hidden">
				
				<button  class='label_upload2 modalButton' id="uploadButton2" style="visibility:visible" onclick="uploadFile()">Upload</button>
				<div class='post_upload' style="margin-top:10px;"></div>
				</div>
				   <div class="progressNumber">
					   <div class='greenbar' style="width:75%;"></div><div class='bluebar' style='width:25%;'></div>
					   <div class='uploadper'>25<span style='color:#3399CC'>%</span></div>
					   <br/><button class="cancelUpload buttonset1">Cancel upload</button>
				   </div>
				
					
				<!-- Display all pics from DB -->
				Preview of Uploaded Photos<br /> 
				<div id='subtxt1' style='font-size:15px;;'>(Click on any photo to add instructions for the editor)</div>
					<div id='picsprev'>
						
						<div id="prevClearDiv" style='clear:both; width:100%; height:20px;'></div>
					</div>
				</div>
				<footer>
				<button class='bfooterb round-corners modalButton' id="summaryButton" data-modal='basic-summary'>Finish</button>
				<button  class='footerb round-corners modalCloseButton'>Cancel</button>
				</footer>
				</div>
				<!-- Use Hash-Bang to maintain scroll position when closing modal -->
				<a href="#!" class="modal-close" title="Close this modal" data-dismiss="modal">&times;</a>
			  </section>
				<!-- ********************************************************************************************************************* -->
				<!-- 3.5th basic modal starts here --> 
			  <section class="semantic-content" data-order="3" id="basic-instr" tabindex="-1" role="dialog" aria-labelledby="modal-label4" aria-hidden="true">
				<div class="modal-inner">
				<header>
				   <a href='#basic-imagesprev'><div id='closebutton' href='#basic-imagesprev' title="Close this modal" data-dismiss="modal">&times;</div></a>
					<div class='largermodalhead greenc'>BASIC</div>
					<div class='smallermodalhead greenc'>EDITING</div>
				</header>
				<div class="modal-content" class='wrap_modal'>
					
			   
				<div id='leftbtn' onclick="changePic(-1)"><img src="./images/arrowleft.png"></div>
				<div id='rightbtn' onclick="changePic(1)"><img src="./images/arrowright.png"></div>
					<div id='slider1'>
					<div id="prevpic"></div>
					
					</div>
				   <div id='picinstr'>
						<textarea id='instrfeditor' placeholder='Type Instructions...' ></textarea>
						<input type='submit' value='SAVE' onclick="saveInstr()" id='savebtn'/>
					</div>
				</div>
				<footer>
						<a class='footerb round-corners modalButton' href='#basic-imagesprev' style='float:left;'>Back To Uploads</a>
					
				</footer>
				</div>
				<!-- Use Hash-Bang to maintain scroll position when closing modal -->
				<a href="#basic-imagesprev" class="modal-close" title="Close this modal"
					data-dismiss="modal">&times;</a>
			  </section>
				<!-- ********************************************************************************************************************* -->
				<!-- 4th modal starts here --> 
			  <section class="semantic-content" data-order="3" id="basic-summary" tabindex="-1" role="dialog" aria-labelledby="modal-label5" aria-hidden="true">
				<div class="modal-inner">
				<header>
				   <a href='#!'><div id='closebutton' href='#!' title="Close this modal" data-dismiss="modal">&times;</div></a>
					<div class='largermodalhead greenc'>BASIC</div>
					<div class='smallermodalhead greenc'>EDITING</div>
				</header>
				<div class="modal-content" class='wrap_modal'>
					
				<div id='summhead'>Summary - <input id='finProjName' type='text' value='Project Name'/></div>
					<div id='summ_content'>
						<div id='summl'>
							Project No<span>1534648
						</div></span>
						<div id='summr' style="">
							<span>Email </span><input id='finEmail' type='text' value='avinsingh007@gmail.com'/>
						</div>
						<div id='summc'><span> XY </span>Photo(s) Uploaded For Editing!</div>
						<div style="clear:both; height:40px; width:100%;"></div>
						
						<textarea id='finprojinstrfeditor' placeholder='Type the instructions for the editor, who would work on your photos...' ></textarea>
						<div style="clear:both; height:40px; width:100%;"></div>
						<div id='summinstrhead'><span>Instructions for You</span></div>
						<div id='summinstr'>We will now send you an email containing the link to access your project. Please ensure that the email ID is correct or change it above.
						</div>
						<div id='summack'>Thank You for choosing us!</div>
					</div> 
				</div>
				<footer>
					<a class='footerb round-corners modalButton' href='#basic-imagesprev' style='float:left;'>Back</a>
					<button id='finishProj' class='bfooterb round-corners' style="margin-right:47%;">Confirm</button>
				</footer>
				</div>
				<!-- Use Hash-Bang to maintain scroll position when closing modal -->
				<a href="#!" class="modal-close" title="Close this modal"
					data-dismiss="modal">&times;</a>
			   </section>
				<!-- ********************************************************************************************************************* -->




			  <div id='upscroll'>&#8593;<br><span>Top</span></div>
			  <div id='downscroll'>&#8595;<br><span>Down</span></div>


			  <div id="photoModal" style="display:none">
				<div class='fullwhiteoverlay'></div>
				<div id='closeButton3' class='closeButton'></div>
				<div id='leftButton3' class='modalButton '></div>
				<div id='rightButton3' class='modalButton'></div>

				<div id='photoModal2' class='photoModal'>
				  <div id='lefthalfpic'><div id='prevPic21' class="modalImg" ></div></div>
				  <div id='righthalfpic'><div id='prevPic22' class="modalImg2" ></div></div>
				</div>
			  </div>
			  
			  <div id="photoModal1" style="display:none">
				<div class='fullwhiteoverlay'></div>
				<div id='closeButton4' class='closeButton'></div>
				<div id='leftButton4' class='modalButton '></div>
				<div id='rightButton4' class='modalButton'></div>

				<div id='photoModal2' class='photoModal'>
				  <div id='lefthalfpic'><div id='prevPic21' class="modalImg" ></div></div>
				  <div id='righthalfpic'><div id='prevPic22' class="modalImg2" ></div></div>
				</div>
			  </div>
			<div id="photoModal3" style="display:none">
				<div class='fullwhiteoverlay'></div>
				<div id='closeButton5' class='closeButton'></div>
				<div id='leftButton5' class='modalButton '></div>
				<div id='rightButton5' class='modalButton'></div>

				<div id='photoModal2' class='photoModal'>
				  <div id='lefthalfpic'><div id='prevPic21' class="modalImg" ></div></div>
				  <div id='righthalfpic'><div id='prevPic22' class="modalImg2" ></div></div>
				</div>
			  </div>

		<script src="js/jquery-1.11.0.min.js"></script>
		<script src="js/modal.js"></script><!-- JS for Modal -->
		<script src='js/progressbar.js'></script>
		<script src="js/dualCarousel.js"></script>
		<script src='js/editHome.js'></script>
		<script type="text/javascript">
		$(function()
			{
			   $('#downscroll').click(function(){
				  $('html, body').animate({scrollTop : 610},800);
				  return false;
				});
				$(window).scroll(function(){
				if ($(this).scrollTop() > 100) {
				  $('#upscroll').css('visibility','visible');
				  $('#downscroll').css('visibility','hidden');
				} else {
				  $('#upscroll').css('visibility','hidden');
				  $('#downscroll').css('visibility','visible');
				}
				});
				/*$(function() { //When the document loads
				$("#tri").bind("click", function() {
				  $(window).scrollTop($(".wrapm").offset().top); //scroll to div with container as ID.
				  return false; //Prevent Default and event bubbling.
				  });
				});
			   /* $(window).scroll(function(){
				if (($(this).scrollTop() > 2) && ($(this).scrollTop() < 600)){
				  $('html, body').animate({scrollTop : 560},800);
				  return false;
				}
				});
				var lastScrollTop = 0;
				var state = 0;
				$(window).scroll(function(event){
				var st = $(this).scrollTop();
				if ((st < 200) && (st > 80))
				  if(state == 0){
				  $('html, body').animate({scrollTop : 560},1);
				  state = 1;
				  return false;
				}
				else {
				   $('html, body').animate({scrollTop : 0},1);
				   state = 0;
				   return false;
				}
				lastScrollTop = st;

				});
				*/
				

				$('#upscroll').click(function(){
				  $('html, body').animate({scrollTop : 0},800);
				  return false;
				});

				$('#togglebasictable').click(function(){
				  $('#basictable .infolist').slideToggle();
				  $('#basictable .infolist').css('padding-top','40px');
				  $('#basictable .infolist').css('padding-left','5%');
				  $('#tri2').toggleClass('rotatedTriangle');
				  
				});
				$('#toggleadvtable').click(function(){
				  $('#advancedtable .infolist').slideToggle();
				  $('#advancedtable .infolist').css('padding-top','40px');
				  $('#advancedtable .infolist').css('padding-left','5%');
				  $('#tri3').toggleClass('rotatedTriangle');
				  
				});

			});
		</script>
	</body>
  </html>
