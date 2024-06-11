<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Event">
    <meta name="generator" content="Event Websit">
    <meta name="googlebot" content="index">
    <meta name="robots" content="index, follow">
    <meta name="robots" content="max-image-preview:large">
    <title>Event website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{asset('asset/css/custom.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('asset/img/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('asset/img/favicon.ico') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{asset('asset/js/jquery.cookie.min.js')}}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSMwlO0-cbpGjLcSXyTJt1oxkPXLr47Yw"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
  </head>
  <body>
         <section >
         <nav class="navbar navbar-expand-lg  navbar-dark bg-dark navbar-c">
         <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand navbar-toggler" style="border: none;" href="#"><img src="{{asset('asset/img/logo.png')}}" alt="logo ManHOM" class="m-auto"></a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav   mb-2 mb-lg-0">
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/">Home</a>
               </li>
          
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Discover
                  </a>
                  <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="/parties">Parties</a></li>
                     <li><a class="dropdown-item" href="/brands">Brands</a></li>
                     <li><a class="dropdown-item" href="/hunters">Hunters</a></li>    
                  </ul>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/contact">Contact Us</a>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     More
                  </a>
                  <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/about">About US</a></li>     
                  <li><a class="dropdown-item" href="/privacy">Privacy Policy</a></li>
                  <li><a class="dropdown-item" href="/term">Terms & Conditions</a></li>
                  <li><a class="dropdown-item" href="/faqs">FAQ</a></li>             
                  </ul>
               </li>
               </ul>
               
               <img src="{{asset('asset/img/logo.png')}}" alt="logo ManHOM" class="logo-footer m-auto  m-3  pe-5 d-none d-md-block">

               <ul class="navbar-nav mb-2 mb-lg-0 ps-4  pe-4 d-none d-md-flex" >
               <li class="nav-item  me-1 d-none d-md-flex">
                  <a class="nav-link active" aria-current="page" href="https://www.facebook.com/Eventykrd-100446199635053/"  target="_blank">
                  <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 15C0 6.71573 6.71573 0 15 0H20C28.2843 0 35 6.71573 35 15V20C35 28.2843 28.2843 35 20 35H15C6.71573 35 0 28.2843 0 20V15Z" fill="#DDD9FB"/>
                  <path d="M22 15.5H19V13.5C19 13.2348 19.1054 12.9804 19.2929 12.7929C19.4804 12.6054 19.7348 12.5 20 12.5H21V10H19C18.2044 10 17.4413 10.3161 16.8787 10.8787C16.3161 11.4413 16 12.2044 16 13V15.5H14V18H16V25H19V18H21L22 15.5Z" stroke="#7E6EF6" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

                  </a>
               </li>
               <li class="nav-item  me-1">
                  <a class="nav-link" href="https://www.instagram.com/eventy.krd/"  target="_blank">
                  <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 15C0 6.71573 6.71573 0 15 0H20C28.2843 0 35 6.71573 35 15V20C35 28.2843 28.2843 35 20 35H15C6.71573 35 0 28.2843 0 20V15Z" fill="#DDD9FB"/>
                  <path d="M21.185 11H14.5963C12.6101 11 11 12.6101 11 14.5963V21.185C11 23.1712 12.6101 24.7812 14.5963 24.7812H21.185C23.1712 24.7812 24.7812 23.1712 24.7812 21.185V14.5963C24.7812 12.6101 23.1712 11 21.185 11Z" stroke="#7E6EF6" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M17.8906 21.5C19.884 21.5 21.5 19.884 21.5 17.8906C21.5 15.8972 19.884 14.2812 17.8906 14.2812C15.8972 14.2812 14.2812 15.8972 14.2812 17.8906C14.2812 19.884 15.8972 21.5 17.8906 21.5Z" stroke="#7E6EF6" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M21.8281 13.625C22.0093 13.625 22.1562 13.4781 22.1562 13.2969C22.1562 13.1157 22.0093 12.9688 21.8281 12.9688C21.6469 12.9688 21.5 13.1157 21.5 13.2969C21.5 13.4781 21.6469 13.625 21.8281 13.625Z" stroke="#7E6EF6" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  </a>
               </li>
               <li class="nav-item  me-1">
                  <a class="nav-link" href="mailto:info@eventy.krd">
                  <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 15C0 6.71573 6.71573 0 15 0H20C28.2843 0 35 6.71573 35 15V20C35 28.2843 28.2843 35 20 35H15C6.71573 35 0 28.2843 0 20V15Z" fill="#DDD9FB"/>
                  <path d="M24.625 12H10.375C10.1687 12 10 12.1687 10 12.375V21.75C10 21.9563 10.1687 22.125 10.375 22.125H24.625C24.8313 22.125 25 21.9563 25 21.75V12.375C25 12.1687 24.8313 12 24.625 12ZM23.725 12.75L17.5 18.975L11.275 12.75H23.725ZM10.75 13.275L14.5375 17.0625L10.75 20.85V13.275ZM11.2937 21.375L15.0625 17.6063L17.2375 19.7812C17.3875 19.9313 17.6125 19.9313 17.7625 19.7812L19.9375 17.6063L23.7062 21.375H11.2937ZM24.25 20.85L20.4625 17.0625L24.25 13.275V20.85Z" fill="#7E6EF6"/>
                  </svg>

                  </a>
               </li>
               <li class="nav-item  me-1">
                  <a class="nav-link" href="tel:009647507680176" >
                  <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 15C0 6.71573 6.71573 0 15 0H20C28.2843 0 35 6.71573 35 15V20C35 28.2843 28.2843 35 20 35H15C6.71573 35 0 28.2843 0 20V15Z" fill="#DDD9FB"/>
                  <path d="M13.426 11.2452C13.3706 11.174 13.3008 11.1154 13.221 11.0733C13.1413 11.0312 13.0535 11.0065 12.9635 11.001C12.8735 10.9954 12.7834 11.009 12.699 11.0409C12.6147 11.0729 12.5381 11.1224 12.4744 11.1862L11.5051 12.1565C11.0523 12.6102 10.8854 13.2524 11.0832 13.8158C11.9042 16.1478 13.2397 18.2651 14.9906 20.0106C16.7361 21.7615 18.8534 23.097 21.1854 23.918C21.7488 24.1158 22.391 23.9489 22.8447 23.4961L23.8141 22.5268C23.8779 22.463 23.9274 22.3865 23.9593 22.3021C23.9913 22.2178 24.0049 22.1277 23.9993 22.0377C23.9937 21.9477 23.969 21.8599 23.9269 21.7802C23.8848 21.7004 23.8262 21.6306 23.755 21.5752L21.5923 19.8934C21.5162 19.8344 21.4277 19.7935 21.3336 19.7737C21.2394 19.7538 21.1419 19.7557 21.0485 19.779L18.9955 20.2918C18.7214 20.3603 18.4343 20.3567 18.1621 20.2813C17.8899 20.2059 17.6418 20.0613 17.4421 19.8615L15.1397 17.5582C14.9398 17.3585 14.795 17.1105 14.7194 16.8383C14.6438 16.5661 14.64 16.2789 14.7084 16.0048L15.2222 13.9517C15.2455 13.8583 15.2473 13.7609 15.2275 13.6667C15.2077 13.5725 15.1668 13.484 15.1078 13.408L13.426 11.2452ZM11.7666 10.4793C11.9307 10.3152 12.1278 10.1879 12.3448 10.1058C12.5618 10.0237 12.7939 9.98872 13.0255 10.0032C13.257 10.0176 13.4829 10.0812 13.6881 10.1896C13.8932 10.2981 14.0729 10.4489 14.2153 10.6321L15.8971 12.7939C16.2056 13.1905 16.3143 13.707 16.1924 14.1945L15.6796 16.2476C15.6531 16.3539 15.6546 16.4653 15.6838 16.5709C15.713 16.6765 15.7691 16.7728 15.8465 16.8504L18.1499 19.1537C18.2275 19.2313 18.324 19.2875 18.4298 19.3167C18.5356 19.3459 18.6471 19.3473 18.7536 19.3206L20.8057 18.8078C21.0463 18.7477 21.2974 18.743 21.54 18.7942C21.7827 18.8453 22.0105 18.951 22.2063 19.1031L24.3681 20.7849C25.1453 21.3896 25.2165 22.538 24.5209 23.2327L23.5516 24.202C22.8579 24.8957 21.821 25.2004 20.8545 24.8601C18.3807 23.9897 16.1346 22.5735 14.2828 20.7165C12.4259 18.865 11.0097 16.6192 10.1392 14.1458C9.79982 13.1802 10.1045 12.1424 10.7982 11.4487L11.7676 10.4793H11.7666Z" fill="#7E6EF6"/>
                  </svg>

                  </a>
               </li>
               <li class="nav-item" >
                  <a class="nav-link" href="https://eventy.krd/">
                  <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 15C0 6.71573 6.71573 0 15 0H20C28.2843 0 35 6.71573 35 15V20C35 28.2843 28.2843 35 20 35H15C6.71573 35 0 28.2843 0 20V15Z" fill="#DDD9FB"/>
                  <path d="M18 10C15.8783 10 13.8434 10.8429 12.3431 12.3431C10.8429 13.8434 10 15.8783 10 18C10 20.1217 10.8429 22.1566 12.3431 23.6569C13.8434 25.1571 15.8783 26 18 26C20.1217 26 22.1566 25.1571 23.6569 23.6569C25.1571 22.1566 26 20.1217 26 18C26 15.8783 25.1571 13.8434 23.6569 12.3431C22.1566 10.8429 20.1217 10 18 10ZM10.9867 18.6044H13.2178C13.2533 19.4133 13.3662 20.2169 13.5556 21.0044H11.6356C11.2775 20.2497 11.0577 19.4368 10.9867 18.6044ZM18.6044 13.8044V11.0578C19.4611 11.3833 20.1649 12.0174 20.5778 12.8356C20.76 13.144 20.9209 13.4649 21.0578 13.7956L18.6044 13.8044ZM21.4667 15.0044C21.6729 15.7893 21.7956 16.5938 21.8311 17.4044H18.6044V15.0044H21.4667ZM17.3956 11.0578V13.8044H14.9422C15.0793 13.4735 15.2397 13.1527 15.4222 12.8444C15.8333 12.023 16.5374 11.3855 17.3956 11.0578ZM17.3956 15.0044V17.4044H14.1778C14.2133 16.5938 14.336 15.7893 14.5422 15.0044H17.3956ZM13.2178 17.3956H10.9867C11.0577 16.5632 11.2775 15.7503 11.6356 14.9956H13.5556C13.3659 15.7828 13.2527 16.5865 13.2178 17.3956ZM14.1778 18.6044H17.3956V21.0044H14.5422C14.336 20.2196 14.2139 19.4151 14.1778 18.6044ZM17.4044 22.16V24.9067C16.5478 24.5811 15.844 23.947 15.4311 23.1289C15.2486 22.8206 15.0882 22.4998 14.9511 22.1689L17.4044 22.16ZM18.6044 24.9067V22.2044H21.0578C20.9207 22.5354 20.7603 22.8562 20.5778 23.1644C20.1649 23.9826 19.4611 24.6167 18.6044 24.9422V24.9067ZM18.6044 20.96V18.56H21.8222C21.7861 19.3707 21.664 20.1752 21.4578 20.96H18.6044ZM22.7911 18.56H25.0222C24.9511 19.3924 24.7314 20.2052 24.3733 20.96H22.4444C22.6311 20.1867 22.744 19.3982 22.7822 18.6044L22.7911 18.56ZM22.7911 17.36C22.7504 16.5656 22.6343 15.7769 22.4444 15.0044H24.3644C24.7227 15.76 24.9422 16.5724 25.0133 17.4044L22.7911 17.36ZM23.68 13.8044H22.0889C21.801 12.9958 21.3837 12.2393 20.8533 11.5644C21.9595 12.061 22.9202 12.832 23.6444 13.8044H23.68ZM15.1467 11.5644C14.6163 12.2393 14.199 12.9958 13.9111 13.8044H12.3556C13.0798 12.832 14.0405 12.061 15.1467 11.5644ZM12.3467 22.2311H13.9111C14.199 23.0397 14.6163 23.7962 15.1467 24.4711C14.0375 23.9671 13.0764 23.1866 12.3556 22.2044L12.3467 22.2311ZM20.8444 24.4711C21.3748 23.7962 21.7921 23.0397 22.08 22.2311H23.6444C22.9158 23.1905 21.9554 23.949 20.8533 24.4356L20.8444 24.4711Z" fill="#7E6EF6"/>
                  </svg>

                  </a>
               </li>
               </ul>


             
            </div>
         </div>
         </nav>

   
         </section>
