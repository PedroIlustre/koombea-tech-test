@extends('layouts.app')

@section('content')
<div>  See all the contacts that you {{ Auth::user()->name }} have <br> <br>
<table class="table table-sm">
    <thead>
        <tr>
            <th>Name</th>
            <th>Birth Date</th>
            <th>Phone</th>
            <th>Addres</th>
            <th>Credit Card</th>
            <th>Franchise</th>
            <th>E-mail</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td> {{$contact->name}} </td>
            <td> {{$contact->birth_date}} </td>
            <td> {{$contact->phone}} </td>
            <td> {{$contact->addres}} </td>
            <td> {{$contact->credit_card}} </td>
            <td> {{$contact->franchise}} </td>
            <td> {{$contact->email}} </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="margin-div">
    <a href="/"> &nbsp; &nbsp; Back to upload
</div>
    
</div>
@endsection