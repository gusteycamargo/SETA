
 @extends('templates.main', ['titulo' => "Menu", 'tag' => "HOME"])
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
            <a href="{{ route('turmas.index') }}">
                <img src="{{ asset('img/turma_ico.png') }}">
            </a>
            <h3>
                <b>Turma</b>
            </h3>
        </div>
        <div class="col-sm-3" style="text-align: center">
            <a href="{{ route('disciplinas.index') }}">
                <img src="{{ asset('img/disciplina_ico.png') }}">
            </a>
            <h3>
                <b>Disciplina</b>
            </h3>
        </div>
     </div>
     <br>
@endsection