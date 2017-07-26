class ControllerGeral {
    constructor() {
        this.getUser();
    }

    getUser() {
        var usuario = new Vue({
            el: '#navbar-menu',
            data: {
                user: {
                    nome: ''
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
            beforeCreate: () => {
                firebase.auth().onAuthStateChanged(function (user) {
                    if (user) {
                        // Pegar nome do usuario
                        $.get("http://localhost:8000/api/public/usuario/" + user.uid, data => {
                            usuario.user.nome = data.nome;
                            console.log('logado - ' + usuario.user.nome);
                        });
                    } else {
                        window.location.href = "login.html";
                        // No user is signed in.
                    }
                });
            },
            created: () => {
                
            }


        });
    }
}