<?php
   //ya aquí se crea el procedimiento para recibir los archivos, igual que de un formulario.
   echo "* datos de post\n";
   foreach($_POST AS $k=>$v) {
      echo "  ".$k.": ".$v."\n";
   }
   echo "\n* datos de archivo recibido\n";
   print_r($_FILES['archivo']);
