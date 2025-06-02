# Traz a imagem (receita) do PHP 8.4 + Alpine Linux (uma distribuição leve do Linux)
FROM php:8.4-alpine as final

WORKDIR /job4you

COPY . /job4you

# Instala as extensões do PHP necessárias para o projeto
RUN docker-php-ext-install mysqli \
      && docker-php-ext-enable mysqli

EXPOSE 5173
# Executa o comando para iniciar o servidor embutido do PHP
CMD [ "php", "-S", "0.0.0.0:5173" ]