<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <?=css('theme/adminator/colorlib.com/polygon/adminator/style.css')?>
    <?=css('css/fontawesome/web-fonts-with-css/css/fontawesome-all.css')?>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <link href="https://silviomoreto.github.io/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://demo.harviacode.com/select2/select2.min.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <?=css('theme/air-datepicker/datepicker.min.css')?>
    <?=js('theme/air-datepicker/datepicker.min.js')?>
    <style media="screen">
      * {
        font-size: 14px !important;
      }
      input, textarea {
        border: solid 1px #eaeaea !important;
        box-shadow: none !important;
        -webkit-appearance:none;
      }
      .form-control:focus, input:focus, input:hover {
        border: solid 1px #bdbdbd !important;
        box-shadow: 0px 0px #bdbdbd !important;
        transition: all 0.8s ease-out;
      }
      table, tr, td, th {
        border: solid 1px #eaeaea !important;
        box-shadow: none !important;
        border-collapse:collapse !important;
      }
      tbody tr:hover {
        background: #f0f0f0 !important;
      }
      .btn-group {
        border: solid 1px #ccc;
      }
      input.select2-search__field {
        border: none !important;
      }
    </style>
  </head>
  <body>
    <input type='text' class='datepicker-here' data-language='en' />

    <script type="text/javascript">
    ;(function ($) { $.fn.datepicker.language['en'] = {
      days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
      daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
      months: ['January','February','March','April','May','June', 'July','August','September','October','November','December'],
      monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      today: 'Today',
      clear: 'Clear',
      dateFormat: 'mm/dd/yyyy',
      timeFormat: 'hh:ii aa',
      firstDay: 0
    }; })(jQuery);
    </script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="https://silviomoreto.github.io/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="http://demo.harviacode.com/select2/select2.min.js"></script>
    <?=js('theme/adminator/colorlib.com/polygon/adminator/vendor.js')?>
    <?=js('theme/adminator/colorlib.com/polygon/adminator/bundle.js')?>
  </body>
</html>
font-size: .875rem; */
