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
  .grade-box { background: #f8f8f8; border-radius: 8px; padding: 20px; margin: 20px 0; text-align: center; }
  .grade-letter { font-size: 64px; font-weight: 800; color: #c0392b; line-height: 1; }
  .grade-status { display: inline-block; padding: 4px 16px; border-radius: 20px; font-size: 13px; font-weight: 500; margin-top: 8px; }
  .pass { background: #E1F5EE; color: #0F6E56; }
  .fail { background: #FCEBEB; color: #791F1F; }
  .scores { display: flex; justify-content: space-around; margin-top: 16px; }
  .score-item { text-align: center; }
  .score-val { font-size: 22px; font-weight: 600; color: #1a1a2e; }
  .score-label { font-size: 11px; color: #888; margin-top: 2px; }
  .footer { background: #f8f8f8; padding: 20px 32px; text-align: center; font-size: 12px; color: #aaa; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="header">
    <div class="logo-box">IST</div>
    <h1>Grade Notification</h1>
  </div>
  <div class="body">
    <p style="font-size:15px;color:#1a1a2e">Dear <strong>{{ $studentName }}</strong>,</p>
    <p style="color:#555;font-size:14px">Your grade for <strong>{{ $courseName }}</strong> has been recorded:</p>
    <div class="grade-box">
      <div class="grade-letter">{{ $letterGrade }}</div>
      <div>
        <span class="grade-status {{ $status }}">{{ ucfirst($status) }}</span>
      </div>
      <div class="scores">
        <div class="score-item"><div class="score-val">{{ $midterm }}</div><div class="score-label">Midterm</div></div>
        <div class="score-item"><div class="score-val">{{ $final }}</div><div class="score-label">Final</div></div>
        <div class="score-item"><div class="score-val">{{ $total }}</div><div class="score-label">Total</div></div>
      </div>
    </div>
    <p style="color:#555;font-size:13px">Log in to your portal to view all your grades.</p>
  </div>
  <div class="footer">
    &copy; {{ date('Y') }} IST System — Institute of Software Technologies
  </div>
</div>
</body>
</html>