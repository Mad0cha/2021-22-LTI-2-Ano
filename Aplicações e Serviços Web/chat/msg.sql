CREATE TABLE mensagens(
   id       INT NOT NULL AUTO_INCREMENT,
   de       VARCHAR(255),
   para     VARCHAR(255),
   msg      TEXT,
   hora     VARCHAR(255),

   CONSTRAINT pk_msg
      PRIMARY KEY (id)


);
