const cron = require('node-cron');
const mysql = require('mysql2');
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





cron.schedule('*/10 * * * * *', function(){
   

     /*Data e hora completa*/
                now = new Date();
                dia = now.getDate();
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

                data_completa = ano+"-"+mes+"-"+dia+" "+hora_completa;
                /*Data e hora completa*/

    console.log("data complata: "+hora_completa);
    let sql = `SELECT * FROM listas_noticia WHERE status = '0' AND data <= '${data_completa}'`;
    let agora = new Date().getTime();

    db.query(sql, function(err, result){
        
        result.forEach(async d => {
            const minha_data = new Date(d.data);
            const nova_data = minha_data.getTime();
            const id_lista = d.id; 

             console.log(`executando lista: ${id_lista} horario: ${data_completa}`);
            if(agora >= nova_data){

                /*Hash de identificação do grupo*/
                grupo = d.grupo
                //console.log(`caption:${d.caption} grupo: ${d.grupo}`);
                
                /*Buscando contatos*/
                    let contatos = `SELECT * FROM leads_noticia WHERE grupo = '${grupo}'`;
                    db.query(contatos, function (err, result){
                    
                        ArrayDelayFunc(result,(t)=>{
                            dados = `cliente=${t.id_contato}&lista=${id_lista}`;
                            console.log(dados);
                            axios.post('http://dimdimbet.com/c/whats/noticias/enviar.php', dados)
                            .then(function (response){
                                console.log(response.data);
                            })
                            .catch(function (error){
                                console.log(error);
                            })
                            //console.log("N > "+t.id_contato);
                        },30000);
                    })
                /*Buscando contatos*/

                db.query(`UPDATE listas_noticia SET status = '1' WHERE id = '${id_lista}'`)
            }
        })

    }) 

})