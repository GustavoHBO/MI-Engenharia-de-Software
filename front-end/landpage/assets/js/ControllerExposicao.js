class ControllerExposicao {
    constructor() {
    }

    buscarExposicao() {
        var buscarExposicao = new Vue({
            el: '#buscar_exposicao',
            data: {
                exposicao: [{
                    id: 1,
                    titulo: 'Exposição de Obras',
                    categoria: 'Exibição Temporária',
                    data_inicio: '25/04/2017',
                    data_fim: '05/05/2017',
                    descricao: 'Exposição de obras sobre a cultura brasileira do século 20',
                    imagem: "http://placehold.it/400x300",
                    itens: [{id: 1,
                        nome: 'Calça de couro',
                        autor: 'Carlos Manoel',
                        image: 'http://placehold.it/400x300',
                        descricao: 'Calça de couro de cavalo de 1941'
                    }]
                }]
            },
            methods: {
                encontrarExposicao: (idExposicao) => {
                    //Chamar aqui o banco de dados
                }
            }
        });
    }
    listarExposicoes() {
        var listarExposicoes = new Vue({
            el: '#lista-exposicoes',
            data: {
                exposicao_principal: {
                    id: 1,
                    titulo: 'Exposição de Obras',
                    categoria: 'Exibição Temporária',
                    data_inicio: '25/04/2017',
                    data_fim: '05/05/2017',
                    descricao: 'Exposição de obras sobre a cultura brasileira do século 20',
                    imagem: "http://placehold.it/400x300",
                    itens: [{id: 1,
                        nome: 'Calça de couro',
                        autor: 'Carlos Manoel',
                        image: 'http://placehold.it/400x300',
                        descricao: 'Calça de couro de cavalo de 1941'
                    }]
                },
                exposicoes: [{
                    id: 1,
                    titulo: 'Exposição de Obras',
                    categoria: 'Exibição Temporária',
                    data_inicio: '25/04/2017',
                    data_fim: '05/05/2017',
                    descricao: 'Exposição de obras sobre a cultura brasileira do século 20',
                    imagem: "http://placehold.it/400x300",
                    itens: [{id: 1,
                        nome: 'Calça de couro',
                        autor: 'Carlos Manoel',
                        image: 'http://placehold.it/400x300',
                        descricao: 'Calça de couro de cavalo de 1941'
                    }]
                },{
                    id: 1,
                    titulo: 'Exposição de Obras',
                    categoria: 'Exibição Temporária',
                    data_inicio: '25/04/2017',
                    data_fim: '05/05/2017',
                    descricao: 'Exposição de obras sobre a cultura brasileira do século 20',
                    imagem: "http://placehold.it/400x300",
                    itens: [{id: 1,
                        nome: 'Calça de couro',
                        autor: 'Carlos Manoel',
                        image: 'http://placehold.it/400x300',
                        descricao: 'Calça de couro de cavalo de 1941'
                    }]
                }]
            },
            created: () => {

                //Depois que pegar a lista de itens, separar a manchete principal, que no caso será o primeiro da lista.
                
            }
        });
    }
}