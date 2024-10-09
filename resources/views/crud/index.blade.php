@extends('layout.main')
@section('content')
<div class="content-wrapper p-3">
    <h4 class="mt-2">Data Dosen</h4>
    <a href="{{ route('create') }}" class="btn btn-primary mb-3">Buat Data Baru</a>
<div class="container">
        <div class="container-fluid">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NIDN</th>
                        <th>Nama Dosen</th>
                        <th>Tanggal Mulai Tugas</th>
                        <th>Jenjang Pendidikan</th>
                        <th>Bidang Keilmuan</th>
                        <th>Foto Dosen</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($utp as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nidn }}</td>
                            <td>{{ $item->nama_dosen }}</td>
                            <td>{{ $item->tgl_mulai_tugas}}</td>
                            <td>{{ $item->jenjang_pendidikan }}</td>
                            <td>{{ $item->bidang_keilmuan }}</td>
                            <td>
                                <img src="{{ Storage::url($item->foto_dosen) }}" alt="Image" width="100" height="130">
                            </td>
                            <td>
                                <a href="{{ route('edit', $item->id) }}" class="btn btn-success mb-1 pl-2 pr-4 "><i class="fas fa-edit pl-1"></i> Edit</a>
                                <a data-toggle="modal" data-target="#modal-hapus{{ $item->id }}" class="btn btn-danger px-2"><i class="fas fa-trash-alt pl-1"></i> Hapus</a>
                            </td>
                        </tr>

                        <div class="modal fade" id="modal-hapus{{ $item->id }}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Ingin Menghapus Data<b>{{ $item->name }} ?</b>
                                  </div></p>
                                <div class="modal-footer">
                                    <form action="{{ route('delete', ['utp' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ya, Hapus Data</button>
                                      </form>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            {{ $utp->links() }}
        </div>
    </div>
</section>
</div>
@endsection