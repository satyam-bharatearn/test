<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Job - Residential Cleaning</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-bottom: 100px; /* Space for fixed bottom bar */
        }
        
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #16a34a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .back-btn {
            background-color: #6b7280;
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        
        .back-btn:hover {
            background-color: #4b5563;
            color: white;
        }
        
        .form-section {
            background-color: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.75rem;
            transition: border-color 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 0.2rem rgba(22, 163, 74, 0.25);
        }
        
        .btn-primary-custom {
            background-color: #16a34a;
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            background-color: #15803d;
            color: white;
        }
        
        .btn-secondary-custom {
            background-color: #6b7280;
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        
        .btn-secondary-custom:hover {
            background-color: #4b5563;
            color: white;
        }
        
        .btn-outline-custom {
            background-color: transparent;
            border: 1px solid #16a34a;
            color: #16a34a;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-outline-custom:hover {
            background-color: #16a34a;
            color: white;
        }
        
        .icon-input {
            position: relative;
        }
        
        .icon-input i {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }
        
        .icon-input .form-control {
            padding-right: 3rem;
        }
        
        .toggle-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .toggle-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            background-color: white;
            color: #374151;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .toggle-btn.active {
            background-color: #16a34a;
            color: white;
            border-color: #16a34a;
        }
        
        .product-item {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
            position: relative;
        }
        
        .delete-item-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background-color: #ef4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .delete-item-btn:hover {
            background-color: #dc2626;
        }
        
        .notes-area {
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .notes-area:hover {
            border-color: #16a34a;
            background-color: #f0fdf4;
        }
        
        .notes-area:hover .add-note-icon {
            opacity: 1;
        }
        
        .add-note-icon {
            opacity: 0;
            transition: opacity 0.3s ease;
            font-size: 2rem;
            color: #16a34a;
        }
        
        .notes-form {
            display: none;
        }
        
        .notes-form.active {
            display: block;
        }
        
        .file-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 1rem;
            text-align: center;
            margin-top: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-upload-area:hover {
            border-color: #16a34a;
            background-color: #f0fdf4;
        }
        
        .fixed-bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            border-top: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        
        .total-summary {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-top: 1rem;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .total-row:last-child {
            font-weight: 600;
            border-top: 1px solid #e5e7eb;
            padding-top: 0.5rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-leaf"></i>{{ isset($job) ? 'Edit Job' : 'New Job' }}
            </h1>
            <a href="{{ route('jobs.index') }}" class="back-btn">
                <i class="fas fa-arrow-left me-2"></i>Back to Jobs
            </a>
        </div>
        
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <form id="jobForm" method="POST" action="{{ isset($job) ? route('jobs.update', $job->id) : route('jobs.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($job))
                @method('PUT')
            @endif
            
            <!-- Header Section -->
            <div class="form-section">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $job->title ?? '') }}" placeholder="Enter job title">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="client" class="form-label">Select a client</label>
                        <div class="icon-input">
                            <input type="text" class="form-control" id="client" name="client" value="{{ old('client', $job->client ?? '') }}" placeholder="Search for client">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="jobNumber" class="form-label">Job #</label>
                        <input type="text" class="form-control" id="jobNumber" name="job_number" value="{{ old('job_number', $job->job_number ?? '') }}" {{ isset($job) ? '' : 'readonly' }}>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="salesperson" class="form-label">Salesperson</label>
                        <select class="form-select" id="salesperson" name="salesperson">
                            <option value="">Salesperson</option>
                            <option value="john" {{ old('salesperson', $job->salesperson ?? '') == 'john' ? 'selected' : '' }}>John Doe</option>
                            <option value="jane" {{ old('salesperson', $job->salesperson ?? '') == 'jane' ? 'selected' : '' }}>Jane Smith</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Job Type Section -->
            <div class="form-section">
                <h3 class="section-title">
                    Job type
                    <i class="fas fa-info-circle" style="font-size: 0.8rem; color: #6b7280;"></i>
                </h3>
                <div class="toggle-buttons">
                    <button type="button" class="toggle-btn {{ old('job_type', $job->job_type ?? 'one-off') == 'one-off' ? 'active' : '' }}" data-type="one-off">One-off</button>
                    <button type="button" class="toggle-btn {{ old('job_type', $job->job_type ?? 'one-off') == 'recurring' ? 'active' : '' }}" data-type="recurring">Recurring</button>
                </div>
                <input type="hidden" id="jobType" name="job_type" value="{{ old('job_type', $job->job_type ?? 'one-off') }}">
            </div>
            
            <!-- Schedule Section -->
            <div class="form-section">
                <h3 class="section-title">Schedule</h3>
                
                <!-- One-off Schedule Section -->
                <div id="oneOffSchedule">
                    <div class="mb-3">
                        <span class="text-muted">Total visits 1 | On Sep 15, 2020</span>
                    </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="scheduleDate" class="form-label">Date</label>
                        <div class="icon-input">
                            <input type="date" class="form-control" id="scheduleDate" name="schedule_date" value="2020-09-15">
                            <i class="fas fa-calendar"></i>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="startTime" class="form-label">Start Time</label>
                        <div class="icon-input">
                            <input type="time" class="form-control" id="startTime" name="start_time">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="endTime" class="form-label">End Time</label>
                        <div class="icon-input">
                            <input type="time" class="form-control" id="endTime" name="end_time">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" id="scheduleLater" name="schedule_later">
                            <label class="form-check-label" for="scheduleLater">Schedule later</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="anytime" name="anytime" onchange="toggleTimeFields()">
                            <label class="form-check-label" for="anytime">Anytime</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="repeats" class="form-label">Repeats</label>
                        <select class="form-select" id="repeats" name="repeats" onchange="toggleRepeatOptions()">
                            <option value="none">Does not repeat</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly on Saturday</option>
                            <option value="biweekly">Every 2 Week on Saturday</option>
                            <option value="monthly">Monday on the 13th</option>
                            <option value="asneeded">As needed (you won't prompt you)</option>
                        </select>
                        
                        <!-- Repeat End Options (hidden by default) -->
                        <div id="repeatEndOptions" class="mt-3" style="display: none;">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="repeat_end_type" id="endsAfter" value="after" checked onchange="toggleEndFields()">
                                    <label class="form-check-label" for="endsAfter">Ends after</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="repeat_end_type" id="endsOn" value="on" onchange="toggleEndFields()">
                                    <label class="form-check-label" for="endsOn">Ends on</label>
                                </div>
                            </div>
                            
                            <!-- Ends After Fields -->
                            <div id="endsAfterFields" class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control" name="repeat_end_after_number" value="1" min="1" placeholder="Number">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <select class="form-select" name="repeat_end_after_period">
                                        <option value="days">days</option>
                                        <option value="weeks">weeks</option>
                                        <option value="months">months</option>
                                        <option value="years">years</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Ends On Field -->
                            <div id="endsOnField" class="mb-3" style="display: none;">
                                <input type="date" class="form-control" name="repeat_end_on_date">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Assign to</label>
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <span class="badge bg-secondary">Indigent <i class="fas fa-times ms-1"></i></span>
                            <span class="badge bg-secondary">Puppy Lane <i class="fas fa-times ms-1"></i></span>
                        </div>
                        {{-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="emailTeam" name="email_team">
                            <label class="form-check-label" for="emailTeam">Email team about assignment</label>
                        </div> --}}
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-md-8 mb-3">
                        <h6>Add a job form</h6>
                        <p class="text-muted">Attach custom built forms to your jobs so that nothing gets missed.</p>
                        <a href="#" class="text-primary">Create a job form in Settings</a>
                    </div> --}}
                    <div class="col-md-6 mb-3">
                        <label for="visitInstructions" class="form-label">Visit instructions</label>
                        <textarea class="form-control" id="visitInstructions" name="visit_instructions" rows="3"></textarea>
                    </div>
                </div>
                {{-- <div class="text-end">
                    <button type="button" class="btn btn-outline-custom">
                        <i class="fas fa-calendar me-2"></i>Show Calendar
                    </button>
                </div> --}}
                </div>
                
                <!-- Recurring Schedule Section -->
                <div id="recurringSchedule" style="display: none;">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="recurringStartDate" class="form-label">Start Date</label>
                            <div class="icon-input">
                                <input type="date" class="form-control" id="recurringStartDate" name="recurring_start_date" value="2020-09-15">
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="recurringStartTime" class="form-label">Start Time</label>
                            <div class="icon-input">
                                <input type="time" class="form-control" id="recurringStartTime" name="recurring_start_time">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="recurringEndTime" class="form-label">End Time</label>
                            <div class="icon-input">
                                <input type="time" class="form-control" id="recurringEndTime" name="recurring_end_time">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="recurringAnytime" name="recurring_anytime" onchange="toggleRecurringTimeFields()">
                                <label class="form-check-label" for="recurringAnytime">Anytime</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="recurringRepeats" class="form-label">Repeats</label>
                            <select class="form-select" id="recurringRepeats" name="recurring_repeats" onchange="toggleRecurringRepeatOptions()">
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly on Saturday</option>
                                <option value="biweekly">Every 2 weeks on Saturday</option>
                                <option value="monthly">Monthly on today</option>
                                <option value="asneeded">As needed (you prompt)</option>
                            </select>
                            
                            <!-- Recurring Repeat End Options (always visible) -->
                            <div id="recurringRepeatEndOptions" class="mt-3">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="recurring_repeat_end_type" id="recurringEndsAfter" value="after" checked onchange="toggleRecurringEndFields()">
                                        <label class="form-check-label" for="recurringEndsAfter">Ends after</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="recurring_repeat_end_type" id="recurringEndsOn" value="on" onchange="toggleRecurringEndFields()">
                                        <label class="form-check-label" for="recurringEndsOn">Ends on</label>
                                    </div>
                                </div>
                                
                                <!-- Recurring Ends After Fields -->
                                <div id="recurringEndsAfterFields" class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="number" class="form-control" name="recurring_repeat_end_after_number" value="1" min="1" placeholder="Number">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <select class="form-select" name="recurring_repeat_end_after_period">
                                            <option value="days">days</option>
                                            <option value="weeks">weeks</option>
                                            <option value="months">months</option>
                                            <option value="years">years</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Recurring Ends On Field -->
                                <div id="recurringEndsOnField" class="mb-3" style="display: none;">
                                    <input type="date" class="form-control" name="recurring_repeat_end_on_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Assign to</label>
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                <span class="badge bg-secondary">Indigent <i class="fas fa-times ms-1"></i></span>
                                <span class="badge bg-secondary">Puppy Lane <i class="fas fa-times ms-1"></i></span>
                            </div>
                            {{-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="recurringEmailTeam" name="recurring_email_team">
                                <label class="form-check-label" for="recurringEmailTeam">Email team about assignment</label>
                            </div> --}}
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-md-8 mb-3">
                            <h6>Add a job form</h6>
                            <p class="text-muted">Attach custom built forms to your jobs so that nothing gets missed.</p>
                            <a href="#" class="text-primary">Create a job form in Settings</a>
                        </div> --}}
                        <div class="col-md-6 mb-3">
                            <label for="recurringVisitInstructions" class="form-label">Visit instructions</label>
                            <textarea class="form-control" id="recurringVisitInstructions" name="recurring_visit_instructions" rows="3"></textarea>
                        </div>
                    </div>
                    {{-- <div class="text-end">
                        <button type="button" class="btn btn-outline-custom">
                            <i class="fas fa-calendar me-2"></i>Show Calendar
                        </button>
                    </div> --}}
                </div>
            </div>
            
            <!-- Invoicing Section -->
            {{-- <div class="form-section">
                <h3 class="section-title">Invoicing</h3>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="sendInvoice" name="send_invoice" checked>
                    <label class="form-check-label" for="sendInvoice">Send not to invoice when I close the job</label>
                </div>
            </div> --}}
            
            <!-- Product/Service Section -->
            <div class="form-section">
                <h3 class="section-title">Product / Service</h3>
                <p class="text-muted mb-3">Keep everything on track by adding products and services.</p>
                
                <div id="productItems">
                    <!-- Product items will be added here dynamically -->
                </div>
                
                <button type="button" class="btn btn-primary-custom" onclick="addProductItem()">
                    <i class="fas fa-plus me-2"></i>Add New Item
                </button>
                
                <div class="total-summary">
                    <div class="total-row">
                        <span>Total cost</span>
                        <span id="totalCost">$0.00</span>
                    </div>
                    <div class="total-row">
                        <span>Total price</span>
                        <span id="totalPrice">$0.00</span>
                    </div>
                </div>
            </div>
            
            <!-- Notes Section -->
            <div class="form-section">
                <h3 class="section-title">Notes</h3>
                <div class="notes-area" onclick="showNotesForm()">
                    <div class="add-note-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                </div>
                <div class="notes-form" id="notesForm">
                    <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Leave an internal note for yourself or a team member"></textarea>
                    <div class="file-upload-area" onclick="document.getElementById('fileUpload').click()">
                        <i class="fas fa-paperclip me-2"></i>
                        Attach files or photos
                        <input type="file" id="fileUpload" name="attachments[]" multiple accept="image/*,.pdf,.doc,.docx" style="display: none;">
                    </div>
                    <div id="fileList" class="mt-2"></div>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Fixed Bottom Bar -->
    <div class="fixed-bottom-bar">
        <div class="d-flex justify-content-end gap-3">
            <button type="button" class="btn btn-secondary-custom" onclick="window.location.href='{{ route('jobs.index') }}'">
                Cancel
            </button>
            <button type="button" class="btn btn-primary-custom" onclick="saveJob()">
                <i class="fas fa-save me-2"></i>{{ isset($job) ? 'Update Job' : 'Save Job' }}
                <i class="fas fa-chevron-down ms-2"></i>
            </button>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let productItemCount = 0;
        
        // Toggle buttons functionality
        document.querySelectorAll('.toggle-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('jobType').value = this.dataset.type;
                toggleScheduleSections();
            });
        });
        
        // Toggle schedule sections based on job type
        function toggleScheduleSections() {
            const jobType = document.getElementById('jobType').value;
            const oneOffSchedule = document.getElementById('oneOffSchedule');
            const recurringSchedule = document.getElementById('recurringSchedule');
            
            if (jobType === 'one-off') {
                oneOffSchedule.style.display = 'block';
                recurringSchedule.style.display = 'none';
            } else if (jobType === 'recurring') {
                oneOffSchedule.style.display = 'none';
                recurringSchedule.style.display = 'block';
            }
        }
        
        // Toggle time fields for one-off schedule
        function toggleTimeFields() {
            const anytime = document.getElementById('anytime');
            const startTime = document.getElementById('startTime');
            const endTime = document.getElementById('endTime');
            const visitInstructions = document.getElementById('visitInstructions');
            
            if (anytime.checked) {
                startTime.disabled = true;
                endTime.disabled = true;
                visitInstructions.disabled = true;
            } else {
                startTime.disabled = false;
                endTime.disabled = false;
                visitInstructions.disabled = false;
            }
        }
        
        // Toggle time fields for recurring schedule
        function toggleRecurringTimeFields() {
            const recurringAnytime = document.getElementById('recurringAnytime');
            const recurringStartTime = document.getElementById('recurringStartTime');
            const recurringEndTime = document.getElementById('recurringEndTime');
            const recurringVisitInstructions = document.getElementById('recurringVisitInstructions');
            
            if (recurringAnytime.checked) {
                recurringStartTime.disabled = true;
                recurringEndTime.disabled = true;
                recurringVisitInstructions.disabled = true;
            } else {
                recurringStartTime.disabled = false;
                recurringEndTime.disabled = false;
                recurringVisitInstructions.disabled = false;
            }
        }
        
        // Toggle recurring repeat options (always visible for recurring)
        function toggleRecurringRepeatOptions() {
            // For recurring, the end options are always visible
            // This function is kept for consistency but doesn't need to do anything
        }
        
        // Toggle recurring end fields
        function toggleRecurringEndFields() {
            const recurringEndsAfter = document.getElementById('recurringEndsAfter');
            const recurringEndsOn = document.getElementById('recurringEndsOn');
            const recurringEndsAfterFields = document.getElementById('recurringEndsAfterFields');
            const recurringEndsOnField = document.getElementById('recurringEndsOnField');
            
            if (recurringEndsAfter.checked) {
                recurringEndsAfterFields.style.display = 'flex';
                recurringEndsOnField.style.display = 'none';
            } else if (recurringEndsOn.checked) {
                recurringEndsAfterFields.style.display = 'none';
                recurringEndsOnField.style.display = 'block';
            }
        }
        
        // Add product item function
        function addProductItem() {
            productItemCount++;
            const productItemsContainer = document.getElementById('productItems');
            
            const productItem = document.createElement('div');
            productItem.className = 'product-item';
            productItem.innerHTML = `
                <button type="button" class="delete-item-btn" onclick="removeProductItem(this)">
                    <i class="fas fa-times"></i>
                </button>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="product_name_${productItemCount}" placeholder="Enter product/service name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="product_quantity_${productItemCount}" value="1" min="1" onchange="calculateTotals()">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Unit Cost</label>
                        <input type="number" class="form-control" name="product_unit_cost_${productItemCount}" step="0.01" placeholder="0.00" onchange="calculateTotals()">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Unit Price</label>
                        <input type="number" class="form-control" name="product_unit_price_${productItemCount}" step="0.01" placeholder="0.00" onchange="calculateTotals()">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Total</label>
                        <input type="number" class="form-control" name="product_total_${productItemCount}" step="0.01" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="product_description_${productItemCount}" rows="2" placeholder="Enter description"></textarea>
                    </div>
                </div>
            `;
            
            productItemsContainer.appendChild(productItem);
            calculateTotals();
        }
        
        // Remove product item function
        function removeProductItem(button) {
            button.parentElement.remove();
            calculateTotals();
        }
        
        // Calculate totals function
        function calculateTotals() {
            let totalCost = 0;
            let totalPrice = 0;
            
            document.querySelectorAll('.product-item').forEach(item => {
                const quantity = parseFloat(item.querySelector('input[name*="quantity"]').value) || 0;
                const unitCost = parseFloat(item.querySelector('input[name*="unit_cost"]').value) || 0;
                const unitPrice = parseFloat(item.querySelector('input[name*="unit_price"]').value) || 0;
                
                const total = quantity * unitPrice;
                item.querySelector('input[name*="total"]').value = total.toFixed(2);
                
                totalCost += quantity * unitCost;
                totalPrice += total;
            });
            
            document.getElementById('totalCost').textContent = '$' + totalCost.toFixed(2);
            document.getElementById('totalPrice').textContent = '$' + totalPrice.toFixed(2);
        }
        
        // Show notes form function
        function showNotesForm() {
            const notesForm = document.getElementById('notesForm');
            const notesArea = document.querySelector('.notes-area');
            
            notesForm.classList.add('active');
            notesArea.style.display = 'none';
        }
        
        // File upload handling
        document.getElementById('fileUpload').addEventListener('change', function(e) {
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = '';
            
            Array.from(e.target.files).forEach(file => {
                const fileItem = document.createElement('div');
                fileItem.className = 'd-flex align-items-center justify-content-between p-2 border rounded mb-2';
                fileItem.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file me-2"></i>
                        <span>${file.name}</span>
                        <small class="text-muted ms-2">(${(file.size / 1024).toFixed(1)} KB)</small>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile(this)">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                fileList.appendChild(fileItem);
            });
        });
        
        // Remove file function
        function removeFile(button) {
            button.parentElement.remove();
        }
        
        // Save job function
        function saveJob() {
            // Add product items data
            const productItems = [];
            document.querySelectorAll('.product-item').forEach((item, index) => {
                const productData = {
                    name: item.querySelector('input[name*="name"]').value,
                    quantity: item.querySelector('input[name*="quantity"]').value,
                    unit_cost: item.querySelector('input[name*="unit_cost"]').value,
                    unit_price: item.querySelector('input[name*="unit_price"]').value,
                    total: item.querySelector('input[name*="total"]').value,
                    description: item.querySelector('textarea[name*="description"]').value
                };
                productItems.push(productData);
            });
            
            // Create hidden input for product items
            let productItemsInput = document.getElementById('productItemsData');
            if (!productItemsInput) {
                productItemsInput = document.createElement('input');
                productItemsInput.type = 'hidden';
                productItemsInput.name = 'product_items';
                productItemsInput.id = 'productItemsData';
                document.getElementById('jobForm').appendChild(productItemsInput);
            }
            productItemsInput.value = JSON.stringify(productItems);
            
            // Submit the form
            document.getElementById('jobForm').submit();
        }
        
        // Auto-calculate total when quantity or price changes
        document.addEventListener('input', function(e) {
            if (e.target.name && (e.target.name.includes('quantity') || e.target.name.includes('unit_price'))) {
                const item = e.target.closest('.product-item');
                if (item) {
                    const quantity = parseFloat(item.querySelector('input[name*="quantity"]').value) || 0;
                    const unitPrice = parseFloat(item.querySelector('input[name*="unit_price"]').value) || 0;
                    const total = quantity * unitPrice;
                    item.querySelector('input[name*="total"]').value = total.toFixed(2);
                    calculateTotals();
                }
            }
        });
        
        // Toggle repeat options based on selection
        function toggleRepeatOptions() {
            const repeatsSelect = document.getElementById('repeats');
            const repeatEndOptions = document.getElementById('repeatEndOptions');
            
            if (repeatsSelect.value === 'none') {
                repeatEndOptions.style.display = 'none';
            } else {
                repeatEndOptions.style.display = 'block';
            }
        }
        
        // Toggle end fields based on radio button selection
        function toggleEndFields() {
            const endsAfter = document.getElementById('endsAfter');
            const endsOn = document.getElementById('endsOn');
            const endsAfterFields = document.getElementById('endsAfterFields');
            const endsOnField = document.getElementById('endsOnField');
            
            if (endsAfter.checked) {
                endsAfterFields.style.display = 'flex';
                endsOnField.style.display = 'none';
            } else if (endsOn.checked) {
                endsAfterFields.style.display = 'none';
                endsOnField.style.display = 'block';
            }
        }
        
        // Set default time for both sections
        const now = new Date();
        now.setHours(now.getHours() + 1);
        const startTime = now.toTimeString().slice(0, 5);
        now.setHours(now.getHours() + 2);
        const endTime = now.toTimeString().slice(0, 5);
        
        // Set default times for one-off schedule
        document.getElementById('startTime').value = startTime;
        document.getElementById('endTime').value = endTime;
        
        // Set default times for recurring schedule
        document.getElementById('recurringStartTime').value = startTime;
        document.getElementById('recurringEndTime').value = endTime;
    </script>
</body>
</html>
