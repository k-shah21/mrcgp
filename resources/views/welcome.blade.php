<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- intl-tel-input (country code + flags) -->
    <style>
        /* File name badge */
        .file-name-badge { display: inline-flex; align-items: center; gap: 6px; margin-top: 8px; padding: 4px 12px; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 6px; font-size: 13px; color: #4338ca; max-width: 100%; }
        .file-name-badge svg { flex-shrink: 0; }
        .file-name-badge span { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        /* Phone country dropdown */
        .phone-country-dropdown { position: absolute; top: 100%; left: 0; z-index: 50; min-width: 280px; max-height: 250px; overflow-y: auto; background: white; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.12); margin-top: 4px; display: none; }
        .phone-country-dropdown.open { display: block; }
        .phone-country-dropdown .country-search { width: 100%; padding: 8px 12px; border: none; border-bottom: 1px solid #e2e8f0; font-size: 13px; outline: none; position: sticky; top: 0; background: white; }
        .phone-country-dropdown .country-option { display: flex; align-items: center; gap: 10px; padding: 8px 12px; cursor: pointer; font-size: 13px; transition: background 0.15s; }
        .phone-country-dropdown .country-option:hover { background: #eef2ff; }
        .phone-country-dropdown .country-option.selected { background: #e0e7ff; }
        .phone-country-dropdown .country-option img { width: 22px; height: 16px; border-radius: 2px; object-fit: cover; }
        .phone-country-dropdown .country-option .dial { color: #6366f1; font-weight: 500; margin-left: auto; }
    </style>
</head>

<body>
    <div class="container mx-auto py-8 px-4 max-w-5xl">
        <div
            class="rounded-xl bg-card text-card-foreground border-0 shadow-xl overflow-hidden bg-gradient-to-br from-white to-slate-50">
            <div class="h-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
            <div class="flex flex-col p-6 space-y-1 bg-slate-50 border-b">
                <div class="flex items-center justify-between">
                    <div
                        class="tracking-tight text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-purple-600">
                        <div class="flex justify-start items-center gap-2">
                            <div class="w-18 h-18 sm:h-20 sm:w-20 rounded-fullflex items-center justify-center"><img
                                    src="/icon.png" alt="404"></div>
                            <div class=""><span>APPLICATION FORM</span>
                                <div class="text-sm text-slate-500">For the South Asia MRCGP [INT.]
                                    Part 1 (AKT) Examination</div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-indigo-100 rounded-md text-indigo-700 font-medium text-sm">
                        May 2026 AKT Exam</div>
                </div>
            </div>
            <div class="p-6">
                <form id="application-form" enctype="multipart/form-data">
                    @csrf
                    <div>

                        <div id="step-1" class="space-y-6">
                            <div class="w-full mb-4">
                                <div class="border rounded-lg overflow-hidden shadow-sm">
                                    <div
                                        class="flex flex-1 items-center text-sm font-medium text-left px-4 py-3 bg-slate-50 hover:bg-slate-100 transition-all">
                                        <div class="flex items-center text-lg font-semibold text-slate-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-shield-check h-5 w-5 mr-2 text-indigo-500">
                                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                                <path d="m9 12 2 2 4-4" />
                                            </svg>
                                            STEP 1: ELIGIBILITY CHECK
                                        </div>
                                    </div>
                                    <div class="overflow-hidden text-sm px-4 pt-4 pb-6 bg-white space-y-6">

                                        <!-- Instruction Message -->
                                        <div role="alert"
                                            class="relative w-full rounded-lg border p-4 [&>svg~*]:pl-7 [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 text-foreground mb-1 border-amber-200 bg-amber-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-alert-triangle h-4 w-4 text-amber-800">
                                                <path
                                                    d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z" />
                                                <path d="M12 9v4" />
                                                <path d="M12 17h.01" />
                                            </svg>
                                            <div class="text-sm [&_p]:leading-relaxed text-amber-800 font-medium">
                                                Cannot use duplicate email. Duplicate entry of the same candidate is not
                                                eligible.
                                            </div>
                                        </div>

                                        <!-- Disclaimer Checkbox -->
                                        <div
                                            class="flex flex-row items-start space-x-3 space-y-0 p-4 border rounded-md bg-slate-50">
                                            <button type="button" role="checkbox" aria-checked="false"
                                                data-state="unchecked" value="on"
                                                class="peer size-4 shrink-0 rounded-sm border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground bg-white border-slate-300 data-[state=checked]:bg-indigo-600 data-[state=checked]:border-indigo-600"
                                                id="duplicate-disclaimer-btn"></button>
                                            <input type="checkbox" name="duplicateDisclaimer" id="duplicate-disclaimer"
                                                class="hidden">
                                            <div class="space-y-1 leading-none">
                                                <label
                                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-slate-700 cursor-pointer"
                                                    for="duplicate-disclaimer-btn">
                                                    I understand that if I make a duplicate entry of the same candidate
                                                    my application will get rejected.
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Old / New Radios -->
                                        <div class="space-y-3">
                                            <label
                                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Candidate
                                                Type <span class="text-red-500">*</span></label>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" role="radiogroup"
                                                id="candidate-type-group">
                                                <!-- New Candidate -->
                                                <div class="flex items-center space-x-2 border p-4 rounded-lg bg-slate-50 border-slate-200 cursor-pointer hover:bg-slate-100 transition-colors cand-type-wrapper"
                                                    data-target="radio-new">
                                                    <button type="button" role="radio" aria-checked="true"
                                                        data-state="checked" value="new"
                                                        class="aspect-square h-4 w-4 rounded-full border border-primary text-primary ring-offset-background focus:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white border-slate-300 data-[state=checked]:border-indigo-600 flex items-center justify-center"
                                                        id="radio-new">
                                                        <span data-state="checked"
                                                            class="flex items-center justify-center"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-circle h-2.5 w-2.5 fill-indigo-600 text-indigo-600">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                            </svg></span>
                                                    </button>
                                                    <input type="hidden" name="candidateType" value="new">
                                                    <label
                                                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 cursor-pointer text-slate-700 pointer-events-none"
                                                        for="radio-new">New Candidate</label>
                                                </div>
                                                <!-- Old Candidate -->
                                                <div class="flex items-center space-x-2 border p-4 rounded-lg bg-slate-50 border-slate-200 cursor-pointer hover:bg-slate-100 transition-colors cand-type-wrapper"
                                                    data-target="radio-old">
                                                    <button type="button" role="radio" aria-checked="false"
                                                        data-state="unchecked" value="old"
                                                        class="aspect-square h-4 w-4 rounded-full border border-primary text-primary ring-offset-background focus:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white border-slate-300 data-[state=checked]:border-indigo-600 flex items-center justify-center"
                                                        id="radio-old">
                                                    </button>
                                                    <input type="hidden" name="candidateType" value="old" disabled>
                                                    <label
                                                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 cursor-pointer text-slate-700 pointer-events-none"
                                                        for="radio-old">Old Candidate</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hidden Candidate ID -->
                                        <div class="space-y-2 hidden" id="candidate-id-container">
                                            <label
                                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                for="step1-candidateId">Candidate ID <span
                                                    class="text-red-500">*</span></label>
                                            <p class="text-[0.8rem] text-muted-foreground">Please enter your 7-digit
                                                candidate Id assigned to you previously.</p>
                                            <input type="text"
                                                class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                placeholder="e.g. 1234567" name="candidateId" maxlength="7"
                                                id="step1-candidateId"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="">
                                        </div>

                                        <!-- Identification Fields -->
                                        <div class="space-y-4">
                                            <div role="alert"
                                                class="relative w-full rounded-lg border p-4 [&>svg~*]:pl-7 [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 text-foreground mb-1 border-amber-200 bg-amber-50">
                                                <div class="text-sm [&_p]:leading-relaxed text-amber-800 font-small">
                                                    Please mention first name and last name as per identification (ID
                                                    card or passport) which you will be showing at examination centre.
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-2">
                                                    <label class="text-sm font-medium leading-none"
                                                        for="usualForename">Usual Forename
                                                        <span class="text-red-500">*</span>
                                                    </label>
                                                    <p class="text-[0.8rem] text-muted-foreground">
                                                        Your first name or forename
                                                    </p>
                                                    <input
                                                        class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                        placeholder="Enter your forename" name="usualForename"
                                                        id="usualForename" value="" required>
                                                </div>
                                                <div class="space-y-2">
                                                    <label class="text-sm font-medium leading-none" for="lastName">Last
                                                        Name
                                                        <span class="text-red-500">*</span>
                                                    </label>
                                                    <p class="text-[0.8rem] text-muted-foreground">Your family name or
                                                        surname</p>
                                                    <input
                                                        class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                        placeholder="Enter your last name" name="lastName" id="lastName"
                                                        value="" required>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-2">
                                                    <label class="text-sm font-medium leading-none" for="email">
                                                        Email Address <span class="text-red-500">*</span>
                                                    </label>
                                                    <p class="text-[0.8rem] text-muted-foreground">
                                                        Primary email for communication
                                                    </p>
                                                    <input type="email"
                                                        class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                        placeholder="e.g. name@example.com" name="email" id="email"
                                                        value="" required>
                                                </div>

                                                <div class="space-y-2" id="passport-number-container">
                                                    <label class="text-sm font-medium leading-none"
                                                        for="step1-passportNumber">Passport Number <span
                                                            class="text-red-500">*</span></label>
                                                    <p class="text-[0.8rem] text-muted-foreground">
                                                        Primary passport number
                                                    </p>
                                                    <input type="text"
                                                        class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                        placeholder="Enter passport number" name="passportNumber"
                                                        id="step1-passportNumber" value="" required>
                                                </div>
                                            </div>

                                            <div class="flex justify-end pt-4">
                                                <button type="button" id="check-eligibility-btn"
                                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary shadow hover:bg-primary/90 h-10 px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white transition-all duration-200 transform hover:scale-105">
                                                    Check Eligibility
                                                </button>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="step-2" class="space-y-6 hidden">
                            <div class="w-full mb-4">
                                <div class="border rounded-lg overflow-hidden shadow-sm">
                                    <div
                                        class="flex flex-1 items-center text-sm font-medium text-left px-4 py-3 bg-slate-50 hover:bg-slate-100 transition-all">
                                        <div class="flex items-center text-lg font-semibold text-slate-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-user h-5 w-5 mr-2 text-indigo-500">
                                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                <circle cx="12" cy="7" r="4" />
                                            </svg>
                                            PERSONAL & CONTACT DETAILS
                                        </div>
                                    </div>
                                    <div class="overflow-hidden text-sm px-4 pt-4 pb-6 bg-white space-y-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                            <div class="space-y-2">
                                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">WhatsApp number
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <div class="bg-slate-50 border border-slate-200 rounded-md focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2">
                                                    <div class="flex h-10 w-full rounded-md bg-transparent text-sm PhoneInput" id="whatsapp-phone-wrapper">
                                                        <div class="relative">
                                                            <button class="items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 py-2 flex gap-1 rounded-e-none rounded-s-lg border-r-0 px-3 focus:z-10" type="button" onclick="toggleCountryDropdown('whatsapp')">
                                                                <span class="flex h-4 w-6 overflow-hidden rounded-sm bg-foreground/20" id="whatsapp-flag"></span>
                                                                <span class="text-sm font-medium" id="whatsapp-dial-code">+92</span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="-mr-2 size-4 opacity-100"><path d="m7 15 5 5 5-5"></path><path d="m7 9 5-5 5 5"></path></svg>
                                                            </button>
                                                            <div class="phone-country-dropdown" id="whatsapp-dropdown"></div>
                                                        </div>
                                                        <input type="tel" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none md:text-sm rounded-e-lg rounded-s-none" placeholder="e.g. 3001234567" id="whatsappNumber">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="whatsappNumber" id="whatsappNumber-full">
                                            </div>
                                            <div class="space-y-2">
                                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Emergency contact number
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <div class="bg-slate-50 border border-slate-200 rounded-md focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2">
                                                    <div class="flex h-10 w-full rounded-md bg-transparent text-sm PhoneInput" id="emergency-phone-wrapper">
                                                        <div class="relative">
                                                            <button class="items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 py-2 flex gap-1 rounded-e-none rounded-s-lg border-r-0 px-3 focus:z-10" type="button" onclick="toggleCountryDropdown('emergency')">
                                                                <span class="flex h-4 w-6 overflow-hidden rounded-sm bg-foreground/20" id="emergency-flag"></span>
                                                                <span class="text-sm font-medium" id="emergency-dial-code">+92</span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="-mr-2 size-4 opacity-100"><path d="m7 15 5 5 5-5"></path><path d="m7 9 5-5 5 5"></path></svg>
                                                            </button>
                                                            <div class="phone-country-dropdown" id="emergency-dropdown"></div>
                                                        </div>
                                                        <input type="tel" class="flex h-9 w-full rounded-md border border-input bg-transparent px-3 py-1 text-base shadow-sm transition-colors placeholder:text-muted-foreground focus-visible:outline-none md:text-sm rounded-e-lg rounded-s-none" placeholder="e.g. 3001234567" id="emergencyContactNumber">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="emergencyContactNumber" id="emergencyContactNumber-full">
                                            </div>
                                            
                                        </div>

                                        <div class="space-y-2">
                                            <label class="text-sm font-medium leading-none" for="fullNameOnRecord">Full
                                                name as you would like it on record
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <p class="text-[0.8rem] text-muted-foreground">This name will be used on
                                                official documents</p>
                                            <input
                                                class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                placeholder="Enter full name for record" name="fullNameOnRecord"
                                                id="fullNameOnRecord" value="">
                                        </div>

                                        <div class="space-y-2">
                                            <label class="text-sm font-medium leading-none" for="previousAttempts">No.
                                                of previous AKTs attempts <span class="text-red-500">*</span></label>
                                            <select name="previousAttempts" id="previousAttempts"
                                                class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500">
                                                <option value="">Select attempts</option>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="5+">5+</option>
                                            </select>
                                        </div>

                                        <div class="space-y-4 mt-6">
                                            <h4 class="text-sm font-semibold text-slate-700">Residential Address
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div class="space-y-2">
                                                    <label class="text-sm font-medium leading-none" for="poBox">House
                                                        no. and street or P.O.Box
                                                        <span class="text-red-500">*</span>
                                                    </label>
                                                    <input
                                                        class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                        placeholder="Enter House no. and street or P.O.Box" name="poBox"
                                                        id="poBox">
                                                </div>
                                                <div class="space-y-2">
                                                    <label class="text-sm font-medium leading-none"
                                                        for="district">District
                                                        <span class="text-red-500">*</span>
                                                    </label>
                                                    <input
                                                        class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                        placeholder="Enter District" name="district" id="district">
                                                </div>
                                                <div class="space-y-2">
                                                    <label class="text-sm font-medium leading-none" for="city">City
                                                        / Town / Village
                                                        <span class="text-red-500">*</span>
                                                    </label>
                                                    <input
                                                        class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                        placeholder="Enter City/Town" name="city" id="city">
                                                </div>
                                                <div class="space-y-2">
                                                    <label class="text-sm font-medium leading-none"
                                                        for="province">Province / Region <span
                                                            class="text-red-500">*</span></label>
                                                    <input
                                                        class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                        placeholder="Enter Province" name="province" id="province">
                                                </div>
                                                <div class="col-span-1 md:col-span-2 space-y-2">
                                                    <label class="text-sm font-medium leading-none"
                                                        for="country">Country <span
                                                            class="text-red-500">*</span></label>
                                                    <input
                                                        class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                        placeholder="Enter Country" name="country" id="country">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-2 mt-6">
                                            <label class="text-sm font-medium leading-none">Passport Image
                                                (Scan) <span class="text-red-500">*</span></label>
                                            <div class="flex items-center justify-center w-full">
                                                <label for="passport-image"
                                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-slate-50 border-slate-300 hover:bg-slate-100">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-upload w-8 h-8 mb-2 text-slate-500">
                                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                            </path>
                                                            <polyline points="17 8 12 3 7 8"></polyline>
                                                            <line x1="12" x2="12" y1="3" y2="15"></line>
                                                        </svg>
                                                        <p class="mb-2 text-sm text-slate-500"><span
                                                                class="font-semibold">Click to upload</span>
                                                            passport image</p>
                                                        <p class="text-xs text-slate-500">JPG, JPEG, PNG (MAX.
                                                            5MB)</p>
                                                    </div>
                                                    <input id="passport-image" name="passportImage" type="file"
                                                        class="hidden" accept=".png, .jpg, .jpeg">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mb-4">
                                <div class="border rounded-lg overflow-hidden shadow-sm">
                                    <div
                                        class="flex flex-1 items-center text-sm font-medium text-left px-4 py-3 bg-slate-50 hover:bg-slate-100 transition-all">
                                        <div class="flex items-center text-lg font-semibold text-slate-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-file-text h-5 w-5 mr-2 text-indigo-500">
                                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                                <path d="M10 9H8" />
                                                <path d="M16 13H8" />
                                                <path d="M16 17H8" />
                                            </svg>
                                            EDUCATION, EXPERIENCE AND LICENSE DETAILS
                                        </div>
                                    </div>
                                    <div class="overflow-hidden text-sm px-4 pt-4 pb-6 bg-white space-y-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                            <div class="space-y-2">
                                                <label
                                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                    for="schoolName">Name of medical school:
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <input
                                                    class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                    autocomplete="new-password"
                                                    placeholder="Enter name of medical school" name="schoolName"
                                                    id="schoolName" aria-describedby="schoolName-description"
                                                    aria-invalid="false" value="">
                                            </div>
                                            <div class="space-y-2">
                                                <label
                                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                    for="schoolLocation">Country of medical school:
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <input
                                                    class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                    autocomplete="new-password"
                                                    placeholder="Enter country of medical school" name="schoolLocation"
                                                    id="schoolLocation" aria-describedby="schoolLocation-description"
                                                    aria-invalid="false" value="">
                                            </div>
                                             <div class="space-y-2">
                                                <label
                                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                    for="qualificationYear">Year of Qualification:
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <select name="qualificationYear" id="qualificationYear"
                                                    class="flex h-9 w-full items-center justify-between whitespace-nowrap rounded-md border px-3 py-2 text-sm shadow-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                                    <option value="">Select year of qualification</option>
                                                    @for ($y = 2026; $y >= 1977; $y--)
                                                        <option value="{{ $y }}">{{ $y }}</option>
                                                    @endfor
                                                </select>
                                             </div>
                                            <div class="space-y-2">
                                                <label
                                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                    for="countryOfExperience">Country of postgraduate clinical
                                                    experience:
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <input
                                                    class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                    autocomplete="new-password"
                                                    placeholder="Enter country of postgraduate clinical experience"
                                                    name="countryOfExperience" id="countryOfExperience"
                                                    aria-describedby="countryOfExperience-description"
                                                    aria-invalid="false" value="" />
                                            </div>
                                            <div class="space-y-2">
                                                <label
                                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                    for="countryOfOrigin">Country of ethnic origin
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <input
                                                    class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                    autocomplete="new-password"
                                                    placeholder="Enter Country of ethnic origin" name="countryOfOrigin"
                                                    id="countryOfOrigin" aria-describedby="countryOfOrigin-description"
                                                    aria-invalid="false" value="" />
                                            </div>
                                            <div class="space-y-2">
                                                <label
                                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                    for="registrationAuthority">Registration authority
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <input
                                                    class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                    autocomplete="new-password"
                                                    placeholder="Enter Registration authority"
                                                    name="registrationAuthority" id="registrationAuthority"
                                                    aria-describedby="registrationAuthority-description"
                                                    aria-invalid="false" value="">
                                            </div>
                                            <div class="space-y-2">
                                                <label
                                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                    for="registrationNumber">Registration number
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <input
                                                    class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500"
                                                    autocomplete="new-password" placeholder="Enter Registration number"
                                                    name="registrationNumber" id="registrationNumber"
                                                    aria-describedby="registrationNumber-description"
                                                    aria-invalid="false" value="">
                                            </div>
                                            <div class="space-y-2 flex flex-col">
                                                <label
                                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                    for="registrationDate">Date of full registration
                                                    <span class="text-red-500">*</span>
                                                </label>
                                                <input type="date" name="registrationDate" id="registrationDate"
                                                    aria-describedby="registrationDate-description" aria-invalid="false"
                                                    class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mb-4" id="eligibility-section-wrapper">
                                <div class="border rounded-lg overflow-hidden shadow-sm">
                                    <div
                                        class="flex flex-1 items-center text-sm font-medium text-left px-4 py-3 bg-slate-50 hover:bg-slate-100 transition-all">
                                        <div class="flex items-center text-lg font-semibold text-slate-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-shield h-5 w-5 mr-2 text-indigo-500">
                                                <path
                                                    d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z">
                                                </path>
                                            </svg>ELIGIBILITY<span class="text-red-500 ml-1">*</span>
                                        </div>
                                    </div>
                                    <div class="overflow-hidden text-sm px-4 pt-4 pb-6 bg-white">
                                        <div class="pb-4 pt-0">
                                            <div class="space-y-6">
                                                <p class="text-sm text-slate-700 mb-4">
                                                    I am eligible to apply for the MRCGP[INT] South Asia Examination
                                                    under the following criterion – please choose ONE:
                                                </p>
                                                <div class="space-y-4">
                                                    <div class="space-y-3" id="eligibility">
                                                        @foreach([
    'A' => 'I have satisfactorily completed a structured two-year training course or a two-year diploma in family medicine as recognised by the MRCGP [INT] South Asia Board (certificates of experience and references attached).',
    'B' => 'I have satisfactorily completed a structured one-year training programme / diploma in family medicine as recognised by the MRCGP[INT] South Asia Board (certificates of experience and references attached) along with a further 2 years of clinical experience.',
    'C' => 'I have completed a minimum of five years of clinical experience of which a minimum of three years has been in family medicine (experience during must be in last 10 years).',
] as $val => $label)
                                                        <label for="eligibility-{{ strtolower($val) }}"
                                                            class="flex items-start space-x-3 rounded-md border p-4 bg-slate-50 border-slate-200 cursor-pointer hover:bg-indigo-50 hover:border-indigo-300 transition-colors group">
                                                            <input type="radio" id="eligibility-{{ strtolower($val) }}"
                                                                name="eligibilityCriterion"
                                                                value="{{ $val }}"
                                                                class="mt-1 w-4 h-4 text-indigo-600 border-slate-300 focus:ring-indigo-500">
                                                            <span class="text-sm font-medium text-slate-700 flex-1 leading-relaxed">
                                                                {{ $label }}
                                                            </span>
                                                        </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mb-4">

                                <div class="border rounded-lg overflow-hidden shadow-sm">
                                    <div
                                        class="flex flex-1 items-center text-sm font-medium text-left px-4 py-3 bg-slate-50 hover:bg-slate-100 transition-all">
                                        <div class="flex items-center text-lg font-semibold text-slate-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-map-pin h-5 w-5 mr-2 text-indigo-500">
                                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>EXAMINATION CENTER PREFERENCE<span class="text-red-500 ml-1">*</span>
                                        </div>
                                    </div>
                                    <div class="overflow-hidden text-sm px-4 pt-4 pb-6 bg-white">
                                        <div class="pb-4 pt-0">
                                            <div class="space-y-6">
                                                <p class="text-sm text-slate-700 mb-4">
                                                    Please choose below the examination centre where you would
                                                    like to take the Part 1 examination.</p>
                                                <div class="space-y-3">
                                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4"
                                                        id="examCenterPreference">
                                                        @foreach(['Colombo', 'Chennai', 'Dhaka', 'Jeddah', 'Karachi', 'Delhi', 'Lahore', 'Yangon', 'Kathmandu'] as $city)
                                                        <label class="flex items-center space-x-2 cursor-pointer group">
                                                            <input type="radio"
                                                                name="examCenterPreference"
                                                                id="center-{{ strtolower($city) }}"
                                                                value="{{ $city }}"
                                                                class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:ring-2">
                                                            <span class="text-sm font-medium text-gray-900 group-hover:text-indigo-700 transition-colors">{{ $city }}</span>
                                                        </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="p-4 bg-amber-50 rounded-md border border-amber-100">
                                                    <p class="text-sm text-amber-700">
                                                        <strong>NOTE:</strong><br>
                                                        Changing your exam centre preference is only possible in
                                                        exceptional circumstances and subject to availability.
                                                        Requests after the registration closing deadline may not
                                                        be accommodated.<br><br>Limited seats at each venue are
                                                        available for the computer-based exam administered by
                                                        Pearson VUE and will be allocated on a first come first
                                                        served basis. Others will be accommodated in a paper-based
                                                        exam administered by British Council.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="w-full mb-4">
                                <div class="border rounded-lg overflow-hidden shadow-sm">
                                    <div
                                        class="flex flex-1 items-center text-sm font-medium text-left px-4 py-3 bg-slate-50 hover:bg-slate-100 transition-all">
                                        <div class="flex items-center text-lg font-semibold text-slate-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-calendar h-5 w-5 mr-2 text-indigo-500">
                                                <path d="M8 2v4"></path>
                                                <path d="M16 2v4"></path>
                                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                                <path d="M3 10h18"></path>
                                            </svg>EXAM DATE
                                        </div>
                                    </div>
                                    <div class="overflow-hidden text-sm px-4 pt-4 pb-6 bg-white">
                                        <div class="pb-4 pt-0">
                                            <div class="space-y-6">
                                                <p class="text-sm text-slate-700 mb-4">
                                                    The AKT examination is a single-day exam. The exam date has
                                                    been scheduled as shown below.
                                                </p>
                                                <div class="space-y-4">
                                                    <div class="p-4 bg-green-50 rounded-md border border-green-200">
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-calendar h-5 w-5 text-green-600 mr-2">
                                                                <path d="M8 2v4"></path>
                                                                <path d="M16 2v4"></path>
                                                                <rect width="18" height="18" x="3" y="4" rx="2">
                                                                </rect>
                                                                <path d="M3 10h18"></path>
                                                            </svg>
                                                            <div>
                                                                <h3 class="text-lg font-semibold text-green-800">
                                                                    Scheduled Exam Date</h3>
                                                                <p class="text-green-700">
                                                                    Wednesday, May 13th, 2026</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="w-full mb-4">
                                <div class="border rounded-lg overflow-hidden shadow-sm">
                                    <div
                                        class="flex flex-1 items-center text-sm font-medium text-left px-4 py-3 bg-slate-50 hover:bg-slate-100 transition-all">
                                        <div class="flex items-center text-lg font-semibold text-slate-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-file-text h-5 w-5 mr-2 text-indigo-500">
                                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z">
                                                </path>
                                                <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                                <path d="M10 9H8"></path>
                                                <path d="M16 13H8"></path>
                                                <path d="M16 17H8"></path>
                                            </svg>CANDIDATE STATEMENT
                                        </div>
                                    </div>
                                    <div class="overflow-hidden text-sm px-4 pt-4 pb-6 bg-white">
                                        <div class="pb-4 pt-0">
                                            <div class="space-y-6">
                                                <div class="p-4 bg-slate-50 rounded-md border border-slate-200">
                                                    <p class="text-sm text-slate-700 mb-4">
                                                        I hereby apply to sit the MRCGP [INT] South Asia
                                                        Examination, success in which will allow me to become
                                                        an International Member of the UK's Royal College of
                                                        General Practitioners. I have read and agree to
                                                        abide by the conditions set out in the MRCGP [INT]
                                                        South Asia Examination Rules and Regulations as
                                                        published on the MRCGP [INT] South Asia website:
                                                        www.mrcgpintsouthasia.org
                                                    </p>
                                                    <p class="text-sm text-slate-700 mb-4">I understand
                                                        that success in the two modules of the South Asia
                                                        MRCGP [INT] examination does not automatically make me
                                                        an International Member of the RCGP, and that I must
                                                        apply to register with the RCGP as an International
                                                        Member before I am allowed to refer to myself as
                                                        "MRCGP [INT]".</p>
                                                    <p class="text-sm text-slate-700 mb-4">I understand
                                                        that "MRCGP [INT]" stands for "Member of the Royal
                                                        College of General Practitioners [International]" and
                                                        the title is subject to remaining a Member in Good
                                                        Standing, which involves continuing annual membership
                                                        subscription and adhering to the RCGP values and
                                                        philosophy.</p>
                                                    <p class="text-sm text-slate-700 mb-4">If accepted
                                                        for International Membership, I undertake to
                                                        continue approved postgraduate study while I remain in
                                                        active general practice, and to uphold and promote
                                                        the aims of the College to the best of my ability.</p>
                                                    <p class="text-sm text-slate-700">I understand that
                                                        the documents submit may be sent for verification and
                                                        incase of forged documents my application will
                                                        straight away be rejected or I may be permanently
                                                        barred from taking the exam.</p>
                                                </div>
                                                <div
                                                    class="flex flex-row items-start space-x-3 space-y-0 rounded-md border p-4 bg-slate-50 border-slate-200">
                                                    <button type="button" role="checkbox" aria-checked="false"
                                                        data-state="unchecked" value="on"
                                                        class="peer h-4 w-4 shrink-0 rounded-sm border border-primary shadow focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:text-primary-foreground data-[state=checked]:bg-indigo-500 data-[state=checked]:border-indigo-500"
                                                        id=":rv:-form-item"
                                                        aria-describedby=":rv:-form-item-description"
                                                        aria-invalid="false">
                                                    </button>
                                                    <input type="checkbox" aria-hidden="true" tabindex="-1" value="on"
                                                        name="termsAccepted"
                                                        style="transform: translateX(-100%); position: absolute; pointer-events: none; opacity: 0; margin: 0px; width: 16px; height: 16px;">
                                                    <div class="space-y-1 leading-none">
                                                        <label
                                                            class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium"
                                                            for="termsAccepted">I agree to the terms and
                                                            conditions <span class="text-red-500">*</span>
                                                        </label>
                                                        <p id="termsAccepted-description"
                                                            class="text-muted-foreground text-xs"
                                                            aria-describedby="termsAccepted-description">
                                                            By checking this box, I confirm that I have read and
                                                            agree to the
                                                            statements above.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mb-4" id="eligibility-required-warning">
                                <div class="p-4 bg-amber-50 rounded-md border border-amber-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0"><svg class="h-5 w-5 text-amber-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg></div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-amber-800">
                                                Eligibility Required</h3>
                                            <div class="mt-2 text-sm text-amber-700">
                                                <p>Please select at least one eligibility criterion
                                                    above to proceed with document uploads.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mb-4" id="required-docs-wrapper">
                                <div class="border rounded-lg overflow-hidden shadow-sm">
                                    <div
                                        class="flex flex-1 items-center text-sm font-medium text-left px-4 py-3 bg-slate-50  hover:bg-slate-100  transition-all">
                                        <div class="flex items-center text-lg font-semibold text-slate-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-upload h-5 w-5 mr-2 text-indigo-500">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                </path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" x2="12" y1="3" y2="15"></line>
                                            </svg>REQUIRED DOCUMENTS
                                        </div>
                                    </div>
                                    <div class="overflow-hidden text-sm px-4 pt-4 pb-6 bg-white space-y-4">
                                        <div class="pb-4 pt-0">
                                            <div class="space-y-6">
                                                <div class="p-4 bg-blue-50 rounded-md border border-blue-100">
                                                    <p class="text-sm text-blue-700">
                                                        <strong>Note:</strong> Based on your
                                                        selected eligibility criteria,
                                                        please upload the required documents.
                                                        All documents should be in
                                                        JPG, JPEG, PNG, or PDF format.
                                                    </p>
                                                </div>
                                                <div id="doc-uploads-container">
                                                    <div class="space-y-2" data-doc="signature"><label
                                                            class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium">Signature
                                                            <span class="text-red-500">*</span></label>
                                                        <!-- Signature Type Tabs -->
                                                        <div class="flex gap-2 mb-3">
                                                            <button type="button" id="sig-tab-draw"
                                                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary shadow hover:bg-primary/90 h-9 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                                                                onclick="switchSignatureTab('draw')">Draw</button>
                                                            <button type="button" id="sig-tab-upload"
                                                                class="gap-2 whitespace-nowrap [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 shadow-sm inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"
                                                                onclick="switchSignatureTab('upload')">Upload</button>
                                                        </div>

                                                        <!-- Draw Signature Section -->
                                                        <div id="signature-draw-section">
                                                            <canvas id="signature-canvas"
                                                                class="border border-slate-300 rounded-lg bg-white w-full"
                                                                style="height: 200px; touch-action: none; cursor: crosshair;"></canvas>
                                                            <input type="hidden" name="signature" id="signature-data">
                                                            <button type="button" onclick="clearSignature()"
                                                                class="mt-2 text-sm text-red-600 hover:text-red-700">Clear
                                                                Signature</button>
                                                        </div>

                                                        <!-- Upload Signature Section -->
                                                        <div id="signature-upload-section" class="hidden">
                                                            <div class="flex items-center justify-center w-full">
                                                                <label for="signature-upload"
                                                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-slate-50 border-slate-300 hover:bg-slate-100">
                                                                    <div
                                                                        class="flex flex-col items-center justify-center pt-5 pb-6">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none" stroke="currentColor"
                                                                            stroke-width="2" stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="lucide lucide-upload w-8 h-8 mb-2 text-slate-500">
                                                                            <path
                                                                                d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                                            </path>
                                                                            <polyline points="17 8 12 3 7 8">
                                                                            </polyline>
                                                                            <line x1="12" x2="12" y1="3" y2="15"></line>
                                                                        </svg>
                                                                        <p class="mb-2 text-sm text-slate-500">
                                                                            <span class="font-semibold">Click
                                                                                to upload</span>
                                                                            signature
                                                                        </p>
                                                                        <p class="text-xs text-slate-500">
                                                                            JPG, JPEG, PNG
                                                                            (MAX. 3MB)</p>
                                                                    </div>
                                                                    <input id="signature-upload" type="file"
                                                                        class="hidden" accept=".png, .jpg, .jpeg"
                                                                        name="signatureUpload">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="text-xs text-slate-500">
                                                        JPG, JPEG, PNG (MAX. 3MB), PDF (MAX. 5MB)</p>
                                                </div>

                                            </div>
                                            <input id="signature" type="file" class="hidden"
                                                accept=".png, .jpg, .jpeg, .pdf">
                                        </div>
                                        <div class="space-y-2" data-doc="passport_bio">
                                            <label
                                                class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium">
                                                Passport Bio Page (Valid)
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <div class="flex items-center justify-center w-full">
                                                <label for="passport_bio_page"
                                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-slate-50  border-slate-300 hover:bg-slate-100 ">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-upload w-8 h-8 mb-2 text-slate-500">
                                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                            </path>
                                                            <polyline points="17 8 12 3 7 8"></polyline>
                                                            <line x1="12" x2="12" y1="3" y2="15"></line>
                                                        </svg>
                                                        <p class="mb-2 text-sm text-slate-500">
                                                            <span class="font-semibold">Click to upload</span>
                                                            passport bio page
                                                        </p>
                                                        <p class="text-xs text-slate-500">
                                                            JPG, JPEG, PNG (MAX. 3MB), PDF (MAX. 5MB)
                                                        </p>
                                                    </div>
                                                    <input id="passport_bio_page" type="file" class="hidden"
                                                        accept=".png, .jpg, .jpeg, .pdf" name="passport_bio_page">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="space-y-2" data-doc="valid_license">
                                            <label
                                                class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium">
                                                Valid License
                                                <span class="text-red-500">*</span>
                                            </label>
                                            <div class="flex items-center justify-center w-full">
                                                <label for="valid-license"
                                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-slate-50  border-slate-300 hover:bg-slate-100 ">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-upload w-8 h-8 mb-2 text-slate-500">
                                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                            </path>
                                                            <polyline points="17 8 12 3 7 8"></polyline>
                                                            <line x1="12" x2="12" y1="3" y2="15"></line>
                                                        </svg>
                                                        <p class="mb-2 text-sm text-slate-500">
                                                            <span class="font-semibold">Click to upload</span>
                                                            valid license
                                                        </p>
                                                        <p class="text-xs text-slate-500">
                                                            JPG, JPEG, PNG (MAX. 3MB), PDF (MAX. 5MB)
                                                        </p>
                                                    </div><input id="valid-license" type="file" class="hidden"
                                                        accept=".png, .jpg, .jpeg, .pdf" name="valid_license">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="space-y-2" data-doc="mbbs_degree">
                                            <label
                                                class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm         font-medium">MBBS
                                                Degree <span class="text-red-500">*</span>
                                            </label>
                                            <div class="flex items-center justify-center w-full">
                                                <label for="mbbs-degree"
                                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-slate-50  border-slate-300 hover:bg-slate-100">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-upload w-8 h-8 mb-2 text-slate-500">
                                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                            </path>
                                                            <polyline points="17 8 12 3 7 8"></polyline>
                                                            <line x1="12" x2="12" y1="3" y2="15"></line>
                                                        </svg>
                                                        <p class="mb-2 text-sm text-slate-500">
                                                            <span class="font-semibold">Click to upload</span>
                                                            MBBS degree
                                                        </p>
                                                        <p class="text-xs text-slate-500">
                                                            JPG, JPEG, PNG (MAX. 3MB), PDF (MAX. 5MB)
                                                        </p>
                                                    </div>
                                                    <input id="mbbs-degree" type="file" class="hidden"
                                                        accept=".png, .jpg, .jpeg, .pdf" name="mbbs_degree">
                                                </label>
                                            </div>
                                        </div>

                                        <div class="space-y-2" data-doc="internship">
                                            <div class="flex items-center justify-between"><label
                                                    class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium">Internship/House
                                                    Job Certificate <span class="text-red-500">*</span></label><span
                                                    class="text-xs text-slate-500">At least
                                                    1 required</span></div><label for="internship-certificate-new-0"
                                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-slate-50  border-slate-300 hover:bg-slate-100 transition-colors">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <div class="flex items-center gap-2 mb-2"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-upload w-6 h-6 text-slate-500">
                                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                            </path>
                                                            <polyline points="17 8 12 3 7 8"></polyline>
                                                            <line x1="12" x2="12" y1="3" y2="15"></line>
                                                        </svg></div>
                                                    <p class="mb-2 text-sm text-slate-500">
                                                        <span class="font-semibold">Click to
                                                            upload</span>
                                                        internship certificate
                                                    </p>
                                                    <p class="text-xs text-slate-500">JPG,
                                                        JPEG, PNG (MAX. 3MB), PDF (MAX. 5MB)</p>
                                                </div><input id="internship-certificate-new-0" type="file"
                                                    class="hidden" accept=".png, .jpg, .jpeg, .pdf"
                                                    name="internship_certificates[]">
                                            </label>
                                        </div>
                                        <div class="space-y-2" data-doc="training">
                                            <label
                                                class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium">Training/Diploma
                                                Certificate <span class="text-red-500">*</span>
                                            </label>
                                            <div class="flex items-center justify-center w-full">
                                                <label for="training-certificate"
                                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-slate-50  border-slate-300 hover:bg-slate-100 ">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-upload w-8 h-8 mb-2 text-slate-500">
                                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                            </path>
                                                            <polyline points="17 8 12 3 7 8"></polyline>
                                                            <line x1="12" x2="12" y1="3" y2="15"></line>
                                                        </svg>
                                                        <p class="mb-2 text-sm text-slate-500">
                                                            <span class="font-semibold">Click to
                                                                upload</span>
                                                            training certificate
                                                        </p>
                                                        <p class="text-xs text-slate-500">
                                                            JPG, JPEG, PNG (MAX. 3MB), PDF (MAX. 5MB)
                                                        </p>
                                                    </div><input id="training-certificate" type="file" class="hidden"
                                                        accept=".png, .jpg, .jpeg, .pdf" name="training_certificate">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="space-y-4" data-doc="experience">
                                            <div class="flex items-center justify-between"><label
                                                    class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium">Experience
                                                    Certificate(s) <span class="text-red-500">*</span></label><span
                                                    class="text-xs text-slate-500">At least
                                                    1 required</span></div><label for="experience-certificate-new-0"
                                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-slate-50  border-slate-300 hover:bg-slate-100  transition-colors">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <div class="flex items-center gap-2 mb-2"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="lucide lucide-upload w-6 h-6 text-slate-500">
                                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4">
                                                            </path>
                                                            <polyline points="17 8 12 3 7 8"></polyline>
                                                            <line x1="12" x2="12" y1="3" y2="15"></line>
                                                        </svg></div>
                                                    <p class="mb-2 text-sm text-slate-500">
                                                        <span class="font-semibold">Click to
                                                            upload</span>
                                                        experience certificate
                                                    </p>
                                                    <p class="text-xs text-slate-500">JPG,
                                                        JPEG, PNG (MAX. 3MB), PDF (MAX. 5MB)</p>
                                                </div>
                                                <input id="experience-certificate-new-0" type="file" class="hidden"
                                                    accept=".png, .jpg, .jpeg, .pdf" name="experience_certificates[]">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-4 justify-end pt-6">
                                <button
                                    class="gap-2 whitespace-nowrap [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 shadow-sm inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-eye h-4 w-4 mr-2">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg><span>Preview</span>
                                </button>
                                <button
                                    class="gap-2 whitespace-nowrap [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 shadow-sm hidden items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"
                                    type="button" id="preview-button"></button>
                                <button
                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary shadow hover:bg-primary/90 h-9 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
                                    type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="loading-modal"
        class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center flex-col transition-opacity duration-300 opacity-0">
        <div class="bg-white rounded-xl shadow-2xl p-8 flex flex-col items-center max-w-sm w-full mx-4 transform transition-all scale-95 duration-300"
            id="loading-modal-inner">
            <svg class="animate-spin -ml-1 mr-3 h-10 w-10 text-indigo-600 mb-4" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
            <h3 class="text-xl font-bold text-slate-800 tracking-tight">Checking Eligibility...</h3>
            <p class="text-slate-500 mt-2 text-center text-sm">Please wait while we verify your details.</p>
        </div>
    </div>

   

    <script>
        // =============================================
        // SIGNATURE PAD — Native HTML5 Canvas
        // =============================================
        let sigCanvas, sigCtx, sigDrawing = false, sigHasDrawn = false;

        function initSignaturePad() {
            sigCanvas = document.getElementById('signature-canvas');
            if (!sigCanvas || sigCanvas.dataset.initialized === 'true') return;
            
            const section = sigCanvas.closest('#signature-draw-section');
            if (!section || section.classList.contains('hidden')) return;
            if (sigCanvas.offsetWidth === 0) return;

            // Set canvas resolution to match display size
            const rect = sigCanvas.getBoundingClientRect();
            sigCanvas.width = rect.width;
            sigCanvas.height = rect.height;
            sigCtx = sigCanvas.getContext('2d');
            sigCtx.fillStyle = '#ffffff';
            sigCtx.fillRect(0, 0, sigCanvas.width, sigCanvas.height);
            sigCtx.strokeStyle = '#000000';
            sigCtx.lineWidth = 2;
            sigCtx.lineCap = 'round';
            sigCtx.lineJoin = 'round';

            // Mouse events
            sigCanvas.addEventListener('mousedown', sigStart);
            sigCanvas.addEventListener('mousemove', sigMove);
            sigCanvas.addEventListener('mouseup', sigEnd);
            sigCanvas.addEventListener('mouseleave', sigEnd);

            // Touch events
            sigCanvas.addEventListener('touchstart', sigTouchStart, { passive: false });
            sigCanvas.addEventListener('touchmove', sigTouchMove, { passive: false });
            sigCanvas.addEventListener('touchend', sigEnd);
            sigCanvas.addEventListener('touchcancel', sigEnd);

            sigCanvas.dataset.initialized = 'true';
            console.log('Signature canvas initialized:', sigCanvas.width, 'x', sigCanvas.height);
        }

        function sigGetPos(e) {
            const rect = sigCanvas.getBoundingClientRect();
            return { x: e.clientX - rect.left, y: e.clientY - rect.top };
        }

        function sigStart(e) {
            sigDrawing = true;
            sigHasDrawn = true;
            const pos = sigGetPos(e);
            sigCtx.beginPath();
            sigCtx.moveTo(pos.x, pos.y);
        }

        function sigMove(e) {
            if (!sigDrawing) return;
            const pos = sigGetPos(e);
            sigCtx.lineTo(pos.x, pos.y);
            sigCtx.stroke();
        }

        function sigEnd() {
            if (sigDrawing) {
                sigDrawing = false;
                sigCtx.closePath();
                // Save data URL to hidden input
                document.getElementById('signature-data').value = sigCanvas.toDataURL('image/png');
            }
        }

        function sigTouchStart(e) {
            e.preventDefault();
            const touch = e.touches[0];
            const mouseEvent = new MouseEvent('mousedown', { clientX: touch.clientX, clientY: touch.clientY });
            sigStart(mouseEvent);
        }

        function sigTouchMove(e) {
            e.preventDefault();
            const touch = e.touches[0];
            const mouseEvent = new MouseEvent('mousemove', { clientX: touch.clientX, clientY: touch.clientY });
            sigMove(mouseEvent);
        }

        function clearSignature() {
            if (sigCanvas && sigCtx) {
                sigCtx.fillStyle = '#ffffff';
                sigCtx.fillRect(0, 0, sigCanvas.width, sigCanvas.height);
                sigCtx.strokeStyle = '#000000';
                sigHasDrawn = false;
            }
            document.getElementById('signature-data').value = '';
        }

        // Signature tab switching
        function switchSignatureTab(tab) {
            const drawSection = document.getElementById('signature-draw-section');
            const uploadSection = document.getElementById('signature-upload-section');
            const drawBtn = document.getElementById('sig-tab-draw');
            const uploadBtn = document.getElementById('sig-tab-upload');

            if (tab === 'draw') {
                drawSection.classList.remove('hidden');
                uploadSection.classList.add('hidden');
                drawBtn.className = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-9 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow transition-all duration-200 transform hover:scale-105';
                uploadBtn.className = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-10 px-4 py-2 border border-slate-200 bg-white text-slate-700 shadow-sm hover:bg-slate-50';
                setTimeout(initSignaturePad, 100);
            } else {
                drawSection.classList.add('hidden');
                uploadSection.classList.remove('hidden');
                uploadBtn.className = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-9 px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow transition-all duration-200 transform hover:scale-105';
                drawBtn.className = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-10 px-4 py-2 border border-slate-200 bg-white text-slate-700 shadow-sm hover:bg-slate-50';
            }
        }

        // =============================================
        // PHONE INPUT — Country Code Selector with Flags
        // =============================================
        const COUNTRIES = [
            { code: 'PK', name: 'Pakistan', dial: '+92', minLen: 10, maxLen: 11 },
            { code: 'IN', name: 'India', dial: '+91', minLen: 10, maxLen: 10 },
            { code: 'BD', name: 'Bangladesh', dial: '+880', minLen: 10, maxLen: 10 },
            { code: 'LK', name: 'Sri Lanka', dial: '+94', minLen: 9, maxLen: 9 },
            { code: 'NP', name: 'Nepal', dial: '+977', minLen: 10, maxLen: 10 },
            { code: 'SA', name: 'Saudi Arabia', dial: '+966', minLen: 9, maxLen: 9 },
            { code: 'AE', name: 'United Arab Emirates', dial: '+971', minLen: 9, maxLen: 9 },
            { code: 'GB', name: 'United Kingdom', dial: '+44', minLen: 10, maxLen: 11 },
            { code: 'MM', name: 'Myanmar', dial: '+95', minLen: 8, maxLen: 10 },
            { code: 'US', name: 'United States', dial: '+1', minLen: 10, maxLen: 10 },
            { code: 'CA', name: 'Canada', dial: '+1', minLen: 10, maxLen: 10 },
            { code: 'AU', name: 'Australia', dial: '+61', minLen: 9, maxLen: 9 },
            { code: 'MY', name: 'Malaysia', dial: '+60', minLen: 9, maxLen: 10 },
            { code: 'QA', name: 'Qatar', dial: '+974', minLen: 8, maxLen: 8 },
            { code: 'KW', name: 'Kuwait', dial: '+965', minLen: 8, maxLen: 8 },
            { code: 'BH', name: 'Bahrain', dial: '+973', minLen: 8, maxLen: 8 },
            { code: 'OM', name: 'Oman', dial: '+968', minLen: 8, maxLen: 8 },
            { code: 'AF', name: 'Afghanistan', dial: '+93', minLen: 9, maxLen: 9 },
            { code: 'IR', name: 'Iran', dial: '+98', minLen: 10, maxLen: 11 },
            { code: 'IQ', name: 'Iraq', dial: '+964', minLen: 10, maxLen: 10 },
            { code: 'JO', name: 'Jordan', dial: '+962', minLen: 9, maxLen: 9 },
            { code: 'EG', name: 'Egypt', dial: '+20', minLen: 10, maxLen: 11 },
            { code: 'ZA', name: 'South Africa', dial: '+27', minLen: 9, maxLen: 9 },
            { code: 'NG', name: 'Nigeria', dial: '+234', minLen: 10, maxLen: 11 },
            { code: 'KE', name: 'Kenya', dial: '+254', minLen: 9, maxLen: 10 },
            { code: 'DE', name: 'Germany', dial: '+49', minLen: 10, maxLen: 12 },
            { code: 'FR', name: 'France', dial: '+33', minLen: 9, maxLen: 9 },
            { code: 'IT', name: 'Italy', dial: '+39', minLen: 9, maxLen: 11 },
            { code: 'TR', name: 'Turkey', dial: '+90', minLen: 10, maxLen: 10 },
            { code: 'CN', name: 'China', dial: '+86', minLen: 11, maxLen: 11 },
            { code: 'JP', name: 'Japan', dial: '+81', minLen: 10, maxLen: 11 },
            { code: 'KR', name: 'South Korea', dial: '+82', minLen: 10, maxLen: 11 },
            { code: 'SG', name: 'Singapore', dial: '+65', minLen: 8, maxLen: 8 },
            { code: 'PH', name: 'Philippines', dial: '+63', minLen: 10, maxLen: 10 },
            { code: 'TH', name: 'Thailand', dial: '+66', minLen: 9, maxLen: 9 },
            { code: 'ID', name: 'Indonesia', dial: '+62', minLen: 10, maxLen: 13 },
            { code: 'VN', name: 'Vietnam', dial: '+84', minLen: 9, maxLen: 10 },
            { code: 'BR', name: 'Brazil', dial: '+55', minLen: 10, maxLen: 11 },
            { code: 'MX', name: 'Mexico', dial: '+52', minLen: 10, maxLen: 10 },
            { code: 'RU', name: 'Russia', dial: '+7', minLen: 10, maxLen: 10 },
        ];

        // Tracks currently selected country per field
        const phoneState = {
            whatsapp: COUNTRIES[0],   // Default: Pakistan
            emergency: COUNTRIES[0],  // Default: Pakistan
        };

        function getFlagUrl(countryCode) {
            return `https://flagcdn.com/w40/${countryCode.toLowerCase()}.png`;
        }

        function renderCountryDropdown(type) {
            const dropdown = document.getElementById(`${type}-dropdown`);
            let html = '<input type="text" class="country-search" placeholder="Search country..." oninput="filterCountries(this, \'' + type + '\')">';
            COUNTRIES.forEach((c, i) => {
                const selected = phoneState[type].code === c.code ? ' selected' : '';
                html += `<div class="country-option${selected}" data-index="${i}" onclick="selectCountry('${type}', ${i})">
                    <img src="${getFlagUrl(c.code)}" alt="${c.code}">
                    <span>${c.name}</span>
                    <span class="dial">${c.dial}</span>
                </div>`;
            });
            dropdown.innerHTML = html;
        }

        function toggleCountryDropdown(type) {
            const dropdown = document.getElementById(`${type}-dropdown`);
            const isOpen = dropdown.classList.contains('open');
            // Close all dropdowns first
            document.querySelectorAll('.phone-country-dropdown').forEach(d => d.classList.remove('open'));
            if (!isOpen) {
                renderCountryDropdown(type);
                dropdown.classList.add('open');
                setTimeout(() => dropdown.querySelector('.country-search')?.focus(), 50);
            }
        }

        function selectCountry(type, index) {
            const country = COUNTRIES[index];
            phoneState[type] = country;
            document.getElementById(`${type}-flag`).innerHTML = `<img src="${getFlagUrl(country.code)}" alt="${country.code}" style="width:100%;height:100%;object-fit:cover;border-radius:2px">`;
            document.getElementById(`${type}-dial-code`).textContent = country.dial;
            document.getElementById(`${type}-dropdown`).classList.remove('open');
            // Sync hidden field
            syncPhoneHidden(type);
        }

        function filterCountries(searchInput, type) {
            const query = searchInput.value.toLowerCase();
            const options = searchInput.parentElement.querySelectorAll('.country-option');
            options.forEach(opt => {
                const name = opt.querySelector('span').textContent.toLowerCase();
                const dial = opt.querySelector('.dial').textContent;
                opt.style.display = (name.includes(query) || dial.includes(query)) ? '' : 'none';
            });
        }

        function syncPhoneHidden(type) {
            const inputId = type === 'whatsapp' ? 'whatsappNumber' : 'emergencyContactNumber';
            const hiddenId = inputId + '-full';
            const val = document.getElementById(inputId).value.replace(/[^0-9]/g, '');
            const dial = phoneState[type].dial;
            document.getElementById(hiddenId).value = val ? (dial + val) : '';
        }

        function validatePhoneNumber(type) {
            const inputId = type === 'whatsapp' ? 'whatsappNumber' : 'emergencyContactNumber';
            const val = document.getElementById(inputId).value.replace(/[^0-9]/g, '');
            if (!val) return { valid: false, error: (type === 'whatsapp' ? 'WhatsApp' : 'Emergency contact') + ' number is required' };
            const country = phoneState[type];
            if (val.length < country.minLen || val.length > country.maxLen) {
                return { valid: false, error: `${country.name} numbers should be ${country.minLen === country.maxLen ? country.minLen : country.minLen + '-' + country.maxLen} digits` };
            }
            return { valid: true };
        }

        function initPhoneInputs() {
            // Set default flags (Pakistan)
            ['whatsapp', 'emergency'].forEach(type => {
                const c = phoneState[type];
                document.getElementById(`${type}-flag`).innerHTML = `<img src="${getFlagUrl(c.code)}" alt="${c.code}" style="width:100%;height:100%;object-fit:cover;border-radius:2px">`;
                document.getElementById(`${type}-dial-code`).textContent = c.dial;
            });

            // Input listeners
            document.getElementById('whatsappNumber').addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                syncPhoneHidden('whatsapp');
            });
            document.getElementById('emergencyContactNumber').addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                syncPhoneHidden('emergency');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.phone-country-dropdown') && !e.target.closest('button[onclick*="toggleCountryDropdown"]')) {
                    document.querySelectorAll('.phone-country-dropdown').forEach(d => d.classList.remove('open'));
                }
            });
        }

        // =============================================
        // FILE NAME DISPLAY on file inputs
        // =============================================
        function initFileNameDisplay() {
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    // Remove existing badge
                    const existingBadge = this.closest('.space-y-2, label')?.querySelector('.file-name-badge');
                    if (existingBadge) existingBadge.remove();

                    if (this.files && this.files.length > 0) {
                        const names = Array.from(this.files).map(f => f.name);
                        const badge = document.createElement('div');
                        badge.className = 'file-name-badge';
                        badge.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg><span>${names.join(', ')}</span>`;
                        
                        // Try to insert badge after the label wrapper
                        const container = this.closest('[data-doc]') || this.closest('.space-y-2');
                        if (container) {
                            container.appendChild(badge);
                        } else {
                            this.parentElement.after(badge);
                        }

                        // Also update the upload label text if it's inside a label
                        const parentLabel = this.closest('label');
                        if (parentLabel) {
                            const uploadText = parentLabel.querySelector('.font-semibold');
                            if (uploadText && uploadText.textContent.includes('Click')) {
                                uploadText.textContent = '✓ File selected';
                                uploadText.closest('p').classList.add('text-indigo-600');
                            }
                        }
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Init phone inputs with country codes
            initPhoneInputs();
            // Init file name display
            initFileNameDisplay();

            const radioCheckedSVG = '<span data-state="checked" class="flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle h-2.5 w-2.5 fill-indigo-600 text-indigo-600"><circle cx="12" cy="12" r="10"></circle></svg></span>';
            const checkboxCheckedSVG = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check h-4 w-4"><polyline points="20 6 9 17 4 12"></polyline></svg>';

            // ==============================
            // Make Radix-style Checkboxes work
            // ==============================
            const allCheckboxBtns = document.querySelectorAll('button[role="checkbox"]');
            allCheckboxBtns.forEach(cb => {
                cb.addEventListener('click', (e) => {
                    e.preventDefault();
                    const isChecked = cb.getAttribute('data-state') === 'checked';
                    const newState = isChecked ? 'unchecked' : 'checked';
                    cb.setAttribute('data-state', newState);
                    cb.setAttribute('aria-checked', String(!isChecked));
                    cb.innerHTML = newState === 'checked' ? checkboxCheckedSVG : '';
                    const hiddenInput = cb.nextElementSibling;
                    if (hiddenInput && hiddenInput.tagName === 'INPUT') hiddenInput.checked = !isChecked;
                });
            });

            // ==============================
            // Candidate Type Toggle (New / Old)
            // ==============================
            const candTypeWrappers = document.querySelectorAll('.cand-type-wrapper');
            const candidateTypeRadios = document.querySelectorAll('button[role="radio"][value="new"], button[role="radio"][value="old"]');
            const candidateIdContainer = document.getElementById('candidate-id-container');
            const candTypeInputs = document.querySelectorAll('input[name="candidateType"]');
            let currentCandidateType = 'new'; // track current selection

            function handleCandidateTypeChange(type, sourceEl) {
                currentCandidateType = type;
                const isOld = type === 'old';
                const wrapper = sourceEl.closest('.cand-type-wrapper');

                if (isOld) {
                    candidateIdContainer.classList.remove('hidden');
                    document.querySelector('input[name="candidateType"][value="old"]').disabled = false;
                    document.querySelector('input[name="candidateType"][value="new"]').disabled = true;
                } else {
                    candidateIdContainer.classList.add('hidden');
                    document.querySelector('input[name="candidateType"][value="new"]').disabled = false;
                    document.querySelector('input[name="candidateType"][value="old"]').disabled = true;
                    const cidInput = document.getElementById('step1-candidateId');
                    if (cidInput) cidInput.value = '';
                }

                // Radix emulation for these radios
                candidateTypeRadios.forEach(btn => {
                    btn.setAttribute('data-state', 'unchecked');
                    btn.setAttribute('aria-checked', 'false');
                    btn.innerHTML = '';
                    const radioWrapper = btn.closest('.cand-type-wrapper');
                    if (radioWrapper) {
                        radioWrapper.classList.remove('border-indigo-500', 'bg-indigo-50');
                        radioWrapper.classList.add('border-slate-200', 'bg-slate-50');
                    }
                });

                const activeRadio = document.getElementById(isOld ? 'radio-old' : 'radio-new');
                if (activeRadio) {
                    activeRadio.setAttribute('data-state', 'checked');
                    activeRadio.setAttribute('aria-checked', 'true');
                    activeRadio.innerHTML = radioCheckedSVG;
                }

                if (wrapper) {
                    wrapper.classList.remove('border-slate-200', 'bg-slate-50');
                    wrapper.classList.add('border-indigo-500', 'bg-indigo-50');
                }

                clearErrorForField('radio-new');
            }

            candTypeWrappers.forEach(wrapper => {
                wrapper.addEventListener('click', (e) => {
                    const type = wrapper.getAttribute('data-target') === 'radio-old' ? 'old' : 'new';
                    handleCandidateTypeChange(type, wrapper);
                });
            });

            candidateTypeRadios.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    handleCandidateTypeChange(btn.value, btn);
                });
            });

            // Set initial visual state for New Candidate (default)
            const newWrapper = document.querySelector('.cand-type-wrapper[data-target="radio-new"]');
            if (newWrapper) {
                newWrapper.classList.remove('border-slate-200', 'bg-slate-50');
                newWrapper.classList.add('border-indigo-500', 'bg-indigo-50');
            }

            // ===================
            // Error helpers
            // ===================
            function showFieldError(inputEl, message) {
                let container = inputEl.closest('.space-y-2') || inputEl.closest('.space-y-3') || inputEl.parentElement;
                // Remove existing error
                container.querySelectorAll('.error-msg').forEach(m => m.remove());
                // Red border on input
                if (inputEl.tagName === 'INPUT' || inputEl.tagName === 'SELECT') {
                    inputEl.classList.remove('border-slate-200', 'focus-visible:ring-indigo-500');
                    inputEl.classList.add('border-red-500', 'focus-visible:ring-red-500');
                }
                // Red label
                const label = container.querySelector('label');
                if (label) label.classList.add('text-red-500');
                // Error message
                const errorP = document.createElement('p');
                errorP.className = 'error-msg text-sm text-red-500 mt-1 font-medium transition-all duration-200';
                errorP.innerText = message;
                container.appendChild(errorP);
            }

            function clearErrorForField(inputId) {
                const el = document.getElementById(inputId);
                if (!el) return;
                const container = el.closest('.space-y-2') || el.closest('.space-y-3') || el.closest('.grid') || el.parentElement;
                if (container) {
                    container.querySelectorAll('.error-msg').forEach(msg => msg.remove());
                    container.querySelectorAll('label.text-red-500').forEach(l => l.classList.remove('text-red-500'));
                }
                el.classList.remove('border-red-500', 'focus-visible:ring-red-500');
                if (el.tagName === 'INPUT' || el.tagName === 'SELECT') {
                    el.classList.add('border-slate-200', 'focus-visible:ring-indigo-500');
                }
            }

            const clearAllErrors = (scope) => {
                const root = scope || document;
                root.querySelectorAll('.error-msg').forEach(el => el.remove());
                root.querySelectorAll('.border-red-500').forEach(el => {
                    el.classList.remove('border-red-500', 'focus-visible:ring-red-500');
                    if (el.tagName !== 'BUTTON') el.classList.add('border-slate-200', 'focus-visible:ring-indigo-500');
                });
                root.querySelectorAll('label.text-red-500').forEach(el => el.classList.remove('text-red-500'));
            };

            const showInlineErrors = (errors, scopeEl) => {
                let firstErrorEl = null;
                Object.keys(errors).forEach(key => {
                    const messages = errors[key];
                    const inputEl = document.querySelector(`[name="${key}"]`);
                    if (inputEl && (!scopeEl || scopeEl.contains(inputEl))) {
                        showFieldError(inputEl, messages[0]);
                        if (!firstErrorEl) firstErrorEl = inputEl;
                    }
                });
                if (firstErrorEl) {
                    firstErrorEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    setTimeout(() => { if (firstErrorEl.focus) firstErrorEl.focus(); }, 500);
                }
            };

            // ==============================
            // REAL-TIME BLUR VALIDATION
            // ==============================
            const validationRules = {
                'usualForename': { required: true, label: 'Usual Forename is required' },
                'lastName': { required: true, label: 'Last Name is required' },
                'fullNameOnRecord': { required: true, label: 'Full name as you would like it on record is required' },
                'email': { required: true, label: 'Email is required', email: true, emailMsg: 'Invalid email address' },
                'step1-passportNumber': { required: true, label: 'Passport Number is required' },
                'step1-candidateId': { required: false, label: 'Candidate ID is required', conditional: () => currentCandidateType === 'old' },
                'whatsappNumber': { required: true, label: 'WhatsApp number is required' },
                'emergencyContactNumber': { required: true, label: 'Emergency contact number is required' },
                'previousAttempts': { required: true, label: 'Please select number of previous attempts' },
                'poBox': { required: true, label: 'House no. and street is required' },
                'district': { required: true, label: 'District is required' },
                'city': { required: true, label: 'City is required' },
                'province': { required: true, label: 'Province is required' },
                'country': { required: true, label: 'Country is required' },
                'schoolName': { required: true, label: 'Name of medical school is required' },
                'schoolLocation': { required: true, label: 'Country of medical school is required' },
                'countryOfExperience': { required: true, label: 'Country of postgraduate clinical experience is required' },
                'countryOfOrigin': { required: true, label: 'Country of ethnic origin is required' },
                'registrationAuthority': { required: true, label: 'Registration authority is required' },
                'registrationNumber': { required: true, label: 'Registration number is required' },
                'registrationDate': { required: true, label: 'Date of full registration is required' },
            };

            // Attach blur listeners to all validatable fields
            Object.keys(validationRules).forEach(fieldId => {
                const el = document.getElementById(fieldId);
                if (!el) return;
                el.addEventListener('blur', () => {
                    const rule = validationRules[fieldId];
                    // Check conditional
                    if (rule.conditional && !rule.conditional()) return;
                    const val = el.value.trim();
                    if ((rule.required || (rule.conditional && rule.conditional())) && !val) {
                        showFieldError(el, rule.label);
                    } else if (rule.email && val && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
                        showFieldError(el, rule.emailMsg);
                    }
                });
                el.addEventListener('input', () => {
                    clearErrorForField(fieldId);
                });
            });

            // ================================
            // ELIGIBILITY RADIO HANDLER
            // ================================
            const eligSectionWrapper = document.getElementById('eligibility-section-wrapper');
            const eligRequiredWarning = document.getElementById('eligibility-required-warning');
            const requiredDocsWrapper = document.getElementById('required-docs-wrapper');

            function updateStep2Sections() {
                console.log('Updating Step 2 Sections for:', currentCandidateType);
                if (currentCandidateType === 'old') {
                    // Old candidate: hide eligibility section, show only basic docs
                    if (eligSectionWrapper) eligSectionWrapper.classList.add('hidden');
                    if (eligRequiredWarning) eligRequiredWarning.classList.add('hidden');
                    updateDocumentVisibility(docVisibilityMap['old']);
                } else {
                    // New candidate: show eligibility radios
                    if (eligSectionWrapper) eligSectionWrapper.classList.remove('hidden');

                    // Check if an eligibility criterion is already selected
                    const checkedElig = document.querySelector('#eligibility input[name="eligibilityCriterion"]:checked');
                    if (checkedElig) {
                        updateDocumentVisibility(docVisibilityMap[checkedElig.value] || docVisibilityMap['all']);
                    } else {
                        // No criterion selected yet — show ALL docs so user sees what's needed
                        updateDocumentVisibility(docVisibilityMap['all']);
                    }
                }
            }

            // Document visibility map per eligibility criterion
            // A = all except experience | B = all | C = all except training
            const docVisibilityMap = {
                'old': ['signature', 'passport_bio', 'valid_license'],
                'all': ['signature', 'passport_bio', 'valid_license', 'mbbs_degree', 'internship', 'training', 'experience'],
                'A':   ['signature', 'passport_bio', 'valid_license', 'mbbs_degree', 'internship', 'training'],
                'B':   ['signature', 'passport_bio', 'valid_license', 'mbbs_degree', 'internship', 'training', 'experience'],
                'C':   ['signature', 'passport_bio', 'valid_license', 'mbbs_degree', 'internship', 'experience'],
            };

            function updateDocumentVisibility(docsToShow) {
                console.log('Showing docs:', docsToShow);
                const allDocs = document.querySelectorAll('[data-doc]');
                allDocs.forEach(docEl => {
                    const docKey = docEl.getAttribute('data-doc');
                    if (docsToShow.includes(docKey)) {
                        docEl.classList.remove('hidden');
                    } else {
                        docEl.classList.add('hidden');
                    }
                });
                if (requiredDocsWrapper) requiredDocsWrapper.classList.remove('hidden');
                if (eligRequiredWarning) eligRequiredWarning.classList.add('hidden');

                if (docsToShow.includes('signature')) {
                    setTimeout(initSignaturePad, 50);
                }
            }

            // Eligibility radio click handler (native radios)
            const eligibilityRadiosNative = document.querySelectorAll('#eligibility input[type="radio"]');
            eligibilityRadiosNative.forEach(radio => {
                radio.addEventListener('change', (e) => {
                    // Remove highlight from all labels
                    document.querySelectorAll('#eligibility label').forEach(lbl => {
                        lbl.classList.remove('border-indigo-500', 'bg-indigo-50');
                        lbl.classList.add('border-slate-200', 'bg-slate-50');
                    });

                    // Add highlight to selected label
                    const parentLabel = radio.closest('label');
                    if (parentLabel) {
                        parentLabel.classList.remove('border-slate-200', 'bg-slate-50');
                        parentLabel.classList.add('border-indigo-500', 'bg-indigo-50');
                    }

                    // Update document visibility based on selected criterion
                    updateDocumentVisibility(docVisibilityMap[radio.value] || docVisibilityMap['all']);
                });
            });

            // Exam center radio — use native radio inputs
            const examCenterRadios = document.querySelectorAll('#examCenterPreference input[type="radio"]');
            examCenterRadios.forEach(r => {
                r.setAttribute('name', 'examCenterPreference');
            });

            // ================================
            // STEP 1 → CHECK ELIGIBILITY (AJAX)
            // ================================
            const checkEligBtn = document.getElementById('check-eligibility-btn');
            const step1 = document.getElementById('step-1');
            const form = document.getElementById('application-form');

            if (checkEligBtn) {
                checkEligBtn.addEventListener('click', () => {
                    clearAllErrors(step1);

                    // Frontend: disclaimer must be checked
                    const disclaimerCb = document.getElementById('duplicate-disclaimer');
                    if (!disclaimerCb.checked) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Disclaimer Required',
                            text: 'You must accept the duplicate entry disclaimer to proceed.',
                            confirmButtonColor: '#6366f1',
                        });
                        const btn = document.getElementById('duplicate-disclaimer-btn');
                        if (btn) {
                            btn.classList.add('border-red-500');
                            btn.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                        return;
                    }

                    // Validate Step 1 required fields
                    const step1Errors = {};
                    const forenameVal = document.getElementById('usualForename').value.trim();
                    if (!forenameVal) step1Errors['usualForename'] = ['Usual Forename is required'];
                    const lastNameVal = document.getElementById('lastName').value.trim();
                    if (!lastNameVal) step1Errors['lastName'] = ['Last Name is required'];
                    const emailVal = document.getElementById('email').value.trim();
                    if (!emailVal) {
                        step1Errors['email'] = ['Email is required'];
                    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal)) {
                        step1Errors['email'] = ['Invalid email address'];
                    }
                    const passportVal = document.getElementById('step1-passportNumber').value.trim();
                    if (!passportVal) step1Errors['passportNumber'] = ['Passport Number is required'];

                    // if (currentCandidateType === 'old') {
                    //     const candId = document.getElementById('step1-candidateId').value.trim();
                    //     if (!candId) step1Errors['candidateId'] = ['Candidate ID is required'];
                    //     else if (candId.length !== 7) step1Errors['candidateId'] = ['Candidate ID must be 7 digits'];
                    // }

                    if (Object.keys(step1Errors).length > 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: 'Please fill in all required fields correctly.',
                            confirmButtonColor: '#6366f1',
                        });
                        showInlineErrors(step1Errors, step1);
                        return;
                    }

                    // *** REAL BACKEND ELIGIBILITY CHECK ***
                    Swal.fire({
                        title: 'Checking Eligibility...',
                        html: '<div class="flex flex-col items-center"><p class="text-slate-500 mt-2">Please wait while we verify your details.</p></div>',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => { Swal.showLoading(); }
                    });

                    const eligPayload = {
                        _token: document.querySelector('input[name="_token"]').value,
                        candidateType: currentCandidateType,
                        passportNumber: passportVal,
                    };
                    if (currentCandidateType === 'new') {
                        eligPayload.email = emailVal;
                        eligPayload.usualForename = forenameVal;
                        eligPayload.lastName = lastNameVal;
                    } else {
                        eligPayload.candidateId = document.getElementById('step1-candidateId').value.trim();
                    }

                    $.ajax({
                        url: '/check-eligibility',
                        method: 'POST',
                        data: eligPayload,
                        success: function(resp) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Eligibility Confirmed!',
                                text: resp.message || 'You are eligible. Please proceed to complete your application.',
                                confirmButtonColor: '#6366f1',
                                timer: 2500,
                                timerProgressBar: true,
                            }).then(() => {
                                step1.classList.add('hidden');
                                const step2 = document.getElementById('step-2');
                                if (step2) {
                                    step2.classList.remove('hidden');
                                    updateStep2Sections();
                                    setTimeout(initSignaturePad, 50);
                                    step2.scrollIntoView({ behavior: 'smooth', block: 'start' });
                                }
                            });
                        },
                        error: function(xhr) {
                            const data = xhr.responseJSON || {};
                            if (xhr.status === 409) {
                                // Duplicate detected
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Duplicate Application',
                                    text: data.message || 'A duplicate application was detected.',
                                    confirmButtonColor: '#6366f1',
                                });
                                if (data.errors) showInlineErrors(data.errors, step1);
                            } else if (xhr.status === 422) {
                                // Validation errors
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Error',
                                    text: 'Please fix the errors below.',
                                    confirmButtonColor: '#6366f1',
                                });
                                if (data.errors) showInlineErrors(data.errors, step1);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Server Error',
                                    text: 'An unexpected error occurred. Please try again.',
                                    confirmButtonColor: '#6366f1',
                                });
                            }
                        }
                    });
                });
            }

            // ================================
            // FORM SUBMISSION (Step 2 — AJAX)
            // ================================
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                clearAllErrors();

                // Validate step 2 required fields
                const step2Errors = {};
                const step2Fields = ['fullNameOnRecord', 'previousAttempts', 'poBox', 'district', 'city', 'province', 'country'];
                step2Fields.forEach(fid => {
                    const el = document.getElementById(fid);
                    if (el && !el.value.trim()) {
                        const rule = validationRules[fid];
                        step2Errors[fid] = [rule ? rule.label : (fid + ' is required')];
                    }
                });

                // Validate phone numbers using country-aware validation
                const waCheck = validatePhoneNumber('whatsapp');
                if (!waCheck.valid) {
                    step2Errors['whatsappNumber'] = [waCheck.error];
                }

                const emCheck = validatePhoneNumber('emergency');
                if (!emCheck.valid) {
                    step2Errors['emergencyContactNumber'] = [emCheck.error];
                }

                // Check education fields
                const eduFields = {
                    'schoolName': 'Name of medical school',
                    'schoolLocation': 'Country of medical school',
                    'qualificationYear': 'Year of qualification',
                    'countryOfExperience': 'Country of postgraduate experience',
                    'countryOfOrigin': 'Country of ethnic origin',
                    'registrationAuthority': 'Registration authority',
                    'registrationNumber': 'Registration number',
                    'registrationDate': 'Date of full registration'
                };
                Object.entries(eduFields).forEach(([id, label]) => {
                    const el = document.getElementById(id);
                    if (el && !el.value.trim()) {
                        step2Errors[el.name || id] = [label.trim() + ' is required'];
                    }
                });

                // Check exam center
                const selectedCenter = document.querySelector('#examCenterPreference input[type="radio"]:checked');
                if (!selectedCenter) {
                    step2Errors['examCenterPreference'] = ['Please select an examination center'];
                }

                // Check terms
                const termsCb = document.querySelector('input[name="termsAccepted"]');
                if (!termsCb || !termsCb.checked) {
                    step2Errors['termsAccepted'] = ['You must accept the terms and conditions'];
                }

                // Check eligibility for new candidates
                if (currentCandidateType === 'new') {
                    // Use native radio selector (no longer Radix buttons)
                    const checkedElig = document.querySelector('#eligibility input[name="eligibilityCriterion"]:checked');
                    if (!checkedElig) {
                        step2Errors['eligibilityCriterion'] = ['Please select an eligibility criterion'];
                    }
                }

                if (Object.keys(step2Errors).length > 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: '<div style="text-align:left;font-size:14px;">' +
                            Object.values(step2Errors).map(msgs => `<p style="margin-bottom:4px;">• ${msgs[0]}</p>`).join('') +
                            '</div>',
                        confirmButtonColor: '#6366f1',
                    });
                    showInlineErrors(step2Errors);
                    return;
                }

                // Frontend: check signature
                const sigData = document.getElementById('signature-data').value;
                const sigUpload = document.getElementById('signature-upload');
                const hasSig = (sigData && sigData.length > 10) || (sigUpload && sigUpload.files.length > 0);

                if (!hasSig) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Signature Required',
                        text: 'Please draw or upload your signature before submitting.',
                        confirmButtonColor: '#6366f1',
                    });
                    document.querySelector('#signature-draw-section, #signature-upload-section')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return;
                }

                // Check other visible documents
                const visibleDocs = document.querySelectorAll('[data-doc]:not(.hidden)');
                let missingDocs = [];
                visibleDocs.forEach(docEl => {
                    const docKey = docEl.getAttribute('data-doc');
                    if (docKey === 'signature') return; // handled above

                    const fileInput = docEl.querySelector('input[type="file"]');
                    if (fileInput && fileInput.files.length === 0) {
                        const labelText = docEl.querySelector('label')?.innerText.replace('*', '').trim();
                        missingDocs.push(labelText || docKey);
                    }
                });

                if (missingDocs.length > 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Missing Documents',
                        html: '<p>Please upload the following required documents:</p><ul class="text-left mt-2">' +
                            missingDocs.map(d => `<li>• ${d}</li>`).join('') + '</ul>',
                        confirmButtonColor: '#6366f1',
                    });
                    return;
                }

                // *** REAL SUBMISSION FLOW ***
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Submitting...';
                submitBtn.disabled = true;

                // Sync phone hidden fields with full international numbers
                syncPhoneHidden('whatsapp');
                syncPhoneHidden('emergency');

                const formData = new FormData(form);

                // Ensure signature data is included (drawn signature)
                const sigDataVal = document.getElementById('signature-data').value;
                if (sigDataVal && sigDataVal.length > 10) {
                    formData.set('signature', sigDataVal);
                }

                // NOTE: examCenterPreference and eligibilityCriterion are now native
                // radio inputs — they are automatically included by FormData(form).
                // No manual formData.set() needed.

                $.ajax({
                    url: '/apply',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(resp) {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                        Swal.fire({
                            icon: 'success',
                            title: 'Application Submitted!',
                            text: resp.message || 'Your application has been submitted successfully.',
                            confirmButtonColor: '#6366f1',
                        }).then(() => {
                            // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Clear Step 2 form fields
        form.reset();

        // Clear drawn signature if any
        clearSignature();

        // Clear file name badges
        document.querySelectorAll('.file-name-badge').forEach(el => el.remove());
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.value = '';
            const uploadText = input.closest('label')?.querySelector('.font-semibold');
            if (uploadText && uploadText.textContent.includes('✓')) {
                uploadText.textContent = 'Click to upload file';
                uploadText.closest('p').classList.remove('text-indigo-600');
            }
        });

        // Reset Step 1 section visibility
        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');
        if (step1 && step2) {
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
            step1.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // Reset candidate type to default ('new')
        handleCandidateTypeChange('new', document.querySelector('.cand-type-wrapper[data-target="radio-new"]')); 
                        });
                    },
                    error: function(xhr) {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                        const data = xhr.responseJSON || {};
                        if (xhr.status === 409) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Duplicate Application',
                                text: data.message || 'A duplicate application was detected.',
                                confirmButtonColor: '#6366f1',
                            });
                        } else if (xhr.status === 422) {
                            const errorList = data.errors ? Object.values(data.errors).map(msgs => `<p style="margin-bottom:4px;">• ${msgs[0]}</p>`).join('') : '';
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: '<div style="text-align:left;font-size:14px;">' + errorList + '</div>',
                                confirmButtonColor: '#6366f1',
                            });
                            if (data.errors) showInlineErrors(data.errors);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Server Error',
                                text: data.message || 'An unexpected error occurred. Please try again.',
                                confirmButtonColor: '#6366f1',
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>