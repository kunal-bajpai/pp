function Carousel(modal, prefix, name, pictures) {
	this.modal = document.getElementById(modal);
	this.name = name;
	this.prefix = prefix;
	this.pictures = pictures;

	document.getElementById(modal).querySelector(".closeButton").onclick = function() {
		document.documentElement.style.overflowY = "scroll";
		document.getElementById(modal).style.display="none";
	}

}

//on clicking on a particular picture, bring it up in the preview carousel
Carousel.prototype.setPic = function(newPicName) {
	//iterate through pictures to find index of image clicked on
	this.currentPicName = newPicName;
	for(var i=0;i < this.pictures.length;i++)
		if(this.pictures[i][this.name]==this.currentPicName)
		{
			this.currentPic=i; //store index of pic which will be used later to move forward and backward in the carousel
			break;
		}
	this.modal.querySelector(".modalImg").style.backgroundImage = 'url('+this.prefix + this.pictures[this.currentPic][this.name]+')';
	if(this.modal.querySelector(".instrLabel")!=null)
		this.modal.querySelector(".instrLabel").innerHTML = null;
	if(this.pictures[this.currentPic]['instructions']!=undefined)
		this.modal.querySelector(".instrLabel").innerHTML = this.pictures[this.currentPic]['instructions'];
}
	
	//goes to next pic in preview carousel if action>0 and previous if action<0
Carousel.prototype.changePic = function(action) {
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
	this.modal.querySelector(".instrText").innerHTML = null;
	if(this.pictures[this.currentPic]['instructions']!=undefined)
		this.modal.querySelector(".instrText").innerHTML = this.pictures[this.currentPic]['instructions'];
}
