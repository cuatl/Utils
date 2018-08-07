<?php
   //ya aquí se crea el procedimiento para recibir los archivos, igual que de un formulario.
   // @toro https://tar.mx/
   echo "* datos de post\n";
   foreach($_POST AS $k=>$v) {
      echo "  ".$k.": ".$v."\n";
   }
   echo "\n* datos de archivo recibido\n";
   print_r($_FILES['archivo']);
   //lo siguiente, extrae información IPTC de la imagen.
   if(function_exists('getimagesize')&&function_exists('iptcparse')) {
      echo "\nInformación IPTC:\n";
      if(getimagesize($_FILES['archivo']['tmp_name'],$info)) {
         $info = iptcparse($info["APP13"]);
         //la información está contenida en índices, revisar la especificación IPTC
         //aquí pondré sólo algunos.
         $iptc = [
         '2#110'=>'Autor',
         '2#116'=>'Autor',
         '2#005'=>'Lens ID',
         '2#095'=>'Estado',
         '2#090'=>'Ciudad',
         '2#105'=>'Título',
         '2#025'=>'Palabras',
         '2#120'=>'Descripción',
         ];
         //print_r($info); //muestra toda la información
         $data = [];
         foreach($info AS $k=>$v) {
            foreach($iptc AS $x=>$y) {
               if(isset($iptc[$k])) {
                  $data[$iptc[$k]] = implode(" ",$v);// $v[0];
               }
            }
         }
         print_r($data);
      } else {
         echo "NO PARECE SER IMAGEN (o no existe información IPTC)\n";
      }
   }
