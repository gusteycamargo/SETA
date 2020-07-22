@extends('templates.main', ['titulo' => "Turma", 'tag' => "TURMA"])

@section('conteudo')
 
     <div class='row'>
         <div class='col-sm-12'>
            <button class="btn btn-primary btn-block" onclick="criar()">
                <b>Cadastrar Nova Turma</b>
            </button>
         </div>
     </div>
     <br>
 
     @component(
         'components.tablelist', [
             "header" => ['Nome', 'Eventos'],
             "data" => $turmas
         ]
     )
     @endcomponent

     <div class="modal" tabindex="-1" role="dialog" id="modalTurma">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formTurmas">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova Turma</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class='col-sm-12'>
                            <label><b>Nome</b></label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>Ano</label>
                            <input type="text" class="form-control" name="ano" id="ano" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>Abreviatura</label>
                            <input type="text" class="form-control" name="abreviatura" id="abreviatura" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>Curso</label>
                            <select name="curso" id="curso" class="form-control" required>
                                
                            </select>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="modalInfo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informações da turma</h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="cancel" class="btn btn-success" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
     </div>
@endsection

@section('script')


    <script type="text/javascript">
        function loadCursos() {
            $.getJSON('/api/cursos/load', function (data) {
                for(i = 0; i < data.length; i++) {
                    item = '<option value="'+data[i].id+'">'+data[i].nome+'</option>';
                    $('#curso').append(item);
                }
            })
        }

        $(function() {
            loadCursos();
        })

        
        function criar() {
            $('#modalTurma').modal().find('.modal-title').text("Nova Turma");
            $('#nome').val('');
            $('#ano').val('');
            $('#abreviatura').val('');
            $('#curso').val('');
            $('#modalTurma').modal('show');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })

        $("#formTurmas").submit( function(event) {
            event.preventDefault();
            if($("#id").val() != '') {
                update( $("#id").val() );
            }
            else {
                insert();
            }
            $('#modalTurma').modal('hide')
        })

        function insert() {
            turmas = {
                nome: $("#nome").val(),
                ano: $("#ano").val(),
                abreviatura: $("#abreviatura").val(),
                curso: $("#curso").val(),
            };
            $.post("/api/turmas", turmas, function(data) {
                novaTurma = JSON.parse(data);
                linha = getLin(novaTurma);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            turmas = {
                nome: $("#nome").val(),
                ano: $("#ano").val(),
                abreviatura: $("#abreviatura").val(),
                curso: $("#curso").val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/turmas/"+id,
                context: this,
                data: turmas,
                success: function (data) {
                    linhas = $("#tabela>tbody>tr");
                    e = linhas.filter( function(i, e) {
                        const dataParse = (JSON.parse(data));
                        return e.cells[0].textContent == dataParse.id;
                    } );
                    console.log(e[0]);

                    if(e) {
                        e[0].cells[1].textContent = turmas.nome;
                    }
                },
                error: function(error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function getLin(turma) {
            var linha = 
            "<tr style='text-align: center'>"+
                "<td style='display: none'>"+ turma.id +"</td>"+
                "<td>"+ turma.nome +"</td>"+
                "<td>"+
                    "<a nohref style='cursor: pointer' onclick='visualizar("+turma.id+")'><img src='{{ asset('img/icons/info.svg') }}'></a>"+
                    "<a nohref style='cursor: pointer' onclick='editar("+turma.id+")'><img src='{{ asset('img/icons/edit.svg') }}'></a>"+
                "</td>"+
            "</tr>";

            return linha;
        }

        function visualizar(id) { 
            $('#modalInfo').modal().find('.modal-body').html("");

            $.getJSON('/api/turmas/'+id, function(data) {
                let nome_curso = '';
                $.getJSON('/api/cursos/'+data.curso_id, function(dataCurso) {
                    $('#modalInfo').modal().find('.modal-body').append("<p>ID: <b>"+ data.id +"</b></p>");
                    $('#modalInfo').modal().find('.modal-title').text(data.nome);
                    $('#modalInfo').modal().find('.modal-body').append("<p>Ano: <b>"+ data.ano +"</b></p>");
                    $('#modalInfo').modal().find('.modal-body').append("<p>Abreviatura: <b>"+ data.abreviatura +"</b></p>");
                    $('#modalInfo').modal().find('.modal-body').append("<p>Curso: <b>"+ dataCurso.nome +"</b></p>");

                    $('#modalInfo').modal('show');
                });
            });
        }

        function editar(id) { 
            $('#modalTurma').modal().find('.modal-title').text("Alterar Turma");

            $.getJSON('/api/turmas/'+id, function(data) {
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#ano').val(data.ano);
                $('#abreviatura').val(data.abreviatura);
                $('#curso').val(data.curso);
                $('#modalTurma').modal('show');
            });
        }

    </script>

@endsection