$(document).ready(function () {  
	//Active menu
	$("#menu > .nav li a").each(function () {
		var path = window.location.href;
		if ($(this).attr("href") == path) {
			$("#menu > .nav li").removeClass("nav-active");
			$(this).parent().addClass("nav-active");
			$(this).closest('.nav-parent').addClass('nav-expanded nav-active');
		}
	});
	// delete confirmation
	$(document).on('click','.btn-remove',function(){
		var c = confirm("Are you sure you want to permanently remove this record ?");
		if(c){
			return true;
		}
		return false;
	});
	//load plugins
	//dropify
	$('.dropify').dropify();
	/*Summernote editor*/
	summernote();
	//select2
	$("select.select2").select2();
	// datepicker
	$(document).on('focus', '.datepicker', function(){
		$(this).datepicker({
			format: 'yyyy-mm-dd'
		}).on('changeDate', function(){
			$(this).datepicker('hide');
			$("#main_modal").css("overflow-y","auto");
		});
	});

	//monthpicker
	$(document).on('focus', '.monthpicker', function(){
		$(this).datepicker( {
			format: "mm/yyyy",
			viewMode: "months", 
			minViewMode: "months"
		}).on('changeDate', function(){
			$(this).datepicker('hide');
		});	
	});
	

	//Form validation
	validate();	 
	// required
	$("input:required, select:required, textarea:required").prev().append("<span class='required'> *</span>");
	$("#main_modal").on('show.bs.modal', function () {
		$('#main_modal').css("overflow-y","hidden"); 		
	});

	$("#main_modal").on('shown.bs.modal', function () {
		setTimeout(function(){
			$('#main_modal').css("overflow-y","auto");
		}, 1000);	
	});

	//Ajax Modal Function
	$(document).on("click",".ajax-modal",function(){
		var link = $(this).attr("href");
		var title = $(this).data("title");
		$.ajax({
			url: link,
			beforeSend: function(){
				$("#preloader").css("display","block"); 
			},success: function(data){
				$("#preloader").css("display","none");

				$('#main_modal .modal-title').html(title);
				$('#main_modal .modal-body').html(data);
				$('#main_modal .alert-success').css("display","none");
				$('#main_modal .alert-danger').css("display","none");
				$('#main_modal').modal('show'); 
				//init Essention jQuery Library
				/*Summernote editor*/
				summernote();
				$('#main_modal .select2').select2();
				$('#main_modal .ajax-submit').validate();
				$('#main_modal .dropify').dropify();
				$('#main_modal input:required, #main_modal select:required, #main_modal textarea:required').prev().append('<span class="required"> *</span>');
			}
		});
		return false;
	}); 

	//Ajax Modal Submit
	$(document).on("submit",".ajax-submit",function(){		 
		var link = $(this).attr("action");
		$.ajax({
			method: "POST",
			url: link,
			data:  new FormData(this),
			mimeType:"multipart/form-data",
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function(){
				$("#preloader").css("display","block");  
			},success: function(data){
				$("#preloader").css("display","none"); 
				var json = JSON.parse(data);
				if(json['result'] == "success"){
					if(typeof json['redirect'] != 'undefined' && json['redirect'] != ''){
						Command: toastr['success'](json['message']);
						window.location.replace(json['redirect']);
						return true;
					}
					
					$("#main_modal .alert-danger").css("display","none");
					if(json['action'] == "update"){
						$('#row_'+json['data']['id']).find('td').each (function() {
							if(typeof $(this).attr("class") != "undefined"){
								$(this).html(json['data'][$(this).attr("class")]);
							}
						});  
					}else if(json['action'] == "store"){
						$('.ajax-submit')[0].reset();
						//store = true;
						var new_row = $("table").find('tr:eq(1)').clone().last();
						if(new_row.has('.action')['length'] == 0){
							window.location.reload();
							return true;
						}
						$(new_row).attr("id", "row_"+json['data']['id']);
						$(new_row).find('td').each (function() {
							if($(this).attr("class") == "dataTables_empty"){
								//window.location.reload();
							}	
							if(typeof $(this).attr("class") != "undefined"){
								$(this).html(json['data'][$(this).attr("class")]);
							}
						}); 
						
						var url  = window.location.href; 
						$(new_row).find('form').attr("action",url+"/"+json['data']['id']);
						$(new_row).find('.btn-warning').attr("href",url+"/"+json['data']['id']+"/edit");
						$(new_row).find('.btn-info').attr("href",url+"/"+json['data']['id']);
						$("table").prepend(new_row);
						//window.setTimeout(function(){window.location.reload()}, 2000);
					}
					Command: toastr['success'](json['message']);
					$('#main_modal').modal('hide');
				}else{
					jQuery.each( json['message'], function( i, val ) {
						$("#main_modal .alert-danger").html("<p>"+val+"</p>");
					});
					$("#main_modal .alert-success").css("display","none");
					$("#main_modal .alert-danger").css("display","block");
				}
			}
		});
		return false;
	});

	//Ajax Non Modal Submit
	$(".ajax-submit2").validate({
		submitHandler: function(form) {
			var link = $(form).attr("action");
			$.ajax({
				method: "POST",
				url: link,
				data:  new FormData(form),
				mimeType:"multipart/form-data",
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function(){
					$("#preloader").css("display","block");  
				},success: function(data){
					$("#preloader").css("display","none"); 
					var json = JSON.parse(data);
					if(json['result'] == "success"){
						Command: toastr['success'](json['message']);
						window.location.replace(json['redirect']);
					}else{
						jQuery.each( json['message'], function( i, val ) {
							Command: toastr['error'](val);
						});
						$("#main_modal .alert-success").css("display","none");
						$("#main_modal .alert-danger").css("display","block");
					}
				}
			});
			return false; 
		},invalidHandler: function(form, validator) {},
		errorPlacement: function(error, element) {}
	});

	//Ajax Delete
	$(document).on("submit",".ajax-delete",function(){	
		dis = this;		 
		var link = $(dis).attr("action");
		$.ajax({
			method: "POST",
			url: link,
			data:  new FormData(dis),
			mimeType:"multipart/form-data",
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function(){
				$("#preloader").css("display","block");  
			},success: function(data){
				$(dis).parent().parent().remove();
				$("#preloader").css("display","none"); 
				var json = JSON.parse(data);
				Command: toastr["success"](json['message']);
			}
		});
		return false;
	});
});


function validate(){
	//Validation Form
	$(".validate").validate({
		submitHandler: function(form) {
			form.submit();
		},invalidHandler: function(form, validator) {},
		errorPlacement: function(error, element) {}
	});
}

function summernote(){
	//summernote editor
	$('#summernote,.summernote').summernote({
		height: 200,
		popover: {
			image: [],
			link: [],
			air: []
		},
		toolbar: [
		['style', ['style']],
		['font', ['bold', 'italic', 'underline', 'clear']],
		['fontname', ['fontname']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		['height', ['height']],
		['table', ['table']],
		['view', ['fullscreen', 'codeview']],
		['help', ['help']]
		],
		dialogsInBody: true
	});
}

