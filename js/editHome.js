var stage = 1, //stores current stage in which the process of project creation is and allows only those modals
	mode=2, //0 for basic, 1 for advanced, 2 for none
	currentPic=0, //index in array of pictures of current picture in the preview carousel
	currentPicName, //full path of current pic
	currentTestPic=0, //index in array of test pictures of current picture in the preview carousel
	currentTestPicName, //full path of current test pic
	editorId=0, //id of currently chosen editor for viewing test images
	projectName, //name given to project
	email, //email of user
	projInstr, //project instructions for editor
	xmleditor, //xhr object to fetch editors
	xmlUpload, //xhr for uploading photos
	testImgs, //test images
	uploadedPictures, //array of names of all uploaded pictures
	projectId=0, //project id received from server. 0 means project not added to db yet
	projectPass, //password for the customer to log in to custSignin.php
	projectCheck, //checkcode for accessing customer account
	uploadStart = false, //flag to check if upload has started
	uploadComp = false, //flag to check if upload has completed
	fileQueue, //file queue for download
	currentFile = 0; //pointer to current file being uploaded in queue
if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
	xmleditor=new XMLHttpRequest();
	}
else
	{// code for IE6, IE5
	xmleditor=new ActiveXObject("Microsoft.XMLHTTP");
	}

//function to check stage that the process is in and only allow the modal for that stage. any other hash change is rejected
window.onload = window.onhashchange = function() {
	if(window.location.hash!='#!' && window.location.hash!='')
	{
		document.getElementById("popupProgress").style.visibility = "hidden";
		window.arrowSlide = false;
		switch(stage)
		{
			case 1: if(window.location.hash!='#basic-upload-photos')
					{window.location.hash = '!';}
					break;
			case 2: if(window.location.hash != '#basic-testprev')
					{window.location.hash = 'basic-uploading';}
					break;
			case 3: if(window.location.hash!='#basic-instr' && window.location.hash != '#basic-testprev' && window.location.hash!='#basic-summary')
					{window.location.hash = 'basic-imagesprev';}
					break;
		}
	}
	else
	{
		window.arrowSlide = true;
		switch(stage)
		{
			case 2: if(uploadStart)
					{document.getElementById("popupProgress").style.visibility = "visible"; break;}
			case 3: document.getElementById("popupProgress").style.visibility = "visible"; break;
		}
	}
}

//sets the mode when basic or advanced project is created
function setMode(newMode) {
	switch(newMode)
	{
		case 0: //basic editing mode
			var elems = document.getElementsByClassName("largermodalhead");
			for(var i=0;i<elems.length;i++)
			{
				elems[i].innerHTML = "Basic";
				elems[i].className = "largermodalhead greenc";
			}
			elems = document.getElementsByClassName("smallermodalhead");
			for(i=0;i<elems.length;i++)
				elems[i].className = "smallermodalhead greenc";
			document.getElementById("formMode").value="0";
			document.getElementById("picinstr").style.visibility = "hidden";
			mode = 0;
			break;
		case 1: //advanced editing mode
			var elems = document.getElementsByClassName("largermodalhead");
			for(var i=0;i<elems.length;i++)
			{
				elems[i].innerHTML = "Advanced";
				elems[i].className = "largermodalhead bluec";
			}
			elems = document.getElementsByClassName("smallermodalhead");
			for(i=0;i<elems.length;i++)
				elems[i].className = "smallermodalhead bluec";
			document.getElementById("formMode").value="1";
			document.getElementById("picinstr").style.visibility = "visible";
			mode = 1;
			break;	
		case 2: //reset the page so that another project can be created
			stage = 1;
			mode = 2;
			projectName = '';
			email = '';
			projInstr = '';
			projectId = 0;
			projectCheck = null;
			projectPass = null;
			document.getElementById("link").href = '';
			document.getElementById("pass").innerHTML = '';
			uploadStart = false;
			uploadComp = false;
			uploadedPictures = null;
			
			//set all editor prefs to false and add new ones
			var editors = document.getElementById('editorlist').getElementsByClassName("editor");
			for(var i=0;i<3;i++)
			{
				if(editors[i].dataset.chosen == "true")
					prefToggle(editors[i]);
			}
			
			var num = document.getElementsByClassName('progressNumber'); //hide progress bar
			for(i=0;i<num.length;i++)
				num[i].style.display='none';
				
			var buttons = document.getElementsByClassName("label_upload"); //show select files button
			for(i=0;i<buttons.length;i++)
				buttons[i].style.display= "block";
					
			document.getElementById("fileToUpload").value=''; //reset file input
			document.getElementById("projectName").value=''; //reset project name form field
			document.getElementById("userEmail").value=''; //reset email form field
			document.getElementById("projinstrfeditor").value=''; //reset instructions form field
			postuploads = document.getElementsByClassName("post_upload"); //reset file info
			for(i=0;i<postuploads.length;i++)
				postuploads[i].innerHTML = '';
				
			upstage = document.getElementsByClassName("uploadStage"); //reset file info
			for(i=0;i<upstage.length;i++)
				upstage[i].innerHTML = 'Uploading and processing photos. Please wait...';
		
			//remove all images from preview modal
			var imgs = document.getElementsByClassName("previmgdiv");
				for(i=imgs.length-1;i>=0;i--)
					imgs[i].parentNode.removeChild(imgs[i]);
			
			//remove warning when unloading page
			window.onbeforeunload = null;
	}
}

//on clicking ok button in summary page
document.getElementById("finishProj").onclick = function() {

	//checking validity of email
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(!re.test(document.getElementById("finEmail").value))
	{
		alert("Please enter a valid email");
		return false;
	}
	
	//checking if project name is set and not just a series of spaces
	if(document.getElementById("finProjName").value == null || document.getElementById("finProjName").value.replace(/\s/g,"") == "")
	{
		alert("Please enter a valid project name");
		return false;
	}
	
	finaliseProj();
	setMode(2);
	window.location.hash='!';
}

//ajax call to server to finalise the project
function finaliseProj()	{
	xhr = new XMLHttpRequest();
	xhr.open("POST","ajax/finalise.php",true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	//get final email, project name and instructions
	email = document.getElementById("finEmail").value;
	projectName = document.getElementById("finProjName").value;
	projectInstr = document.getElementById("finprojinstrfeditor").value;
	
	//get editor preferences
	var prefs = '';
	var editors = document.getElementById('editorlist').getElementsByClassName("editor");
	for(var i=0;i<3;i++)
	{
		if(editors[i].dataset.chosen == "true")
			prefs+="&pref[]="+editors[i].dataset.id;
	}
	xhr.send("id="+projectId+"&name="+projectName+"&email="+email+"&instructions="+projectInstr+prefs);
}

//on clicking on basic editing button
document.getElementById("basicup").onclick = function() {
 	if(stage == 1)
	 	setMode(0);
 	modal = document.getElementById(this.dataset.modal);
 	window.location.hash = this.dataset.modal;
}

//on clicking advanced editing button
document.getElementById("advup").onclick = function() {
	if(stage == 1)
	 	setMode(1);
 	modal = document.getElementById(this.dataset.modal);
 	window.location.hash = this.dataset.modal;
}

//preview images button onclick listener ie after uploading pictures
document.getElementById("previewButton").onclick = function() {
	if(uploadComp)
		stage=3;
 	modal = document.getElementById(this.dataset.modal);
 	window.location.hash = this.dataset.modal;
}

//after giving instructions, proceed to summary
document.getElementById("summaryButton").onclick = function() {
	document.getElementById("summhead").querySelector("input").value = projectName;
	document.getElementById("summl").innerHTML = "<span>Project No</span> "+projectId;
	document.getElementById("link").href = "http://www.photopuddle.com/custSignin.php?projId="+projectId+"&check="+projectCheck;
	document.getElementById("pass").innerHTML = projectPass;
	document.getElementById("summr").querySelector("input").value = email;
	document.getElementById("summc").querySelector("span").innerHTML = uploadedPictures.length;
	document.getElementById("finprojinstrfeditor").value = projInstr;
	window.location.hash = this.dataset.modal;
}

//on clicking upload files, validate form
document.getElementById("uploadButton").onclick = function() {
	modal = document.getElementById(this.dataset.modal);
	
	//checking if pictures have been selected
	if(document.getElementById("fileToUpload").files.length<=0)
	{
		alert("Please select some photos");
		return false;
	}
	
	//checking validity of email
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(!re.test(document.getElementById("userEmail").value))
	{
		alert("Please enter a valid email");
		return false;
	}
	
	//checking if project name is set and not just a series of spaces
	if(document.getElementById("projectName").value == null || document.getElementById("projectName").value.replace(/\s/g,"") == "")
	{
		alert("Please enter a valid project name");
		return false;
	}
	projectName = document.getElementById("projectName").value;
 	email = document.getElementById("userEmail").value;
 	projInstr = document.getElementById("projinstrfeditor").value;
 	uploadStart = true;
	stage = 2;
	
	var upStage = document.getElementsByClassName('uploadStage')
	for(var i=0;i<upStage.length;i++)
		upStage[i].innerHTML='Uploading and processing photos. Please wait...';
		
	postuploads = document.getElementsByClassName("post_upload"); //reset file info
			for(i=0;i<postuploads.length;i++)
				postuploads[i].innerHTML = '';
				
	//set onbeforeunload to prevent user from accidentally closing page
	window.onbeforeunload = function() {
		return "You have created a project.\nLeaving the page will scrap it!";
	}
	uploadFile();
	window.location.hash = this.dataset.modal;
}

//ajax call to save instruction for a particular picture
function saveInstr() {
	var instr = document.getElementById("instrfeditor").value;
	xmleditor.open("POST","ajax/saveInstr.php",true);
	xmleditor.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmleditor.send("instr="+instr+"&id="+uploadedPictures[currentPic]['id']);
	uploadedPictures[currentPic]['instr'] = instr;
}

//general event listener for modal close buttons
var modalCloseButtons = document.getElementsByClassName('modalCloseButton');
for(var i=0; i<modalCloseButtons.length; i++)
{
		modalCloseButtons[i].onclick = function() {
			if(projectId!=0 || uploadStart)
			{
				if(confirm("You have uploaded some pictures.\nCancelling the project will delete them and scrap the project."))
				{
					xmlUpload.abort();
					var xmlcancel = new XMLHttpRequest();
					xmlcancel.open("POST","ajax/cancel.php",true);
					xmlcancel.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlcancel.send("id="+projectId);
					setMode(2);
				}
				else
					return false;
			}
			window.location.hash = '!';
		}
}

//on clicking on a particular picture, bring it up in the preview carousel
function setPic() {
	
	//iterate through uploadedPictures to find index of image clicked on
	for(var i=0;i < uploadedPictures.length;i++)
		if(uploadedPictures[i]['name']==currentPicName)
		{
			currentPic=i; //store index of pic which will be used later to move forward and backward in the carousel
			break;
		}
	document.getElementById("prevpic").src = "pictures/projects/project" + projectId + "/original/prev/" + currentPicName;
	
	//load instruction for that image if specified earlier
	document.getElementById("instrfeditor").value = '';
	if(uploadedPictures[currentPic]['instr']!=undefined)
		document.getElementById("instrfeditor").value = uploadedPictures[currentPic]['instr'];
	else
		document.getElementById("instrfeditor").value = '';
}

//goes to next pic in preview carousel if action>0 and previous if action<0
function changePic(action) {
	if(action > 0)
		if(currentPic >= uploadedPictures.length-1)
			currentPic = 0;
		else
			currentPic++;
	if(action < 0)
		if(currentPic <= 0)
			currentPic = uploadedPictures.length - 1;
		else
			currentPic--;
	document.getElementById("prevpic").src = "pictures/projects/project" + projectId + "/original/" + uploadedPictures[currentPic]['name'];
	
	//load instruction for that image if specified earlier
	document.getElementById("instrfeditor").value = '';
	if(uploadedPictures[currentPic]['instr']!=undefined)
		document.getElementById("instrfeditor").value = uploadedPictures[currentPic]['instr'];
	else
		document.getElementById("instrfeditor").value = '';
}



//ajax call to delete an uploaded image by id
function deleteImage(id) {
	xmleditor.open("POST","ajax/deleteImage.php",true);
	xmleditor.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmleditor.send("id="+id);
}

//add images in the preview pictures modal
function prevPictures() {
	//for each uploaded picture, create a div in the preview modal
	for(var i=0;i<uploadedPictures.length;i++)
	{
		pic = document.createElement("img");
		div = document.createElement("div");
		div.className = 'previmgdiv';
		button = document.createElement("button");
		button.innerHTML = "X";
		a = document.createElement("a");
		a.onclick = function() {
			currentPicName = this.querySelector("img").dataset.pic;
			setPic();
			window.location.hash="basic-instr";
		}
		
		//deleting image
		button.onclick = function() {
			deleteImage(this.parentNode.querySelector("img").dataset.id);
			for(var i=0;i < uploadedPictures.length;i++)
				if(uploadedPictures[i]['id']==this.parentNode.querySelector("img").dataset.id)
				{
					currentPic=i;
					break;
				}
			uploadedPictures.splice(i,1); //remove from uploaded pictures array
			this.parentNode.parentNode.removeChild(this.parentNode); //delete div
		}
		
		a.appendChild(pic);
		div.appendChild(a);
		div.appendChild(button);
		pic.src = "pictures/projects/project"+projectId+"/original/thumbs/"+uploadedPictures[i]['name'];
		pic.dataset.pic = uploadedPictures[i]['name'];
		pic.dataset.id=uploadedPictures[i]['id']; //passed to server when deleting pic
		document.getElementById("picsprev").insertBefore(div,document.getElementById("prevClearDiv"));
	}
}

//get 'num' number of editors from the server via ajax. 'not' is the array of id of editors currently on screen so that the server does not include them in the search for new ones
function getEditors(num) {
	xmleditor.open("POST","ajax/getEditors.php",true);
	xmleditor.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmleditor.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200)	
			if(xmleditor.responseText!="")
				addToList(JSON.parse(xmleditor.responseText));
	}
	var editors = document.getElementById('editorlist').getElementsByClassName("editor");
	var not = new Array();
	for(var j=0;j<editors.length;j++)
		not[not.length] = editors[j].dataset.id;
	xmleditor.send("num="+num+"&not[]="+not[0]+"&not[]="+not[1]+"&not[]="+not[2]);
}

//adds the list of editors to preferences modal
function addToList(newEditorList) {
	var i=0;
	var editors = document.getElementById('editorlist').getElementsByClassName("editor");
	//if there were less than 3 editors being shown before then first extend the list to include new ones
	for(var j=0;j<3;j++)
	{
		if(editors[j].style.visibility=="hidden")
		{
			if(newEditorList != null && i in newEditorList)
			{
				editors[j].querySelector("#EditorName").innerHTML = newEditorList[i].firstname + ' ' + newEditorList[i].lastname;
				editors[j].dataset.id = newEditorList[i].id;
				editors[j].style.visibility = 'visible';
				testpics = editors[j].getElementsByClassName("testpic");
				for(var k=0;k<testpics.length;k++)
				{
					testpics[k].dataset.pic = testImgs[k]['name'];
					testpics[k].querySelector(".test").src="pictures/tests/"+testImgs[k]['name'];
					testpics[k].querySelector(".edited").src="pictures/editors/editor"+editors[j].dataset.id+"/thumbs/"+testImgs[k]['name'];
				}
				i++;
			}
		}
	}
	//after extending the list, if new editors are left then replace the unchosen editors with them
	if(newEditorList != null && i in newEditorList)
		for(j=0;j<3;j++)
		{
			if(editors[j].dataset.chosen=="false")
			{
				if(newEditorList[i])
				{
					editors[j].querySelector("#EditorName").innerHTML = newEditorList[i].name;
					editors[j].dataset.id = newEditorList[i].id;
					editors[j].style.visibility = 'visible';
					testpics = editors[j].getElementsByClassName("testpic");
					for(var k=0;k<testpics.length;k++)
					{
						testpics[k].dataset.pic = testImgs[k]['name'];
						testpics[k].querySelector(".test").src="pictures/tests/"+testImgs[k]['name'];
						testpics[k].querySelector(".edited").src="pictures/editors/editor"+editors[j].dataset.id+"/"+testImgs[k]['name'];
					}
					i++;
				}
			}
		}	
}

//counts number of editors which are not chosen yet and replaces them with new ones
function moreEditors() {
	var editors = document.getElementById('editorlist').getElementsByClassName("editor");
	var count =0;
	for(var i=0;i<3;i++)
	{
		if(editors[i].dataset.chosen == "false")
			count++;
	}	
	getEditors(count);
}

//toggle chosen attrubute of a particular editor between true and false and change the star icon accordingl
function prefToggle(elem) {
	if(elem.parentNode.parentNode.dataset.chosen == "false")
	{
		elem.src="images/selected.png";
		elem.parentNode.parentNode.dataset.chosen="true";
	}
	else
	{
		elem.src="images/unselected.png";
		elem.parentNode.parentNode.dataset.chosen="false";
	}
}

//if file is selected then populate its details. if none are selected then hide the existing details being shown
function fileSelected() {
	var files = document.getElementById('fileToUpload').files;
	//if no files selected then show upload file and select file buttons else hide them
	if(files.length>0)
	{
		document.getElementById("uploaddiv").style.visibility="visible";
		document.getElementById("uploadButton2").style.display="block";
	}
	else
	{
		stage = 1;
		document.getElementById("uploaddiv").style.visibility="hidden";
		document.getElementById("uploadButton2").style.display="none";
	}
	
	//calculate size of pictures chosen
		var fileSize = 0;
		if(files)
		for(var i=0;i<files.length;i++)
			fileSize += files[i].size;
	if (fileSize > 1024 * 1024)
			fileSize = (Math.round(fileSize * 100 / (1024 * 1024)) / 100).toString() + 'MB';
	else
		fileSize = (Math.round(fileSize * 100 / 1024) / 100).toString() + 'KB';	 
	var filedetdiv = document.getElementsByClassName("post_upload");
	for(i=0;i<filedetdiv.length;i++)
		if(files.length == 1)
			filedetdiv[i].innerHTML = files.length + " photo ("+ fileSize +") selected!";
		else
			filedetdiv[i].innerHTML = files.length + " photos ("+ fileSize +") selected!";
}

//ajax call to start uploading files
function uploadFile() {
	getEditors(3);
	var buttons = document.getElementsByClassName("label_upload"); //hide all select file buttons
	for(i=0;i<buttons.length;i++)
		buttons[i].style.display = "none";
	document.getElementById("uploadButton2").style.display="none"; //hide upload button in the preview modal
	
	//display the progress bar
	var num = document.getElementsByClassName('progressNumber')
	for(i=0;i<num.length;i++)
		num[i].style.display='block';
	fileQueue = document.getElementById("fileToUpload").files;
	currentFile = 0;
	upload();
}

cancelButtons = document.getElementsByClassName("cancelUpload");
for(i=0;i<cancelButtons.length;i++)
{
	cancelButtons[i].onclick = function() {
		xmlUpload.abort();
		if(window.location.hash=="#basic-imagesprev")
			afterComplete();
		else
			if(confirm("Cancelling the upload will scrap the project and you will have to start over."))
			{
				setMode(2);
				window.location.hash="#";
			}
	}
}

//upload current file in queue
function upload() {
	document.getElementById("formProjId").value = projectId; //add project id to form so that server can reference to it
	fd = new FormData(document.getElementById("projectDetails"));
	fd.append("fileToUpload[]",fileQueue[currentFile]);
	xmlUpload = new XMLHttpRequest();
	xmlUpload.upload.addEventListener("progress", uploadProgress, false);
	xmlUpload.addEventListener("load", uploadComplete, false);
	xmlUpload.addEventListener("error", uploadFailed, false);
	xmlUpload.addEventListener("abort", uploadCanceled, false);
	/* Be sure to change the url below to the url of your upload server side script */
	xmlUpload.open("POST", "ajax/upload.php");
	xmlUpload.send(fd); //let the uploading roll!
}

function uploadProgress(evt) {
	if (evt.lengthComputable) {
		var percentComplete = Math.round((currentFile + (evt.loaded / evt.total)) * 100 / fileQueue.length);
		//set upload progress in the bars
		divs = document.getElementsByClassName('progressNumber');
		for(var i=0;i<divs.length;i++)
		{
			divs[i].querySelector(".greenbar").style.width = percentComplete.toString() + '%';
			divs[i].querySelector(".bluebar").style.width = (100-percentComplete).toString() + '%';
			divs[i].querySelector(".uploadper").innerHTML = percentComplete.toString() + "<span style='color:#3399CC'>%</span>";
		}
	}
	else {
		divs = document.getElementsByClassName('progressNumber');
		for(var i=0;i<divs.length;i++)
		{
			divs[i].querySelector(".greenbar").style.width = '0';
			divs[i].querySelector(".bluebar").style.width = '100%';
			divs[i].querySelector(".uploadper").innerHTML = 'Cannot compute';
		}
	}
}

function uploadComplete(evt) {
	// This event is raised when the server send back a response
	var target = evt.srcElement || evt.target;
	try
	{
		var resp = JSON.parse(target.responseText);
		if(uploadedPictures == undefined)
			uploadedPictures = resp.files; //if pictures weren't added previously
		else
			uploadedPictures = uploadedPictures.concat(resp.files);	//if new pictures were added
		projectId = resp.projectId; //update project id
		projectPass = resp.projectPass;
		projectCheck = resp.projectCheck;
	}
	catch(e)
	{

	}
	finally
	{
		if(currentFile < fileQueue.length-1)
		{
			currentFile++;
			upload();
			return;
		}
		if(uploadedPictures!=undefined)
			afterComplete();
		else
			uploadFailed(null);
	}
}

function afterComplete() {
	uploadStart = false;
	uploadComp = true;
	fileQueue = null;
	var upStage = document.getElementsByClassName('uploadStage')
	for(var i=0;i<upStage.length;i++)
		upStage[i].innerHTML='Upload completed. Click "Next" to complete submission';
	
	document.getElementById("uploadButton2").style.display="none"; //hide upload file button
	var num = document.getElementsByClassName('progressNumber'); //hide progress bar
	for(i=0;i<num.length;i++)
		num[i].style.display='none';
		
	var buttons = document.getElementsByClassName("label_upload"); //show select files button
	for(i=0;i<buttons.length;i++)
		buttons[i].style.display = "block";
		
	document.getElementById("fileToUpload").value=''; //reset file input
	document.getElementById("projectName").value=''; //reset project name form field
	document.getElementById("userEmail").value=''; //reset email form field
	document.getElementById("projinstrfeditor").value=''; //reset instructions form field
	
	postuploads = document.getElementsByClassName("post_upload");
	for(i=0;i<postuploads.length;i++)
		postuploads[i].innerHTML = '';

//remove all images from preview modal and populate them again
	var imgs = document.getElementsByClassName("previmgdiv");
		for(i=imgs.length-1;i>=0;i--)
			imgs[i].parentNode.removeChild(imgs[i]);
	prevPictures();
}

function uploadFailed(evt) {
	alert("There was an error attempting to upload the file. Please ensure that files are iamges.");
	if(window.location.hash=="#basic-imagesprev")
		afterComplete();
	else
	{
		setMode(2);
		window.location.hash="#";
	}
}

function uploadCanceled(evt) {
	
}	
//Get sample images and set onclick to display in carousel
xmlsample = new XMLHttpRequest();
xmlsample.open("GET","ajax/getSampleImages.php",true);
xmlsample.onreadystatechange = function() {
	if(this.readyState == 4 && this.status == 200)
	{
		resp = JSON.parse(xmlsample.responseText);
		basicCarousel.pictures = resp.basic;
		advancedCarousel.pictures = resp.advanced;
	}
}
xmlsample.send();
basicCarousel = new dualCarousel("photoModal","pictures/sample/basic/before/","name",null,"pictures/sample/basic/after/","name");
advancedCarousel = new dualCarousel("photoModal1","pictures/sample/advanced/before/","name",null,"pictures/sample/advanced/after/","name");
testCarousel = new dualCarousel("photoModal3","pictures/tests/","name",null,"","name");
xmltest = new XMLHttpRequest();
xmltest.open("GET","ajax/getTestImages.php",true);
xmltest.send();
xmltest.onreadystatechange = function() {
	if(this.readyState == 4 && this.status == 200)
	{
		testImgs = JSON.parse(xmltest.responseText);
		testCarousel.pictures = testImgs;
	}
}
document.getElementById("photoModal").querySelector(".closeButton").onclick = function() {
		document.getElementById("photoModal").style.display="none";
	}
document.getElementById("photoModal1").querySelector(".closeButton").onclick = function() {
		document.getElementById("photoModal1").style.display="none";
	}
document.getElementById("photoModal3").querySelector(".closeButton").onclick = function() {
		document.getElementById("photoModal3").style.display="none";
	}
	
document.onkeyup = function(e) {
	if(document.getElementById("photoModal").style.display=='block')
	{
		if(e.keyCode==37)
			basicCarousel.changePic(-1);
		if(e.keyCode==39)
			basicCarousel.changePic(1);
		if(e.keyCode==27)
			document.getElementById("closeButton3").click();
	}
	if(document.getElementById("photoModal1").style.display=='block')
	{
		if(e.keyCode==37)
			advancedCarousel.changePic(-1);
		if(e.keyCode==39)
			advancedCarousel.changePic(1);
		if(e.keyCode==27)
			document.getElementById("closeButton4").click();
	}
	if(document.getElementById("photoModal3").style.display=='block')
	{
		if(e.keyCode==37)
			testCarousel.changePic(-1);
		if(e.keyCode==39)
			testCarousel.changePic(1);
		if(e.keyCode==27)
			document.getElementById("closeButton5").click();
	}
}

document.getElementById("leftButton3").onclick = function() {
	basicCarousel.changePic(-1);
}
document.getElementById("rightButton3").onclick = function() {
	basicCarousel.changePic(1);
}

document.getElementById("leftButton4").onclick = function() {
	advancedCarousel.changePic(-1);
}
document.getElementById("rightButton4").onclick = function() {
	advancedCarousel.changePic(1);
}

document.getElementById("leftButton5").onclick = function() {
	testCarousel.changePic(-1);
}
document.getElementById("rightButton5").onclick = function() {
	testCarousel.changePic(1);
}

basicpics = document.getElementsByClassName("basicpics");
for(i=0;i<basicpics.length;i++)
	basicpics[i].onclick = function() {
		basicCarousel.setPic(this.dataset.pic);	
	}

advancedpics = document.getElementsByClassName("advancedpics");
for(i=0;i<advancedpics.length;i++)
	advancedpics[i].onclick = function() {
		advancedCarousel.setPic(this.dataset.pic);	
	}

//event listener for all image pairs listed near editors
testpiclinks = document.getElementsByClassName("testpic");
for(i=0;i<testpiclinks.length;i++)
	testpiclinks[i].onclick = function() {
		testCarousel.prefix2 = "pictures/editors/editor"+this.parentNode.parentNode.parentNode.dataset.id+"/prev/";
		testCarousel.setPic(this.dataset.pic);
	}
