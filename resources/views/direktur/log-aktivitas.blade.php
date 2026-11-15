@extends('layouts.direktur')

@section('title', 'Audit Trail // Log Aktivitas Sistem')

@section('content')
<div class="py-6 space-y-6">
    <div class="bg-white rounded-2xl border border-line p-6 shadow-sm">
        
        {{-- Header Halaman --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h3 class="text-xl font-bold text-ink">Rekam Jejak Log Aktivitas Sistem</h3>
                <p class="text-sm text-ink-muted">Mencatat seluruh mutasi data operasional secara real-time dari database MySQL.</p>
            </div>
        </div>

        {{-- Tabel Data Log --}}
        <div class="overflow-x-auto rounded-xl border border-line">
            <table class="min-w-full divide-y divide-line text-sm">
                <thead class="bg-surface-muted">
                    <tr>
                        <th class="px-4 py-3 text-left font-bold text-ink-muted uppercase text-xs">Waktu</th>
                        <th class="px-4 py-3 text-left font-bold text-ink-muted uppercase text-xs">Pengguna</th>
                        <th class="px-4 py-3 text-left font-bold text-ink-muted uppercase text-xs">Aksi</th>
                        <th class="px-4 py-3 text-left font-bold text-ink-muted uppercase text-xs">Modul</th>
                        <th class="px-4 py-3 text-left font-bold text-ink-muted uppercase text-xs">Keterangan</th>
                        <th class="px-4 py-3 text-left font-bold text-ink-muted uppercase text-xs">Alamat IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line bg-surface">
                    @forelse($logs as $log)
                        <tr class="hover:bg-surface-muted/50 transition-colors">
                            {{-- Waktu --}}
                            <td class="px-4 py-3 whitespace-nowrap text-xs text-ink-muted font-mono">
                                {{ $log->created_at->format('d/m/Y H:i:s') }}
                            </td>

                            {{-- Nama Pengguna (dari relasi user) --}}
                            <td class="px-4 py-3 font-semibold text-ink">
                                {{ $log->user?->name ?? 'Sistem / Tamu' }}
                            </td>

                            {{-- Badge Aksi (Warna Dinamis) --}}
                            <td class="px-4 py-3">
                                <span class="px-2 py-0.5 rounded text-xs font-bold 
                                    {{ $log->action === 'CREATE' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                    {{ $log->action === 'UPDATE' ? 'bg-amber-100 text-amber-800' : '' }}
                                    {{ $log->action === 'DELETE' ? 'bg-rose-100 text-rose-800' : '' }}">
                                    {{ $log->action }}
                                </span>
                            </td>

                            {{-- Modul --}}
                            <td class="px-4 py-3 font-mono text-xs font-semibold text-ink-muted">
                                {{ $log->module }}
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-4 py-3 text-ink">
                                {{ $log->description }}
                            </td>

                            {{-- IP Address --}}
                            <td class="px-4 py-3 text-xs font-mono text-ink-muted">
                                {{ $log->ip_address ?? '127.0.0.1' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-ink-muted">
                                Belum ada riwayat aktivitas yang tercatat di database.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Navigasi Paginasi Halaman --}}
        <div class="mt-4">
            {{ $logs->links() }}
        </div>

    </div>
</div>
@endsection