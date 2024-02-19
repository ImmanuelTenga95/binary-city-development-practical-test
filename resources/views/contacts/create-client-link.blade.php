@extends('layouts.app')

@section('content')
<div class="col-md-12 mt-4 d-md-flex justify-content-between align-items-center">
        <h6>Link Client(s)</h6>
        <a class="btn btn-primary my-2 my-md-0" href="{{url('binary-city/contacts')}}">Back</a>
    </div>
<ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">General</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Client(s)</button>
  </li>
  
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    
        <div class="col-md-6 mt-4">
        <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label fw-bold">Full Name</label>
  <p>{{$contact->surname}} {{$contact->name}}</p>
  
</div>

<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label fw-bold">Email</label>
  <p>{{$contact->email}}</p>

</div>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            New Link
</button>
</div>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
   @if($clients->isEmpty())
  <hr>
   <div class="alert alert-info mt-4" role="alert">
    <p class="fw-bold mb-0">No client(s) Found.</p>
  </div>
  @else
      <table class="table table-striped table-hover">
        
            
  <thead>
    <tr>
      <th scope="col">Client Name</th>
      <th scope="col">Client code</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach($clients as $client)
    <tr>
      <td>{{$client->name}}</td>
      <td>{{$client->client_code}}</td>
      <td><a class="btn btn-danger my-2 my-md-0"  href="{{route('contact.unlink.client',[ 'contactId' => $contact->id, 'clientId' => $client->id])}}">Unlink</a></td>
    </tr>
  @endforeach
  </tbody>
</table>
@endif
  </div>
</div>

<!--Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{route('create.client.link', $contact->id)}}">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Contact Link</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label fw-bold">Client<span class="text-danger">*</span></label>
            <select type="text" name="client_id" class="form-control" id="formGroupExampleInput" placeholder="John Doe" required>
            @if($allClients->isEmpty()){
              <option selected disabled value="">No Client(s) Found.</option>
            }@else
            <option selected disabled value="">Choose a client</option>
            @endif
            @foreach($allClients as $client)
              <option value="{{$client->id}}">{{$client->name}}</option>
            @endforeach
            </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </div>
    </form>
  </div>
</div>
@endsection