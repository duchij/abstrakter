{include file="mpage/mheader.tpl"}
{literal}
<script>
tinymce.init({
        selector: ".dtextbox",
        //theme:"advanced",
        toolbar:"undo redo | print | indent outdent | alignleft aligncenter alignright | bold italic | bullist numlist | fontsizeselect | fontselect | forecolor",
        
        fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        font_formats: "Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;Verdana=verdana",
        menubar:true,
        plugins : 'paste textcolor code print autolink',
        //paste_word_valid_elements: "b,strong,i,em,h1,h2",
        paste_retain_style_properties: "margin, padding, width, height, font-size, font-weight, font-family, color, text-align, ul, ol, li, text-decoration, border, background, float, display, link",
        paste_as_text: false,
        force_p_newlines: false,
       // forced_root_block : 'div',
        force_br_newlines : true,
        //forced_root_block : '',
        autosave_retention: "30m",
        language: 'sk',
       // convert_urls: false,
       // allow_script_urls: true,
        height: "400px"

            

     });
</script>
{/literal}
<div class="container">
<div class="row">
	{include file="header.tpl"}
</div>
		

	
    <div id="row">
			<div class="one fifth">
				{include file="mpage/main_menu.tpl"}
			</div>
		
		    <div class="three fifth">
		      {include file=$page_template}
		    </div>
		      
		      <div class="one fifth">
		 		{include file="mpage/mright.tpl"}
		      </div>
	</div>
	<div class="row">		
	   {include file="footer.tpl"}
	</div>
    <div id="bottom"></div>
</div>	
{include file="mpage/mfooter.tpl"}