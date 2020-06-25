@extends('index.layout.index')
@section('title')
<title>Báo cáo sử dụng thuốc - Quản lý phòng mạch tư</title>
@endsection
@section('style')
<link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />

<link href="assets/css/cssdate.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="page-title-box d-flex align-items-center justify-content-between">
      <h4 class="mb-0 font-size-18">Báo cáo sử dụng thuốc</h4>

      <div class="page-title-right d-none d-lg-block">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
          <li class="breadcrumb-item active">Báo cáo</li>
          <li class="breadcrumb-item active">Báo cáo sử dụng thuốc</li>
        </ol>
      </div>

    </div>
  </div>
</div>

@if (count($errors) > 0 || session('error'))
<div class="alert alert-danger" role="alert">
  <strong>Cảnh báo!</strong><br>
  @foreach($errors->all() as $err)
  {{$err}}<br />
  @endforeach
  {{session('error')}}
</div>
@endif
@if (session('success'))
<div class="alert alert-success">
  <strong>Thành công!</strong>
  <button type="button" class="close" data-dismiss="alert">×</button>
  <br />
  {{session('success')}}
</div>
@endif
<!--end duong dan nho-->
<div class="row">
  <div class="col-sm-12">
    <div class="card-box table-responsive">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4 font-size-16">Báo cáo sử dụng thuốc</h4>
          <div class="form-group date">
            {{csrf_field()}}
            <label>Tháng</label><br>
            <input class="input-small datepicker hasDatepicker" type="month" name="thang" onchange="getdsbaocao(this.value)" value="{{date("Y-m")}}">
          </div>

          <div class="p-10">
            <table class="table table-striped table-bordered m-0">
              <thead>
                <tr>
                  <th class="text-center">STT</th>
                  <th class="text-center">Thuốc</th>
                  <th class="text-center">Đơn vị</th>
                  <th class="text-center">Số lượng dùng</th>
                  <th class="text-center">Số lần dùng</th>
                </tr>
              </thead>
              <tbody style="text-align: center" id="tbodydskhambenh">
                <?php $i = 0; ?>
                @if(isset($CTBCSDT))
                @foreach($CTBCSDT as $detail)
                <tr>
                  <td>{{++$i}}</td>
                  <td>{{$detail->thuoc->TenThuoc}}</td>
                  <td>{{$detail->thuoc->donvi->TenDonVi}}</td>
                  <td>{{number_format($detail->SoLuongDung,0,',','.')}}</td>
                  <td>{{number_format($detail->SoLanDung,0,',','.')}}</td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="5">Không có dữ liệu</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="d-print-none p-t-10 mt-3">
            <div class="float-right">
              <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print"></i></a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
@section('script-ori')
@endsection
@section('script')
<script>
  function getdsbaocao(value) {
    var token = $("input[name='_token']").val();
    //            alert(value);
    $.ajax({
      url: "{{route('ajax-bcsdt.get')}}",
      type: "GET",
      async: true,
      data: {
        "_token": token,
        "key": value
      },
      success: function(data) {
        $("#tbodydskhambenh").html(data);
      }
    });
  }
</script>
@endsection
