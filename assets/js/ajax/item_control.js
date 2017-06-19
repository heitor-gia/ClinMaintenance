
$('#newitem').click(function(){
	$('#modal').openModal({dismissible: false});
	$('#messagebox-info').show();
	$('#title').text("Novo item");
	$('#confirm').text('Cadastrar');
	$('#confirm').data('function',1)
});

$(document).on('click','.edit',function(){
	$('#modal').openModal({dismissible: false});
	$('#messagebox-info').hide();
	$('#title').text("Editar item");
	$('#name_item').val($(this).data('name'));
	$('#description').val($(this).data('description'));
	$('label').addClass('active');
	$('#confirm').text('Salvar');
	$('#confirm').data('function',2)
	$('#confirm').data('id',$(this).data('id'));
});

$(document).on('click','.delete',function(){
	$('#modal-delete').openModal({dismissible: false});
	$('#btndelete').data('id',$(this).data('id'));
});

function deleteItem(id){
	if(id!=''){
		$.post('itens/deleteItem',{id_item: id},
			function(data, status){
				if(data['status']==1){
					$('#msg').text(data['message']);
					$('#messagebox').addClass('success-box');
					$('#messagebox').removeClass('error');
					$('#messagebox').show(200);
					$('#row'+id).remove();

				} else {
					$('#msg').text(data['message']);
					$('#messagebox').addClass('error');
					$('#messagebox').removeClass('success-box');
					$('#messagebox').show(200);
				}		
				$('#modal').closeModal();		        
			});
	}else{
		$('#msg-modal').text("Erro 400!");
		$('#messagebox-modal').addClass('error');
		$('#messagebox-modal').removeClass('success-box');
		$('#messagebox-modal').show(200);
	}

	setTimeout(function(){
		$('#messagebox').hide(200);
	},8000);	
}

function newItem(name,description){
	
	if(name!= ''){
		$.post('itens/createItem',{name_item : name, description_item : description},
			function(data, status){
				if(data['status']==1){
					id = data['id_item'];
					$('#msg').text(data['message']);
					$('#messagebox').addClass('success-box');
					$('#messagebox').removeClass('error');
					$('#messagebox').show(200);
					$('#name_item').val('');
					$('#description').val('');
					$('table > tbody:last-child').append('<tr id="row'+id+'"><td id="name'+id+'">'+name+'</td><td><a id="item'+id+'" class="btn-flat waves-effect edit" data-id='+id+' data-name="'+name+'" data-description="'+description+'" ><i class="material-icons">mode_edit</i></a><a class="btn-flat waves-effect delete"  id="delete'+id+'" data-id='+id+'><i class="material-icons">delete</i></a></td></tr>');
				} else {
					$('#msg').text(data['message']);
					$('#messagebox').addClass('error');
					$('#messagebox').removeClass('success-box');
					$('#messagebox').show(200);
				}
				$('#modal').closeModal();

			});
	}else{
		$('#msg-modal').text('Preencha o campo "Nome do item".');
		$('#messagebox-modal').addClass('error');
		$('#messagebox-modal').removeClass('success-box');
		$('#messagebox-modal').show(200);
	}

	setTimeout(function(){
		$('#messagebox').hide(200);
	},5000);
}

function editItem(id,name,description){
	if(name!='' && id!=''){
		$.post('itens/editItem',{name_item : name, description_item : description,id_item: id},
			function(data, status){
				if(data['status']==1){
					$('#msg').css('white-space','pre');
					$('#msg').text(data['message']);
					$('#messagebox').addClass('success-box');
					$('#messagebox').removeClass('error');
					$('#messagebox').show(200);
					$('#item'+id).data('name',name);
					$('#name'+id).text(name);
					$('#item'+id).data('description',description);
					$('#name_item').val('');
					$('#description').val('');
					$('label').removeClass('active');
					$('#messagebox-modal').hide();

				} else {
					$('#msg').text(data['message']);
					$('#messagebox').addClass('error');
					$('#messagebox').removeClass('success-box');
					$('#messagebox').show(200);
				}		
				$('#modal').closeModal();		        
			});
	}else{
		$('#msg-modal').text("Preencha os campos corretamente.");
		$('#messagebox-modal').addClass('error');
		$('#messagebox-modal').removeClass('success-box');
		$('#messagebox-modal').show(200);
	}

	setTimeout(function(){
		$('#messagebox').hide(200);
	},8000);	
}


$('#btndelete').click(function(){
	id = $(this).data('id');
	deleteItem(id);
});

$('#confirm').click(function(){
	func = $(this).data('function');
	name = $('#name_item').val();
	description = $('#description').val();
	if(func==1){
		newItem(name,description);
	} else if (func==2){
		editItem($(this).data('id'),name,description);
	} else {
		$('#msg').text("Erro 403.");
		$('#messagebox').addClass('error');
		$('#messagebox').removeClass('success-box');
		$('#messagebox').show(200);
	}
});



$(document).ready(function(){
	$('#cancel').click(function(){
		$('#name_item').val('');
		$('#description').val('');
		$('label').removeClass('active');
		$('#messagebox-modal').hide();
	});

	$('#messagebox').click(function(){
		$('#messagebox').hide(200);
	});

	$('#messagebox-modal').click(function(){
		$('#messagebox-modal').hide(200);
	});

	$('#messagebox-info').click(function(){
		$('#messagebox-info').hide(200);
	});
});