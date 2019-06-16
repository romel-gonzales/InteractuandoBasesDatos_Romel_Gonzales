
const Rutas = require('express').Router(),
	  Login = require('../modelo/modeloLogin')

Rutas.post('/login', function(req, res){
	let usuario = req.body.user
	let clave = req.body.pass
	//console.log('Login, usuario recibido: '+usuario+' clave: '+clave)
	Login.findOne({user: usuario, pass: clave}, function(err, userdb){
			//console.log('pasando login!!!!')
			if(err){
				console.log('error en login')
				res.status(500)
				res.json(err)
			}
			if(userdb){
				console.log('user value: '+userdb)
				req.session.usuario = userdb.user
				console.log('Valores de session: '+JSON.stringify(userdb))							
				res.send("Validado")
			}
			else{
					console.log('no se logro logear')
					res.send("Credenciales de usuario incorrectas!!")
				}
	})	
})

Rutas.get('/isSesionActiva', function(req, res)
{
	if(req.session.usuario){
		res.send('sesionActivada')
	}
	else{
		res.send('sesionNoActivada')
	}	
})


Rutas.get('/cerrarSesion', function(req, res){

	req.session.usuario = false
	req.session.destroy(function(err){
		console.log('session fue destruida??: '+err);
		res.send("logout")
	})
	
})


Rutas.post('/crud', function(req, res){
	var usuario = 'romel'
	var clave = 'romel'
	console.log('crud, usuario recibido: '+usuario+' clave: '+clave)
	Login.insertMany({user: usuario, pass: clave}, function(err, resp){
			if(err){
				console.log('error en crud')
				res.status(500)
				res.json(err)
			}
			if(resp){
				console.log('user value: '+resp)
				res.send("Usuario Creado!!")
			}
			else{
					console.log('no se logro crear user')
					res.send("no se logro crear user!!")
				}
	})	
})

module.exports = Rutas