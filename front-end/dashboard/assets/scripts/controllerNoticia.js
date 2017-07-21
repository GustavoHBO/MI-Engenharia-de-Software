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

}