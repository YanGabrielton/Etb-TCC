# 📃 Manual do Banco de Dados
Este projeto usa o SGBD Postgres, você precisa tê-lo na sua máquina ou um respectivo container docker.

## 🚀 Como iniciar o banco de dados localmente

### 1. Copie, cole e renomeie o arquivo [.example.env](.example.env)

```bash
  cp .example.env .env
```

### 2. Altere os valores relacionados com o banco de dados
> Poderá mudar os valores usando o nano, por exemplo, ou pelo editor que preferir

```bash
  nano .env
```

### 3. Escolha o melhor modo de criar o banco de dados, para você

### ✅ 🐳 Com Docker
> Certifique-se de ter instalado o [Docker](https://www.docker.com/get-started/) na sua máquina

#### 1. Acesse o seu terminal e digite o seguinte comando

```bash
  docker compose up .
```

### ⛔ 🐋 Sem Docker
> Certifique-se de ter instalado a versão 17.4 do SGBD [Postgres](https://postgres.org/) na sua máquina

#### 1. Como executar os scripts da pasta [./sql](/scripts/database/sql)

```bash
  pgsql ...
```

## 🔍 Guia de consultas