
// Instancia responsável pelo controle da lista de noticias
var imagens = new Vue({
  el: '#imagens',
  data: {
    imagens: [
        {
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
});