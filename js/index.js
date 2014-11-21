xmlpics = new XMLHttpRequest();
xmlpics.open("GET","ajax/getHomeImages.php",true);
xmlpics.onreadystatechange = function() {
	if(this.readyState==4 && this.status==200)
	{
		pictures = JSON.parse(xmlpics.responseText);

		carousel = new dualCarousel('photoModal','pictures/home/before/','name',pictures,'pictures/home/after/','name');
		hexagons = document.getElementsByClassName("hexagon-in2");
		for(i=0;i<hexagons.length;i++)
			hexagons[i].onclick = function() {
				carousel.setPic(this.dataset.pic);	
			}
	}
}
xmlpics.send();

aftdivs = document.getElementsByClassName("aftdiv");
afts=[];
for(i=0;i<aftdivs.length;i++)
{
	afts.push(aftdivs[i].style.backgroundImage.substring(4,aftdivs[i].style.backgroundImage.length-1));
	aftdivs[i].style.backgroundImage = '';
}
img1 = document.createElement("img");
img1.src = afts[0];
cur1=0;
img1.onload = function() {
	aftdivs[cur1].style.backgroundImage = 'url('+this.src+')';
	cur1++;
	if(cur1<afts.length)
		this.src = afts[cur1];
}

befdivs = document.getElementsByClassName("befdiv");
befs=[];
for(i=0;i<befdivs.length;i++)
{
	befs.push(befdivs[i].style.backgroundImage.substring(4,befdivs[i].style.backgroundImage.length-1));
	befdivs[i].style.backgroundImage = '';
}
cur=0;
img = document.createElement("img");
img.src = befs[0];
img.onload = function() {
	befdivs[cur].style.backgroundImage = 'url('+this.src+')';
	cur++;
	if(cur<befs.length)
		this.src = befs[cur];
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
