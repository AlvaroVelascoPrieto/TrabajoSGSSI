var NombreAp = document.getElementById("NombreAp")
var NombreApError = document.getElementById('NombreApError')
var DNI = document.getElementById('DNI')
var DNIerror = document.getElementById('DNIerror')
var telf = document.getElementById('telefono')
var telfError = document.getElementById('telfError')
var fechaN = document.getElementById('fechaN')
var email = document.getElementById('email')
var emailError = document.getElementById('emailError')
var password = document.getElementById('pw')
var password2 = document.getElementById('pw2')
var passwordError = document.getElementById('pwError')
var formNombre = document.getElementById("ModificarNombre")
var formDNI = document.getElementById("ModificarDNI")
var formTelf = document.getElementById("ModificarTelf")
var formEmail = document.getElementById("ModificarEmail")
var formPw = document.getElementById("ModificarPw")

//Se realizan las mismas comprobaciones que en comprobar.js, pero esta vez se hace con un formulario por
//campo, para poder cambiarlos independientemente y que el boton con método 'submit' no envíe todos los datos
//a la vez (incluso los campos que no se hayan cambiado)


formNombre.addEventListener('submit', (e) => {
    var aux = NombreAp.value
    for (var i = 0; i < aux.length; i++) {
        if (aux[i] < '9' && aux[i] > '0' || NombreAp.value == '') {
            e.preventDefault()
            NombreApError.innerText = "Por favor, introduzca un nombre válido"
        } 
    }
})
formDNI.addEventListener('submit', (e) => {
    var dni = DNI.value
    var numero
    var letr
    var letra
    var expresion_regular_dni
     
      expresion_regular_dni = /^\d{8}[a-zA-Z]$/;
     
      if(expresion_regular_dni.test (dni) == true){
         numero = dni.substr(0,dni.length-1);
         letr = dni.substr(dni.length-1,1);
         numero = numero % 23;
         letra='TRWAGMYFPDXBNJZSQVHLCKET';
         letra=letra.substring(numero,numero+1);
        if (letra!=letr.toUpperCase()) {
            e.preventDefault()
            DNIerror.innerText = 'Dni erroneo, la letra del NIF no se corresponde'
        }
        }else{
            e.preventDefault()
            DNIerror.innerText = 'Dni erroneo, formato no válido'
        }
})
formTelf.addEventListener('submit', (e) => {
    aux = telf.value
    if (aux < 600000000 || aux > 999999999) {
        e.preventDefault()
        telfError.innerText = "Por favor, introduzca un número de teléfono válido"
    }
})
formEmail.addEventListener('submit', (e) => {
    aux = email.value
    var valido = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
    if (!aux.match(valido)) {
        e.preventDefault()
        emailError.innerText = "Por favor, introduzca un e-mail válido"
    }
})
    
formPw.addEventListener('submit', (e) => {
    var pass1 = pw.value
    var pass2 = pw2.value
    if (!(pass1 === pass2)) {
        e.preventDefault()
        passwordError.innerText = "Las contraseñas no coinciden"
    }
})