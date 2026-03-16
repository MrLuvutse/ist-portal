<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
  body { font-family: 'Segoe UI', sans-serif; background: #f4f5f7; margin: 0; padding: 0; }
  .wrapper { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 12px; overflow: hidden; }
  .header { background: #1a1a2e; padding: 32px; text-align: center; }
  .logo-box { width: 52px; height: 52px; background: #c0392b; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; font-weight: 800; margin-bottom: 12px; }
  .header h1 { color: #fff; font-size: 20px; margin: 0; }
  .header p { color: #aaa; font-size: 13px; margin: 4px 0 0; }
  .body { padding: 32px; }
  .greeting { font-size: 16px; color: #1a1a2e; margin-bottom: 16px; }
  .info-box { background: #f8f8f8; border-radius: 8px; padding: 20px; margin: 20px 0; }
  .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee; font-size: 14px; }
  .info-row:last-child { border-bottom: none; }
  .info-label { color: #888; }
  .info-val { color: #1a1a2e; font-weight: 500; }
  .btn { display: inline-block; background: #c0392b; color: #fff; padding: 12px 28px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; margin-top: 20px; }
  .footer { background: #f8f8f8; padding: 20px 32px; text-align: center; font-size: 12px; color: #aaa; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="header">
    <div class="logo-box">IST</div>
    <h1>Welcome to IST System</h1>
    <p>Institute of Software Technologies</p>
  </div>
  <div class="body">
    <p class="greeting">Dear <strong>{{ $studentName }}</strong>,</p>
    <p style="color:#555;font-size:14px;line-height:1.6">
      Your student account has been created successfully. Below are your login credentials and account details.
    </p>
    <div class="info-box">
      <div class="info-row"><span class="info-label">Student ID</span><span class="info-val">{{ $studentId }}</span></div>
      <div class="info-row"><span class="info-label">Program</span><span class="info-val">{{ $program }}</span></div>
      <div class="info-row"><span class="info-label">Email</span><span class="info-val">{{ $email }}</span></div>
      <div class="info-row"><span class="info-label">Password</span><span class="info-val">{{ $password }}</span></div>
    </div>
    <p style="color:#555;font-size:13px">Please log in and change your password as soon as possible.</p>
    <a href="http://127.0.0.1:8000/login" class="btn">Login to IST System</a>
  </div>
  <div class="footer">
    &copy; {{ date('Y') }} IST System — Institute of Software Technologies<br>
    This is an automated message, please do not reply.
  </div>
</div>
</body>
</html>