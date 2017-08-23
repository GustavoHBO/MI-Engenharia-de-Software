class ControllerExposicao {
    constructor() {
    }

    buscarExposicao() {
        var buscarExposicao = new Vue({
            el: '#buscar_exposicao',
            data: {
                exposicao
            },
            methods: {
                encontrarExposicao: (idExposicao) => {
                    //Chamar aqui o banco de dados
                }
            },
            create: () => {
                //pega lista de exposições
                $.get("http://localhost:8000/api/public/exposicao/listar", data => {
                    lista_exposicoes.exposicoes = data;
                }); 
            }
        });
    }
    listarExposicoes() {
        var listarExposicoes = new Vue({
            el: '#lista-exposicoes',
            data: {
                exposicoes: {},
            },
            methods: {

            },
            created: () => {
                    //pega lista de exposições
                    $.get("http://localhost:8000/api/public/exposicao/listar", data => {
                        listarExposicoes.exposicoes = data;
                    }); 
                
            }
        });
    }
}