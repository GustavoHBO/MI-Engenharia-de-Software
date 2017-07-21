var loginpage = new Vue({
  el: '#login-page',
  data: {
    email: '',
    senha: '',
    cemail: '',
    csenha: '',
    csenha2: '',
    nome: '',
    sobrenome: ''
  },
  methods:{
    loginEmail: () => {
      firebase.auth().signInWithEmailAndPassword(loginpage.email, loginpage.senha).catch(function(error) {
      // Handle Errors here.
          var errorCode = error.code;
          console.log(errorCode);
          if(errorCode == 'auth/invalid-email'){
            $.gritter.add({
                  // (string | mandatory) the heading of the notification
                  title: 'E-mail inválido!'
              });
          } else if(errorCode == 'auth/wrong-password'){
            $.gritter.add({
                  // (string | mandatory) the heading of the notification
                  title: 'Senha incorreta!'
              });
          } else if(errorCode == 'auth/user-not-found'){
            $.gritter.add({
                  // (string | mandatory) the heading of the notification
                  title: 'E-mail não cadastrado!'
            });
          }
      // ...
      });

      firebase.auth().onAuthStateChanged(function(user) {
          if (user) {
              window.location.href = "index.html";
          } else {
              // No user is signed in.
          }
      });
    },
    loginGoogle: () => {
      var provider = new firebase.auth.GoogleAuthProvider();
      firebase.auth().signInWithPopup(provider).then(function(result) {
      // This gives you a Google Access Token. You can use it to access the Google API.
      var token = result.credential.accessToken;
      // The signed-in user info.
      var user = result.user;
      // ...
      window.location.href = "index.html";
      }).catch(function(error) {
        console.log(error.message);
      });
    },
    loginFacebook: () => {
      var provider = new firebase.auth.FacebookAuthProvider();
      firebase.auth().signInWithPopup(provider).then(function(result) {
        // This gives you a Facebook Access Token. You can use it to access the Facebook API.
        var token = result.credential.accessToken;
        // The signed-in user info.
        var user = result.user;
        // ...
        console.log('logou');
        window.location.href = "index.html";
      }).catch(function(error) {
        var errorCode = error.code;
        if(errorCode == 'auth/popup-closed-by-user'){
          $.gritter.add({
                  // (string | mandatory) the heading of the notification
                  title: 'Você não completou o login com Facebook!'
            });
        }
      });
    }
  }
})