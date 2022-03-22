### Treinamento Testes Automatizados

***Para executar o ambiente é necessário ter o Docker e Docker Compose instalados na maquina.***

Instalação

```bash
git clone git@github.com:jeffesonmaia/test-training.git

cd test-training/

docker-compose up -d

docker-compose exec test-training composer install
```

Rodar os testes
```
docker-compose exec test-training ./vendor/bin/phpunit tests
 ```
