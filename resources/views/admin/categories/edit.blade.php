@extends('admin.admin_master')
@section('admin')
<div class="d-flex justify-content-between">
    <h3>welcome : {{Auth::user()->name}} </h3>
    
</div>

<div class="row mt-3 justify-content-center">
    <div class="col-md-6" >
        <div class="card p-3 text-center">
           <div class="card-header">
               <h3 class="text-center mb-3 text-dark ">Edit Category</h3>
            </div>
           
      
            <div class="card-body " >
            <form action="{{ route('categories.update' , [ 'id'=>$category->id ] )}} " method="Post">
                @csrf
               
               @error("category_name")
                   <div class="alert alert-danger"> {{$message}} </div>
               @enderror
               <input type="text" name="category_name" value={{ $category->category_name  }} placeholder="category name" class="form-control form-control-lg mb-3">

               <button type="submit" class="btn btn-primary ">Update category</button>
            </form>
            
        </div>
        
    </div><!-- card -->
    </div><!--col-6 -->

   

</div><!-- row -->



@endsection