export class usuario { 
  id_usuario; 
  nome; 
  sobrenome; 
  ativo; 
  tipo; 
  permissao; 
 
  constructor(id_usuario, nome, sobrenome, ativo, tipo) {
    this.id_usuario = id_usuario;
    this.nome = nome;
    this.sobrenome = sobrenome;
    this.tipo = tipo;
  } 
}