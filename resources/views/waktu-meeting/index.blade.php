@extends('layouts.main')

@section('title', 'Waktu Meeting')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-status-top bg-primary"></div>
                <div class="card-header">
                    <h3 class="card-title">
                        Data Waktu Meeting
                    </h3>
                    <div class="card-actions">
                        @can('create-ruang-meeting')
                            <a class="btn-link text-primary mx-2" href="{{ route('waktu-meeting.create') }}">
                                Tambah
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
                                    <th>Nama</th>
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
                                            {{ $item->nama ?? '-' }}
                                        </td>
                                        <td>
                                            @can('edit-ruang-meeting')
                                                <a class="btn-link text-info" href="{{ route('waktu-meeting.edit', $item) }}">
                                                    Ubah
                                                </a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('destroy-ruang-meeting')
                                                <form action="{{ route('waktu-meeting.destroy', $item) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a class="btn-link text-danger btn_delete"
                                                        href="{{ route('waktu-meeting.destroy', $item) }}"
                                                        data-item="{{ $item->nama ?? '-' }}">
                                                        Hapus
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
        });
    </script>
@endpush
