class ControllerNoticia {
    constructor() {
        this.getUser();
    }

    getUser() {
        var usuario = new Vue({
            el: '#navbar-menu',
            data: {
                user: {
                    nome: 'Usuario Boladão'
                }
            },
            beforeCreate: function () {
                firebase.auth().onAuthStateChanged(function (user) {
                    if (user) {
                        console.log('logado');
                    } else {
                        window.location.href = "login.html";
                        // No user is signed in.
                    }
                });
            }


        });
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