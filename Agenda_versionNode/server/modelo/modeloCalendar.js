
const mongoose = require('mongoose')
	  Schema = mongoose.Schema;

const EventoSchema = new Schema({
	title: {type: String},
	start: {type: String},
	end: {type: String}
})	

module.exports = mongoose.model('eventos', EventoSchema) 
