<?php
    require_once("includes/init.php");
    $session = Session::get_instance();
    //$session->require_login();
    $editor = $session->logged_in_user();
    $files = scandir(SITE_ROOT."/pictures/tests");
	$testFiles = array();
	if(is_array($files))
	{
		foreach($files as $file)
			if($file!='.' && $file!='..')
				$testFiles[] = $file;
	}
?>
 <!DOCTYPE html>

 <html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>EDITOR'S PAGE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico" type="image/pp-icon"/>
    <link href="css/style_editor.css" rel="stylesheet">
    <link href="css/reset.css" rel="stylesheet">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/progressbar.css">

    </head>

<script>
    var editorId = <?php echo $editor->id;?>;
</script>

<body>

    <div id="logobkg">
    <a href="editor.php">
    <img id="instr1" src="images/pp5.png" onmouseover="this.src='images/pp6.png'" onmouseout="this.src='images/pp5.png'"/>
    </a>
    </div>
     
   <?php include("editHeader.html");?>

 <div id='mininav' class='wrap3'>

        <div id="lefter">
        <ul id='navleft' class="submenu">
            <li>
                Re-take tests
            </li>
        </ul>
        </div>
    </div>

    <div id='wrapper'>
		<div id='editPicsPreview'>
           <?php
           		if(is_array($testFiles))
           			foreach($testFiles as $testFile):
           	?>
            <div id='imgBox' class='selectable imgBox' data-selected='0' >
                <img id='imgThumb' class='imgThumb' src='<?php echo "pictures/tests/".$testFile;?>' data-pic='<?php echo $testFile;?>'>
                <div id='blackOverlay' class='blackOverlay greenc'>selected</div>
                <div id='tickSym' class='tickSym greenc'> &#10004;</div>
                <div id='toSelect' class='toSelect greenc'>Select</div>
                <div id='toUnselect' class='toUnselect greenc'>Unselect</div>
            </div>
            <div id='imgBox' class='imgBox'>
                <img id='imgThumb' class='edited imgThumb' src='<?php echo "pictures/editors/editor".$editor->id."/".$testFile;?>' data-pic='<?php echo $testFile;?>'>
            </div>
            <div class='clearfix20'></div>
			<?php endforeach;?>
		</div>
        <div id='dwnldButton'>
            <button id='dwnldButton1' class='blueb round-corners'>Download Selected</button>
            <button id='dwnldButton2' class='greenb round-corners'>Download All</button>
        </div>

        <div class='clearfix20'></div>


        <div id='dwnldButton'>
        	<form id="projectDetails" enctype="multipart/form-data" method="post">
	            <input type="file" form="fileForm" name="fileToUpload[]" id="fileToUpload" accept="image/*" onchange="fileSelected();" multiple style="display:none"/>
	            <input type="hidden" name="projid" id="formProjId"/>
	        </form>
	        <form id="fileForm"></form>
            <label for="fileToUpload" id='pushl' class='label_upload' >Add more pictures</label>
            <div id="uploaddiv" style="visibility:hidden">
                
                <button  class='label_upload2 modalButton' id="uploadButton2" style="visibility:hidden" onclick="uploadFile()">Upload</button>
                <div class='post_upload' style="margin-top:10px;"></div>
            </div>
			<div class="progressNumber" style='visibility:hidden'>
				<div class='greenbar' style="width:75%;"></div><div class='bluebar' style='width:25%;'></div>
				<div class='uploadper'>25<span style='color:#3399CC'>%</span></div>

			</div>
        </div>

        <div class='clearfix20'></div>

        <div class='fullBlackOverlay'></div>
		<div id='photoModal1' class='photoModal'>
            <img id='prevPic11' src="./images/dummy.jpg">
            <img id='prevPic12' src="./images/dummy.jpg">
            <div id='closeButton1' class='closebutton bluec'> &times;</div>
            <div id='leftButton1' class='modalButton bluec'><</div>
            <div id='rightButton1' class='modalButton bluec'>></div>
        </div>
        
    <footer></footer>
</body>

<script src="js/editTakeTest.js"></script>

</html>
