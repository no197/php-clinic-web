@extends('index.layout.index')
@section('title')
<title>Sửa phiếu khám bệnh - Quản lý phòng mạch tư</title>
@endsection
@section('style')
<!-- <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" /> -->
<link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
<link href="assets/css/cssdate.css" rel="stylesheet" type="text/css">
<link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="row">
  <div class="col-12">
    <div class="page-title-box d-flex align-items-center justify-content-between">
      <h4 class="mb-0 font-size-18">Sửa phiếu khám bệnh</h4>

      <div class="page-title-right d-none d-lg-block">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
          <li class="breadcrumb-item active"><a href="{{route('ds-phieukham.get')}}"> Danh sách phiếu khám bệnh</a></li>
          <li class="breadcrumb-item active">Sửa phiếu khám bệnh</li>
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

{{--<div class="row">--}}
{{--<div class="col-md-12">--}}
{{--<div class="form-group">--}}
{{--<a href="{{route('them-benhnhan.get')}}">--}}
{{--<button class="ladda-button btn btn-default waves-effect waves-light" data-style="expand-right">--}}
{{--<span class="btn-label"><i class="fa fa-plus"></i></span>Thêm bệnh nhân--}}
{{--</button>--}}
{{--</a>--}}

{{--<a href="{{route('them-loaibenh.get')}}">--}}
{{--<button class="ladda-button btn btn-default waves-effect waves-light" data-style="expand-right">--}}
{{--<span class="btn-label"><i class="fa fa-plus"></i></span>Thêm loại bệnh--}}
{{--</button>--}}
{{--</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

<form class="form-horizontal" role="form" action="{{route('sua-phieukham.post',[$PKB->MaPKB])}}" method="post">
  {{csrf_field()}}
  <div class="row">
    <div class="col-sm-12">
      <div class="card-box">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-4 font-size-16">
              Sửa phiếu khám bệnh
            </h4>
            <p class="text-muted m-b-10 font-13">
              <b>Bắt buộc</b>
              <span class="badge badge-pill badge-soft-primary font-size-11">Bệnh nhân</span>
              <span class="badge badge-pill badge-soft-primary font-size-11">Ngày khám</span>
              <span class="badge badge-pill badge-soft-primary font-size-11">Triệu chứng</span>
              <span class="badge badge-pill badge-soft-primary font-size-11">Chuẩnđoán loại bệnh</span>
            </p>
            <div class="row">
              <div class="col-md-6">
                <div class="p-l-r-10">

                  <div class="form-group">
                    <label class="control-label">Bệnh nhân</label>
                    <select disabled class="form-control" data-style="btn-default btn-custom" id="mabn" name="mabn" disabled>
                      <option value="">--- Chọn bệnh nhân ---</option>
                      @foreach($dsBenhNhan as $detail)
                      <option value="{{$detail->MaBN}}" @if (old('mabn',$PKB->MaBN) == $detail->MaBN) selected @endif>
                        {{$detail->HoTen}} &#160;-&#160; @if($detail->GioiTinh == 1)
                        Nữ @elseif($detail->GioiTinh == 2) Nam @else Khác @endif
                        &#160;-&#160; {{$detail->NamSinh}} &#160;-&#160; {{$detail->DiaChi}}
                      </option>
                      @endforeach
                    </select>
                  </div>


                  <div class="form-group">
                    <label class="control-label">Triệu chứng</label>
                    <input name="trieuchung" type="text" class="form-control" value="{{old('trieuchung',$PKB->TrieuChung)}}" placeholder="Nhập triệu chứng..." required>
                  </div>

                </div>
              </div>

              <div class="col-md-6">
                <div class="p-l-r-10">
                  <div class="form-group date">
                    <label>Ngày khám</label><br>
                    <input disabled class="input-small datepicker hasDatepicker" id="ngaykham" type="date" name="ngaykham" value="{{$PKB->NgayKham}}" readonly>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Chuẩn đoán loại bệnh</label>
                    <select class="form-control" data-style="btn-default btn-custom" id="loaibenh" name="loaibenh">
                      <option value="">--- Chọn loại bệnh ---</option>
                      @foreach($dsLoaiBenh as $detail)
                      <option value="{{ $detail->MaLoaiBenh }}" @if (old('loaibenh',$PKB->DuDoanLoaiBenh) == $detail->MaLoaiBenh) selected @endif>
                        {{ $detail->TenLoaiBenh }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4 font-size-16">
            Kê đơn thuốc
          </h4>
          <div class="p-10">
            <table id="datatable-responsive" class="table table-striped table-bordered m-0" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="text-center">STT</th>
                  <th class="text-center">Thuốc</th>
                  <th class="text-center">Số lượng còn lại</th>
                  <th class="text-center">Số lượng</th>
                  <th class="text-center">Đơn vị</th>
                  <th class="text-center">Cách dùng</th>
                </tr>
              </thead>
              <tbody style="text-align: center">
                <?php $i = 0; ?>
                @foreach($ctpkb as $detail)
                <tr>
                  <td class="text-center">{{++$i}}</td>
                  <td class="text-center tenthuoc">{{$detail->thuoc->TenThuoc}}</td>
                  <td class="text-center slconlai">
                    @if ($detail->thuoc->SoLuongConLai == 0)
                    <b style="color: red">{{$detail->thuoc->SoLuongConLai}}</b>
                    @else
                    <b style="color: green">{{$detail->thuoc->SoLuongConLai}}</b>
                    @endif
                  </td>
                  <td class="text-center">
                    <b class="soluongcu hidden">{{$detail->SoLuong}}</b>
                    <input name="{{$detail->thuoc->MaThuoc}}" type="number" class="form-control soluong" placeholder="Số lượng..." maxlength="4" value="{{old($detail->thuoc->MaThuoc,$detail->SoLuong)}}">
                  </td>
                  <td class="text-center">{{$detail->thuoc->donvi->TenDonVi}}</td>
                  <td class="text-center">{{$detail->thuoc->cachdung->CachDung}}</td>
                </tr>
                @endforeach
                @foreach($dsThuoc as $detail)
                <tr>
                  <td class="text-center">{{++$i}}</td>
                  <td class="text-center tenthuoc">{{$detail->TenThuoc}}</td>
                  <td class="text-center slconlai">
                    @if ($detail->SoLuongConLai == 0)
                    <b style="color: red">{{$detail->SoLuongConLai}}</b>
                    @else
                    <b style="color: green">{{$detail->SoLuongConLai}}</b>
                    @endif
                  </td>
                  <td class="text-center">
                    <input name="{{$detail->MaThuoc}}" type="number" class="form-control soluong" placeholder="Số lượng..." maxlength="4" value="{{old($detail->MaThuoc)}}">
                  </td>
                  <td class="text-center">{{$detail->donvi->TenDonVi}}</td>
                  <td class="text-center">{{$detail->cachdung->CachDung}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="p-l-r-10 p-t-10">
            <div class="form-group">
              <button class="btn btn-primary" data-style="expand-right">
                Lưu lại
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
@section('script-ori')
<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="assets/plugins/datatables/jszip.min.js"></script>
<script src="assets/plugins/datatables/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable-responsive').DataTable({
      "language": {
        "sInfo": "Dòng _START_ đến  _END_ trong tổng  _TOTAL_ dòng",
        "sLengthMenu": "Hiển thị _MENU_ dòng",
        "paginate": {
          "previous": "<",
          "next": ">"
        }
      },
      "drawCallback": function() {
        $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
      },
      "columnDefs": [{
        "className": "text-center",
        "targets": [0, 1, 2, 3, 4]
      }],
      //                        "paging":   false,
      "ordering": false,
      //                        "info":     false,
      "bFilter": true
    });
    $(".soluong").on('change', function() {
      var soLuongNhap = $(this).val();
      var soLuongConLai = parseInt($(this).parent().parent().find(".slconlai").text());
      var soLuongCu = parseInt($(this).parent().find(".soluongcu").text());
      var tenThuoc = "";
      if (isNaN(soLuongCu)) {
        if (soLuongNhap > soLuongConLai) {
          tenThuoc = $(this).parent().parent().find(".tenthuoc").text();
          alert("Thuốc " + tenThuoc + " không đủ dùng")
          // alert(soLuongConLai)
        }
      } else {
        if (soLuongNhap > (soLuongConLai + soLuongCu)) {
          tenThuoc = $(this).parent().parent().find(".tenthuoc").text();
          alert("Thuốc " + tenThuoc + " không đủ dùng")
          // alert(soLuongConLai)
        }
      }
    });
  });
</script>
@endsection
