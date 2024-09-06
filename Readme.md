Pasos para correr el proyecto

1. Ejecutar docker compose up -d
2. Una vez ejecutado el docker verificar la integridad de la base de datos
3. Descargar las extensiones de php extension pack y php server para vscode
4. tener activo apache
5. dar ctrl + , y ir a la opcion arriba a la derecha o donde puedas entrar a settings.json y colocar lo que esta dentro de parentesis con su debida ruta
(  "php.validate.executablePath": "E:\\xampp\\php\\php.exe") y reiniciar vscode
6. Una vez tener entrar a views
7. entrar a index.php dar click derecho dentro del html y clickear php SERVE project
8. empezar a usar"# PruebaTecnicaPHP"


si existe algun error con la base de datos, aqui le facilito el sql

DROP TABLE IF EXISTS "public"."Author";
-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS "Author_id_author_seq";

-- Table Definition
CREATE TABLE "public"."Author" (
    "id_author" int4 NOT NULL DEFAULT nextval('"Author_id_author_seq"'::regclass),
    "author_name" varchar(255) NOT NULL,
    "author_lastName" varchar(255) NOT NULL,
    "birth_date" date,
    "biography" text,
    PRIMARY KEY ("id_author")
);

DROP TABLE IF EXISTS "public"."Book";
-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS "Book_id_book_seq";

-- Table Definition
CREATE TABLE "public"."Book" (
    "id_book" int4 NOT NULL DEFAULT nextval('"Book_id_book_seq"'::regclass),
    "title" varchar(255) NOT NULL,
    "id_author" int4,
    "ISBN" varchar(20),
    "date_publication" date,
    CONSTRAINT "Book_id_author_fkey" FOREIGN KEY ("id_author") REFERENCES "public"."Author"("id_author") ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY ("id_book")
);


-- Indices
CREATE UNIQUE INDEX "Book_ISBN_key" ON public."Book" USING btree ("ISBN");

DROP TABLE IF EXISTS "public"."Loan";
-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS "Loan_id_loan_seq";

-- Table Definition
CREATE TABLE "public"."Loan" (
    "id_loan" int4 NOT NULL DEFAULT nextval('"Loan_id_loan_seq"'::regclass),
    "id_book" int4,
    "id_user" int4,
    "loan_date" date NOT NULL,
    "regret_date" date,
    CONSTRAINT "Loan_id_book_fkey" FOREIGN KEY ("id_book") REFERENCES "public"."Book"("id_book") ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT "Loan_id_user_fkey" FOREIGN KEY ("id_user") REFERENCES "public"."User"("id_user") ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY ("id_loan")
);

DROP TABLE IF EXISTS "public"."User";
-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS "User_id_user_seq";

-- Table Definition
CREATE TABLE "public"."User" (
    "id_user" int4 NOT NULL DEFAULT nextval('"User_id_user_seq"'::regclass),
    "user_name" varchar(255) NOT NULL,
    "user_lastName" varchar(255) NOT NULL,
    "email" varchar(255) NOT NULL,
    "register_date" date,
    PRIMARY KEY ("id_user")
);


-- Indices
CREATE UNIQUE INDEX "User_email_key" ON public."User" USING btree (email);

INSERT INTO "public"."Author" ("id_author", "author_name", "author_lastName", "birth_date", "biography") VALUES
(1, 'Gabriel 2', 'García Márquez', '1927-03-06', 'Novelista, cuentista, editor y periodista colombiano, ganador del Premio Nobel de Literatura en 1982.');
INSERT INTO "public"."Author" ("id_author", "author_name", "author_lastName", "birth_date", "biography") VALUES
(3, 'Mario 3', 'Vargas Llosa', '1936-03-28', 'Novelista y ensayista peruano, ganador del Premio Nobel de Literatura en 2010.');
INSERT INTO "public"."Author" ("id_author", "author_name", "author_lastName", "birth_date", "biography") VALUES
(5, 'Mario 3', 'perez', '2024-09-18', 'nacio y murio');

INSERT INTO "public"."Book" ("id_book", "title", "id_author", "ISBN", "date_publication") VALUES
(7, 'Mi amor ', 3, '54454554', '2024-09-12');
INSERT INTO "public"."Book" ("id_book", "title", "id_author", "ISBN", "date_publication") VALUES
(2, 'El amor en los tiempos del cólera 22', 1, '9780307389732', '1985-03-01');
INSERT INTO "public"."Book" ("id_book", "title", "id_author", "ISBN", "date_publication") VALUES
(5, 'La tía Julia y el escribidor 2', 3, '9788497598623', '1977-09-01');
INSERT INTO "public"."Book" ("id_book", "title", "id_author", "ISBN", "date_publication") VALUES
(1, 'Cien años de soledad 4', 1, '9780060883287', '1967-06-05');



INSERT INTO "public"."User" ("id_user", "user_name", "user_lastName", "email", "register_date") VALUES
(12, 'Pastor ', 'lopez', 'admin@gmail.com', '2024-09-11');
INSERT INTO "public"."User" ("id_user", "user_name", "user_lastName", "email", "register_date") VALUES
(4, 'Efrain 2', 'Cabrera', 'efraincabrera35@gmail.com', '2024-09-12');

