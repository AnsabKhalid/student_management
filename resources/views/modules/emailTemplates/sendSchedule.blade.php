
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('public/css/adminlte.css')}}">
    <style>
        .email-container{
            width: 600px;
            margin: auto;
        }
        .greeting{
            text-align: center;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }
        table{
            border: 1px solid black;
        }
        thead tr th{
            background-color: #0c84ff;
            border: 1px solid black;
        }
        tr,td{
            border: 1px solid black;
            padding: 10px;
        }

    </style>
</head>
<body>
<div class="email-container">
     <img src="https://aceeducation.com.my/wp-content/uploads/2020/08/cropped-cropped-ACE-EDUCATION-2-2.png">
    <div class="greeting text-center">
        <h3 class="text-center">Dear {{ $data['classData'][0]['studentName'] }}</h3>
        <br>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center" style="text-align: center">
                    <h3 class="card-title text-center" style="text-align: center">Schedule</h3>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Teacher Name</th>
                            <th>Mode of Class</th>
                            <th>classDuration</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['classData'] as $classdata)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $classdata->subject }}</td>
                                <td>{{ date('d-M-y',strtotime($classdata->classDate)) }}</td>
                                <td>{{ date('h:i A',strtotime($classdata->classTime)) }}</td>
                                <td>{{ $classdata->teacherName }}</td>
                                <td>{{ $classdata->modeOfClass }}</td>
                                <td>{{ $classdata->classDuration }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
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




