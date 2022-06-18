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
    #demoInput5-error{
        color: red;
    }
    /*
    CSS for the main interaction
    */
    .tabset > input[type="radio"] {
      position: absolute;
      left: -200vw;
    }

    .tabset .tab-panel {
      display: none;
    }

    .tabset > input:first-child:checked ~ .tab-panels > .tab-panel:first-child,
    .tabset > input:nth-child(3):checked ~ .tab-panels > .tab-panel:nth-child(2),
    .tabset > input:nth-child(5):checked ~ .tab-panels > .tab-panel:nth-child(3),
    .tabset > input:nth-child(7):checked ~ .tab-panels > .tab-panel:nth-child(4),
    .tabset > input:nth-child(9):checked ~ .tab-panels > .tab-panel:nth-child(5),
    .tabset > input:nth-child(11):checked ~ .tab-panels > .tab-panel:nth-child(6) {
      display: block;
    }

    /*
    Styling
    */

    .tabset > label {
      position: relative;
      display: inline-block;
      padding: 15px 15px 25px;
      border: 1px solid transparent;
      border-bottom: 0;
      cursor: pointer;
      font-weight: 600;
    }

    .tabset > label::after {
      content: "";
      position: absolute;
      left: 15px;
      bottom: 10px;
      width: 22px;
      height: 4px;
      background: #8d8d8d;
    }

    .tabset > label:hover,
    .tabset > input:focus + label {
      color: #06c;
    }

    .tabset > label:hover::after,
    .tabset > input:focus + label::after,
    .tabset > input:checked + label::after {
      background: #06c;
    }

    .tabset > input:checked + label {
      border-color: #ccc;
      border-bottom: 1px solid #fff;
      margin-bottom: -1px;
    }

    .tab-panel {
      padding: 30px 0;
      border-top: 1px solid #ccc;
    }

    /*
    Demo purposes only
    */
    *,
    *:before,
    *:after {
      box-sizing: border-box;
    }

    .tabset {
      max-width: 65em;
    }
</style>
@endsection

@section('content')
@include('errors.validation')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <h1 class="m-0"><strong>{{$committeeDetails->name}}</strong>- Committee Details</h1>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <ol class="breadcrumb float-sm-right">
          <a href={{route('committee_index')}}><button class="btn btn-primary">Back</button></a>
        </ol>
      </div>
    </div>
  </div>
</div>


<section class="content p-2">
  <div class="container-fluid m-t-25 card p-3">
  <section>
    <div class="tabset">
      <!-- Tab 1 -->
      <input type="radio" name="tabset" id="tab1" aria-controls="general" checked>
      <label for="tab1">Member List</label>

      <!-- Tab 2 -->
      <input type="radio" name="tabset" id="tab2" aria-controls="profile">
      <label for="tab2">Collection History</label>

      <!-- Tab 3 -->
      <input type="radio" name="tabset" id="tab3" aria-controls="footer">
      <label for="tab3">Fund Transfer</label>

      <!-- Tab 4 -->
      <input type="radio" name="tabset" id="tab4" aria-controls="expense">
      <label for="tab4">Expenses History</label>
      
      <div class="tab-panels">

        <section id="general" class="tab-panel">
          <h4><strong>{{$committeeDetails->name}}</strong>- Committee Member List</h4>
          <hr>
          
          <div class="card">
              <div class="card-body p-0">
                <table class="table table-sm table-hover">
                  <thead style="color:#fff; background: #4ed2c5;">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Role</th>
                      <th>Balance</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>1</td>
                        <td><strong>{{$committeeDetails->userData->full_name}}</strong></td>
                        <td><span class="badge bg-success">Manager</span></td>
                        <td>{{$committeeDetails->total_balance}}</td>
                      </tr>
                    @foreach ($memberDetails as $item)
                      <tr>
                        <td>{{$loop->iteration + 1}}</td>
                        <td>{{$item->full_name}}</td>
                        <td><span class="badge bg-info">Member</span></td>
                        <td>{{$item->balance}}</td>
                      </tr>
                    @endforeach
                    
                  </tbody>
                </table>
              </div>
          </div>

        </section>

        <section id="profile" class="tab-panel">
          <div class="d-flex justify-content-between">
            <h4>Collection History</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#add_collection">+ Add</button>
          </div>
          <hr>

          <div class="card">
              <div class="card-body p-0">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <table id="index_datatable" width="100%" class="table table-sm table-hover" >
                    <thead style="color:#fff; background: #4ed2c5;">
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Recieved By</th>
                        <th>Collected From</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
          
        </section>

        <section id="footer" class="tab-panel">
          <div class="d-flex justify-content-between">
            <h4>Fund Transfer</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#fund_transfer">+ Add</button>
          </div>
          <hr>

          <div class="card">
              <div class="card-body p-0">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <table id="fund_datatable" width="100%" class="table table-sm table-hover" >
                    <thead style="color:#fff; background: #4ed2c5;">
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Transfer From</th>
                        <th>Transfer To</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Remarks</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
          
          
        </section>

        <section id="expense" class="tab-panel">
          <div class="d-flex justify-content-between">
            <h4>Expenses</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#add_expense">+ Add</button>
          </div>
          <hr>

          <div class="card">
              <div class="card-body p-0">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <table id="expense_datatable" width="100%" class="table table-sm table-hover" >
                    <thead style="color:#fff; background: #4ed2c5;">
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Manager</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Remarks</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
          
          
        </section>

      </div>
      
    </div>
  </section>
</section>

<!-- ADD Collection MODAL -->
<div class="modal fade" id="add_collection" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Collection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['action' => ['App\Http\Controllers\Admin\CollectionController@store'], 'id' => 'from_collection', 'files' => true, 'class' => 'needs-validation']) !!}
      <div class="modal-body">
        <div class="card-body">
          <input type="hidden" name="committee_id" id="committee_id" value="{{$committeeDetails->id}}">
          <input type="hidden" name="manager_id" value="{{$committeeDetails->manager_id}}">
          <div class="form-group">
            <label for="exampleInputEmail1">Recieved By</label>
            {!! Form::select('member_id', $comiittee_members, null, ['placeholder'=>__('Select Member') ,'id'=>'member_id', 'class'=>'form-control', 'style'=>'width: 100%', 'required']) !!}
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Collected From</label>
            {!! Form::select('user_id[]', $user, null, ['data-placeholder'=>__('Search Multiple Mates') ,'multiple'=>'multiple','id'=>'user_id', 'class'=>'select2', 'style'=>'width: 100%', 'required']) !!}
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Amount <span class="badge badge-success" id="output"></span></label>
            <input type="number" name="amount" class="form-control" id="amount" required="" autocomplete="off">
          </div>
          
          <div class="form-group">
            <label for="exampleInputEmail1">Remarks</label>
            <input type="text" name="remarks" class="form-control" id="remarks">
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

<!-- Fund Transfer MODAL -->
<div class="modal fade" id="fund_transfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Fund Transfer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['action' => ['App\Http\Controllers\Admin\CollectionController@transfer'], 'id' => 'from_fund', 'files' => true, 'class' => 'needs-validation']) !!}
      <div class="modal-body">
        <div class="card-body">
          <input type="hidden" name="committee_id" id="committee_id" value="{{$committeeDetails->id}}">
          <input type="hidden" name="manager_id" value="{{$committeeDetails->manager_id}}">
          <input type="hidden" name="available_balance" id="available_balance">
          <div class="form-group">
            <label for="exampleInputEmail1">Transfer From <span class="badge badge-success" id="amount_output"></span></label>
            {!! Form::select('transfer_from', $comiittee_members, null, ['placeholder'=>__('Select') ,'id'=>'transfer_from', 'class'=>'form-control', 'style'=>'width: 100%', 'required']) !!}
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Transfer To</label>
            {!! Form::select('transfer_to', $comiittee_members, null, ['placeholder'=>__('Select') ,'id'=>'transfer_to', 'class'=>'form-control', 'style'=>'width: 100%', 'required']) !!}
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Amount <span class="badge badge-success" id="output"></span></label>
            <input type="number" name="amount" class="form-control" id="fund_amount" required="" autocomplete="off">
            <div class="text-bold" id="balance_output"></div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Remarks</label>
            <input type="text" name="remarks" class="form-control" id="remarks">
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Transfer</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<!-- ADD Expense MODAL -->
<div class="modal fade" id="add_expense" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Expense</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['action' => ['App\Http\Controllers\Admin\CollectionController@expenseStore'], 'id' => 'from_expense', 'files' => true, 'class' => 'needs-validation']) !!}
      <div class="modal-body">
        <div class="card-body">
          <input type="hidden" name="committee_id" id="committee_id" value="{{$committeeDetails->id}}">
          <input type="hidden" name="manager_id" value="{{$committeeDetails->id}}">
          <div class="form-group">
            <label for="exampleInputEmail1">Expense By</label>
            {!! Form::select('expense_by', $comiittee_members, $committeeDetails->manager_id, ['placeholder'=>__('Select') ,'id'=>'expense_by', 'class'=>'form-control', 'style'=>'width: 100%', 'required', 'disabled']) !!}
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Amount <span class="badge badge-success" id="output"></span></label>
            <input type="number" name="amount" class="form-control" id="amount" required="" autocomplete="off">
          </div>
          
          <div class="form-group">
            <label for="exampleInputEmail1">Remarks</label>
            <input type="text" name="remarks" class="form-control" id="remarks">
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

<!-- Delete Collection Modal -->
<div class="modal fade" id="collection_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Revert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{ Form::open(array('url' => 'admin/collection/destroy', 'id'=>'delete_form', 'method' => 'POST')) }}
        <div class="modal-body">

          <p>Are you sure?</p>
          <div class="modal-footer">
            <input type="hidden" name="id" id="collection_delete_id">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary border-0 btn_submit">Yes</button>
          </div>

        </div>
        {{ Form::close() }}


      </div>
    </div>
  </div>
</div>

<!-- Delete Transfer Fund Modal -->
<div class="modal fade" id="fund_transfer_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font_s" id="exampleModalLongTitle">Revert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{ Form::open(array('url' => 'admin/collection/fundDestroy', 'id'=>'delete_form', 'method' => 'POST')) }}
        <div class="modal-body">

          <p>Are you sure?</p>
          <div class="modal-footer">
            <input type="hidden" name="id" id="fund_transfer_delete_id">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary border-0 btn_submit">Yes</button>
          </div>

        </div>
        {{ Form::close() }}


      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
  //Initialize Select2 Elements
  $('.select2').select2();

  $( "#amount" ).keyup(function() {
    var value = $(this).val();
    var count = $("#user_id :selected").length;

    var val = parseInt(value);
    var num = parseInt(count);

    var result = value / count;

    // Output changes
    $('#output').html(result+ " * " +num);
    
  });

  $('#add_collection').on('hidden.bs.modal', function () {
    $("#from_collection").trigger("reset");
    $("#user_id").empty();
  });

</script>

<script type="text/javascript">
  $(document).ready(function() {
    window.csrfToken = '<?php echo csrf_token(); ?>';
    var postData = {};
    postData._token = window.csrfToken;
    var id = $('#committee_id').val();
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
        "url": "{{URL::to('/admin/collection/getdata/')}}"+'/'+id,
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
          "data": "recieved_by"
        },
        {
          "data": "collected_from"
        },
        {
          "data": "amount"
        },
        {
          "data": "date"
        },
        {
          "data": "action"
        },


      ]
    });

    new $.fn.dataTable.FixedHeader(table);
  });

  // Delete Form
  $('#index_datatable').on('click', '.collection_delete', function() {

    var id = $(this).attr('href');
    $('#collection_delete_id').val(id);
  });
</script>

<script>
  // AJAX LOAD
  $( "#transfer_from" ).change(function() {
    var userId = $(this).val();
    var committeeId = $('#committee_id').val();
    var fundAmount = $('#fund_amount').val();
    $.ajax({
        url : "{{URL::to('/admin/collection/getBalance/')}}"+'/'+userId+'/'+committeeId,
        data : '_token = <?php echo csrf_token() ?>',
        type : 'GET',
        dataType : 'json',
        success : function(result){
          if(result){
            $('#amount_output').html("Balance: "+result);
            $('#available_balance').val(result);
          }
        }
    });
  });
  $( "#fund_amount" ).keyup(function() {
    var value = $(this).val();
    var balance = $("#available_balance").val();

    if(parseInt(value) > parseInt(balance))
    {
      $(this).val('');
      // Output changes
      $('#balance_output').html("<p class='text-danger'>Invalid Balance!</p>");
    }else{
      // Output changes
      $('#balance_output').html("");
    }
    
  });

  $('#fund_transfer').on('hidden.bs.modal', function () {
    $('#amount_output').html('');
    $('#balance_output').html("");
    $("#from_fund").trigger("reset");
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    window.csrfToken = '<?php echo csrf_token(); ?>';
    var postData = {};
    postData._token = window.csrfToken;
    var id = $('#committee_id').val();
    var table = $('#fund_datatable').DataTable({
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
        "url": "{{URL::to('/admin/fundTransfer/getdata/')}}"+'/'+id,
        "type": "POST",
        "data": function(d) {
          $.extend(d, postData);
          var dt_params = $('#fund_datatable').data('dt_params');
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
          "data": "transfer_from"
        },
        {
          "data": "transfer_to"
        },
        {
          "data": "amount"
        },
        {
          "data": "date"
        },
        {
          "data": "remarks"
        },
        {
          "data": "action"
        },


      ]
    });

    new $.fn.dataTable.FixedHeader(table);
  });

  // Delete Form
  $('#fund_datatable').on('click', '.fund_delete', function() {

    var id = $(this).attr('href');
    $('#fund_transfer_delete_id').val(id);
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    window.csrfToken = '<?php echo csrf_token(); ?>';
    var postData = {};
    postData._token = window.csrfToken;
    var id = $('#committee_id').val();
    var table = $('#expense_datatable').DataTable({
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
        "url": "{{URL::to('/admin/expense/getdata/')}}"+'/'+id,
        "type": "POST",
        "data": function(d) {
          $.extend(d, postData);
          var dt_params = $('#expense_datatable').data('dt_params');
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
          "data": "manager_id"
        },
        {
          "data": "amount"
        },
        {
          "data": "date"
        },
        {
          "data": "remarks"
        },
        {
          "data": "action"
        },


      ]
    });

    new $.fn.dataTable.FixedHeader(table);
  });

  // Delete Form
  $('#expense_datatable').on('click', '.collection_delete', function() {

    var id = $(this).attr('href');
    $('#collection_delete_id').val(id);
  });
</script>
@endsection