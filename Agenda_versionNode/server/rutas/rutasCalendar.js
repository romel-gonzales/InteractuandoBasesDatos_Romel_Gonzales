
const Rutas = require('express').Router(),
	  Evento = require('../modelo/modeloCalendar')	


Rutas.get('/', function(req, res){
	res.send('dentro de rutas!!');
	
})

Rutas.get('/all', function(req, res){
	if(req.session.usuario)	
	{
		Evento.find().exec(function(err, doc){
			if(err) {
				resp.status(500);
				res.json(err);
			}
			//console.log('Listando todos los eventos: '+doc)
			res.json(doc);	
		})
	}
	else{
		console.log('Hacer inicio de sesion primero!!!!')
		res.send('sesionNoActivada') 
	}
})

Rutas.post('/new', function(req, res){
	//console.log('/new, datos recibido de formulario: '+JSON.stringify(req.body));
	if(req.session.usuario)	
	{	
		const eventos = new Evento(req.body)
		console.log('schema a insertar a DB: '+eventos);
		eventos.save(function(err){
			if(err){
				console.log(err)
				res.json(err)
			}
		})
	}
	else{ 
		console.log('Hacer inicio de sesion primero!!!!')
		res.send('sesionNoActivada') 
				
	}
})

Rutas.post('/update', function(req, res){
	
	console.log('update a insertar a DB: '+JSON.stringify(req.body));	
	if(req.session.usuario)	
	{	
		Evento.findOne({_id: req.body.id}).exec(function(err, result){
			let id = req.body.id,
				start = req.body.start,
				end = req.body.end
			if(err){
				console.log('error al encontrar registro a update: '+err)
			}
			else{
				Evento.update({_id: id}, {start: start, end: end}, function(error, result){
					if(error){
						console.log('error al hacer update a db: '+err)
					}
					else{
						console.log('se logro hacer update a db')
						res.send("registro actualizado!!!")
					}	
				})				
			}				
		})
	}		
	else{
		console.log('Hacer inicio de sesion primero!!!!')
		res.send('sesionNoActivada') 
	}	
})


Rutas.post('/delete/:_id', function(req, res){
	var id = req.params._id
	console.log('id elemento a eliminar: '+id)
	Evento.remove({_id: id}, function(err){
		if(err){
			console.log(err)
			res.status(500)
			res.json(err)
		}
		res.send("evento ha sido eliminado!!!")
	})
	
})

module.exports = Rutas