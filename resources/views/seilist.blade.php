<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        td {
            user-select: none;
        }

        #thisdatatable.dataTable tbody td {
            white-space: nowrap;
        }
    </style>
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">

        {{-- SIDEBAR START --}}
        @include('layouts.sidebar')



        <div class="main">
            @include('layouts.header')

            @error('excel_file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <main class="content" style="padding:0.5rem 0.5rem 0.5rem; !important;">
                <div class="container-fluid p-0">


                            <div class="card" style="white-space:nowrap; !important;">
                                <div class="card-body">
                                    <table id="thisdatatable" class="table-sm table-striped"
                                        style="width:100%; white-space:nowrap; !important;">

                                        <thead>
                                            <tr>
                                                <th>SPAS NO.</th>
                                                <th>Strand</th>
                                                <th>Program</th>
                                                <th>Firstname</th>
                                                <th>Surname</th>
                                                <th>Email</th>
                                                <th>Municipality</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody style="white-space: nowrap !important;">
                                            @foreach ($seis as $sei)
                                                <tr>

                                                    <td style="color: black;">
                                                        {{ $sei->spasno }}</td>
                                                    <td style="color: black">{{ $sei->strand }}</td>
                                                    <td style="color: black">{{ $sei->program->progname }}</td>
                                                    @foreach ($sei->scholars as $scholar)
                                                        <td style="color: black">{{ $scholar->fname }}</td>
                                                        <td style="color: black">{{ $scholar->lname }}</td>
                                                        <td style="color: black">{{ $scholar->email }}</td>
                                                    @endforeach
                                                    <td style="color: black"> {{ $sei->municipality }}</td>
                                                   

                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <div style="color: dimgrey">
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    
                                                </div>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                </div>
                <button style="display: none" id="getEmailsButton">Get Selected Emails</button>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <script>
        // $('#datatables-column-search-select-inputs').dataTable({
        //     "scrollX": true
        // });
        document.addEventListener("DOMContentLoaded", function() {
            var datatablesMulti = $("#thisdatatable").DataTable({
                responsive: true,

                initComplete: function() {
                    this.api().columns([1, 6]).every(function() {
                        var column = this;
                        var select = $(
                                "<select class=\"form-control\"><option value=\"\"></option></select>"
                            )
                            .appendTo($(column.footer()).empty())
                            .on("change", function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(val ? "^" + val + "$" : "", true, false)
                                    .draw();
                            });
                        column.data().unique().sort().each(function(d, j) {
                            select.append("<option value=\"" + d + "\">" + d +
                                "</option>")
                        });
                    });
                }
            });

            // function getSelectedEmails() {
            //     var selectedRows = datatablesMulti.rows({
            //         selected: true
            //     });
            //     var selectedEmails = [];
            //
            //     selectedRows.every(function() {
            //         var data = this.data();
            //         var email = data[5]; // Assuming the email is in the second column (index 1)
            //         selectedEmails.push(email);
            //     });
            //
            //     return selectedEmails;
            // }
            //
            // $(document).on("keydown", function(e) {
            //     // Check if the "Escape" key (key code 27) is pressed
            //     if (e.key === "Escape" || e.key === "Esc" || e.keyCode === 27) {
            //         // Deselect all selected rows in the DataTable
            //         datatablesMulti.rows({
            //             selected: true
            //         }).deselect();
            //     }
            // });
            //
            //
            //
            // // Example: Call the function and log the selected emails
            // $("#getEmailsButton").on("click", function() {
            //     // Call the function to retrieve selected email values
            //     var selectedEmails = getSelectedEmails();
            //     // console.log(selectedEmails);
            //
            //     // Do something with the selected email values (e.g., display them)
            //     // alert("Selected Emails:\n" + selectedEmails.join("\n"));
            // });



        })
    </script>
    <script></script>
</body>

</html>
