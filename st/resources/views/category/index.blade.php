@extends('layouts.base')
@section('title')
Category Managment
@endsection
@section('content')
	<div>
	welcome {{ Auth::user()->name }}
	</div>
	<div class="limiter">
		<div>
			<a href="{{ URL::route('categories.create') }}">Add Category</a>
		</div>
		<div class="container-table100">
			<div class="wrap-table100">

				<div class="table100 ver3 m-b-110">
					<div class="table100-head">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">Id</th>
									<th class="cell100 column2">Name</th>
									<th class="cell100 column2">Read</th>
									<th class="cell100 column2">Delete</th>
									<th class="cell100 column2">Edit</th>
								</tr>
							</thead>
						</table>
					</div>

					<div class="table100-body js-pscroll">
						<table>
							<tbody>
                               

                                @foreach($categories as $key => $category)
								<tr class="row100 body">
									<td class="cell100 column1">{{ 1+$key }}</td>
									<td class="cell100 column2">{{ $category->name }}</td>
									<td class="cell100 column2"><a href='{{ URL::route('categories.show',['id' => $category->id]) }}' >R</a></td>	
									<td class="cell100 column2">
										<form action="{{ URL::route('categories.destroy',['id' => $category->id]) }}" method="POST">
											@csrf
											@method('DELETE')
											<input type="submit" value="D">
										</form>
									</td>	
									<td class="cell100 column2">
										<a href="{{ URL::route('categories.edit',['id' => $category->id]) }}" >Edit</a>
									</td>						
                                </tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
@endsection