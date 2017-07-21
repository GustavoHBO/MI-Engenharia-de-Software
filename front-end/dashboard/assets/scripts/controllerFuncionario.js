class ControllerFuncionario {
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

    gerenciarFuncionario() {
        var lista_funcionarios = new Vue({
            el: '#lista_funcionarios',
            data: {
                funcionarios: [{
                        nome: 'Carlos Rodrigues',
                        email: 'carlosrodrigues2008@hotmail.com',
                        gerencia_itens: true,
                        gerencia_eventos: true,
                        gerencia_noticias: true
                    },
                    {
                        nome: 'Maikon Filho',
                        email: 'maikonfilhooo@hotmail.com',
                        gerencia_itens: true,
                        gerencia_eventos: false,
                        gerencia_noticias: false
                    }
                ]
            },
            methods: {

            }
        });
    }

    novoFuncionario() {
        var NovoFuncionarioPage = new Vue({
            el: '#novo-funcionario',
            data: {
                message: 'mensagem'
            },
            methods: {

            },
        });

    }

}