var pw1 = document.getElementById('pw')
var pw2 = document.getElementById('pw2')
var error = document.getElementById('error')
var form = document.getElementById('formPW')


form.addEventListener('submit', (e) => {

	var aux = pw1.value
	if (!(aux === pw2.value)) {
		e.preventDefault()
		error.innerText = "Las contraseñas no coinciden"
	}



})