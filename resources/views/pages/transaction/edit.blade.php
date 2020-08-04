@extends('layouts.default')

@section('content')
    <div class="card">
      <div class="card-header">
        <strong>Ubah Transaksi</strong>
        <small>{{ $item->uuid }}</small>
      </div>
      <div class="card-body card-block">
        <form action="{{ route('transaction.update', $item->id) }}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label for="name" class="form-control-label">Nama Pemesan</label>
            <input  type="text"
                    name="name" 
                    value="{{ old('name') ? old('name') : $item->name }}" 
                    class="form-control @error('name') is-invalid @enderror"/>
            @error('name') <div class="text-muted">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="email" class="form-control-label">Email</label>
            <input  type="email"
                    name="email" 
                    value="{{ old('email') ? old('email') : $item->email }}" 
                    class="form-control @error('email') is-invalid @enderror"/>
            @error('email') <div class="text-muted">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="number" class="form-control-label">Nomor HP</label>
            <input  type="text"
                    name="number" 
                    value="{{ old('number') ? old('number') : $item->number }}" 
                    class="form-control @error('number') is-invalid @enderror"/>
            @error('number') <div class="text-muted">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label for="address" class="form-control-label">Alamat Pemesan</label>
            <input  type="text"
                    name="address" 
                    value="{{ old('address') ? old('address') : $item->address }}" 
                    class="form-control @error('address') is-invalid @enderror"/>
            @error('address') <div class="text-muted">{{ $message }}</div> @enderror
          </div>
          <div class="row">
            <div class="col-4">
              <a href="{{ route('transaction.status', $item->id) }}?status=SUCCESS" class="btn btn-success btn-block">
                <i class="fa fa-check"></i> Set Sukses
              </a>
            </div>
            <div class="col-4">
              <a href="{{ route('transaction.status', $item->id) }}?status=FAILED" class="btn btn-warning btn-block">
                <i class="fa fa-times"></i> Set Gagal
              </a>
            </div>
            <div class="col-4">
              <a href="{{ route('transaction.status', $item->id) }}?status=PENDING" class="btn btn-info btn-block">
                <i class="fa fa-spinner"></i> Set Pending
              </a>
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">
              Ubah Transaksi
            </button>
          </div>
        </form>
      </div>
    </div>
@endsection