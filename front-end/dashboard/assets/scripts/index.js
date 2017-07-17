var loginpage = new Vue({
  el: '#lista_relatorio',
  data: {
    relatorios: [
    {
      item: 'Bota de Couro',
      funcionario: 'Carlos Rodrigues',
      movimentacao: 'Adição'
    },
    {
      item: 'Carroça de Madeira',
      funcionario: 'Fernando Guigs',
      movimentacao: 'Remoção'
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
});