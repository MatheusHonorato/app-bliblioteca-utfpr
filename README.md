# app-biblioteca-utfpr
App desenvolvido para a disciplina Ambiente de Ensino e Aprendizagem a Distância - MBA E.S. UTFPR 

<img src="https://raw.githubusercontent.com/MatheusHonorato/app-bliblioteca-utfpr/master/screenshot.png?token=AEV3GXF4VT6ZWJ7ATDTAXVK6W5BUC" width="100%">

## Funcionalidades

- Home da aplicação;
- Cadastrar usuário;
- Cadastrar Obras;
- Realizar empréstimos de obras.

## Equipe

- Matheus Felipe Paixo Honorato: Desenvolvedor - aplicação (package AP); 
- Karolina Celeste Rolim Duarte: Usuário do sistema; 
- Lucas Pedro Dos Santos: Desenvolvedor/projetista - Interface Gráfica (package IG); 
- Thais Silva Pereira: Desenvolvedor/projetista - banco de dados (package BD); 
- Bruno da Silva Ecks: Integrador.

## Qual a stack necessária para rodar o projeto?

- PHP 7
- Mysql
- Apache
- Composer
- Node
- NPM
- Git

## Como rodar o projeto na sua máquina

- Clone o projeto
    - git clone https://github.com/MatheusHonorato/app-bliblioteca-utfpr
- Intale as dependências e o framework
    - composer install --no-scripts
- Copie o arquivo .env.example
    - Se estiver utilizando linux: cp .env.example .env
    - Se estiver no windows abra o arquivo em um editor de código e o salve novamente     como .env
- Crie uma nova chave para a aplicação
    - php artisan key:generate
- Rode as migrations
    - php artisan migrate --seed

