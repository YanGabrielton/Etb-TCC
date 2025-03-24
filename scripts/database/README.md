# 📃 Manual do Banco de Dados
Este projeto usa o SGBD Postgres, você precisa tê-lo na sua máquina ou um respectivo container docker.

## 🚀 Como iniciar o banco de dados localmente

### 1. Copie, cole e renomeie o arquivo [.example.env](.example.env)

```bash
  cp .example.env .env
```

### 2. Altere os valores relacionados com o banco de dados no arquivo .env
> Poderá mudar os valores usando o nano, por exemplo, ou pelo editor que preferir

```bash
  nano .env
```

### 3. Suba os containers docker com o docker compose
> Certifique-se de ter instalado o [Docker](https://www.docker.com/get-started/) na sua máquina.
Você também pode subir apenas o container do banco de dados executando o Dockerfile na pasta [database](/scripts/database/Dockerfile)

#### 1. Acesse o seu terminal e digite o seguinte comando
> Esse comando subirá os containers da aplicação em modo background

```bash
  docker compose up -d
```

## 🔍 Guia de consultas