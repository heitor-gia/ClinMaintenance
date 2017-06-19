$(document).ready(function(){
	$('#submit').click(function (){
		$('#messagebox').removeClass('error success-box');
		$('input').blur();
		var name = $('#user_name').val();
		var type = $('#type').val();
		if(type != "" && name!=""){
			$.post('createUser',{name_user : name ,user_type : type},
				function(data, status){
					if(data['status']==1){
						$('#msg').text(data['message']);
						$('#messagebox').addClass('success-box');
						$('#messagebox').show(200);
						$('#user_name').val('');
					} else {
						$('#msg').text(data['message']);
						$('#messagebox').addClass('error');
						$('#messagebox').show(200);
						$('#user_name').val('');
					}			

				});
		}else{
			$('#msg').text("Preencha todos os campos");
			$('#messagebox').addClass('error');
			$('#messagebox').show(200);
			$('#user_name').val('');
		}
	});
	$('#user_name').keypress(function(event){
		if(event.keyCode == 13){
			$('#submit').click();
		}
	});
	$('#messagebox').click(function(){
		$('#messagebox').hide(200);
	});
	$('input').focus(function(){
		$('#messagebox').hide(200);
	});
});