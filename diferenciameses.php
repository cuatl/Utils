<?php
   /* número de meses entre dos fechas @ToRo https://tar.mx */
   $fechas = [];
   //generamos algunas fechas al azar
   for($i=1;$i<=3;$i++) {
      $fechas[] = [
      date('Y-m-d',strtotime('-'.rand(0,10).' month -'.rand(1,30).' day')),
      date('Y-m-d',strtotime('+'.rand(0,3).' month + '.rand(1,30).' day'))
      ];
   }
   echo "Diferencia absoluta:\n"; //diferencia absoluta (total de meses calculados)
   foreach($fechas AS $k) {
      $f1= new DateTime($k[0]);
      $f2= new DateTime($k[1]);
      $meses = $f2->diff($f1);
      $diff =  ($meses->y>0)?$meses->y*12:0;
      printf("%s a %s -- %s meses %d días\n",$k[0], $k[1], $meses->m+$diff, $meses->d);
   }
   echo "\nDiferencia relativa:\n"; //diferencia relativa (meses "pasados")
   foreach($fechas AS $k) {
      printf("%s a %s -- %s meses\n",$k[0],$k[1],mesesd($k[0], $k[1]));
   }
   /* mesesd(fecha inicial, fecha final) {{{ */
   function mesesd($f1, $f2) {
      $ff1=strtotime($f1); $ff2=strtotime($f2);
      if(date('Ym',$ff1) == date('Ym',$ff2)) return 0; //mismo mes
      elseif(date('Y',$ff1) == date('Y',$ff2)) { return date('n',$ff2) - date('n',$ff1); } //mismo año
      else {
         //otros años
         $anos=[];
         for($i=date('Y',$ff1);$i<=date('Y',$ff2);$i++) { $anos[$i]=$i; }
         $fa = array_shift($anos);//año inicial
         $ff = array_pop($anos); //año final
         $restante = (sizeof($anos)>0)? sizeof($anos)*12 : 0;
         return (12-date('n',$ff1) + date('n',$ff2)) + $restante;
      }
   } /* }}} */
