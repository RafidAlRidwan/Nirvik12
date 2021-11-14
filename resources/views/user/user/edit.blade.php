@extends('layouts.user.user_navbar')

@section('style')
  <link rel="stylesheet" href="{{asset('assets/user/landingPage/custom-select/css/style.css')}}">
  <link href="{{asset('assets/user/landingPage/file-select/tower-file-input.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/user/landingPage/custom-css/edit.css')}}" rel="stylesheet">
@endsection

@section('content')
<section id="speakers-details" class="wow fadeIn">
  <div class="container">
    <div class="section-header">
        <h2>Edit Profile</h2>
    </div>

  <div class="wrapper"> 
    <div class="card">
        <div class="card-body">
            {!! Form::model($user, ['route' => ['user.update', $user->id],'method'=>'put', 'files' => true, 'class' => 'needs-validation', 'novalidate']) !!}


            @include ('user.user.form2')

            {!! Form::close() !!}
        </div>
    </div>
  </div>
  </div>
</section>

@endsection

@section('script')
      <script type="text/javascript">
          $(document).ready(function(){
              var maxField = 1; //Input fields increment limitation
              var addButton = $('.add_button'); //Add button selector
              var wrapper = $('.field_wrapper'); //Input field wrapper
              var x = 1; //Initial field counter is 1           
              //Once add button is clicked
              $(addButton).click(function(){
                  //Check maximum number of input fields
                  if(x < maxField){ 
                      x++; //Increment field counter
                      var fieldHTML = '<article><div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"><label>Mobile No</label><div class="inputMobile" style="display: flex;"><input type="number" class="custom-add" name="mobile[]" value=""/><span class="remove_button"><i class="fa fa-minus-circle"></i></span></div></div></article>'; //New input field html 
                      $(wrapper).append(fieldHTML); //Add field html
                  }
                  else{
                  flashy('<?php echo "Maximum 3" ?>', {
                    type : 'flashy__info'
                  });
                  }
              });
              
              //Once remove button is clicked
              $(wrapper).on('click', '.remove_button', function(e){
                  e.preventDefault();
                  $(this).closest('article > div').remove(); //Remove field html
                  flashy('<?php echo " Removed" ?>', {
                    type : 'flashy__danger'
                  });
                  x--; //Decrement field counter
              });
          });
  </script>

  <script type="text/javascript">
    $('.changeStatus').on('change', function () {
            var field = $(this).val();
            
            if (field == 2) {

                $('#marital-status').show();
            }
            else{
              $('#marital-status').hide();
            }
        });
  </script>
  <!-- CUSTOM SELECT -->
  <script src="{{asset('assets/user/landingPage/custom-select/js/jquery.nice-select.min.js')}}"></script>
  <script src="{{asset('assets/user/landingPage/custom-select/js/fastclick.js')}}"></script>
  <script src="{{asset('assets/user/landingPage/custom-select/js/prism.js')}}"></script>
  
  <script>
    $(document).ready(function() {
      $('select:not(.ignore)').niceSelect();      
      FastClick.attach(document.body);
    });    
  </script>
  <!-- File SELECT -->
  
  <script src="{{asset('assets/user/landingPage/file-select/tower-file-input.js')}}"></script>
  
  <script type="text/javascript">
      $('#demoInput5').fileInput({
            iconClass: 'mdi mdi-fw mdi-upload'
        });
      
  </script>
  
  <script type="text/javascript">
      $(document).on('click', '#demoInput5', function(){
            $('#edit-img').hide();
        });
  </script>

  
@endsection
