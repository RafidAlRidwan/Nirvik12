<section>
       <div class="page-header custom-section">
              <div class="backdrop-gradient"></div>
              <div class="container">
                     <div class="breadcrumb-wrap"></div>
                     <h1 style="font-weight: bold;" class="page-title">#{{$data['title']}}</h1>
                     <p style="font-weight: bold;" class="lead">{{$data['sub-title']}}</p>
                     @if(!empty($data['button']))
                     <p>
                            <a href="{{url($data['action'])}}" style="background-color: #ff4d6d; border: 1px solid #ff4d6d;" class="btn btn-primary btn-sm">{{$data['button']}}</a>
                     </p>
                     @endif
                     @if($data['isAuth'])
                     <p>
                            <a href="{{route($data['route-name'])}}" style="background-color: #ff4d6d; border: 1px solid #ff4d6d;" class="btn btn-primary btn-sm">{{$data['button2']}}</a>
                     </p>
                     @endif
              </div>
       </div>
       </div>
</section>