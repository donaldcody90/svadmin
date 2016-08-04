jQuery(document).ready(function($){
	$(".ajaxForm").submit(function(event){
		var data = $(this).serializeArray();
		data.push({name: 'postAjax', value: 1});
		var task=$("input[name=task]").val();
		var URL=baseURL+"ajax/"+task;
		$.ajax({
			url: URL,
			type: "post",
			data: data,
			success: function (response) {
			   // you will get response from your php page (what you echo or print)                 
			   var obj = $.parseJSON(response);
				if(obj.Response=='Error')
				{
					$(".w2ui-msg-body #response_ajax").addClass("alert-error");
					$(".w2ui-msg-body #response_ajax").html(obj.Error);
					$(".w2ui-msg-body #response_ajax").show();
				}else{
					$(".w2ui-msg-body #response_ajax").addClass("alert-success");
					$(".w2ui-msg-body #response_ajax").html(obj.Message);
					$(".w2ui-msg-body #response_ajax").show();
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
			   console.log(textStatus, errorThrown);
			}
		});
		return false;
	});
	
	$("#button").click(function() {
		$('html, body').animate({
			scrollTop: $("#elementtoScrollToID").offset().top
		}, 2000);
	});
	
	
});
function openPopup(URL,data,width,height){
	data.postAjax=1;
	jQuery.ajax({
        url: URL,
        type: "post",
		data: data,
        success: function (response) {
           // you will get response from your php page (what you echo or print)                 
		   var obj = jQuery.parseJSON(response);
			if(obj.Response=='Error')
			{
				alert(obj.Error);
			}else{
				jQuery("#ajaxPopup").css('width',width+"px");
				jQuery("#ajaxPopup").css('height',height+"px");
				jQuery("#ajaxPopup").html(obj.Message);
				jQuery("#ajaxPopup").w2popup();
			}
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	return false;
}

