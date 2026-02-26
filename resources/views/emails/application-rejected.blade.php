<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Rejected</title>
    <style>
        body { 
            margin: 0; 
            padding: 0; 
            background-color: #f1f5f9; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        }
        .container { 
            max-width: 600px; 
            margin: 40px auto; 
        }
        .card { 
            background: #ffffff; 
            border-radius: 12px; 
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        .header { 
            background: linear-gradient(135deg, #475569 0%, #1e293b 100%);
            padding: 32px;
            text-align: center;
        }
        .header h1 { 
            color: #ffffff; 
            margin: 0; 
            font-size: 22px; 
            font-weight: 600;
        }
        .header p {
            color: rgba(255,255,255,0.8);
            font-size: 14px;
            margin-top: 4px;
        }
        .body { 
            padding: 32px; 
        }
        .greeting {
            font-size: 16px;
            color: #1e293b;
            margin-bottom: 20px;
        }
        .message { 
            font-size: 14px; 
            color: #475569; 
            line-height: 1.7; 
        }
        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background-color: #fee2e2;
            color: #991b1b;
        }
        .reason-box {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 16px;
            margin-top: 20px;
        }
        .reason-label {
            font-size: 12px;
            color: #991b1b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .reason-text {
            font-size: 14px;
            color: #334155;
            line-height: 1.6;
        }
        .footer {
            padding: 24px 32px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            color: #94a3b8;
            font-size: 12px;
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="header">
            <h1>MRCGP [INT] South Asia</h1>
            <p>Application Status Update</p>
            </div>

        <div class="body">
            <p class="greeting">
                Dear {{ $application->usualForename ?? $application->fullName }},
            </p>

            <p class="message">
                We regret to inform you that your application for the MRCGP [INT] South Asia AKT Examination has been reviewed and could
                not be approved at this time.
                </p>
                
                <p style="margin-top: 20px;">
                    <strong style="font-size: 13px; color: #64748b;">Current Status:</strong><br>
                    <span class="status-badge">Rejected</span>
                </p>
                
                @if($application->rejection_reason)
                    <div class="reason-box">
                        <p class="reason-label">Reason for Rejection</p>
                        <p class="reason-text">{{ $application->rejection_reason }}</p>
                    </div>
                @endif
                
                <p class="message" style="margin-top: 24px;">
                    If you believe this decision was made in error, or if you have questions regarding your application, please do not
                    hesitate to contact us.
            </p>
        </div>
<div class="footer">
    <p>&copy; {{ date('Y') }} MRCGP International South Asia. All rights reserved.</p>
</div>
    </div>
</div>

</body>
</html>