# instalar dependencias
composer install

# subir os containers com Docker
docker-compose up --build


# ajustar permissões da pasta do projeto (se necessário)
sudo chmod -R 777 /home/nicolas/Documentos/crud-contatos


# criar o banco de dados
Dentro do diretório do projeto existe um arquivo chamado database.sql.
