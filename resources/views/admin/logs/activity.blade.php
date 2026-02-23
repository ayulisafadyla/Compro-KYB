@extends('admin.layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2>Activity Log</h2>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead>
                    <tr>
                        <th width="180">Timestamp</th>
                        <th>Administrator</th>
                        <th>Action</th>
                        <th>Module</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                        <tr>
                            <td>
                                <div class="fw-bold small">{{ $activity->created_at->format('d M Y') }}</div>
                                <div class="text-muted x-small">{{ $activity->created_at->format('H:i:s') }}</div>
                            </td>
                            <td class="small fw-bold">{{ $activity->user->name ?? 'System' }}</td>
                            <td>
                                @php
                                    $actionBadge = 'bg-secondary';
                                    if(str_contains(strtolower($activity->action), 'create')) $actionBadge = 'bg-success';
                                    elseif(str_contains(strtolower($activity->action), 'update')) $actionBadge = 'bg-warning text-dark';
                                    elseif(str_contains(strtolower($activity->action), 'delete')) $actionBadge = 'bg-danger';
                                @endphp
                                <span class="badge {{ $actionBadge }} small">{{ $activity->action }}</span>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $activity->module }}</span></td>
                            <td class="small">{{ $activity->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No activities found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($activities->hasPages())
            <div class="mt-4">
                {{ $activities->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
