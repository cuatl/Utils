/*
 * Generar código verificador
 * @ToRo 2017
 * https://tar.mx/archivo/2016/crear-y-validar-numeros-de-longitud-fija-con-algoritmo-de-luhn.html
 */
import Foundation
/* padding a la izquierda */
extension String {
    func padleft(total:Int,cad :String) -> String {
        let pad = total - self.characters.count;
        if(pad < 1) { return self; }
        else { return "".stringByPaddingToLength(pad, withString: cad, startingAtIndex: 0)+self }
    }
}
func digito(cadena:String) -> Int {
    var ncadena = Array(cadena.characters)  //convertimos a un arreglo
    var sum = [Int](); var a = 2;           //variables iniciales
    //multiplicamos
    for i in 0...cadena.characters.count-1 {
        let d = ncadena[i]
        let n = Int(String(d))
        if(a < 1) { a = 2 } // primer caracter *1, luego *2, etc.
        sum.append(n!*a)    // añadimos a arreglo
        a = a-1;            //
    }
    sum = sum.reverse()
    //sumamos
    var total=0;
    for d in sum {
        let ni = String(Int(d))
        if(ni.characters.count == 1) { total += d }
        else {
            let da = Array(ni.characters) //es más de un dígito
            for nd in da {
                let suma = Int(String(nd))
                total += suma!;
            }
        }
    }
    total %= 10             //base 10
    return (total != 0) ? 10-total :  total
}

//
let longitud = 5;           //longitud cadena
let prefijo = "01";         //prefijo
var numeros = [92,10,20];   //números de prueba
for numero in numeros {
    var original = String(numero)
    var relleno = prefijo + original.padleft(longitud, cad: "0")
    var digitov = digito(relleno)
    var codigo = relleno + String(Int(digitov))
    print("Inicial: \(original) - Relleno: \(relleno) - Dígito: \(digitov) - Código: \(codigo)")
}
