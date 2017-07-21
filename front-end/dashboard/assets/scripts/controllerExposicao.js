class ControllerExposicao {
    constructor() {
    }

    gerenciarExposicao() {
        var lista_exposicoes = new Vue({
            el: '#lista_exposicoes',
            data: {
                exposicoes: [{
                    nome: '',
                    titulo: 'Animais Selvagens',
                    local: 'Auditório',
                    data_inicio: '10/09/2017',
                    data_fim: '20/09/2017',
                    descricao: ''
                }, ]
            },
            methods: {
                editar: (idExposicao) => {
                    location.href = "editar-exposicao.html?exposicao=" + idExposicao;
                }
            }
        })
    }

    novaExposicao() {
        var NovaExposicaoPage = new Vue({
            el: '#nova-exposicao',
            data: {

            },
            methods: {

            },
        });
    }


}