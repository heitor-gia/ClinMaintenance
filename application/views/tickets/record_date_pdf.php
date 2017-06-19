<script src="<?php echo base_url('assets/js/pdf/pdfmake.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pdf/vfs_fonts.js') ?>"></script>
<script>

	mytable = {
		style: 'tableExample',
		table: {
			headerRows: 1,
			widths: [ 'auto', 'auto', 'auto', 70,70,'*' ],
			body: [
			[{ text: 'ID', style: 'tableHeader' }, 
			{ text: 'Item', 	  style: 'tableHeader'}, 
			{ text: 'Box', 	  style: 'tableHeader' }, 
			{ text: 'Abertura',  style: 'tableHeader' }, 
			{ text: 'Fechamento', style: 'tableHeader' }, 
			{ text: 'Descrição', style: 'tableHeader' }],

			<?php foreach($tickets as $ticket) {
				?>
				[ '<?php echo $ticket['id_ticket'];?>', 
				'<?php echo $ticket['item'];?>', 
				'<?php echo $ticket['num_box'];?>', 
				'<?php echo $ticket['creation_ticket'];?>', 
				'<?php echo $ticket['close_ticket']!=NULL?$ticket['close_ticket']:'Não resolvido';?>', 
				'<?php echo $ticket['description_ticket'];?>' ],

				<?php
			} ?>
			]
		},
		layout: 'lightHorizontalLines'
	}


	var dd = {content:[
		{ 
			text: 'Relatório de chamados\n\n', 
			style: 'header' 
		},
		<?php if($max!=''||$min!=''){ ?>
			{ 
			text: '<?php if($min!=''){?>A partir de <?php echo nice_date($min,"d/m/Y")?><?php }?><?php if($max!=''){?> até <?php echo nice_date($max,"d/m/Y")?>
					<?php }?>', 
			style: 'subheader' 
			},
		<?php }?>
		{ 
			text: '\nNº total de chamados:<?php echo count($tickets)?> \n \n', 
			style: 'subheader' 
		},
			mytable
		<?php if(!$tickets){?>
			,{
				text: 'Não foi possível gerar o relatório', 
				style: 'header'
			} 
		<?php }?>
		],

		styles: {
			header: {
				fontSize: 20,
				bold: true,
				alignment: 'center'
			},
			subheader: {
				fontSize: 15,
				bold: true,
				alignment: 'center'
			},
			quote: {
				italics: true
			},
			small: {
				fontSize: 8
			}
		}
	}
	pdfMake.createPdf(dd).open();
	window.location.replace('<?php echo site_url('tickets/records') ?>');

</script>