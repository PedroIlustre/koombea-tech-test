@extends('layouts.app')

@section('content')
<div>  See all the contacts that you {{ Auth::user()->name }} have <br> <br>
<table class="table table-sm">
    <thead>
        <tr>
            <th> # </th>
            <th>File name</th>
        </tr>
    </thead>
    <tbody>
        @foreach($files as $file)
        <tr>
            <td> - </td>
            <td> <a href="/show_upload/{{$file->id}}"> {{$file->url}} </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="margin-div">
    <a href="/"> &nbsp; &nbsp; Back to upload
</div>
    
</div>
@endsection