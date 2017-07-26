var NovapesquisaPage = new Vue({
  el: '#nova-pesquisa',
  data: {
    code: '<iframe src="https://docs.google.com/forms/d/e/1FAIpQLScWDWHqigj9r7urDeAvpgIPoY6XjoZNs7vR9ECBfwRMsRW0wg/viewform?embedded=true" width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">Carregando…</iframe>',
    show: false
  },
  methods:{
    mostrar: function () {
      this.code = (document.getElementById('campo').value);
      this.show=true;
    }
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