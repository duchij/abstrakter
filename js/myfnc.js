function countObj(obj)
{
	var i = 0;
	for (var element in obj)
	{
		i++;
	}
	return i;
}



$(document).ready(function() 
{
	
	/*$("#input_text_prop").hide();
	$("#textarea_text_prop").hide();*/
	$("body").hideAllProp();
	
	var elements = {};
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
		//console.log(elements);
		
	});
	
	$("#SelectList").click(function(e){
		var count = countObj(elements);
		$("#desForm").append('<div id="div_selectList_'+count+'"><label for="selectList_label_'+count+'" id="selectList_label_'+count+'">Select list:</label> <select id="selectList_'+count+'" style="width:200px;"></select> <a href="#" class="removeObj"><strong>X</strong></a></div>');
		
		elements["selectList_"+count] = {
				label_text:"label_"+count,
				selectlist_width:200,
				selectlist_idf:"input_text_"+count,
				selectlist_items:{},
				column_name:"selectlist_"+count,
				column_size:255,
				
			};
		//console.log(elements);
		
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
		else if (id.indexOf("selectList_") != -1)
		{
			$("#selectList_prop").show();
			
			$("#selectList_idf").val(id);
			$("#selectList_label").val(elements[id].label_text);
			$("#selectList_width").val(elements[id].textarea_width);
			$("#selectList_height").val(elements[id].textarea_height);
			$("#selectList_column_name").val(elements[id].column_name);
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
		
		/*selectlist design and properties*/
		if (id === 'selectlist_items')
		{
			var str = $("#selectlist_items").val();
			
			$("#"+selectedObj).remove();
			
			var tmp1 = str.split("\n");
			var cnt = tmp1.length;
			var sl = '<label for="selectList_label_'+tmp[1]+'" id="selectList_label_'+tmp[1]+'">Select list:</label> <select id="'+selectedObj+'" style="width:200px;">';
	
			for (var i=0; i<cnt; i++)
			{
				var tmp2 = [];
				tmp2 = tmp1[i].split(";");
				console.log(tmp2);
				sl += '<option value="'+tmp2[1]+'">'+tmp2[0]+'</option>';
				elements[selectedObj].selectlist_items[tmp2[1]] = tmp2[0];
			}
			sl +="</select>";
			//console.log(sl);
			$("#div_selectList_"+tmp[1]).html(sl);
			// = $("#selectlist_items").text();
			console.log(elements);
		}
		if (id === 'selectlist_label')
		{
		
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

(function($) {	
	$.fn.hideAllProp = function() {
		
		$("#input_text_prop").hide();
		$("#textarea_text_prop").hide();
		$("#selectList_prop").hide();
		
		
		return $(this).addClass('changed');
		}

		
		})(jQuery);
		


