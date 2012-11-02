sed -e"s/db_loc/auth_conf['&']/g" -e"s/db_name/auth_conf['&']/g" -e"s/db_pass/auth_conf['&']/g" -e"s/db_user/auth_conf['&']/g" -i create.php 
