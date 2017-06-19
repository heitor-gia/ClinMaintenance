$(document).ready(function(){
	$('#submit').click(function (){
		
		$('#msg').text("");
		$('input').blur();
		var oldpassword  = $('#oldpswd').val();
		var newpassword  = $('#newpswd').val();
		var confpassword = $('#confpswd').val();

		if(oldpassword != "" && newpassword != "" && confpassword!=""){
			if (newpassword==confpassword) {
				$.post('changePassword',{oldpswd : oldpassword ,newpswd : newpassword, confpswd:confpassword},
					function(data, status){
						if(data['status']==1){
							$('#msg').text(data['message']);
							$('#messagebox').removeClass('error');
							$('#messagebox').addClass('success-box');
							$('#messagebox').show(200);
							$('#newpswd').val('');
							$('#oldpswd').val('');
							$('#confpswd').val('');						
						} else {
							$('#msg').text(data['message']);
							$('#messagebox').removeClass('success-box');
							$('#messagebox').addClass('error');
							$('#messagebox').show(200);
							$('#newpswd').val('');
							$('#oldpswd').val('');
							$('#confpswd').val('');	
						}			

					});
			}else{
				$('#msg').text("As senhas não combinam");
				$('#messagebox').show(200);
				$('#messagebox').removeClass('success-box');
				$('#messagebox').addClass('error');
				$('#newpswd').val('');
				$('#oldpswd').val('');
				$('#confpswd').val('');	
			}

		}else{
			$('#msg').text("Preencha todos os campos");
			$('#messagebox').show(200);
			$('#messagebox').removeClass('success-box');
			$('#messagebox').addClass('error');
			$('#newpswd').val('');
			$('#oldpswd').val('');
			$('#confpswd').val('');	
		}
	});
	$('#confpswd').keypress(function(event){
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