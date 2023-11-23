const http = require('http');
const express = require('express');
const mysql = require('mysql2');
const request = require('request');
const urlMidias = 'http://dimdimbet.com/c/whats/images/';
const app = express();

const conn = mysql.createConnection({
  host: 'localhost',
  user: 'admin',
  password: 'dZ3ed6hmdHkFjEjc',
  database: 'admin',
  charset: 'utf8'
});

app.use(express.json());

process.env.TZ = 'America/Sao_Paulo'

/*Recebendo dados pro fluxo*/
app.post('/recebe', (req, res) =>{
  const instancia = req.body.instancia;
  const hash = req.body.hash;
  const cliente = req.body.cliente;
  const nome = req.body.nome;

  console.log("Recebi: "+hash);

  conn.query(`SELECT * FROM chatbot_responde WHERE
   instancia = '${instancia}' AND hash = '${hash}' ORDER BY posicao`, 
   async function(error, results, fields){

     /*Erro*/
    if (error) {
      console.log("Erro:", error);
      res.status(500).send("Erro interno do servidor");
      return;
    }
    /*Loop com os dados*/

    /*Loop com os dados*/
    for(const result of results){
      let tipo = result.tipo;

      if(tipo == 'texto'){
        sendText(result.texto,nome, cliente, result.instancia);
      
      }else if(tipo == 'espera'){
        console.log("Espera de "+result.espera+" segundos");
        await new Promise(resolve => setTimeout(resolve, result.espera * 1000));
      
      }else if(tipo == 'midia'){
        sendMidia(result.texto,nome, result.midia, cliente, result.instancia);
      
      }else if(tipo == 'audio'){
        sendAudio(result.midia, cliente, result.instancia);
     
      }else if(tipo == 'pdf'){
        sendPdf(result.midia, cliente, result.instancia);
      }else if(tipo == 'escrevendo'){
        setStatus(result.espera, 'composing', cliente, result.instancia);
        await new Promise(resolve => setTimeout(resolve, result.espera * 1000));
      }else if(tipo == 'gravando'){
        setStatus(result.espera, 'recording', cliente, result.instancia);
        await new Promise(resolve => setTimeout(resolve, result.espera * 1000));
      }
    }
    /*Loop com os dados*/

    /*Devolvendo resposta de confirmação*/
    res.status(200).send({"error": false, 
                          "message": 'successo',
                          "status_code": 200});
    /*Devolvendo resposta de confirmação*/
  })


})
/*Recebendo dados pro fluxo*/

/*Definindo status*/
function setStatus(tempo, status, cliente, instancia){
  tempo = tempo*1000;
  var options = {
  'method': 'POST',
  'url': 'http://127.0.0.1:3333/message/setstatus?key='+instancia,
  'headers': {
    'Content-Type': 'application/json',
    'Authorization': 'Bearer 123'
  },
  body: JSON.stringify({
    "id": cliente,
    "status": status,
    "msdelay": tempo
  })

};
request(options, function (error, response) {
  if (error) throw new Error(error);
  //console.log(response.body);
});
}
/*Definindo status*/

/*Enviando mensagens*/
function sendText(texto,nome, cliente, instancia){
  //console.log("Para: "+cliente+" instancia: "+instancia);
  texto = texto.replace('{nome}', nome);

  var options = {
  'method': 'POST',
  'url': 'http://127.0.0.1:3333/message/text?key='+instancia,
  'headers': {
    'Authorization': 'Bearer 123',
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    "id": `${cliente}`,
    "message": `${texto}`,
    "mdelay": "0"
  })

};
request(options, function (error, response) {
  if (error) throw new Error(error);
  //console.log(response.body);
  //console.log(`Enviando texto para: ${number}`);
});

}
function sendMidia(texto,nome, midia, cliente, instancia){
  
  texto = texto.replace('{nome}', nome);


  extension = midia.split(".")[1];
  if(extension == 'mp4'){
      complete = 'video/mp4';
  }else{
    complete = `image/png`;
  }
  //console.log(complete);

  var options = {
    'method': 'POST',
    'url': 'http://127.0.0.1:3333/message/image?key='+instancia,
    'headers': {
      'Authorization': 'Bearer 123',
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    form: {
      'id': `${cliente}`,
      'path': urlMidias,
      'file': `${midia}`,
      'caption': `${texto}`,
      'mimetype': complete,
      'msdelay': '0'
    }
  };
  request(options, function (error, response) {
    if (error) throw new Error(error);
    //console.log(`Enviando `);
  });


}
function sendAudio(audio, cliente, instancia){
  //console.log("Para: "+cliente+" instancia: "+instancia+" audio: "+audio);

    var options = {
    'method': 'POST',
    'url': 'http://127.0.0.1:3333/message/audio?key='+instancia,
    'headers': {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Authorization': 'Bearer 123'
    },
    form: {
      'id': cliente,
      'path': urlMidias,
      'file': audio,
      'mimetype': 'audio/mpeg',
      'msdelay': '0'
    }
  };
  request(options, function (error, response) {
    if (error) throw new Error(error);
    //console.log(`Enviando audio para: ${number}`);
  });

}
function sendPdf(file, cliente, instancia){

  //console.log(`enviando: ${file} para: ${cliente}`);
  var options = {
  'method': 'POST',
  'url': 'http://127.0.0.1:3333/message/doc?key='+instancia,
  'headers': {
    'Content-Type': 'application/json',
    'Authorization': 'Bearer 123'
  },
  body: JSON.stringify({
    "id": cliente,
    "path": urlMidias,
    "file": file,
    "mimetype": "application/pdf"
  })

};
request(options, function (error, response) {
  if (error) throw new Error(error);
  //console.log(response.body);
});
}
/*Enviando mensagens*/

/*Inicializando o servidor*/
const server = http.createServer(app);

const port = 4455; //Definindo a porta

server.listen(port, () => {
  console.log(`Servidor rodando na porta ${port}`);
})
/*Inicializando o servidor*/

