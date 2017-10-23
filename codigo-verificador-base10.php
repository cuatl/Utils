<?php
   /*
   * https://tar.mx/archivo/2016/crear-y-validar-numeros-de-longitud-fija-con-algoritmo-de-luhn.html
   * @ToRo 2016
   * https://tar.mx/tema/codigo-de-barras.html
   */
   // genera dígito verificador según Algoritmo de Luhn
   // https://es.wikipedia.org/wiki/Algoritmo_de_Luhn
   function digito($digito) {
      $a=2;
      $sum = [];
      for($i=strlen($digito)-1;$i>=0;$i--) {
         $d =$digito[$i];
         //si es el primero es *2, de lo contrario *1;
         if($a<1) $a=2;
         $sum[] = $d*$a;
         $a--;
      }
      //ahora sumamos
      $total = 0;
      foreach($sum AS $d) {
         if(strlen($d)==1) $total += $d;
         else {
            $da = str_split($d);
            foreach($da AS $one) { $total += $one; }
         }
      }
      $total %= 10;
      if($total != 0) $total = 10-$total;
      return $total;
   }
   // verifica que un número sea válido
   function verifica($numero) {
      $numero_checksum = '';
      foreach (str_split(strrev((string) $numero)) as $i => $d) {
         $numero_checksum .= $i %2 !== 0 ? $d * 2 : $d;
      }
      return array_sum(str_split($numero_checksum)) % 10 === 0;
   }
   //
   //
   $longitud=5;
   $numeros = [1,2,3,435,50230]; // id de mis clientes, podría ser obtenido de una DB
   $prefijo = "01"; //producto 01, se tiene de 1 a 99 tipo de tarjetas o productos
   foreach($numeros AS $k) {
      $numero = $prefijo;
      $numero .= str_pad($k,$longitud,0,STR_PAD_LEFT); // 1 = 000001, etc.
      $digito = digito($numero); //del prefijo + número
      $tarjeta = $numero.$digito;
      echo "Prefijo + ID : $numero, DV: ".$digito.", tarjeta: ".$tarjeta."\n";
   }
   //
   /*
   // ejemplo para generar la tarjeta en código de barras
   $tarjeta = "01000017"; //(si nuestra tarjeta fueran esos 8 códigos)
   $tmpf = "/tmp/".$tarjeta.".ps"; //archivo temporal
   $tmpi = $tarjeta.".png"; //archivo final
   $cmd = "barcode -e 128 -E -b $tarjeta -o $tmpf";
   $cmd = `$cmd`;
   $cmd = "convert -density 300 $tmpf $tmpi";
   $cmd = `$cmd`;
   unlink($tmpf);
   */
   //
   // verificamos el número según el algoritmo de Luhn:
   $tarjeta = "01000017";
   echo "Tarjeta $tarjeta es válida: ";
   echo verifica($tarjeta);
   echo "\n";
