@extends('layout/mainlayout')
@section('content')
@php
use App\Models\Downloadcategoty;
use App\Models\DownloadFile;
use App\Models\DownloadFileDoc;
@endphp
<body>
    
    <div class="parallax overflow-hidden page-section bg-blue-300">
      <div class="container parallax-layer" data-opacity="true">
        <div class="media media-grid v-middle">
          <div class="media-left">
            <span class="icon-block half bg-blue-500 text-white" style="height: 45px;"><i class="fa fa-fw fa-download"></i></span>
          </div>
          <div class="media-body">
            <h3 class="text-display-2 text-white margin-none">ดาวน์โหลดไฟล์เอกสาร</h3>
            <p class="text-white text-subhead" style="font-size: 1.6rem;">เอกสารคู่มือ Brother</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Content -->
    <section class="content" id="document">
    
      <div class="container">
    
        <div class='page-section'>
    
            <div class="col-lg-9">
              <div id="table">
                  <div>
                    <div class="panel panel-default paper-shadow download-group" data-z="0.5" style="margin-bottom: 5px;">
                        <ul class=" list-group">
                      @foreach($download_title as $down)
                      @php
                      $download_cate = Downloadcategoty::where('title_id',$down->title_id)->where('active','y')->get();
                      @endphp
                      <li class="list-group-item">
                        <div class="media v-middle">
                          <div class="media-body">
                            <h4 class="text-headline margin-none" style="font-size: 26px;font-weight: bold;">
                              {{$down->title_name}}</h4>
                          </div>
                          <div class="media-right">
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item media v-middle">
                        @foreach($download_cate as $cate)
                        @php
                        $file = DownloadFile::join('download_filedoc','download_filedoc.file_id','=','download_file.file_id')->where('download_file.download_id',$cate->download_id)->where('download_file.active','y')->get();
                        @endphp
                        <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                          <div class="panel-heading dowload-header panel-collapse-trigger " data-toggle="collapse" data-parent="#accordion" href="#collapse{{$cate->download_id}}">
                            <h3 class="panel-title" style="font-size: 22px;">{{ $cate->download_name}}</h3>
                          </div>
    
                          <div class="panel-body list-group">
                            <div class="panel panel-default">
                              
    
                              <div id="collapse{{$cate->download_id}}" class="panel-collapse collapse ">
                                <ul class="list-group list-group-menu">
                                  @foreach($file as $f)
                        
                                    <li class="list-group-item">
                                      
                                      <a href="{{ route('download.downloadfiles', ['id' => $f->filedoc_id]) }}">
                                        <img src="{{asset('images/icons8-pdf-48.png')}}" alt="" style="width: 22px;" />
                                       {{ $f->filedoc_name }}<span class="pull-right"><i class="fa fa-download"></i> ดาวน์โหลด </span>
                                      </a>
                                      
                                    </li>
                                  @endforeach
                                  
                                </ul>
                              </div>
    
                            </div>
    
                          </div>
                        </div>
                        @endforeach
                      </li>
                      @endforeach
                      </ul>
                    </div>
    
    
                  </div>
           
              </div>
            </div>
          </div>
    
          
    
    
    </section>
</body>
@endsection