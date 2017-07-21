class ControllerUsuario {
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

    gerenciarUsuario() {
        var lista_usuarios = new Vue({
            el: '#lista_usuarios',
            data: {
                usuarios: [{
                        nome: 'Carlos Goes',
                        email: 'carlosgoes2008@hotmail.com',
                        ativo: true
                    },
                    {
                        nome: 'Titi Queiroz',
                        email: 'titiquebrabarraco@hotmail.com',
                        ativo: false
                    }
                ]
            },
            methods: {
                editar: (idUsuario) => {
                    location.href = "editar-usuario.html?usuario=" + idUsuario;
                }
            }
        })
    }

}