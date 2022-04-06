# De David para Joinner Sistemas #

## Teste de desenvolvimento PHP/Lavavel/PostgreSQL ##

Obrigado pela oportunidade de participar do processo seletivo. to. 

### Orientações para rodar o teste ###

Faça clone do repositório do projeto:

Executar o comando `composer install` no diretório do teste.

Execute também o comando 'composer dump-autoload'.

### Banco de dados ###

Será necessário criar o banco de dados utilizando o arquivo *base.sql* localizado no diretório raíz desse projeto.

Altere o arquivo .env, conforme segue:

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=teste

#### Username e password, deve seguir suas configurações locais ou remota ####
DB_USERNAME=postgres   
DB_PASSWORD=root


Abaixo, as instruções de funcionamento do crud:

 - Na pasta teste, execute o camando 'php artisan serve'
 - Em seguida localhost:8000
 - Será iniciada com uma Lista/Grid sem os registros uma vêz que no seu banco ainda não tem registros, após o primeiro cadastrado, será exibido a lista com dados.
 - Para Incluir clique no botão ADICIONAR, será aberto um modal, preencha os campos e clique em cadastrar.
 - Para Alterar clique no icone 'péncil' na grid ações, será aberto um modal,preencha os campos e que deseja alterar clique em salvar.
 - Para Excluir clique no icone 'Lixeira' na grid ações, será aberto um modal,certifique que é este O registro que deseja alterar e clique em remover.
 - Para pesquisar nome de pessoas na lista digite o nome e tecle ENTER ou clique em pesquisar.
 
 **Atenciosamente!**