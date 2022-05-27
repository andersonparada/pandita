FROM ubuntu:20.04

LABEL maintainer="Taylor Otwell"

ARG WWWGROUP

WORKDIR /var/www

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=America/Guatemala

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip supervisor libcap2-bin libpng-dev python2 locales\
    && locale-gen es_GT \
    && locale-gen es_GT.UTF-8 \
    && update-locale \
    && mkdir -p ~/.gnupg \
    && chmod 600 ~/.gnupg \
    && echo "disable-ipv6" >> ~/.gnupg/dirmngr.conf \
    && apt-key adv --homedir ~/.gnupg --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys E5267A6C \
    && apt-key adv --homedir ~/.gnupg --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys C300EE8C \
    && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu focal main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
    && apt-get update --allow-unauthenticated\
    && apt-get install -y php8.1-fpm php8.1-cli php8.1-dev \
    php8.1-gd \
    php8.1-curl php8.1-memcached \
    php8.1-imap php8.1-mysql php8.1-mbstring \
    php8.1-xml php8.1-zip php8.1-bcmath php8.1-soap \
    php8.1-intl php8.1-readline \
    php8.1-msgpack php8.1-igbinary php8.1-ldap \
    php8.1-redis php8.1-imagick\
    && apt-get install -y nginx \
    && update-rc.d nginx defaults \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && apt-get update \
    && apt-get install -y mysql-client \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


ARG imagemagic_config=/etc/ImageMagick-6/policy.xml

RUN if [ -f $imagemagic_config ] ; then sed -i 's/<policy domain="coder" rights="none" pattern="PDF" \/>/<policy domain="coder" rights="read|write" pattern="PDF" \/>/g' $imagemagic_config ; else echo did not see file $imagemagic_config ; fi

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.1

RUN groupadd --force -g 1000 sail
RUN useradd -ms /bin/bash --no-user-group -g 1000 -u 1337 sail

COPY dockerfiles/app/start-container /usr/local/bin/start-container
COPY dockerfiles/app/scheduler.sh /usr/local/bin/scheduler.sh
COPY dockerfiles/app/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY dockerfiles/app/php.ini /etc/php/8.1/fpm/conf.d/99-sail.ini
COPY dockerfiles/app/vhost.conf /etc/nginx/sites-available/default

RUN chmod +x /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/scheduler.sh

ENTRYPOINT ["start-container"]
