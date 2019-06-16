
	/*
		Script para creacion de usuarios para logeo en la aplicacion
		para ejecutar el script favor correr el siguiente comando:
						node crear_usuario.js 
	*/

	let mongoose = require('mongoose')

	mongoose.connect('mongodb://localhost/eventos')
		.then(function(db){console.log('Base de datos conectada con exito!!!')})
		.catch(function(err){console.log('Error al conectarse a la BD')})
		
	let usuarioSchema = mongoose.Schema({
		user: String,
		pass: String
	})	
		
	let Login = mongoose.model('Login',usuarioSchema,'logins')
	
	let crearLogin = new Login({user: 'romel', pass: 'romel'})

	crearLogin.save(function(err, login){
		if(err){
			console.log('Error al crear usuario: '+err)
		}
		console.log(login.user + '  salvado a la base de datos!!!!')
	})
	  