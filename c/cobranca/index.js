const cron =  require('node-cron');
const mysql = require('mysql2')
const axios = require('axios');

const db = mysql.createConnection({
    host: 'localhost',
    user: 'admin',
    password: 'dZ3ed6hmdHkFjEjc',
    database: 'admin',
    charset : 'utf8'
});
 
process.env.TZ = 'America/Sao_Paulo'

function ArrayDelayFunc(array, delegate, delay){
    array.forEach(function(el, i){
      setTimeout(function() {
        delegate(array[i]);
      }, i * delay);
    })
  }

cron.schedule('* 8 * * *', function(){
	 /*Data e hora completa*/
                now = new Date();
                dia = now.getDate();

                dia = dia+3;
                if(dia < 10){
                    dia = "0"+dia;
                }

                mes = now.getMonth();
                mes = mes+1;
                if(mes < 10){
                    mes = "0"+mes;
                }

                ano = now.getFullYear();
                hora = now.getHours();
                if(hora < 10){
                    hora = "0"+hora;
                }

                min = now.getMinutes();
                if(min < 10){
                    min = "0"+min;
                }

                hora_completa = hora+":"+min+":00";


                data_pesquisa = ano+"-"+mes+"-"+dia;
                //data_completa = ano+"-"+mes+"-"+dia+" "+hora_completa;
                /*Data e hora completa*/

                console.log("cobrar: "+data_pesquisa);


        let busca = `SELECT * FROM users WHERE expira <= '${data_pesquisa}'`;

        db.query(busca, function(err, result){
            ArrayDelayFunc(result, (d)=> {
                dados = {user: d.id}
                dados = JSON.stringify(dados);
                axios.post('https://app.dimdimbet.com/c/cobranca/criar.php', dados)
                .then(function(response){
                    console.log(response.data);
                })
                .catch(function(error){
                    console.log(error);
                })
            },2000);
        }) 

})

