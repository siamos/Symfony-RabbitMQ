# net2grid
Symfony, RabbitMQ, Doctrine, data consume and save to database

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
Press the send to save the data to database, this may also take some minutes, after a few, a message that have successfully your data
have been saved will be appear.
