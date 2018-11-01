<!-- Fixed navbar -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('/testimoni') }}">Testimoni</a></li>
                <li><a href="{{url('/p/cara-belanja')}}">Cara Belanja</a></li>
                <li><a href="{{url('/p/metode-pembayaran')}}">Metode Pembayaran</a></li>
                <li><a href="{{ url('/konfirmasi-pembayaran') }}">Konfirmasi Pembayaran</a></li>
                <li><a href="{{url('/tentang')}}">Tentang Kami</a></li>
                <li><a href="{{url('/blog')}}">Blog</a></li>
                @if(auth()->guard('customer')->check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;&nbsp;{{auth()->guard('customer')->user()->nama_lengkap}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/profil')}}">Profil</a></li>
                            <li>
                                <a href="{{url('/logout')}}" onclick="event.preventDefault(); document.getElementById('customer_logout').submit()">Logout</a>
                                <form id="customer_logout" action="{{url('/logout')}}" method="post">
                                    {{csrf_field()}}
                                </form>
                            </li>

                        </ul>

                    </li>
                @else
                    <li><a href="{{url('/login')}}">Login Member</a></li>
                @endif


            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

