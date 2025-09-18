# Instalação e Execução do Projeto

Este documento guiará você pelo processo de configuração e execução da aplicação utilizando **Docker**, **PHP** e **Doctrine**.

---

### Pré-requisitos

Certifique-se de ter o **Docker** e o **Docker Compose** instalados em sua máquina.

---

### 1. Configuração do Ambiente

1.  **Instale as dependências do projeto:**
    Navegue até o diretório raiz do projeto e execute o comando abaixo para instalar as bibliotecas do Composer, ignorando as verificações de versão da plataforma.

    ```bash
    composer install --ignore-platform-reqs
    ```

2.  **Inicie os serviços com Docker:**
    Use o Docker Compose para construir as imagens e iniciar os containers do projeto. O comando `-d` executa os containers em segundo plano, deixando o terminal livre.

    ```bash
    docker-compose up --build -d
    ```

---

### 2. Configuração do Banco de Dados

1.  **Crie o banco de dados:**
    O script SQL necessário para criar a estrutura do banco de dados está no arquivo `database.sql`, localizado na raiz do projeto.

2.  **Execute o script:**
    Conecte-se ao banco de dados e execute o conteúdo do arquivo `database.sql` para criar as tabelas e popular o banco de dados conforme necessário.

---

### 3. Acessando a Aplicação

Após a execução de todos os passos anteriores, a aplicação estará disponível e rodando em:

**`http://localhost:8000`**
