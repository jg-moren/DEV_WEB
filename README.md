Sempre que precisar gerenciar o seu ambiente, navegue até a pasta ~/meu-xampp e use:

    Para parar o servidor: docker-compose down

    Para iniciar o servidor: docker-compose up -d

    Para ver se tudo está rodando: docker ps

    Dados de conexão do Banco de Dados (no seu código PHP):

        Host: db (o Docker resolve o nome do serviço como IP automaticamente)

        Usuário: root

        Senha: root (definida no arquivo yml)


Para crirar o banco de dados use:
sudo docker exec -i xampp_db mysql -u root -proot < db.sql

Para abrir o banco de dados use:
docker exec -it xampp_db mysql -u root -p
senha: root
