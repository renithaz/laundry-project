@extends('layouts.app')
@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <div class="row">
    <div class="col-sm-6 col-md-3 mb-4">
      <div class="card card-stats card-round shadow h-100 py-2 border-left-primary">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <i class="bi bi-receipt text-primary" style="font-size: 2rem;"></i>
            </div>
            <div class="col ms-2">
              <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Transaksi</div>
              <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalTransactions }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3 mb-4">
      <div class="card card-stats card-round shadow h-100 py-2 border-left-success">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <i class="bi bi-currency-dollar text-success" style="font-size: 2rem;"></i>
            </div>
            <div class="col ms-2">
              <div class="text-xs fw-bold text-success text-uppercase mb-1">Total Pendapatan</div>
              <div class="h5 mb-0 fw-bold text-gray-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3 mb-4">
      <div class="card card-stats card-round shadow h-100 py-2 border-left-warning">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <i class="bi bi-hourglass-split text-warning" style="font-size: 2rem;"></i>
            </div>
            <div class="col ms-2">
              <div class="text-xs fw-bold text-warning text-uppercase mb-1">Pesanan Proses</div>
              <div class="h5 mb-0 fw-bold text-gray-800">{{ $processOrders }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3 mb-4">
      <div class="card card-stats card-round shadow h-100 py-2 border-left-info">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <i class="bi bi-people text-info" style="font-size: 2rem;"></i>
            </div>
            <div class="col ms-2">
              <div class="text-xs fw-bold text-info text-uppercase mb-1">Total Customer</div>
              <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalCustomers }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 fw-bold text-primary">Transaksi Terakhir</h6>
          <a href="{{ route('transaction.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Customer</th>
                  <th>Tanggal</th>
                  <th>Status</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach($recentTransactions as $rt)
                <tr>
                  <td>{{ $rt->order_code }}</td>
                  <td>{{ $rt->customer?->customer_name ?? $rt->customer_name ?? '-' }}</td>
                  <td>{{ \Carbon\Carbon::parse($rt->order_date)->format('d/m/Y') }}</td>
                  <td>
                    @if($rt->order_status == 0)
                      <span class="badge bg-warning text-dark">Proses</span>
                    @elseif($rt->order_status == 1)
                      <span class="badge bg-success">Selesai</span>
                    @else
                      <span class="badge bg-info text-dark">Diambil</span>
                    @endif
                  </td>
                  <td>Rp {{ number_format($rt->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                @if($recentTransactions->isEmpty())
                <tr>
                  <td colspan="5" class="text-center">Belum ada transaksi</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection