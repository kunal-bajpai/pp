var origPictures, currentOrigPicName, currentOrigPic, xmlpics = new XMLHttpRequest();
var editPictures, currentEditPicName, currentEditPic;
xmlpics.open("GET","ajax/getAllPictures.php?projId="+projectId,false);
xmlpics.send();
origPictures = JSON.parse(xmlpics.responseText).original;
editPictures = JSON.parse(xmlpics.responseText).edited;
singleCarousel = new Carousel("photoModal1", "pictures/projects/project" + projectId + "/original/prev/", "name", origPictures);
editCarousel = new dualCarousel("photoModal", "pictures/projects/project" + projectId + "/original/prev/", "original", editPictures,"pictures/projects/project" + projectId + "/wm/prev/", "name");

//code starting here is to implement preview carousel
	
imgdivs = document.getElementsByClassName("imgThumb");
for(var i=0;i<imgdivs.length;i++)
	imgdivs[i].onclick = function() {
		singleCarousel.setPic(this.dataset.pic);
		document.body.style.overflow = 'hidden';
		document.getElementById("photoModal1").style.display="block";
		document.getElementsByClassName("fullBlackOverlay")[0].style.display="block";
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

var imgs = document.getElementsByClassName('imgBox2');
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
        changeSelected(this.parentNode.dataset.id,this.parentNode.dataset.selected);
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
        changeSelected(this.parentNode.dataset.id,this.parentNode.dataset.selected);        
	}
}

var xmlchosen=new XMLHttpRequest();
function changeSelected(picId,action) {
	xmlchosen.open("POST","ajax/changeChosen.php",true);
	xmlchosen.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlchosen.send("id="+picId+"&action="+action);
}

document.getElementById("removeEditor").onclick = function() {
	xmlremove = new XMLHttpRequest();
	xmlremove.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200)
		{
			document.getElementById("currentEditor").innerHTML = "No one";
			var button = document.getElementById("removeEditor");
			button.parentNode.removeChild(button);
		}
	}
	xmlremove.open("POST","ajax/removeEditor.php",true);
	xmlremove.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlremove.send("projId="+projectId);
}

document.getElementById("cancelProject").onclick = function() {
	xmlcancel = new XMLHttpRequest();
	xmlcancel.onreadystatechange = function() {
	console.log(this.responseText);
		if(this.readyState == 4 && this.status == 200)
		{
			window.location.href='index.php';
		}
	}
	xmlcancel.open("POST","ajax/custCancelProj.php",true);
	xmlcancel.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlcancel.send("id="+projectId);
}
