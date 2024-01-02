@extends('admin.admin_master')
@section('admin')
<div class="d-flex justify-content-between">
    <h3>welcome : {{Auth::user()->name}} </h3>
    <h3>Total of Categories : {{count($categories)}} </h3>
</div>

<div class="row mt-3">
    <div class="col-md-8" >
        <h3 class="text-center mb-3 text-primary ">All Categories</h3>
        @if (session('success'))
        <h2 class="text-center text-success my-3">{{session('success')}} </h2>          
        @endif


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
        
           
           <tbody>
                @php($i=1)
                @foreach ($categories as $category)
                <tr>
                    <td scope="row"> {{$i++}} </td>
                    <td> {{$category->user->name}} </td>
                    <td>{{$category->category_name}}</td>
                    <td>{{$category->created_at->diffForHumans()}}</td>
                    <td class="text-center">
                        <a href="{{ route('categories.edit', ['id'=>$category->id]) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('categories.softDelete', ['id'=>$category->id]) }}" class="btn btn-danger">Delete</a>
                    </td>
                  
        
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>{{ $categories->links() }}</div>

    </div><!--col-8 -->

    <div class="col-md-4" >
        <h3 class="text-center mb-3 text-primary"> Add Categories</h3>
        <div class="card p-3 text-center" >
            <div class="card-header" >
                <h3 class="text-center text-dark mb-3">Add category</h3>
                
            </div>
            <div class="card-body " >
                <form action="{{ route('categories.store')}} " method="Post">
                    @csrf
                   
                   @error("category_name")
                       <div class="alert alert-danger"> {{$message}} </div>
                   @enderror
                   <input type="text" name="category_name" placeholder="category name" class="form-control form-control-lg mb-3">

                   <button type="submit" class="btn btn-primary ">add category</button>
                </form>
                
            </div>

        </div><!-- card -->

    </div><!--col-4 -->

</div><!-- row -->



@endsection