@extends('admin.layout')

@section('title', 'Kelola Training Programs & Progress Member')

@section('content')
<div class="container-fluid px-0">
    <!-- Header Page -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-white mb-1">
                <i class="fa-solid fa-dumbbell text-lime me-2"></i>Modul Training Programs & Kurikulum Latihan
            </h3>
            <p class="text-secondary small mb-0">Kelola Program Templates, penugasan program ke member, master exercises, dan evaluasi perkembangan fisik (Progress Tracking).</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-lime fw-bold btn-sm" data-bs-toggle="modal" data-bs-target="#modalAssignProgram">
                <i class="fa-solid fa-user-plus me-1"></i> Assign Program ke Member
            </button>
            <button type="button" class="btn btn-lime text-dark fw-bold btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddTemplate">
                <i class="fa-solid fa-plus me-1"></i> Buat Program Template Baru
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success rounded-4 mb-4">
            <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger rounded-4 mb-4">
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Nav Tabs -->
    <ul class="nav nav-pills custom-admin-tabs mb-4 border-bottom border-secondary pb-3" id="trainingTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active text-white fw-bold" id="templates-tab" data-bs-toggle="tab" data-bs-target="#templates-content" type="button">
                <i class="fa-solid fa-layer-group me-1"></i> Program Templates ({{ count($templates) }})
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link text-white fw-bold" id="assigned-tab" data-bs-toggle="tab" data-bs-target="#assigned-content" type="button">
                <i class="fa-solid fa-user-check me-1"></i> Program Member Aktif ({{ count($memberPrograms) }})
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link text-white fw-bold" id="exercises-tab" data-bs-toggle="tab" data-bs-target="#exercises-content" type="button">
                <i class="fa-solid fa-person-running me-1"></i> Master Exercises ({{ count($exercises) }})
            </button>
        </li>
    </ul>

    <!-- Tab Contents -->
    <div class="tab-content" id="trainingTabsContent">
        
        <!-- TAB 1: PROGRAM TEMPLATES -->
        <div class="tab-pane fade show active" id="templates-content" role="tabpanel">
            <div class="row g-4">
                @forelse($templates as $tpl)
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="admin-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between border border-secondary" style="background: #111827;">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-lime text-dark fw-bold px-2 py-1 small">
                                        {{ str_replace('_', ' ', $tpl->goal) }}
                                    </span>
                                    <span class="badge bg-dark border border-info text-info fw-bold px-2 py-1 small">
                                        {{ $tpl->level }}
                                    </span>
                                </div>
                                <h4 class="fw-bold text-white mb-1 mt-2">{{ $tpl->name }}</h4>
                                <p class="text-secondary small mb-3">{{ $tpl->description ?: 'Template program latihan terstruktur.' }}</p>

                                <div class="p-3 bg-dark rounded-3 border border-secondary mb-3">
                                    <div class="row text-center g-2">
                                        <div class="col-6 border-end border-secondary">
                                            <span class="text-secondary small d-block">Durasi Program</span>
                                            <span class="fw-bold text-lime fs-5">{{ $tpl->duration_weeks }} Minggu</span>
                                        </div>
                                        <div class="col-6">
                                            <span class="text-secondary small d-block">Estimasi / Sesi</span>
                                            <span class="fw-bold text-info fs-5">{{ $tpl->estimated_duration_minutes }} Menit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-3 border-top border-secondary d-flex justify-content-between align-items-center">
                                <span class="small text-secondary"><i class="fa-solid fa-list-check me-1"></i> {{ $tpl->workouts_count }} Sesi Workout</span>
                                <form action="{{ route('admin.training_programs.templates.destroy', $tpl->id) }}" method="POST" onsubmit="return confirm('Hapus template ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-secondary">
                        <i class="fa-solid fa-dumbbell fa-3x mb-3 opacity-50"></i>
                        <p class="mb-0 fs-6">Belum ada Program Template terdaftar.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- TAB 2: MEMBER PROGRAMS AKTIFF -->
        <div class="tab-pane fade" id="assigned-content" role="tabpanel">
            <div class="admin-card p-4 rounded-4 border border-secondary" style="background: #111827;">
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle mb-0">
                        <thead>
                            <tr class="text-secondary small text-uppercase">
                                <th>Nama Member</th>
                                <th>Program Assigned</th>
                                <th>Trainer Pembimbing</th>
                                <th>Tanggal Mulai - Selesai</th>
                                <th>Status Program</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($memberPrograms as $mp)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-white">{{ $mp->member ? $mp->member->name : 'Member ID #' . $mp->member_id }}</div>
                                        <div class="small text-secondary">{{ $mp->member ? $mp->member->email : '-' }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-lime">{{ $mp->template ? $mp->template->name : 'Custom Program' }}</div>
                                        <div class="small text-secondary">Goal: {{ $mp->goal }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-dark border border-secondary text-info">
                                            <i class="fa-solid fa-user-ninja me-1"></i> {{ $mp->trainer ? $mp->trainer->name : 'Unassigned Coach' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="small text-white"><i class="fa-solid fa-calendar-days text-lime me-1"></i> {{ $mp->start_date }} s/d {{ $mp->end_date ?: 'Ongoing' }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-success text-dark fw-bold px-2 py-1">{{ $mp->status }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-secondary">Belum ada program latihan yang ditugaskan ke member.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB 3: MASTER EXERCISES -->
        <div class="tab-pane fade" id="exercises-content" role="tabpanel">
            <div class="row g-3">
                @forelse($exercises as $ex)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="p-3 rounded-3 bg-dark border border-secondary d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-bold text-white mb-1"><i class="fa-solid fa-bolt text-lime me-1"></i> {{ $ex->name }}</div>
                                <div class="small text-secondary">{{ $ex->muscle_group }} • {{ $ex->equipment ?: 'Bodyweight' }}</div>
                            </div>
                            <span class="badge bg-secondary text-white small">{{ $ex->category }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-secondary">Belum ada master exercise terdaftar.</div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Modal Create Template -->
    <div class="modal fade" id="modalAddTemplate" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark border border-secondary text-white">
                <form action="{{ route('admin.training_programs.templates.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title fw-bold text-lime"><i class="fa-solid fa-plus me-2"></i>Buat Program Template Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label small text-secondary">Nama Template Program</label>
                                <input type="text" name="name" class="form-control bg-dark text-white border-secondary" placeholder="Misal: Fat Loss Beginner 12-Weeks" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-secondary">Goal Latihan</label>
                                <select name="goal" class="form-select bg-dark text-white border-secondary" required>
                                    <option value="FAT_LOSS">FAT LOSS (Pembakaran Lemak)</option>
                                    <option value="MUSCLE_GAIN">MUSCLE GAIN (Peningkatan Otot)</option>
                                    <option value="STRENGTH">STRENGTH (Kekuatan)</option>
                                    <option value="ENDURANCE">ENDURANCE (Stamina & Cardio)</option>
                                    <option value="GENERAL_FITNESS">GENERAL FITNESS</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-secondary">Tingkat Kesulitan</label>
                                <select name="level" class="form-select bg-dark text-white border-secondary" required>
                                    <option value="BEGINNER">BEGINNER (Pemula)</option>
                                    <option value="INTERMEDIATE">INTERMEDIATE (Menengah)</option>
                                    <option value="ADVANCED">ADVANCED (Lanjutan)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-secondary">Durasi Program (Minggu)</label>
                                <input type="number" name="duration_weeks" class="form-control bg-dark text-white border-secondary" value="12" min="1" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-secondary">Estimasi Durasi / Sesi (Menit)</label>
                                <input type="number" name="estimated_duration_minutes" class="form-control bg-dark text-white border-secondary" value="45" min="10" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-secondary">Deskripsi & Instruksi Program</label>
                                <textarea name="description" class="form-control bg-dark text-white border-secondary" rows="3" placeholder="Deskripsi mengenai target & aturan program latihan ini..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-lime text-dark fw-bold">Buat Template 🏋️</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Assign Program ke Member -->
    <div class="modal fade" id="modalAssignProgram" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark border border-secondary text-white">
                <form action="{{ route('admin.training_programs.assign') }}" method="POST">
                    @csrf
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title fw-bold text-lime"><i class="fa-solid fa-user-plus me-2"></i>Assign Program Latihan ke Member</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small text-secondary">Pilih Member Gym</label>
                                <select name="member_id" class="form-select bg-dark text-white border-secondary" required>
                                    @foreach($members as $m)
                                        <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-secondary">Pilih Program Template</label>
                                <select name="program_template_id" class="form-select bg-dark text-white border-secondary" required>
                                    @foreach($templates as $tpl)
                                        <option value="{{ $tpl->id }}">{{ $tpl->name }} ({{ $tpl->duration_weeks }} Minggu)</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-secondary">Personal Trainer Pembimbing</label>
                                <select name="trainer_id" class="form-select bg-dark text-white border-secondary">
                                    <option value="">-- Pilih Coach --</option>
                                    @foreach($trainers as $tr)
                                        <option value="{{ $tr->id }}">{{ $tr->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-secondary">Tanggal Mulai Program</label>
                                <input type="date" name="start_date" class="form-control bg-dark text-white border-secondary" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small text-secondary">Catatan Khusus dari Trainer/Admin</label>
                                <textarea name="notes" class="form-control bg-dark text-white border-secondary" rows="2" placeholder="Catatan instruksi khusus untuk member..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-lime text-dark fw-bold">Tugaskan Program 🚀</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
