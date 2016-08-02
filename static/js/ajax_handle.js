function submitAjax(self,message="")
{
	if(message !=""){
		var confirm_result=confirm(message);
		if(!confirm_result)
			return false;
	}
	var parentForm=$(self).closest("form");
	var data=parentForm.serializeArray();
	var controller="";
	var task="";
	
	$.each(data, function(i, field) {
		if(field.name=="controller")
			controller=field.value;
		if(field.name=="task")
			task=field.value;
	});
	data.push({name: 'postAjax', value: 1});
	
	if(controller == "" || task == "")
	{	parentForm.children(".ajax_response").removeClass('alert-success').addClass("alert-error");
		parentForm.children(".ajax_response").html("Function not found.");
		parentForm.children(".ajax_response").show();
		return false;	
	}
	
	var URL=baseURL+controller+"/"+task;
		$.ajax({
			url: URL,
			type: "post",
			data: data,
			success: function (response) {
			   var obj = $.parseJSON(response);
			  	// console.log(obj.Response);
				if(obj.Response=='Error')
				{
					parentForm.children(".ajax_response").removeClass('alert-success').addClass("alert-error");
					parentForm.children(".ajax_response").html(obj.Error);
					parentForm.children(".ajax_response").show();
				}else{
					$(obj.delete_item_vandon).remove();
					$(".list_vandon"+obj.sid+" ul").append(obj.list_shipid);

					parentForm.children(".ajax_response").removeClass('alert-error').addClass("alert-success");
					parentForm.children(".ajax_response").html(obj.Message);
					parentForm.children(".ajax_response").show();
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
			   console.log(textStatus, errorThrown);
			}
		});
	return false;
}
	
	
jQuery(document).ready(function($){
		$(".ajaxForm").submit(function(event){
		var data = $(this).serializeArray();
		data.push({name: 'postAjax', value: 1});
		var controller=$("input[name=controller]").val();
		var task=$("input[name=task]").val();
		var URL=baseURL+controller+"/"+task;
		$.ajax({
			url: URL,
			type: "post",
			data: data,
			success: function (response) {
			   // you will get response from your php page (what you echo or print)                 
			   var obj = $.parseJSON(response);
				if(obj.Response=='Error')
				{
					$(".w2ui-msg-body #response_ajax").removeClass('alert-success').addClass("alert-error");
					$(".w2ui-msg-body #response_ajax").html(obj.Error);
					$(".w2ui-msg-body #response_ajax").show();
				}else{
					$(".w2ui-msg-body #response_ajax").removeClass('alert-error').addClass("alert-success");
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


});


// function submitAjax(self,message="")
// {
// 	if(message !=""){
// 		var confirm_result=confirm(message);
// 		if(!confirm_result)
// 			return false;
// 	}
// 	var parentForm=$(self).closest("form");
// 	var data=parentForm.serializeArray();
// 	var controller="";
// 	var task="";
	
// 	$.each(data, function(i, field) {
// 		if(field.name=="controller")
// 			controller=field.value;
// 		if(field.name=="task")
// 			task=field.value;
// 	});
// 	data.push({name: 'postAjax', value: 1});
	
// 	if(controller == "" || task == "")
// 	{	parentForm.children(".ajax_response").removeClass('alert-success').addClass("alert-error");
// 		parentForm.children(".ajax_response").html("Function not found.");
// 		parentForm.children(".ajax_response").show();
// 		return false;	
// 	}
	
// 	var URL=baseURL+controller+"/"+task;
// 		$.ajax({
// 			url: URL,
// 			type: "post",
// 			data: data,
// 			success: function (response) {
// 			   var obj = $.parseJSON(response);
// 			  console.log(obj.Response);
// 				if(obj.Response=='Error')
// 				{
// 					parentForm.children(".ajax_response").removeClass('alert-success').addClass("alert-error");
// 					parentForm.children(".ajax_response").html(obj.Error);
// 					parentForm.children(".ajax_response").show();
// 				}else{
// 					parentForm.children(".ajax_response").removeClass('alert-error').addClass("alert-success");
// 					parentForm.children(".ajax_response").html(obj.Message);
// 					parentForm.children(".ajax_response").show();
// 					// $(".list_vandon ol").html(obj.list_shipid);
// 					// $(".list_vandon ol").show();
// 				}
// 			},
// 			error: function(jqXHR, textStatus, errorThrown) {
// 			   console.log(textStatus, errorThrown);
// 			}
// 		});
// 	return false;
// }
	
	
// jQuery(document).ready(function($){
// 		$(".ajaxForm").submit(function(event){
// 		var data = $(this).serializeArray();
// 		data.push({name: 'postAjax', value: 1});
// 		var controller=$("input[name=controller]").val();
// 		var task=$("input[name=task]").val();
// 		var URL=baseURL+controller+"/"+task;
// 		$.ajax({
// 			url: URL,
// 			type: "post",
// 			data: data,
// 			success: function (response) {
// 			   // you will get response from your php page (what you echo or print)                 
// 			   var obj = $.parseJSON(response);
// 				if(obj.Response=='Error')
// 				{
// 					$(".w2ui-msg-body #response_ajax").removeClass('alert-success').addClass("alert-error");
// 					$(".w2ui-msg-body #response_ajax").html(obj.Error);
// 					$(".w2ui-msg-body #response_ajax").show();
// 				}else{
// 					$(".w2ui-msg-body #response_ajax").removeClass('alert-error').addClass("alert-success");
// 					$(".w2ui-msg-body #response_ajax").html(obj.Message);
// 					$(".w2ui-msg-body #response_ajax").show();
// 				}
// 			},
// 			error: function(jqXHR, textStatus, errorThrown) {
// 			   console.log(textStatus, errorThrown);
// 			}
// 		});
// 		return false;
// 	});


// });