class ControllerRelatorio {
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
            methods: {
                logout: () => {
                    firebase.auth().signOut().then(function () {
                        window.location.href = "login.html";
                    }, function (error) {
                        console.log(error.message);
                    });
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

    relatorioItem() {
        var lista_relatorio = new Vue({
            el: '#lista_relatorio',
            data: {
                relatorios: [{
                        item: 'Bota de Couro',
                        funcionario: 'Carlos Rodrigues',
                        movimentacao: 'Adição'
                    },
                    {
                        item: 'Carroça de Madeira',
                        funcionario: 'Fernando Guigs',
                        movimentacao: 'Remoção'
                    }
                ]
            },
            methods: {
                
            }
        });
    }

    relatorioFuncionario() {
        var lista_relatorio = new Vue({
            el: '#lista_relatorio',
            data: {
                relatorios: [{
                        nome: 'Carlos Rodrigues',
                        item: 'Bota de Couro',
                        movimentacao: 'Adição'
                    },
                    {
                        nome: 'Fernando Guigs',
                        item: 'Carroça de Madeira',
                        movimentacao: 'Remoção'
                    }
                ]
            },
            methods: {
                
            }
        });

    }
}