@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="space-y-6">
    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="page-title">Detail Siswa</h1>
                <p class="page-subtitle">Informasi lengkap detail data siswa.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-secondary">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>
                <a href="{{ route('students.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8 card">
            <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Data Pribadi</h3>
            <dl class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="field-label">NIS</dt>
                    <dd class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $student->nis ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="field-label">Nama Siswa</dt>
                    <dd class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ $student->name }}</dd>
                </div>
                <div>
                    <dt class="field-label">Kelas</dt>
                    <dd class="text-sm text-slate-700 dark:text-slate-200">{{ $student->kelas ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="field-label">Status</dt>
                    <dd>
                        @if($student->status == 'active')
                        <span class="badge badge-success">Aktif</span>
                        @else
                        <span class="badge badge-danger">Non-aktif</span>
                        @endif
                    </dd>
                </div>
            </dl>

            <div class="mt-6 pt-6 border-t border-slate-100 dark:border-slate-800">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Informasi Orang Tua/Wali</h3>
                <dl class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <dt class="field-label">Nama Orang Tua/Wali</dt>
                        <dd class="text-sm text-slate-700 dark:text-slate-200">{{ $student->parent_name }}</dd>
                    </div>
                    <div>
                        <dt class="field-label">No. HP</dt>
                        <dd class="text-sm text-slate-700 dark:text-slate-200">{{ $student->parent_phone }}</dd>
                    </div>
                    <div>
                        <dt class="field-label">Email</dt>
                        <dd class="text-sm text-slate-700 dark:text-slate-200">{{ $student->parent_email ?? '-' }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="field-label">Alamat</dt>
                        <dd class="text-sm text-slate-700 dark:text-slate-200">{{ $student->address }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
