@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-md-12">
    <h4>Hello, Welcome!</h4>
    </div>
    <div class="col-md-12">
        <h6 class="text-info">Dashboard</h6>
    </div>
  <div class="col-sm-4 mb-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total Client(s) </h5>
        
        <p class="card-text"><span class="badge bg-info">{{$clientsCount}}</span></p>
       
      </div>
    </div>
  </div>
  <div class="col-sm-4 mb-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total Contact(s)</h5>
        <p class="card-text"><span class="badge bg-primary">{{$contactsCount}}</span></p>
        
      </div>
    </div>
  </div>
  <div class="col-sm-4 mb-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total Link(s)</h5>
         <p class="card-text"><span class="badge bg-dark">{{$totalLinked}}</span></p>
        
      </div>
    </div>
  </div>
  
</div>

@endsection