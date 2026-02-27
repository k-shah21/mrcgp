
        // Signature tab switching (global so onclick attributes work)
        function switchSignatureTab(tab) {
            const drawSection = document.getElementById('signature-draw-section');
            const uploadSection = document.getElementById('signature-upload-section');
            const drawBtn = document.getElementById('sig-tab-draw');
            const uploadBtn = document.getElementById('sig-tab-upload');

            if (tab === 'draw') {
                drawSection.classList.remove('hidden');
                uploadSection.classList.add('hidden');
                drawBtn.className = 'px-4 py-2 text-sm font-medium rounded-md bg-indigo-600 text-white';
                uploadBtn.className = 'px-4 py-2 text-sm font-medium rounded-md bg-slate-200 text-slate-700';
            } else {
                drawSection.classList.add('hidden');
                uploadSection.classList.remove('hidden');
                uploadBtn.className = 'px-4 py-2 text-sm font-medium rounded-md bg-indigo-600 text-white';
                drawBtn.className = 'px-4 py-2 text-sm font-medium rounded-md bg-slate-200 text-slate-700';
            }
        }

        // Clear jSignature
        function clearSignature() {
            const $sigPad = $('#signature-pad');
            if ($sigPad.length && $sigPad.jSignature) {
                try { $sigPad.jSignature('reset'); } catch (e) { }
            }
            document.getElementById('signature-data').value = '';
        }

        document.addEventListener('DOMContentLoaded', () => {
            // =====================
            // Initialize jSignature
            // =====================
            const $sigPad = $('#signature-pad');
            if ($sigPad.length) {
                $sigPad.jSignature({ 'UndoButton': false, 'color': '#000', 'lineWidth': 2 });
                $sigPad.bind('change', function (e) {
                    const datapair = $sigPad.jSignature('getData', 'svgbase64');
                    if (datapair) {
                        document.getElementById('signature-data').value = 'data:' + datapair[0] + ',' + datapair[1];
                    }
                });
            }

            // ==============================
            // Make Radix-style Radios work
            // ==============================
            const allRadioButtons = document.querySelectorAll('button[role="radio"]');
            allRadioButtons.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const group = btn.closest('[role="radiogroup"]');
                    if (group) {
                        group.querySelectorAll('button[role="radio"]').forEach(b => {
                            b.setAttribute('data-state', 'unchecked');
                            b.setAttribute('aria-checked', 'false');
                            b.innerHTML = '';
                            const hiddenInput = b.nextElementSibling;
                            if (hiddenInput && hiddenInput.tagName === 'INPUT') hiddenInput.checked = false;
                        });
                    }
                    btn.setAttribute('data-state', 'checked');
                    btn.setAttribute('aria-checked', 'true');
                    btn.innerHTML = '<span data-state="checked" class="flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle h-2.5 w-2.5 fill-indigo-600 text-indigo-600"><circle cx="12" cy="12" r="10"></circle></svg></span>';
                    const hiddenInput = btn.nextElementSibling;
                    if (hiddenInput && hiddenInput.tagName === 'INPUT') hiddenInput.checked = true;
                });
            });

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
                    cb.innerHTML = newState === 'checked'
                        ? '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check h-4 w-4"><polyline points="20 6 9 17 4 12"></polyline></svg>'
                        : '';
                    const hiddenInput = cb.nextElementSibling;
                    if (hiddenInput && hiddenInput.tagName === 'INPUT') hiddenInput.checked = !isChecked;
                });
            });

            // ==============================
            // Candidate Type Toggle (New / Old)
            // ==============================
            const candidateTypeRadios = document.querySelectorAll('button[role="radio"][value="new"], button[role="radio"][value="old"]');
            const candidateIdContainer = document.getElementById('candidate-id-container');
            const candTypeInputs = document.querySelectorAll('input[name="candidateType"]');
            // Containers for new-candidate-only fields
            const newOnlyContainers = document.querySelectorAll('.new-candidate-only');
            const oldOnlyContainers = document.querySelectorAll('.old-candidate-only');

            candidateTypeRadios.forEach(radio => {
                radio.addEventListener('click', (e) => {
                    const isOld = radio.value === 'old';
                    if (isOld) {
                        candidateIdContainer.classList.remove('hidden');
                    } else {
                        candidateIdContainer.classList.add('hidden');
                        const cidInput = document.getElementById('step1-candidateId');
                        if (cidInput) cidInput.value = '';
                    }
                    candTypeInputs.forEach(i => i.disabled = (i.value !== radio.value));

                    // Radix emulation for these radios
                    candidateTypeRadios.forEach(btn => {
                        btn.setAttribute('data-state', 'unchecked');
                        btn.setAttribute('aria-checked', 'false');
                        btn.innerHTML = '';
                    });
                    radio.setAttribute('data-state', 'checked');
                    radio.setAttribute('aria-checked', 'true');
                    radio.innerHTML = '<span data-state="checked" class="flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle h-2.5 w-2.5 fill-indigo-600 text-indigo-600"><circle cx="12" cy="12" r="10"></circle></svg></span>';

                    clearErrorState(document.getElementById('radio-new'));
                });
            });

            // ===================
            // Error helpers
            // ===================
            const clearErrorState = (element) => {
                if (!element || !element.name) return;
                const container = element.closest('.space-y-2') || element.closest('.grid') || element.parentElement;
                if (container) {
                    container.querySelectorAll('.error-msg').forEach(msg => msg.remove());
                    container.querySelectorAll('label.text-red-500').forEach(l => l.classList.remove('text-red-500'));
                }
                element.classList.remove('border-red-500', 'focus-visible:ring-red-500');
                if (element.type !== 'radio' && element.type !== 'checkbox' && element.type !== 'hidden') {
                    if (element.tagName !== 'BUTTON') {
                        element.classList.add('border-slate-200', 'focus-visible:ring-indigo-500');
                    }
                } else if (element.type === 'hidden') {
                    const btn = element.previousElementSibling;
                    if (btn && (btn.getAttribute('role') === 'radio' || btn.getAttribute('role') === 'checkbox')) {
                        btn.classList.remove('border-red-500');
                    }
                }
            };

            const form = document.getElementById('application-form');
            form.addEventListener('input', (e) => clearErrorState(e.target));
            form.addEventListener('change', (e) => clearErrorState(e.target));

            const showInlineErrors = (errors, scopeEl) => {
                let firstErrorEl = null;
                Object.keys(errors).forEach(key => {
                    const messages = errors[key];
                    const inputEl = document.querySelector(`[name="${key}"]`);
                    if (inputEl && (!scopeEl || scopeEl.contains(inputEl))) {
                        let container = inputEl.closest('.space-y-2') || inputEl.parentElement;
                        if (inputEl.type !== 'hidden' && inputEl.type !== 'radio' && inputEl.type !== 'checkbox') {
                            inputEl.classList.remove('border-slate-200', 'focus-visible:ring-indigo-500');
                            inputEl.classList.add('border-red-500', 'focus-visible:ring-red-500');
                        } else if (inputEl.type === 'hidden') {
                            const btn = inputEl.previousElementSibling;
                            if (btn && (btn.getAttribute('role') === 'radio' || btn.getAttribute('role') === 'checkbox')) {
                                btn.classList.add('border-red-500');
                            }
                        }
                        const label = container.querySelector('label');
                        if (label) label.classList.add('text-red-500');

                        const errorP = document.createElement('p');
                        errorP.className = 'error-msg text-sm text-red-500 mt-1 font-medium';
                        errorP.innerText = messages[0];
                        container.appendChild(errorP);
                        if (!firstErrorEl) firstErrorEl = inputEl;
                    }
                });
                if (firstErrorEl) {
                    firstErrorEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    setTimeout(() => {
                        const el = firstErrorEl.type === 'hidden' ? firstErrorEl.previousElementSibling : firstErrorEl;
                        if (el) el.focus();
                    }, 500);
                }
            };

            const clearAllErrors = (scope) => {
                const root = scope || document;
                root.querySelectorAll('.error-msg').forEach(el => el.remove());
                root.querySelectorAll('.border-red-500').forEach(el => {
                    el.classList.remove('border-red-500', 'focus-visible:ring-red-500');
                    if (el.tagName !== 'BUTTON') el.classList.add('border-slate-200', 'focus-visible:ring-indigo-500');
                });
                root.querySelectorAll('label.text-red-500').forEach(el => el.classList.remove('text-red-500'));
            };

            // ================================
            // STEP 1 → CHECK ELIGIBILITY
            // ================================
            const checkEligBtn = document.getElementById('check-eligibility-btn');
            const step1 = document.getElementById('step-1');

            if (checkEligBtn) {
                checkEligBtn.addEventListener('click', async () => {
                    clearAllErrors(step1);

                    // Frontend: disclaimer must be checked
                    const disclaimerCb = document.getElementById('duplicate-disclaimer');
                    if (!disclaimerCb.checked) {
                        const btn = document.getElementById('duplicate-disclaimer-btn');
                        btn.classList.add('border-red-500');
                        const err = document.createElement('p');
                        err.className = 'text-sm font-medium text-red-500 error-msg mt-1';
                        err.innerText = 'You must accept the disclaimer.';
                        btn.parentElement.appendChild(err);
                        return;
                    }

                    // Show SweetAlert loading
                    Swal.fire({
                        title: 'Validating data...',
                        html: 'Please wait while we verify your details.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => { Swal.showLoading(); }
                    });

                    // Build FormData from Step 1 fields
                    const formData = new FormData();
                    formData.append('_token', document.querySelector('input[name="_token"]').value);

                    // Candidate type
                    const activeCandType = document.querySelector('input[name="candidateType"]:not([disabled])');
                    if (activeCandType) formData.append('candidateType', activeCandType.value);

                    formData.append('passportNumber', document.getElementById('step1-passportNumber').value);

                    // New candidate fields
                    const emailEl = document.getElementById('email');
                    if (emailEl) formData.append('email', emailEl.value);
                    const forenameEl = document.getElementById('usualForename');
                    if (forenameEl) formData.append('usualForename', forenameEl.value);
                    const lastNameEl = document.getElementById('lastName');
                    if (lastNameEl) formData.append('lastName', lastNameEl.value);

                    // Candidate ID (old)
                    const candIdVal = document.getElementById('step1-candidateId').value;
                    if (!candidateIdContainer.classList.contains('hidden') && candIdVal) {
                        formData.append('candidateId', candIdVal);
                    }

                    try {
                        const response = await fetch('/check-eligibility', {
                            method: 'POST',
                            headers: { 'Accept': 'application/json' },
                            body: formData
                        });

                        const result = await response.json();

                        if (response.status === 409) {
                            // DUPLICATE → Reject
                            Swal.fire({
                                icon: 'error',
                                title: 'Application Rejected!',
                                text: result.message || 'You have already submitted an application. Duplicate entries are not eligible.',
                                confirmButtonColor: '#6366f1',
                            }).then(() => {
                                // Clear form on duplicate
                                form.reset();
                                allRadioButtons.forEach(b => {
                                    b.setAttribute('data-state', 'unchecked');
                                    b.setAttribute('aria-checked', 'false');
                                    b.innerHTML = '';
                                });
                                allCheckboxBtns.forEach(cb => {
                                    cb.setAttribute('data-state', 'unchecked');
                                    cb.setAttribute('aria-checked', 'false');
                                    cb.innerHTML = '';
                                });
                                candidateIdContainer.classList.add('hidden');
                            });
                        } else if (response.status === 422) {
                            Swal.close();
                            if (result.errors) {
                                showInlineErrors(result.errors, step1);
                            }
                        } else if (response.ok) {
                            // SUCCESS → Proceed to Step 2
                            Swal.fire({
                                icon: 'success',
                                title: 'Eligibility Confirmed!',
                                text: result.message || 'You can now proceed to complete your application.',
                                confirmButtonColor: '#6366f1',
                                timer: 2500,
                                timerProgressBar: true,
                            }).then(() => {
                                step1.classList.add('hidden');
                                const step2 = document.getElementById('step-2');
                                if (step2) {
                                    step2.classList.remove('hidden');
                                    step2.scrollIntoView({ behavior: 'smooth', block: 'start' });
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong. Please try again.',
                                confirmButtonColor: '#6366f1',
                            });
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Network Error',
                            text: 'An unexpected error occurred. Please check your connection and try again.',
                            confirmButtonColor: '#6366f1',
                        });
                    }
                });
            }

            // ================================
            // FORM SUBMISSION (Step 2 → /apply)
            // ================================
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                clearAllErrors();

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

                // Frontend: check required file uploads
                const missingDocs = [];
                const bioPage = document.getElementById('passport_bio_page');
                if (!bioPage || bioPage.files.length === 0) missingDocs.push('Passport Bio Page');
                const validLicense = document.getElementById('valid-license');
                if (!validLicense || validLicense.files.length === 0) missingDocs.push('Valid License');

                // Only for new candidate: additional required docs
                const activeCandType = document.querySelector('input[name="candidateType"]:not([disabled])');
                if (activeCandType && activeCandType.value === 'new') {
                    const mbbs = document.getElementById('mbbs-degree');
                    if (!mbbs || mbbs.files.length === 0) missingDocs.push('MBBS Degree');
                    const training = document.getElementById('training-certificate');
                    if (!training || training.files.length === 0) missingDocs.push('Training/Diploma Certificate');
                }

                if (missingDocs.length > 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Missing Required Documents',
                        html: '<ul style="text-align:left;margin:0 auto;max-width:280px;">' +
                            missingDocs.map(d => `<li style="margin-bottom:4px;">• ${d}</li>`).join('') +
                            '</ul>',
                        confirmButtonColor: '#6366f1',
                    });
                    return;
                }

                // Show loading
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Submitting...';
                submitBtn.disabled = true;

                // Build FormData – ensure file inputs have name attributes
                const formData = new FormData(form);

                // Append file inputs that may not have name attrs to match backend
                const fileMapping = {
                    'passport_bio_page': 'passport_bio_page',
                    'valid-license': 'valid_license',
                    'mbbs-degree': 'mbbs_degree',
                    'training-certificate': 'training_certificate',
                };
                for (const [inputId, fieldName] of Object.entries(fileMapping)) {
                    const el = document.getElementById(inputId);
                    if (el && el.files.length > 0 && !el.name) {
                        formData.append(fieldName, el.files[0]);
                    }
                }

                // Append multi-file uploads
                document.querySelectorAll('input[id^="internship-certificate-"]').forEach(el => {
                    if (el.files.length > 0) formData.append('internship_certificates[]', el.files[0]);
                });
                document.querySelectorAll('input[id^="experience-certificate-"]').forEach(el => {
                    if (el.files.length > 0) formData.append('experience_certificates[]', el.files[0]);
                });

                try {
                    const response = await fetch('/apply', {
                        method: 'POST',
                        headers: { 'Accept': 'application/json' },
                        body: formData
                    });

                    const result = await response.json();

                    if (response.status === 409) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Duplicate Detected!',
                            text: result.message || 'A duplicate application was found. Your submission has been rejected.',
                            confirmButtonColor: '#6366f1',
                        });
                    } else if (response.status === 422) {
                        if (result.errors) {
                            // Build list of missing fields for SweetAlert
                            const errorList = Object.entries(result.errors).map(([key, msgs]) => `• ${msgs[0]}`).join('\n');
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: '<div style="text-align:left;font-size:14px;">' +
                                    Object.entries(result.errors).map(([key, msgs]) => `<p style="margin-bottom:4px;">• ${msgs[0]}</p>`).join('') +
                                    '</div>',
                                confirmButtonColor: '#6366f1',
                            });
                            showInlineErrors(result.errors);
                        }
                    } else if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Application Submitted!',
                            text: result.message || 'Your application has been submitted successfully.',
                            confirmButtonColor: '#6366f1',
                        }).then(() => {
                            form.reset();
                            allRadioButtons.forEach(b => {
                                b.setAttribute('data-state', 'unchecked');
                                b.setAttribute('aria-checked', 'false');
                                b.innerHTML = '';
                            });
                            allCheckboxBtns.forEach(cb => {
                                cb.setAttribute('data-state', 'unchecked');
                                cb.setAttribute('aria-checked', 'false');
                                cb.innerHTML = '';
                            });
                            clearSignature();
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again.',
                            confirmButtonColor: '#6366f1',
                        });
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Network Error',
                        text: 'A network error occurred. Please check your connection and try again.',
                        confirmButtonColor: '#6366f1',
                    });
                } finally {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            });
        });
    