$(document).ready(function(){
	$('#submit').click(function (){

		$('input').blur();
		var pswd = $('#newpswd').val();
		var conf = $('#confpswd').val();
		if(conf!=''&&pswd!=''){
			if(conf == pswd){
				$.post('activateuser',{newpswd : pswd,confpswd : conf},
					function(data, status){
						if(data['status']==1){
							window.location.reload();
						} else {
							$('#msg').text(data['message']);
							$('#messagebox').show(200);
							$('#newpswd').val('');
							$('#confpswd').val('');
						}				        
					});
			}else{
				$('#msg').text("As senhas não combinam");
				$('#messagebox').show(200);
				$('#newpswd').val('');
				$('#confpswd').val('');
			}
		} else {
			$('#msg').text("Preencha todos os campos");
				$('#messagebox').show(200);
				$('#newpswd').val('');
				$('#confpswd').val('');
		}
	});
	$('input').keypress(function(event){
		if(event.keyCode == 13){
			$('#submit').click();
		}
	});
	$('input').focus(function(){
		$('#messagebox').hide(200);
	});
	$('#messagebox').click(function(){
		$('#messagebox').hide(200);
	});
});