<?php
	require_once("../includes/init.php");
	$session = AdminSession::get_instance();
	//$session->require_login();
	$confirmed = Project::find_by_sql("SELECT id, name, type, submittime FROM projects WHERE status = '".Project::CONFIRMED."' ORDER BY id DESC");
	$unconfirmed = Project::find_by_sql("SELECT id, name, type, submittime FROM projects WHERE status = '".Project::UNCONFIRMED."' ORDER BY id DESC");
	$completed = Project::find_by_sql("SELECT id, name, type, submittime FROM projects WHERE status = '".Project::COMPLETED."' ORDER BY id DESC");
	$cancelled = Project::find_by_sql("SELECT id, name, type, submittime FROM projects WHERE status = '".Project::CANCELLED."' ORDER BY id DESC");
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
	<link rel="stylesheet" href="../css/progressbar.css">

	</head>

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
				Editor &nbsp;Account&nbsp;
			</li>

		</ul>
		</div>

	</div> 

	<div id='wrapper'>
		<h5 id='wel'>Welcome <span class='greenc'><?php echo $session->logged_in_user()->firstname.'!';?></span></h5>
	<div class='pagers'>
		<input type='radio' name='projCategory' id='confirmed' class='projCategory' checked><label for='confirmed'>Confirmed</label>
		<input type='radio' name='projCategory' id='unconfirmed' class='projCategory'><label for='unconfirmed'>Unconfirmed</label>
		<input type='radio' name='projCategory' id='completed' class='projCategory'><label for='completed'>Completed</label>
		<input type='radio' name='projCategory' id='cancelled' class='projCategory'><label for='cancelled'>Cancelled</label>
	</div>
		<div id='confirmedProj'>
			<div id='rowHeader' class='bluec'>
				<div>ID</div>
				<div>Project</div>
				<div>Submission Date</div>
				<div>Editor</div>
			</div>

			<div class='tableHR'></div>
	<?php if(is_array($confirmed))
				foreach($confirmed as $confirmedProj) :?>
			<div class='rowElement'>
				<div class='col1'><?php echo $confirmedProj->id;?></div>
				<div class='col2'><?php echo $confirmedProj->name;?><br/><a href="projView.php?id=<?php echo $confirmedProj->id;?>" style="text-decoration:none;color:inherit;" class='greenb customButton1'>Click To View</a></div>
				<div class='col3'><?php echo strftime('%d-%m-%Y %H:%M',$confirmedProj->submittime);?></div>
				<div class='col4'><?php if(!$confirmedProj->is_free()) $editor = Editor::find_for($confirmedProj); echo (!isset($editor))?"none":"<a href='editorProfile.php?id=".$editor->id."'>".$editor->username."</a>";?></div>
			</div>
			<div class='tableHR'></div>
	<?php endforeach;?>

		</div>
	
	
	<div id='unconfirmedProj' style='display:none'>
			<div id='rowHeader' class='bluec'>
				<div>ID</div>
				<div>Project</div>
			</div>

			<div class='tableHR'></div>
	<?php if(is_array($unconfirmed))
				foreach($unconfirmed as $unconfirmedProj) :?>
			<div class='rowElement'>
				<div class='col1'><?php echo $unconfirmedProj->id;?></div>
				<div class='col1'><?php echo $unconfirmedProj->name;?></div>
			</div>
			<div class='tableHR'></div>
	<?php endforeach;?>

		</div>
	
	<div id='completedProj' style='display:none'>
			<div id='rowHeader' class='bluec'>
				<div>ID</div>
				<div>Project</div>
				<div>Submit time</div>
				<div>Chosen pics</div>
			</div>

			<div class='tableHR'></div>
	<?php if(is_array($completed))
				foreach($completed as $completedProj) :?>
			<div class='rowElement'>
				<div class='col1'><?php echo $completedProj->id;?><br/></div>
				<div class='col2'><?php echo $completedProj->name;?><br/><a href="projView.php?id=<?php echo $completedProj->id;?>" style="text-decoration:none;color:inherit;" class='greenb customButton1'>Click To View</a></div>
				<div class='col3'><?php echo strftime('%d-%m-%Y %H:%M',$completedProj->submittime);?></div>
				<div class='col4'><span class='bluec'><?php echo $completedProj->chosen_pics_count();?></span><br/> photos <br/></div>
			</div>
			<div class='tableHR'></div>
	<?php endforeach;?>

		</div>
	
	
	<div id='cancelledProj' style='display:none'>
			<div id='rowHeader' class='bluec'>
				<div>ID</div>
				<div>Project</div>
			</div>

			<div class='tableHR'></div>
	<?php if(is_array($cancelled))
				foreach($cancelled as $cancelledProj) :?>
			<div class='rowElement'>
				<div class='col1'><?php echo $cancelledProj->id;?></div>
				<div class='col2'><?php echo $cancelledProj->name;?><br/><a href="projView.php?id=<?php echo $cancelledProj->id;?>" style="text-decoration:none;color:inherit;" class='greenb customButton1'>Click To View</a></div>
			</div>
			<div class='tableHR'></div>
	<?php endforeach;?>

		</div>
	
	</div>


	<footer></footer>
</body>
<script>
	radios = document.getElementsByClassName('projCategory');
	for(var i=0;i<radios.length;i++)
		radios[i].onchange = function() {
			radios = document.getElementsByClassName('projCategory');
			for(var i=0;i<radios.length;i++)
				if(radios[i].checked)
					document.getElementById(radios[i].id+'Proj').style.display='block';
				else
					document.getElementById(radios[i].id+'Proj').style.display='none';
		}
</script>
</html>
