var mysql = require('mysql');

exports.UMG_AI_Webhook = function WebhookHttp (req, res) { 
  var connection = mysql.createConnection({
            host: "104.198.194.168",
            user: "root",
            password: "pass@umg",
            database: "umg_ai"
        });
	
	connection.connect();
	var body = req['body'];  
	var sessionId = req.body['sessionId'];  
	var messageId = req.body['id'];  
	var timestamp = req.body['timestamp'];  
	var intentName = req.body.result.metadata['intentName'];  
	var action = req.body.result['action'];  
	var resolvedQuery = req.body.result['resolvedQuery'];  
	var source = req.body.result['source'];  
	var fulfillment = req.body.result.fulfillment['speech'];  
	var actionIncomplete = req.body.result['actionIncomplete'];  
	var precio = false;	

	console.log("Hola soy un Log"+sessionId);	
	console.log("Hola soy un Log"+resolvedQuery);	
	console.log(body);
	//console.log("originalRequest"+req.body['originalRequest']);
	//console.log("data"+req.body.originalRequest['data']);	
	//console.log("sender"+req.body.originalRequest.data['sender']);	
	//console.log("recipient"+req.body.originalRequest.data['recipient']);	
	//console.log("message"+req.body.originalRequest.data['message']);

	//console.log("contexts"+req.body.result['contexts']);


	console.log("FIN DE BODY");

	if (intentName!="Default Fallback Intent" || intentName!="Default Welcome Intent")
	{

	}

	/*
	if(!actionIncomplete)
	{
		switch (action) {		
			case 'obtenerPrecio':			
				precio = true;
				response = obtenerPrecio(req);				
				res.setHeader('Content-Type', 'application/json');				
				console.log("ANTES DE ENVIAR HeroWebhook");    					
			  	res.send(JSON.stringify({ "speech": response, "displayText": response
			  	})); 
			  	console.log("EJECUCION actualizarBD");    					
				actualizarBD(connection, sessionId, response, resolvedQuery, source, messageId, intentName, timestamp);
				console.log("FINALIZACION actualizarBD");    					
				break;			
			default:
				//res.status(404).end();
				break;
		} 	
	}*/
	
	if(precio==false)
	{
		response = fulfillment;	
		res.setHeader('Content-Type', 'application/json');	
		console.log("ANTES DE ENVIAR UMG_AI_Webhook");    					
		res.send(JSON.stringify({ "speech": response, "displayText": response}));
		console.log("EJECUCION actualizarBD");    					
		actualizarBD(connection, sessionId, response, resolvedQuery, source, messageId, intentName, timestamp);
		console.log("FINALIZACION actualizarBD");    					
	}	
};

function actualizarBD(connection, sessionId, response, resolvedQuery, source, messageId, intentName, timestamp)
{
	connection.query('SELECT EXISTS(SELECT 1 FROM conversations WHERE sessionId=\"'+sessionId+'\") AS EXISTE', function(error, results, fields) {
    	if (error) console.log(error); 
    	else 
    		{
    			console.log("CONSULTA EXITOSA");    					
    			console.log(results);
    			if (results[0].EXISTE==0) 
    			{
    				console.log("INSERTAR CONVERSACION");    	
					insertarConversacion(connection, sessionId, response, resolvedQuery, source, messageId, intentName, timestamp);
    			}
    			else if (results[0].EXISTE==1) 
    			{
					console.log("OBTIENE ID DE CONVERSACION");    	
					obtenerIDConversacion(connection, sessionId, response, resolvedQuery, source, messageId, intentName, timestamp);
    			}
    		}
	});
}

function obtenerIDConversacion(connection, sessionId, response, resolvedQuery, source, messageId, intentName, timestamp)
{
	console.log("LLEGO ACA"+sessionId);    		
	connection.query('SELECT id FROM conversations WHERE sessionId=\"'+sessionId+'\"', function(error, results, fields) {
	if (error) console.log(error); 
		else 
		{
			console.log("INSERTAR MENSAJE EXITOSA");    					
			console.log(results);
			insertarMensajeUser(connection, results[0].id, response, resolvedQuery, source, messageId, intentName, timestamp);
		}
	});	

}

function insertarMensajeUser(connection, id, response, resolvedQuery, source, messageId, intentName, timestamp)
{
	console.log("LLEGO ACA"+id);    	
	var values = {id: null, id_conversation: id, resolvedQuery:resolvedQuery, intentName:intentName, id_message:messageId, source:source, timestamp:new Date(timestamp)};
	connection.query('INSERT INTO conversations_detail SET ?', values, function(error, results, fields) {
	if (error) console.log(error); 
		else 
		{
			console.log("INGRESO MENSAJE EXITOSO");		
			insertarMensajeBot(connection, id, response, messageId, intentName);
		}
	});		
}

function insertarMensajeBot(connection, id, response, messageId, intentName)
{
	console.log("LLEGO ACA"+id);    	
	var values = {id: null, id_conversation: id, resolvedQuery:response, intentName:intentName, id_message: messageId, source:"API.AI", timestamp:new Date()};	
	connection.query('INSERT INTO conversations_detail SET ?', values, function(error, results, fields) {
	if (error) console.log(error); 
		else 
		{
			console.log("INGRESO MENSAJE EXITOSO");				
		}
	});	
	connection.end();
}


function insertarConversacion(connection, sessionId, response, resolvedQuery, source, messageId, intentName, timestamp)
{
	console.log("LLEGO ACA"+sessionId);    	
	var values = {id: null, sessionId: sessionId, channel:source };
	connection.query('INSERT INTO conversations SET ?', values, function(error, results, fields) {
	if (error) console.log(error); 
		else 
		{
			console.log("INGRESO CONVERSACION EXITOSO");	
			obtenerIDConversacion(connection, sessionId, response, resolvedQuery, source, messageId, intentName, timestamp);
		}
	});	
}
/*
function obtenerPrecio(req, res)
{
  var modelo = req.body.result.parameters['modelos'];  
  switch (modelo) {
		case 'Dash':					
			response = respuesta_random("Q.9,500.00", "Dash");
			break;

		case 'Dawn 125':
			response = respuesta_random("Q.7,800.00", "Dawn 125");
			break;

		case 'Glamour':			
			response = respuesta_random("Q.10,000.00", "Glamour");
			break;

		case 'Hunk i3s':			
			response = respuesta_random("Q.13,000.00", "Hunk i3s");
			break;	
		
		case 'Dawn 150':			
			response = respuesta_random("Q.9,000.00", "Dawn 150");
			break;
		default:
			response = "Lo lamento, no tengo el precio la "+ action+" en este momento.";
			break;
	}
	return response;	
}
function respuesta_random(precio, modelo)
{
	switch (Math.floor((Math.random()*10)+1)) {
		case 1:
			respuesta = "El precio de la " + modelo + " es "+ precio;
			break;
		case 2:
			respuesta = "El precio de este modelo es " + precio;
			break;
		case 3:
			respuesta = precio + " es el precio de la " + modelo;
			break;
		case 4:
			respuesta = "El costo de esta motocileta es " + precio ;
			break;
		case 5:
			respuesta = "Esta motocileta tiene un valor de " + precio;
			break;
		case 6:
			respuesta = "El precio de venta es " + precio;
			break;
		case 7:
			respuesta = "El valor de la motocileta es " + precio;
			break;
		case 8:
			respuesta = "Puedes adquirir esta motocileta por " + precio;
			break;
		case 9:
			respuesta = "La motocileta tiene un precio de " + precio;
			break;
		case 10:
			respuesta = "La " + modelo + " tiene un precio de " + precio;
			break;
		}
		return respuesta;
}*/