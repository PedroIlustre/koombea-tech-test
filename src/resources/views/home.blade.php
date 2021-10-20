@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="informacao-pagina">
                    <div class="contato-principal">
                        <a href="/list_contact/{{Auth::user()->id}}"> &nbsp; &nbsp; See all your contacts
                    </div>
                </div>

                <div class="informacao-pagina">
                    <div class="contato-principal">
                        <a href="/list_files/{{Auth::user()->id}}"> &nbsp; &nbsp; See all your pending files to submit
                    </div>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="informacao-pagina">
                        <div class="contato-principal">
                            @component('layouts._components.upload_file',['class_fieldset'=>'borda-preta'])
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
