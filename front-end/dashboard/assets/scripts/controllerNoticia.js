class ControllerNoticia {
   constructor() {

    }

    gerenciarNoticia() {
        var lista_noticias = new Vue({
            el: '#lista_noticias',
            data: {
                noticias: [{
                    titulo: 'Novos itens chegam ao museu',
                    data: '10/09/2017',
                    escritor: 'Ricardo Nogueira'
                }, ]
            },
            methods: {
                editar: (idNoticia) => {
                    location.href = "editar-noticia.html?noticia=" + idNoticia;
                }
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