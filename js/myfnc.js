$(document).ready(function() {
	var elements = [];
	var $inputText = '';
	var selectedObj = '';
	
	
//window.alert( "ready!" );

	$("#TextBox").click(function(e){
		var ele = elements.length;
		var count = ele++;
		$inputText = '<div><label for="label_text_'+count+'" id="label_text_'+count+'">Label_'+count+'</label>: <input type="text" id="input_text_'+count+'" value="" style="width:100px;"/></div';
		$("#desForm").append($inputText);
		elements.push({
			label_text:"label_"+count,
			input_text_width:100,
			input_text_idf:"input_text_"+count,
			input_text:"",
			column_name:"input_text_"+count,
			column_size:255
		});
		
	});
	
	$("#TextArea").click(function(e){
		$("#designerPlace").append('Textarea: <textarea id="text_duch" name="lolos"></textarea>');
	});
	
	
	$("#desForm").on('focus','input',function(){
		var id = $(this).attr("id");
		selectedObj = id;
		var tmp = selectedObj.split("_");
		
		if (id.indexOf("input_text_") != -1)
		{
			$("#input_text_items").attr('readonly',true);
			$("#input_text_height").attr('readonly',true);
			$("#input_text_idf").val(id);
			$("#input_text_label").val(elements[tmp[2]].label_text);
			$("#input_text_width").val(elements[tmp[2]].input_text_width);
			
		}
	});
	
	$(":input").change(function(e){
		
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
			var strTmp = $("#input_text_column_name").val().trim();
			console.log(strTmp);
			if (idf.test(strTmp)){
				alert("Povolene su len pismena,cisla a _ !!!!!");
				setTimeout(function(){$('#input_text_column_name').focus();}, 1)
			}
			else
			{
				elements[tmp[2]].column_name = $("#input_text_column_name").val();
			}
			
			
		}
	
	});
	
	(function($)
	{
		$.fn.setLabel = function(label) {
			
			
			$(this).find('focus','label',function(){
				window.alert("k");
			});
			var gh = $(this).attr("id");
			console.log($(gh).serialize());
			$(gh).focus(function()
			{
				var id = $(this).attr("id");
				window.alert(id);
			});
			return $(this).addClass('changed');
		}
	})(jQuery);
		

});


