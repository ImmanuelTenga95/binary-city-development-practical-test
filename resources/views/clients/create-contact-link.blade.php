@extends('layouts.app')

@section('content')
<div class="col-md-12 mt-4 d-md-flex justify-content-between align-items-center">
        <h6>Link Contact(s)</h6>
        <a class="btn btn-primary my-2 my-md-0" href="{{url('binary-city')}}">Back</a>
    </div>
<ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">General</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Contact(s)</button>
  </li>
  
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  
        <div class="col-md-6 mt-4">
        <div class="mb-3">
  <label for="formGroupExampleInput" class="form-label fw-bold">Name</label>
  <p>{{$client->name}}</p>
</div>
<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label fw-bold">Client Code</label>
  <input class="form-control" type="text" id="clientCodeId" value="{{$client->client_code}}" aria-label="Client Code" readonly>
</div>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            New Link
</button>

</div>
 
  </div>

  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
   @if($contacts->isEmpty())
  <hr>
   <div class="alert alert-info mt-4" role="alert">
    <p class="fw-bold mb-0">No contact(s) Found.</p>
  </div>
  @else
  <table id="contactsTable" class="table table-striped table-hover">     
            
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Surname</th>
      <th scope="col">Email Adress</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @foreach($contacts as $contact)
    <tr>
      <th scope="row">{{$contact->name}}</th>
      <td>{{$contact->surname}}</td>
      <td>{{$contact->email}}</td>
      <td><a class="btn btn-danger my-2 my-md-0"  href="{{route('client.unlink.contact',['clientId' => $client->id, 'contactId' => $contact->id])}}">Unlink</a></td>
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
    <form method="post" action="{{route('create.contact.link', $client->id)}}">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Contact Link</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label fw-bold">Contact<span class="text-danger">*</span></label>
            <select type="text" name="contact_id" class="form-control" id="formGroupExampleInput" placeholder="John Doe" required>
            @if($allContacts->isEmpty()){
              <option selected disabled value="">No Contact(s) Found.</option>
            }@else
            <option selected disabled value="">Choose a contact</option>
            @endif
            @foreach($allContacts as $contact)
              <option value="{{$contact->id}}">{{$contact->name}} {{$contact->surname}}</option>
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