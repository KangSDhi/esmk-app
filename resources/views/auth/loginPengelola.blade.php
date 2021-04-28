@extends('auth.shared.layout')

@section('title', $title)

@section('content')
    <section class="hero is-info is-fullheight">
        <div class="hero-body">
            <div class="container">
                @if ($message = \Illuminate\Support\Facades\Session::get('error'))
                <div id="notif-message" class="columns is-centered">
                    <div class="column is-5-tablet is-4-desktop is-4-widescreen">
                        <div class="notification is-danger">
                            <button class="delete" onclick="closeFun()"></button>
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                </div>
                @endif
                <div class="columns is-centered">
                    <div class="column is-5-tablet is-4-desktop is-4-widescreen">
                        <form action="{{ route('post.loginPengelola') }}" class="box" method="post">
                            @csrf
                            <div class="field">
                                <label for="" class="label">Email</label>
                                <div class="control has-icons-left">
                                    <input type="email" name="email" class="input" required>
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <label for="" class="label">Password</label>
                                <div class="control has-icons-left">
                                    <input type="password" name="password" class="input" required>
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <button class="button is-success">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
