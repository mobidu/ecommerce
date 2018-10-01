@if(auth()->guard('customer')->check())
    <ul class="list-group hidden-print">
        <li class="list-group-item active">MENU CUSTOMER</li>
        <a href="{{url('/profil')}}" class="list-group-item"><span class="fa fa-user"></span>&nbsp;&nbsp;Profil</a>
        <a href="{{url('/order')}}" class="list-group-item"><span class="fa fa-cart-arrow-down"></span>&nbsp;&nbsp;Order</a>
        <a href="{{url('/affiliate')}}" class="list-group-item"><span class="fa fa-users"></span>&nbsp;&nbsp;Affiliate</a>
        {{--<li><a href="#" class="">Profil</a></li>--}}
    </ul>
@endif
<div class="panel panel-primary hidden-print">
    <div class="panel-heading">KATEGORI</div>
        <div class="panel-body">
            <ul class="nav">
                @foreach ($kategori as $k)
                    <li><a href="{{ url('/kategori/' . $k->slug) }}" class="text-capitalize"> {{ $k->nama_kategori }} <span class="fa fa-arrow-circle-right pull-right"></span></a></li>
                @endforeach
            </ul>
        </div>
</div>

<div class="panel panel-primary hidden-print">
    <div class="panel-heading">
        <h3 class="panel-title">TESTIMONI</h3>
    </div>
    <div class="panel-body">
        <div id="testimoni" class="carousel slide">
            <!-- Indicators -->     
            <div class="carousel-inner">
                @foreach ($testimoni as $testi)           
                <div class="item {{ $testi->id == 1 ? 'active':'' }}">
                    <p style="text-align: justify;">{{ $testi->pesan }}</p>
                    <p class="text-center">::..::..::</p>
                    <small><b>{{ $testi->nama }}</b>
                        <i>({{ str_limit($testi->no_hp, 9) }})</i>
                    </small>
                </div>
                @endforeach
                <hr>
                <div class="pull-right">
                    <a href="{{ url('/testimoni') }}"><b>Testimoni Lengkap</b></a>
                </div>               
            </div> 
            
        </div><!-- End Carousel -->
    </div>
</div>

<div class="panel panel-primary hidden-print">
    <div class="panel-heading">
        <h3 class="panel-title">PEMBAYARAN</h3>
    </div>
    <div class="panel-body">
        @foreach ($bank as $b)
            <img src="{{ asset('/img/'.$b->provider->logo) }}" class="img-responsive center-block" width="150px" height="150px">
            <p class="text-center">No Rekening : {{ $b->no_rekening }}</p>
            <p class="text-center">Atas Nama : <strong>{{ $b->nama_pemilik }}</strong></p>
        @endforeach
    </div>
</div>