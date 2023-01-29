@extends("home.layout.master")
@section('content')

<section id="counter" style="padding: 2rem 3rem">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-wrapper">
                    {{--<img src="{{ url('assets/img/bg/counter-bg.png') }}" style="width: 100%;">--}}

                    {{--<h2 class="product-title">Accede a tu cuenta</h2>
                    
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('home')}}">
                                <i class="ti-home"></i> Inicio
                            </a>
                        </li>

                        <li class="current">Accede a tu cuenta</li>
                    </ol>--}}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="find-job section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1 class="color">Accede a tu cuenta</h1>
                <div class="my-account-login">
                    @if(Session::has("mensaje_login"))
                        <div class="" id="mensaje-resultado">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                {{ Session::get("mensaje_login") }}
                            </div>
                        </div>
                    @endif

                    @if(Session::has("mensaje_error"))
                        <div class="" id="mensaje-resultado">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                
                                {{ Session::get("mensaje_error") }}
                            </div>
                        </div>
                    @endif

                    {!! Form::open(['route' => 'admin.login_post']) !!}
                        {{-- {!! csrf_field() !!} --}}
                        @if(route("home") =="http://komatsu.t3rsc.co" || route("home") =="https://komatsu.t3rsc.co" ||
                            route("home") =="https://demo.t3rsc.co")
                            <input type="hidden" name="ruta" value=""> 
                        @endif

                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            
                            {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email', 'value' => old('email')]) !!}

                            <p class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</p>
                        </div>

                        <div class="form-group">
                            <label for="password" class="sr-only">Contraseña</label>
                            
                            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Contraseña']) !!}
                            
                            <p class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</p>
                        </div>
                        
                        <div class="">
                            {!! Form::submit('Iniciar Sesión', ['class' => 'btn btn-common btn-rm', 'id' => 'iniciar-sesion']) !!}
                        </div>

                        <article>
                            <p class="t2 text-center olvidastes-t3">
                                <a href="{{ route('admin.olvido_contrasena') }}">¿Olvidaste la contraseña?</a>
                            </p>
                        </article>
                    {!! Form::close() !!}
                </div>

                <div class="widget hidden">
                    <div class="bottom-social-icons social-icon"> 
                        <div class="row">
                            <div class="col-md-4">
                                <a class="linkedin" href="{{ route('social.auth', 'linkedin') }}">
                                    Ingresa con <i class="ti-linkedin"></i>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a class="google-plus" href="{{ route('social.auth', 'google') }}">
                                    Ingresa con <i class="ti-google"></i>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <a class="facebook" href="{{ route('social.auth', 'facebook') }}">
                                    Ingresa con <i class="ti-facebook"></i>
                                </a>
                            </div>
                        </div>                 
                    </div>  
                </div>
            </div>

        <div class="col-md-3"></div>
    </div>
</div>
</section>
@stop()