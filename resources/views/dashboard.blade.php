<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Manage</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <link rel="stylesheet" href="{{ asset('assets/vendors/dropify/dist/dropify.min.css') }}">


    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css') }}">
    <!-- End layout styles -->


    <style>
        #dropdownMenuButton7:hover {
            cursor: pointer;
        }

        td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    @include('layout.sidebar')
    <div class="page-wrapper">
        @include('layout.navbar')
        @yield('content')
        @include('layout.footer')
        @include('modal.insert_modal')
    </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script>


    <!-- inject:js -->
    <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard-dark.js') }}"></script>
    <!-- End custom js for this page -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var table = document.getElementById('tbl');
            var rows = table.querySelectorAll('tbody tr');

            // Thêm sự kiện click cho mỗi hàng
            rows.forEach(function(row) {
                row.addEventListener('click', function(event) {
                    var targetCell = event.target.closest('td');
                    var isLastCell = targetCell && targetCell.cellIndex === targetCell.parentNode
                        .cells.length - 1;
                    var isSecondLastCell = targetCell && targetCell.cellIndex === targetCell
                        .parentNode.cells.length - 2;

                    // Kiểm tra xem sự kiện click có xuất phát từ cột cuối cùng hoặc cột gần cuối không
                    if (!isLastCell && !isSecondLastCell) {
                        // Reset màu cho tất cả các hàng
                        rows.forEach(function(r) {
                            r.classList.remove('table-active');
                        });

                        // Đặt màu cho hàng được click
                        row.classList.add('table-active');

                        var jobId = row.id;

                        // Chỉ hiển thị modal nếu không click vào ô cuối cùng hoặc ô gần cuối
                        showJobModal(jobId);
                    }
                });
            });

            // Thêm sự kiện click cho toàn bộ document
            document.addEventListener('click', function(event) {
                // Kiểm tra xem sự kiện click có xuất phát từ bảng hay không
                if (!event.target.closest('#tbl')) {
                    // Reset màu cho tất cả các hàng
                    rows.forEach(function(r) {
                        r.classList.remove('table-active');
                    });
                }
            });
        });

        // Hàm hiển thị modal
        function showJobModal(jobId) {
            // Gọi Ajax để lấy thông tin chi tiết của công việc với ID jobId
            // Hiển thị thông tin trong modal
            // Mở modal
            $.ajax({
                url: '/chi-tiet/' + jobId, // Đường dẫn mới đã định nghĩa
                type: 'GET',
                success: function(data) {
                    $('#modalContent').html(data);
                    $('#myModal').modal('show');
                },
                error: function() {
                    alert('Đã xảy ra lỗi khi lấy thông tin chi tiết công việc.');
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            // Thêm sự kiện click cho button
            $('.btn-add-task').on('click', function() {
                // Hiển thị modal khi button được click
                $('#addTaskModal').modal('show');
            });

            // Xử lý sự kiện submit form thêm công việc
            $('#addTaskForm').on('submit', function(e) {
                e.preventDefault();
                // Thực hiện xử lý khi submit form, ví dụ: gửi dữ liệu thông qua AJAX
                // Sau khi thêm công việc thành công, có thể đóng modal
                $('#addTaskModal').modal('hide');
            });
        });
    </script>

    {{-- CLICK VÀO NÚT SỬA --}}
    <script>
        $(document).ready(function() {
            $('.dropdown-item:contains("Sửa")').on('click', function() {
                // Lấy giá trị data-job-id từ thẻ <a>
                var jobId = $(this).data('job-id');
                $.ajax({
                    url: '/sua/' + jobId,
                    type: 'GET',
                    success: function(data) {
                        $('#modalContent').html(data);
                        $('#myModal').modal('show');
                    },
                    error: function() {
                        alert('Đã xảy ra lỗi khi lấy thông tin chi tiết công việc.');
                    }
                });
            });
        });
    </script>
    <script>
        // Lấy tất cả các phần tử có class là 'report-btn'
        var reportButtons = document.querySelectorAll('.report-btn');
        // Lặp qua mỗi nút và thêm sự kiện click
        reportButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Lấy giá trị data-job-id
                var jobId = this.getAttribute('data-job-id');

                $.ajax({
                    url: '/bao-cao/' + jobId, // Đường dẫn mới đã định nghĩa
                    type: 'GET',
                    success: function(data) {
                        $('#modalContent').html(data);
                        $('#myModal').modal('show');
                    },
                    error: function() {
                        alert('Đã xảy ra lỗi khi lấy thông tin chi tiết công việc.');
                    }
                });
            });
        });
    </script>

    {{-- LỌC TÌNH TRẠNG --}}
    <script>
        $(document).ready(function() {
            // Bắt sự kiện khi giá trị của select box thay đổi
            $("#statusFilter").change(function() {
                // Lấy giá trị đã chọn
                var value = $(this).val();
                window.location.href = '/loc/' + value;
            });
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modalContent">
                <!-- Nội dung modal sẽ được cập nhật từ Ajax response -->
            </div>
        </div>
    </div>
</body>

</html>
