
##Dependency management##


Composer is some weird shit. If you update dependencies in composer.json, and run "php composer.phar install", it won't fetch new requirements because for some reason composer.lock file does not get updated. At the same time, we don't want to update our third-party libraries since it may introduce new backward-incompatible changes and break our project. To workaround it, run the following (use simply "composer "command"" if you have composer installed globally, or run "php composer.phar "command"" if you don't, composer.phar file is included in our project so you will be fine):


If were changed dependencies (composer.json), then after pull run (following command will update composer.lock file and will fetch new libraries without updating existing ones):


UNIX:

```
php composer.phar update nothing
```

WINDOWS:

```

```

##Migrations##
If new migration files were committed, then you need to update your local db. After pull go to ```protected``` folder and run (don't forget to conf your db.php file for localhost):


UNIX:
```
./yii migrate
```


WINDOWS:
```
yii migrate
```


Project structure
-------------------

```
_protected
    assets/              contains assets definition
    config/              contains application configurations
    console              contains console commands (controllers and migrations)
    controllers/         contains Web controller classes
    helpers/             contains helper classes
    mail/                contains view files for e-mails
    models/              contains model classes
    rbac/                contains role based access control classes
    runtime/             contains files generated during runtime
    tests/               contains various tests for the basic application
    translations/        contains application translations
    views/               contains view files for the Web application
    widgets/             contains widgets
assets                   contains application assets generated during runtime
themes                   contains your themes
```
