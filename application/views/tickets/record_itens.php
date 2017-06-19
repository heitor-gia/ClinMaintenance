<script src="<?php echo base_url('assets/js/pdf/pdfmake.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pdf/vfs_fonts.js') ?>"></script>
<script>

	mytable = {
		style: 'tableExample',
		table: {
			headerRows: 1,
			widths: [ '*', '*' ],
			body: [
			[{ text: 'Item', 	  style: 'tableHeader' }, 
			{ text: 'Situação',  style: 'tableHeader' }], 

			<?php foreach($itens as $item) {?>

				[ '<?php echo $item[0]['item'];?>', 
				  <?php if($item[0]['item_tickets']>0){?>
		  				{
							stack: [
								'Boxes em manutenção:',
								{
									ul: [
										  <?php foreach ($item as $box) {
										  		if($box['operating']==0){
														echo "'".$box['num_box']."',";
											   }
											}?> 
											
									]
								}
							]
						}
					<?php } else {?>
						'OK'
					<?php }?>

				  ],

			<?php } ?>
			]
		},
		layout: 'lightHorizontalLines'
	}


	var dd = {content:[
		{ 
			text: 'Relatório geral dos itens\n', 
			style: 'header' 
		},
		{ 
			text: 'Em <?php echo date('d/m/Y') ?>\n\n', 
			style: 'subheader' 
		},
			mytable
		
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