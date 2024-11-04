<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course Enrollment Notification</title>
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

    <p>We are excited to inform you that a new user has enrolled in your course, <strong>{{ $course->title }}</strong>!
      🎉</p>

    <h3>Enrollment Details:</h3>
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

    <h3>What You Can Do:</h3>
    <ol>
      <li><strong>Welcome the New Student:</strong> Consider sending a personal welcome message to make them feel
        valued.</li>
      <li><strong>Engage with Your Students:</strong> Check the course forum or discussion boards to interact with your
        learners.</li>
      <li><strong>Prepare Course Materials:</strong> Ensure that all necessary resources are ready for an engaging
        learning experience.</li>
    </ol>

    <p>If you have any questions or need support, feel free to reach out to our team at <a
        href="mailto:pmostafaie1390@gmail.com">pmostafaie1390@gmail.com</a> or visit our help center at <a
        href="{{ $url = url('/') }}" target="_blank">{{ $url }}</a>.</p>

    <p class="footer">Thank you for your dedication and passion in teaching! We’re thrilled to have you as part of our
      community.</p>

    <p class="footer">Best Regards,<br>Parsa Mostafaie,<br>Developer,<br>{{ config('app.name', 'Laravel') }}<br></p>
  </div>

</body>

</html>
