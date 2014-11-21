var type=0, base=0, offset=3, currentPage=1, endPage, xmlProj = new XMLHttpRequest();

function hasClass(elem,className)
{
	return (' '+elem.className+' ').indexOf(' '+className+' ') > -1;
}

xmlProj.onreadystatechange = function () {
	if(this.readyState==4 && this.status==200)
	{
		resp = JSON.parse(this.responseText);
		refreshings = document.getElementsByClassName("refreshing");
		for(i=0;i<refreshings.length;i++)
			refreshings[i].innerHTML = "&nbsp";
		switch(resp.table)
		{
			case '0': mainDiv = document.getElementById("confirmedProj");break;
			case '1': mainDiv = document.getElementById("unconfirmedProj");break;
			case '2': mainDiv = document.getElementById("completedProj");break;
			case '3': mainDiv = document.getElementById("cancelledProj");break;
		}
		for(var i=mainDiv.childNodes.length-1;i>=0;i--)
		{
			if(mainDiv.childNodes[i].id!='rowHeader' && !hasClass(mainDiv.childNodes[i],'dummyDiv') && mainDiv.childNodes[i].className!='tableHR')
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
			addToList(resp.projects,resp.table);
	}
}

function prev() {
	if(currentPage > 1)
	{
		base -= offset;
		getProjects();
	}
}

function next() {
	if(currentPage<endPage)
	{
		base += offset;
		getProjects();
	}
}

selectBox = document.getElementsByClassName("resultPerPage");
for(var i=0;i<selectBox.length;i++)
	selectBox[i].onchange = function() {
		offset = this.value;
		base = 0;
		getProjects();
	}

currPages = document.getElementsByClassName("currentPage");
for(var i =0;i<currPages.length;i++)
{
	currPages[i].onblur = function() {
		if(this.value % 1 == 0 && this.value <= endPage && this.value >= 1)
		{
			currentPage = this.value;
			base = offset * (currentPage - 1);
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

radios = document.getElementsByClassName('projCategory');
for(var i=0;i<radios.length;i++)
	radios[i].onchange = function() {
		type = this.value;
		radios = document.getElementsByClassName('projCategory');
		for(var i=0;i<radios.length;i++)
		{
			switch(this.value)
			{
				case '0':
				document.getElementById("confirmed").checked = true;
				document.getElementById("confirmed1").checked = true;
				document.getElementById("confirmedProj").style.display = 'block';
				document.getElementById("unconfirmedProj").style.display = 'none';
				document.getElementById("completedProj").style.display = 'none';
				document.getElementById("cancelledProj").style.display = 'none';
				break;
				case '1':
				document.getElementById("unconfirmed").checked = true;
				document.getElementById("unconfirmed1").checked = true;
				document.getElementById("confirmedProj").style.display = 'none';
				document.getElementById("unconfirmedProj").style.display = 'block';
				document.getElementById("completedProj").style.display = 'none';
				document.getElementById("cancelledProj").style.display = 'none';
				break;
				case '2':
				document.getElementById("completed").checked = true;
				document.getElementById("completed1").checked = true;
				document.getElementById("confirmedProj").style.display = 'none';
				document.getElementById("unconfirmedProj").style.display = 'none';
				document.getElementById("completedProj").style.display = 'block';
				document.getElementById("cancelledProj").style.display = 'none';
				break;
				case '3':
				document.getElementById("cancelled").checked = true;
				document.getElementById("cancelled1").checked = true;
				document.getElementById("confirmedProj").style.display = 'none';
				document.getElementById("unconfirmedProj").style.display = 'none';
				document.getElementById("completedProj").style.display = 'none';
				document.getElementById("cancelledProj").style.display = 'block';
				break;
		}
		getProjects();
	}
}

radios = document.getElementsByClassName("typeRadio");
for(var i=0;i<radios.length;i++)
	radios[i].onchange = function() {
		
	}

function removeClass(elem,className)
{
	elem.setAttribute('class',elem.className.replace(' '+className,''));
	elem.setAttribute('class',elem.className.replace(className,''));
}

function addToList(projects,projType) {
	switch(projType)
	{
		case '0':
			for(var i=0;i<projects.length;i++)
			{
				table = document.getElementById("confirmedProj");
				div = table.querySelector(".dummyDiv").cloneNode(true);
				removeClass(div,'dummyDiv');
				div.style.display = 'block';
				div.querySelector(".col1").innerHTML = projects[i].id;
				div.querySelector(".col2").innerHTML = projects[i].name + div.querySelector(".col2").innerHTML;
				div.querySelector(".col2 a").href += "?id="+projects[i].id;
				div.querySelector(".col3").innerHTML = projects[i].submittime;
				div.querySelector(".col4").innerHTML = projects[i].editor;
				table.appendChild(div);
			}
			break;
		case '1':
			for(var i=0;i<projects.length;i++)
			{
				table = document.getElementById("unconfirmedProj");
				div = table.querySelector(".dummyDiv").cloneNode(true);
				removeClass(div,'dummyDiv');
				div.style.display = 'block';
				div.querySelector(".col1").innerHTML = projects[i].id;
				div.querySelector(".col2").innerHTML = projects[i].name + div.querySelector(".col2").innerHTML;
				div.querySelector(".col2 a").href += "?id="+projects[i].id;
				div.querySelector(".col3").innerHTML = projects[i].type;
				table.appendChild(div);
				break;
			}
		case '2':
			for(var i=0;i<projects.length;i++)
			{
				table = document.getElementById("completedProj");
				div = table.querySelector(".dummyDiv").cloneNode(true);
				removeClass(div,'dummyDiv');
				div.style.display = 'block';
				div.querySelector(".col1").innerHTML = projects[i].id;
				div.querySelector(".col2").innerHTML = projects[i].name + div.querySelector(".col2").innerHTML;
				div.querySelector(".col2 a").href += "?id="+projects[i].id;
				div.querySelector(".col3").innerHTML = projects[i].type;
				div.querySelector(".col4").innerHTML = projects[i].completetime;
				div.querySelector(".col5 span").innerHTML = projects[i].total;
				table.appendChild(div);
				break;
			}
		case '3':
			for(var i=0;i<projects.length;i++)
			{
				table = document.getElementById("cancelledProj");
				div = table.querySelector(".dummyDiv").cloneNode(true);
				removeClass(div,'dummyDiv');
				div.style.display = 'block';
				div.querySelector(".col1").innerHTML = projects[i].id;
				div.querySelector(".col2").innerHTML = projects[i].name + div.querySelector(".col2").innerHTML;
				div.querySelector(".col2 a").href += "?id="+projects[i].id;
				table.appendChild(div);
				break;
			}
	}
}

function getProjects() {
	refreshings = document.getElementsByClassName("refreshing");
	for(i=0;i<refreshings.length;i++)
		refreshings[i].innerHTML = "Refreshing...";
	xmlProj.open("GET","ajax/getProjects.php",true);
	xmlProj.open("GET","ajax/getProjects.php?type="+type+"&base="+base+"&offset="+offset,true);
	xmlProj.send();
}
getProjects();
