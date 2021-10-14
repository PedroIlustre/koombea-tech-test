@extends('layouts.base')    
@section('page_title','Contato')
@section('content')    

    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Log in to send a CSV file</h1>
        </div>

        <div class="informacao-pagina">
            <div class="contato-principal">
                @component('layouts._components.form_contato',['class_fieldset'=>'borda-preta'])
                @endcomponent
            </div>
        </div>  
    </div>
    @include('layouts._partials.footer')
@endsection