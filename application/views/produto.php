<body>
	<h1>Lista de Produtos</h1>
	<table class="table">
		<tr>
			<td>
				<label>Código de Barras</label>
			</td>
			<td>
				<label>Produto</label>
			</td>
		</tr>
		<?php if(isset($produtos)) foreach($produtos as $produto) { ?>
			<tr>
				<td>
					<?php echo $produto->cod_barras ?>
				</td>
				<td>
					<?php echo $produto->descricao ?>
				</td>
			</tr>
		<?php } ?>
	</table>
</body>