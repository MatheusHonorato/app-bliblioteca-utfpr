# app-biblioteca-utfpr
App desenvolvido para a disciplina Ambiente de Ensino e Aprendizagem a Distância - MBA E.S. UTFPR 

<img src="https://raw.githubusercontent.com/MatheusHonorato/app-bliblioteca-utfpr/master/screenshot.png?token=AEV3GXF4VT6ZWJ7ATDTAXVK6W5BUC" width="600">

## Equipe

- Matheus Felipe Paixo Honorato, 
- Karolina Celeste Rolim Duarte, 
- Lucas Pedro Dos Santos, 
- Thais Silva Pereira, 
- Bruno da Silva Ecks

## Qual stack necessária para rodar o projeto?

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

