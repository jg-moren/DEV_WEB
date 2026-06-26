
# Bolão da Copa 2026 🏆

**🌍 Acesso ao site ao vivo:** [https://copa.nfy.fyi](https://copa.nfy.fyi)

Sistema web de gerenciamento e palpites para a Copa do Mundo de 2026. Desenvolvido em PHP e MySQL, com suporte a deploy em hospedagem em nuvem (InfinityFree) e ambiente de desenvolvimento local isolado em contêineres Docker.

## 🚀 Funcionalidades

* **Sistema de Autenticação:** Cadastro e login de usuários utilizando criptografia de senhas nativa do PHP (`password_hash`).
* **Área do Administrador:** Gerenciamento completo de partidas (criação, atualização de resultados reais e exclusão de jogos).
* **Área do Usuário (Palpiteiro):** Interface dinâmica para registrar palpites nos jogos disponíveis.
* **Gamificação:** Cálculo automático de acertos exatos e erros com base nos resultados reais das partidas.
* **Interface Responsiva:** Layout moderno utilizando Bootstrap 5, com sistema de cards e temas escuros transparentes.

## 🛠️ Tecnologias Utilizadas

* **Backend:** PHP (Sessões seguras, PDO para conexão com o banco).
* **Banco de Dados:** MySQL (Consultas parametrizadas prevenindo SQL Injection, uso de `INNER JOIN`).
* **Frontend:** HTML5, CSS3, JavaScript e Bootstrap 5.3.
* **Infraestrutura:** Docker e Docker Compose (para ambiente de desenvolvimento).

---

## ⚙️ Como executar o projeto localmente

Certifique-se de ter o Docker e o Docker Compose instalados no seu sistema.

### 1. Iniciando o Servidor
Navegue até a pasta raiz do ambiente (onde está o seu `docker-compose.yml`) e suba os contêineres em segundo plano:

```bash
docker-compose up -d

```

### 2. Configurando o Banco de Dados

Com os contêineres rodando, você precisa importar as tabelas (certifique-se de ter o arquivo `db.sql` no diretório). Rode o comando abaixo para popular o banco de dados:

```bash
sudo docker exec -i xampp_db mysql -u root -proot < db.sql

```

*(Obs: Dependendo da configuração de grupos de usuário no seu Linux, o `sudo` pode ser omitido).*

### 3. Acessando o Sistema

* **Aplicação Web:** Acesse `http://localhost` no seu navegador.
* **Acessar o terminal do Banco de Dados:**
```bash
docker exec -it xampp_db mysql -u root -p
# A senha solicitará: root

```



---

## 💻 Gerenciamento do Ambiente Local (Cheatsheet)

Sempre que precisar gerenciar o seu ambiente Docker, utilize os comandos abaixo no diretório `~/meu-xampp`:

* **Para parar o servidor:**
```bash
docker-compose down

```


* **Para iniciar o servidor:**
```bash
docker-compose up -d

```


* **Para ver se os serviços estão rodando:**
```bash
docker ps

```



---

## 🔌 Dados de Conexão (Para o PHP)

No arquivo `conexao.php`, as credenciais para o PDO se conectarem ao banco de dados rodando localmente no Docker são:

* **Host:** `db` *(O Docker resolve o nome do serviço para o IP correto automaticamente)*
* **Banco de Dados:** `meu_sistema` *(Verifique o nome exato usado no seu db.sql)*
* **Usuário:** `root`
* **Senha:** `root` *(Definida no docker-compose.yml)*

*(Nota: Para deploy no InfinityFree, os dados de Host, Banco de Dados, Usuário e Senha devem ser alterados conforme fornecido no painel vPanel da hospedagem).*

---

## 📁 Estrutura de Diretórios (Resumo)

* `/pages/` - Contém as views e interfaces do usuário (`BolãodaCopa.php`, `ADMPage.php`, `Cadastro.php`).
* `/service/` - Contém a lógica de negócio, classes e processadores de formulários (`login.php`, `bolao.php`, `deleta_jogo.php`).
* `/style/` & `/img/` & `/script/` - Arquivos estáticos (CSS, Imagens, JS).
* `/index.php` - Tela inicial / Login.

---

## ⚠️ Notas Importantes de Segurança

* **Senhas no Banco:** O sistema exige que a coluna de senha na tabela `usuarios` seja do tipo `VARCHAR(255)` para suportar os hashes longos gerados pelo algoritmo do PHP. Nunca insira senhas em texto puro diretamente no banco.
* **Administrador:** Para definir um usuário como Administrador, altere a coluna `adm` desse usuário para `1` diretamente no banco de dados. Apenas usuários com esta flag têm acesso à `ADMPage.php`.
