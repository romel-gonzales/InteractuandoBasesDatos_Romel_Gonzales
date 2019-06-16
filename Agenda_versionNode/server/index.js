

		// Carga de modulos
const http = require('http'),
	  express = require('express'),
	  session = require('express-session'),
	  bodyParser = require('body-parser'),  
	  path = require('path'),
	  morgan = require('morgan'),
	  app = express();

	 // carga modulos de Base de Datos
const mongoose = require('mongoose');
	//Abrir conexion a DB
	mongoose.connect('mongodb://localhost/eventos')
		.then(function(db){console.log('Base de datos conectada con exito!!!')})
		.catch(function(err){console.log('Error al conectarse a la BD')})
	
	// carga rutas
const rutasCalendar = require('./rutas/rutasCalendar')	
const rutasLogin = require('./rutas/rutasLogin')

const Servidor = http.createServer(app)

	app.engine('html', require('ejs').renderFile)
	app.set('port', process.env.PORT || 3000)
	app.use(express.static('client'))
	app.use(bodyParser.json())
	app.use(bodyParser.urlencoded({extended: true}))
	app.use(session({
		secret: 'clave-manejo-session',
		saveUninitialized: false,
		resave: false
	}))
	app.use('/events', rutasCalendar)
	app.use('/', rutasLogin)
	app.use(morgan('dev'))
	
	
	//Abrir puerto de Red de escucha
	Servidor.listen(app.get('port'), function(){console.log('Servidor iniciado!!!')})