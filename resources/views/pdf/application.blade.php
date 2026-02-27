<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MRCGP AKT Application Preview</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #334155; line-height: 1.5; margin: 0; padding: 0px; }
        .header { border-bottom: 2px solid #6366f1; padding-bottom: 10px; margin-bottom: 30px; position: relative; }
        .header img { height: 60px; }
        
        .section { margin-bottom: 20px; border: 1px solid #e2e8f0; border-radius: 4px; overflow: hidden; }
        .section-header { background: #6366f1; color: white; padding: 6px 12px; font-weight: bold; font-size: 14px; text-transform: uppercase; }
        .section-content { padding: 10px 12px; }
        
        .details-table { width: 100%; border-collapse: collapse; }
        .details-table td { padding: 0; font-size: 13px; vertical-align: top; }
        .details-table td.label { width: 40%; font-weight: bold; color: #1e293b; }
        .details-table td.value { width: 60%; color: #475569; }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 120px;
            color: rgba(99, 102, 241, 0.1);
            z-index: -1;
            white-space: nowrap;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="watermark">Preview</div>

    <div class="header">
        <div style="float: left;">
            <img src="{{public_path('icon.png')}}" alt="" style="height: 60px; float: left;">
            <div style="margin-left: 70px;">
                <h1 style="margin:0; color:#4338ca; font-size: 22px;">MRCGP [INT.] South Asia</h1>
                <p style="margin:5px 0 0; color:#64748b;">AKT Examination Application</p>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="section">
        <div class="section-header">Candidate Details</div>
        <div class="section-content">
            <table class="details-table">
            <tr>
                <td class="label">Candidate Type:</td>
                <td class="value">{{ ucfirst($candidateType ?? 'N/A') }}</td>
            </tr>
            @if(($candidateType ?? '') === 'old')
            <tr>
                <td class="label">Candidate ID:</td>
                <td class="value">{{ $candidateId ?? 'Not provided' }}</td>
            </tr>
            @endif
            <tr>
                <td class="label">Full Name:</td>
                <td class="value">{{ $fullNameOnRecord ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Usual Forename:</td>
                <td class="value">{{ $usualForename ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Last Name:</td>
                <td class="value">{{ $lastName ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Passport Number:</td>
                <td class="value">{{ $passportNumber ?? 'Not provided' }}</td>
            </tr>
        </table>
        </div>
    </div>

    <div class="section">
        <div class="section-header">Contact Details</div>
        <div class="section-content">
            <table class="details-table">
            <tr>
                <td class="label">WhatsApp Number:</td>
                <td class="value">{{ $whatsappNumber ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Emergency Contact Number:</td>
                <td class="value">{{ $emergencyContactNumber ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Email Address:</td>
                <td class="value">{{ $email ?? 'Not provided' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-header">Address Details</div>
        <div class="section-content">
            <table class="details-table">
            <tr>
                <td class="label">Street Address / P.O. Box:</td>
                <td class="value">{{ $poBox ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">District:</td>
                <td class="value">{{ $district ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">City:</td>
                <td class="value">{{ $city ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Province:</td>
                <td class="value">{{ $province ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Country:</td>
                <td class="value">{{ $country ?? 'Not provided' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-header">Examination History</div>
        <div class="section-content">
            <table class="details-table">
            <tr>
                <td class="label">Previous AKT attempts:</td>
                <td class="value">{{ $previousAttempts ?? 'Not provided' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-header">Experience & License Details</div>
        <div class="section-content">
            <table class="details-table">
            <tr>
                <td class="label">Graduating Medical School:</td>
                <td class="value">{{ $schoolName ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Medical School Location:</td>
                <td class="value">{{ $schoolLocation ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Qualification Year:</td>
                <td class="value">{{ $qualificationYear ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Clinical Experience Country:</td>
                <td class="value">{{ $countryOfExperience ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Registration Authority:</td>
                <td class="value">{{ $registrationAuthority ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Registration Number:</td>
                <td class="value">{{ $registrationNumber ?? 'Not provided' }}</td>
            </tr>
            <tr>
                <td class="label">Registration Date:</td>
                <td class="value">{{ $registrationDate ?? 'Not provided' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-header">Examination Centre Preference</div>
        <div class="section-content">
            <table class="details-table">
            <tr>
                <td class="label">Preferred Center:</td>
                <td class="value">{{ $examCenterPreference ?? 'Not selected' }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        This is a generated preview of your application. Values shown are based on your current input.
    </div>
</body>
</html>
