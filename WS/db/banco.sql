CREATE TABLE produtos (
	id				INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	cod_barras		VARCHAR(50) NOT NULL UNIQUE,
	descricao 		VARCHAR(255) NOT NULL,
	votos			INT
)