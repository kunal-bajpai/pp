var origPictures, xmlpics = new XMLHttpRequest(), editPictures, fileQueue, currentFile;
xmlpics.open("GET","ajax/getAllPictures.php?projId="+projectId,false);
xmlpics.send();
origPictures = JSON.parse(xmlpics.responseText).original;
editPictures = JSON.parse(xmlpics.responseText).edited;
singleCarousel = new Carousel("photoModal1", "pictures/projects/project" + projectId + "/original/prev/", "name", origPictures);
editCarousel = new dualCarousel("photoModal", "pictures/projects/project" + projectId + "/original/prev/", "original", editPictures,"pictures/projects/project" + projectId + "/done/prev/", "name");

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
	document.getElementById("formProjId").value = projectId; //add project id to form so that server can reference to it
	fd = new FormData(document.getElementById("projectDetails"));
	fd.append("fileToUpload[]",fileQueue[currentFile]);
	var xhr = new XMLHttpRequest();
	xhr.upload.addEventListener("progress", uploadProgress, false);
	xhr.addEventListener("load", uploadComplete, false);
	xhr.addEventListener("error", uploadFailed, false);
	xhr.addEventListener("abort", uploadCanceled, false);
	/* Be sure to change the url below to the url of your upload server side script */
	xhr.open("POST", "ajax/uploadDonePic.php");
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
  var target = evt.srcElement || evt.target;
	if(target.responseText == "-1")
	{
		alert("Error linking project. Please ensure that you are signed in.");
	}
	else
	{
	  var resp = JSON.parse(target.responseText);
	  for(i=0;i<resp.length;i++)
	  {
	  	dummy = document.getElementById("imgBox2dummy").cloneNode(true);
	  	dummy.id='imgBox2';
	  	dummy.style.display='inline';
	  	dummy.querySelector(".imgThumb2").src = "pictures/projects/project"+projectId+"/done/thumbs/"+resp[i].name;
		dummy.querySelector(".imgThumb2").onclick = function() {
			editCarousel.setPic(this.dataset.pic);
			document.body.style.overflow = 'hidden';
			document.getElementById("photoModal2").style.display="block";
			document.getElementsByClassName("fullBlackOverlay")[0].style.display="block";
		}
	  	dummy.querySelector(".imgThumb2").dataset.pic = resp[i].name;
	  	dummy.dataset.id = resp[i].id;
	  	dummy.querySelector(".tickSym").onclick = function() {
	  		deleteImage(this.parentNode.dataset.id);
	  		this.parentNode.parentNode.removeChild(this.parentNode);
	  	}
	  	editCarousel.pictures[editCarousel.pictures.length] = {id:resp[i].id,name:resp[i].name, original:resp[i].original};
	  	document.getElementById("editPicsPreview2").appendChild(dummy);
	  }
	  if(currentFile < fileQueue.length-1)
	  {
	  	currentFile++;
	  	upload();
	  	return;
	  }
	}
	var xmllog = new XMLHttpRequest();
	xmllog.open("POST","ajax/logUploadPic.php",true);
	xmllog.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmllog.send("id="+projectId+"&num="+currentFile);
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

imgdivs = document.getElementsByClassName("imgThumb");
for(var i=0;i<imgdivs.length;i++)
	imgdivs[i].onclick = function() {
		singleCarousel.setPic(this.dataset.pic);
		document.body.style.overflow = 'hidden';
		singleCarousel.modal.style.display="block";
	}
	
document.onkeyup = function(e) {
	if(document.getElementById("photoModal1").style.display=='block')
	{
		if(e.keyCode==37)
			singleCarousel.changePic(-1);
		if(e.keyCode==39)
			singleCarousel.changePic(1);
		if(e.keyCode==27)
			document.getElementById("closeButton1").click();
	}
	if(document.getElementById("photoModal2").style.display=='block')
	{
		if(e.keyCode==37)
			editCarousel.changePic(-1);
		if(e.keyCode==39)
			editCarousel.changePic(1);
		if(e.keyCode==27)
			document.getElementById("closeButton2").click();
	}
}

imgdivs = document.getElementsByClassName("imgThumb2");
for(var i=0;i<imgdivs.length;i++)
	imgdivs[i].onclick = function() {
		editCarousel.setPic(this.dataset.pic);
		document.body.style.overflow = 'hidden';
		document.getElementById("photoModal2").style.display="block";
		document.getElementsByClassName("fullBlackOverlay")[0].style.display="block";
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

var imgs = document.getElementsByClassName('imgBox');
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
	var divs = document.getElementsByClassName("imgBox");
	var sel = '';
	for(i=0;i<divs.length;i++)
		if(divs[i].dataset.selected=='1')
			sel+=divs[i].dataset.id+'_';
	if(sel!='')
		window.open("partDownload.php?ids="+sel.substring(0,sel.length-1)+"&projId="+projectId);
}

document.getElementById("dwnldButton2").onclick = function() {
	window.open("allDownload.php?projId="+projectId);
}

function deleteImage(id) {
	xmldel = new XMLHttpRequest();
	xmldel.open("POST","ajax/deleteDonePic.php",false);
	xmldel.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmldel.send("id="+id);
	for(i=0;i<editCarousel.pictures.length;i++)
		if(editCarousel.pictures[i].id == id)
			editPictures.splice(i,1);
}

document.getElementById("dropProject").onclick = function() {
	var xmldrop = new XMLHttpRequest();
	xmldrop.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200)
		{
			window.location.href = "editMyProjList.php";
		}
	}
	xmldrop.open("POST","ajax/dropProject.php",true);
	xmldrop.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmldrop.send("id="+projectId);	
}
