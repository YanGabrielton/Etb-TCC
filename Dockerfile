# Traz a imagem (receita) do PHP 8.4 + PHP CLI (Command Line Interface do PHP)
FROM php:8.4-cli

# Copia todos os arquivos da máquina hospedeira para o diretório /usr/src dentro do container
COPY . /usr/src
# Define o diretório de trabalho dentro do container
WORKDIR /usr/src

# Expoõe a porta 5173 (permitindo acessar de fora do container), que é onde o servidor embutido do PHP irá rodar
EXPOSE 5173
# Executa o comando para iniciar o servidor embutido do PHP
CMD [ "php", "-S", "0.0.0.0:5173" ]