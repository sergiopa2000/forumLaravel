@extends('app.base')

@section('content')
    <section class="d-flex align-items-center" style="min-height: 76.1vh;">
      <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
              <div class="card-body p-4 p-md-5">
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Registration Form</h3>
                <form action="{{ url('user') }}" method="post">
                  @csrf
                  @error('userCreateError')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  <div class="row">
                    <div class="mb-4">
                      @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                      <div class="form-outline">
                        <input required value="{{ old('name') }}" type="text" name="name" class="form-control form-control-lg" minlength="2" minlength="60"/>
                        <label class="form-label" for="name">Username</label>
                      </div>
                    </div>
                  </div>
                  <div class="row d-flex justify-content-center" style="margin-bottom: 15px;">
                    <img style="width:14%;margin-bottom: 15px;" src="https://bootdey.com/img/Content/avatar/avatar1.png" class="ml-3 rounded-circle selected" alt="User" />
                    <img style="width:14%;margin-bottom: 15px;" src="https://bootdey.com/img/Content/avatar/avatar2.png" class="ml-3 rounded-circle" alt="User" />
                    <img style="width:14%;margin-bottom: 15px;" src="https://bootdey.com/img/Content/avatar/avatar3.png" class="ml-3 rounded-circle" alt="User" />
                    <img style="width:14%;margin-bottom: 15px;" src="https://bootdey.com/img/Content/avatar/avatar4.png" class="ml-3 rounded-circle" alt="User" />
                    <img style="width:14%;margin-bottom: 15px;" src="https://bootdey.com/img/Content/avatar/avatar5.png" class="ml-3 rounded-circle" alt="User" />
                    <img style="width:14%;margin-bottom: 15px;" src="https://bootdey.com/img/Content/avatar/avatar6.png" class="ml-3 rounded-circle" alt="User" />
                    <label class="form-label" for="image">Profile Image</label>
                    <input hidden id="registerImg" type="text" name="image" value="https://bootdey.com/img/Content/avatar/avatar1.png"/>
                  </div>
                  <div class="row">
                    <div class="col-md-6 d-flex align-items-center">
                      @error('birthdate')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    
                    <div class="col-md-6 d-flex align-items-center">
                      @error('email')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4 d-flex align-items-center">
                      <div class="form-outline datepicker w-100">
                        <input required value="{{ old('birthdate') }}" type="date" name="birthdate" class="form-control form-control-lg" />
                        <label for="birthdate" class="form-label">Birthday</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <input required value="{{ old('email') }}" type="email" name="email" class="form-control form-control-lg" minlength="6" minlength="50"/>
                      <label class="form-label" for="email">Email</label>
                    </div>
                  <div class="text-center">
                    <input class="btn btn-outline-primary btn-lg w-25" type="submit" value="Register" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('styles')
  <style>
    .rounded-circle{
      cursor: pointer;
      padding: 0;
    }
    
    .selected{
      padding: 0;
      box-sizing: border-box;
      border: 6px solid #007bff;
      transition: 0.1s;
    }
  </style>
@endsection

@section('scripts')
  <script type="text/javascript" src="{{ url('assets/register-profile-image.js') }}"></script>
@endsection