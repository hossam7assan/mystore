@extends('layouts.base')
@section('title')
Create Product
@endsection
@section('content')
<form method="post" action="{{ URL::route('products.store') }}" enctype="multipart/form-data">
    @csrf
    Product name        : <input type='text' name='prod_name'>
    <br>
    Product price       : <input type='number' name='prod_price'>
    <br>
    product description : <input type='text' name='prod_desc'>
    <br>
    Product photo       : <input type='file' name='prod_photo'>
    <br>
    Product category    : <select name="prod_cat">
                            @foreach ($availbleCats as $cat)
                                <option value="{{ $cat->id }}">{{$cat->name}}</option>
                            @endforeach
                          </select>
                          <br>    
    <input type='submit' value="Add Product">
</form>

@endsection