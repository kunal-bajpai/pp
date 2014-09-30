<?php
	require_once("../includes/init.php");
	$session = AdminSession::get_instance();
	$session->require_login();
	$editor = Editor::find_by_id($_GET['id']);
	$files = scandir(SITE_ROOT."/pictures/tests");
	$testFiles = array();
	if(is_array($files))
	{
		foreach($files as $file)
			if($file!='.' && $file!='..')
				$testFiles[] = $file;
	}
	if(isset($_POST['amount']))
	{
		$payout = new Payout();
		$payout->timestamp = time();
		$payout->total = $_POST['total'];
		$payout->bankname = $_POST['bankname'];
		$payout->ifsc = $_POST['ifsc'];
		$payout->acname = $_POST['acname'];
		$payout->txnid = $_POST['txnid'];
		$payout->acno = $_POST['acno'];
		$payout->basic_price = BASIC_PRICE;
		$payout->advanced_price = ADVANCED_PRICE;
		$payout->save();
		$payout->addTo($editor,$_POST['project']);
	}
	if(isset($_POST['status']) && $_POST['status'] == Editor::APPROVED || $_POST['status'] == Editor::DISAPPROVED)
	{
		$editor->status = $_POST['status'];
		$editor->save();
	}
	$basicProjects = Project::find_by_sql("SELECT projects.id, projects.name, COUNT(*) count FROM projects JOIN pictures ON pictures.project = projects.id JOIN donepics ON donepics.original = pictures.id WHERE donepics.chosen = 1 AND donepics.editor = {$editor->id} AND projects.type = 0 AND donepics.editor NOT IN (SELECT editor FROM edit_payout WHERE project = projects.id) GROUP BY projects.id;");
	$advancedProjects = Project::find_by_sql("SELECT projects.id, projects.name, COUNT(*) count FROM projects JOIN pictures ON pictures.project = projects.id JOIN donepics ON donepics.original = pictures.id WHERE donepics.chosen = 1 AND donepics.editor = {$editor->id} AND projects.type = 1 AND donepics.editor NOT IN (SELECT editor FROM edit_payout WHERE project = projects.id) GROUP BY projects.id;");
	$basicDue = 0;
	$advancedDue = 0;
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
	<link rel="icon" href="../images/favicon.ico" type="image/pp-icon"/>
	<link href="../css/style_editor.css" rel="stylesheet">
	<link href="../css/reset.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/modal.css">
	<link rel="stylesheet" href="../css/menu.css">
	<link rel="stylesheet" href="../css/progressbar.css">

	</head>

<script>
	var editorId = <?php echo $editor->id;?>;
</script>

<body>

	<div id="logobkg">
	<a href="editor.php">
	<img id="instr1" src="../images/pp5.png" onmouseover="this.src='../images/pp6.png'" onmouseout="this.src='../images/pp5.png'"/>
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
		<div>
			<table>
				Basic projects
				<tr><td>ID</td><td>Name</td><td>Count</td></tr>
				<?php if(is_array($basicProjects))
						foreach($basicProjects as $proj): ?>
					<tr><td><?php echo $proj->id;?></td><td><?php echo $proj->name;?></td><td><?php echo $proj->count;?></td></tr>
				<?php $basicDue+=BASIC_PRICE*$proj->count;endforeach;?>
				<tr><td><?php echo $basicDue;?></td></tr>
			</table>
		</div>
		<div>
			<table>
				Advanced Projects
				<tr><td>ID</td><td>Name</td><td>Count</td></tr>
				<?php if(is_array($advancedProjects))
						foreach($advancedProjects as $proj): ?>
					<tr><td><?php echo $proj->id;?></td><td><?php echo $proj->name;?></td><td><?php echo $proj->count;?></td></tr>
				<?php $advancedDue+=ADVANCED_PRICE*$proj->count;endforeach;?>
				<tr><td><?php echo $advancedDue;?></td></tr>
			</table>
		</div>
		<div>
			<form method="POST">
				<input type='hidden' name='amount' value='<?php echo $basicDue + $advancedDue;?>'/>
				<?php if(is_array($advancedProjects))
						foreach($advancedProjects as $proj): ?>
							<input type='hidden' name='project[]' value='<?php echo $proj->id;?>'/>
				<?php endforeach;?>
				<?php if(is_array($basicProjects))
						foreach($basicProjects as $proj): ?>
							<input type='hidden' name='project[]' value='<?php echo $proj->id;?>'/>
				<?php endforeach;?>
				<p>Total payout worth Rs. <?php echo $basicDue + $advancedDue;?> /-</p><br/>
				Bank name <input type='text' name='bankname' value='<?php echo $editor->bankname;?>'/><br/>
				IFS Code <input type='text' name='ifsc' value='<?php echo $editor->ifsc;?>'/><br/>
				Payee name <input type='text' name='acname' value='<?php echo $editor->acname;?>'/><br/>
				A/c no. <input type='text' name='acno' value='<?php echo $editor->acno;?>'/><br/>
				Transaction ID <input type='text' name='txnid'/><br/>
				<input type='submit'/>
			</form>
			<form method="POST">
			<?php
				if($editor->status == Editor::PENDING || $editor->status == Editor::APPROVED):?>
				<input type='hidden' name='status' value='<?php echo Editor::DISAPPROVED;?>'/>
				<input type='submit' value='Disapprove' />
				<?php else:?>
				<input type='hidden' name='status' value='<?php echo Editor::APPROVED;?>'/>
				<input type='submit' value='Approve' />
			<?php endif;?>
			</form>
		</div>
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

		<div class='fullBlackOverlay' style='display:none'></div>
		<div id='photoModal1' class='photoModal'>
			<img id='prevPic11' src="./images/dummy.jpg">
			<img id='prevPic12' src="./images/dummy.jpg">
			<div id='closeButton1' class='closebutton bluec'> &times;</div>
			<div id='leftButton1' class='modalButton bluec'><</div>
			<div id='rightButton1' class='modalButton bluec'>></div>
		</div>
		
	<footer></footer>
</body>

<script src="js/editorProfile.js"></script>

</html>
