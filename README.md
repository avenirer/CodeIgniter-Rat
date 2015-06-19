# CodeIgniter Rat

CodeIgniter Rat is a library that allows you to log whatever you want in a database table.

## Installing

1. Copy the files inside the corresponding CI application directories.
2. Create a table inside your database with the following SQL:
```mysql
DROP TABLE IF EXISTS `rat`;
CREATE TABLE `rat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
3. Configure the library from the config/rat.php:
i. `$config['store_in'] = 'database';` - !FOR THE MOMENT ONLY WORKS WITH DATABASE so leave this part untouched!
ii. `$config['session_user_id'] = 'user_id';` - If you want to pass the user's ID automatically to the library when creating the log, you can setup a session value and pass it to this config item. If not, leave blank.
iii. `$config['table_name'] = '';` - If you wanted to be original and prefered another table name, you must change it here. Leave blank if the table name is 'rat'

4. Use it...

## Usage
