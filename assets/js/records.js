$(document).ready(function() {
	$('select').change(function(){
		
		if($(this).val()==2){
			$('.date').show(200);
		}else{
			$('.date').hide(200);
		}
	});



	$('.datepicker').pickadate({
		    selectMonths: true, // Creates a dropdown to control month
		    selectYears: 5, // Creates a dropdown of 15 years to control year
		    monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Augosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
		    monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
		    weekdaysFull: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
		    weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
		    showMonthsShort: undefined,
		    showWeekdaysFull: undefined,
		    format: 'dd-mm-yyyy',
		    today: 'Hoje',
		    clear: 'Limpar',
		    close: 'OK',
		    max: true,
		    min: new Date('2016-05-01'),
		    closeOnSelect: true,
		});

	$('#messagebox').click(function(){
		$('#messagebox').hide(200);
	});
	$('input').focus(function(){
		$('#messagebox').hide(200);
	});

});