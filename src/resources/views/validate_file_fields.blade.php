@extends('layouts.app')

@section('content')
<div>  Please confirm your file informations <br> <br>
    @foreach($file_lines as $num_line => $lines)
        <center> At the line number {{$num_line}}  <br>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="save-contact" method="post" action='{{ route("save_contact") }}' enctype="multipart/form-data">
            {{ @csrf_field() }} 
            {{ method_field('POST') }}
            <input type="hidden" name="upload_id" value="{{$upload_id}}">
            @foreach($header as $k => $item)
                The value of the field called <b> {{$item}} </b>  is <b> {{$lines[$item]}} </b>
                <input type="hidden" name="value_field[{{$num_line}}][{{$item}}]" value="{{$lines[$item]}}">
                <input type="hidden" name="url_file" value="{{$url_file}}">
                do you want to save as: 
                <select name="table_column[{{$num_line}}][{{$item}}]" id="table_column"> 
                    <option value=""> Select </option>
                    <option value="name"> Name </option>
                    <option value="birth_date"> Birth Date </option>
                    <option value="phone">Phone </option>
                    <option value="addres"> Addres </option>
                    <option value="credit_card"> Credir Card</option>
                    <option value="franchise">FR  </option>
                    <option value="email"> E-mail</option>
                </select> 
                <br>
            @endforeach
        <br> <br> 
    @endforeach
    <button type="submit" >Save File</button>
    </center>
</div>
@endsection