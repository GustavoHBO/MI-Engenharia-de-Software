class ControllerFuncionario {
    constructor() {

    }


    gerenciarFuncionario() {
        var lista_funcionarios = new Vue({
            el: '#lista_funcionarios',
            data: {
                funcionarios: [{
                        nome: 'Carlos Rodrigues',
                        email: 'carlosrodrigues2008@hotmail.com',
                        gerencia_itens: true,
                        gerencia_eventos: true,
                        gerencia_noticias: true
                    },
                    {
                        nome: 'Maikon Filho',
                        email: 'maikonfilhooo@hotmail.com',
                        gerencia_itens: true,
                        gerencia_eventos: false,
                        gerencia_noticias: false
                    }
                ]
            },
            methods: {
                editar: (idFuncionario) => {
                    location.href = "editar-funcionario.html?funcionario=" + idFuncionario;
                }
            }
        });
    }

    novoFuncionario() {
        var NovoFuncionarioPage = new Vue({
            el: '#novo-funcionario',
            data: {
                message: 'mensagem'
            },
            methods: {

            },
        });

    }

    editarFuncionario() {
        var editarFuncionario = new Vue({
                el: '#editar-fucionario',
                data: {},
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