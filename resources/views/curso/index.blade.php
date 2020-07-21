@extends('templates.main', ['titulo' => "Curso"])

@section('conteudo')
 
     <div class='row'>
         <div class='col-sm-12'>
            <button class="btn btn-primary btn-block" onclick="criar()">
                <b>Cadastrar Novo Curso</b>
            </button>
         </div>
     </div>
     <br>
 
     @component(
         'components.tablelist', [
             "header" => ['Nome', 'Eventos'],
             "data" => $cursos
         ]
     )
     @endcomponent

     <div class="modal" tabindex="-1" role="dialog" id="modalCurso">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formCursos">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Curso</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class='col-sm-12'>
                            <label><b>Nome</b></label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>Abreviatura</label>
                            <input type="text" class="form-control" name="abreviatura" id="abreviatura" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>Tempo (em anos)</label>
                            <input type="number" class="form-control" name="tempo" id="tempo" required>
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
@endsection

@section('script')


    <script type="text/javascript">
        function criar() {
            $('#modalCurso').modal().find('.modal-title').text("Novo Curso");
            $('#nome').val('');
            $('#abreviatura').val('');
            $('#tempo').val('');
            $('#modalCurso').modal('show');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })

        $("#formCursos").submit( function(event) {
            event.preventDefault();
            if($("#id").val() != '') {
                update( $("#id").val() );
            }
            else {
                insert();
            }
            $('#modalCurso').modal('hide')
        })

        function insert() {
            cursos = {
                nome: $("#nome").val(),
                abreviatura: $("#abreviatura").val(),
                tempo: $("#tempo").val(),
            };
            console.log(cursos);
            $.post("/api/cursos", cursos, function(data) {
                novoCurso = JSON.parse(data);
                linha = getLin(novoCurso);
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

        function getLin(curso) {
            var linha = 
            "<tr style='text-align: center'>"+
                "<td>"+ curso.nome +"</td>"+
                "<td>"+
                    "<a nohref style='cursor: pointer' onclick='visualizar("+curso.id+")'><img src='{{ asset('img/icons/info.svg') }}'></a>"+
                    "<a nohref style='cursor: pointer' onclick='editar("+curso.id+")'><img src='{{ asset('img/icons/edit.svg') }}'></a>"+
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

@endsection