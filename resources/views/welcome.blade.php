<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Your Website</title>
  <!-- Enlace al archivo CSS de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link @if (old('activeTab') !== 'register' && !session()->has('errors')) active @endif" data-bs-toggle="tab" href="#login">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link @if (old('activeTab') === 'register' || session()->has('errors')) active @endif" data-bs-toggle="tab" href="#register">Register</a>
              </li>
            </ul>
          </div>
          <div class="card-body tab-content">
            <!-- Tab de Login -->
            <div class="tab-pane fade @if (!session()->has('errors') && (old('activeTab') !== 'register' && request()->input('activeTab') !== 'register')) show active @endif" id="login">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                <div class="mb-3">
                  <label for="loginEmail" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="mb-3">
                  <label for="loginPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" id="loginPassword" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
              </form>
            </div>

            <!-- Tab de Register -->
            <div class="tab-pane fade @if (old('activeTab') === 'register' || session()->has('errors')) show active @endif" id="register">
              <form action="{{ route('users.store') }}" method="post">
                @csrf <!-- Agrega el campo CSRF token -->

                <div class="mb-3">
                  <label for="registerName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                  @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                <div class="mb-3">
                  <label for="registerEmail" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') }}">
                  @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
                </div>
                <div class="mb-3">
                  <label for="registerPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
                </div>
                <div class="mb-3">
                  <label for="registerPasswordConfirmation" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" id="registerPasswordConfirmation" name="password_confirmation" placeholder="Confirm Password">
                  @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                  @endif
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Enlace al archivo JavaScript de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
