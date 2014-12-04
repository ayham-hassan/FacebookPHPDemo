<?php
###############################################
#### facebook application configurations  #####
###############################################

# replace $appId, $appSecret values with socialtag app values founded in facebook.com
$appId = '307710499430417'; 
$appSecret = '466f486ba9d44012227af685cdcfc178'; 

# default return url for socialtag app when doing something in server, such as success login to facebook, logout,.....
$return_url = 'http://localhost/sociatag/';

# permissions to be used in facebook
$permissions = array(
  'email',
  'user_about_me',
  'user_education_history',
  'user_interests',
  'user_likes',
  'user_photos',
  'user_friends ',
  'user_videos',
  'read_friendlists',
  'read_stream',
  'manage_notifications',
  'manage_friendlists'
);

###############################################
#### end of facebook application configurations  #####
###############################################

###############################################
#### database configurations  #################
###############################################

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');    // DB username
define('DB_PASSWORD', 'root');    // DB password
define('DB_DATABASE', 'sociatag');      // DB name
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die( "Unable to connect");
$database = mysqli_select_db($connection,DB_DATABASE) or die( "Unable to select database");

###############################################
#### end of database configurations  ##########
###############################################

?>