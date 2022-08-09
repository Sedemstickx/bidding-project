@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bids</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <h2>Bids</h2>

@if(count($bids) > 0)
<div class="table-responsive-lg">
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>ITEM NAME</th>
        <th>IMAGE</th>
        <th>PRICE(GHC)</th>
        <th>POSTED DATE</th>
      </tr>
    </thead>
    <tbody>
@foreach($bids as $bid) 
      <tr>
        <td>{{ $bid->name }}</td>
        <td><img class="img" src="{{ url('uploads') }}/{{ $bid->image }}" alt="{{ $bid->image }}"></td>
        <td>{{ number_format($bid->price) }}</td>
        <td>{{ $bid->created_at }}</td>

      </tr>
@endforeach     
    </tbody>
  </table>
  </div> 
@else
<h2>
Error 404
</h2>
@endif
                    
{{ $bids->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection