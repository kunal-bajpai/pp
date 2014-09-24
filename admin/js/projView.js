var origPictures, xmlpics = new XMLHttpRequest(), editPictures, fileQueue, currentFile;
xmlpics.open("GET","ajax/getAllPictures.php?projId="+projectId,false);
xmlpics.send();
origPictures = JSON.parse(xmlpics.responseText).original;
editPictures = JSON.parse(xmlpics.responseText).edited;
singleCarousel = new Carousel("photoModal1", "../pictures/projects/project" + projectId + "/original/prev/", "name", origPictures);
editCarousel = new dualCarousel("photoModal", "../pictures/projects/project" + projectId + "/original/prev/", "original", editPictures,"../pictures/projects/project" + projectId + "/done/prev/", "name");

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
