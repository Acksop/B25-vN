<?php

define('DEBUG',TRUE);

define('BD_ADRESSE', 'localhost');
define('BD_USER', 'root');
define('BD_PASS', 'password');
define('BD_NOM', 'B25_vN');

// -1:mysql    0:mysqli    1:pear:db  2:pdo
define('BD_TYPE_CONNECTION',-1)
define('ESCAPE_TYPE_CONNECTION',-1);   //    idem

define('BD_DSN',"mysql://root:password@localhost/B25_vN");
define('BD_PDO_DSN',"mysql:host=localhost;dbname=B25_vN");
