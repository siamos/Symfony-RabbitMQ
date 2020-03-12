# Project Description:
An app that consumes data from Amazon api and saves them to database, filtering them before to RabbitMQ. The credentials for amazon, rabbitmq, and mysql was given, you are free to change them. 

Developed with: Symfony, RabbitMQ, Doctrine, MySql. 

* For the amazon api call i used symfony `HttpClient` library to fetch the data via get method and url.

* Data Formating:
`FormatingDataForRabbitMQ()` and `HexToDec()` are the custom functions that used to format the data to the correct form to send them on rabbitmq. 

* For the rabbitmq configuration and connection:
  Follow https://www.rabbitmq.com/tutorials/ for php. 

* For doctrine:
  Follow https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/tutorials/getting-started.html.

Every function in this project is well documented and comprehensive.

# 1 STEP
Install symfony 4 on your machine. follow https://symfony.com/doc/current/index.html

# 2 STEP
Get repository on your local ide

# 3 STEP
Run on your command line: symfony server:start, to initiate your local host

# 4 STEP
Run on your command line: symfony open:local, to open your local index page

# 5 STEP
The data from amazon api will automaticaly download and send to RabbitMQ for filtering, this may take some minutes.
After that the following message will be appear. "Amazon data recieved and uploaded to RabbitMQ. Send data to Database: SEND"

# 6 STEP
Press the SEND to save the data to database, this may also take some minutes, after a few, a message that successfully your data
have been saved will be appear.


# Database table in MYSQL:

CREATE TABLE `energy_entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `routing_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `energy_value` int(11) DEFAULT NULL,
  `energy_timestamp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
