@extends('layouts.content')
@section('content')
<div class="container-fluid bg-d  pb-5">
<section class="row bg--primay">
    <div class="container-fluid position-relative" >
        <div class="px-4 pb-5" style="min-height: 400px;">
        <div >
            <picture>
                <source srcset="{{asset('asset/img/about-top.png')}}" media="(max-width: 576px)">
                <source srcset="{{asset('asset/img/about-top.png')}}" media="(max-width: 768px)">
                <source srcset="{{asset('asset/img/about-top.png')}}" media="(max-width: 992px)">
                <source srcset="{{asset('asset/img/about-top.png')}}" media="(max-width: 1200px)">
                <source srcset="{{asset('asset/img/about-top.png')}}" media="(max-width: 1400px)">
                <source srcset="{{asset('asset/img/about-top.png')}}" media="(min-width: 1400px)">
                <img src="{{asset('asset/img/about-top.png')}}" class="w-100"  alt="Responsive image">
            </picture>
        <div>
            <div class="text-center position-absolute  start-50 translate-middle" style="bottom: 70px;">
                <h1 class=" m-auto" style="font-weight: 700;font-size: 60px;line-height: 73px;text-align: center;letter-spacing: 0.06em;color: #FFFFFF;">Powering your events so <br> you can grow</h1>
            </div>
            <div class="mt-3">
            <button class="btn--secondary mx-3 position-absolute p-3 px-4 top-100 start-50 translate-middle">
            Download for free
            </button>
            </div>
 
        </div>
        </div>
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
    <div class="row text-center text-white py-5">
        <div class="col-md-4">
          <h3 class="pt-5 pb-1" style="font-weight: 700;font-size: 18px;line-height: 50px;">Check Any Detail Of Events</h3>
          <img src="{{asset('asset/img/line2.png')}}"     alt="Responsive image" class="pb-5">
          <p class="p-about">
          Connecting people with events, live musics, concerts, activities and parties.
          </p>
          <p  class="p-about">
          People can see the events around them and they can check and see all the event types.
          </p>
        </div>
        <div class="col-md-4">
          <h3 class="pt-5 pb-1" style="font-weight: 700;font-size: 18px;line-height: 50px;">Discover The Best Events</h3>
          <img src="{{asset('asset/img/line2.png')}}"     alt="Responsive image" class="pb-5">
          <p  class="p-about">
          Freelancers can have their profile and details about their business and publish, from this way they can be found easily by the event hostess and even by normal people who would like to make small parties with families and friends.
          </p>
        </div>
        <div class="col-md-4">
          <h3 class="pt-5 pb-1" style="font-weight: 700;font-size: 18px;line-height: 50px;">Get More Audiences</h3>
          <img src="{{asset('asset/img/line2.png')}}"     alt="Responsive image" class="pb-5">
          <p  class="p-about">
          The hoster can get more clients to their events.
          </p>
          <p  class="p-about">
          Artists can share their profile with their contacts and social media profiles.
          </p>
          <p  class="p-about">
          The service company can make their promotions.
          </p>
        </div>
    </div>
    </div>
</section>
<section>
<div class="container py-5 text-center">
<img src="{{asset('asset/img/about-vector.png')}}" alt="Responsive image" width="50px">
</div>
</section>
<section>
    <div class="container pb-5">
    <h2 class="text-center py-5" style="font-weight: 700;font-size: 45px;line-height: 26px;color: #7E6EF6;">Why Eventy?</h2>
    <p class="py-1" style="font-weight: 400;font-size: 20px;line-height: 33px;color: #F2EEEE;">
    One of the main problems in the region for the people is to find a place to spend time with friends and families.
    </p>
    <p class="py-1" style="font-weight: 400;font-size: 20px;line-height: 33px;color: #F2EEEE;">
    Usually, it takes a long time to find such a place. People are using social media and they are checking restaurant by restaurant pages to see if any of them has any events.
    </p>
    <p class="py-1" style="font-weight: 400;font-size: 20px;line-height: 33px;color: #F2EEEE;">
    Sometimes people regret the event they went to there. Because they did not have enough information about the place, or the quality of the hoster is very low or their price is very high.
    </p>
    </div>
</section>
</div>
@endsection