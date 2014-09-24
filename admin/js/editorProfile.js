var pictures, xmlpics = new XMLHttpRequest(), currentFile, fileQueue;
xmlpics.onreadystatechange = function() {
	if(this.readyState == 4 && this.status == 200)
		pictures = JSON.parse(xmlpics.responseText);
}
xmlpics.open("GET","../ajax/getTestImages.php",true);
xmlpics.send();

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
		window.open("../partTestDownload.php?"+sel.substring(0,sel.length-1));
}

document.getElementById("dwnldButton2").onclick = function() {
	window.open("../testDload.php");
}
