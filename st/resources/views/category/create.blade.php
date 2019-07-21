@extends('layouts.base')
@section('title')
Add new Category
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="{{ URL::route('categories.store') }}" >
    @csrf
    <input type="text" name="cat_name">
    <br>
    <input type="submit" value="Add Category">

</form>
@endsection