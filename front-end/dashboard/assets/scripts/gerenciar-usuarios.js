var lista_usuarios = new Vue({
  el: '#lista_usuarios',
  data: {
    usuarios: [
        {
            nome: 'Carlos Goes'
        },
        {
            nome: 'Titi Queiroz'
        }
    ]
  },
    beforeCreate: function () {
        firebase.auth().onAuthStateChanged(function(user) {
                if (user) {
                    console.log('logado');
                } else {
                    window.location.href = "login.html";
                    // No user is signed in.
                }
            });
    }
})
