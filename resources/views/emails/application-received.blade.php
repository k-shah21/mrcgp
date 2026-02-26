<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Received</title>
    <style>
        body { margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Segoe UI', Arial, sans-serif; }
        .wrapper { max-width: 620px; margin: 40px auto; }
        .header { background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); padding: 40px 40px 32px; border-radius: 16px 16px 0 0; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 22px; font-weight: 700; letter-spacing: -0.5px; }
        .header p { color: rgba(255,255,255,0.85); margin: 8px 0 0; font-size: 14px; }
        .body { background: #fff; padding: 40px; }
        .greeting { font-size: 18px; font-weight: 600; color: #1e293b; margin-bottom: 16px; }
        .para { color: #475569; line-height: 1.7; font-size: 15px; margin-bottom: 16px; }
        .info-box { background: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #6366f1; border-radius: 8px; padding: 20px; margin: 24px 0; }
        .info-box table { width: 100%; border-collapse: collapse; }
        .info-box td { padding: 6px 0; font-size: 14px; color: #334155; }
        .info-box td:first-child { font-weight: 600; width: 45%; color: #1e293b; }
        .status-chip { display: inline-block; background: #fef3c7; color: #92400e; border-radius: 20px; padding: 4px 14px; font-size: 13px; font-weight: 600; }
        .timeline { margin: 24px 0; }
        .timeline-item { display: flex; align-items: flex-start; margin-bottom: 16px; }
        .timeline-dot { width: 28px; height: 28px; border-radius: 50%; background: #6366f1; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; flex-shrink: 0; margin-right: 14px; margin-top: 2px; }
        .timeline-text { flex: 1; font-size: 14px; color: #475569; line-height: 1.6; }
        .timeline-text strong { color: #1e293b; }
        .footer { background: #f8fafc; padding: 28px 40px; border-radius: 0 0 16px 16px; border-top: 1px solid #e2e8f0; text-align: center; }
        .footer p { color: #94a3b8; font-size: 13px; margin: 4px 0; }
        .footer a { color: #6366f1; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>✅ Application Received</h1>
        <p>South Asia MRCGP [INT] Part 1 (AKT) Examination – May 2026</p>
    </div>

    <div class="body">
        <p class="greeting">Dear {{ $application->usualForename }} {{ $application->lastName }},</p>

        <p class="para">
            Thank you for submitting your application for the <strong>South Asia MRCGP [INT] Part 1 (AKT) Examination</strong>. We are pleased to confirm that your application has been successfully received and is currently under review.
        </p>

        <div class="info-box">
            <table>
                <tr>
                    <td>Application Reference</td>
                    <td>#{{ str_pad($application->id, 6, '0', STR_PAD_LEFT) }}</td>
                </tr>
                <tr>
                    <td>Candidate Name</td>
                    <td>{{ $application->usualForename }} {{ $application->lastName }}</td>
                </tr>
                <tr>
                    <td>Registered Email</td>
                    <td>{{ $application->email }}</td>
                </tr>
                <tr>
                    <td>Exam Centre</td>
                    <td>{{ $application->examCenterPreference ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Date Submitted</td>
                    <td>{{ $application->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                <tr>
                    <td>Current Status</td>
                    <td><span class="status-chip">Pending Review</span></td>
                </tr>
            </table>
        </div>

        <p class="para">Here is what happens next:</p>

        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-dot">1</div>
                <div class="timeline-text"><strong>Document Verification</strong><br>Our team will verify all submitted documents for authenticity and completeness. This typically takes 5–10 working days.</div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot">2</div>
                <div class="timeline-text"><strong>Eligibility Assessment</strong><br>Your eligibility criteria will be assessed against the MRCGP [INT] South Asia Board requirements.</div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot">3</div>
                <div class="timeline-text"><strong>Status Notification</strong><br>You will receive an email notification once a decision has been made regarding your application.</div>
            </div>
        </div>

        <p class="para">
            If you have any questions or need to provide additional documents, please contact us at
            <a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>.
        </p>

        <p class="para" style="margin-top: 32px;">
            {!! config('mail.signature', 'Regards,<br><strong>MRCGP Admin Team</strong><br>South Asia MRCGP Application Portal') !!}
        </p>
    </div>

    <div class="footer">
        <p>This is an automated message. Please do not reply directly to this email.</p>
        <p>© {{ date('Y') }} South Asia MRCGP [INT] Examination Board. All rights reserved.</p>
        <p><a href="https://www.mrcgpintsouthasia.org">www.mrcgpintsouthasia.org</a></p>
    </div>
</div>
</body>
</html>
