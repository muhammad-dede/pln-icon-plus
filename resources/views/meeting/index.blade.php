@extends('layouts.main')

@section('title', 'Meeting')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-status-top bg-primary"></div>
                <div class="card-header">
                    <h3 class="card-title">
                        Data Meeting
                    </h3>
                    <div class="card-actions">
                        @can('create-meeting')
                            <a class="btn-link text-primary mx-2" href="{{ route('meeting.create') }}">
                                Pemesanan
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div id="table-default" class="table-responsive">
                        <table class="table table-vcenter" id="dataTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Unit</th>
                                    <th>Ruang</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Peserta</th>
                                    <th>Konsumsi</th>
                                    <th>Pemesan</th>
                                    <th>Status</th>
                                    <th class="w-1"></th>
                                    <th class="w-1"></th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="text-muted">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $item->unit ?? '-' }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $item->ruangMeeting->nama ?? '-' }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $item->tanggal_meeting ? date_format(date_create($item->tanggal_meeting), 'd-m-Y') : '-' }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $item->waktuMeeting->nama ?? '-' }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $item->jumlah_peserta ?? '0' }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $item->jenisKonsumsi->nama ?? '-' }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $item->user->nama ?? '-' }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $item->status == 0 ? 'Digunakan' : 'Selesai' }}
                                        </td>
                                        <td>
                                            @can('edit-meeting')
                                                <a class="btn-link text-info" href="{{ route('meeting.edit', $item) }}">
                                                    Ubah
                                                </a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('destroy-meeting')
                                                <form action="{{ route('meeting.destroy', $item) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a class="btn-link text-danger btn_delete"
                                                        href="{{ route('meeting.destroy', $item) }}"
                                                        data-item="{{ $item->unit ?? '-' }}">
                                                        Hapus
                                                    </a>
                                                </form>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('status-meeting')
                                                <form action="{{ route('meeting.status', $item) }}" method="POST">
                                                    @csrf
                                                    @method('post')
                                                    <a class="btn-link text-warning btn_status"
                                                        href="{{ route('meeting.status', $item) }}"
                                                        data-item="{{ $item->unit ?? '-' }}">
                                                        Status
                                                    </a>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();

            $('.btn_delete').click(function(event) {
                var item = $(this).attr('data-item');
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                    title: "Anda akan menghapus",
                    text: item,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
            $('.btn_status').click(function(event) {
                var item = $(this).attr('data-item');
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                    title: "Anda akan mengubah status",
                    text: item,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
