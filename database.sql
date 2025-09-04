CREATE TABLE montadoras (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

CREATE TABLE automoveis (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    placa VARCHAR(10) NOT NULL UNIQUE,
    chassi VARCHAR(50) NOT NULL UNIQUE,
    montadora INT,
    FOREIGN KEY (montadora) REFERENCES montadoras(codigo)
);

INSERT INTO montadoras (nome) VALUES ('Volkswagen'), ('Ford'), ('Fiat'), ('Chevrolet');