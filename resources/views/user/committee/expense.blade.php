@extends('layouts.user.user-dashboard-master')
@section('style')
<link rel="stylesheet" href="{{asset('assets/admin/plugins/select2/css/select2.min.css')}}">
<link href="{{asset('assets/user/landingPage/custom-css/cus-data-table.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/user/landingPage/custom-select/css/style.css')}}">
<style>
        .section-with-bg {
                background-color: transparent;
        }

        #schedule .nav-tabs a.active {
                background-color: #0e1b4d;
                color: #f82249;
                border: 2px solid #f82249;
        }

        #schedule .nav-tabs a {
                border: 2px solid #0e1b4d;
                border-radius: 20px;
        }

        .btn-custom {
                background-color: #2f3640;
                color: #f82249;
        }

        .btn-custom:hover {
                background-color: #fff;
                border-color: #f82249;
                color: #f82249;
        }

        .nice-select {
                width: 100%;
        }

        .nice-select .option:hover,
        .nice-select .option.focus,
        .nice-select .option.selected.focus {
                padding-top: 2px;
                padding-bottom: 2px;
        }

        .selected::after {
                display: none;
        }

        #schedule .nav-tabs {
                padding: 0px;
        }
</style>
@endsection
@section('content')
<main id="home">
        <section id="speakers-details" class="wow fadeIn">
                <div class="container">
                        <div class="section-header">
                                <h2>{{$committeeDetails->name}} - Committee Details</h2>
                        </div>

                        <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <section id="schedule" class="section-with-bg">
                                                <div class="container wow fadeInUp">
                                                @include('user.committee.navBar')
                                                        <div class="tab-content row justify-content-center">
                                                                <!-- TAB 3 -->
                                                                <div class="col-lg-9 tab-pane fade show active">
                                                                        <hr class="px-3">
                                                                        <div class="card" style="background-color: transparent; border:none;">
                                                                                <div class="d-flex justify-content-between px-3">
                                                                                        <h4 class="text-bold">Expenses History</h4>
                                                                                        @if($committeeDetails['manager_id'] == Auth::user()->id)
                                                                                        <button class="btn btn-info btn-custom text-bold btn-sm h-25" data-toggle="modal" data-target="#add_expense">+ Add</button>
                                                                                        @else
                                                                                        <button style="text-decoration: line-through" class="btn btn-secondary text-bold btn-sm h-25" disabled data-toggle="modal" data-target="#add_expense">+ Add</button>
                                                                                        @endif
                                                                                </div>
                                                                                <div class="card-body p-0">
                                                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                                                                <table id="expense_datatable" width="100%" class="table table-sm table-hover">
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
                                                                </div>
                                                        </div>
                                                </div>
                                        </section>
                                </div>

                        </div>
                </div>
        </section>
</main>


<!-- ADD Expense MODAL -->
<div class="modal fade" id="add_expense" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border: none; background: black; background: linear-gradient( to right bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)); border-radius: 1rem; backdrop-filter: blur(5px);">
                        {!! Form::open(['action' => ['App\Http\Controllers\User\CommitteeController@expenseStore'], 'id' => 'from_expense', 'files' => true, 'class' => 'needs-validation']) !!}
                        <div class="modal-body">
                                <div class="d-flex justify-content-between">
                                        <h5 class="modal-title" style="color:#fff; font-weight:700" id="exampleModalLongTitle">Add Expense</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span style="color: #f82249; text-shadow: 0 0px 0 #fff; opacity: 1;" aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="card-body">
                                        <input type="hidden" name="committee_id" id="committee_id" value="{{$committeeDetails->id}}">
                                        <input type="hidden" name="manager_id" value="{{$committeeDetails->id}}">
                                        <div class="form-group">
                                                <label class="text-white" for="exampleInputEmail1">Expense By</label>
                                                {!! Form::select('expense_by', $comiittee_members, $committeeDetails->manager_id, ['placeholder'=>__('Select') ,'id'=>'expense_by', 'class'=>'form-control', 'style'=>'width: 100%', 'required', 'disabled']) !!}
                                        </div>

                                        <div class="form-group">
                                                <label class="text-white" for="exampleInputEmail1">Amount <span class="badge badge-success" id="output"></span></label>
                                                <input type="number" name="amount" class="form-control" id="amount" required="" autocomplete="off">
                                        </div>

                                        <div class="form-group">
                                                <label class="text-white" for="exampleInputEmail1">Remarks</label>
                                                <input type="text" name="remarks" class="form-control" id="remarks">
                                        </div>
                                        <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-custom border-0 btn_submit">Save</button>
                                        </div>

                                </div>
                        </div>
                        {!! Form::close() !!}
                </div>
        </div>
</div>


@endsection

@section('script')
<script>
        $(function() {
                $('[data-toggle="tooltip"]').tooltip()
        })
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
                        "buttons": ['pageLength'],
                        "ajax": {
                                "url": "{{URL::to('/user/expense/getdata/')}}" + '/' + id,
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