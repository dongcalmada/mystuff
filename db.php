<?php
   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('stuff.db');
      }
   }
   $db = new MyDB();
   if(!$db) {
      die($db->lastErrorMsg());
   }
?>

