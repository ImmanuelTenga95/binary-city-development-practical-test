$(document).ready(function(){
    const alert = $('.message');
    if(alert.length){
        setTimeout(function(){
            alert.hide()
        }, 3000)
    }

//FOR CLIENTS
//EDIT
// $('.edit-btn').on('click', function(){
//     const url = event.target.getAttribute('data-url');
//     $.ajax({
//     url: url, 
//     type: 'GET', 
//     success: function(response){
//         $('#inputId').val(response.id);
//         $('#clientName').val(response.name);
//         $('#editModal').modal('show');
//     },
//     error: function(error){
//         console.log(error);
//     }
// });
// });
//UPDATE
// $('#updateBtn').on('click', function(){
//    const id = $('#inputId').val()
//    const name = $('#clientName').val()
//    const csrfToken = $('meta[name="csrf-token"]').attr('content');
//    $.ajax({
//     url: 'binary-city/client/update/' +id,
//     type:'PUT',
//     data: {
//         name: name,
//     },
//      headers: {
//             'X-CSRF-TOKEN': csrfToken
//         },
//     success:function(res){
//         console.log(res)
//         $('#editModal').modal('hide');
//         window.location.reload();
//     },
//     error:function(error){
//         console.log(error);
//     }
//    })
// });

//SUBMIT FORM VALIDATION

$('#clientSubmitButton').on('click', function(e){

    e.preventDefault();
    const name = $('#client_name').val();
    const contactError = $('.client-error');

    if(name == ""){
        $('#clientNameError').text('Name field is required');
    }else{
        $('#clientCreateForm').submit();
    
    }

    if(contactError.length){
    setTimeout(function(){
        $('#clientNameError').text('');
    }, 3000)
    }


});

//FOR CLIENTS END


//FOR CONTACTS START
//EDIT
// $('#update-btn').on('click', function(){
//     const url = event.target.getAttribute('data-url');
//     $.ajax({
//     url: url, 
//     type: 'GET', 
//     success: function(response){
//         //console.log(response)
//         $('#contactInputId').val(response.id);
//         $('#contactName').val(response.name);
//         $('#contactSurname').val(response.surname);
//         $('#contactEmail').val(response.email);
//         $('#contactEditModal').modal('show');
//     },
//     error: function(error){
//         console.log(error);
//     }
// });
// });

//UPDATE
// $('#contactUpdateBtn').on('click', function(){
//    const id = $('#contactInputId').val()
//    const name = $('#contactName').val()
//    const surname = $('#contactSurname').val()
//    const email = $('#contactEmail').val()
//    const csrfToken = $('meta[name="csrf-token"]').attr('content');
//    $.ajax({
//     url: 'contact/update/' +id,
//     type:'PUT',
//     data: {
//         name: name,
//         surname: surname,
//         email: email,
//     },
//      headers: {
//             'X-CSRF-TOKEN': csrfToken
//         },
//     success:function(res){
//         console.log(res)
//         $('#editModal').modal('hide');
//         window.location.reload();
//     },
//     error:function(error){
//         console.log(error);
//     }
//    })
// });

//UNLINK CLIENT CONTACT

//$('#clientDelete').on('click', function(){
//    const url = event.target.getAttribute('data-url');
 //   $.ajax({
 //   url: url, 
 //   type: 'GET', 
 //   success: function(response){
 //       console.log(response)
 //       window.location.reload();
 //   },
 //   error: function(error){
 //       console.log(error);
  //  }
//});
//});


//SUBMIT FORM VALIDATION

$('#contactSubmit').on('click', function(event){

    event.preventDefault();
    const name = $('#contact_name').val();
    const surname = $('#contact_surname').val();
    const email = $('#contact_email').val();
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    const contactError = $('.contact-error');

    if(name == "" && surname == "" && email == ""){
        $('#contactError').text('All fields are required');
    }else{

        if(name == ""){
            $('#contactNameError').text('Name field is required');
        }
        if(surname == ""){
            $('#contactSurnameError').text('Surname field is required');
        }
        if(email == ""){
            $('#contactEmailEmptyError').text('Email field is required...');
        }

        if(!emailPattern.test(email)){
            $('#contactEmailError').text('Invalid email format, Please enter a valid email address.');
        }
    }

    if(contactError.length){
        setTimeout(function(){
            contactError.text('');
        }, 3000)
    }
    

    if(name != "" && surname != "" && email != "" && emailPattern.test(email)){
        $('#createNewContactForm').submit();
    }
    

});

//FOR CONTACTS END


});
