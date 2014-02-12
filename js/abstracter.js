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