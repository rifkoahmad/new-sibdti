@extends('kerangka.master')
@section('title', 'Tabel Barang')
@section('content')
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title text-center">Tabel Barang</h4>
                        <a class="btn btn-success" href="{{ route('barang.create') }}">Tambah</a>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session()->has('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('failed') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-content">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Ruangan</th>
                                    <th>Stok</th>
                                    {{-- <th>Foto</th> --}}
                                    <th>Status</th>
                                    <th>Function</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->kode_barang }}</td>
                                        <td>{{ $item->ruangans->nama_ruangan }}</td>
                                        <td>{{ $item->stok }}</td>
                                        {{-- <td><img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama_barang }}" width="100"></td> --}}
                                        <td>
                                            <span class="badge {{ $item->status == 0 ? 'bg-danger' : 'bg-success' }}">
                                                {{ $item->status == 0 ? 'Rusak' : 'Bagus' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-primary btn-sm me-2" href="{{ route('barang.show', $item->id) }}">
                                                    <i class="bi bi-eye"></i> Detail
                                                </a>
                                                <a class="btn btn-primary btn-sm me-2" href="{{ route('barang.edit', $item->id) }}">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                                <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash-fill"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
