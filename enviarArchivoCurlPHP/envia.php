<?php
   /*
   * envía archivo (imagen) a formulario WWW en PHP desde línea de comandos
   * @ToRo https://tar.mx 
   */
   $url = "https://tar.mx/apps/testupload/"; //url que recibe el archivo
   $file = "test.jpg"; //archivo a enviar, o se puede utilizar: envia.php archivo.jpg
   $name = "descripción del archivo a enviar";
   //if(!empty($argv[1]) && is_file(escapeshellcmd($argv[1]))) $file = $argv[1]; //sin restricción de tipo
   if(!empty($argv[1]) && preg_match("/\.(jpg|png)$/",$argv[1])) $file = $argv[1];
   if(!is_file($file)) die("No existe el archivo $file\n\n");
   echo "Subiendo archivo $file...\n";
   $ch = curl_init();
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_POST,1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_URL, $url);
   //datos a enviar
   $datos= [
   "titulo"  => $name,
   //"otrodato" => "valor",
   "archivo" => curl_file_create($file),
   ];
   curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
   $res = curl_exec($ch);
   //
   echo "RESPUESTA DEL SERVIDOR:\n\n";
   print_r($res);
   curl_close ($ch);
