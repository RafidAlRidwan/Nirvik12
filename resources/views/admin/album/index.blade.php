@extends('layouts.admin.admin')

@section('style')
<style>
  .paginate svg {
    overflow: hidden;
    vertical-align: middle;
    width: 30px;
  }
  .paginate p {
    margin-top: 1rem;
    margin-bottom: 1rem;
    text-align: center;
  }
  .paginate div {
    display: block;
    text-align: center;
  }
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
        <h1 class="m-0">Album Management</h1>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <ol class="breadcrumb float-sm-right">
          <a><button type="button" data-toggle="modal" data-target="#album_modal" class="btn btn-primary">+ Add New</button></a>
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
              <th>Cover Photo</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($album as $items)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$items->title}}</td>
              @if(!empty($items->attachment))
                <td><img style='border: 1px solid #ddd; border-radius:5px; width: 45px; height:45px; ' src={{asset('/'. $items->attachment)}} alt='cover photo' class='responsive'></td>
              @else
                <td><img style='border: 1px solid #ddd; border-radius:5px; width: 45px; height:45px; ' src={{asset('/assets/user/landingPage/img/album.png')}} alt='cover photo' class='responsive'></td>
              @endif
              <td><a class="album_edit" href={{$items->id}} title='{{$items->title}}' data-toggle='modal' data-target='#album_edit_modal'><i class='fa fa-edit' style='font-size:14px;'></i></a>
                | <a class='album_delete' href={{$items->id}}  data-toggle='modal' data-target='#album_delete_modal' style='border: none; background: none;' ><i class='fa fa-trash'></i> </a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Serial</th>
              <th>Title</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center paginate">
            {!! $album->links() !!}
        </div>
      </div>
    </div>
  </div>
</section>

<!-- EDIT MODAL -->
<div class="modal fade" id="album_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Album</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['action' => ['App\Http\Controllers\Admin\AlbumController@update'], 'id'=>'edit_news', 'files' => true, 'class' => 'needs-validation']) !!}
      <div class="modal-body">
        <div class="card-body">
          <input type="hidden" name="id" id="album_id">
          <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" name="title" class="form-control" id="title" required="">
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
<div class="modal fade" id="album_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{ Form::open(array('url' => 'admin/album/destroy', 'id'=>'delete_form', 'method' => 'POST')) }}
        <div class="modal-body">

          <p>Are you sure?</p>
          <div class="modal-footer">
            <input type="hidden" name="id" id="album_delete_id">
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

@include('admin.album.add-modal')
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
  
  // Update News
  $('#index_datatable').on('click', '.album_edit', function() {
      var title = $(this).attr('title');
      var id = $(this).attr('href');
      $('#title').val(title);
      $('#album_id').val(id);

  });

  // Delete Album
  $('#index_datatable').on('click', '.album_delete', function() {
    var id = $(this).attr('href');
    $('#album_delete_id').val(id);
  });

</script>
@endsection