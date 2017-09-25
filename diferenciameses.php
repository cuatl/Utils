<?php
   /* 
   * calcula meses absolutos ??? entre dos fechas 
   * @toro 2017 https://tar.mx/
   */
   //fechas random (inicio, fin)
   for($i=1;$i<=20;$i++) {
      $f1 = date('Y-m-d',strtotime('-'.rand(0,30).' month'));
      $f2 = date('Y-m-d',strtotime('+'.rand(0,3).' month'));
      printf("meses: %2d ini: %s fin: %s\n",mesesd($f1,$f2),$f1,$f2);
   }
   /* mesesd(fecha inicial, fecha final) {{{ */
   function mesesd($f1, $f2) {
      $ff1=strtotime($f1); $ff2=strtotime($f2);
      if(date('Ym',$ff1) == date('Ym',$ff2)) return 0; //mismo mes
      elseif(date('Y',$ff1) == date('Y',$ff2)) { return date('n',$ff2) - date('n',$ff1); } //mismo año
      else { //otros años
         $anos=[];
         for($i=date('Y',$ff1);$i<=date('Y',$ff2);$i++) { $anos[$i]=$i; }
         $fa = array_shift($anos);//año inicial
         $ff = array_pop($anos); //año final
         $restante = (sizeof($anos)>0)? sizeof($anos)*12 : 0;
         return (12-date('n',$ff1) + date('n',$ff2)) + $restante;
      }
   } /* }}} */
