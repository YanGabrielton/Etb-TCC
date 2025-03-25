DROP TABLE IF EXISTS user_account CASCADE;
DROP TABLE IF EXISTS place_address CASCADE;
DROP TABLE IF EXISTS client_account;
DROP TABLE IF EXISTS employee_account;
DROP TABLE IF EXISTS service_category CASCADE;
DROP TABLE IF EXISTS service_announcement CASCADE;
DROP TABLE IF EXISTS employee_service CASCADE;
DROP TABLE IF EXISTS service_user_favorite;
DROP TABLE IF EXISTS review CASCADE;
DROP TABLE IF EXISTS client_review;
DROP TABLE IF EXISTS service_review;
DROP TYPE IF EXISTS account_status_type;
DROP TYPE IF EXISTS employee_service_status_type;

CREATE TYPE account_status_type as ENUM ('ACTIVE', 'UNDER_REVIEW', 'BLOCKED');
CREATE TYPE employee_service_status_type as ENUM ('ACCEPTED', 'REJECTED', 'PENDING', 'WELL_DONE!');

CREATE TABLE user_account (
  username      VARCHAR(40) NOT NULL CHECK (length(username) > 0),
  email         VARCHAR(100) NOT NULL CHECK (length(email) > 0),
  passwd        CHAR(64) NOT NULL CHECK (length(passwd) > 0),
  photo         TEXT NULL CHECK (photo IS NULL OR photo ~ '%\.(jpg|jpeg|png|webp|bmp)$'),
  cellphone     CHAR(11) NULL,
  created_date  TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
  status        account_status_type DEFAULT 'UNDER_REVIEW'
);

CREATE TABLE place_address (
  _id           INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  zip_code      CHAR(8) NOT NULL,
  state         CHAR(2) NOT NULL,
  city          TEXT NOT NULL,
  neighborhood  TEXT NOT NULL,
  street        TEXT NOT NULL
);

CREATE TABLE client_account (
  _id          INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  cpf          CHAR(11) NOT NULL UNIQUE CHECK (length(cpf) > 0),
  birth_date   DATE NOT NULL CHECK (birth_date < CURRENT_DATE AND birth_date > CURRENT_DATE - INTERVAL '100 years'),
  key_address  INTEGER NULL REFERENCES place_address (_id)
) INHERITS (user_account);

CREATE TABLE employee_account (
  _id          INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  cnpj         CHAR(14) NOT NULL UNIQUE CHECK (length(cnpj) > 0),
  curriculum   TEXT NOT NULL CHECK (length(curriculum) > 0 AND curriculum ~ '%\.(pdf|jpg|jpeg|png|webp|bmp)$'),
  key_address  INTEGER NULL REFERENCES place_address (_id)
) INHERITS (user_account);

CREATE TABLE service_category (
  _id           SMALLINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  title         TEXT NOT NULL CHECK (length(title) > 0),
  icon_name     TEXT NOT NULL CHECK (length(icon_name) > 0)
);

CREATE TABLE service_announcement (
  _id           INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  title         VARCHAR(50) NOT NULL CHECK (length(title) > 0),
  description   TEXT NULL,
  price         NUMERIC(7, 2) NOT NULL,
  category      SMALLINT NOT NULL REFERENCES service_category (_id),
  created_date  TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
  last_up_date  TIMESTAMPTZ NULL
);

CREATE TABLE employee_service (
  _id           INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  start_in      TIMESTAMPTZ NOT NULL,
  end_in        TIMESTAMPTZ NOT NULL,
  duration      INTERVAL NOT NULL GENERATED ALWAYS AS (end_in - start_in) STORED,
  price         NUMERIC(7, 2) NOT NULL,
  key_client    INTEGER NOT NULL REFERENCES client_account (_id),
  key_employee  INTEGER NOT NULL REFERENCES employee_account (_id),
  key_place     INTEGER NOT NULL REFERENCES place_address (_id),
  created_date  TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
  last_up_date  TIMESTAMPTZ NULL,
  status        employee_service_status_type DEFAULT 'PENDING'
);

CREATE TABLE service_user_favorite (
  key_service   INTEGER NOT NULL REFERENCES service_announcement (_id),
  key_client    INTEGER NOT NULL REFERENCES client_account (_id)
);

CREATE TABLE review (
  rating_number SMALLINT NULL DEFAULT 0 CHECK(rating_number BETWEEN 0 AND 10),
  commentary    TEXT NULL,
  created_date  TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP,
  last_up_date  TIMESTAMP NULL
);

CREATE TABLE client_review (
  _id           INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  category      TEXT[],
  key_employee  INTEGER NOT NULL REFERENCES employee_account (_id),
  key_client    INTEGER NOT NULL REFERENCES client_account (_id)
) INHERITS(review);

CREATE TABLE service_review (
  _id           INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  category      TEXT[],
  key_service   INTEGER NOT NULL REFERENCES employee_service (_id),
  key_employee  INTEGER NOT NULL REFERENCES employee_account (_id)
) INHERITS(review);

CREATE UNIQUE INDEX ON client_account (email);
CREATE UNIQUE INDEX ON employee_account (email);