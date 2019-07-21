@extends('layouts.base')
@section('title')
Edit Category
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
<form method="post" action="{{ URL::route('categories.update',['id' => $categoryData->id]) }}" >
    @csrf
    @method('PUT')
    <input type="text" name="cat_name" value="{{ $categoryData->name }}">
    <br>
    <input type="submit" value="Edit Category">

</form>
@endsection