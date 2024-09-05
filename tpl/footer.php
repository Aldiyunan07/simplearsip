</body>
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script> <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script> <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script> <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->

<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/adminlte.min.js"></script>
<!-- <script type="text/javascript" src="../assets/DataTables/data/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="../assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
<script type="text/javascript" src="../assets/js/adminlte.js"></script>
<!-- <script type="text/javascript" src="../assets/DataTables/data/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/DataTables/data/js/dataTables.jqueryui.min.js"></script> -->
<script type="text/javascript">
  $(document).ready(function() {
    $("#tanggal").datepicker({
      dateFormat: 'yy-mm-dd',
    });
  });

  $(document).ready(function() {
    $("#tanggal1").datepicker({
      dateFormat: 'yy-mm-dd',
    });
  });

  $(document).ready(function() {
    $("#tanggal3").datepicker({
      dateFormat: 'yy-mm-dd',
    });
  });

  $(document).ready(function() {
    $("#tanggal4").datepicker({
      dateFormat: 'yy-mm-dd',
    });
  });

  $(document).ready(function() {
    $("#pegawai").DataTable();
  });

  $(function() {
    $("#sad").DataTable();
  });
</script>

</html>