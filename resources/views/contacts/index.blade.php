@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
           <div class="row-md-12 d-md-flex justify-content-between align-items-center">
        <h6><a href="{{route('index.dashboard')}}">Dashboard</a> <span>>></span> Contacts</h6>
        <div>
           
         <button type="button" class="btn btn-primary mt-2 mt-md-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Create New Contact
            </button>
        </div>
            </div>
  @if($contacts->isEmpty())
  <hr>
   <div class="alert alert-info mt-4" role="alert">
    <p class="fw-bold mb-0">No contact(s) Found.</p>
  </div>
  @else
  <div class="table-responsive">
 <table class="table table-striped table-hover mt-4">
  <thead class="table-dark">
    <tr>
     
      <th scope="col">Surname</th>
      <th scope="col">Name</th>
      <th scope="col">Email address</th>
      <th scope="col" class="text-center">No. of linked clients</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  @foreach($contacts as $contact)
    <tr>
      <td>{{$contact->surname}}</td>
      <td>{{$contact->name}}</td>
      <td>{{$contact->email}}</td>
      <td class="text-center">{{ $contact->clients()->count()}}</td>
      <th>
      <div class="d-flex">
       {{-- <button type="button" class="delete-btn btn btn-outline-danger mx-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Delete
      </button> --}}
      <a href="{{route('contact.delete', $contact->id)}}"  class="delete-btn btn btn-outline-danger">Delete</a>
       <a href="{{route('create.contact-link', $contact->id)}}"  class="delete-btn btn btn-outline-primary mx-2">Link client(s)</a>
      </div>
      </th>
    </tr>
  @endforeach  
  </tbody>
</table>
</div>
@endif
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Contact</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="createNewContactForm" method="POST" action="{{route('create.contact')}}">
      @csrf
      <div class="mx-2">
            <small id="contactError" class="text-danger contact-error"></small>
       </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Name<span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" id="contact_name" placeholder="John" required>
            <div>
            <small id="contactNameError" class="text-danger contact-error"></small>
            </div>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label fw-bold">Surname<span class="text-danger">*</span></label>
            <input type="text" name="surname" class="form-control" id="contact_surname" placeholder="Doe" required>
            <div>
            <small id="contactSurnameError" class="text-danger contact-error"></small>
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email Address<span class="text-danger">*</span></label>
            <input type="text" name="email" class="form-control" id="contact_email" placeholder="example@example.com" required>
            <div>
            <small id="contactEmailEmptyError" class="text-danger contact-error"></small>
            <small id="contactEmailError" class="text-danger contact-error"></small>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="contactSubmit" type="button" class="btn btn-primary">Create</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!---EDIT MODAL-->
<div class="modal fade" id="contactEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">Create New Contact</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label fw-bold">Name<span class="text-danger">*</span></label>
            <input type="text" id="contactName" name="name" class="form-control"  placeholder="John" required>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label fw-bold">Surname<span class="text-danger">*</span></label>
            <input type="text" id="contactSurname" name="surname" class="form-control"  placeholder="Doe" required>
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label fw-bold">Email Address<span class="text-danger">*</span></label>
            <input type="text" id="contactEmail" name="email" class="form-control" placeholder="example@example.com" required>
            <input type="hidden" id="contactInputId">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="contactUpdateBtn"  class="btn btn-primary">Create</button>
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
        <p class="text-danger">Are you sure you want to delete this contact?</p>
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
