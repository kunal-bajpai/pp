var base=0, offset=3, currentPage=1, endPage, status=-5, xmlEdit = new XMLHttpRequest();

xmlEdit.onreadystatechange = function () {
	if(this.readyState==4 && this.status==200)
	{
		resp = JSON.parse(this.responseText);
		refreshings = document.getElementsByClassName("refreshing");
		for(i=0;i<refreshings.length;i++)
			refreshings[i].innerHTML = "&nbsp";
		mainDiv = document.getElementById("editorTable");
		for(var i=mainDiv.childNodes.length-1;i>=0;i--)
		{
			if(mainDiv.childNodes[i].id!='rowHeader' && mainDiv.childNodes[i].id!='dummyDiv' && mainDiv.childNodes[i].className!='tableHR')
				mainDiv.removeChild(mainDiv.childNodes[i]);
		}
		endPage = resp.endPage;
		currentPage = resp.currentPage;
		
		var currentPages = document.getElementsByClassName("currentPage");
		for(var i=0;i<currentPages.length;i++)
			currentPages[i].value = resp.currentPage;
			
		endPages = document.getElementsByClassName("endPage");
		for(var i=0;i<endPages.length;i++)
			endPages[i].innerHTML = resp.endPage;
			
		selectBox = document.getElementsByClassName("resultPerPage");
		for(var i=0;i<selectBox.length;i++)
			selectBox[i].value = offset;
			
		if(resp.editors!=null)
			addToList(resp.editors);
	}
}

function prev() {
	if(currentPage > 1)
	{
		base -= offset;
		getEditors();
	}
}

function next() {
	if(currentPage<endPage)
	{
		base += offset;
		getEditors();
	}
}

radios = document.getElementsByClassName("status");
for(var i=0;i<radios.length;i++)
	radios[i].onchange = function() {
		if(this.value=='-5')
		{
			document.getElementById("all1").checked = true;
			document.getElementById("all2").checked = true;
			status = -5;
		}
		if(this.value=='-2')
		{
			document.getElementById("pend1").checked = true;
			document.getElementById("pend2").checked = true;
			status = -2;
		}
		if(this.value=='-3')
		{
			document.getElementById("disapp1").checked = true;
			document.getElementById("disapp2").checked = true;
			status = -3;
		}
		if(this.value=='-4')
		{
			document.getElementById("app1").checked = true;
			document.getElementById("app2").checked = true;
			status = -4;
		}
		base = 0;
		getEditors();
	}

selectBox = document.getElementsByClassName("resultPerPage");
for(var i=0;i<selectBox.length;i++)
	selectBox[i].onchange = function() {
		offset = this.value;
		base = 0;
		getEditors();
	}

currPages = document.getElementsByClassName("currentPage");
for(var i =0;i<currPages.length;i++)
{
	currPages[i].onblur = function() {
		if(this.value % 1 == 0 && this.value <= endPage && this.value >= 1)
		{
			currentPage = this.value;
			base = offset * (currentPage - 1);
			getEditors();
		}
		else
			this.value = currentPage;
	}
	currPages[i].onkeyup = function(e) {
		if(e.keyCode == 13)
			this.blur();
	}
}


function addToList(editors) {
	for(var i=0;i<editors.length;i++)
	{
		div = document.getElementById("dummyDiv").cloneNode(true);
		div.id=null;
		div.style.display = 'block';
		div.querySelector(".col1 .id").innerHTML = editors[i].id;
		div.querySelector(".col2").innerHTML = editors[i].name;
		div.querySelector("a").href += "?id="+editors[i].id;
		document.getElementById("editorTable").appendChild(div);
	}
}

function getEditors() {
	refreshings = document.getElementsByClassName("refreshing");
	for(i=0;i<refreshings.length;i++)
		refreshings[i].innerHTML = "Refreshing...";
	xmlEdit.open("GET","ajax/getEditors.php",true);
	xmlEdit.open("GET","ajax/getEditors.php?status="+status+"&base="+base+"&offset="+offset,true);
	xmlEdit.send();
}
getEditors();
