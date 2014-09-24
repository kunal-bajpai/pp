var pictures, currentPic, currentPicName, projectId;
	xmlpics = new XMLHttpRequest(), xmlundertake = new XMLHttpRequest();
	xmlundertake.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200)
		{
			if(this.responseText == 0)
				window.location.href = "editMyProjView.php?id="+projectId;
			else
				switch(this.responseText)
				{
					case '-3':alert("Sorry, you are not allowed to undertake any project as your test images have been disapproved. Please edit them again and upload for approval.");break;
					case '-2':alert("Sorry, your test images are pending for approval. Until then, you are not allowed to undertake any projects.");break;
					case '-1':alert("Sorry, this project is not free. You cannot undertake it.");break;
					case '1':alert("Sorry, you have dropped this project in the past. You cannot undertake it.");break;
					case '2':alert("Sorry, you have failed this project in the past. You cannot undertake it.");break;
					case '3':alert("Sorry, you have completed this project in the past. You cannot undertake it.");break;
					case '4':alert("Sorry, you have been removed from this project in the past. You cannot undertake it.");break;
				}
		}
	}
	xmlpics.open("GET","ajax/getPictures.php?projId="+projectId,false);
	xmlpics.send();
	pictures = JSON.parse(xmlpics.responseText);
	
	function addClass(elem,className)
	{
		elem.setAttribute('class',elem.className.replace(' '+className,''));;
		elem.setAttribute('class',elem.className+' '+className);
	}

	function removeClass(elem,className)
	{
		elem.setAttribute('class',elem.className.replace(' '+className,''));
	}
	
	document.getElementById("undertakeButton").onclick = function() {
		xmlundertake.open("GET","ajax/undertakeProj.php?id="+projectId,true);
		xmlundertake.send();
	}
	
	//on clicking on a particular picture, bring it up in the preview carousel
	
	carousel = new Carousel("photoModal1","pictures/projects/project"+projectId+"/original/prev/","name", pictures);

	imgdivs = document.getElementsByClassName("imgBox");
	for(var i=0;i<imgdivs.length;i++)
		imgdivs[i].onclick = function() {
			carousel.setPic(this.querySelector(".imgThumb").dataset.pic);
			document.body.style.overflow = 'hidden';
			document.getElementById("photoModal1").style.display="block";
			document.getElementsByClassName("fullBlackOverlay")[0].style.display="block";
		}
	
	document.onkeyup = function(e) {
		if(carousel.modal.style.display=='block')
		{
			if(e.keyCode==37)
				carousel.changePic(-1);
			if(e.keyCode==39)
				carousel.changePic(1);
			if(e.keyCode==27)
				carousel.modal.querySelector(".closeButton").click();
		}
	}
