<script src="<?php echo base_url('assets/js/pdf/pdfmake.js') ?>"></script>
<script src="<?php echo base_url('assets/js/pdf/vfs_fonts.js') ?>"></script>
<script>

	mytable = {
		style: 'tableExample',
		table: {
			headerRows: 1,
			widths: [ '*', '*' ],
			body: [
			[{ text: 'Box', 	  style: 'tableHeader' }, 
			{ text: 'Situação',  style: 'tableHeader' }], 

			<?php foreach($boxes as $box) {?>

				[ '<?php echo "Box ".$box[0]['num_box'];?>', 
				  <?php if($box[0]['box_tickets']>0){?>
		  				{
							stack: [
								'Itens em manutenção:',
								{
									ul: [
										  <?php foreach ($box as $item) {
										  		if($item['operating']==0){
														echo "'".$item['item']."',";
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
			text: 'Relatório geral dos boxes\n', 
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