document.getElementsByName('btn')[0].addEventListener('click',ValidarCampos)
document.getElementsByName('btn')[1].addEventListener('click',ValidarCampos)
console.log('java');

let fecha1= new Date(document.getElementById('fecha').value);
let fecha2= new Date();
var dd = fecha2.getDate();
var mm = fecha2.getMonth()+1;
var yyyy = fecha2.getFullYear();
fecha2 = mm+'/'+dd+'/'+yyyy;




function ValidarCampos(){
    console.log('entro')

    //var valor1= document.getElementsByClassName('form-control').value;
    var i=0;
    while(document.getElementsByClassName('form-control')[i]!=null){
        if(document.getElementsByClassName('form-control')[i].value==''){
            alert("Rellene el campo "+[i]);
            document.getElementsByName('btn')[0].value = 'nada';   
                }
        i++;
    }

}


function ValidarFecha(){
    console.log("Si entro")
    if(fecha1.getTime()< fecha2){
        alert('Ingrese una fecha valida');
    }
}
console.log(fecha1+ "fecha 2: "+fecha2);