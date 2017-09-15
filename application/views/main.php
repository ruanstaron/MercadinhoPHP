<body>
    <div id="center">
        <div id="container_busca">
            <h2 class="title">Merca<span class="highlight">dinho</span></h2>
            <div id="divBusca">
                <form method="get" action="<?php echo base_url(); ?>index.php/produto">
                    <img src="<?php echo base_url();?>/imagens/search3.png" alt="Buscar..."/>
                    <select id= "select" name="opcao">
                        <option value="cod_barras">Código de Barras</option>
                        <option value="descricao">Nome do produto</option>
                    </select>
                    <input type="text" id="txtBusca" name="txtBusca" placeholder="Buscar..."/>
                    <button id="btnBusca">Buscar</button>
                </form>
            </div>
        </div>
    </div>
</body> 