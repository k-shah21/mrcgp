const fs = require('fs');

const step1Html = `
    <div id="step-1" class="space-y-6">
        <div class="w-full mb-4">
            <div class="border rounded-lg overflow-hidden shadow-sm">
                <div class="flex flex-1 items-center text-sm font-medium text-left px-4 py-3 bg-slate-50 hover:bg-slate-100 transition-all">
                    <div class="flex items-center text-lg font-semibold text-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-check h-5 w-5 mr-2 text-indigo-500"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                        STEP 1: ELIGIBILITY CHECK
                    </div>
                </div>
                <div class="overflow-hidden text-sm px-4 pt-4 pb-6 bg-white space-y-6">
                
                    <!-- Instruction Message -->
                    <div role="alert" class="relative w-full rounded-lg border p-4 [&>svg~*]:pl-7 [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 text-foreground mb-1 border-amber-200 bg-amber-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-triangle h-4 w-4 text-amber-800"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                        <div class="text-sm [&_p]:leading-relaxed text-amber-800 font-medium">
                            Cannot use duplicate email. Duplicate entry of the same candidate is not eligible.
                        </div>
                    </div>

                    <!-- Disclaimer Checkbox -->
                    <div class="flex flex-row items-start space-x-3 space-y-0 p-4 border rounded-md bg-slate-50">
                        <button type="button" role="checkbox" aria-checked="false" data-state="unchecked" value="on" class="peer size-4 shrink-0 rounded-sm border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground bg-white border-slate-300 data-[state=checked]:bg-indigo-600 data-[state=checked]:border-indigo-600" id="duplicate-disclaimer-btn"></button>
                        <input type="checkbox" name="duplicateDisclaimer" id="duplicate-disclaimer" class="hidden">
                        <div class="space-y-1 leading-none">
                            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-slate-700 cursor-pointer" for="duplicate-disclaimer-btn">
                                I understand that if I make a duplicate entry of the same candidate my application will get rejected.
                            </label>
                        </div>
                    </div>

                    <!-- Old / New Radios -->
                    <div class="space-y-3">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Candidate Type <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" role="radiogroup" id="candidate-type-group">
                            <!-- New Candidate -->
                            <div class="flex items-center space-x-2 border p-4 rounded-lg bg-slate-50 border-slate-200 cursor-pointer hover:bg-slate-100 transition-colors" onclick="document.getElementById('radio-new').click()">
                                <button type="button" role="radio" aria-checked="true" data-state="checked" value="new" class="aspect-square h-4 w-4 rounded-full border border-primary text-primary ring-offset-background focus:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white border-slate-300 data-[state=checked]:border-indigo-600 flex items-center justify-center" id="radio-new">
                                    <span data-state="checked" class="flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle h-2.5 w-2.5 fill-indigo-600 text-indigo-600"><circle cx="12" cy="12" r="10"></circle></svg></span>
                                </button>
                                <input type="hidden" name="candidateType" value="new">
                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 cursor-pointer text-slate-700" for="radio-new">New Candidate</label>
                            </div>
                            <!-- Old Candidate -->
                            <div class="flex items-center space-x-2 border p-4 rounded-lg bg-slate-50 border-slate-200 cursor-pointer hover:bg-slate-100 transition-colors" onclick="document.getElementById('radio-old').click()">
                                <button type="button" role="radio" aria-checked="false" data-state="unchecked" value="old" class="aspect-square h-4 w-4 rounded-full border border-primary text-primary ring-offset-background focus:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white border-slate-300 data-[state=checked]:border-indigo-600 flex items-center justify-center" id="radio-old">
                                </button>
                                <input type="hidden" name="candidateType" value="old" disabled>
                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 cursor-pointer text-slate-700" for="radio-old">Old Candidate</label>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden Candidate ID -->
                    <div class="space-y-2 hidden" id="candidate-id-container">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="step1-candidateId">Candidate ID <span class="text-red-500">*</span></label>
                        <p class="text-[0.8rem] text-muted-foreground">Please enter your 7-digit candidate Id assigned to you previously.</p>
                        <input type="text" class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500" placeholder="e.g. 1234567" name="candidateId" maxlength="7" id="step1-candidateId" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="">
                    </div>

                    <hr class="border-slate-200">

                    <!-- Basic Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex justify-center md:justify-start flex-col space-y-4">
                            <div class="space-y-2 col-span-1 md:col-span-1">
                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="step1-email">E-mail <span class="text-red-500">*</span></label>
                                <input type="email" class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500" placeholder="Enter Email" name="email" id=":r0:-form-item" value="">
                            </div>
                            <div class="space-y-2 col-span-1 md:col-span-1">
                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="step1-passportNumber">Passport Number <span class="text-red-500">*</span></label>
                                <input type="text" class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500" placeholder="Enter Passport Number" name="passportNumber" id="step1-passportNumber" value="">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="step1-fullName">Full name as you would like it to appear on record <span class="text-red-500">*</span></label>
                                <input type="text" class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm bg-slate-50 border-slate-200 focus-visible:ring-indigo-500" placeholder="Enter Full Name" name="fullName" id=":r1:-form-item" value="">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Passport Size image: <span class="text-red-500">*</span></label>
                            <div class="flex items-center justify-center w-full">
                                <label for="passport-image" class="flex flex-col items-center justify-center w-full h-full min-h-[12rem] border-2 border-dashed rounded-lg cursor-pointer bg-slate-50 border-slate-300 hover:bg-slate-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload w-8 h-8 mb-2 text-slate-500"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" x2="12" y1="3" y2="15"></line></svg>
                                        <p class="mb-2 text-sm text-slate-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-slate-500">JPG, JPEG, PNG (MAX. 3MB)</p>
                                    </div>
                                    <input id="passport-image" type="file" class="hidden" accept=".png, .jpg, .jpeg" name="passportImage">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end my-6">
            <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none [&>svg]:pointer-events-none [&>svg]:size-4 [&>svg]:shrink-0 bg-primary shadow hover:bg-primary/90 h-10 px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed" type="button" id="check-eligibility-btn">
                Check Eligibility
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right h-4 w-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </button>
        </div>
    </div>
`

const step2Start = '<div id="step-2" class="hidden">'

// 1. replace string
let content = fs.readFileSync('resources/views/welcome.blade.php', 'utf8')

// The point to inject is <div class="w-full mb-4"> around line 37.
const targetSplit = '<div class="w-full mb-4">'
const parts = content.split(targetSplit)

// Part 0 is up to the first <div class="w-full mb-4">. Part 1 is the first block, etc.
// Insert step 1 and step 2 container start.
content = parts[0] + step1Html + step2Start + targetSplit + parts.slice(1).join(targetSplit)

// Close step 2
content = content.replace('</form>', '</div>\n                </form>')

// Now remove old fields. 
// Old Candidate ID
content = content.replace(/<div class="space-y-2"><label[^>]+for=":r4:-form-item">Candidate ID[\s\S]*?<\/div>/m, "")
// Old Grid containing email, fullname, passport image:
// We can just find the first occurrence of: <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> ... up to <div role="alert" ... 
let startIndex = content.indexOf('<div class="flex justify-center md:justify-start flex-col space-y-4">')
let endIndex = content.indexOf('<div role="alert"', startIndex)
if (startIndex !== -1 && endIndex !== -1) {
    // We should safely replace it.
    let toRemove = content.substring(startIndex, endIndex)
    content = content.replace(toRemove, '')
}

// Add loading modal after form
const modalHtml = `
    <!-- Loading Modal -->
    <div id="loading-modal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center flex-col transition-opacity duration-300 opacity-0">
        <div class="bg-white rounded-xl shadow-2xl p-8 flex flex-col items-center max-w-sm w-full mx-4 transform transition-all scale-95 duration-300" id="loading-modal-inner">
            <svg class="animate-spin -ml-1 mr-3 h-10 w-10 text-indigo-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <h3 class="text-xl font-bold text-slate-800 tracking-tight">Validating data...</h3>
            <p class="text-slate-500 mt-2 text-center text-sm">Please wait while we verify your details.</p>
        </div>
    </div>
`
content = content.replace('</form>', '</form>\n' + modalHtml)

// Now we need javascript for the step 1 flow: validation, radios, etc.
// Put it at the bottom of DOMContentLoaded

const step1Js = `
            // ==========================================
            // STEP 1 WIZARD LOGIC
            // ==========================================
            const checkEligBtn = document.getElementById('check-eligibility-btn');
            const step1 = document.getElementById('step-1');
            const step2 = document.getElementById('step-2');
            const candidateTypeRadios = document.querySelectorAll('button[role="radio"][value="new"], button[role="radio"][value="old"]');
            const candidateIdContainer = document.getElementById('candidate-id-container');
            const candTypeInputs = document.querySelectorAll('input[name="candidateType"]');
            
            candidateTypeRadios.forEach(radio => {
                radio.addEventListener('click', (e) => {
                    const isOld = radio.value === 'old';
                    if (isOld) {
                        candidateIdContainer.classList.remove('hidden');
                    } else {
                        candidateIdContainer.classList.add('hidden');
                        document.getElementById('step1-candidateId').value = ''; // clear it
                    }
                    // enable/disable inputs accordingly so they submit nicely
                    candTypeInputs.forEach(i => i.disabled = (i.value !== radio.value));
                    
                    // Radix style emulation for these specific radios
                    candidateTypeRadios.forEach(btn => {
                        btn.setAttribute('data-state', 'unchecked');
                        btn.setAttribute('aria-checked', 'false');
                        btn.innerHTML = '';
                    });
                    
                    radio.setAttribute('data-state', 'checked');
                    radio.setAttribute('aria-checked', 'true');
                    radio.innerHTML = '<span data-state="checked" class="flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle h-2.5 w-2.5 fill-indigo-600 text-indigo-600"><circle cx="12" cy="12" r="10"></circle></svg></span>';
                    
                    clearErrorState(document.getElementById('radio-new')); // clear group error
                });
            });

            checkEligBtn.addEventListener('click', async () => {
                // Clear errors
                document.querySelectorAll('#step-1 .error-msg').forEach(el => el.remove());
                document.querySelectorAll('#step-1 .border-red-500').forEach(el => {
                    el.classList.remove('border-red-500', 'focus-visible:ring-red-500');
                    if(el.tagName !== 'BUTTON') el.classList.add('border-slate-200', 'focus-visible:ring-indigo-500');
                });
                document.querySelectorAll('#step-1 label.text-red-500').forEach(el => el.classList.remove('text-red-500'));

                // Basic frontend check for disclaimer
                const disclaimerCheckbox = document.getElementById('duplicate-disclaimer');
                if (!disclaimerCheckbox.checked) {
                    const btn = document.getElementById('duplicate-disclaimer-btn');
                    btn.classList.add('border-red-500');
                    const err = document.createElement('p');
                    err.className = 'text-sm font-medium text-red-500 error-msg mt-1';
                    err.innerText = 'You must accept the disclaimer.';
                    btn.parentElement.appendChild(err);
                    return;
                }

                const loadingModal = document.getElementById('loading-modal');
                const loadingModalInner = document.getElementById('loading-modal-inner');
                
                loadingModal.classList.remove('hidden');
                setTimeout(() => {
                    loadingModal.classList.remove('opacity-0');
                    loadingModalInner.classList.remove('scale-95');
                }, 10);

                // Prepare Step 1 data
                const formData = new FormData();
                formData.append('_token', document.querySelector('input[name="_token"]').value);
                formData.append('email', document.getElementById(':r0:-form-item').value);
                formData.append('passportNumber', document.getElementById('step1-passportNumber').value);
                formData.append('fullName', document.getElementById(':r1:-form-item').value);
                
                const candId = document.getElementById('step1-candidateId').value;
                if (!candidateIdContainer.classList.contains('hidden')) {
                    formData.append('candidateId', candId);
                }

                const fileInput = document.getElementById('passport-image');
                if (fileInput.files.length > 0) {
                    formData.append('passportImage', fileInput.files[0]);
                }

                try {
                    // Send to new endpoint
                    const response = await fetch('/check-eligibility', {
                        method: 'POST',
                        headers: { 'Accept': 'application/json' },
                        body: formData
                    });

                    const result = await response.json();

                    // Optional artificial delay for UX
                    await new Promise(r => setTimeout(r, 1000));

                    if (!response.ok) {
                        if (response.status === 422) {
                            let firstErrorEl = null;
                            Object.keys(result.errors).forEach(key => {
                                const messages = result.errors[key];
                                const inputEl = document.querySelector(\`[name="\${key}"]\`);
                                
                                if (inputEl && document.getElementById('step-1').contains(inputEl)) {
                                    let container = inputEl.closest('.space-y-2') || inputEl.parentElement;
                                    
                                    if (inputEl.type !== 'hidden') {
                                        inputEl.classList.remove('border-slate-200', 'focus-visible:ring-indigo-500');
                                        inputEl.classList.add('border-red-500', 'focus-visible:ring-red-500');
                                    }

                                    const label = container.querySelector('label');
                                    if (label) label.classList.add('text-red-500');

                                    const errorHtml = \`<p class="text-sm font-medium text-red-500 error-msg mt-1">\${messages[0]}</p>\`;
                                    container.insertAdjacentHTML('beforeend', errorHtml);

                                    if (!firstErrorEl) firstErrorEl = inputEl;
                                }
                            });

                            if (firstErrorEl) {
                                firstErrorEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                setTimeout(() => {
                                    const elToFocus = firstErrorEl.type === 'hidden' ? firstErrorEl.previousElementSibling : firstErrorEl;
                                    if(elToFocus) elToFocus.focus();
                                }, 500);
                            }
                        }
                    } else {
                        // Success - show step 2
                        step1.classList.add('hidden');
                        step2.classList.remove('hidden');
                        step2.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An unexpected error occurred. Please try again.');
                } finally {
                    loadingModal.classList.add('opacity-0');
                    loadingModalInner.classList.add('scale-95');
                    setTimeout(() => loadingModal.classList.add('hidden'), 300);
                }
            });
            // ==========================================
`

content = content.replace("const form = document.getElementById('application-form');", step1Js + "\n            const form = document.getElementById('application-form');")

fs.writeFileSync('resources/views/welcome.blade.php', content, 'utf8')
