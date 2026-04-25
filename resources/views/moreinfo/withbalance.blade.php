@extends('home.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="content" style="padding-top:0;">
<div class="container-fluid pt-3 pb-4">
    <div class="pg-hero" style="background:linear-gradient(135deg,#991b1b 0%,#dc2626 55%,#ef4444 100%);margin-bottom:20px;">
        <div class="pg-hero__eyebrow"><i class="fas fa-exclamation-circle"></i> Dashboard</div>
        <div class="pg-hero__title">Students with Balance</div>
        <div class="pg-hero__sub">Students who still have outstanding payment balances</div>
    </div>
    <div class="pg-card">
        <div class="pg-toolbar">
            <div class="pg-toolbar__title">
                <span class="pg-toolbar__dot" style="background:#ef4444;box-shadow:0 0 0 3px rgba(239,68,68,.2);"></span>
                Outstanding Balance Records
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-arrow-left mr-1"></i> Back</a>
        </div>
        <div class="card-body p-0">
        <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>LRN / ID</th><th>Name</th><th>Section</th>
                    <th>Level</th><th>School Year</th><th>Strand</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $s)
                <tr>
                    <td style="font-weight:600;font-variant-numeric:tabular-nums;">{{ $s->Id_num }}</td>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->section }}</td>
                    <td><span style="display:inline-flex;padding:3px 10px;border-radius:999px;font-size:.75rem;font-weight:700;background:rgba(239,68,68,.1);color:#ef4444;border:1px solid rgba(239,68,68,.2);">{{ $s->lvl }}</span></td>
                    <td>{{ $s->ay }}</td>
                    <td>{{ $s->strand ?? '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4" style="color:var(--ct-text-muted);"><i class="fas fa-check-circle" style="font-size:1.5rem;color:#10b981;opacity:.5;display:block;margin-bottom:8px;"></i>No students with balance found.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
        </div>
        @if($students->hasPages())
        <div class="card-footer" style="background:var(--ct-surface-alt);border-top:1px solid var(--ct-border);padding:12px 20px;">{{ $students->links() }}</div>
        @endif
    </div>
</div>
</section>
@endsection
