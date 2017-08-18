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

    item() {
        var item = new Vue({
            el: '#item',
            data: {
                favorito:  false
            },
            methods: {
                cliquei: () => {
                    if(this.favorito){
                        $(".star.glyphicon").click(function() {
                            $(this).toggleClass("glyphicon-star-empty");
                        });
                    } else{
                        $(".star.glyphicon").click(function() {
                            $(this).toggleClass("glyphicon-star");
                        });
                    }
                    this.favorito = !this.favorito;
                }
            }
        });
    }
}