# Guida Docker

#### 1. come avviare un webserver dockerizzato

Eseguire questo comando sulla bash:

    docker run -d -p 8080:80 --name my-apache-php-app --rm  -v /home/informatica/mio-sito:/var/www/html zener79/php:7.4-apache

#### 2. come avviare un container mysql-server

Bisogna avviare un container con mysql-server che monta un volume per la persistenza dei dati del DBMS e un volume per accedere al file dump.

Eseguire questo comando sulla bash, avendo cura di sostituire i percorsi delle cartelle:

    docker run --name my-mysql-server --rm -v PercorsoDellaCartella-mysqldata:/var/lib/mysql -v PercorsoDellaCartella-dump:/dump -e MYSQL_ROOT_PASSWORD=my-secret-pw -p 3306:3306 -d mysql:latest

Successivamente occorre ottenere una bash dantro il container al fine di importare il dump:

Eseguire il seguente comando:

    docker exec -it my-mysql-server bash
    
Infine importare il dump.

Eseguire i seguenti comandi:

    mysql -u root -p < /dump/create_employee.sql;
    
Quando sarà richiesta la password inserire: my-secret-pw

    exit;
    
Ora che avete completato la procedura siete pronti per partire.

Le volte successive sarà sufficiente avviare il container con MySQL tramite il seguente comando:

    docker run --name my-mysql-server --rm -v /home/informatica/mysqldata:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=my-secret-pw -p 3306:3306 -d mysql:latest
