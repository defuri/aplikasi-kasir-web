<div class="table-responsive mb-5">
    <table class="table table-striped table-hover align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Log</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Username</th>
                <th scope="col">Hak</th>
                <th scope="col">Waktu</th>
            </tr>
        </thead>
        <tbody wire:poll>
            @foreach ($defLog as $defItem)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $defItem->log_name }}</td>
                    <td>
                        @php
                            $defDescription = $defItem->description;
                            $defBadgeColor = '';

                            if ($defDescription == 'LOGIN') {
                                $defBadgeColor = 'success';
                            } elseif ($defDescription == 'LOGOUT') {
                                $defBadgeColor = 'danger';
                            } elseif (str_contains(strtolower($defDescription), 'insert')) {
                                $defBadgeColor = 'success';
                            } elseif (str_contains(strtolower($defDescription), 'update')) {
                                $defBadgeColor = 'warning';
                            } elseif (str_contains(strtolower($defDescription), 'delete')) {
                                $defBadgeColor = 'danger';
                            }
                        @endphp

                        @if ($defBadgeColor)
                            <span class="badge bg-{{ $defBadgeColor }} text-white">{{ $defDescription }}</span>
                        @else
                            {{ $defDescription }}
                        @endif
                    </td>
                    <td>{{ $defItem->causer?->username ?? 'Unknown User' }}</td>
                    <td>{{ $defItem->causer?->hak ?? 'Unknown User' }}</td>
                    <td>{{ $defItem->created_at->setTimezone('Asia/Jakarta')->format('H:i d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $defLog->links() }}
</div>
