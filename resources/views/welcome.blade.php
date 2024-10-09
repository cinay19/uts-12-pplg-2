@extends('layout.main')
@section('content')
<div class="content-wrapper p-3">
<div class="row">
    <!-- ./col -->
    <div class="col-lg-6 col-md-6 mx-auto">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h4>Data</h4>

          <p>Data Dosen</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="{{ route('information') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-md-6 mx-auto">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h4>Tambah Data</h4>

          <p>Buat Data Dosen</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{ route('index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
</div>
@endsection