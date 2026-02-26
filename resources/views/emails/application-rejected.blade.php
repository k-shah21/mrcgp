<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status Update</title>
    <style>
        body { 
            margin: 0; 
            padding: 0; 
            background-color: #f1f5f9; 
            font-family: 'Segoe UI', Arial, sans-serif; 
        }
        .wrapper { 
            max-width: 600px; 
            margin: 60px auto; 
        }
        .card { 
            background: #ffffff; 
            border-radius: 16px; 
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .header { 
            background: linear-gradient(135deg, #475569 0%, #1e293b 100%);
            padding: 40px;
            text-align: center;
        }
        .header h1 { 
            color: #ffffff; 
            margin: 0; 
            font-size: 20px; 
            font-weight: 600;
        }
        .body { 
            padding: 40px; 
            text-align: center;
        }
        .message { 
            font-size: 15px; 
            color: #475569; 
            line-height: 1.7; 
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="card">
        <div class="header">
            <h1>{{ $application->usualForename }} {{ $application->lastName }}</h1>
            </div>

        <div class="body">
            <p class="message">
                {{ $application->admin_message }}
            </p>
        </div>
    </div>
</div>

</body>
</html>