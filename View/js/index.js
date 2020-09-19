// alert('index js');
$(document).ready(() => {
	// alert('en jq');
	const registerForm = $('#registerForm');
	const buttonRegisterForm = $('#sendDataRegister');
	buttonRegisterForm.click(function (e) {
		e.preventDefault();
		// alert('register save');
		let name = $('#newName').val();
		let lastName = $('#newLastName').val();
		let photo = $('#newPhoto').val();
		let email = $('#newEmail').val();
		let password = $('#newPassword').val();
		let objectForm = {
			name: name,
			lastName: lastName,
			photo: photo,
			email: email,
			password: password,
		};
		console.log(objectForm);
		let form = new FormData(document.getElementById('registerForm'));
		console.log(form.get('nombre'));
		console.log(form.get('apellido'));
		console.log(form.get('foto'));
		console.log(form.get('mail'));
		console.log(form.get('contrasena'));

		let url = 'Controlerc_index.php';
		fetch(url, {
			method: 'post',
			body: form,
		})
			.then((response) => response.json())
			.then((data) => {
				console.log(data);
			});
	});
});
