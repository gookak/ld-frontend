@extends('layouts/main')

@section('tagfooter')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxuTicq9cG0Nah4_FlKp370QMKsCbduPE&callback=myMap"></script>
@endsection

@section('content')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>ติดต่อเรา</h2>
                </div>
            </div>
        </div>
    </div>
</div>
</br>
<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="sub-menu-title">แผนที่</div></br>
                <div id="googleMap" style="width:100%;height:400px;"></div></br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="sub-menu-title">ข้อมูลติดต่อ</div></br>
                <p><h4><strong>ร้านL&D.COM</strong></h4></p>
                <p>ที่ตั้ง บิ๊กซีบางพลี ชั้น 2 เลขที่ 89 หมู่ 9 ถนนเทพารักษ์ กม.13 ถนนเทพารักษ์ ต.บางพลีใหญ่ อ.บางพลี จ.สมุทรปราการ 10540</p>
                <p><strong>หมายเลขโทรศัพท์</strong> 087-799-9212</p>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')
<script type="text/javascript">
    $(document).ready(function(){

        function myMap() {
          var myCenter = new google.maps.LatLng(13.60394,100.70770);
          var mapCanvas = document.getElementById("googleMap");
          var mapOptions = {center: myCenter, zoom: 16};
          var map = new google.maps.Map(mapCanvas, mapOptions);
          var marker = new google.maps.Marker({position:myCenter});
          marker.setMap(map);
      }
      myMap();
  });
</script>
@endsection