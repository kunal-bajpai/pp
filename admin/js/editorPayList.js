var base=0, offset=3, currentPage=1, endPage, xmlProj = new XMLHttpRequest();

xmlProj.onreadystatechange = function () {
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
		div.querySelector(".col3").innerHTML = editors[i].count_basic;
		div.querySelector(".col4").innerHTML = editors[i].count_advanced;
		div.querySelector(".col5").innerHTML = editors[i].total;
		div.querySelector("a").href += "?id="+editors[i].id;
		document.getElementById("editorTable").appendChild(div);
	}
}

function getEditors() {
	refreshings = document.getElementsByClassName("refreshing");
	for(i=0;i<refreshings.length;i++)
		refreshings[i].innerHTML = "Refreshing...";
	xmlProj.open("GET","ajax/getEditorsPay.php",true);
	xmlProj.open("GET","ajax/getEditorsPay.php?base="+base+"&offset="+offset,true);
	xmlProj.send();
}
getEditors();
