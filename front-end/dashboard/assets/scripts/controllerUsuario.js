class ControllerUsuario {
    constructor() {

    }

    gerenciarUsuario() {
        var lista_usuarios = new Vue({
            el: '#lista_usuarios',
            data: {
                usuarios: [{
                        nome: 'Carlos Goes',
                        email: 'carlosgoes2008@hotmail.com',
                        ativo: true
                    },
                    {
                        nome: 'Titi Queiroz',
                        email: 'titiquebrabarraco@hotmail.com',
                        ativo: false
                    }
                ]
            },
            methods: {
                editar: (idUsuario) => {
                    location.href = "editar-usuario.html?usuario=" + idUsuario;
                }
            }
        })
    }

    editarUsuario(){
         var editarUsuario = new Vue({
            el: '#editar-usuario',
            data: {
            },
            methods: {

            },
            created: () => {
                let query = location.search.slice(1); //pega a parte depois da ?
                let id = query.split('=')[1]; // pega o id do evento enviado
                console.log(id);
            }
        });
    }
}