function test(st)
{
	var block = document.getElementById("block");
	if (st === '0')
	{
		block.style.visibility = "hidden";
	}
	else
	{
		block.style.visibility = "visible";
	}
}

function deleteConfirm(str)
{
	//alert(str);
	if (confirm('Naozaj zmazat?'))
	{
		
		var tmp = str.split(";");
		//alert(tmp[0]+"="+tmp[1]);
		self.location="app.php?"+tmp[0]+"="+tmp[1];
	}	
		
}

function setRadioButtons(str)
{
	//alert(str);
	var aktiv_rb = 	document.getElementById("aktiv_rb");
	var pasiv_rb = 	document.getElementById("pasiv_rb");
	var visit_rb = 	document.getElementById("visit_rb");
	
	aktiv_rb.checked = false;
	pasiv_rb.checked = false;
	visit_rb.checked = false;
	
	if (str === 'aktiv')
	{
		aktiv_rb.checked = true;
	}
	else if (str == 'pasiv')
	{
		pasiv_rb.checked = true;
	}
	else if (str == 'visit')
	{
		visit_rb.checked = true;
	}
	else
		{
			aktiv_rb.checked = true;
		}
	
}
function setSectionRadios(str)
{
	var doctor_rb = 	document.getElementById("doctor_rb");
	var nurse_rb = 	document.getElementById("nurse_rb");
	
	if (str === 'doctor')
	{
		doctor_rb.checked = true;
	}
	if (str === 'nurse')
	{
		nurse_rb.checked = true;
	}
}
