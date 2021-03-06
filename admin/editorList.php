<?php
	require_once("../includes/init.php");
	$session = AdminSession::get_instance();
	$session->require_login();
?><!DOCTYPE html>

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

<body>


	<div id="logobkg">
	<a href="editor.php">
	<img id="instr1" src="../images/pp5.png" onmouseover="this.src='../images/pp6.png'" onmouseout="this.src='../images/pp5.png'"/>
	</a>
	</div>

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
		<h5 id='wel'>Welcome <span class='greenc'><?php echo $session->logged_in_user()->firstname;?>!</span></h5>
		<div class='pagers' id='pagerHeader'>
			<input type="radio" class="status" name="status1" value="-5" id="all1" checked/><label for="all1">All</label>&nbsp;
			<input type="radio" class="status" name="status1" value="-2" id="pend1"/><label for="pend1">Pending</label>&nbsp;
			<input type="radio" class="status" name="status1" value="-4" id="app1"/><label for="app1">Approved</label>&nbsp;
			<input type="radio" class="status" name="status1" value="-3" id="disapp1"/><label for="disapp1">Disapproved</label><br/>
			<button onclick="prev()" class='pagbuttons'>< Prev</button> <p class='startPage'></p> Page <input type='text' class='currentPage'> of <p class='endPage'></p> <button onclick="next()" class='pagbuttons'>Next ></button>
			<br>Results per page : <select class="resultPerPage"><option selected>3</option><option>5</option><option>10</option><option>20</option></select><br/>
			<p class="refreshing"></p>
		</div>

		<div id='editorTable'>
			<div id='rowHeader' class='bluec'>
				<div>ID</div>
				<div>Name</div>
			</div>

			<div class='tableHR'></div>
			<div id="dummyDiv" style='display:none'>
				<div class='rowElement'>
					<div class='col1'><div class='id'>Avinash Singh</div><br/><a class='greenb round-corners customButton1' href="editorProfile.php" style="text-decoration:none;color:inherit;">Click To View</a></div>
					<div class='col2'>29-05-2013</div>
				</div>
				<div class='tableHR'></div>
			</div>
		</div>

		<div class='pagers' id='pagerFooter'>
			<input type="radio" class="status" name="status2" value="-5" id="all2" checked/><label for="all2">All</label>&nbsp;
			<input type="radio" class="status" name="status2" value="-2" id="pend2"/><label for="pend2">Pending</label>&nbsp;
			<input type="radio" class="status" name="status2" value="-4" id="app2"/><label for="app2">Approved</label>&nbsp;
			<input type="radio" class="status" name="status2" value="-3" id="disapp2"/><label for="disapp2">Disapproved</label><br/>
			<button onclick="prev()" class='pagbuttons'>< Prev</button> <p class='startPage'></p> Page <input type='text' class='currentPage'> of <p class='endPage'></p> <button class='pagbuttons' onclick="next()">Next ></button>
			<br>Results per page : <select class="resultPerPage"><option selected>3</option><option>5</option><option>10</option><option>20</option></select><br/>
			<p class="refreshing"></p>
		</div>
	</div>

	<footer></footer>
</body>
<script src='js/editorList.js'></script>
</html>
