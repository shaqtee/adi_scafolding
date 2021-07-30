<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('images/brand/aplikasi.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link href="{{ asset('packages/sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('packages/sbadmin2/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @include('layouts.public.css')
    @yield('css')
</head>
<body id="page-top" style="background-color:#1F1F1F;">
    @yield('public_content')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('packages/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('packages/sbadmin2/js/sb-admin-2.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        let formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
            //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
        });
    </script>
    <script>
        let cekses = @php echo json_encode(session()->get('myWishlist')) @endphp || "";
        $('.countWishlist').html(cekses.length);
        /* Display Cart */
        let countCart = @php echo json_encode(session()->get('myCart'));@endphp || "";
        $('.countCart').html(countCart.length);
    </script>
    <!-- End Scripts-->

    @yield('js')

    <!-- Ongkir -->
    <script>
        $('select[name="province_origin"]').on('change', function() {
            let provinceId = $(this).val();

            if(provinceId){
                jQuery.ajax({
                    url:'/api/province/'+provinceId+'/cities',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data){
                        $('select[name="city_origin"]').empty();

                        $.each(data, function(key, value){
                            $('select[name="city_origin"]').append(`<option value="${key}">${value}</option`);

                        });

                    }
                })
            }else{
                $('select[name="city_origin"]').empty();
            }



        })

        $('#city_destination').select2({
            ajax:{
                url:'/api/cities',
                type: 'post',
                dataType: 'JSON',
                delay: 150,
                data: function(data){
                    return {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        search: $.trim(data.term)
                    }
                },
                processResults: function(response){

                    return {
                        results: response
                    }
                },
                cache:true
            }
        })
    </script>
    <!-- End Ongkir -->
</body>
</html>
