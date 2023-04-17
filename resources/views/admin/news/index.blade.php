@extends('layouts.admin.admin')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <h1 class="m-0">News Management</h1>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <ol class="breadcrumb float-sm-right">
          <button type="submit" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary">+ Add New</button>
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
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <tr>
              <th>Serial</th>
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- ADD MODAL -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Insert News</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['action' => ['App\Http\Controllers\Admin\NewsController@store'], 'files' => true, 'class' => 'needs-validation']) !!}
      <div class="modal-body">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" name="heading" class="form-control" required="">
          </div>
          <div class="form-group">
            <label for="exampleSelectBorder">Description</label>
            <textarea name="body" id="summernote"></textarea>
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

<!-- EDIT MODAL -->
<div class="modal fade" id="news_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update News</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['action' => ['App\Http\Controllers\Admin\NewsController@update'], 'id'=>'edit_news', 'files' => true, 'class' => 'needs-validation']) !!}
      <div class="modal-body">
        <div class="card-body">
          <input type="hidden" name="id" id="news_id">
          <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" name="heading" class="form-control" id="heading" required="">
          </div>
          <div class="form-group">
            <label for="exampleSelectBorder">Description</label>
            <textarea name="body" id="summernote2"></textarea>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <?php
            $status = [
              0 => 'Inactive',
              1 => 'Active'
            ]
            ?>
            {!! Form::select('status', $status, null, ['class' => 'form-control', 'id' =>'status_data' ]) !!}
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- EDIT MODAL ADD -->
<!-- Modal Delete-->
<div class="modal fade" id="news_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{ Form::open(array('url' => 'admin/news/destroy', 'id'=>'delete_form', 'method' => 'POST')) }}
        <div class="modal-body">

          <p>Are you sure?</p>
          <div class="modal-footer">
            <input type="hidden" name="id" id="news_delete_id">
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
<script>
  $('#summernote').summernote({
    placeholder: '',
    tabsize: 2,
    height: 250
  });
  $('#summernote2').summernote({
    tabsize: 2,
    height: 250
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
        "url": "{{URL::to('/admin/news/getdata')}}",
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
          "data": "heading"
        },
        {
          "data": "body"
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

  // RESET MODAL
  $('#news_edit_modal').on('hidden.bs.modal', function() {
    $(this).find('form').trigger('reset');
  })

  // Update News
  $('#index_datatable').on('click', '.news_edit', function() {
    var active = $(this).attr('status_val');
    var id = $(this).attr('href');

    $.ajax({
      url: "{{route('news.edit.data')}}",
      type: "POST",
      data: {
        "_token": "{{ csrf_token() }}",
        "news_id": id
      },
      success: function(response) {
        $('#heading').val(response.data.heading);
        $('#summernote2').summernote('code', response.data.body);
        $('#status_data').val(active);
        $('#news_id').val(id);
      },
      error: function(response) {

      },
    });



  });

  // Delete News
  $('#index_datatable').on('click', '.news_delete', function() {
    var id = $(this).attr('href');
    $('#news_delete_id').val(id);
  });
</script>
@endsection