function dualCarousel(modal, prefix, name, pictures, prefix2, name2) {
	this.modal = document.getElementById(modal);
	this.name = name;
	this.prefix = prefix;
	if(pictures!=undefined)
		this.pictures = pictures;
	else
		this.pictures = new Array();
	this.name2 = name2;
	this.prefix2 = prefix2;

	document.getElementById(modal).querySelector(".closeButton").onclick = function() {
		document.documentElement.style.overflowY = "scroll";
		document.getElementById(modal).style.display="none";
	}

}

//on clicking on a particular picture, bring it up in the preview carousel
dualCarousel.prototype.setPic = function(newPicName) {
	//iterate through pictures to find index of image clicked on
	this.currentPicName = newPicName;
	for(var i=0;i < this.pictures.length;i++)
	{
		if(this.pictures[i][this.name2].toLowerCase()==this.currentPicName.toLowerCase())
		{
			this.currentPic=i; //store index of pic which will be used later to move forward and backward in the carousel
			break;
		}
	}
	this.modal.style.display="block";
	this.modal.querySelector(".modalImg").style.backgroundImage = 'url('+this.prefix + this.pictures[this.currentPic][this.name]+')';
	this.modal.querySelector(".modalImg2").style.backgroundImage = 'url('+this.prefix2 + this.currentPicName+')';
}

//goes to next pic in preview carousel if action>0 and previous if action<0
dualCarousel.prototype.changePic = function(action) {
	if(action > 0)
		if(this.currentPic >= this.pictures.length-1)
			this.currentPic = 0;
		else
			this.currentPic++;
	if(action < 0)
		if(this.currentPic <= 0)
			this.currentPic = this.pictures.length - 1;
		else
			this.currentPic--;
	this.modal.querySelector(".modalImg").style.backgroundImage = 'url('+this.prefix + this.pictures[this.currentPic][this.name]+')';
	this.modal.querySelector(".modalImg2").style.backgroundImage = 'url('+this.prefix2 + this.pictures[this.currentPic][this.name2]+')';
}
