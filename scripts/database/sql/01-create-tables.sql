CREATE TYPE account_status_type as ENUM ('ACTIVE', 'UNDER_REVIEW', 'BLOCKED');
CREATE TYPE employee_service_status_type as ENUM ('ACCEPTED', 'REJECTED', 'PENDING', 'WELL_DONE!');


DROP TABLE IF EXISTS user_account;
CREATE TABLE user_account (
  _id           INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  username      VARCHAR(40) NOT NULL CHECK (username <> ''),
  email         VARCHAR(100) NOT NULL UNIQUE CHECK (email <> ''),
  passwd        CHAR(64) NOT NULL CHECK (username <> ''),
  photo         TEXT NULL,
  cellphone     CHAR(11) NULL,
  key_address   INTEGER NULL REFERENCES place_address (_id),
  created_date  TIMESTAMP WITH TIME ZONE GENERATED ALWAYS AS (CURRENT_TIMESTAMP),
  last_up_date  TIMESTAMP NULL WITH TIME ZONE,
  status        account_status_type DEFAULT 'UNDER REVIEW'
);


DROP TABLE IF EXISTS client_account;
CREATE TABLE client_account (
  cpf          CHAR(11) NOT NULL UNIQUE CHECK (cpf <> '')
) INHERITS (user_account);


DROP TABLE IF EXISTS employee_account;
CREATE TABLE employee_account (
  cnpj         CHAR(14) NOT NULL UNIQUE CHECK (cnpj <> '')
) INHERITS (user_account);


DROP TABLE IF EXISTS place_address;
CREATE TABLE place_address (
  _id           INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  zip_code      CHAR(8) NOT NULL,
  state         CHAR(2) NOT NULL,
  city          TEXT NOT NULL,
  neighborhood  TEXT NOT NULL,
  street        TEXT NOT NULL
);


DROP TABLE IF EXISTS service_category;
CREATE TABLE service_category (
  _id           INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  title         TEXT NOT NULL CHECK (title <> ''),
  icon          TEXT NOT NULL CHECK (title <> '')
);


DROP TABLE IF EXISTS employee_service;
CREATE TABLE employee_service (
  _id           INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  start_in      TIMESTAMP,
  end_in        TIMESTAMP,
  duration      INTERVAL,
  price         NUMERIC(7, 2) NOT NULL,
  key_client    INTEGER NOT NULL REFERENCES client_account (_id),
  key_employee  INTEGER NOT NULL REFERENCES employee_account (_id),
  created_date  TIMESTAMP WITH TIME ZONE GENERATED ALWAYS AS (CURRENT_TIMESTAMP),
  last_up_date  TIMESTAMP NULL WITH TIME ZONE,
  status        employee_service_status_type DEFAULT 'PENDING'
);


DROP TABLE IF EXISTS service_announcement;
CREATE TABLE service_announcement (
  _id           INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  title         VARCHAR(50) NOT NULL CHECK (title <> ''),
  description   TEXT NULL,
  price         NUMERIC(7, 2) NOT NULL,
  category      TEXT NOT NULL CHECK (category <> ''),
  created_date  TIMESTAMP WITH TIME ZONE GENERATED ALWAYS AS (CURRENT_TIMESTAMP),
  last_up_date  TIMESTAMP WITH TIME ZONE NULL
);


DROP TABLE IF EXISTS service_user_favorite;
CREATE TABLE service_user_favorite (
  key_service   INTEGER NOT NULL REFERENCES service_announcement (_id),
  key_user      INTEGER NOT NULL REFERENCES user_account (_id)
);


DROP TABLE IF EXISTS review;
CREATE TABLE review (
  _id           INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  rating_number TINYINT NULL DEFAULT 0 CHECK(rating_number BETWEEN 0 AND 10),
  commentary    TEXT NULL,
  key_user      INTEGER NOT NULL REFERENCES user_account (_id),
  key_service   INTEGER NOT NULL REFERENCES employee_service (_1),
  created_date  TIMESTAMP WITH TIME ZONE GENERATED ALWAYS AS (CURRENT_TIMESTAMP),
  last_up_date  TIMESTAMP NULL WITH TIME ZONE
);

DROP TABLE IF EXISTS client_review;
CREATE TABLE client_review (
  category      TEXT[]
  key_employee  INTEGER NOT NULL REFERENCES user_employee (_id),
  key_client    INTEGER NOT NULL REFERENCES user_client (_id)
) INHERITS(review);

DROP TABLE IF EXISTS service_review;
CREATE TABLE service_review (
  category      TEXT[]
  key_service   INTEGER NOT NULL REFERENCES employee_service (_id),
  key_employee  INTEGER NOT NULL REFERENCES user_employee (_id)
) INHERITS(review);