@extends('layouts.app')

@section('content')
<div>  Please confirm your file informations <br> <br>
    @foreach($file_lines as $num_line => $lines)
    <center> At the line number {{$num_line+1}}  <br>
    <form id="save-contact" method="post" action='{{ route("save_contact") }}' enctype="multipart/form-data">
    {{ @csrf_field() }} 
{{ method_field('POST') }}
        @foreach($header as $k => $item)
              The value of the field called <b> {{$item}} </b>  is <b> {{$lines[$k]}} </b>
              <input type="hidden" name="value_field[{{$num_line}}][{{$k}}]" value="{{$lines[$k]}}">
              do you want to save as: 
              <select name="table_column[{{$num_line}}][{{$k}}]" id="table_column"> 
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
        <button type="submit" >Save Contacts</button>
    </center>
</div>
@endsection