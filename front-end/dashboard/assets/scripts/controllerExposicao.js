class ControllerExposicao {
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

    gerenciarExposicao() {
        var lista_exposicoes = new Vue({
            el: '#lista_exposicoes',
            data: {
                exposicoes: [{
                    nome: '',
                    titulo: 'Animais Selvagens',
                    local: 'Auditório',
                    data_inicio: '10/09/2017',
                    data_fim: '20/09/2017',
                    descricao: ''
                }, ]
            },
            methods: {
                editar: (idExposicao) => {
                    location.href = "editar-exposicao.html?exposicao=" + idExposicao;
                }
            }
        })
    }

    novaExposicao() {
        var NovaExposicaoPage = new Vue({
            el: '#nova-exposicao',
            data: {
                
            },
            methods: {

            },
        });
    }


}