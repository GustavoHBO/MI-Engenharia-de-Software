class ControllerItem {
    constructor() {
    }

    listaItens() {
        var listaItens = new Vue({
            el: '#lista-itens',
            data: {
                itens
            },
            methods: {

            },
            created: () => {
                //pega lista de eventos
                $.get("http://localhost:8000/api/public/item", data => {
                    listaItens.itens = data;
                });
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