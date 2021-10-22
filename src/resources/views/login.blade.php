@extends('layouts.base')    
@section('page_title','Contato')
@section('content')    

    <div class="content-page">
        <div class="title-page">
            <h1>Log in to send a CSV file</h1>
        </div>

        <div class="info-page">
            <div class="margin-div">
                @component('layouts._components.form_contato',['class_fieldset'=>'borda-preta'])
                @endcomponent
            </div>
        </div>  
    </div>
    @include('layouts._partials.footer')
@endsection