class ControllerItem {
    constructor() {

    }


    gerenciarItens() {
        var lista_item = new Vue({
            el: '#lista_item',
            data: {
                itens: [{
                        id: 1,
                        titulo: 'Chapeu da independencia',
                        classificacao: 'Coisa Velha',
                        categoria: 'Colonial'
                    },
                    {
                        id: 2,
                        titulo: 'Miniatura de boi',
                        classificacao: 'Bom',
                        categoria: 'Colonial'
                    },
                    {
                        id: 3,
                        titulo: 'Espingarda',
                        classificacao: 'Não sei',
                        categoria: 'Ditadura'
                    },
                    {
                        id: 4,
                        titulo: 'Carroça de Madeira',
                        classificacao: 'Coisa Velha',
                        categoria: 'Automotivo'
                    },
                ]
            },
            methods: {
                editar: (idItem) => {
                    location.href = "editar-item.html?item=" + idItem;
                }
            }
        });
    }

    novoItem() {
        var imagens = new Vue({
            el: '#imagens',
            data: {
                imagens: [{
                        url: 'foto',
                    },
                    {
                        url: 'foto',
                    },
                    {
                        url: 'foto',
                    },
                ]
            },
            methods: {

            }
        });

    }

    editarItem(){
         var editarItem = new Vue({
            el: '#editar-item',
            data: {
            },
            methods: {

            },
            created: () => {
                let query = location.search.slice(1); //pega a parte depois da ?
                let id = query.split('=')[1]; // pega o id do item enviado
                console.log(id);
            }
        });
    }
}