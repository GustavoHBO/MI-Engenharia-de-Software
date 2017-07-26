class ControllerNoticia {
   constructor() {

    }

    gerenciarNoticia() {
        var pesquisa = new Vue({
            el: '#lista_noticias',
            data: {
                noticias: {},
                pesquisa: "", 
            },
            methods: {
                editar: (idNoticia) => {
                    location.href = "editar-noticia.html?noticia=" + idNoticia;
                },
                pesquisar: () => {
                    $.get("http://localhost:8000/api/public/noticia/buscar/" + pesquisa.pesquisa, data => {
                    lista_noticias.noticias = data;
                });
                }
            },
            created: () => {
                //pega lista de usuarios
                $.get("http://localhost:8000/api/public/noticia/listar", data => {
                    lista_noticias.noticias = data;
                });
            }
        })
    }

    novaNoticia() {
        var NovanoticiaPage = new Vue({
            el: '#nova-noticia',
            data: {

            },
            methods: {

            },
        });

    }

    editarNoticia(){
         var editarNoticia = new Vue({
            el: '#editar-noticia',
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