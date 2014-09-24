var type=0, basicBase=0, advBase=0, offset=3, currentPage=1, endPage, xmlProj = new XMLHttpRequest();

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
			
		if(resp.projects!=null)
			addToList(resp.projects);
	}
}

function prev() {
	if(currentPage > 1)
	{
		if(type==0)
			basicBase -= offset;
		else
			advBase -= offset;
		getProjects();
	}
}

function next() {
	if(currentPage<endPage)
	{
		if(type==0)
			basicBase += offset;
		else
			advBase += offset;
		getProjects();
	}
}

selectBox = document.getElementsByClassName("resultPerPage");
for(var i=0;i<selectBox.length;i++)
	selectBox[i].onchange = function() {
		offset = this.value;
		basicBase = 0;
		advBase = 0;
		getProjects();
	}

currPages = document.getElementsByClassName("currentPage");
for(var i =0;i<currPages.length;i++)
{
	currPages[i].onblur = function() {
		if(this.value % 1 == 0 && this.value <= endPage && this.value >= 1)
		{
			currentPage = this.value;
			if(type==0)
				basicBase = offset * (currentPage - 1);
			else
				advBase = offset * (currentPage - 1);
			getProjects();
		}
		else
			this.value = currentPage;
	}
	currPages[i].onkeyup = function(e) {
		if(e.keyCode == 13)
			this.blur();
	}
}

radios = document.getElementsByClassName("typeRadio");
for(var i=0;i<radios.length;i++)
	radios[i].onchange = function() {
		if(this.value=='0')
		{
			document.getElementById("basicRadio1").checked = true;
			document.getElementById("basicRadio2").checked = true;
			type = 0;
		}
		else
		{
			document.getElementById("advRadio1").checked = true;
			document.getElementById("advRadio2").checked = true;
			type = 1;
		}
		getProjects();
	}

function addToList(projects) {
	for(var i=0;i<projects.length;i++)
	{
		div = document.getElementById("dummyDiv").cloneNode(true);
		div.id=null;
		div.style.display = 'block';
		div.querySelector(".col1 .name").innerHTML = projects[i].name;
		div.querySelector(".col2").innerHTML = projects[i].start;
		div.querySelector(".col3").innerHTML = projects[i].end;
		div.querySelector(".col4m span").innerHTML = projects[i].total;
		div.querySelector("a").href += "?id="+projects[i].id;
		document.getElementById("editorTable").appendChild(div);
	}
}

function getProjects() {
	refreshings = document.getElementsByClassName("refreshing");
	for(i=0;i<refreshings.length;i++)
		refreshings[i].innerHTML = "Refreshing...";
	xmlProj.open("GET","ajax/getProjects.php",true);
	if(type == 0)
		xmlProj.open("GET","ajax/getProjects.php?type="+type+"&base="+basicBase+"&offset="+offset,true);
	else
		xmlProj.open("GET","ajax/getProjects.php?type="+type+"&base="+advBase+"&offset="+offset,true);
	xmlProj.send();
}
getProjects();
