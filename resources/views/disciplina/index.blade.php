@extends('templates.main', ['titulo' => "Disciplina", 'tag' => "DISCIPLINA"])

@section('conteudo')
 
     <div class='row'>
         <div class='col-sm-12'>
            <button class="btn btn-primary btn-block" onclick="criar()">
                <b>Cadastrar Nova Disciplina</b>
            </button>
         </div>
     </div>
     <br>
 
     @component(
         'components.tablelistDisciplina', [
             "header" => ['Nome', 'Eventos'],
             "data" => $disciplinas
         ]
     )
     @endcomponent

     <div class="modal" tabindex="-1" role="dialog" id="modalDisciplina">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formDisciplinas">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova Disciplina</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <div class='col-sm-12'>
                            <label><b>Nome</b></label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>Número de bimestres</label>
                            <input type="number" class="form-control" name="num_de_bimestres" id="num_de_bimestres" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>Componente Curricular</label>
                            <select name="componente_id" id="componente_id" class="form-control" required>
                                
                            </select>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>Turma</label>
                            <select name="turma" id="turma" class="form-control" required>
                                
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

    <div class="modal" tabindex="-1" role="dialog" id="modalPeso">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formPeso">
                    <div class="modal-header">
                        <h5 class="modal-title">Configuração de pesos</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="idPeso" class="form-control">
                        <input type="hidden" id="idDisc" class="form-control">
                        <div class='col-sm-12'>
                            <label><b>Trabalho</b></label>
                            <input type="text" class="form-control" name="trabalho" id="trabalho" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>Avaliação</label>
                            <input type="text" class="form-control" name="avaliacao" id="avaliacao" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>1º Bimestre</label>
                            <input type="text" class="form-control" name="pri_bim" id="pri_bim" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>2º Bimestre</label>
                            <input type="text" class="form-control" name="seg_bim" id="seg_bim">
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>3° Bimestre</label>
                            <input type="text" class="form-control" name="ter_bim" id="ter_bim">
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>4º Bimestre</label>
                            <input type="text" class="form-control" name="qua_bim" id="qua_bim">
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

    <div class="modal" tabindex="-1" role="dialog" id="modalConceito">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formConceito">
                    <div class="modal-header">
                        <h5 class="modal-title">Configuração de conceitos</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="idConceito" class="form-control">
                        <input type="hidden" id="idDisc" class="form-control">
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>A</label>
                            <input type="text" class="form-control" name="a" id="a" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>B</label>
                            <input type="text" class="form-control" name="b" id="b" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>C</label>
                            <input type="text" class="form-control" name="c" id="c" required>
                        </div>
                        <div class='col-sm-12' style="margin-top: 10px">
                            <label>D</label>
                            <input type="text" class="form-control" name="d" id="d" required>
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
        function loadSelects() {
            $.getJSON('/api/turmas/load', function (data) {
                for(i = 0; i < data.length; i++) {
                    item = '<option value="'+data[i].id+'">'+data[i].nome+'</option>';
                    $('#turma').append(item);
                }
            });

            $.getJSON('/api/componentes/load', function (data) {
                for(i = 0; i < data.length; i++) {
                    item = '<option value="'+data[i].id+'">'+data[i].nome+'</option>';
                    $('#componente_id').append(item);
                }
            });
        }

        $(function() {
            loadSelects();
        })

        
        function criar() {
            $('#modalDisciplina').modal().find('.modal-title').text("Nova Disciplina");
            $('#nome').val('');
            $('#num_de_bimestres').val('');
            $('#component_id').val('');
            $('#turma').val('');
            $('#modalDisciplina').modal('show');
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })

        $("#formDisciplinas").submit( function(event) {
            event.preventDefault();
            if($("#id").val() != '') {
                update( $("#id").val() );
            }
            else {
                insert();
            }
            $('#modalDisciplina').modal('hide')
        })

        $("#formPeso").submit( function(event) {
            event.preventDefault();
            if($("#idPeso").val() != '') {
                updatePeso( $("#idDisc").val() );
            }
            else {
                insertPeso();
            }
            $('#modalPeso').modal('hide')
        })

        $("#formConceito").submit( function(event) {
            event.preventDefault();
            if($("#idConceito").val() != '') {
                updateConceito( $("#idDisc").val() );
            }
            else {
                insertConceito();
            }
            $('#modalConceito').modal('hide')
        })

        function insertPeso() {
            pesos = {
                trabalho: $('#trabalho').val(),
                avaliacao: $('#avaliacao').val(),
                pri_bim: $('#pri_bim').val(),
                seg_bim: $('#seg_bim').val(),
                ter_bim: $('#ter_bim').val(),
                qua_bim: $('#qua_bim').val(),
                disciplina_id: $('#idDisc').val(),
            };
            $.post("/api/pesos", pesos, function(data) {
                console.log('200 OK PESO');
            });
        }

        function insertConceito() {
            conceitos = {
                a: $('#a').val(),
                b: $('#b').val(),
                c: $('#c').val(),
                d: $('#d').val(),
                disciplina_id: $('#idDisc').val(),
            };
            $.post("/api/conceitos", conceitos, function(data) {
                console.log('200 OK CONCEITO');
            });
        }

        function updateConceito(id) {
            conceitos = {
                a: $('#a').val(),
                b: $('#b').val(),
                c: $('#c').val(),
                d: $('#d').val(),
                disciplina_id: $('#idDisc').val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/conceitos/"+id,
                context: this,
                data: conceitos,
                success: function (data) {
                    console.log(data);
                    console.log('edicao conceito ok');
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

        function updatePeso(id) {
            pesos = {
                trabalho: $('#trabalho').val(),
                avaliacao: $('#avaliacao').val(),
                pri_bim: $('#pri_bim').val(),
                seg_bim: $('#seg_bim').val(),
                ter_bim: $('#ter_bim').val(),
                qua_bim: $('#qua_bim').val(),
                disciplina_id: $('#idDisc').val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/pesos/"+id,
                context: this,
                data: pesos,
                success: function (data) {
                    console.log(data);
                    console.log('edicao peso ok');
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

        function insert() {
            disciplinas = {
                nome: $("#nome").val(),
                num_de_bimestres: $("#num_de_bimestres").val(),
                componente_id: $("#componente_id").val(),
                turma: $("#turma").val(),
            };
            $.post("/api/disciplinas", disciplinas, function(data) {
                novaDisciplina = JSON.parse(data);
                linha = getLin(novaDisciplina);
                $('#tabela>tbody').append(linha);
            });
        }

        function update(id) {
            disciplinas = {
                nome: $("#nome").val(),
                num_de_bimestres: $("#num_de_bimestres").val(),
                componente_id: $("#componente_id").val(),
                turma: $("#turma").val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/disciplinas/"+id,
                context: this,
                data: disciplinas,
                success: function (data) {
                    linhas = $("#tabela>tbody>tr");
                    e = linhas.filter( function(i, e) {
                        const dataParse = (JSON.parse(data));
                        return e.cells[0].textContent == dataParse.id;
                    } );
                    console.log(e);

                    if(e) {
                        e[0].cells[1].textContent = disciplinas.nome;
                    }
                },
                error: function(error) {
                    alert('ERRO - UPDATE');
                    console.log(error);
                }
            })
        }

        function getLin(disciplina) {
            var linha = 
            "<tr style='text-align: center'>"+
                "<td style='display: none'>"+ disciplina.id +"</td>"+
                "<td>"+ disciplina.nome +"</td>"+
                "<td>"+
                    "<a nohref style='cursor: pointer' onclick='visualizar("+disciplina.id+")'><img src='{{ asset('img/icons/info.svg') }}'></a>"+
                    "<a nohref style='cursor: pointer' onclick='editar("+disciplina.id+")'><img src='{{ asset('img/icons/edit.svg') }}'></a>"+
                    "<a nohref style='cursor: pointer' onclick='peso(\""+disciplina.id+"\",\""+disciplina.nome+"\")'><img src='{{ asset('img/icons/peso.svg') }}'></a>"+
                    "<a nohref style='cursor: pointer' onclick='conceito(\""+disciplina.id+"\",\""+disciplina.nome+"\")''><img src='{{ asset('img/icons/conceito.svg') }}'></a>"+
                "</td>"+
            "</tr>";

            return linha;
        }

        function visualizar(id) { 
            $('#modalInfo').modal().find('.modal-body').html("");

            $.getJSON('/api/disciplinas/'+id, function(data) {
                let nome_turma = '';
                $.getJSON('/api/turmas/'+data.turma_id, function(dataTurma) {
                    $.getJSON('/api/componentes/'+data.componente_id, function(dataComponente) {

                        $('#modalInfo').modal().find('.modal-body').append("<p>ID: <b>"+ data.id +"</b></p>");
                        $('#modalInfo').modal().find('.modal-title').text(data.nome);
                        $('#modalInfo').modal().find('.modal-body').append("<p>Bimestres: <b>"+ data.num_de_bimestres +"</b></p>");
                        $('#modalInfo').modal().find('.modal-body').append("<p>Componente curricular: <b>"+ dataComponente.nome +"</b></p>");
                        $('#modalInfo').modal().find('.modal-body').append("<p>Turma: <b>"+ dataTurma.nome +"</b></p>");

                        $('#modalInfo').modal('show');
                    });
                });
            });
        }

        function editar(id) { 
            $('#modalDisciplina').modal().find('.modal-title').text("Alterar Turma");

            $.getJSON('/api/disciplinas/'+id, function(data) {
                $('#id').val(data.id);
                $('#nome').val(data.nome);
                $('#num_de_bimestres').val(data.num_de_bimestres);
                $('#componente_id').val(data.componente_id);
                $('#turma').val(data.turma);
                $('#modalDisciplina').modal('show');
            });
        }

        function peso(id, nomeDisciplina) { 
            $('#modalPeso').modal().find('.modal-title').text("Configurar peso: "+nomeDisciplina);
            $('#idDisc').val(id)

            $.ajax({
                type: "GET",
                url: "/api/pesos/"+id,
                context: this,
                success: function (data) {
                    const json = JSON.parse(data);
                    $('#idPeso').val(json.id);
                    $('#trabalho').val(json.trabalho);
                    $('#avaliacao').val(json.avaliacao);
                    $('#pri_bim').val(json.pri_bim);
                    $('#seg_bim').val(json.seg_bim);
                    $('#ter_bim').val(json.ter_bim);
                    $('#qua_bim').val(json.qua_bim);
                },
                error: function(error) {
                    $('#idPeso').val('');
                    $('#trabalho').val('');
                    $('#avaliacao').val('');
                    $('#pri_bim').val('');
                    $('#seg_bim').val('');
                    $('#ter_bim').val('');
                    $('#qua_bim').val('');
                    console.log(error);
                }
            })

            $('#modalPeso').modal('show');
        }

        function conceito(id, nomeDisciplina) { 
            $('#modalConceito').modal().find('.modal-title').text("Configurar conceito: "+nomeDisciplina);
            $('#idDisc').val(id)

            $.ajax({
                type: "GET",
                url: "/api/conceitos/"+id,
                context: this,
                success: function (data) {
                    const json = JSON.parse(data);
                    $('#idConceito').val(json.id);
                    $('#a').val(json.a);
                    $('#b').val(json.b);
                    $('#c').val(json.c);
                    $('#d').val(json.d);
                },
                error: function(error) {
                    $('#idConceito').val('');
                    $('#a').val('');
                    $('#b').val('');
                    $('#c').val('');
                    $('#d').val('');
                    console.log(error);
                }
            })

            $('#modalConceito').modal('show');
        }

    </script>

@endsection