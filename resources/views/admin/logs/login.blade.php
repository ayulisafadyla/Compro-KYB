@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Login History</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead>
                    <tr>
                        <th width="180">Session Login</th>
                        <th>Administrator</th>
                        <th>Status</th>
                        <th>Device</th>
                        <th class="text-end" width="180">Session Logout</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logins as $login)
                        <tr>
                            <td>
                                <div class="fw-bold small">{{ \Carbon\Carbon::parse ($login->login_at)->format('d M Y') }}</div>
                                <div class="text-muted x-small">{{ \Carbon\Carbon::parse($login->login_at)->format('H:i:s') }}</div>
                            </td>
                            <td class="small fw-bold">{{ $login->user->name ?? 'Unknown' }}</td>
                            <td>
                                @if(is_null($login->logout_at) && \Carbon\Carbon::parse ($login->login_at)->diffInHours() < 24)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Terminated</span>
                                @endif
                            </td>
                            <td class="small text-muted" title="{{ $login->user_agent }}">
                                {{ Str::limit ($login->user_agent, 40) }}
                            </td>
                            <td class="text-end">
                                @if($login->logout_at)
                                    <div class="small fw-bold">{{ \Carbon\Carbon::parse ($login->logout_at)->format('d M Y') }}</div>
                                    <div class="text-muted x-small">{{ \Carbon\Carbon::parse ($login->logout_at)->format('H:i:s') }}</div>
                                @else
                                    <span class="text-muted x-small">Ongoing...</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No login history found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logins->hasPages())
            <div class="mt-4">
                {{ $logins->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
