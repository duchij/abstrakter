<form action="app.php" method="post">
<input type="hidden" name="fform_parse_string" value="">
<textarea rows="20" cols="100" name="formstring">
</textarea>
<input type="submit" name="" value="ukaz">
</form>


<table>
{foreach from=$data key=i item=row}

	{if $row.type == 'input_text'}
	
		<tr>
			<td>{$row.label}:</td><td><input type="text" width="{$row.width}" name="{$row.field}" value="{$row.value}"></td>
		</tr>
	{/if}
	
	{if $row.type == 'textarea'}
		<tr>
			<td>{$row.label}:</td><td><textarea rows="{$row.height}" cols="{$row.width}" name="{$row.field}">{$row.value}</textarea></td>
		</tr>
	{/if}
	
	{if $row.type == 'radio'}
	<tr>	
		<td>{$row.label}:</td><td><input type="radio" name="{$row.field}" value="{$row.value}"></td>
	</tr>
	{/if}
	
		

{/foreach}
</table>

</form>