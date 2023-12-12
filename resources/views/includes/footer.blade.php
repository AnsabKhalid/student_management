</div>
<!-- /.content-wrapper -->
@if(in_array(Route::currentRouteName(), $routeNames = ['publicStudent', 'publicTeacher', 'share', 'shareSingle', 'shareTeacher','reviewFormStudent','reviewFormTeacher','storeReview']))
@else
<footer class="main-footer">
<strong>Copyright &copy; 2023 ACE EDUCATION</strong>
Design & Developed By <a href="https://5star.my"> Mr. Shahbid Hussain </a>
<div class="float-right d-none d-sm-inline-block">
</div>
</footer>
@endif

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger" id="deleteStudentButton">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
{{--<script src="{{asset('public/plugins/jquery/jquery.min.js')}}"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('public/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('public/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('public/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>

<script src="{{asset('public/plugins/moment/moment.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('public/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('public/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function () {
        $("#students").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,"searching": true,
            "buttons" : [] ,"ordering": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-12');
        $("#teachers").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,"searching": true,"ordering": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-12');
        $("#history").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons": [],"searching": true,"ordering": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-12');
        $("#history1").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons": [],"searching": true,"ordering": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-12');
        $("#history2").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons": [],"searching": false,"ordering": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-12');
        $("#SnB").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,"searching": true,
            "buttons" : [] ,"ordering": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-12');
        $("#monthly").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,"searching": false,
            "buttons" : [] ,"ordering": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-12');
        $(".monthly").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,"searching": true,
            "buttons" : [] ,"ordering": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-12');
         $(".history").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": true,"searching": true,
            "buttons": [],"ordering": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-12');
    });
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2({
            tags: false,
            scrollAfterSelect: true,
            insertTag: function (data, tag) {
                // Insert the tag at the end of the results
                data.push(tag);
            }
            // tokenSeparators: [',', ' ']
        })
        $(".availability").select2({
            tags: true,
            scrollAfterSelect: true,
            insertTag: function (data, tag) {
                // Insert the tag at the end of the results
                data.push(tag);
            }
            // tokenSeparators: [',', ' ']
        })
        $(".selectSubjects").select2({
            tags: true,
            scrollAfterSelect: true,
            insertTag: function (data, tag) {
                // Insert the tag at the end of the results
                data.push(tag);
            }
            // tokenSeparators: [',', ' ']
        })


        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#dob').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
        $('#startDate').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });

        // $('#phoneNumber').inputmask('___________', { 'placeholder': '___________' });
    });
</script>
<script src="{{asset('public/plugins/ccJquery/js/intlTelInput.js')}}"></script>
<script src="{{asset('public/plugins/ccJquery/js/utils.js')}}"></script>
<script>
    var input = document.querySelector("#phoneNumber");
    window.intlTelInput(input, {
        // separateDialCode : true,
        nationalMode: false,
        autoPlaceholder : 'aggressive',
        hiddenInput: "full"
    });
</script>
<script>
    $('#confirmDeleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var Id = button.data('id');
        var url = button.data('url');
        var deleteUrl = url + '/' + Id;
        console.log(deleteUrl);
        var modal = $(this);
        modal.find('#deleteStudentButton').attr('href', deleteUrl);
    });
</script>
<script>
    $(document).ready(function() {
        const form = document.getElementById('myForm');
        const input = document.getElementById('classDateInput');

        form.addEventListener('submit', (event) => {
            if (!input.value) {
                event.preventDefault();
                alert('Please fill in the date field!');
            }
        });
    });
    $(document).ready(function() {
        const form = document.getElementById('myForm2');
        const input = document.getElementById('classDateInput2');

        form.addEventListener('submit', (event) => {
            if (!input.value) {
                event.preventDefault();
                alert('Please fill in the date field!');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        if ($('#recurring').is(':checked'))
        {
            $('#recurring').prop('checked', false);
        }
        $('#recurring').on('change', function() {
            if ($(this).is(':checked')) {
                $('.recurringForm').removeClass('d-none');
            } else {
                $('.recurringForm').addClass('d-none');
            }
        });
    });
    $(document).ready(function() {
        $('#recurrence').on('change', function() {
            if ($(this).val() === 'Weekly') {
                $('#weekly').removeClass('d-none').addClass('d-flex');
            } else {
                $('#weekly').removeClass('d-flex').addClass('d-none');
            }
        });
    });
</script>
<!-- jQuery Knob -->
<script src="{{asset('public/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('public/plugins/chart.js/Chart.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('canvas').each(function(index, element) {
            var chartData = $(element).data('chart-data');
            new Chart(element, {
                type: 'pie',
                data: chartData,
                options: {
                    maintainAspectRatio : false,
                    responsive : true,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Total Amount Stats Monthly'
                            }
                        }
                    },
                }
            });
        });
    });
</script>

<script>
    $(function () {
        /* jQueryKnob */

        $('.knob').knob({
            draw: function () {
                // "tron" case
                if (this.$.data('skin') == 'tron') {

                    var a = this.angle(this.cv)  // Angle
                        ,
                        sa = this.startAngle          // Previous start angle
                        ,
                        sat = this.startAngle         // Start angle
                        ,
                        ea                            // Previous end angle
                        ,
                        eat = sat + a                 // End angle
                        ,
                        r = true

                    this.g.lineWidth = this.lineWidth

                    this.o.cursor
                    && (sat = eat - 0.3)
                    && (eat = eat + 0.3)

                    if (this.o.displayPrevious) {
                        ea = this.startAngle + this.angle(this.value)
                        this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3)
                        this.g.beginPath()
                        this.g.strokeStyle = this.previousColor
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                        this.g.stroke()
                    }

                    this.g.beginPath()
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
                    this.g.stroke()

                    this.g.lineWidth = 2
                    this.g.beginPath()
                    this.g.strokeStyle = this.o.fgColor
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
                    this.g.stroke()

                    return false
                }
            }
        });
    });




    /* END JQUERY KNOB */
</script>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            console.log('Copying to clipboard was successful!');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }
    function studentLinkCopy() {
        /* Get the text field */
        var inputField = document.getElementById("studentLink");

        /* Select the text field */
        inputField.select();

        /* Copy the text inside the text field to the clipboard */
        document.execCommand("copy");

        /* Show an alert */
        alert("Copied to clipboard: " + inputField.value);
    }
    function teacherLinkCopy() {
        /* Get the text field */
        var inputField = document.getElementById("teacherLink");

        /* Select the text field */
        inputField.select();

        /* Copy the text inside the text field to the clipboard */
        document.execCommand("copy");

        /* Show an alert */
        alert("Copied to clipboard: " + inputField.value);
    }
</script>


<script>
    $(document).ready(function() {
        // Add more button click event
        $('#add-more').click(function(e) {
            e.preventDefault();
            var formRow = $('.form-row').first().clone(); // Clone the first form row
            formRow.find(':input').val(''); // Reset all input fields
            formRow.find('select').prop('selectedIndex', 0); // Reset all select fields
            formRow.appendTo('#form-container'); // Append the new form row to the form container

            // Add remove button to the new form row
            var removeButton = $('<button class="remove-row btn btn-danger my-3">Remove</button>');
            removeButton.click(function(e) {
                e.preventDefault();
                $(this).parent().remove(); // Remove the current form row
            });
            formRow.append(removeButton);
        });

        // Remove button click event
        $(document).on('click', '.remove-row', function(e) {
            e.preventDefault();
            $(this).parent().remove(); // Remove the current form row
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Add more button click event
        $('#addMorePkg').click(function(e) {
            e.preventDefault();
            var formRow = $('.form-row').first().clone(); // Clone the first form row
            formRow.find(':input').val(''); // Reset all input fields
            formRow.find('select').prop('selectedIndex', 0); // Reset all select fields
            formRow.appendTo('#form-container'); // Append the new form row to the form container

            // Add remove button to the new form row
            var removeButton = $('<button class="remove-row btn btn-danger my-3">Remove</button>');
            removeButton.click(function(e) {
                e.preventDefault();
                $(this).parent().remove(); // Remove the current form row
            });
            formRow.append(removeButton);
        });

        // Remove button click event
        $(document).on('click', '.remove-row', function(e) {
            e.preventDefault();
            $(this).parent().remove(); // Remove the current form row
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script>
    $(document).ready(function () {
        var form = $('.print'),
            cache_width = form.width(),
             a4 = [595.28, 841.89]; // for a4 size paper width and height

        $('#create_pdf').on('click', function () {
            $('body').scrollTop(0);
            createPDF();
        });

        function createPDF() {
            getCanvas().then(function (canvas) {
                var img = canvas.toDataURL("image/png");
                var pdf = new jsPDF({
                    unit: 'mm',
                    format: 'a4',
                });
                var pdfWidth = pdf.internal.pageSize.width;
                var pdfHeight = pdf.internal.pageSize.height;
                var imgWidth = canvas.width;
                var imgHeight = canvas.height;

                // Calculate the ratio of the PDF page size to the image size
                var ratio = Math.min(pdfWidth / imgWidth, pdfHeight / imgHeight);

                // Calculate the new dimensions for the image based on the ratio
                var newImgWidth = imgWidth * ratio;
                var newImgHeight = imgHeight * ratio;

                // Add the image to the PDF with the new dimensions and position it in the center
                pdf.addImage(img, 'PNG', (pdfWidth - newImgWidth) / 2, (pdfHeight - newImgHeight) / 2, newImgWidth, newImgHeight);

                // Save the PDF
                pdf.save('html-to-pdf.pdf');

                // Reset the form width
                form.width(cache_width);
            });
        }

        function getCanvas() {
            form.width('auto').css('max-width', 'none');
            return html2canvas(form, {
                dpi: 1000, // increase DPI to 300
                imageTimeout: 2000,
                removeContainer: true,
                width: form.outerWidth(),
                height: form.outerHeight(),
            });
        }
    });
    $(document).ready(function () {
        var form = $('.tsd'),
            cache_width = form.width(),
            a4 = [595.28, 841.89]; // for a4 size paper width and height

        $('#createPdftsd').on('click', function () {
            $('body').scrollTop(0);
            createPDF();
        });

        function createPDF() {
            getCanvas().then(function (canvas) {
                var img = canvas.toDataURL("image/png");
                var pdf = new jsPDF({
                    unit: 'mm',
                    format: 'a4',
                });
                var pdfWidth = pdf.internal.pageSize.width;
                var pdfHeight = pdf.internal.pageSize.height;
                var imgWidth = canvas.width;
                var imgHeight = canvas.height;

                // Calculate the ratio of the PDF page size to the image size
                var ratio = Math.min(pdfWidth / imgWidth, pdfHeight / imgHeight);

                // Calculate the new dimensions for the image based on the ratio
                var newImgWidth = imgWidth * ratio;
                var newImgHeight = imgHeight * ratio;

                // Add the image to the PDF with the new dimensions and position it in the center
                pdf.addImage(img, 'PNG', (pdfWidth - newImgWidth) / 2, (pdfHeight - newImgHeight) / 2, newImgWidth, newImgHeight);

                // Save the PDF
                pdf.save('html-to-pdf.pdf');

                // Reset the form width
                form.width(cache_width);
            });
        }

        function getCanvas() {
            form.width('auto').css('max-width', 'none');
            return html2canvas(form, {
                dpi: 1000, // increase DPI to 300
                imageTimeout: 2000,
                removeContainer: true,
                width: form.outerWidth(),
                height: form.outerHeight(),
            });
        }
    });
    $(document).ready(function () {
        var form = $('.printReporttmr'),
            cache_width = form.width(),
            a4 = [595.28, 841.89]; // for a4 size paper width and height

        $('#createPdftmr').on('click', function () {
            $('body').scrollTop(0);
            createPDF();
        });

        function createPDF() {
            getCanvas().then(function (canvas) {
                var img = canvas.toDataURL("image/png");
                var pdf = new jsPDF({
                    unit: 'mm',
                    format: 'a4',
                });
                var pdfWidth = pdf.internal.pageSize.width;
                var pdfHeight = pdf.internal.pageSize.height;
                var imgWidth = canvas.width;
                var imgHeight = canvas.height;

                // Calculate the ratio of the PDF page size to the image size
                var ratio = Math.min(pdfWidth / imgWidth, pdfHeight / imgHeight);

                // Calculate the new dimensions for the image based on the ratio
                var newImgWidth = imgWidth * ratio;
                var newImgHeight = imgHeight * ratio;

                // Add the image to the PDF with the new dimensions and position it in the center
                pdf.addImage(img, 'PNG', (pdfWidth - newImgWidth) / 2, (pdfHeight - newImgHeight) / 2, newImgWidth, newImgHeight);

                // Save the PDF
                pdf.save('html-to-pdf.pdf');

                // Reset the form width
                form.width(cache_width);
            });
        }

        function getCanvas() {
            form.width('auto').css('max-width', 'none');
            return html2canvas(form, {
                dpi: 1000, // increase DPI to 300
                imageTimeout: 2000,
                removeContainer: true,
                width: form.outerWidth(),
                height: form.outerHeight(),
            });
        }
    });
    $(document).ready(function () {
        var form = $('.ssd'),
            cache_width = form.width(),
            a4 = [595.28, 841.89]; // for a4 size paper width and height

        $('#createPdfssd').on('click', function () {
            $('body').scrollTop(0);
            createPDF();
        });

        function createPDF() {
            getCanvas().then(function (canvas) {
                var img = canvas.toDataURL("image/png");
                var pdf = new jsPDF({
                    unit: 'mm',
                    format: 'a4',
                });
                var pdfWidth = pdf.internal.pageSize.width;
                var pdfHeight = pdf.internal.pageSize.height;
                var imgWidth = canvas.width;
                var imgHeight = canvas.height;

                // Calculate the ratio of the PDF page size to the image size
                var ratio = Math.min(pdfWidth / imgWidth, pdfHeight / imgHeight);

                // Calculate the new dimensions for the image based on the ratio
                var newImgWidth = imgWidth * ratio;
                var newImgHeight = imgHeight * ratio;

                // Add the image to the PDF with the new dimensions and position it in the center
                pdf.addImage(img, 'PNG', (pdfWidth - newImgWidth) / 2, (pdfHeight - newImgHeight) / 2, newImgWidth, newImgHeight);

                // Save the PDF
                pdf.save('html-to-pdf.pdf');

                // Reset the form width
                form.width(cache_width);
            });
        }

        function getCanvas() {
            form.width('auto').css('max-width', 'none');
            return html2canvas(form, {
                dpi: 1000, // increase DPI to 300
                imageTimeout: 2000,
                removeContainer: true,
                width: form.outerWidth(),
                height: form.outerHeight(),
            });
        }
    });
    $(document).ready(function () {
        var form = $('.printReportsmr'),
            cache_width = form.width(),
            a4 = [595.28, 841.89]; // for a4 size paper width and height

        $('#createPdfsmr').on('click', function () {
            $('body').scrollTop(0);
            createPDF();
        });

        function createPDF() {
            getCanvas().then(function (canvas) {
                var img = canvas.toDataURL("image/png");
                var pdf = new jsPDF({
                    unit: 'mm',
                    format: 'a4',
                });
                var pdfWidth = pdf.internal.pageSize.width;
                var pdfHeight = pdf.internal.pageSize.height;
                var imgWidth = canvas.width;
                var imgHeight = canvas.height;

                // Calculate the ratio of the PDF page size to the image size
                var ratio = Math.min(pdfWidth / imgWidth, pdfHeight / imgHeight);

                // Calculate the new dimensions for the image based on the ratio
                var newImgWidth = imgWidth * ratio;
                var newImgHeight = imgHeight * ratio;

                // Add the image to the PDF with the new dimensions and position it in the center
                pdf.addImage(img, 'PNG', (pdfWidth - newImgWidth) / 2, (pdfHeight - newImgHeight) / 2, newImgWidth, newImgHeight);

                // Save the PDF
                pdf.save('html-to-pdf.pdf');

                // Reset the form width
                form.width(cache_width);
            });
        }

        function getCanvas() {
            form.width('auto').css('max-width', 'none');
            return html2canvas(form, {
                dpi: 1000, // increase DPI to 300
                imageTimeout: 2000,
                removeContainer: true,
                width: form.outerWidth(),
                height: form.outerHeight(),
            });
        }
    });
</script>

<!-- AdminLTE App -->
<script src="{{asset('public/js/adminlte.js')}}"></script>

</body>
</html>

