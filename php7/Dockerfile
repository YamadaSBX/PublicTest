FROM php:7.3-fpm

#プロジェクト名
ENV PROJECT_NAME="fuel_server"

RUN apt-get update 
RUN apt-get install -y default-mysql-client
#zip,unzip
RUN apt-get install -y zip unzip
#vim
RUN apt-get install -y vim curl

#composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod 777 /usr/local/bin/composer


WORKDIR /var/www

#oilインストール
RUN curl https://get.fuelphp.com/oil | sh
    
#プロジェクト作成
RUN oil create $PROJECT_NAME


WORKDIR $PROJECT_NAME
    
#PHPUnitインストール
RUN composer require --dev phpunit/phpunit ^7
