@extends('layouts.admin.admin')
@section('style')
<style>
  .tower-input-preview-container img {
    vertical-align: middle;
    border-style: none;
    width: 300px;
    margin-bottom: 10px;
  }

  .tower-file input[type="file"] {
    height: 0.1px;
    width: 0.1px;
    opacity: 0;
  }
</style>
@endsection

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <h1 class="m-0">Blog Management</h1>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <ol class="breadcrumb float-sm-right">
          <!-- <a href={{URL::to('admin/blog/create')}}><button type="button" class="btn btn-primary">+ Add New</button></a> -->
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content p-2">
  <div class="container-fluid">
    <div class="row m-t-25 card p-3">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">


        <table id="index_datatable" class="table table-bordered table-striped table-hover">
          <thead style="color:#fff; background: #4ed2c5;">
            <tr>
              <th>Serial</th>
              <th>Blog Title</th>
              <th>Created By</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <tr>
              <th>Serial</th>
              <th>Blog Title</th>
              <th>Created By</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Modal Delete-->
<div class="modal fade" id="gallery_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{ Form::open(array('url' => 'admin/blog/destroy', 'id'=>'delete_form', 'method' => 'POST')) }}
        <div class="modal-body">

          <p>Are you sure?</p>
          <div class="modal-footer">
            <input type="hidden" name="id" id="sponsor_delete_id">
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
@endsection

@section('script')
<!-- File SELECT -->

<script src="{{asset('assets/user/landingPage/file-select/tower-file-input.js')}}"></script>

<script type="text/javascript">
  $('#demoInput5').fileInput({
    iconClass: 'mdi mdi-fw mdi-upload'
  });
</script>
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
        "url": "{{URL::to('/admin/blog/getdata')}}",
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
          "data": "title"
        },
        {
          "data": "created"
        },
        {
          "data": "status"
        },
        {
          "data": "action"
        },
      ]
    });

    new $.fn.dataTable.FixedHeader(table);
  });

  // Make Active / InActive
  $('#index_datatable').on('click', '.actionStatus', function() {
    var id = $(this).attr('status');
    $.ajax({
      url: "{{route('blog.status.modify')}}",
      type: "POST",
      data: {
        "_token": "{{ csrf_token() }}",
        "blog_id": id
      },
      success: function(response) {
        if (response.status == true) {
          var table = $('#index_datatable').DataTable();
          table.draw();
        }
      },
      error: function(response) {

      },
    });
  });

  // Delete Gallery
  $('#index_datatable').on('click', '.sponsor_delete', function() {
    var id = $(this).attr('href');
    $('#sponsor_delete_id').val(id);
  });
</script>
@endsection