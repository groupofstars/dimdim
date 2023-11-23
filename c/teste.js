     /*Aviso de expiração*/
          if(t.plano == 0){

            if(t.expira > 0){
                $.alert({
                  theme: 'dark',
                  title: 'Plano de Teste',
                  content: `Olá, você só tem mais ${t.expira} dias para testes\n
                  adquira seu plano para continuar usando`,
                  buttons: {
                    PLANOS: function(){
                      $("#pages").load("payment.html");
                    },
                    OK: {
                      
                    }
                  }
                })
            }else{
               $.alert({
                theme:'dark',
                title:'Conta Suspensa',
                content: `Seu tempo de testes acabaram, adquira um plano para prosseguir`,
                buttons: {
                  PLANOS: function(){
                    $("#pages").load("payment.html");
                  },
                  FECHAR: {

                  }
                }
              })


              /*Bloqueando opções*/
              $("ul[role='menu']").html(""); 
              $("ul[role='menu']").html(`<li class="nav-item clique" onclick="pay()">
                                      <a class="nav-link clique">
                                       <i class="nav-icon fas fa-comments-dollar"></i>
                                        <p>
                                        Créditos 
                                        </p>
                                      </a>
                                    </li>`);
              /*Bloqueando opções*/
            }
          }else if(t.plano > 0 && t.expira != '++'){

            if(t.expira > 0){
              $.alert({
                theme:'dark',
                title:'Aviso de Pagamento',
                content: `Faltam ${t.expira} dias pro pagamento expirar`,
               
                buttons:{
                  RENOVAR: function(){
                     $("#pages").load("payment.html");
                   },
                   OK: {

                   }
                }
              })
            }else{
              $.alert({
                theme:'dark',
                title:'Conta Suspensa',
                content: `Sua conta está bloqueada, devido a falta de pagamento da Mensalidade`,
                buttons: {
                  RENOVAR: function(){
                    $("#pages").load("payment.html");
                  },
                  FECHAR: {

                  }
                }
              })


              /*Bloqueando opções*/
              $("ul[role='menu']").html(""); 
              $("ul[role='menu']").html(`<li class="nav-item clique" onclick="pay()">
                                      <a class="nav-link clique">
                                       <i class="nav-icon fas fa-comments-dollar"></i>
                                        <p>
                                        Créditos 
                                        </p>
                                      </a>
                                    </li>`);
              /*Bloqueando opções*/
            }
            
          }
          /*Aviso de expiração*/
          $("#nome").html(t.nome);
        })