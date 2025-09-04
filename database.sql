-- Comando para criar a tabela de montadoras
CREATE TABLE montadoras (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Comando para criar a tabela de automóveis, já com a ligação (FOREIGN KEY)
CREATE TABLE automoveis (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    placa VARCHAR(10) NOT NULL UNIQUE,
    chassi VARCHAR(50) NOT NULL UNIQUE,
    montadora INT,
    FOREIGN KEY (montadora) REFERENCES montadoras(codigo)
);

-- Comando para inserir os dados iniciais na tabela de montadoras
INSERT INTO montadoras (nome) VALUES ('Volkswagen'), ('Ford'), ('Fiat'), ('Chevrolet');