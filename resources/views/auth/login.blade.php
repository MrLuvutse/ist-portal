<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IST System — Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', sans-serif; }
        .login-card { background: #fff; border-radius: 12px; width: 420px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.4); }
        .login-header { background: #1a1a2e; padding: 32px; text-align: center; }
        .ist-logo { width: 52px; height: 52px; background: #c0392b; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; font-weight: 700; margin: 0 auto 12px; }
        .login-header h4 { color: #fff; margin: 0; font-weight: 600; }
        .login-header p { color: #aaa; font-size: 12px; margin: 4px 0 0; }
        .login-body { padding: 32px; }
        .role-tabs { display: grid; grid-template-columns: 1fr 1fr; border: 1px solid #e0e0e0; border-radius: 6px; overflow: hidden; margin-bottom: 24px; }
        .role-tab { padding: 10px; text-align: center; font-size: 13px; cursor: pointer; background: #f8f8f8; color: #666; border: none; transition: all .2s; }
        .role-tab.active { background: #c0392b; color: #fff; }
        .form-label { font-size: 12px; font-weight: 500; color: #555; }
        .form-control { font-size: 13px; border-color: #e0e0e0; }
        .form-control:focus { border-color: #c0392b; box-shadow: 0 0 0 3px rgba(192,57,43,0.1); }
        .ist-btn-login { width: 100%; padding: 12px; background: #c0392b; color: #fff; border: none; border-radius: 6px; font-size: 14px; font-weight: 500; margin-top: 8px; }
        .ist-btn-login:hover { background: #a93226; }
        .demo-hints { margin-top: 20px; padding: 12px; background: #f8f8f8; border-radius: 8px; font-size: 11px; color: #888; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="ist-logo">IST</div>
            <h4>IST System</h4>
            <p>Institute of Software Technologies</p>
        </div>
        <div class="login-body">
            <div class="role-tabs">
                <button class="role-tab active" id="tab-student" onclick="setRole('student')">Student Portal</button>
                <button class="role-tab" id="tab-admin" onclick="setRole('admin')">Admin Portal</button>
            </div>

            @if($errors->any())
                <div class="alert alert-danger py-2" style="font-size:13px">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control"
                        placeholder="Enter your password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember">
                    <label class="form-check-label" for="remember" style="font-size:13px">Remember me</label>
                </div>
                <button type="submit" class="ist-btn-login">Sign In</button>
            </form>

            <div class="demo-hints">
                <strong>Demo credentials:</strong><br>
                Admin: admin@ist.com / password<br>
                Student: student@ist.com / password
            </div>
        </div>
    </div>
    <script>
        function setRole(role) {
            document.getElementById('tab-student').classList.toggle('active', role === 'student');
            document.getElementById('tab-admin').classList.toggle('active', role === 'admin');
        }
    </script>
</body>
</html>