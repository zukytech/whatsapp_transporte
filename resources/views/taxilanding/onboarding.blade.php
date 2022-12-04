<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('global.site_name','FindMeTaxi') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor') }}/tailwind/tailwind.min.css">


    <!-- Google Analitics -->
    @include('layouts.ga')
    @yield('head')
    @laravelPWA
    
    <!-- RTL and Commmon ( Phone ) -->
    @include('layouts.rtl')

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <!-- Custom CSS defined by admin -->
    <link type="text/css" href="{{ asset('byadmin') }}/front.css" rel="stylesheet">

    <style>
        .modal {
          transition: opacity 0.25s ease;
        }
        body.modal-active {
          overflow-x: hidden;
          overflow-y: visible !important;
        }
      </style>
    
</head>
<body class="landing-page">

   
    @include('taxilanding.onboard.header')
    @include('taxilanding.onboard.pricing')
    @include('taxilanding.onboard.faq')
    @include('taxilanding.partials.footer')

    <!-- AlpineJS Library -->
    <script src="{{ asset('vendor') }}/alpine/alpine.js"></script>
    
    <!--   Core JS Files   -->
    <script src="{{ asset('vendor') }}/jquery/jquery.min.js" type="text/javascript"></script>
 

    <!-- All in one -->
    <script src="{{ asset('custom') }}/js/js.js?id={{ config('config.version')}}s"></script>

    <!-- Custom JS defined by admin -->
    <?php echo file_get_contents(base_path('public/byadmin/front.js')) ?>

    <!-- Google Map -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&key=<?php echo config('settings.google_maps_api_key'); ?>&libraries=places&callback=js.initializeGoogle"></script>


    <script>

        function selectDriver(index){
            var theDriver=drivers[index];
            $('#driver_id').val(theDriver.id);
            $('#selectedDriverName').html(theDriver.name);
            $('#selectedDriverTime').html(theDriver.duration_text);
            $('#selectedDriverCost').html(theDriver.ride_cost_formated);
        }
        window.onload = function () {
            
        $('#requstRideButton').on('click',function () {
            $( "#form-request-driver" ).submit();
        });
            
    
        $('#termsCheckBox').on('click',function () {
            $('#submitRegister').prop("disabled", !$("#termsCheckBox").prop("checked"));
            if(this.checked){
                $('#submitRegister').addClass('opacity-100');
            }else{
                $('#submitRegister').removeClass('opacity-100');
                 
            }
           
        })

        $("#search_location").on("click",function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = { lat: position.coords.latitude, lng: position.coords.longitude };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type:'POST',
                        url: '/search/location',
                        dataType: 'json',
                        data: {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        },
                        success:function(response){
                            if(response.status){
                                $("#txtstartlocation").val(response.data.formatted_address);
                            }
                        }, error: function (response) {
                        }
                    })
                    }, function() {

                    });
                } 
        });

        var inputStart = document.getElementById('txtstartlocation');
        if(inputStart){
            var autocompleteStart = new google.maps.places.Autocomplete(inputStart, {  });
            google.maps.event.addListener(autocompleteStart, 'place_changed', function () {
                var place = autocompleteStart.getPlace();
                var filled=$("#txtstartlocation").val().length>3&&$("#txtendlocation").val().length>3;
                $('#submit').prop("disabled", !filled);
               
                if(filled){
                    $('#submit').removeClass('opacity-50');
                    $('#submit').addClass('opacity-100')
                }

            });
        }

        var inputEnd = document.getElementById('txtendlocation');
        if(inputEnd){
            var autocompleteEnd = new google.maps.places.Autocomplete(inputEnd, {  });
            google.maps.event.addListener(autocompleteEnd, 'place_changed', function () {
                var place = autocompleteEnd.getPlace();
                var filled=$("#txtstartlocation").val().length>3&&$("#txtendlocation").val().length>3;
                $('#submit').prop("disabled", !filled);
                if(filled){
                    $('#submit').removeClass('opacity-50');
                    $('#submit').addClass('opacity-100')
                }
                
            });
        }
    }
    </script>

<script>
    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
    	event.preventDefault()
    	toggleModal()
      })
    }
    
    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)
    
    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }
    
    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
    	isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
    	isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
    	toggleModal()
      }
    };
    
    
    function toggleModal () {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
    
     
  </script>


</body>
</html>