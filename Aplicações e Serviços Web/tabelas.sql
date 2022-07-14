DROP TABLE IF EXISTS disp_instituicao;
DROP TABLE IF EXISTS disp_voluntario;
DROP TABLE IF EXISTS instituicao;
DROP TABLE IF EXISTS voluntario;
-- ----------------------------------------------------------------------------

CREATE TABLE voluntario(
   cc         NUMERIC(8),
   nome       VARCHAR(50),
   nascimento DATE NOT NULL,
   carta      VARCHAR(12),
   genero     CHAR(1),
   email      VARCHAR(50),
   passwd     VARCHAR(255),
   telefone   NUMERIC(9),
   concelho   VARCHAR(50),
   freguesia  VARCHAR(50),
   distrito   VARCHAR(50),
   foto       VARCHAR(50),
   --
    CONSTRAINT pk_voluntario
        PRIMARY KEY (cc),
    --
    CONSTRAINT ck_genero
        CHECK (genero in ('F', 'M', 'O'))
);


CREATE TABLE instituicao(
   nome       VARCHAR(50),
   tipo       VARCHAR(50),
   descricao  VARCHAR(255),
   email      VARCHAR(50),
   passwd     VARCHAR(255),
   telefone   NUMERIC(9),
   concelho   VARCHAR(50),
   freguesia  VARCHAR(50),
   distrito   VARCHAR(50),
   nome_cont  VARCHAR(50),
   tel_cont   NUMERIC(9),
   morada     VARCHAR(255),
   --
    CONSTRAINT pk_instituicao
        PRIMARY KEY (email)
);


CREATE TABLE disp_voluntario(
   cc       NUMERIC(8),
   dia      VARCHAR(50),
   hora_ini VARCHAR(50),
   hora_fim VARCHAR(50),

    --
    CONSTRAINT pk_disponibilidade_voluntario
        PRIMARY KEY (cc, dia, hora_ini, hora_fim),
    --
    CONSTRAINT fk_nome_voluntario
        FOREIGN KEY (cc)
            REFERENCES voluntario(cc) ON DELETE CASCADE,
    --
	CONSTRAINT ck_dia_voluntario
        CHECK (dia in ('Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'))

);


CREATE TABLE disp_instituicao(
   email    VARCHAR(50),
   dia      VARCHAR(50),
   hora_ini VARCHAR(50),
   hora_fim VARCHAR(50),

    --
    CONSTRAINT pk_disponibilidade_instituicao
        PRIMARY KEY (email, dia, hora_ini, hora_fim),
    --
    CONSTRAINT fk_nome_instituicao
        FOREIGN KEY (email) REFERENCES instituicao(email) ON DELETE CASCADE,
    --
	CONSTRAINT ck_dia_instituicao
        CHECK (dia in ('Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'))

);
