@extends('admin.master')

@section('pageTitle')
Add user | Online shop
@endsection

@section('headerScriptArea1')
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('/') }}admin-panel/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('/') }}admin-panel/plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('/') }}admin-panel/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('/') }}admin-panel/plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ asset('/') }}admin-panel/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('/') }}admin-panel/plugins/select2/select2.min.css">
@endsection


@section('headerScriptArea2')
    <!--Custom CSS for image preview -->
    <link href="{{ asset('/') }}admin-panel/image-preview/image-preview.css" rel="stylesheet" type="text/css">

@endsection

@section('body')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Add new user</h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
          <div class="box-header">
              @if(Session::has('message'))
                      <h3>{!! Session::get('message') !!}</h3>
              @endif
          </div>

          <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
              @csrf
            <div class="box-body">

                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter name...">
                </div>

                <div class="form-group">
                  <label>Phone number</label>
                  <input type="tel" name="phone" class="form-control" placeholder="Enter phone number...">
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter email address...">
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                  <label>Address</label>
                  <textarea class="form-control" rows="3" name="address" placeholder="Enter address ..."></textarea>
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">User image</label>
                  <input type="file" name="photo" class="form-control" id="imageInputFile">
                   <div class="image-preview" id="imagePreview">
                      <img src="" alt="" class="image-preview__image">
                      <span class="image-preview__default-text">Image preview</span>
                  </div>                 
                </div>

                <div class="form-group">
                    <label>User role</label>
                    <select class="form-control select2" name="role" style="width: 100%;">
                      <option value="1" >Super admin</option>
                      <option value="2" >Admin</option>
                      <option value="3" selected="selected">Vendor</option>
                    </select>
                </div>


                <div class="form-group">
                  <label class="radio-inline">
                      <input type="radio" name="status" id="optionsRadiosInline1" value="1" checked><strong>Active</strong> 
                  </label>
                  <label class="radio-inline">
                      <input type="radio" name="status" id="optionsRadiosInline2" value="0"><strong>Inactive</strong>
                  </label>
              </div>


            </div><!-- /.box-body -->

              <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              
         </form>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('footerScriptArea')
<!-- Select2 -->
<script src="{{ asset('/') }}admin-panel/plugins/select2/select2.full.min.js"></script>

<!-- InputMask -->
<script src="{{ asset('/') }}admin-panel/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ asset('/') }}admin-panel/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ asset('/') }}admin-panel/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('/') }}admin-panel/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('/') }}admin-panel/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('/') }}admin-panel/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('/') }}admin-panel/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('/') }}admin-panel/plugins/iCheck/icheck.min.js"></script>

<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

<!-- Image preview -->
<script src="{{ asset('/') }}admin-panel/image-preview/image-preview.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    CKEDITOR.replace('editor1');
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>

@endsection