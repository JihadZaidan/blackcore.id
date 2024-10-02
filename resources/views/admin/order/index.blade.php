@extends('admin_layout')

@section('title', 'order')

@section('content')
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 class="card-title mb-2">Order</h4>
              <p class="card-description mb-0">
                Daftar pesanan masuk yang telah dilakukan oleh pembeli
              </p>
            </div>
            <button class="btn btn-dark btn-icon-text" data-toggle="modal" data-target="#addOrderModal">
              <i class="ti-plus btn-icon-prepend"></i>
              Tambah Order
            </button>
          </div>
          <div class="d-flex justify-content-end align-items-end mb-2">
            <form action="" class="input-group" style="max-width: 300px;">
              <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control"
                placeholder="Search order" aria-label="Search order">
              <div class="input-group-append">
                <button class="btn btn-dark" type="submit" style="padding: 0.8rem 1.5rem">
                  <i class="ti-search"></i>
                </button>
              </div>
            </form>
          </div>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No. Invoice</th>
                  <th>Tanggal</th>
                  <th>Pembeli</th>
                  <th>Total</th>
                  <th>Status Order</th>
                  <th>Status Pembayaran</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach (range(0, 10) as $item)
                  <tr>
                    <td>{{ fake()->numerify('INV-########') }}</td>
                    <td>{{ \Illuminate\Support\Carbon::today()->subDays(rand(0, 365))->format('d M Y H:i:s') }}</td>
                    <td>{{ fake()->name() }}</td>
                    <td>{{ formatRupiah(rand(100000, 1000000)) }}</td>
                    <td>
                      @if (rand(0, 1))
                      <span class="badge badge-success">Selesai</span>
                      @else
                      <span class="badge badge-warning">Diproses</span>
                      @endif
                    </td>
                    <td>
                      @if (rand(0, 1))
                      <span class="badge badge-success">Lunas</span>
                      @else
                      <span class="badge badge-warning">Belum Lunas</span>
                      @endif
                    </td>
                    <td>
                      <button class="btn btn-sm btn-dark">Detail</button>
                      <button class="btn btn-sm btn-warning">Konfirmasi Pembayaran</button>
                      <button class="btn btn-sm btn-danger">Batalkan</button>
                    </td>
                  </tr>
                @endforeach


              </tbody>
            </table>
          </div>
          <div class="mt-3">
            {{-- {{ $order->withQueryString()->links() }} --}}
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addOrderModal" tabindex="-1" role="dialog" aria-labelledby="addOrderModalLabel"
    aria-hidden="true">
    <form action="" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addOrderModalLabel">Tambah Order Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="order_name">Nama Order</label>
              <input type="text" class="form-control" id="order_name" name="order_name" data-slug-target="#slug"
                placeholder="Masukkan nama kategory" value="{{ old('order_name') }}" required>
              @error('order_name')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="slug">Slug</label>
              <input type="text" class="form-control" id="slug" name="slug"
                placeholder="Ketik nama order untuk generate slug otomatis" value="{{ old('slug') }}" required>
              @error('slug')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark">Simpan Order</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  @push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // auto generate slug

      });

      // show modal when errors occur
      @if (count($errors) > 0)
        $(document).ready(function() {
          $('#addOrderModal').modal('show');
        });
      @endif

      // delete confirmation
      function confirmDelete(id, name) {
        Swal.fire({
          title: 'Hapus Order',
          text: "Apakah Anda yakin ingin menghapus order '" + name + "' ini?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Menghapus...'
            });
            Swal.showLoading();
            $('#delete-form-' + id).submit();
          }
        })
      }

    </script>
  @endpush
@endsection
