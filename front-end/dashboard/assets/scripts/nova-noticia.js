var NovanoticiaPage = new Vue({
  el: '#nova-noticia',
  data: {
    message: 'mensagem'
  },
  methods:{
    
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