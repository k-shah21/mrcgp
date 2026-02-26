<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status Update</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f5f9;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            padding: 32px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            font-size: 22px;
            margin: 0;
            font-weight: 600;
        }

        .header p {
            color: rgba(255, 255, 255, 0.8);
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

        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-approved {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .message-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            margin-top: 20px;
        }

        .message-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .message-text {
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

                <p style="font-size: 14px; color: #475569; line-height: 1.6;">
                    Your application for the MRCGP [INT] South Asia AKT Examination has been updated.
                </p>

                <p style="margin-top: 20px;">
                    <strong style="font-size: 13px; color: #64748b;">Current Status:</strong><br>
                    <span class="status-badge status-{{ $application->status }}">
                        {{ ucfirst($application->status) }}
                    </span>
                </p>

                @if($application->rejection_reason)
                    <div class="message-box">
                        <p class="message-label">Reason for Rejection</p>
                        <p class="message-text">{{ $application->rejection_reason }}</p>
                    </div>
                @endif

                @if($application->candidateId)
                    <p style="font-size: 14px; color: #475569; margin-top: 20px;">
                        <strong>Your Candidate ID:</strong> {{ $application->candidateId }}
                    </p>
                @endif
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} MRCGP International South Asia. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>