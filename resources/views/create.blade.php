@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
<form action="/create" method="POST" enctype="multipart/form-data">
@csrf 
<div>     
    <div class="form-floating mt-3 mb-3">
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
      <label for="name" class="form-label">Name of product</label>
    </div>
    @error('name')
   <p class="form-error">{{ $message }}</p>
   @enderror
</div>

<div>
    <div class="form-floating mt-3 mb-3">
      <input type="number" class="form-control" id="price" placeholder="Enter amount" name="price" required>
      <label for="price" class="form-label">Starting bid price</label>
    </div>
    @error('price')
   <p class="form-error">{{ $message }}</p>
   @enderror
</div> 
   
<div>
<div class="form-floating mt-3 mb-3">
<input type="file" class="form-control" id="image" placeholder="Enter commission" name="image" accept="image/*" required>
<label for="image" class="form-label">Upload image</label>
</div>
    @error('image')
   <p class="form-error">{{ $message }}</p>
   @enderror       
</div> 

    <!-- <div class="form-check mb-3">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div> -->
    <br>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button> &nbsp;<a href="/home">Cancel</a>
  </form>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection