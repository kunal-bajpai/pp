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
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/progressbar.css">
    </head>
<script>
   var testImgs;
   xmltest = new XMLHttpRequest();
   xmltest.open("GET","ajax/getTestImages.php",false);
   xmltest.send();
   testImgs = JSON.parse(xmltest.responseText);
</script>
    <body>
    <div id="logobkg">
    <a href="index.php">
    <img id="instr1" src="images/pp5.png" onmouseover="this.src='images/pp6.png'" onmouseout="this.src='images/pp5.png'"/>
    </a>
    </div>
     
          
  
 <!--   <div id="nav" >
        <div class='wrap4'>     
        <div id="lefter">
        <nav id='navleft' class="menu" class='wrap4'>
        <ul>
       <!--    <li class="b1 bubble-float-bottom"><a href="index.php" style="text-decoration: none;">Home</a></li>
            <li class="b1 divider bubble-float-bottom"><a href="#" style="text-decoration: none;">Hire a Photographer</a></li> 
            <li class="b1 divider bubble-float-bottom"><a href="#" style="text-decoration: none;">About Us</a></li>
            <li class="b1 divider bubble-float-bottom"><a href="#" style="text-decoration: none;">Contact Us</a></li>  -->
    <!--        <li class="b1 divider bubble-float-bottom"><a href="signin.php" style="text-decoration: none;">Editor(?)</a></li>
        </ul>
        </nav>
        </div>
        <div id="righter">
           <ul id='navright' class="menu"></ul>
        </div>
        </div>
    </div>
 <!--<div id='mininav' class='wrap3'>
        <div id="lefter">
        <ul id='navleft' class="submenu">
            <li>
                Get &nbsp;Your&nbsp; Photos&nbsp; Edited
            </li>
        </ul>
        </div>
    </div> -->
            
            
        <div id="container" >
           
           <div class="banner has-dots" style="overflow: hidden; width: 100%; height:100%; position:fixed;">
            <ul style="width: 400%; position: fixed; left:-100%; height:100%; overflow: hidden;">
                <li style="background-image: url(images/banner1.png); background-size: 100%; width: 20%;">
                <!--    <h1>The jQuery slider that just slides.</h1>
                    <p>No fancy effects or unnecessary markup, and it’s less than 3kb.</p>
                    
                    <a class="btn" href="#download">Download</a> -->
                </li>
                
                <li style="background-image: url(images/banner2.png); background-size: 100%; width: 20%;">
                 <!--   <h1>Fluid, flexible, fantastically minimal.</h1>
                    <p>Use any HTML in your slides, extend with CSS. You have full control.</p>
                    
                    <a class="btn" href="#download">Download</a> -->
                </li>
                
                <li style="background-image: url(images/banner3.png); background-size: 100%; width: 20%;">
                  <!--  <h1>Open-source.</h1>
                    <p>Everything to do with Unslider is hosted on GitHub.</p>
                    
                    <a class="btn" href="//github.com/idiot/unslider">Contribute</a> -->
                </li>
                
                <li style="background-image: url(images/banner5.png); background-size: 100%; width: 20%;">
                   <!-- <h1>Uh, that’s about it.</h1>
                    <p>I just wanted to show you another slide.</p>
                    
                    <a class="btn" href="#download">Download</a>  -->
                </li>
               
            </ul>
            
            </div>

            
           
           
  
            <div class="wrapm">
                <div id='spacediv'></div>
                <p id="tri">I am a wide triangle.</p>
                <div id='basictable' class='table1 '  >
                    <div id='largerhead1' class='greenc zfix'>BASIC</div>
                    <div id='smallerhead1' class='greenc zfix'>EDITING</div>
                    <button id='basicup' class="button1 round-corners zfix modalButton" data-modal='basic-upload-photos'>Select</button>
                    <div class='infolist'>
                    <ul class='wrap3 zfix' >
                       
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li>Donec tempus tellus id fringilla euismod.</li>
                            <li>Nulla sed risus nec dolor laoreet adipiscing.</li>
                            <li>Aenean sit amet dolor lobortis, blandit nibh vitae, vulputate felis.</li>
                            <li>Praesent ut ipsum a leo consectetur bibendum.</li>
                            <li>Praesent blandit lorem et elit molestie fringilla.</li>
                        
                    </ul>
                   
                        
                    </div>
                </div>
                <div id='vline1' class='zfix'></div>
              
                <div id='advancedtable' class='table2' >
                    <div id='largerhead2' class='bluec zfix'>ADVANCED</div>
                    <div id='smallerhead2' class='bluec zfix'>EDITING</div>
                    <button id='advup' class="button2 round-corners zfix modalButton" data-modal='basic-upload-photos'>Select</button>
                    <div class='infolist'>
                    <ul class='wrap3 zfix' >
                       
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li>Donec tempus tellus id fringilla euismod.</li>
                            <li>Nulla sed risus nec dolor laoreet adipiscing.</li>
                            <li>Aenean sit amet dolor lobortis, blandit nibh vitae, vulputate felis.</li>
                            <li>Praesent ut ipsum a leo consectetur bibendum.</li>
                            <li>Praesent blandit lorem et elit molestie fringilla.</li>
                        
                    </ul>
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
                </div>


                <div id='footer'></div>

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
                     <label for="fileToUpload" class='label_upload' >Upload your pictures</label><br />
                     <div class='post_upload'></div>
                     <input type="file" form="fileForm" name="fileToUpload[]" id="fileToUpload" accept="image/*" onchange="fileSelected();" multiple/>
                     <input type="hidden" name="mode" id="formMode"/>
                     <input type="hidden" name="projid" id="formProjId"/>
                   </div>
               <div id='projdet'>Customer Information</div>
                   Project Name: <input type='text' name="name" id="projectName" required placeholder='Give a name to this project' />
                   Email: <input type="email" name="email" id="userEmail" autocomplete required placeholder="Enter your email address"/><br /><br/><br/>
                   Instructions for the Editor:
                   <textarea id='projinstrfeditor' name='instructions' placeholder='Type Instructions...' ></textarea>
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
                   <div class="uploadStage">Uploading Photos...</div>
                   <div class="progressNumber">
                       <div class='greenbar' style="width:25%;"></div><div class='bluebar' style='width:75%;'></div>
                       <div class='uploadper'>25<span style='color:#3399CC'>%</span></div>
                   </div>
                    <div style='width:94%; position:relative; margin:auto;'>Meanwhile, <br/> Take a look at our editors</div>
                    <div id='editorlist'>
                            <div data-id='0' style="visibility:hidden" class="editor" data-chosen="false">
                                <div id="editorsf">
                                    <h1 id='EditorName'>Jimmy Falcon1</h1>
                                    x Successes, y Failed
                                </div>
                                <div id="editorsampleimgs">
                                    <a class="testpiclink" href="#basic-testprev">
                                       <div class='esi testpic'>
                                           <img src="./images/dummy.JPG" class='boright test'/>
                                           <img src="./images/dummy.JPG" class='edited'/>
                                       </div>
                                    </a>
                                    <a class="testpiclink" href="#basic-testprev">
                                       <div class='esi testpic'>
                                           <img src="./images/dummy.JPG" class='boright test'/>
                                           <img src="./images/dummy.JPG" class='edited'/>
                                       </div>
                                    </a>
                                    <a class="testpiclink" href="#basic-testprev">
                                       <div class='esi testpic' style='margin-right:0px;'>
                                           <img src="./images/dummy.JPG" class='boright test'/>
                                           <img src="./images/dummy.JPG" class='edited'/>
                                       </div>
                                    </a>
                                </div>
                                <div id='givePreference'>
                                    <img class="star" onclick="prefToggle(this)" src="./images/unselected.png">
                                </div>
                            </div>
                            <hr id="hr1" class='editorrule'/>
                           <div data-id='0' style="visibility:hidden" class="editor" data-chosen="false">
                                <div id="editorsf">
                                    <h1 id='EditorName'>Jimmy Falcon2</h1>
                                    x Successes, y Failed
                                </div>
                                <div id="editorsampleimgs">
                                    <a class="testpiclink" href="#basic-testprev">
                                       <div class='esi testpic'>
                                           <img src="./images/dummy.JPG" class='boright test'/>
                                           <img src="./images/dummy.JPG" class='edited'/>
                                       </div>
                                    </a>
                                    <a class="testpiclink" href="#basic-testprev">
                                       <div class='esi testpic'>
                                           <img src="./images/dummy.JPG" class='boright test'/>
                                           <img src="./images/dummy.JPG" class='edited'/>
                                       </div>
                                    </a>
                                    <a class="testpiclink" href="#basic-testprev">
                                       <div class='esi testpic' style='margin-right:0px;'>
                                           <img src="./images/dummy.JPG" class='boright test'/>
                                           <img src="./images/dummy.JPG" class='edited'/>
                                       </div>
                                    </a>
                                </div>
                                <div id='givePreference'>
                                    <img class="star" onclick="prefToggle(this)" src="./images/unselected.png">
                                </div>
                            </div>
                              <hr id="hr2" class='editorrule'/>
                              
                            <div data-id='0' style="visibility:hidden" class="editor" data-chosen="false">
                                <div id="editorsf">
                                    <h1 id='EditorName'>Jimmy Falcon3</h1>
                                    x Successes, y Failed
                                </div>
                                <div id="editorsampleimgs">
                                    <a class="testpiclink" href="#basic-testprev">
                                       <div class='esi testpic'>
                                           <img src="./images/dummy.JPG" class='boright test'/>
                                           <img src="./images/dummy.JPG" class='edited'/>
                                       </div>
                                    </a>
                                    <a class="testpiclink" href="#basic-testprev">
                                       <div class='esi testpic'>
                                           <img src="./images/dummy.JPG" class='boright test'/>
                                           <img src="./images/dummy.JPG" class='edited'/>
                                       </div>
                                    </a>
                                    <a class="testpiclink" href="#basic-testprev">
                                       <div class='esi testpic' style='margin-right:0px;'>
                                           <img src="./images/dummy.JPG" class='boright test'/>
                                           <img src="./images/dummy.JPG" class='edited'/>
                                       </div>
                                    </a>
                                </div>
                                <div id='givePreference'>
                                    <img class="star" onclick="prefToggle(this)" src="./images/unselected.png">
                                </div>
                            </div>
                            <div id="clearDiv" style="clear:both"></div>
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
                <section class="semantic-content" data-order="2" id="basic-testprev" tabindex="-1" role="dialog" aria-labelledby="modal-label4" aria-hidden="true">
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
                </section>
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
                <label for="fileToUpload" id='pushl' class='label_upload' >Add more pictures</label>
                <div style="clear:both; width:100%;height:30px;"></div>
                <div id="uploaddiv" style="visibility:hidden">
                
                <button  class='label_upload2 modalButton' id="uploadButton2" style="visibility:visible" onclick="uploadFile()">Upload</button>
                <div class='post_upload' style="margin-top:10px;"></div>
                </div>
                   <div class="progressNumber">
                       <div class='greenbar' style="width:75%;"></div><div class='bluebar' style='width:25%;'></div>
                       <div class='uploadper'>25<span style='color:#3399CC'>%</span></div>
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
                    <img id="prevpic" src="./images/dummy2.jpg">
                    
                    </div>
                   <div id='picinstr'>
                        <textarea id='instrfeditor' placeholder='Type Instructions...' ></textarea>
                        <input type='submit' value='SAVE' onclick="saveInstr()" id='savebtn'/>
                    </div>
                </div>
                <footer>
                        <button class='footerb round-corners modalButton' data-modal='basic-imagesprev' style='float:left;'>Back To Uploads</button>
                    
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
                            <span>Project No</span>1534648
                        </div>
                        <div id='summr' style="">
                            <span>Email </span><input id='finEmail' type='text' value='avinsingh007@gmail.com'/>
                        </div>
                        <div id='summc'><span> XY </span>Photos Uploaded For Editing!</div>
                        <div style="clear:both; height:40px; width:100%;"></div>
                        
                        <textarea id='finprojinstrfeditor' placeholder='Type Instructions...' ></textarea>
                        <div style="clear:both; height:40px; width:100%;"></div>
                        <div id='summinstrhead'><span>Instructions for You</span></div>
                        <div id='summinstr'>Google Chrome
Copyright 2014 Google Inc. All rights reserved.
Google Chrome is made possible by the Chromium open source project and other open source software.
Google Chrome Terms of Service
                        </div>
                        <div id='summack'>Thank You for your co-operation!</div>
                    </div> 
                </div>
                <footer>
                    <button id='finishProj' class='bfooterb round-corners' style="margin-right:47%;">OK</button>
                </footer>
                </div>
                <!-- Use Hash-Bang to maintain scroll position when closing modal -->
                <a href="#!" class="modal-close" title="Close this modal"
                    data-dismiss="modal">&times;</a>
                </section>
                <!-- ********************************************************************************************************************* -->



        <script src="js/jquery-1.11.0.min.js"></script>
        <script src="js/unslider.js"></script>
        <script src="js/modal.js"></script><!-- JS for Modal -->
        <script src='js/progressbar.js'></script>
        <script src='js/edit.js'></script>
        <script>$(function() {
                                    $('.banner').unslider(
                                        {
                                            dots:true,
                                            fluid:true
                                        });
                                }); 
        </script>
        <script type="text/javascript">
        $(function()
            {
                $('#basictable').click(function(){
                    $('#basictable').css('height','700px');
                });
                $('#advancedtable').click(function(){
                    $('#advancedtable').css('height','700px');
                });
            });
        </script>
    </body>
  </html>