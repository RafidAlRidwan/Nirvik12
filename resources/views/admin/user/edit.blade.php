@extends('layouts.admin.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <h1 class="m-0">Edit User</h1>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <ol class="breadcrumb float-sm-right">
                <!-- <button type="submit" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary">Add New</button> -->
                </ol>
            </div>
            </div>
        </div>
    </div>

    <section class="content p-2 ">
        <div class="container-fluid">
            <div class="row m-t-25 card p-3">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            
                    
                    <table id="index_datatable" class="table table-hover">
                        <thead>
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
@endsection