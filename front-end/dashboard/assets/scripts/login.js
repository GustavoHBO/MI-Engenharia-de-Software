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
      var provider = new firebase.auth.GoogleAuthProvider();
      firebase.auth().signInWithPopup(provider).then(function(result) {
      // This gives you a Google Access Token. You can use it to access the Google API.
      var token = result.credential.accessToken;
      // The signed-in user info.
      var user = result.user;
      // ...
      console.log('logou');
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
        console.log(error.message);
      });
    }
  }
})