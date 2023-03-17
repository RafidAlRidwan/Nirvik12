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

  #demoInput5-error {
    color: red;
  }

  /*
    CSS for the main interaction
    */
  .tabset>input[type="radio"] {
    position: absolute;
    left: -200vw;
  }

  .tabset .tab-panel {
    display: none;
  }

  .tabset>input:first-child:checked~.tab-panels>.tab-panel:first-child,
  .tabset>input:nth-child(3):checked~.tab-panels>.tab-panel:nth-child(2),
  .tabset>input:nth-child(5):checked~.tab-panels>.tab-panel:nth-child(3),
  .tabset>input:nth-child(7):checked~.tab-panels>.tab-panel:nth-child(4),
  .tabset>input:nth-child(9):checked~.tab-panels>.tab-panel:nth-child(5),
  .tabset>input:nth-child(11):checked~.tab-panels>.tab-panel:nth-child(6) {
    display: block;
  }

  /*
    Styling
    */

  .tabset>label {
    position: relative;
    display: inline-block;
    padding: 15px 15px 25px;
    border: 1px solid transparent;
    border-bottom: 0;
    cursor: pointer;
    font-weight: 600;
  }

  .tabset>label::after {
    content: "";
    position: absolute;
    left: 15px;
    bottom: 10px;
    width: 22px;
    height: 4px;
    background: #8d8d8d;
  }

  .tabset>label:hover,
  .tabset>input:focus+label {
    color: #06c;
  }

  .tabset>label:hover::after,
  .tabset>input:focus+label::after,
  .tabset>input:checked+label::after {
    background: #06c;
  }

  .tabset>input:checked+label {
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
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td><strong>{{$committeeDetails->userData->full_name}}</strong></td>
                <td><span class="badge bg-success">Manager</span></td>
              </tr>
              @foreach ($memberDetails as $item)
              <tr>
                <td>{{$loop->iteration + 1}}</td>
                <td>{{$item->full_name}}</td>
                <td><span class="badge bg-info">Member</span></td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>

    </section>
</section>

@endsection

