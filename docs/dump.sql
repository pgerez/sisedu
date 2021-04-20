ALTER TABLE Certificado ADD finalizado TINYINT(1) NOT NULL;


####para cliclolectivo en certificados

ALTER TABLE Certificado ADD ciclolectivo_id INT DEFAULT NULL;
ALTER TABLE Certificado ADD CONSTRAINT FK_D17AED2C3166A0C FOREIGN KEY (ciclolectivo_id) REFERENCES Ciclolectivo (id);
CREATE INDEX IDX_D17AED2C3166A0C ON Certificado (ciclolectivo_id);

