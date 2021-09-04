@extends('layouts.app')

@section('content')
<div>  Please confirm your file informations <br> <br>
    @foreach($file_lines as $num_line => $lines)
    <center> At the line number {{$num_line+1}}  <br>
        @foreach($header as $k => $item)
              The value of the field called {{$item}}  is {{$lines[$k]}}  <br> 
              save as: 
              <select id=""> 
                  Model::con
              <option value=""> 
              <option value=""> 
              <option value=""> 
              <option value=""> 
              @endforeach
              <br> <br> 
            </center>
              @endforeach
</div>
@endsection