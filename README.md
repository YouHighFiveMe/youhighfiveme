YouHighFiveMe
=============

Welcome to the new open source project!

YouHighFiveMe is a web application which allows people to create their profile and let other people 
give them credit, or high fives, for their events such as community help, conference talks 
or any other type of activity they do.

Over time, user's will get their asset page generated with lot's of references from people.
This can be viewed as less formal referral list than on curriculum vitae, but it can be added
as a personal asset.

#Staging environment

The staging environment is located at http://test.youhighfive.me and builds are
created whenever new changes are merged.

#Installation

Fork the project into your Github account and then clone it into your development environment.

    $ git clone git@github.com:YOUR_GIT_ACCOUNT_NAME/youhighfiveme.git

Now go to your newly created directory.

Copy the distribution file for the parameters to your local file:

    $ cp app/config/parameters.yml-dist app/config/parameters.yml

Modify the parameters.yml to reflect your database connections and smtp settings.

Prepare cache and logs folder permissions by running (double check your apache user on the first one):

    $ sudo chmod -Rf +a "daemon allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
    $ sudo chmod -Rf +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    $ curl -s https://getcomposer.org/installer | php

Then, use the `install` command to install all dependancies:

    $ php composer.phar install

After all dependancies are installed, make sure your app/cache and app/logs
folder have write access. If there is no write access, the web server might
output an internal error.

Connect to your database and run these commands:

    CREATE USER 'youhighfiveme'@'localhost' IDENTIFIED BY 'secret';
    GRANT ALL PRIVILEGES ON *.* TO 'youhighfiveme'@'localhost';

then run the following commands:

    $ app/console doctrine:database:create

#Database migrations

This app comes bundled with Doctrine Migrations bundle, which simplifies the
process of keeping database structure in sync with multiple developers and
production environment.

Migrations bundle checks the structure of your entities and does it's magic
based on that information.

After you have created the database as stated in previous section, you need to create schema into
the database. Since we are using Doctrine migrations, we use the console tool to create the schema.

    $ app/console doctrine:migrations:migrate

New migration scripts appear when you pull new code from Github. To see if there
are any new migrations available, you need to check the status.

    $ app/console doctrine:migrations:status

If you see new migrations available, all you have to do is run the migrations.

    $ app/console doctrine:migrations:migrate

You should now have your database in an updated state with up-to-date structure
that corresponds with application's entity classes.

#Initializing database

If you wish to erase data in the database and create a new fresh instance of
database with dummy data and three users, run the fixtures command:

    $ app/console doctrine:fixtures:load

NOTE: This will erase all data and create new dummy data. However, this process
will not recreate the structure of the database. If you wish to update schema before
you run fixtures, always run the Doctrine migrations tool.

Loading fixtures as described earlier, three user account are created: dev1, dev2 and dev3.
Passwords for these users are the same as the usernames respectively.

#Architecture

Application has a DemoBundle, which is a first revision of suggestion for the
application's architecture. Please review this bundle and state your opinion on
our IRC channel (channel information below).

#Testing

We strongly encourage you to practice test driven development and write those
unit tests for the code you make. As we have multiple developers involved,
it is crucial that we make sure the application code is working.

To run a test, go to your project's folder and run following command:

    $ phpunit -c app src/Portal

#IRC

You can catch us on IRC as this is the channel where most of the talk about development
and other things related to YouHighFiveMe reside at.

Channel: #youhighfive.me @ irc.freenode.net

#Contributing

Anyone is free to join the team and develop YouHighFiveMe. Before you do so, please read
the Wiki as it includes a lot of useful information about the project. Also, come and introduce yourself
to us on IRC and let us know what issue from the Github's issue list you are willing 
to work on.

Enjoy and welcome to the project!
