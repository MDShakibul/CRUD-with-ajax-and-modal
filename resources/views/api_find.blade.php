<!DOCTYPE html>
<html>
<head>

</head>
<body>

<span class="error" style="color: red;"></span><br>

Enter Application No: <input type="text" id="application_no" class="application_no" required><br><br>

ID: <input type="text" class="id"><br><br>
{{-- Application No: <input type="text" class="application_no"><br><br> --}}
Status: <input type="text" class="status"><br><br>
Payment_date: <input type="text" class="payment_date"><br><br>
<p class="validity_date"></p><br><br>
Name: <input type="text" class="name" style="width: 250px;"><br><br>
Address: <input type="text" class="address" style="width: 488px;"><br><br>
Mobile No: <input type="text" class="mobile_no"><br><br>
Mauser Name: <input type="text" class="mauser_name"><br><br>
Contact Mobile No: <input type="text" class="contact_mobile_no"><br><br>
Resolved By Date: <input type="text" class="resolved_by_date"><br><br>
Created At: <input type="text" class="created_at"><br><br>



<button type="submit" id="submit">Submit</button>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $(".application_no").blur(function(e){
        e.preventDefault();
        var application_no = $("#application_no").val();
        //alert(application_no);=
        if(!application_no){
          console.log('Application No. is required*');
          //$('.error').text('Application No. is required*');
          $(".error").html('Application No. is required*');
          $('.id').val('');
          $('.payment_date').val('');
          $('.application_no').val('');
          $('.status').val('');
          $('.name').val('');
          $('.address').val('');
          $('.mobile_no').val('');
          $('.mauser_name').val('');
          $('.contact_mobile_no').val('');
          $('.resolved_by_date').val('');
          $('.created_at').val('');
        }
        else{
            $.ajax({
                url: "{{ url('http://localhost/crud_api/public/api/user/form') }}"+'/'+ application_no,
                method: 'GET',
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    $(".error").html(response);
                    $('.id').val(response.result.id);
                    $('.application_no').val(response.result.application_no);
                    $('.status').val(response.result.status);
                    $('.payment_date').val(response.result.payment_date);
                    var modified_payment_date = response.modified_payment_date;
                    var validity_date = response.validity_date;
                    $('.validity_date').html(validity_date);
                    $('.name').val(response.result.name);
                    $('.address').val(response.result.address);
                    $('.mobile_no').val(response.result.mobile_no);
                    $('.mauser_name').val(response.result.mauser_name);
                    $('.contact_mobile_no').val(response.result.contact_mobile_no);
                    $('.resolved_by_date').val(response.result.resolved_by_date);
                    $('.created_at').val(response.result.created_at);

                    var isValidApplication = response.is_valid;
                    if(isValidApplication == true){
                        $(".error").html('');
                        $('#submit').prop("disabled",false);
                    }else{
                        $(".error").html('Your Form was Expired');
                        $('#submit').prop("disabled",true);
                    }
                },error: function(error_response) {
                    //console.log(error_response);
                    $(".error").html(error_response.responseJSON.message);
                },
            });
        }
    });
});
</script>

</body>
</html>
