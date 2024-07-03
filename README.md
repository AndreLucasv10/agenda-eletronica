## Agenda-Eletronica

Agenda Eletronica feita para o desafio tecnico do estágio em desenvolvimento web onde terá todas as funções descritas a baixo

## Funções implementadas
 
* Funções implementadas
* Login para acesso ao sistema;
* Adição de eventos;
* Edição de eventos;
* Remoção de eventos;
* Listagem de eventos;
* Descrição de eventos;
* Hora de início do evento;
* Hora de Termino do evento;
* Status dos eventos
* Eventos com duração de mais de um dia;

## Tecnologias usadas


* PHP(versão:8.3.8) usando a extensão PHP Intelephense(versão: 1.10.4)
* Jquery(versão:3.7.1)
* Bootstrap5(versão:5.3.3)
* MySQL(versão:8.4) utilizando Xampp control panel (versão: 3.3.0)

## Instalando

Antes de qualquer coisa você precisa ter um ambiente PHP/Apache/Mysql configurado em sua maquina, pois o mesmo necessita de um servidor local para funcionar, eu uso XAMPP para linux, existem outros como Wamp e Vertrigo.

Vá na pasta do seu servidor (Usei o XAMPP 3.3.0) no meu caso a pasta 'htdocs' em outros servidores como Wamp é a 'www' e execute o comando git clone, caso tenha o git instalado, ou se preferir baixe os arquivos e mova até a mesma.

 Agora vá até seu banco de dados no meu caso localhost/phpmyadmin crie um novo banco com o nome calendario e importe o arquivo calendario.sql que contém o Banco de dados e itens pré cadastrados como o Usuário, recomendo abrir o arquivo e verificar os dados. Como a senha estão em md5 deixarei a baixo sem a criptografia:

* Usuario: lucas
* Senha: 123

 Pronto basta abrir o diretório onde se encontra os arquivos através do seu servidor, se for local: localhost/NomedaPasta.
