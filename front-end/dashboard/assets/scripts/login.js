var fpassword = new Vue({
  el: '#forgoten',
  data: {
    emailForgot: ''
  },
  methods: {
    forgotPassword: function (event){
      event.preventDefault();
      firebase.auth().sendPasswordResetEmail(fpassword.emailForgot).then(function() {
        $.gritter.add({
            // (string | mandatory) the heading of the notification
          title: 'E-mail enviado com sucesso!'
        });
        fpassword.emailForgot = "";
        $('#PasswordModal').modal('toggle')
      }, function(error) {
        var errorCode = error.code;
        if (errorCode == 'auth/user-not-found') {
          $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'E-mail não cadastrado!'
          });
          fpassword.emailForgot = "";
        }
      });
    }
  }
})

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
  methods: {
    loginEmail: () => {
      firebase.auth().signInWithEmailAndPassword(loginpage.email, loginpage.senha).catch(function (error) {
        // Handle Errors here.
        var errorCode = error.code;
        if (errorCode == 'auth/invalid-email') {
          $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'E-mail inválido!'
          });
        } else if (errorCode == 'auth/wrong-password') {
          $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Senha incorreta!'
          });
        } else if (errorCode == 'auth/user-not-found') {
          $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'E-mail não cadastrado!'
          });
        }
        // ...
      });

      firebase.auth().onAuthStateChanged(function (user) {
        if (user) {
          //redirecionando para o dashboard
          window.location.href = "index.html?" + this.nome;
        } else {
          // No user is signed in.
        }
      });
    },
    loginGoogle: () => {
      var provider = new firebase.auth.GoogleAuthProvider();
      firebase.auth().signInWithPopup(provider).then(function (result) {
        // This gives you a Google Access Token. You can use it to access the Google API.
        var token = result.credential.accessToken;
        // The signed-in user info.
        var user = result.user;
        var id;
        user.providerData.forEach(function (profile) {
          console.log("Sign-in provider: " + profile.providerId);
          console.log("  Provider-specific UID: " + profile.uid);
          console.log("  Name: " + profile.displayName);
          console.log("  Email: " + profile.email);
          console.log("  Photo URL: " + profile.photoURL);
          id = profile.uid;
          nome = profile.displayName
        });

        // ...

        nome = nome.split(" "); // dividir nome o sobrenome (cada item em uma posição do array)
        // ciclo para agrupar o sobrenome
        var i = 0; // contador
        var sobrenomeTemp = "";
        var aux = nome.slice(1);
        while (i < aux.length) {
          sobrenomeTemp = sobrenomeTemp.concat(aux[i], " "); // agupa os sobrenomes
          i++;
        }
        nome = nome[0]
        sobrenome = sobrenomeTemp.trim(); // limpa os espaços em branco
        //cadastar usuario no banco
        // ROTA PARA BANCO LOCAL, SUBSTITUIR PARA SERVIDOR QUANDO DISPONÍVEL ROTABANCOLOCAL
        $.post("http://localhost:8000/api/public/usuario/new?id=" + user.uid + "&nome=" + this.nome + "&sobrenome=" + this.sobrenome)
          .done(function (data) {
            if (data) {
              console.log("Cadastro concluido, efetuando Login");
              window.location.href = "index.html";
            } else {}
          }).fail(function (code) {
            console.log("Usuário já cadastrado, efetuando Login");
            window.location.href = "index.html";
          });
  

      }).catch(function (error) {
        console.log(error.message);
      });
    },
    loginFacebook: () => {
      var provider = new firebase.auth.FacebookAuthProvider();
      firebase.auth().signInWithPopup(provider).then(function (result) {
        // This gives you a Facebook Access Token. You can use it to access the Facebook API.
        var token = result.credential.accessToken;
        // The signed-in user info.
        var user = result.user;
        var id;
        user.providerData.forEach(function (profile) {
          console.log("Sign-in provider: " + profile.providerId);
          console.log("  Provider-specific UID: " + profile.uid);
          console.log("  Name: " + profile.displayName);
          console.log("  Email: " + profile.email);
          console.log("  Photo URL: " + profile.photoURL);
          id = profile.uid;
          nome = profile.displayName
        });

        nome = nome.split(" "); // dividir nome o sobrenome (cada item em uma posição do array)
        // ciclo para agrupar o sobrenome
        var i = 0; // contador
        var sobrenomeTemp = "";
        var aux = nome.slice(1);
        while (i < aux.length) {
          sobrenomeTemp = sobrenomeTemp.concat(aux[i], " "); // agupa os sobrenomes
          i++;
        }
        nome = nome[0]
        sobrenome = sobrenomeTemp.trim(); // limpa os espaços em branco
        //cadastar usuario no banco
        // ROTA PARA BANCO LOCAL, SUBSTITUIR PARA SERVIDOR QUANDO DISPONÍVEL ROTABANCOLOCAL
        $.post("http://localhost:8000/api/public/usuario/new?id=" + user.uid + "&nome=" + this.nome + "&sobrenome=" + this.sobrenome)
          .done(function (data) {
            if (data) {
              console.log("Cadastro concluido, efetuando Login");
              window.location.href = "index.html";
            } else {}
          }).fail(function (code) {
            console.log("Usuário já cadastrado, efetuando Login");
            window.location.href = "index.html";
            });


      }).catch(function (error) {
        var errorCode = error.code;
        if (errorCode == 'auth/popup-closed-by-user') {
          $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Você não completou o login com Facebook!'
          });
        }
      });
    }
  }
})