function countObj(obj)
{
	var i = 0;
	for (var element in obj)
	{
		i++;
	}
	return i;
}

function getEnumObj(elements)
{
	result = {};
	for (var obj in elements)
	{
		if (obj.indexOf('radio_') != -1)
		{
			if (result[elements[obj].radio_group] == undefined)
			{
				result[elements[obj].radio_group] = [];
			}
			result[elements[obj].radio_group].push(elements[obj].radio_value);
		}
	}
	return result;
}



$(document).ready(function() 
{
	
	/*$("#input_text_prop").hide();
	$("#textarea_text_prop").hide();*/
	$("body").hideAllProp();
	
	var elements = {};
	var enumsObj = {};
	var $inputText = '';
	var selectedObj = '';
	
	
//window.alert( "ready!" );

	$("#TextBox").click(function(e){
		
		var count = countObj(elements);
		$inputText = '<div id="div_input_text_'+count+'"><label for="label_text_'+count+'" id="label_text_'+count+'">Label_'+count+'</label>: <input type="text" id="input_text_'+count+'" value="" style="width:100px;"/> <a href="#" class="removeObj"><strong>X</strong></a></div>';
		$("#desForm").append($inputText);
		
		elements["input_text_"+count] = {
			label_text:"label_"+count,
			input_text_width:100,
			input_text_idf:"input_text_"+count,
			input_text:"",
			column_name:"input_text_"+count,
			column_size:255,
			
		};
		//console.log(elements);
	});
	
	$("#TextArea").click(function(e){
		var count = countObj(elements);
		$("#desForm").append('<div id="div_textarea_'+count+'"><label for="textarea_label_'+count+'" id="textarea_label_'+count+'">Textarea:</label> <textarea id="textarea_'+count+'" style="width:200px;height:100px;"></textarea> <a href="#" class="removeObj"><strong>X</strong></a></div>');
		
		elements["textarea_"+count] = {
				label_text:"label_"+count,
				textarea_width:200,
				textarea_height:100,
				textarea_idf:"input_text_"+count,
				textarea_text:"",
				column_name:"input_text_"+count,
				column_size:255,
				
			};
	});
	
	$("#RadioButton").click(function(e){
		//console.log("radio");
		var count = countObj(elements);
		$("#desForm").append('<div id="div_radio_'+count+'"><input type="radio" name="group" value="" id="radio_'+count+'" value="radio_'+count+'"> : <label for="radio_label_'+count+'" id="radio_label_'+count+'">Radio_'+count+':</label>&nbsp&nbsp<a href="#" class="removeObj" title="Removes selected object"><strong>X</strong></a></div>');
		
		elements["radio_"+count] = {
				label_text:"radio_"+count,
				//textarea_width:200,
				//textarea_height:100,
				radio_idf:"radio_"+count,
				radio_group: "group",
				radio_value: "radio_"+count,
				//textarea_text:"",
				column_name:"radio_"+count,
				column_size:255,
				
			};
		
		
	});
	//console.log(elements);
		

	
	$("#SelectList").click(function(e){
		var count = countObj(elements);
		$("#desForm").append('<div id="div_selectList_'+count+'"><label for="selectList_label_'+count+'" id="selectList_label_'+count+'">select list_'+count+':</label> <select id="selectList_'+count+'" style="width:200px;"></select> <a href="#" class="removeObj"><strong>X</strong></a></div>');
		
		elements["selectList_"+count] = {
				label_text:"selectlist_"+count,
				selectlist_width:200,
				selectlist_idf:"input_text_"+count,
				selectlist_items:'',
				column_name:"selectlist_"+count,
				column_size:255,
				
			};
		//console.log(elements);
		
	});
	
	$("#sendData").click(function(e){
		e.preventDefault();
		//alert("tu");
		$("#definitiveForm").html();
		$.ajax({
			url:"app.php",
			type:"post",
			data:{'include':"formDes",'fform_fnc':"desf",'formDesDataFnc':elements,'enumObj':getEnumObj(elements)},
			
			success:function(result)
			{
				//alert(result);
				$("#definitiveForm").html(result);
			},
			
			error:function(xhr, desc, err) {
		        console.log(xhr);
		        console.log("Details: " + desc + "\nError:" + err);
			}
			
		});
		
	});
	
	
	/*removal of selected object*/
	$("body").on('click','.removeObj', function (){
		var selDiv = $(this).parent('div');
		var id = selDiv.attr("id");
		delete elements[id];
		selDiv.remove();
		console.log(elements);
	});
	
	//hide all properties when outside od the forms
	$("#desForm").on('blur','*',function(){
		//$("body").hideAllProp();
	});
	
	$("#tableName").change(function (e){
		
		e.preventDefault();
		
		var str = $("#tableName").val();
		var idf = new RegExp('[^a-z0-9_$]','ig');
		
		if (idf.test(str)){
			alert("Povolene su len pismena,cisla a _ !!!!!");
			setTimeout(function()
							{
								$("#tableName").val(); 
								$("#tableName").focus();}, 1);
			
			//$('#input_text_column_name').preventDefault();
		}
		else
		{
			//elements[selectedObj].column_name = $("#radio_column_name").val();
			$.ajax({
				url:"app.php",
				type:"post",
				data:{'include':"setTableName",'fform_fnc':"desf",'tableName':str},
				
				success:function(result)
				{
					//alert(result);
					//$("#definitiveForm").html(result);
					alert(result);
				},
				
				error:function(xhr, desc, err) {
			        console.log(xhr);
			        console.log("Details: " + desc + "\nError:" + err);
				}
				
			});
			
		}
		
		
	});
	
	//fire focus on case of other browsers
	$("#desForm").on('change',':input',function(){
		var id = $(this).attr("id");
		selectedObj = id;
		console.log("tuu.."+id);
		
		if  (id.indexOf("radio_") != -1)
		{
			$("#radioButton_prop").show();
			
			$("#radio_idf").val(id);
			$("#radio_label").val(elements[id].label_text);
			$("#radio_group").val(elements[id].radio_group);
			$("#radio_value").val(elements[id].radio_value);
			$("#radio_column_name").val(elements[id].column_name);
						
			//$("#input_text_column_size").val(elements[id].column_size);
		}
		
		
	});
	
	
	//display properties after selected form element
	$("#desForm").on('focus',':input',function(){
		
		$("body").hideAllProp();
		
		var id = $(this).attr("id");
		selectedObj = id;
		console.log("tuu.."+id);
		if (id.indexOf("input_text_") != -1)
		{
			$("#input_text_prop").show();
			
			$("#input_text_idf").val(id);
			$("#input_text_label").val(elements[id].label_text);
			$("#input_text_width").val(elements[id].input_text_width);
			$("#input_text_column_name").val(elements[id].column_name);
			$("#input_text_column_size").val(elements[id].column_size);
			
		}
		else if  (id.indexOf("radio_") != -1)
		{
			$("#radioButton_prop").show();
			
			$("#radio_idf").val(id);
			$("#radio_label").val(elements[id].label_text);
			$("#radio_group").val(elements[id].radio_group);
			$("#radio_value").val(elements[id].radio_value);
			$("#radio_column_name").val(elements[id].column_name);
						
			//$("#input_text_column_size").val(elements[id].column_size);
		}
		else if (id.indexOf("selectList_") != -1)
		{
			$("#selectList_prop").show();
			
			$("#selectlist_idf").val(id);
			$("#selectlist_label").val(elements[id].label_text);
			$("#selectlist_width").val(elements[id].selectlist_width);
			$("#selectlist_height").val(elements[id].selectlist_height);
			$("#selectlist_column_name").val(elements[id].column_name);
		}
		else if (id.indexOf("textarea_") != -1)
		{
			$("#textarea_text_prop").show();
			
			$("#textarea_idf").val(id);
			$("#textarea_label").val(elements[id].label_text);
			$("#textarea_width").val(elements[id].textarea_width);
			$("#textarea_height").val(elements[id].textarea_height);
			$("#textarea_column_name").val(elements[id].column_name);
			//$("#textarea_column_size").val(elements[id].column_size);
		}
		else
		{
			$("body").hideAllProp();
		}
	});
	
	$(":input").on('input', function(e){
		
		var id = $(this).attr("id");
		var tmp = selectedObj.split("_");
		console.log([id,selectedObj]);
		
		/*radio design and properties*/
		if (id === 'radio_group')
		{
			var grp = $("#radio_group").val();
			$("#"+selectedObj).attr("name",grp);
			elements[selectedObj].radio_group = $("#radio_group").val();
			
		}
		if (id === "radio_label")
		{
			$("#radio_label_"+tmp[1]).html($("#radio_label").val());
			elements[selectedObj].label_text = $("#radio_label").val();
		}
		if (id === 'radio_column_name')
		{
			var idf = new RegExp('[^a-z0-9_$]','ig');
			var strTmp = $("#radio_column_name").val();
			//console.log(strTmp);
			//console.log(idf.test(strTmp));
			if (idf.test(strTmp)){
				alert("Povolene su len pismena,cisla a _ !!!!!");
				setTimeout(function()
								{
									$("#radio_column_name").val(); 
									$('#radio_column_name').focus();}, 1);
				
				//$('#input_text_column_name').preventDefault();
			}
			else
			{
				elements[selectedObj].column_name = $("#radio_column_name").val();
			}
		}
		
		
		/*selectlist design and properties*/
		if (id === 'selectlist_items')
		{
			var str = $("#selectlist_items").val();
			
			$("#"+selectedObj).remove();
			
			var tmp1 = str.split(";");
			var cnt = tmp1.length;
			var sl = '<label for="selectList_label_'+tmp[1]+'" id="selectList_label_'+tmp[1]+'">Select list:</label> <select id="'+selectedObj+'" style="width:200px;">';
	
			for (var i=0; i<cnt; i++)
			{
				var tmp2 = [];
				tmp2 = tmp1[i].split(",");
				console.log(tmp2);
				sl += '<option value="'+tmp2[1]+'">'+tmp2[0]+'</option>';
				//elements[selectedObj].selectlist_items[tmp2[1]] = tmp2[0];
			}
			sl +="</select>";
			//console.log(sl);
			$("#div_selectList_"+tmp[1]).html(sl);
			// = $("#selectlist_items").text();
			elements[selectedObj].selectlist_items = $("#selectlist_items").val();
			console.log(elements);
		}
		if (id === 'selectlist_label')
		{
			$("#selectList_label_"+tmp[1]).html($("#selectlist_label").val());
			elements[selectedObj].label_text = $("#selectlist_label").val();
		}
		if (id === 'selectlist_width')
		{
			$("#"+selectedObj).css("width",$("#selectlist_width").val()+"px");
			elements[selectedObj].selectlist_width = $("#selectlist_width").val();
		}
		if (id === 'selectlist_column_name')
		{
			var idf = new RegExp('[^a-z0-9_$]','ig');
			var strTmp = $("#selectlist_column_name").val();
			//console.log(strTmp);
			//console.log(idf.test(strTmp));
			if (idf.test(strTmp)){
				alert("Povolene su len pismena,cisla a _ !!!!!");
				setTimeout(function(){
					$("#selectlist_column_name").val(); 
					$('#selectlist_column_name').focus();}, 1);
				}
				else
				{
					elements[selectedObj].column_name = $("#selectlist_column_name").val();
				}
		}
		
		/*textarea conditions*/
		if (id === "textarea_label")
		{
			$("#textarea_label_"+tmp[1]).html($("#textarea_label").val());
			elements[selectedObj].label_text = $("#textarea_label").val();
		}
		else if (id === "textarea_width")
		{
			$("#"+selectedObj).css("width",$("#textarea_width").val()+"px");
			elements[selectedObj].textarea_width = $("#textarea_width").val();
		}
		else if (id === "textarea_height")
		{
			$("#"+selectedObj).css("height",$("#textarea_height").val()+"px");
			elements[selectedObj].textarea_height = $("#textarea_height").val();
		}
		else if (id === "textarea_column_name")
		{
			var idf = new RegExp('[^a-z0-9_$]','ig');
			var strTmp = $("#textarea_column_name").val();
			//console.log(strTmp);
			//console.log(idf.test(strTmp));
			if (idf.test(strTmp)){
				alert("Povolene su len pismena,cisla a _ !!!!!");
				setTimeout(function()
								{
									$("#textarea_column_name").val(); 
									$('#textarea_column_name').focus();}, 1);
				
				//$('#input_text_column_name').preventDefault();
			}
			else
			{
				elements[selectedObj].column_name = $("#textarea_column_name").val();
			}
		}
		
		/* what to do with input_text.... */
		else if (id === "input_text_label")
		{
			$("#label_text_"+tmp[2]).html($("#input_text_label").val());
			elements[selectedObj].label_text = $("#input_text_label").val();
			//console.log(elements);
		}
		else if (id === "input_text_width")
		{
			$("#input_text_"+[tmp[2]]).css("width",$("#input_text_width").val()+"px");
			elements[selectedObj].input_text_width = $("#input_text_width").val();
		}
		
		else if (id === "input_text_column_name")
		{
			var idf = new RegExp('[^a-z0-9_$]','ig');
			var strTmp = $("#input_text_column_name").val();
			//console.log(strTmp);
			//console.log(idf.test(strTmp));
			if (idf.test(strTmp)){
				alert("Povolene su len pismena,cisla a _ !!!!!");
				setTimeout(function(){$('#input_text_column_name').focus();}, 1);
				$("#input_text_column_name").val(strTmp);
				//$('#input_text_column_name').preventDefault();
			}
			else
			{
				elements[selectedObj].column_name = $("#input_text_column_name").val();
			}
		}
	});
});

(function($) 
{	
	$.fn.hideAllProp = function() {
		
		$("#input_text_prop").hide();
		$("#textarea_text_prop").hide();
		$("#selectList_prop").hide();
		$("#radioButton_prop").hide();
		
		
		return $(this).addClass('changed');
		}

		
})(jQuery);
		


