# My 1st dockerfile
# Pls b ez on me
# GG thx

FROM webgriffe/php-apache-base

# Update stuff
RUN apt-get update
RUN apt-get install -y build-essential chrpath libssl-dev libxft-dev

# Install PhantomJS Prerequisites
RUN apt-get install -y libfreetype6 libfreetype6-dev
RUN apt-get install -y libfontconfig1 libfontconfig1-dev

# Install PhantomJS
#Url : https://bitbucket.org/ariya/phantomjs/downloads/phantomjs-2.1.1-linux-x86_64.tar.bz2

RUN cd ~
RUN export PHANTOM_JS="phantomjs-2.1.1-linux-x86_64"
RUN apt-get install wget -y
RUN wget https://github.com/Ashwinning/Image-Lancer/raw/master/phantomjs-2.1.1-linux-x86_64.tar.bz2
RUN tar xvjf phantomjs-2.1.1-linux-x86_64.tar.bz2

# Once downloaded, move Phantomjs folder to /usr/local/share/ and create a symlink:

RUN mv phantomjs-2.1.1-linux-x86_64 /usr/local/share
RUN ln -sf /usr/local/share/phantomjs-2.1.1-linux-x86_64/bin/phantomjs /usr/local/bin

# Show version num (Check if install worked out)

RUN phantomjs --version
