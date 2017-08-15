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
                    }
                ]
            },
            methods: {
                editar: (idItem) => {
                    location.href = "editar-item.html?item=" + idItem;
                },
                desativar: (item) => {
                    $.post("http://localhost:8000/api/public/item/desativa", item).
                    done((data) => {
                        console.log(item);
                        console.log(data);
                        $.get("http://localhost:8000/api/public/item", data => {
                            lista_item.itens = data;
                        });
                    }).fail(() => {
                        console.log("error");
                    });
                }
            },
            created: () => {
                //pega lista de eventos
                $.get("http://localhost:8000/api/public/item", data => {
                    lista_item.itens = data;
                });
            }
        });
    }

    novoItem() {
        var imagens = new Vue({
            el: '#imagens',
            data: {
                item: {
                    numero_inventario: "",
                    colecao: "",
                    classificacao: "",
                    nome: "",
                    titulo: "",
                    funcao: "",
                    origem: "",
                    procedencia: "",
                    descricao: "",
                    dimensoes: "",
                    altura: "",
                    largura: "",
                    diametro: "",
                    peso: "",
                    comprimento: "",
                    estado_conservacao: "",
                    historico_objeto: "",
                    referencia_bibliografica: "",
                    local_data: "",
                    materiais_constitutivos: "",
                    tecnicas_fabricacao: "",
                    autoria: "",
                    aquisicao: "",
                    data: "",
                    autor: "",
                    observacoes: "",
                    modelo_3d: "",
                    imagens: [{
                        url: 'foto'
                    }]
                },
            },
            methods: {
                cadastrar: () => {
                    imagens.item.aquisicao = getElementsByName("mode_aquisicao");
                    $.post("http://localhost:8000/api/public/item/cadastrar", novoItem.item).
                    done((data) => {
                        location.href = "http://localhost:8000/front-end/dashboard/gerenciar-itens.html";
                    }).fail(() => {
                        console.log("error");
                    });
                }
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