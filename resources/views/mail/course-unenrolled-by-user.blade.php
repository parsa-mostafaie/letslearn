<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Unenrollment Notification</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 20px;
      background-color: #f4f4f4;
    }

    .container {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
    }

    p {
      color: #555;
    }

    .footer {
      margin-top: 20px;
      font-size: 0.9em;
      color: #777;
    }
  </style>
</head>

<body>

  <div class="container">
    <h2>Hi {{ $course->user->name }},</h2>

    <p>We want to inform you that a user has unenrolled from your course, <strong>{{ $course->title }}</strong>.</p>

    <h3>Unenrollment Details:</h3>
    <ul>
      <li><strong>User Name:</strong> {{ $user->name }}</li>
      <li><strong>Email:</strong> {{ $user->email }}</li>
    </ul>
    
    <h3>Course Overview:</h3>
    <ul>
      <li><strong>Course Title:</strong> {{ $course->title }}</li>
      <li><strong>Start Date:</strong> {{ $course->created_at }}</li>
      <li><strong>Total Enrollments:</strong> {{ $course->total_enrollment_count }}</li>
    </ul>

    <p>We appreciate your efforts in providing valuable content and support to your students. If you have any feedback
      or would like to discuss this further, please feel free to reach out.</p>

    <h3>Next Steps:</h3>
    <p>Consider reaching out to the user to understand their experience and gather feedback that could help improve the
      course.</p>

    <p>If you have any questions or need assistance, don’t hesitate to contact our support team at <a
        href="mailto:pmostafaie1390@gmail.com">pmostafaie1390@gmail.com</a>.</p>

    <p class="footer">Thank you for your commitment to our learning community! We appreciate all that you do.</p>

    <p class="footer">Best Regards,<br>Parsa Mostafaie,<br>Developer,<br>{{ config('app.name', 'Laravel') }}<br></p>
  </div>

</body>

</html>
