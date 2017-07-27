class ControllerExposicao {
    constructor() {
    }

    gerenciarExposicao() {
        var lista_exposicoes = new Vue({
            el: '#lista_exposicoes',
            data: {
                exposicoes: {},
            },
            methods: {
                editar: (idExposicao) => {
                    location.href = "editar-exposicao.html?exposicao=" + idExposicao;
                }
            },
            created: () =>{
                //pega lista de exposições
                $.get("http://localhost:8000/api/public/exposicao/listar", data => {
                    lista_exposicoes.exposicoes = data;
                });
            }
        })
    }

    novaExposicao() {
        var novaExposicao = new Vue({
            el: '#nova-exposicao',
            data: {
                exposicao: { }
            },
            methods: {
                cadastrar: () => {
                    //enquanto n cadastrar itens
                    novaExposicao.exposicao.id_item = {};
                    $.post("http://localhost:8000/api/public/exposicao/cadastrar", novaExposicao.exposicao).
                    done((data) => {
                        location.href = "http://localhost:8000/front-end/dashboard/gerenciar-exposicao.html";
                    }).fail((error) => {
                        console.log(error);
                    });
                },
            },
        });
    }

    editarExposicao(){
       var editarExposicao = new Vue({
        el: '#editar-exposicao',
        data: {
        },
        methods: {

        },
        created: () => {
            let query = location.search.slice(1); //pega a parte depois da ?
            let id = query.split('=')[1]; // pega o id do evento enviado
            console.log(id);
        }
    });
   }


}