YouHighFiveMe
=============

Welcome to the new open source project!

YouHighFiveMe is a web application which allows people to create their profile and let other people 
give them credit, or high fives, for their events such as community help, conference talks 
or any other type of activity they do.

Over time, user's will get their asset page generated with lot's of references from people.
This can be viewed as less formal referral list than on curriculum vitae, but it can be added
as a personal asset.

#Installation

Clone this project into your development environment.

    $ git clone git@github.com:YouHighFiveMe/youhighfiveme.git

Now go to your newly created directory.

Copy the distribution file for the parameters to your local file:

    $ cp app/config/parameters.yml-dist app/config/parameters.yml

Modify the parameters.yml to reflect your database connections and smtp settings.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    $ curl -s https://getcomposer.org/installer | php

Then, use the `install` command to install all dependancies:

    $ php composer.phar install

After all dependancies are installed, make sure your app/cache and app/logs
folder have write access.

Connect to your database and run these commands:

    CREATE USER 'youhighfiveme'@'localhost' IDENTIFIED BY 'secret';
    GRANT ALL PRIVILEGES ON *.* TO 'youhighfiveme'@'localhost';

then run the following commands:

    $ app/console doctrine:database:create

    $ app/console doctrine:schema:create

You should now have a working application environment.

#Database migrations

This app comes bundled with Doctrine Migrations bundle, which simplifies the
process of keeping database structure in sync with multiple developers and
production environment.

Migrations bundle checks the structure of your entities and does it's magic
based on that information.

You should create migration script after you are done with adding/dropping or
renaming tables, table columns or constraints.

    $ app/console doctrine:migrations:diff

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
you run fixtures, use following routine:

    $ app/console doctrine:schema:drop --force

    $ app/console doctrine:schema:create

Loading fixtures as described earler, three user account are created: dev1, dev2 and dev3.
Passwords for these users are the same as the usernames respectively.

#Testing

We strongly encourage you to practice test driven development and write those
unit tests for the code you make. As we have multiple developers involved,
it is crucial that we make sure the application code is working.

To run a test, go to your project's folder and run following command:

    $ phpunit -c app src/Portal

#IRC

You can catch us on IRC as this is the channel where most of the talk about development
and other things related to YouHighFiveMe reside at.

Channel: #youhighfive.me @ freenode.net

#Contributing

Anyone is free to join the team and develop YouHighFiveMe. Just introduce yourself
to us on IRC and let us know what issue from the Github's issue list you are willing 
to work on.

Enjoy and welcome to the project!
