<?php
$link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147szheng0', 'kanahjoh');
mysql_select_db('c_cs147_szheng0');


require_once('helper_fns.php'); //load up file with helper fns

 session_save_path('Session/'); 

?>