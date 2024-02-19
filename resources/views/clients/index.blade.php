@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
        <div class="row-md-12 d-md-flex justify-content-between align-items-center">
        <h6><a href="{{route('index.dashboard')}}">Dashboard</a> <span>>></span> Clients</h6>
        <div class="">
        
            <button type="button" class="btn btn-primary mt-2 mt-md-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Create New Client
            </button>
        </div>
            
            </div>
  @if($clients->isEmpty())
  <hr>
   <div class="alert alert-info mt-4" role="alert">
    <p class="fw-bold mb-0">No client(s) Found.</p>
  </div>
  @else
  <div class="table-responsive">         
 <table class="table table-striped table-hover mt-4">         
  <thead class="table-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Client code</th>
      <th scope="col" class="text-center">No. of linked contacts</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
   @foreach($clients as $client)
      <td>{{$client->name}}</td>
      <td>{{$client->client_code}}</td>
      <td class="text-center">{{ $client->contacts()->count()}}</td>
      <td>
      <div class="d-flex space-x-2">
      {{-- <a href="#" data-url="{{route('client.edit', $client->id)}}" class="edit-btn btn btn-outline-info mx-2">Edit</a> --}}
      {{-- <button type="button" class="delete-btn btn btn-outline-danger mx-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Delete
      </button> --}}
      <a href="{{route('client.delete', $client->id)}}"  class="delete-btn btn btn-outline-danger">Delete</a>
      <a href="{{route('create.client-link', $client->id)}}"  class="delete-btn btn btn-outline-primary mx-2">Link contact(s)</a>
      </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endif
        </div>
    </div>


<!-- Create Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="clientCreateForm" method="post" action="{{route('create.client')}}">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Client</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label fw-bold">Client Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" id="client_name" placeholder="John Doe" required>
            <div>
            <small id="clientNameError" class="text-danger client-error"></small>
            </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="clientSubmitButton" type="button" class="btn btn-primary">Create</button>
      </div>
    </div>
    </form>
  </div>
</div>

<!--Edit Modal-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Client</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label fw-bold">Client Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="clientName" class="form-control"  placeholder="John Doe" required>
            </div>
            <input type="hidden" id="inputId">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="updateBtn" class="btn btn-primary">Create</button>
      </div>
    </div>
  </div>
</div>

<!--DELETE MODAL-->

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <form method="" action="">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="staticBackdropLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-danger">Are you sure you want to delete this client?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" class="btn btn-danger">Yes</button>
      </div>
    </div>
    </form>
  </div>
</div>
@endsection
