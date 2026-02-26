<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status Update</title>
    <style>
        body { margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Segoe UI', Arial, sans-serif; }
        .wrapper { max-width: 620px; margin: 40px auto; }
        .header { background: linear-gradient(135deg, #475569 0%, #1e293b 100%); padding: 40px 40px 32px; border-radius: 16px 16px 0 0; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 22px; font-weight: 700; letter-spacing: -0.5px; }
        .header p { color: rgba(255,255,255,0.75); margin: 8px 0 0; font-size: 14px; }
        .body { background: #fff; padding: 40px; }
        .greeting { font-size: 18px; font-weight: 600; color: #1e293b; margin-bottom: 16px; }
        .para { color: #475569; line-height: 1.7; font-size: 15px; margin-bottom: 16px; }
        .status-banner { background: #fef2f2; border: 1px solid #fecaca; border-left: 4px solid #ef4444; border-radius: 8px; padding: 16px 20px; margin: 24px 0; display: flex; align-items: center; }
        .status-banner span { font-size: 15px; font-weight: 600; color: #991b1b; }
        .info-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .info-box table { width: 100%; border-collapse: collapse; }
        .info-box td { padding: 6px 0; font-size: 14px; color: #334155; }
        .info-box td:first-child { font-weight: 600; width: 45%; color: #1e293b; }
        .message-box { background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 20px; margin: 24px 0; }
        .message-box p { color: #78350f; font-size: 14px; margin: 0; line-height: 1.7; }
        .message-box strong { color: #92400e; display: block; margin-bottom: 8px; }
        .encouragement { background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid #bbf7d0; border-radius: 8px; padding: 20px; margin: 24px 0; }
        .encouragement p { color: #166534; font-size: 14px; line-height: 1.7; margin: 0; }
        .footer { background: #f8fafc; padding: 28px 40px; border-radius: 0 0 16px 16px; border-top: 1px solid #e2e8f0; text-align: center; }
        .footer p { color: #94a3b8; font-size: 13px; margin: 4px 0; }
        .footer a { color: #6366f1; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>Application Status Update</h1>
        <p>South Asia MRCGP [INT] Part 1 (AKT) Examination</p>
    </div>

    <div class="body">
        <p class="greeting">Dear {{ $application->usualForename }} {{ $application->lastName }},</p>

        <p class="para">
            Thank you for your interest in the <strong>South Asia MRCGP [INT] Part 1 (AKT) Examination</strong>. After careful review of your application, we regret to inform you of the following:
        </p>

        <div class="status-banner">
            <span>❌ &nbsp; Application Status: Not Approved</span>
        </div>

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
            </table>
        </div>

        @if($application->admin_message)
        <div class="message-box">
            <p>
                <strong>Reason / Additional Information:</strong>
                {{ $application->admin_message }}
            </p>
        </div>
        @endif

        <div class="encouragement">
            <p>
                <strong style="display:block; margin-bottom:8px; color:#14532d;">A Word of Encouragement 💚</strong>
                We understand this may be disappointing news, and we want to assure you that this decision was made after thorough review. Many successful MRCGP candidates have faced initial setbacks before going on to excel. We encourage you to:
                <br><br>
                • Review the eligibility criteria on our website carefully<br>
                • Ensure all required documents are valid and complete<br>
                • Reach out to our office if you need guidance on re-applying<br><br>
                Your commitment to excellence in general practice is commendable, and we wish you all the best in your future endeavours.
            </p>
        </div>

        <p class="para">
            If you believe this decision was made in error, or if you have questions about the review process, please do not hesitate to contact us at
            <a href="mailto:{{ config('mail.from.address') }}" style="color:#6366f1;">{{ config('mail.from.address') }}</a>.
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
