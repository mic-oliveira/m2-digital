[![Test Coverage](https://raw.githubusercontent.com/Hi-Folks/array/main/badge-coverage.svg)](https://packagist.org/packages/hi-folks/array)
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
`docker-compose exec web php artisan migrate:fresh`

# Executar migrations com seeder(popular base de dados)
`docker-compose exec web php artisan migrate:fresh --seed`

## Pipeline
Para pipeline foi utilizado o Actions do github, 
o arquivo de configuração encontra-se na pasta .github/workflow

## Testes unitários
Para executar todos os testes através do docker(os testes usando base de dados em memória). 
O pipeline no git executa estes mesmos testes. <br>
`docker-compose exec web ./vendor/bin/pest`

## Tratamento de exceção
O tratamento de exceção foi realizado usando o idioma português, mantendo o nome dos atributos do modelo
