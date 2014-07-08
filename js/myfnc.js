function countObj(obj)
{
	var i = 0;
	for (var element in obj)
	{
		i++;
	}
	return i;
}



$(document).ready(function() {
	
	/*$("#input_text_prop").hide();
	$("#textarea_text_prop").hide();*/
	$("body").hideAllProp();
	
	var elements = {};
	var $inputText = '';
	var selectedObj = '';
	
	
//window.alert( "ready!" );

	$("#TextBox").click(function(e){
		
		var count = countObj(elements);
		$inputText = '<div id="input_text_'+count+'"><label for="label_text_'+count+'" id="label_text_'+count+'">Label_'+count+'</label>: <input type="text" id="input_text_'+count+'" value="" style="width:100px;"/> <a href="#" class="removeObj"><strong>X</strong></a></div>';
		$("#desForm").append($inputText);
		elements["input_text_"+count] = {
			label_text:"label_"+count,
			input_text_width:100,
			input_text_idf:"input_text_"+count,
			input_text:"",
			column_name:"input_text_"+count,
			column_size:255,
			
		};
		console.log(elements);
	});
	
	$("#TextArea").click(function(e){
		var count = countObj(elements);
		$("#desForm").append('<div id="textarea_text_'+count+'">Textarea: <textarea id="text_duch" name="lolos"></textarea></div>');
	});
	
	/*removal of selected object*/
	$("body").on('click','.removeObj', function (){
		var selDiv = $(this).parent('div');
		var id = selDiv.attr("id");
		delete elements[id];
		selDiv.remove();
		console.log(elements);
	});
	
	$("#desForm").focus(function(e){
		
		console.log("halo");
});
	
	$("#desForm").on('focus','*',function(){
		var id = $(this).attr("id");
		selectedObj = id;
	
		if (id.indexOf("input_text_") != -1)
		{
			$("#input_text_prop").show();
			
			$("#input_text_items").attr('readonly',true);
			$("#input_text_height").attr('readonly',true);
			$("#input_text_idf").val(id);
			$("#input_text_label").val(elements[id].label_text);
			$("#input_text_width").val(elements[id].input_text_width);
			$("#input_text_column_name").val(elements[id].column_name);
			$("#input_text_column_size").val(elements[id].column_size);
			
		}
		else if (id.indexOf("textarea_text_") != -1)
		{
			$("#textarea_text_prop").show();
		}
		else
		{
			$("body").hideAllProp();
		}
	});
	
	$(":input").on('input', function(e){
		
		var id = $(this).attr("id");
		var tmp = selectedObj.split("_");
		
		if (id === "input_text_label")
		{
			$("#label_text_"+tmp[2]).html($("#input_text_label").val());
			elements[tmp[2]].label_text = $("#input_text_label").val();
			//console.log(elements);
		}
		if (id === "input_text_width")
		{
			$("#input_text_"+[tmp[2]]).css("width",$("#input_text_width").val()+"px");
			elements[tmp[2]].input_text_width = $("#input_text_width").val();
		}
		if (id === "input_text_column_name")
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
				elements[tmp[2]].column_name = $("#input_text_column_name").val();
			}
			
			
		}
	
	});
	

	
	
		

});

(function($) {	
	$.fn.hideAllProp = function() {
		
		$("#input_text_prop").hide();
		$("#textarea_text_prop").hide();
		
		
		return $(this).addClass('changed');
		}

		
		})(jQuery);
		


