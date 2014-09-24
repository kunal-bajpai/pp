function addClass(elem,className)
{
	elem.setAttribute('class',elem.className.replace(' '+className,''));;
	elem.setAttribute('class',elem.className+' '+className);
}

function removeClass(elem,className)
{
	elem.setAttribute('class',elem.className.replace(' '+className,''));
}

var xmlusername = new XMLHttpRequest(), timeout;

xmlusername.onreadystatechange = function() {
	if(this.readyState==4 && this.status==200)
	{
		elem = document.getElementById("su_username");
		if(this.responseText == '1')
		{
			document.getElementById("usernamestatus").innerHTML = '';
			document.getElementById("usernamestatus").style.display = 'none';
			removeClass(elem,'invalid');
			addClass(elem,'valid');
		}
		else
		{
			document.getElementById("usernamestatus").style.display = 'block';
			document.getElementById("usernamestatus").innerHTML = 'Sorry, username taken.';
			removeClass(elem,'valid');
			addClass(elem,'invalid');
		}
	}
}

function checkWith(elem,re) {
		if(elem.value != '')
			if(!re.test(elem.value))
			{
				document.getElementById('er_'+elem.id).style.display = 'block';
				removeClass(elem,'valid');
				addClass(elem,'invalid');
			}
			else
			{
				document.getElementById('er_'+elem.id).style.display = 'none';
				removeClass(elem,'invalid');
				addClass(elem,'valid');
			}
		else
		{
			document.getElementById('er_'+elem.id).style.display = 'none';
			removeClass(elem,'invalid');
			removeClass(elem,'valid');
		}
}

document.getElementById("su_firstname").onblur = document.getElementById("su_firstname").onkeyup = function(){ checkWith(this, /^[a-zA-Z]+$/)};
document.getElementById("su_lastname").onblur = document.getElementById("su_lastname").onkeyup = function() { 
	if(this.value!='')
		checkWith(this, /^[a-zA-Z]+$/)
	else
	{
		document.getElementById('er_'+this.id).style.display = 'none';
		removeClass(this,'invalid');
		addClass(this,'valid');
	}
};

document.getElementById("su_email").onblur = function() { checkWith(this, /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)};

document.getElementById("su_password").onblur = function() { 
	checkWith(this, /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,15}$/)
	var rep = document.getElementById("su_rep_password");
	if(this.value != rep.value)
	{
		document.getElementById('er_su_rep_password').style.display = 'block';
		removeClass(rep,'valid');
		addClass(rep,'invalid');
	}
	else
	{
		document.getElementById('er_su_rep_password').style.display = 'none';
		removeClass(rep,'invalid');
		addClass(rep,'valid');
	}
};

document.getElementById("su_rep_password").onblur = document.getElementById("su_rep_password").onkeyup = function() {
	if(this.value != document.getElementById("su_password").value)
	{
		document.getElementById('er_'+this.id).style.display = 'block';
		removeClass(this,'valid');
		addClass(this,'invalid');
	}
	else
	{
		document.getElementById('er_'+this.id).style.display = 'none';
		removeClass(this,'invalid');
		addClass(this,'valid');
	}
}

document.getElementById("su_username").oninput = function() {
	var re = /^(?=[^\._]+[\._]?[^\._]+$)[\w\.]{6,15}$/;
	if(typeof timeout == "number")
			clearTimeout(timeout);
	if(re.test(this.value))
	{
		removeClass(this,'invalid');
		removeClass(this,'valid');
		setTimeout(function() {
			document.getElementById("usernamestatus").style.display = 'block';
			document.getElementById("usernamestatus").innerHTML = 'Checking availability...';
			xmlusername.open("POST","ajax/username.php",true);
			xmlusername.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlusername.send("username="+document.getElementById("su_username").value);
		},1500);
	}
	else
	{
		document.getElementById("usernamestatus").style.display = 'none';
		document.getElementById("usernamestatus").innerHTML = '';
		removeClass(this,'valid');
		addClass(this,'invalid');
	}
}

function checkFiles() {
	fileinput = document.getElementById('su_tests');
	if(testImgs.length == fileinput.files.length)
	{
		for(var i=0;i<fileinput.files.length;i++)
			if(testImgs.indexOf(fileinput.files[i].name) < 0)
			{
				removeClass(fileinput,'valid');
				addClass(fileinput,'invalid');	
				return;
			}
		removeClass(fileinput,'invalid');
		addClass(fileinput,'valid');
	}
	else
	{
		removeClass(fileinput,'valid');
		addClass(fileinput,'invalid');
	}
}

document.getElementById("su_tests").onchange = function() {
	checkFiles();
}

document.getElementById("signUpForm").onsubmit = function() {
	document.getElementById("su_email").onblur();
	document.getElementById("su_firstname").onblur();
	document.getElementById("su_password").onblur();
	document.getElementById("su_rep_password").onblur();
	document.getElementById("su_username").oninput();
	lastname = document.getElementById("su_lastname");
	if(lastname.value=='')
	{
		removeClass(lastname,'invalid');
		addClass(lastname,'valid');
	}
	checkFiles();
	var elemslist = this.getElementsByClassName("valid");
	var elems = [];
	for(var i = 0, n; n = elemslist[i]; ++i) 
		elems.push(n);
	var reqdValid = this.getElementsByTagName("input");
	var fail = false;
	for(var i=0;i<reqdValid.length;i++)
		if(elems.indexOf(reqdValid[i])<0)
		{
			removeClass(reqdValid[i],'valid');
			addClass(reqdValid[i],'invalid')
			if(reqdValid[i].type!='submit' && reqdValid[i].id!='su_username' && reqdValid[i].id!='su_rep_password') //show error msg for all invalid inputs
				document.getElementById('er_'+reqdValid[i].id).style.display='block';
			fail = true;
		}
	if(fail)
		return false;
}
