@extends('app.base')

@section('content')
    <section style="min-height: 76.1vh">
      <div class="container h-100 mb-5">
        <div class="h-100">
          <form action="{{ url('loginAction') }}" method="POST">
            @csrf
            <div style="width: 60%;margin: 0 auto;">
              <div class="card" style="border-radius: 1rem">
                <div class="card-body p-5 text-center">
                  <div class="pb-2">
                    <h2 class="fw-bold mb-2">Login</h2>
                    <p class="mb-5">
                      Please enter your username or register now. You can also do not fill it out to enter as
                      anonymous
                    </p>
                    @error('incorrectUsername')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-outline form-white">
                      <input required name="username" type="text" class="form-control form-control-lg" value="{{ old('username') }}"/>
                      <label class="form-label mt-2" for="username">Username</label>
                    </div>
                  </div>
    
                  <input
                    class="btn btn-outline-primary btn-lg px-5 mb-3 mt-3"
                    type="submit" value="login"
                  >
                  </input>
    
                  <div>
                    <p class="mb-0">
                      Don't have an account?
                      <a href="{{ url('user/create') }}" class="fw-bold">Sign Up</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
@endsection
@section('styles')
    <style>
        section{
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection