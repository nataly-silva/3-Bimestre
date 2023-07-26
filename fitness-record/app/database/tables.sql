DROP TABLE IF EXISTS logins;

CREATE TABLE IF NOT EXISTS logins (
    id              INTEGER PRIMARY KEY,
    nome            TEXT    NOT NULL,
    dataNascimento  TEXT NOT NULL,
    tipo            INTEGER NOT NULL,
    email           TEXT NOT NULL,
    senha           TEXT NOT NULL
);

DROP TABLE IF EXISTS usuarios;

CREATE TABLE IF NOT EXISTS usuarios (
    id              INTEGER PRIMARY KEY,
    id_login        INTEGER,
    endereco        TEXT,
    celular         TEXT,
    situacao        INTEGER,
    condicao        INTEGER,
    ativado         INTEGER,
    CONSTRAINT fk_situacao FOREIGN KEY (situacao) REFERENCES situacao (id),
    CONSTRAINT fk_login FOREIGN KEY (id_login) REFERENCES logins (id)
);
CREATE TABLE IF NOT EXISTS usuarioTipo (
    id INTEGER PRIMARY KEY,
    tipo INTEGER
);

DROP TABLE IF EXISTS situacao;

CREATE TABLE IF NOT EXISTS situacao (
    id             INTEGER PRIMARY KEY,
    tipo            TEXT
);

DROP TABLE IF EXISTS objetivos;

CREATE TABLE IF NOT EXISTS objetivos (
    id             INTEGER PRIMARY KEY,
    obj            TEXT
);

DROP TABLE IF EXISTS objetivos_usuarios;

CREATE TABLE IF NOT EXISTS objetivos_usuarios (
    id_usuario      INTEGER PRIMARY KEY,
    id_objetivo     INTEGER,
    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios (id),
    CONSTRAINT fk_objetivo FOREIGN KEY (id_objetivo) REFERENCES objetivos (id)
);

INSERT INTO situacao (id, tipo) VALUES(1,"Desistente");
INSERT INTO situacao (id, tipo) VALUES(2,"Matriculado");

INSERT INTO objetivos (id, obj) VALUES(1,"Saúde");
INSERT INTO objetivos (id, obj) VALUES(2,"Hipertrofia");
INSERT INTO objetivos (id, obj) VALUES(3,"Perca de Peso");
