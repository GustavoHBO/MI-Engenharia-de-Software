class ControllerItem {
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

    gerenciarItens() {
        var lista_item = new Vue({
            el: '#lista_item',
            data: {
                itens: [{
                        titulo: 'Chapeu da independencia',
                        classificacao: 'Coisa Velha',
                        categoria: 'Colonial'
                    },
                    {
                        titulo: 'Miniatura de boi',
                        classificacao: 'Bom',
                        categoria: 'Colonial'
                    },
                    {
                        titulo: 'Espingarda',
                        classificacao: 'Não sei',
                        categoria: 'Ditadura'
                    },
                    {
                        titulo: 'Carroça de Madeira',
                        classificacao: 'Coisa Velha',
                        categoria: 'Automotivo'
                    },
                ]
            },
            methods: {
            
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

}