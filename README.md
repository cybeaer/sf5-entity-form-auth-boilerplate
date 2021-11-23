# Symfony 5 User Auth Boilerplate
based on Entity Model and Form Login
```
users:
    entity:
        class: App\Entity\User
        property: username
```

## enabling csrf and max login attemps
uncomment:
```
    # enable_csrf: true #just maybe
    #login_throttling: #not while setup
    #    max_attempts: 3
    #    interval: '15 minutes'
```

## crypt and cost
```
App\Entity\User:
    algorithm: auto
    cost:      10
```
using bcrypt with a cost of 10

## create root account
```
bin/console user:manage add-root
```

## DB
currently using sqlite (in .env) for faster testing purpose

configure it to your liking in 
```
config/package/doctrine.yaml
```
or uncomment and use the mysql config

## setup
```
$ composer install
$ symony serve 
```