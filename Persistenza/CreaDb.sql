DROP DATABASE IF EXISTS CodiciCatasto;
CREATE DATABASE CodiciCatasto;
USE CodiciCatasto;

CREATE TABLE codici (
    codice CHAR(4) NOT NULL,
    comune VARCHAR(40) NOT NULL,
    provincia CHAR(2) NOT NULL,
    PRIMARY KEY (provincia,comune)
);


LOAD DATA 
     LOCAL INFILE '../DATA/codici_comuni_italiani.txt'
     INTO TABLE codici
     FIELDS TERMINATED BY ';'
     LINES TERMINATED BY '\n';