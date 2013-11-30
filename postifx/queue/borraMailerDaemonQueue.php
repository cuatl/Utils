<?php
/*
* elimina cola de mensajes que no se pueden entregar en servidor remoto
* Jorge M. http://tar.mx
*/
$server="root@127.0.0.1";
$path ="ssh ".$server;
$cmd = $path." postqueue -p";
$cmd = explode("\n",`$cmd`);
if(!empty($cmd)) {
   foreach($cmd AS $k) {
      if(preg_match("/MAILER\-DAEMON/i",$k)) {
         $v=  explode(" ",$k);
         $ncmd = $path." postsuper -d ".$v[0];
         $ncmd = `$ncmd`;
      }
   }
}
?>
