
var lista_funcionarios = new Vue({
  el: '#lista_funcionarios',
  data: {
    funcionarios: [
        {
            nome: 'Carlos Rodrigues'
        },
        {
            nome: 'Maikon Filho'
        }
    ]
  },
    beforeCreate: function () {
        firebase.auth().onAuthStateChanged(function(user) {
                if (user) {
                    console.log(user.name);
                } else {
                    window.location.href = "login.html";
                    // No user is signed in.
                }
            });
    }
})
