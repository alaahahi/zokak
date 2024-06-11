@extends('layouts.content')
@section('content')
<div class="container-fluid bg-d  pb-5">

<section>
    <div class="container">
       <div class="row ">
         <div class="p-0 mt-5"  style="text-align: center;background: #7E6EF6;border-radius: 16px;min-height:330px">
         <div id="map"></div>
         </div>
        </div>
   
       </div>
    </div>
</section>

<section class=" bg-d">
<div class="container ">
       <div class="row ">
         <div class="col-md-7 text-white py-5">
            <h2>
            Contact Us 
            </h2>
            <p>
            We’ll be in touch to kick things off in no time
            </p>
            <p>
            Prefer email? You can also reach us at:
            </p>
            <a>
            info@eventy.krd
            </a>
         </div>
       </div>
</div>
</section>
</div>
<script>
$(document).ready(function() {
  function initMap() {
    var mapOptions = {
      center: {lat:36.190138 , lng: 44.009400 }, 
      zoom: 12
    };
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);
    var marker = new google.maps.Marker({
      position: {lat:36.190138 , lng: 44.009400 }, 
      map: map,
      title: 'Erbil City'
    });
  }

  initMap();
});
</script>
@endsection