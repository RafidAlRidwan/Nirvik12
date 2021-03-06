@extends('layouts.admin.admin')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <h1 class="m-0">User Management</h1>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <ol class="breadcrumb float-sm-right">
          <button type="submit" data-toggle="modal" data-target="#add_user" class="btn btn-primary">+ Add New</button>
        </ol>
      </div>
    </div>
  </div>
</div>

<hr>

<section class="content p-2 ">
  <div class="container-fluid">
    <div class="row m-t-25 card p-3">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">


        <table id="index_datatable" class="table table-bordered table-striped table-hover">
          <thead style="color:#fff; background: #4ed2c5;">
            <tr>
              <th>Serial</th>
              <th>Profile Picture</th>
              <th>User Name</th>
              <th>Name</th>
              <th>Current City</th>
              <th>Section</th>
              <th>Shift</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>



          </tbody>
          <tfoot>
            <tr>
              <th>Serial</th>
              <th>Profile Picture</th>
              <th>User Name</th>
              <th>Name</th>
              <th>Current City</th>
              <th>Section</th>
              <th>Shift</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- ADD MODAL -->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Insert User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['action' => ['App\Http\Controllers\User\UserController@store'], 'files' => true, 'class' => 'needs-validation']) !!}
      <div class="modal-body">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">User Name</label>
            <input type="text" name="name" class="form-control" id="user" placeholder="a1" required="">
          </div>
          <div class="form-group">
            <label for="exampleSelectBorder">User Type</label>
            <select name="type" class="custom-select" id="exampleSelectBorder">
              <option selected>Select Type</option>
              <option value="2">Admin</option>
              <option value="3">User</option>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="password" value="1234" placeholder="Password" required="">
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- END MODAL ADD -->
<!-- Modal Delete-->
<div class="modal fade" id="user-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{ Form::open(array('url' => 'admin/user/delete', 'id'=>'delete_form', 'method' => 'POST')) }}
        <div class="modal-body">

          <p>Are you sure?</p>
          <div class="modal-footer">
            <input type="hidden" name="user_id" id="delete">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary border-0 btn_submit">Yes</button>
          </div>

        </div>
        {{ Form::close() }}


      </div>
    </div>
  </div>
</div>
<!-- Modal Delete-->
</section>
@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    window.csrfToken = '<?php echo csrf_token(); ?>';
    var postData = {};
    postData._token = window.csrfToken;

    var table = $('#index_datatable').DataTable({
      "responsive": true,
      "processing": true,
      "serverSide": true,
      "dom": 'Bfrtip',
      "lengthMenu": [
        [10, 25, 50, 100, 200, 250],
        ['10 rows', '25 rows', '50 rows', '100 rows', '200 rows', '250 rows']
      ],
      "buttons": ['pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'],
      "ajax": {
        "url": "{{URL::to('/admin/getdata')}}",
        "type": "POST",
        "data": function(d) {
          $.extend(d, postData);
          var dt_params = $('#index_datatable').data('dt_params');
          if (dt_params) {
            $.extend(d, dt_params);
          }
        }
      },
      "destroy": true,
      "columns": [{
          "data": "serial"
        },
        {
          "data": "pp"
        },
        {
          "data": "username"
        },
        {
          "data": "name"
        },
        {
          "data": "city"
        },
        {
          "data": "section"
        },
        {
          "data": "shift"
        },
        {
          "data": "action"
        },


      ]
    });

    new $.fn.dataTable.FixedHeader(table);
  });

  // Delete Form
  $('#index_datatable').on('click', '.user_delete', function() {

    var id = $(this).attr('href');
    $('#delete').val(id);
  });
</script>
@endsection