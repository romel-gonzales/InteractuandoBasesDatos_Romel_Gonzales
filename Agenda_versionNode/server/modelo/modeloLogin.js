
const mongoose = require('mongoose')
	  Schema = mongoose.Schema;

const LoginSchema = new Schema({
	user: {type: String},
	pass: {type: String}	
}) 

module.exports = mongoose.model('login', LoginSchema)