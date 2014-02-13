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