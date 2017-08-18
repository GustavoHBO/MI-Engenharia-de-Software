class ControllerItem {
    constructor() {
    }

    listaItens() {
        var listaItens = new Vue({
            el: '#lista-itens',
            data: {
                itens: [{
                    id: 1,
                    nome: 'Calça de couro',
                    autor: 'Carlos Manoel',
                    image: 'http://placehold.it/400x300',
                    descricao: 'Calça de couro de cavalo de 1941'
                },{
                    id: 2,
                    nome: 'Chapéu',
                    autor: 'Carlos Manoel',
                    image: 'http://placehold.it/400x300',
                    descricao: 'Chapéu de couro de cavalo de 1941'
                },{
                    id: 3,
                    nome: 'Chapéu',
                    autor: 'Carlos Manoel',
                    image: 'http://placehold.it/400x300',
                    descricao: 'Chapéu de couro de cavalo de 1941'
                },{
                    id: 4,
                    nome: 'Chapéu',
                    autor: 'Carlos Manoel',
                    image: 'http://placehold.it/400x300',
                    descricao: 'Chapéu de couro de cavalo de 1941'
                },{
                    id: 5,
                    nome: 'Chapéu',
                    autor: 'Carlos Manoel',
                    image: 'http://placehold.it/400x300',
                    descricao: 'Chapéu de couro de cavalo de 1941'
                },{
                    id: 6,
                    nome: 'Chapéu',
                    autor: 'Carlos Manoel',
                    image: 'http://placehold.it/400x300',
                    descricao: 'Chapéu de couro de cavalo de 1941'
                },{
                    id: 7,
                    nome: 'Chapéu',
                    autor: 'Carlos Manoel',
                    image: 'http://placehold.it/400x300',
                    descricao: 'Chapéu de couro de cavalo de 1941'
                },{
                    id: 8,
                    nome: 'Chapéu',
                    autor: 'Carlos Manoel',
                    image: 'http://placehold.it/400x300',
                    descricao: 'Chapéu de couro de cavalo de 1941'
                }]
            },
            methods: {

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