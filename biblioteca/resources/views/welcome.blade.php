@extends('layouts.app')

@section('title', 'Sistema de Empréstimos')

@section('sidebar')
    @parent
@endsection

@section('content')
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('loans.index') }}">Empréstimos</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('users.index') }}">Usuários</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ route('work.index') }}">Obras</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end">
                        <h1 class="text-uppercase text-white font-weight-bold">Biblioteca - Sistema de Empréstimos</h1>
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-5">Sistema de Gerenciamento de Empréstimos, Usuários e Obras</p>
                    </div>
                </div>
            </div>
        </header>
@endsection