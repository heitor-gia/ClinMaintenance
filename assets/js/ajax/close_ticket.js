

$('[id^="sit"]').click(function(){
	if(!$(this).data('status')){
		ticket = $(this).attr("id").slice(3);
		$('#modal').openModal({dismissible:false});
		$('#closeticket').data('ticket', ticket);
	}
	
});

$('#closeticket').click(function(){
	closeticket($(this).data('ticket'));
});	

function closeticket(ticket){
	
	if(ticket!= null){
		$.post(url,{id_ticket : ticket},
			function(data, status){
				if(data['status']==1){
					$('#msg').text(data['message']);
					$('#messagebox').addClass('success-box');
					$('#messagebox').removeClass('error');
					$('#messagebox').show(200);
					$('#sit'+ticket).removeClass('danger danger-hover');
					$('#sit'+ticket).addClass('success');
					$('#sit'+ticket).text('OK');
					$('#sit'+ticket).tooltip('remove');
					$('#sit'+ticket).css('cursor','default');
					$('#sit'+ticket).removeAttr('onclick');
					$('#close'+ticket).css('white-space','pre');
					$('#close'+ticket).text(data['time']);
					$('#sit'+ticket).data('status', true);
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
}





$(document).ready(function(){

	$('#messagebox').click(function(){
		$('#messagebox').hide(200);
	});
});