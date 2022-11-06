# Teste técnico M2 Digital

## Subir containers de aplicação
`docker-compose up -d --force-recreate`

## Instalação de pacotes do projeto
`docker-compose exec web composer install`

## Informações de ambiente
Adicionado conexão ao container de mysql no arquivo .env.example:
<br>`docker-compose exec web cp .env.example .env`</br> ou copiá-lo manualmente na pasta 
e após copiado executar o comando:
<br>`docker-compose exec web php artisan key:generate`</br>

# Executar migrations
`docker-compose exec web php artisan migrate:fresh --seed`

## Pipeline
Para pipeline foi utilizado o Actions do github, o arquivo de configuração encontra-se na pasta .github/workflow

## Tratamento de exceção
O tratamento de exceção foi realizado usando o idioma português, mantendo o nome dos atributos do modelo
