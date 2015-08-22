DROP TABLE tabela;
CREATE TABLE tabela (id INT IDENTITY, nome VARCHAR(30), filho VARCHAR(30));
CREATE UNIQUE CLUSTERED INDEX index_tabela ON tabela (id);

INSERT INTO tabela VALUES ('Zezé di Camargo', 'Wanessa Camargo');
INSERT INTO tabela VALUES ('Elis Regina', 'Maria Rita');
INSERT INTO tabela VALUES ('Xororó', 'Sandy');
INSERT INTO tabela VALUES ('Xororó', 'Júnior Lima');
INSERT INTO tabela VALUES ('Gilberto Gil', 'Preta Gil');
INSERT INTO tabela VALUES ('Gilberto Gil', 'Bela Gil');
INSERT INTO tabela VALUES ('Sílvio Santos', 'Patrícia Abravanel');
INSERT INTO tabela VALUES ('Sílvio Santos', 'Rebeca Abravanel');
INSERT INTO tabela VALUES ('Carlos Eduardo Dolabella', 'Dado Dolabella');
INSERT INTO tabela VALUES ('Fábio Júnior', 'Fiuk');

INSERT INTO tabela VALUES ('Fábio Júnior', 'Cléo Pires');
INSERT INTO tabela VALUES ('Fábio Júnior', 'Tayna Galvão');
INSERT INTO tabela VALUES ('Monique Evans', 'Bárbara Evans');
INSERT INTO tabela VALUES ('Jon Voight', 'Angelina Jolie');
INSERT INTO tabela VALUES ('Angelina Jolie', 'Zahara Jolie-Pitt');
INSERT INTO tabela VALUES ('Will Smith', 'Jaden Smith');
INSERT INTO tabela VALUES ('Will Smith', 'Willow Smith');

SELECT * 
FROM tabela;

SELECT DISTINCT nome 
FROM tabela 
ORDER BY nome;

INSERT INTO tabela VALUES ('Mr. Catra', NULL);
