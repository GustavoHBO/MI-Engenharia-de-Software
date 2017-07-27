class ControllerPesquisa {
 constructor() {

 }
 novaPesquisa() {
    var NovapesquisaPage = new Vue({
      el: '#nova-pesquisa',
      data: {
        code: '',
        show: false
    },
    methods:{
        mostrar: function () {
          this.code = (document.getElementById('campo').value);
          this.show=true;
      }
  }
});
}
}