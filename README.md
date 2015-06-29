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
  1. `$config['store_in'] = 'database';` - !FOR THE MOMENT ONLY WORKS WITH DATABASE so leave this part untouched!
  2. `$config['session_user_id'] = 'user_id';` - If you want to pass the user's ID automatically to the library when creating the log, you can setup a session value and pass it to this config item. If not, leave blank.
  3. `$config['table_name'] = '';` - If you wanted to be original and prefered another table name, you must change it here. Leave blank if the table name is 'rat'

4. Use it...

## Usage

You can either autoload the library (I don't advise you to do that), or load the library where you want to use it:
```php
$this->load->library('rat');
```

### log($message, $user_id = '0', $code = '0')

The log() method allows you to write the log. You must pass it the `$message` you want to write. If you didn't set the `$config['session_user_id']`, you can also pass it a user ID. For your convenience, you also can pass a code of the message; who knows, maybe you want to have different colors on the messages when you output the logs. You can do that by passing a code to the message you write.

### get_log($user_id = NULL, $code = NULL, $date = NULL, $order_by = NULL, $limit = NULL)

The get_log() method allows you to retrieve the logs of a/many user/s...

### delete_log($user_id = NULL, $date = NULL)

The delete_log() method allows you do delete the (user) logs regarding of a date in time...
