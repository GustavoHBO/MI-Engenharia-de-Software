var loginpage = new Vue({
  el: '#login-page',
  data: {
    email: '',
    senha: ''
  },
  methods:{
    loginEmail: () => {
      firebase.auth().signInWithEmailAndPassword(loginpage.email, loginpage.senha).catch(function(error) {
      // Handle Errors here.
          var errorCode = error.code;
          var errorMessage = error.message;
          console.log(errorMessage);
      // ...
      });

      firebase.auth().onAuthStateChanged(function(user) {
          if (user) {
              window.location.href = "index.html";
          } else {
              console.log('não logado');
              // No user is signed in.
          }
      });
    },
    loginGoogle: () => {
      console.log('apertou google');
    },
    loginFacebook: () => {
      console.log('apertou facebooks');
    }
  }
})