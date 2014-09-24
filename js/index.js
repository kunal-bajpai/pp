var pictures, xmlpics = new XMLHttpRequest();
xmlpics.open("GET","ajax/getHomeImages.php",false);
xmlpics.send();
pictures = JSON.parse(xmlpics.responseText);

carousel = new dualCarousel('photoModal','pictures/home/before/','name',pictures,'pictures/home/after/','name');
hexagons = document.getElementsByClassName("hexagon-in2");
for(i=0;i<hexagons.length;i++)
	hexagons[i].onclick = function() {
		carousel.setPic(this.dataset.pic);	
	}
	
/*function showhide()
{
	var div = document.getElementById("newpost");
	if (div.style.display !== "none")
		div.style.display = "none";
	else
		div.style.display = "block";
}

var shown = false;
document.getElementById("button").onclick = function() {
	showhide();
	if(!shown)
	{
		this.innerHTML = "Too Much!";
		shown = true;
	}
	else
	{
		this.innerHTML = "More Happiness!";
		shown = false;
	}
}*/

document.onkeyup = function(e) {
	if(document.getElementById("photoModal").style.display=='block')
	{
		if(e.keyCode==37)
			carousel.changePic(-1);
		if(e.keyCode==39)
			carousel.changePic(1);
		if(e.keyCode==27)
			document.getElementById("photoModal").style.display="none";
		return false;
	}
}
document.getElementById("leftButton3").onclick = function() {
	carousel.changePic(-1);
}
document.getElementById("rightButton3").onclick = function() {
	carousel.changePic(1);
}