<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    @yield('title')

    <meta name="description" content="Pasar E-Rakyat adalah toko online terkemuka di indonesia dengan ribuan produk trendi terbaru."/>
    <meta name="keywords" content="toko online, Toko Elektronik, Elektronik online" />
`   <meta name="robots" content="noindex,follow,noodp"/>
    <meta name="author" content="websitegratis.id">
    <meta name="generator" content="websitegratis.id">
    <link rel="canonical" href="https://websitegratis.id/" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Toko Elektronik Online Indonesia" />
    <meta property="og:description" content="Pasar E-Rakyat adalah toko online terkemuka di indonesia dengan ribuan produk trendi terbaru." />
    <meta property="og:url" content="https://websitegratis.id/" />
    <meta property="og:site_name" content="Pasar E-Rakyat" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link href='//fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/style.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="icon" href="{{ base_path() . '/storage' }}">
    <style>
        .table-borderless > tbody > tr > td,
        .table-borderless > tbody > tr > th,
        .table-borderless > tfoot > tr > td,
        .table-borderless > tfoot > tr > th,
        .table-borderless > thead > tr > td,
        .table-borderless > thead > tr > th {
            border: none;
        }
    </style>
    
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>

<body role="document">
    
    @include('includes.header')

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ ('/') }}"><img src="{{ asset('/img/logo-front.png') }}" class="img-responsive"></a>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-3">
                <div class="input-group pencarian">
                    <input type="text" class="form-control" name="cari_produk" placeholder="Cari Produk..." size="4">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
            <div class="col-md-1 pull-right">
                <a href="{{ url('/cart') }}"style="text-decoration: none;"> 
                    <img src="{{ asset('/img/shopping-cart.png') }}" class="img-responsive"> 
                </a>
            </div>
        </div>
        <div class="clearfix divider"><br></div>
    </div>

    @yield('content')

    @include('includes.footer')

    <script>
        $('#testimoni').carousel({
            interval:   3500
        });
    </script>
</body>
</html>