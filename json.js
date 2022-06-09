//js que importa el contenido de json y lo transorma en array para su uso en los gráficos.
import data from './grafico2.json' assert {type: 'json'};
export var colores = [];
export var valores =[];
for (var i in data){
    colores.push(i)
    valores.push(data[i].count)
}

console.log(i)
console.log(valores)

function sumar(){
    console.log(data.Pizza.count);
    for (var i in data){
        if (i == "Pizza"){
            var index =colores.indexOf("Pizza")
            data.Pizza.count +=1
            console.log(data.Pizza.count)
            valores[index] = data.Pizza.count 
        }
    }
}

let btn = document.getElementById("prueba");
btn.addEventListener('click', event => {
    sumar();
  });


