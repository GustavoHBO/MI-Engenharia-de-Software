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
                        window.location.href = "../dashboard/login.html";
                    }, function (error) {
                        console.log(error.message);
                    });
                }
            },
            beforeCreate: () => {
                
            },
            created: () => {
                
            }


        });
    }
}