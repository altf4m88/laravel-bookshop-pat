<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/flatly/bootstrap.min.css" integrity="undefined" crossorigin="anonymous"> --}}
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Laravel Bookshop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            @if($userRole === 'ADMIN')
                    <div class="collapse navbar-collapse" id="navbarColor01">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link @if( $page == 'HOME') active @endif" href="/home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if( $page == 'INPUT') active @endif" href="{{url('/admin/input')}}">Input</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if( $page == 'REPORT') active @endif" href="{{url('/admin/report')}}">Laporan</a>
                            </li>
                        </ul>
                        <div class="d-flex">
                            <a class="btn btn-link text-white" href="{{ url('/update-password')}}">
                                Update Password
                            </a>
                            <a class="btn btn-danger" href="{{url('/logout')}}">
                                Logout
                            </a>
                        </div>
                    </div>
            @elseif($userRole === 'MANAGER')
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link @if( $page == 'HOME') active @endif" href="{{url('/home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if( $page == 'REPORT') active @endif" href="{{url('/manager/laporan')}}">Laporan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if( $page == 'USER') active @endif" href="{{url('/manager/user')}}">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if( $page == 'SETTING') active @endif" href="{{url('/manager/setting')}}">Pengaturan</a>
                </li>
                </ul>
                <div class="d-flex">
                    <a class="btn btn-link text-white" href="{{ url('/update-password')}}">
                        Update Password
                    </a>
                    <a class="btn btn-danger" href="{{url('/logout')}}">
                        Logout
                    </a>
                </div>
            </div>
            @elseif($userRole === 'KASIR')
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home
                    <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Laporan</a>
                </li>
                </ul>
            </div>
            @endif
        </div>
    </nav>
    @yield('content')
</body>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> --}}
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.js') }}"></script>
{{-- <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.js') }}"></script> --}}
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
@yield('script')
</html>