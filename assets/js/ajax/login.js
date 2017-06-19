$(document).ready(function(){
	$('#submit').click(function (){	

		$('#msg').text("");
		var name = $('#user_name').val();
		var pswd = $('#password').val();
		if(pswd != "" && name!=""){
			$.post('users/login',{user_name : name ,password : pswd},
				function(data, status){
					if(data['status']==1){
						$('#messagebox').hide(200);
						window.location.reload();
					} else {
						$('#msg').text(data['message']);
						$('#messagebox').show(200);
						$('#password').val('');
					}			

				});
		}else{
			$('#msg').text("Preencha todos os campos");
			$('#messagebox').show(200);
		}
	});
	$('input').keypress(function(event){
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