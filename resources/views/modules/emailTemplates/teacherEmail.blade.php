<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .email-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .greeting {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .message {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <img src="https://aceeducation.com.my/wp-content/uploads/2020/08/cropped-cropped-ACE-EDUCATION-2-2.png">
    <div class="greeting">
        <h3>Dear {{ $data['teacherData']->teacherName }}</h3>
        <br>
    </div>
    <div class="message">
        <h4>{{ $data['message'] }}</h4>
    </div>
    <div class="footer">
        <h5>Thank You</h5>
        <h6>Timely Attendance: Both students and tutors are expected to arrive on time for their scheduled classes. Any delay in attendance must be communicated in advance.<br>
            Cancellation Policy: Students who wish to cancel a class must give at least 24 hours' notice prior to the scheduled class time. Tutors are required to give advance notice if they need to cancel a class. Last-minute cancellations are allowed only in case of emergencies, and students and tutors must give at least 4 hours' notice.<br>
            Rescheduling: Missed or cancelled classes must be rescheduled within 3 days. Tutors and students may arrange a suitable time or request ACE Education to help. Rescheduled class must be held within the same week.
        <br><br>Should you have any inquiries, please feel free to contact us via WhatsApp without any hesitation. We would be more than happy to assist you with any questions or concerns you may have then Click the below whatsapp button. Thank You :)</h6>
        <a href="https://wa.me/message/GEW4NFXRCLP3G1"><img src="https://aceeducation.com.my/whatsapp.png" width="250" height="60"></a>
        
    </div>
</div>
</body>
</html>


