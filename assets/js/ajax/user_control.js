

$('[id^="delete"]').click(function(){
	user_id = $(this).attr('id').slice(6);
	$('#modal-delete').openModal({dismissible:false});	
	$('#btndelete').data('user_id',user_id);
});

$('#btndelete').click(function(){
	deleteUser($(this).data('user_id'));
});


function deleteUser(user){

		
		if(user!= null){
			$.post(urldelete,{id_user : user},
				function(data, status){
					if(data['status']==1){
						$('#msg').text(data['message']);
						$('#messagebox').addClass('success-box');
						$('#messagebox').removeClass('error');
						$('#messagebox').show(200);
						$('#row'+user).remove();
					} else {
						$('#msg').text(data['message']);
						$('#messagebox').addClass('error');
						$('#messagebox').removeClass('success-box');
						$('#messagebox').show(200);
					}				        
				});
		}else{
			$('#msg').text("Algo deu errado");
			$('#messagebox').addClass('error');
			$('#messagebox').removeClass('success-box');
			$('#messagebox').show(200);
		}

		setTimeout(function(){
			$('#messagebox').hide(200);
		},5000);
	
	
}

$('[id^="reset"]').click(function(){
	user_id = $(this).attr('id').slice(5);
	$('#modal-reset').openModal({dismissible:false});	
	$('#btnreset').data('user_id',user_id);
})

$('#btnreset').click(function(){
	resetUser($(this).data('user_id'));
});

function resetUser(user){
	if(user!= null){
		$.post(urlreset,{id_user : user},
			function(data, status){
				if(data['status']==1){
					$('#msg').css('white-space','pre');
					$('#msg').text(data['message']);
					$('#messagebox').addClass('success-box');
					$('#messagebox').removeClass('error');
					$('#messagebox').show(200);
				} else {
					$('#msg').text(data['message']);
					$('#messagebox').addClass('error');
					$('#messagebox').removeClass('success-box');
					$('#messagebox').show(200);
				}				        
			});
	}else{
		$('#msg').text("Algo deu errado.");
		$('#messagebox').addClass('error');
		$('#messagebox').removeClass('success-box');
		$('#messagebox').show(200);
	}

	setTimeout(function(){
		$('#messagebox').hide(200);
	},8000);

}


$(document).ready(function(){


	$('#messagebox').click(function(){
		$('#messagebox').hide(200);
	});


});