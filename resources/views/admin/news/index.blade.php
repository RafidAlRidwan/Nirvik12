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
              <button type="submit" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary">Add New</button>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content p-2">
      <div class="container-fluid">
        <div class="row m-t-25">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        
                
                <table id="index_datatable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Heading</th>
                            <th>Body</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Serial</th>
                            <th>Heading</th>
                            <th>Body</th>
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
	     {!! Form::open(['action' => ['App\Http\Controllers\Admin\NewsController@store'], 'files' => true, 'class' => 'needs-validation', 'novalidate']) !!}
	      <div class="modal-body">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Heading</label>
                    <input type="text" name="heading" class="form-control" id="heading" required="">
                  </div>
                  <div class="form-group">
	                  <label for="exampleSelectBorder">Body</label>
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
@endsection

@section('script')
<script>
      $('#summernote').summernote({
        placeholder: '',
        tabsize: 2,
        height: 250
      });
</script>
@endsection