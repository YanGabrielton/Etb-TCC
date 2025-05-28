# Traz a imagem (receita) do MySql 8.4
FROM mysql:8.4

# Copia os scripts SQL para o diretório de inicialização do MySQL
# Isso permite que o MySQL execute esses scripts quando o container for iniciado
COPY ./sql /docker-entrypoint-initdb.d