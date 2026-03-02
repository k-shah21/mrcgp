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
        
        .section { margin: 20px 0; border: 1px solid #e2e8f0; border-radius: 4px; overflow: hidden; }
        .section-header { background: #6366f1; color: white; padding: 5px 5px; font-weight: bold; font-size: 14px; text-transform: uppercase; }
        .section-content { padding: 10px 12px; }
        
        .details-table { width: 100%; border-collapse: collapse; }
        .details-table td { padding: 0; font-size: 12px; vertical-align: top; }
        .details-table td.label { width: 40%; font-weight: bold; color: #1e293b; }
        .details-table td.value { width: 60%; color: #1e293b; }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 120px;
            font-weight: bold;
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
        .page-break {
            page-break-before: always;
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
                <td class="label">City / Town / Village:</td>
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
    </div>

    <div class="section">
        <div class="section-header">Examination Centre Preference</div>
        <div class="section-content">
            <table class="details-table">
            <tr>
                <td class="label">Location: </td>
                <td class="value">{{ $examCenterPreference ?? 'Not selected' }}</td>
            </tr>
        </table>
        </div>
    </div>

    <div class="section page-break">
        <div class="section-header">AGREEMENT</div>
        <div class="section-content">
            <table class="details-table">
            <tr>
                <td class="label">Terms Agreed:</td>
                <td class="value">{{ ($termsAccepted ?? '') == 'on' ? 'Yes' : 'No' }}</td>
            </tr>
        </table>
        </div>
    </div>
    <div class="section">
        <div class="section-header">ELIGIBILITY</div>
        <div class="section-content">
            <table class="details-table">
            <tr>
                <td class="label">Criterion:</td>
                <td class="value">{{ $eligibilityCriterion ?? 'Not provided' }}</td>
            </tr>
        </table>
        </div>
    </div>
    <div class="section">
        <div class="section-header">CANDIDATE'S STATEMENT</div>
        <div class="section-content">
            <table class="details-table">
            <tr>
                <td class="label" colspan="2" style="text-align: left; font-size: 11px; font-weight: normal; line-height: 1.4; color: #000000; padding: 5px;">I hereby apply to sit in the MRCGP [INT] South Asia Examination, success in which will allow me to become an International Member
                of the UK’s Royal College of General Practitioners. I have read and agree to abide by the conditions set out in the MRCGP [INT]
                South Asia Examination Rules and Regulations as published on the MRCGP [INT] South Asia website: <br><br>
                I understand that success in the two modules of the South Asia MRCGP [INT] examination does not automatically make me an
                International Member of the RCGP, and that I must apply to register with the RCGP as an International Member before I am allowed
                to refer to myself as “MRCGP [INT]”.<br><br>
                I understand that “MRCGP [INT]” stands for “Member of the Royal College of General Practitioners [International]” and the title is
                subject to remaining a Member in Good Standing, which involves continuing annual membership subscription and adhering to the
                RCGP values and philosophy.<br><br>
                If accepted for International Membership, I undertake to continue approved postgraduate study while I remain in active general
                practice, and to uphold and promote the aims of the College to the best of my ability.<br><br>
                I understand that the documents submit may be sent for verification and incase of forged documents my application will straight away
                be rejected or I may be permanently barred from taking the exam</td>
            </tr>
        </table>
        </div>
    </div>

   @if(isset($preview_files) && count($preview_files) > 0)
    <div class="page-break"></div>

    <h2 style="color:#4338ca; text-align:center; border-bottom:2px solid #6366f1; padding-bottom:10px; margin-bottom:30px;">
        ATTACHED DOCUMENTS
    </h2>

    @foreach($preview_files as $fieldName => $fileData)
        @php
            $files = is_array($fileData) ? $fileData : [$fileData];
            $images = [];
            $nonImages = [];
            foreach($files as $f) {
                if(strpos($f->type, 'image/') === 0) $images[] = $f;
                else $nonImages[] = $f;
            }
        @endphp

        {{-- Show each image on its own page --}}
        @foreach($images as $img)
            <div style="width:100%; text-align:center; margin-bottom:40px;">
                <div style="font-weight:bold; font-size:18px; margin-bottom:20px; text-transform:uppercase; color: #4338ca;">
                    {{ str_replace('_', ' ', $fieldName) }} 
                    @if(count($files) > 1) (IMAGE) @endif
                </div>
                <div style="display: inline-block; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; background: #ffffff;">
                    <img src="{{ $img->data }}" style="max-width:500px; max-height:750px; display:block; margin: 0 auto;">
                </div>
            </div>
            @if(!$loop->last || count($nonImages) > 0 || !$loop->parent->last)
                <div class="page-break"></div>
            @endif
        @endforeach

        {{-- Show non-images (PDFs) listed together in one box for this field --}}
        @if(count($nonImages) > 0)
            <div style="width:100%; text-align:center; margin-bottom:40px;">
                <div style="font-weight:bold; font-size:18px; margin-bottom:20px; text-transform:uppercase; color: #4338ca;">
                    {{ str_replace('_', ' ', $fieldName) }} (DOCUMENTS)
                </div>

                <div style="width:70%; margin:0 auto; padding:30px; border:2px dashed #e2e8f0; background:#f8fafc; border-radius:10px; text-align:left;">
                    <p style="font-weight:bold; margin-bottom:15px; color:#334155; text-align: center;">
                        ATTACHED FILES LIST
                    </p>
                    
                    <ul style="margin: 0; padding-left: 20px; color: #475569;">
                        @foreach($nonImages as $file)
                            <li style="margin-bottom: 8px; font-size: 14px;">
                                <span style="font-weight: bold;">{{ $file->name }}</span>
                                <span style="color: #94a3b8; font-size: 11px;"> ({{ strtoupper(explode('/', $file->type)[1] ?? 'FILE') }})</span>
                            </li>
                        @endforeach
                    </ul>

                    <div style="margin-top: 25px; color: #94a3b8; font-size: 11px; text-align: center; border-top: 1px solid #e2e8f0; padding-top: 15px;">
                        Note: Files are successfully attached to your application record. PDF viewing is restricted within the preview for security.
                    </div>
                </div>
            </div>
            @if(!$loop->last)
                <div class="page-break"></div>
            @endif
        @endif
    @endforeach
@endif

</body>
</html>
