YouHighFiveMe ^5
================

Welcome to the YouHiveFiveMe open source project.

#What is YouHighFiveMe project?

YouHighFive is a project that allows people to create their profile and let
other people give them high fives from different occasions, community help,
conference talks or any other type of activity they do.

Over time, user's will get their asset page generated with lot's of references
from people.

#Installation

Clone this project into your development environment.

    $ git clone https://github.com/YouHighFiveMe/youhighfiveme.git

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
folder have write access and run the following commands:

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
to us on IRC and let us know what issue you are willing to work on.

Enjoy and welcome to the project!
