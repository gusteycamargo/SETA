 <!-- https://material.io/resources/icons/?icon=delete&style=baseline -->
{{-- 
 

 @section('titulo') Clientes @endsection --}}
 @extends('templates.main', ['titulo' => "Menu"])
 @section('titulo') <b>Menu</b> @endsection
 @section('conteudo')
 
     <div class='row'>
        <div class="col-sm-3" style="text-align: center">
            <a href="{{ route('cursos.index') }}">
                <img src="{{ asset('img/curso_ico.png') }}">
            </a>
            <h3>
                <b>Curso</b>
            </h3>
        </div>
        <div class="col-sm-3" style="text-align: center">
            <a href="{{ route('componentes.index') }}">
                <img src="{{ asset('img/componente_ico.png') }}">
            </a>
            <h3>
                <b>Componente</b>
            </h3>
        </div>
        <div class="col-sm-3" style="text-align: center">
            <a href="#">
                <img src="{{ asset('img/turma_ico.png') }}">
            </a>
            <h3>
                <b>Turma</b>
            </h3>
        </div>
        <div class="col-sm-3" style="text-align: center">
            <a href="#">
                <img src="{{ asset('img/disciplina_ico.png') }}">
            </a>
            <h3>
                <b>Disciplina</b>
            </h3>
        </div>
     </div>
     <br>
 
     {{-- @component(
         'components.tablelist', [
             "header" => ['ID', 'Nome', 'E-mail', 'Telefone', 'Eventos'],
             "data" => $clientes
         ]
     )
     @endcomponent

     <div class="modal fade" tabindex="-1" role="dialog" id="modalRemove">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" id="id_remove" class="form-control">
                <div class="modal-header">
                    <h5 class="modal-title">Remover Cliente</h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" onClick="remove()">Sim</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
     </div>

     <div class="modal fade" tabindex="-1" role="dialog" id="modalInfo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informações do Cliente</h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="cancel" class="btn btn-success" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
     </div>

     <div class="modal" tabindex="-1" role="dialog" id="modalCliente">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formClientes">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Cliente</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class='col-sm-12'>
                            <label><b>Nome</b></label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>E-mail</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="telefone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  --}}
@endsection

{{-- @section('script')


    <script type="text/javascript">
        function criar() {
            $('#modalCliente').modal().find('.modal-title').text("Novo Cliente");
            $('#nome').val('');
            $('#email').val('');
            $('#telefone').val('');
            $('#modalCliente').modal('show');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })

        $("#formClientes").submit( function(event) {
            event.preventDefault();
            if($("#id").val() != '') {
                update( $("#id").val() );
            }
            else {
                insert();
            }
            $('#modalCliente').modal('hide')
        })

        function insert() {
            clientes = {
                nome: $("#nome").val(),
                email: $("#email").val(),
                telefone: $("#telefone").val(),
            };
            console.log(clientes);
            $.post("/api/clientes", clientes, function(data) {
                novoCliente = JSON.parse(data);
                linha = getLin(novoCliente);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            clientes = {
                nome: $("#nome").val(),
                email: $("#email").val(),
                telefone: $("#telefone").val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/clientes/"+id,
                context: this,
                data: clientes,
                success: function (data) {
                    linhas = $("#tabela>tbody>tr");
                    e = linhas.filter( function(i, e) {
                        const dataParse = (JSON.parse(data));
                        return e.cells[0].textContent == dataParse.id;
                    } );
                    //console.log(e[0]);

                    if(e) {
                        e[0].cells[1].textContent = clientes.nome;
                        e[0].cells[2].textContent = clientes.email;
                        e[0].cells[3].textContent = clientes.telefone;
                    }
                },
                error: function(error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function getLin(cliente) {
            var linha = 
            "<tr style='text-align: center'>"+
                "<td>"+ cliente.id +"</td>"+
                "<td>"+ cliente.nome +"</td>"+
                "<td>"+ cliente.email +"</td>"+
                "<td>"+ cliente.telefone +"</td>"+
                "<td>"+
                    "<a nohref style='cursor: pointer' onclick='visualizar("+cliente.id+")'><img src='{{ asset('img/icons/info.svg') }}'></a>"+
                    "<a nohref style='cursor: pointer' onclick='editar("+cliente.id+")'><img src='{{ asset('img/icons/edit.svg') }}'></a>"+
                    "<a nohref style='cursor: pointer' onclick='remover("+cliente.id+", '"+cliente.nome+"'"+")'><img src='{{ asset('img/icons/delete.png') }}'></a>"+
                "</td>"+
            "</tr>";

            return linha;
        }

        function visualizar(id) { 
            $('#modalInfo').modal().find('.modal-body').html("");

            $.getJSON('/api/clientes/'+id, function(data) {
                $('#modalInfo').modal().find('.modal-body').append("<p>ID: <b>"+ data.id +"</b></p>");
                $('#modalInfo').modal().find('.modal-body').append("<p>Nome: <b>"+ data.nome +"</b></p>");
                $('#modalInfo').modal().find('.modal-body').append("<p>E-mail: <b>"+ data.email +"</b></p>");
                $('#modalInfo').modal().find('.modal-body').append("<p>Telefone: <b>"+ data.telefone +"</b></p>");

                $('#modalInfo').modal('show');
            });
        }

        function editar(id) { 
            $('#modalCliente').modal().find('.modal-title').text("Alterar Cliente");

            $.getJSON('/api/clientes/'+id, function(data) {
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#email').val(data.email);
                $('#telefone').val(data.telefone);
                $('#modalCliente').modal('show');
            });
         }
        function remover(id, nome) { 
            $('#modalRemove').modal().find('.modal-body').html("");
            $('#modalRemove').modal().find('.modal-body').append("Deseja remover o cliente ''"+nome+"'?'");
            $('#id_remove').val(id);
            $('#modalRemove').modal('show'); 
        }

        function remove() {
            var id = $('#id_remove').val();
            $.ajax({
                type: "DELETE",
                url: "/api/clientes/"+id,
                context: this,
                success: function (data) {
                    linhas = $("#tabela>tbody>tr");
                    e = linhas.filter( function(i, e) {
                        

                        console.log(id);
                        console.log(data);
                        return e.cells[0].textContent == id;
                    } );
                    //console.log(e[0]);

                    if(e) {
                        e.remove();
                    }
                },
                error: function(error) {
                    alert('ERRO - DELETE');
                    console.log(error);
                }
            });

            $('#modalRemove').modal('hide'); 
        }

    </script>

@endsection --}}
 
 