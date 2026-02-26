<x-layouts.dashboard title="Application Details" description="View candidate application">

    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('admin.applications.index') }}"
            class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-slate-700 transition">
            <i class="ri-arrow-left-line text-sm"></i> Back to Applications
        </a>
    </div>

    <div class="flex flex-col lg:flex-row gap-6">
        {{-- Main Details --}}
        <div class="flex-1 space-y-6">
            {{-- Candidate Info --}}
            <x-card title="Candidate Information" subtitle="{{ ucfirst($application->candidateType) }} Candidate">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Full Name</span>
                        <span class="text-slate-800 font-medium">{{ $application->usualForename }} {{ $application->lastName }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Email</span>
                        <span class="text-slate-800">{{ $application->email ?? '—' }}</span>
                    </div>
                    @if($application->candidateId)
                        <div>
                            <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Candidate ID</span>
                            <span class="text-slate-800 font-mono">{{ $application->candidateId }}</span>
                        </div>
                    @endif
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Passport No.</span>
                        <span class="text-slate-800 font-mono">{{ $application->passportNumber }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">WhatsApp</span>
                        <span class="text-slate-800">{{ $application->whatsappNumber ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Emergency Contact</span>
                        <span class="text-slate-800">{{ $application->emergencyContactNumber ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Previous AKT Attempts</span>
                        <span class="text-slate-800">{{ $application->previousAttempts ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Exam Center</span>
                        <span class="text-slate-800">{{ $application->examCenterPreference ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Eligibility Criterion</span>
                        <span class="text-slate-800">{{ $application->eligibilityCriterion ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Submitted</span>
                        <span class="text-slate-800">{{ $application->created_at?->format('M d, Y h:i A') }}</span>
                    </div>
                </div>
            </x-card>

            {{-- Address --}}
            <x-card title="Address" subtitle="Residential address">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Street / P.O. Box</span>
                        <span class="text-slate-800">{{ $application->poBox ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">District</span>
                        <span class="text-slate-800">{{ $application->district ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">City</span>
                        <span class="text-slate-800">{{ $application->city ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Province</span>
                        <span class="text-slate-800">{{ $application->province ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Country</span>
                        <span class="text-slate-800">{{ $application->country ?? '—' }}</span>
                    </div>
                </div>
            </x-card>

            {{-- Education --}}
            <x-card title="Education & Experience" subtitle="Medical qualifications">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Medical School</span>
                        <span class="text-slate-800">{{ $application->schoolName ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">School Country</span>
                        <span class="text-slate-800">{{ $application->schoolLocation ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Qualification Year</span>
                        <span class="text-slate-800">{{ $application->qualificationYear ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Country of Experience</span>
                        <span class="text-slate-800">{{ $application->countryOfExperience ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Ethnic Origin</span>
                        <span class="text-slate-800">{{ $application->countryOfOrigin ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Registration Authority</span>
                        <span class="text-slate-800">{{ $application->registrationAuthority ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Registration Number</span>
                        <span class="text-slate-800 font-mono">{{ $application->registrationNumber ?? '—' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Registration Date</span>
                        <span class="text-slate-800">{{ $application->registrationDate?->format('M d, Y') ?? '—' }}</span>
                    </div>
                </div>
            </x-card>

            {{-- Documents --}}
            <x-card title="Uploaded Documents" subtitle="Application attachments">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($application->passportImagePath)
                        <div class="border border-slate-200 rounded-xl p-3">
                            <p class="text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-2">Passport Image</p>
                            @if(Str::endsWith($application->passportImagePath, ['.jpg', '.jpeg', '.png']))
                                <img src="{{ asset('storage/' . $application->passportImagePath) }}" alt="Passport Image" class="w-full rounded-lg object-cover max-h-48">
                            @else
                                <a href="{{ asset('storage/' . $application->passportImagePath) }}" target="_blank" class="text-xs text-indigo-600 hover:underline">
                                    <i class="ri-file-pdf-2-line mr-1"></i> View Document
                                </a>
                            @endif
                        </div>
                    @endif

                    @if($application->bioDataPagePath)
                        <div class="border border-slate-200 rounded-xl p-3">
                            <p class="text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-2">Passport Bio Page</p>
                            @if(Str::endsWith($application->bioDataPagePath, ['.jpg', '.jpeg', '.png']))
                                <img src="{{ asset('storage/' . $application->bioDataPagePath) }}" alt="Bio Data" class="w-full rounded-lg object-cover max-h-48">
                            @else
                                <a href="{{ asset('storage/' . $application->bioDataPagePath) }}" target="_blank" class="text-xs text-indigo-600 hover:underline">
                                    <i class="ri-file-pdf-2-line mr-1"></i> View Document
                                </a>
                            @endif
                        </div>
                    @endif

                    @if($application->validLicensePagePath)
                        <div class="border border-slate-200 rounded-xl p-3">
                            <p class="text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-2">Valid License</p>
                            @if(Str::endsWith($application->validLicensePagePath, ['.jpg', '.jpeg', '.png']))
                                <img src="{{ asset('storage/' . $application->validLicensePagePath) }}" alt="License" class="w-full rounded-lg object-cover max-h-48">
                            @else
                                <a href="{{ asset('storage/' . $application->validLicensePagePath) }}" target="_blank" class="text-xs text-indigo-600 hover:underline">
                                    <i class="ri-file-pdf-2-line mr-1"></i> View Document
                                </a>
                            @endif
                        </div>
                    @endif

                    @if($application->signature)
                        <div class="border border-slate-200 rounded-xl p-3">
                            <p class="text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-2">Signature</p>
                            @if(Str::startsWith($application->signature, 'data:'))
                                <img src="{{ $application->signature }}" alt="Signature" class="max-h-24 bg-white">
                            @elseif(Str::startsWith($application->signature, 'documents/'))
                                <img src="{{ asset('storage/' . $application->signature) }}" alt="Signature" class="max-h-24 bg-white">
                            @else
                                <p class="text-xs text-slate-500">Signature on file</p>
                            @endif
                        </div>
                    @endif

                    @php
                        $otherDocs = is_string($application->otherDocumentsPaths)
                            ? json_decode($application->otherDocumentsPaths, true)
                            : $application->otherDocumentsPaths;
                    @endphp

                    @if($otherDocs && is_array($otherDocs))
                        @foreach($otherDocs as $docType => $path)
                            <div class="border border-slate-200 rounded-xl p-3">
                                <p class="text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-2">{{ str_replace('_', ' ', ucfirst($docType)) }}</p>
                                @if(is_array($path))
                                    @foreach($path as $i => $p)
                                        <a href="{{ asset('storage/' . $p) }}" target="_blank" class="block text-xs text-indigo-600 hover:underline mb-1">
                                            <i class="ri-file-line mr-1"></i> Document {{ $i + 1 }}
                                        </a>
                                    @endforeach
                                @else
                                    @if(Str::endsWith($path, ['.jpg', '.jpeg', '.png']))
                                        <img src="{{ asset('storage/' . $path) }}" alt="{{ $docType }}" class="w-full rounded-lg object-cover max-h-48">
                                    @else
                                        <a href="{{ asset('storage/' . $path) }}" target="_blank" class="text-xs text-indigo-600 hover:underline">
                                            <i class="ri-file-pdf-2-line mr-1"></i> View Document
                                        </a>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    @endif

                    @if($application->experienceCertificatePath)
                        @php
                            $expPaths = is_string($application->experienceCertificatePath)
                                ? json_decode($application->experienceCertificatePath, true)
                                : $application->experienceCertificatePath;
                        @endphp
                        @if(is_array($expPaths))
                            <div class="border border-slate-200 rounded-xl p-3">
                                <p class="text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-2">Experience Certificates</p>
                                @foreach($expPaths as $i => $p)
                                    <a href="{{ asset('storage/' . $p) }}" target="_blank" class="block text-xs text-indigo-600 hover:underline mb-1">
                                        <i class="ri-file-line mr-1"></i> Certificate {{ $i + 1 }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
            </x-card>
        </div>

        {{-- Sidebar: Status Actions --}}
        <div class="w-full lg:w-80 space-y-6">
            {{-- Current Status --}}
            <x-card title="Status" subtitle="Current application status">
                <div class="text-center py-4">
                    @php
                        $variant = match($application->status) {
                            'approved' => 'success',
                            'rejected' => 'danger',
                            default => 'warning',
                        };
                        $statusColors = match($application->status) {
                            'approved' => 'bg-emerald-100 text-emerald-800 ring-emerald-300',
                            'rejected' => 'bg-rose-100 text-rose-800 ring-rose-300',
                            default => 'bg-amber-100 text-amber-800 ring-amber-300',
                        };
                    @endphp
                    <span class="inline-flex items-center rounded-full px-4 py-1.5 text-sm font-semibold ring-1 ring-inset {{ $statusColors }}">
                        {{ ucfirst($application->status ?? 'pending') }}
                    </span>

                    @if($application->admin_message)
                        <div class="mt-4 p-3 bg-slate-50 rounded-xl border border-slate-200 text-left">
                            <p class="text-[11px] uppercase tracking-wide text-slate-400 font-semibold mb-1">Admin Message</p>
                            <p class="text-xs text-slate-700">{{ $application->admin_message }}</p>
                        </div>
                    @endif
                </div>
            </x-card>

            {{-- Approve Action --}}
            @if($application->status !== 'approved')
                <x-card title="Approve" subtitle="Mark as approved">
                    <form method="POST" action="{{ route('admin.applications.update-status', $application) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <div class="mb-3">
                            <label class="block text-[11px] font-semibold uppercase tracking-wide text-slate-500 mb-1">Message (optional)</label>
                            <textarea name="admin_message" rows="3" placeholder="Congratulations! Your application has been approved..."
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/70 transition-all"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-1.5 rounded-xl bg-emerald-600 px-4 py-2 text-xs font-semibold text-white hover:bg-emerald-700 transition shadow-sm"
                            onclick="return confirm('Are you sure you want to approve this application?')">
                            <i class="ri-check-line text-sm"></i> Approve Application
                        </button>
                    </form>
                </x-card>
            @endif

            {{-- Reject Action --}}
            @if($application->status !== 'rejected')
                <x-card title="Reject" subtitle="Decline this application">
                    <form method="POST" action="{{ route('admin.applications.update-status', $application) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <div class="mb-3">
                            <label class="block text-[11px] font-semibold uppercase tracking-wide text-slate-500 mb-1">Reason (optional)</label>
                            <textarea name="admin_message" rows="3" placeholder="Your application has been rejected because..."
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-rose-500/70 transition-all"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-1.5 rounded-xl bg-rose-600 px-4 py-2 text-xs font-semibold text-white hover:bg-rose-700 transition shadow-sm"
                            onclick="return confirm('Are you sure you want to reject this application?')">
                            <i class="ri-close-line text-sm"></i> Reject Application
                        </button>
                    </form>
                </x-card>
            @endif

            {{-- Reset to Pending --}}
            @if($application->status !== 'pending')
                <x-card title="Reset" subtitle="Set back to pending">
                    <form method="POST" action="{{ route('admin.applications.update-status', $application) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="pending">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-1.5 rounded-xl bg-slate-200 px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-300 transition shadow-sm"
                            onclick="return confirm('Reset this application to pending?')">
                            <i class="ri-refresh-line text-sm"></i> Reset to Pending
                        </button>
                    </form>
                </x-card>
            @endif
        </div>
    </div>
</x-layouts.dashboard>
