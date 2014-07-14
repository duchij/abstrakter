<!--<form action="app.php" method="post">
 
<input type="hidden" name="fform_parse_string" value="">
<textarea rows="20" cols="100" name="formstring">
</textarea>
<input type="submit" name="" value="ukaz">
</form>
 -->

<table>
{foreach from=$data key=i item=row}

	{if $row.type == 'input_text'}
		<tr>
			<td>{$row.label}:</td><td><input type="text" style="width:{$row.width}px" name="{$row.field}" value="{$row.value}"></td>
		</tr>
	{/if}
	{if $row.type == 'textarea'}
		<tr>
			<td>{$row.label}:</td><td><textarea name="{$row.field}" style="width:{$row.width}px;height:{$row.height}px;">{$row.value}</textarea></td>
		</tr>
	{/if}
	{if $row.type == 'radio'}
	<tr>	
		<td>{$row.label}:</td><td><input type="radio" name="{$row.group}" value="{$row.value}"></td>
	</tr>
	{/if}
	
	{if $row.type == 'selectlist'}
	<tr>
		<td>{$row.label}:</td><td><select style="width:{$row.width}px;">
				{foreach key=key item=item from=$row.value}
					<option value='{$key}'>{$item}</option>
				{/foreach}
		</select>
	</tr>
	{/if}
{/foreach}
</table>

</form>
{$sqlStr}