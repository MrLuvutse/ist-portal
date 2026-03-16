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
  .body { padding: 32px; }
  .alert-box { background: #FCEBEB; border-left: 4px solid #c0392b; border-radius: 0 8px 8px 0; padding: 16px 20px; margin: 20px 0; }
  .alert-title { font-size: 15px; font-weight: 600; color: #791F1F; margin-bottom: 6px; }
  .alert-detail { font-size: 13px; color: #A32D2D; }
  .footer { background: #f8f8f8; padding: 20px 32px; text-align: center; font-size: 12px; color: #aaa; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="header">
    <div class="logo-box">IST</div>
    <h1>Absence Notice</h1>
  </div>
  <div class="body">
    <p style="font-size:15px;color:#1a1a2e">Dear <strong>{{ $studentName }}</strong>,</p>
    <p style="color:#555;font-size:14px;line-height:1.6">
      This is to inform you that you were marked <strong>absent</strong> for the following class:
    </p>
    <div class="alert-box">
      <div class="alert-title">{{ $courseName }}</div>
      <div class="alert-detail">Date: {{ $date }}</div>
      @if($notes)
      <div class="alert-detail">Notes: {{ $notes }}</div>
      @endif
    </div>
    <p style="color:#555;font-size:13px;line-height:1.6">
      Please note that excessive absences may affect your academic standing.
      If you believe this is an error, please contact your instructor.
    </p>
  </div>
  <div class="footer">
    &copy; {{ date('Y') }} IST System — Institute of Software Technologies
  </div>
</div>
</body>
</html>