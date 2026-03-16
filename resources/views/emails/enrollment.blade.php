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
  .course-card { background: #f8f8f8; border-left: 4px solid #c0392b; border-radius: 0 8px 8px 0; padding: 20px; margin: 20px 0; }
  .course-name { font-size: 18px; font-weight: 600; color: #1a1a2e; margin-bottom: 8px; }
  .course-code { font-size: 12px; color: #c0392b; font-weight: 600; margin-bottom: 12px; }
  .detail { font-size: 13px; color: #555; margin: 4px 0; }
  .footer { background: #f8f8f8; padding: 20px 32px; text-align: center; font-size: 12px; color: #aaa; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="header">
    <div class="logo-box">IST</div>
    <h1>Enrollment Confirmation</h1>
  </div>
  <div class="body">
    <p style="font-size:15px;color:#1a1a2e">Dear <strong>{{ $studentName }}</strong>,</p>
    <p style="color:#555;font-size:14px;line-height:1.6">
      You have been successfully enrolled in the following course:
    </p>
    <div class="course-card">
      <div class="course-code">{{ $courseCode }}</div>
      <div class="course-name">{{ $courseName }}</div>
      <div class="detail">Instructor: {{ $instructor }}</div>
      <div class="detail">Schedule: {{ $schedule }}</div>
    </div>
    <p style="color:#555;font-size:13px">Log in to your student portal to view your full course list.</p>
  </div>
  <div class="footer">
    &copy; {{ date('Y') }} IST System — Institute of Software Technologies
  </div>
</div>
</body>
</html>