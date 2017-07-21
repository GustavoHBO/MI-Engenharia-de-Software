class ControllerGeral {
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
}