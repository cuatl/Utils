#!/usr/bin/php
<style>body{font-size:1.1em;font-family:sans-serif;}table{width:100%;} table th, table td:first-child {background: #f1f1f1;padding:5px 10px;} table td {padding:5px 10px; border-bottom:1px solid #f1f1f1;}.text-right{text-align:right;}</style>
<body>
   <strong>Resultado de las filas seleccionadas</strong>
   <table border="0" cellspacing="0">
      <?php
         /* https://tar.mx/archivo/2017/exportar-a-html-filas-seleccionadas-en-sequel-pro.html */
         $filas = [];
         while (false !== $data = fgetcsv(STDIN, 4096, "\t")) { $filas[] = $data; }
         if(empty($filas)) die("<p>No hay filas seleccionadas u ocurrió un error.</p>");
         $maxlen=8;
         foreach($filas AS $k=>$v) {
            print('<tr>');
            foreach($v AS $a=>$b) {
               $c = $k==0?'h':'d';
               $s = is_float($b)?number_format($b,2):$b;
               $align = preg_match('!\d+(?:\.\d+)?!',$b) ? ' class="text-right"':null;
               printf('<t%s%s>%s</t%s>',$c,$align,$s,$c);
               $maxlen = strlen($s)>$maxlen?strlen($s):$maxlen;
            }
            print('</tr>');
         }
      ?>
   </table>
   <?php
      //print_r($filas);
      if(sizeof($filas) == 2) {
         if($maxlen>20) $maxlen=20;
         echo "<pre>\n";
            foreach($filas[0] AS $k=>$v) {
               printf("%s : %s\n",sprintf("%".$maxlen."s",$v), $filas[1][$k]);
            }
         echo "</pre>";
      }
   ?>
</body>
