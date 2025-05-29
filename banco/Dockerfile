# Traz a imagem (receita) do MySql 8.4
FROM mysql:8.4.0

# Copia os scripts SQL para o diretório de inicialização do MySQL
# Isso permite que o MySQL execute esses scripts quando o container for iniciado
COPY ./sql /docker-entrypoint-initdb.d

# Copia o arquivo de configuração personalizado para o diretório de configuração do MySQL
COPY ./custom.cnf /etc/mysql/conf.d/custom.cnf

# Expõe a porta 3306, que é a porta padrão do MySQL, no container
EXPOSE 3306