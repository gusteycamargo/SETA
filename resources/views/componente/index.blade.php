@extends('templates.main', ['titulo' => "Componente", 'tag' => "COMPONENTE"])

@section('conteudo')
 
     <div class='row'>
         <div class='col-sm-12'>
            <button class="btn btn-primary btn-block" onclick="criar()">
                <b>Cadastrar Novo Componente Curricular</b>
            </button>
         </div>
     </div>
     <br>
 
     @component(
         'components.tablelist', [
             "header" => ['Nome', 'Eventos'],
             "data" => $componentes
         ]
     )
     @endcomponent

     <div class="modal" tabindex="-1" role="dialog" id="modalComponente">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formComponentes">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Componente</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class='col-sm-12'>
                            <label><b>Nome</b></label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>Carga horária</label>
                            <input type="text" class="form-control" name="carga_horaria" id="carga_horaria" required>
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
                    <h5 class="modal-title">Informações do Componente</h5>
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
            $('#modalComponente').modal().find('.modal-title').text("Novo Componente");
            $('#nome').val('');
            $('#carga_horaria').val('');
            $('#curso').val('');
            $('#modalComponente').modal('show');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })

        $("#formComponentes").submit( function(event) {
            event.preventDefault();
            if($("#id").val() != '') {
                update( $("#id").val() );
            }
            else {
                insert();
            }
            $('#modalComponente').modal('hide')
        })

        function insert() {
            componentes = {
                nome: $("#nome").val(),
                carga_horaria: $("#carga_horaria").val(),
                curso: $("#curso").val(),
            };
            $.post("/api/componentes", componentes, function(data) {
                novoComponente = JSON.parse(data);
                linha = getLin(novoComponente);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            componentes = {
                nome: $("#nome").val(),
                carga_horaria: $("#carga_horaria").val(),
                curso: $("#curso").val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/componentes/"+id,
                context: this,
                data: componentes,
                success: function (data) {
                    linhas = $("#tabela>tbody>tr");
                    e = linhas.filter( function(i, e) {
                        const dataParse = (JSON.parse(data));
                        return e.cells[0].textContent == dataParse.id;
                    } );
                    //console.log(e[0]);

                    if(e) {
                        e[0].cells[1].textContent = componentes.nome;
                    }
                },
                error: function(error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function getLin(componente) {
            var linha = 
            "<tr style='text-align: center'>"+
                "<td style='display: none'>"+ componente.id +"</td>"+
                "<td>"+ componente.nome +"</td>"+
                "<td>"+
                    "<a nohref style='cursor: pointer' onclick='visualizar("+componente.id+")'><img src='{{ asset('img/icons/info.svg') }}'></a>"+
                    "<a nohref style='cursor: pointer' onclick='editar("+componente.id+")'><img src='{{ asset('img/icons/edit.svg') }}'></a>"+
                "</td>"+
            "</tr>";

            return linha;
        }

        function visualizar(id) { 
            $('#modalInfo').modal().find('.modal-body').html("");

            $.getJSON('/api/componentes/'+id, function(data) {
                let nome_curso = '';
                $.getJSON('/api/cursos/'+data.curso_id, function(dataCurso) {
                    $('#modalInfo').modal().find('.modal-body').append("<p>ID: <b>"+ data.id +"</b></p>");
                    $('#modalInfo').modal().find('.modal-title').text(data.nome);
                    $('#modalInfo').modal().find('.modal-body').append("<p>Carga horária: <b>"+ data.carga_horaria +"</b></p>");
                    $('#modalInfo').modal().find('.modal-body').append("<p>Curso: <b>"+ dataCurso.nome +"</b></p>");

                    $('#modalInfo').modal('show');
                });
            });
        }

        function editar(id) { 
            $('#modalComponente').modal().find('.modal-title').text("Alterar Componente");

            $.getJSON('/api/componentes/'+id, function(data) {
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#carga_horaria').val(data.carga_horaria);
                $('#curso').val(data.curso);
                $('#modalComponente').modal('show');
            });
        }

    </script>

@endsection