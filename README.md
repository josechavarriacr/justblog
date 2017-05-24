JustBlog
===============================

Simple platform for blogging based in Yii2

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    components/          contains files used to SEO, RSS and SyntaxHigh
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.

INSTALLATION
------------

1- git clone https://github.com/josechavarriacr/justblog.git
or dowloaded de zip file from https://github.com/josechavarriacr/justblog

2- composer update

3- composer install 

4- create databse called test

5- yii migrate

6- enjoy ;)


ACCESS
-------------

home -> http://localhost/justblog

admin -> http://localhost/justblog/admin


