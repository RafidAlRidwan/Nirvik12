@extends('layouts.admin.admin')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <h1 class="m-0">CoverPage Management</h1>
      </div>
      @php
        $count = App\Models\CoverPage::TotalCount();
      @endphp
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <ol class="breadcrumb float-sm-right">
          @if($count < 5)
            <a href={{URL::to('admin/cover-page/create')}}><button type="button" class="btn btn-primary">+ Add New</button></a>
          @else
            <a href={{URL::to('admin/cover-page/create')}}><button type="button" class="btn btn-primary" disabled>+ Add New</button></a>
          @endif
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content p-2">
  <div class="container-fluid">
    <div class="row m-t-25 card p-3">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">


        <table id="index_datatable" class="table table-bordered table-striped table-hover table-responsive">
          <thead style="color:#fff; background: #4ed2c5;">
            <tr>
              <th>Serial</th>
              <th>Title</th>
              <th>Description</th>
              <th>Cover Photo</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($coverPage as $items)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$items->title ?? '-'}}</td>
              <td>{!! $items->description ?? '-' !!}</td>
              @php
                $editURL = URL::to('admin/cover-page/edit' . '/' . $items->id);
              @endphp
              @if(!empty($items->attachment))
                <td><img style='border: 1px solid #ddd; border-radius:5px; width: 65px; height:45px; ' src='{{asset('/'. $items->attachment)}}' alt='cover photo' class='responsive'></td>
              @else
                <td><img style='border: 1px solid #ddd; border-radius:5px; width: 65px; height:45px; ' src={{asset('/assets/user/landingPage/img/album.png')}} alt='cover photo' class='responsive'></td>
              @endif
              <td><a href={{$editURL}} ><i class='fa fa-edit' style='font-size:14px;'></i></a>
                | <a class='cover_page_delete' href={{$items->id}}  data-toggle='modal' data-target='#cover_page_delete_modal' style='border: none; background: none;' ><i class='fa fa-trash'></i> </a>
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Serial</th>
              <th>Title</th>
              <th>Description</th>
              <th>Cover Photo</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Modal Delete-->
<div class="modal fade" id="cover_page_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{ Form::open(array('url' => 'admin/cover-page/destroy', 'id'=>'delete_form', 'method' => 'POST')) }}
        <div class="modal-body">

          <p>Are you sure?</p>
          <div class="modal-footer">
            <input type="hidden" name="id" id="cover_page_delete_id">
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

<script type="text/javascript">

  // Delete Event
  $('#index_datatable').on('click', '.cover_page_delete', function() {
    var id = $(this).attr('href');
    $('#cover_page_delete_id').val(id);
  });

</script>
@endsection