YouHighFiveMe ^5
================

Welcome to the YouHiveFiveMe open source project.

1) What is YouHighFiveMe project?
---------------------------------

YouHighFive is a project that allows people to create their profile and let
other people give them high fives from different occasions, community help,
conference talks or any other type of activity they do.

Over time, user's will get their asset page generated with lot's of references
from people.

2) Installation
---------------
 
If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    $ curl -s https://getcomposer.org/installer | php

Then, use the `install` command to install all dependancies:

    $ php composer.phar install

After all dependancies are installed, make sure your app/cache and app/logs
folder have write access and run the following commands:

    $ app/console doctrine:database:create

    $ app/console doctrine:schema:create

    $ app/console doctrine:fixtures:load

You should now have a working application environment with some dummy data
loaded.

Please join us for some development chat and ideas on IRC's freenode.net server
and channel #youhighfive.me

Enjoy and welcome to the project!

[1]:  http://youhighfive.me
[2]:  https://github.com/YouHighFiveMe/youhighfiveme
