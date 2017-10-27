/*
 * Crear y validar números de longitud fija con algoritmo de Luhn
 * @ToRo 2017
 * https://tar.mx
 * v1.1
 */
import Foundation
//MARK: padding izquierdo
extension String {
    func left(total:Int, cadena: String) -> String {
        let pad = total - self.characters.count;
        return pad < 1 ? self : "".padding(toLength: pad, withPad: cadena, startingAt: 0)+self
    }
}
//MARK: crear dígito
func digito(cadena:String) -> Int {
    var sum = [Int](); var a = 2 ; var total = 0;
    //multiplicamos
    for i in cadena.characters {
        let n = Int(String(i))
        a = (a < 1) ? 2 : a //primer caracter *1, luego *2 y así.
        sum.append(n!*a)    // añadimos al arreglo
        a = a-1
    }
    sum.reverse()
    //print(sum)
    //sumamos
    for numero in sum {
        for chars in String(Int(numero)).characters {
            let suma = Int(String(chars))
            total += suma!
        }
    }
    total %= 10             //base10
    return (total != 0) ? 10-total : total
}
//MARK: ejemplo
let longitud = 5;           //longitud de relleno de cada número
let prefijo  = "01";        //prefijo número
let numeros  = [37,92,10,20,324]; //números de ejemplo
for numero in numeros {
    let original = String(numero)
    let relleno = prefijo + original.left(total: longitud, cadena: "0")
    let digitov = digito(cadena: relleno)   //aquí obtiene el prefijo
    let codigo = relleno + String(Int(digitov))
    print("Final: \(codigo) Inicial: \(original) - Relleno \(relleno) Dígito verificador \(digitov)")
}
//EOF
