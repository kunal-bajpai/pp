var pictures, xmlpics = new XMLHttpRequest(), currentFile, fileQueue;
xmlpics.open("GET","ajax/getTestImages.php",false);
xmlpics.send();
pictures = JSON.parse(xmlpics.responseText);

//if file is selected then populate its details. if none are selected then hide the existing details being shown
function fileSelected() {
	var files = document.getElementById('fileToUpload').files;
	//if no files selected then show upload file and select file buttons else hide them
	if(files.length>0)
	{
		document.getElementById("uploaddiv").style.visibility="visible";
		document.getElementById("uploadButton2").style.visibility="visible";
	}
	else
	{
		stage = 1;
		document.getElementById("uploaddiv").style.visibility="hidden";
		document.getElementById("uploadButton2").style.visibility="hidden";
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
  var buttons = document.getElementsByClassName("label_upload"); //hide all select file buttons
  for(i=0;i<buttons.length;i++)
  	buttons[i].style.visibility = "hidden";
  document.getElementById("uploadButton2").style.visibility="hidden"; //hide upload button in the preivew modal
  
  //display the progress bar
  var num = document.getElementsByClassName('progressNumber')
  for(i=0;i<num.length;i++)
  	num[i].style.visibility='visible';
  fileQueue = document.getElementById("fileToUpload").files;
  currentFile = 0;
  upload();
}

//upload current file in queue
function upload() {
	fd = new FormData(document.getElementById("projectDetails"));
	fd.append("fileToUpload[]",fileQueue[currentFile]);
	var xhr = new XMLHttpRequest();
	xhr.upload.addEventListener("progress", uploadProgress, false);
	xhr.addEventListener("load", uploadComplete, false);
	xhr.addEventListener("error", uploadFailed, false);
	xhr.addEventListener("abort", uploadCanceled, false);
	/* Be sure to change the url below to the url of your upload server side script */
	xhr.open("POST", "ajax/uploadTests.php");
	xhr.send(fd); //let the uploading roll!
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
    divs = document.getElementsById('progressNumber');
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
	if(evt.srcElement.responseText == "-1")
	{
		alert("Error linking editor. Please ensure that you are signed in.");
	}
	else
	{
	  	thumbs = document.getElementsByClassName("edited");
	  	for(i=0;i<thumbs.length;i++)
	  		thumbs[i].src = thumbs[i].src + "#" + new Date().getTime();
	  	if(currentFile < fileQueue.length-1)
		  {
		  	currentFile++;
		  	upload();
		  	return;
		  }
	}
  var upStage = document.getElementsByClassName('uploadStage')
  for(var i=0;i<upStage.length;i++)
  	upStage[i].innerHTML='Upload completed';
  
  document.getElementById("uploadButton2").style.visibility="hidden"; //show upload file button again
  
  var num = document.getElementsByClassName('progressNumber'); //hide progress bar
  for(i=0;i<num.length;i++)
  	num[i].style.visibility='hidden';

  var buttons = document.getElementsByClassName("label_upload"); //show select files button
  for(i=0;i<buttons.length;i++)
  	buttons[i].style.visibility = "visible";
  	
	document.getElementById("fileToUpload").value=''; //reset file input
	
	postuploads = document.getElementsByClassName("post_upload");
	for(i=0;i<postuploads.length;i++)
		postuploads[i].innerHTML = '';
}

function uploadFailed(evt) {
	var num = document.getElementsByClassName('progressNumber');
  for(i=0;i<num.length;i++)
  	num[i].style.visibility='hidden';
  alert("There was an error attempting to upload the file.");
}

function uploadCanceled(evt) {
  alert("The upload has been canceled by the user or the browser dropped the connection.");
}

//code starting here is to implement preview carousel

//on clicking on a particular picture, bring it up in the preview carousel
function setPic() {
	//iterate through pictures to find index of image clicked on
	for(var i=0;i < pictures.length;i++)
		if(pictures[i]==currentPicName)
		{
			currentPic=i; //store index of pic which will be used later to move forward and backward in the carousel
			break;
		}
	document.getElementById("prevPic11").src = "pictures/tests/" + pictures[currentPic];
	document.getElementById("prevPic12").src = "pictures/editors/editor"+ editorId + "/" + pictures[currentPic];
	}
	//goes to next pic in preview carousel if action>0 and previous if action<0
function changePic(action) {
	if(action > 0)
		if(currentPic >= pictures.length-1)
			currentPic = 0;
		else
			currentPic++;
	if(action < 0)
		if(currentPic <= 0)
			currentPic = pictures.length - 1;
		else
			currentPic--;
	document.getElementById("prevPic11").src = "pictures/tests/" + pictures[currentPic];
	document.getElementById("prevPic12").src = "pictures/editors/editor"+ editorId + "/" + pictures[currentPic];
}

imgdivs = document.getElementsByClassName("imgThumb");
for(var i=0;i<imgdivs.length;i++)
	imgdivs[i].onclick = function() {
		currentPicName = this.dataset.pic;
		setPic();
		document.body.style.overflow = 'hidden';
		document.getElementById("photoModal1").style.display="block";
		document.getElementsByClassName("fullBlackOverlay")[0].style.display="block";
	}
document.getElementById("closeButton1").onclick = function() {
	document.body.style.overflow = "auto";
	document.getElementById("photoModal1").style.display="none";
	document.getElementsByClassName("fullBlackOverlay")[0].style.display="none";
}
	
document.onkeyup = function(e) {
	if(document.getElementById("photoModal1").style.display=='block')
	{
		if(e.keyCode==37)
			changePic(-1);
		if(e.keyCode==39)
			changePic(1);
		if(e.keyCode==27)
			document.getElementById("closeButton1").click();
	}
}

//code to select - unselect pics for download
function addClass(elem,className)
{
	elem.setAttribute('class',elem.className.replace(' '+className,''));;
	elem.setAttribute('class',elem.className+' '+className);
}

function removeClass(elem,className)
{
	elem.setAttribute('class',elem.className.replace(' '+className,''));
}

var imgs = document.getElementsByClassName('selectable');
for(i=0;i<imgs.length;i++)
{
	imgs[i].onmouseover = function() {
		addClass(this.querySelector('.toSelect'),'toSelectHover');
		addClass(this.querySelector('.toUnselect'),'toSelectHover');
	}
	imgs[i].onmouseout = function() {
		removeClass(this.querySelector('.toSelect'),'toSelectHover');
		removeClass(this.querySelector('.toUnselect'),'toSelectHover');
	}
}

var toSelects = document.getElementsByClassName('toSelect');
for(i=0;i<toSelects.length;i++)
{
	toSelects[i].onclick = function() {
		this.parentNode.querySelector('.blackOverlay').style.display='inline';
        this.parentNode.querySelector('.tickSym').style.display='inline';
		this.parentNode.querySelector('.toSelect').style.display='none';
        this.parentNode.querySelector('.toUnselect').style.display='block';
        this.parentNode.dataset.selected=1;
	}
}

var toUnselects = document.getElementsByClassName('toUnselect');
for(i=0;i<toUnselects.length;i++)
{
	toUnselects[i].onclick = function() {
		this.parentNode.querySelector('.blackOverlay').style.display='none';
        this.parentNode.querySelector('.tickSym').style.display='none';
        this.parentNode.querySelector('.toSelect').style.display='block';
        this.parentNode.querySelector('.toUnselect').style.display='none';
        this.parentNode.dataset.selected=0;
	}
}

document.getElementById("dwnldButton1").onclick = function() {
	var divs = document.getElementsByClassName("selectable");
	var sel = '';
	for(i=0;i<divs.length;i++)
		if(divs[i].dataset.selected=='1')
			sel+="name[]="+encodeURIComponent(divs[i].querySelector(".imgThumb").dataset.pic)+'&';
	if(sel!='')
		window.open("partTestDownload.php?"+sel.substring(0,sel.length-1));
}

document.getElementById("dwnldButton2").onclick = function() {
	window.open("testDload.php");
}
