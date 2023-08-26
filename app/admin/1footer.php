<!-- Bootstrap core JavaScript-->
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- lightbox -->
<script src="../../js/lightbox.js"></script>
<!-- Custom scripts for all pages-->
<script src="../../js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="../../vendor/chart.js/Chart.min.js"></script>
<!-- Page level plugins -->
<script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="../../js/demo/datatables-demo.js"></script>
<script>
    $(document).ready(function() {
        // untuk view data
        $('#dataTable').on('click', '.view_data', function() {
            var id_booking = $(this).attr('id');
            console.log(id_booking);
            $.ajax({
                url: "ajax/select_data_booking.php",
                method: "post",
                data: {
                    id_booking: id_booking
                },
                success: function(data) {
                    $('#detail_kamar').html(data);
                    $('#viewModal').modal();
                }
            });
        });
        // edit data
        $('#dataTable').on('click', '.edit_data', function() {
            var $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            var id_booking = data[1];
            console.log(id_booking);
            $.ajax({
                url: "ajax/edit_data_booking.php",
                method: "post",
                data: {
                    id_booking: id_booking
                },
                success: function(data) {
                    $('#detail_edit').html(data);
                    $('#updateModal').modal();
                }
            });
        });
    });
</script>
</body>

</html>