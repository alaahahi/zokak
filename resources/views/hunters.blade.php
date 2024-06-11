@extends('layouts.content')
@section('content')
<div class="container-fluid bg-d  pb-5">
<section>
    <div class="container pt-4" >
        <div class="row text-center py-5">
            <div class="col-md-7" >
                <div class="position-relative">
                <picture >
                    <source srcset="{{asset('asset/img/blob2.png')}}" media="(max-width: 576px)">
                    <source srcset="{{asset('asset/img/blob2.png')}}" media="(max-width: 768px)">
                    <source srcset="{{asset('asset/img/blob2.png')}}" media="(max-width: 992px)">
                    <source srcset="{{asset('asset/img/blob2.png')}}" media="(max-width: 1200px)">
                    <source srcset="{{asset('asset/img/blob2.png')}}" media="(max-width: 1400px)">
                    <source srcset="{{asset('asset/img/blob2.png')}}" media="(min-width: 1400px)">
                    <img src="{{asset('asset/img/blob2.png')}}" alt="Responsive image">
                </picture>
                <div class="position-absolute top-50 start-50 translate-middle">
                <picture >
                    <source srcset="{{asset('asset/img/Hunters.png')}}" media="(max-width: 576px)">
                    <source srcset="{{asset('asset/img/Hunters.png')}}" media="(max-width: 768px)">
                    <source srcset="{{asset('asset/img/Hunters.png')}}" media="(max-width: 992px)">
                    <source srcset="{{asset('asset/img/Hunters.png')}}" media="(max-width: 1200px)">
                    <source srcset="{{asset('asset/img/Hunters.png')}}" media="(max-width: 1400px)">
                    <source srcset="{{asset('asset/img/Hunters.png')}}" media="(min-width: 1400px)">
                    <img src="{{asset('asset/img/Hunters.png')}}" alt="Responsive image">
                </picture>
                </div>
                </div>
        
            </div>
                
            <div class="col-md-5" >
                <picture>
                    <source srcset="{{asset('asset/img/illustraion3.png')}}" media="(max-width: 576px)">
                    <source srcset="{{asset('asset/img/illustraion3.png')}}" media="(max-width: 768px)">
                    <source srcset="{{asset('asset/img/illustraion3.png')}}" media="(max-width: 992px)">
                    <source srcset="{{asset('asset/img/illustraion3.png')}}" media="(max-width: 1200px)">
                    <source srcset="{{asset('asset/img/illustraion3.png')}}" media="(max-width: 1400px)">
                    <source srcset="{{asset('asset/img/illustraion3.png')}}" media="(min-width: 1400px)">
                    <img src="{{asset('asset/img/illustraion3.png')}}" alt="Responsive image">
                </picture>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
    <div class="row text-center text-white py-5">
        <div class="col-md-4">
          <h3 class="py-5 position-relative" style="font-weight: 600;font-size: 25px;line-height: 30px;" class="position-relative">Menu  
        <span  class="position-absolute">
        <img src="{{asset('asset/img/find-parties-arrow.png')}}"  width="38px"   alt="Responsive image" class="pt-4">
        </span>
        </h3>
          <div>
          <picture>
                    <source srcset="{{asset('asset/img/h1.png')}}" media="(max-width: 576px)">
                    <source srcset="{{asset('asset/img/h1.png')}}" media="(max-width: 768px)">
                    <source srcset="{{asset('asset/img/h1.png')}}" media="(max-width: 992px)">
                    <source srcset="{{asset('asset/img/h1.png')}}" media="(max-width: 1200px)">
                    <source srcset="{{asset('asset/img/h1.png')}}" media="(max-width: 1400px)">
                    <source srcset="{{asset('asset/img/h1.png')}}" media="(min-width: 1400px)">
                    <img src="{{asset('asset/img/h1.png')}}" alt="Responsive image">
                </picture>
          </div>
        </div>
        <div class="col-md-4">
        <h3 class="py-5 position-relative mt-5" style="font-weight: 600;font-size: 25px;line-height: 30px;"  class="">
            <span>
            <img src="{{asset('asset/img/map-view-arrow.png')}}"  width="48px"   alt="Responsive image" class="pt-5">
            </span class="position-absolute">
            Filter Parties
        </h3>
          <div>
          <picture>
                    <source srcset="{{asset('asset/img/h2.png')}}" media="(max-width: 576px)">
                    <source srcset="{{asset('asset/img/h2.png')}}" media="(max-width: 768px)">
                    <source srcset="{{asset('asset/img/h2.png')}}" media="(max-width: 992px)">
                    <source srcset="{{asset('asset/img/h2.png')}}" media="(max-width: 1200px)">
                    <source srcset="{{asset('asset/img/h2.png')}}" media="(max-width: 1400px)">
                    <source srcset="{{asset('asset/img/h2.png')}}" media="(min-width: 1400px)">
                    <img src="{{asset('asset/img/h2.png')}}" alt="Responsive image">
                </picture>
          </div>
        </div>
        <div class="col-md-4">
            <h3 class="py-5 position-relative" style="font-weight: 600;font-size: 25px;line-height: 30px;"  class="">Party Info
            <span class="position-absolute">
            <img src="{{asset('asset/img/explore-arrow.png')}}"  width="48px"   alt="Responsive image" class="pt-4">
            </span>
            </h3>
          <div>
          <picture>
                    <source srcset="{{asset('asset/img/h3.png')}}" media="(max-width: 576px)">
                    <source srcset="{{asset('asset/img/h3.png')}}" media="(max-width: 768px)">
                    <source srcset="{{asset('asset/img/h3.png')}}" media="(max-width: 992px)">
                    <source srcset="{{asset('asset/img/h3.png')}}" media="(max-width: 1200px)">
                    <source srcset="{{asset('asset/img/h3.png')}}" media="(max-width: 1400px)">
                    <source srcset="{{asset('asset/img/h3.png')}}" media="(min-width: 1400px)">
                    <img src="{{asset('asset/img/h3.png')}}" alt="Responsive image">
                </picture>
          </div>
        </div>
    </div>
    </div>
</section>
<section>
@include('components.download')
</section>
</div>
@endsection