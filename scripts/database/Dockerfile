FROM postgres:17.4-bullseye as initdb

WORKDIR /db

COPY ./sql ./scripts/database/
COPY ./initdb.sh /docker-entrypoint-initdb.d/