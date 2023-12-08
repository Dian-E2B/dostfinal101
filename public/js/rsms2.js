jQuery(document).ready(function ($) {
    var startyearValue = $('#startyear').val();
    var endyearValue = $('#endyear').val();
    var semesterValue = $('#semester').val();
    var semesterValue2;



    if (semesterValue == 1) {
        semesterValue2 = semesterValue + 1;
    } else if (semesterValue == 2) {
        semesterValue2 = semesterValue - 1;
    } else {
        semesterValue2 = "SUMMER";
    }

    var table = $('#thisdatatable').DataTable({
        processing: true,
        serverSide: true,
        "debug": true,
        // pageLength: 20, // Set the default page length to 10 rows
        ajax: {
            url: "{{ route('getongoinglistgroupsajaxviewclicked', ['startyear' => ':startyear', 'endyear' => ':endyear', 'semester' => ':semester']) }}",
            type: 'GET',
        },
        columns: [{
            data: null,
            orderable: false,
            searchable: false,
            className: 'action-column',
            render: function (data, type, row) {
                var number = row
                    .NUMBER; // Assuming 'NUMBER' is the column name in your database

                return '<td >' +
                    '<a href="#" class="edit-btn" data-number="' + number +
                    '"><i class="fa fa-pencil"></i></a> <a href="#" class="view-btn" data-number="' + number +
                    '"><i class="fa fa-eye"></i></a>' + '</td>';
            }
        },
        {
            data: 'BATCH',

        },
        {
            data: 'NUMBER',

        },
        {
            data: 'NAME',

        },
        {
            data: 'MF',

        },
        {
            data: 'SCHOLARSHIPPROGRAM',

        },
        {
            data: 'SCHOOL',

        },
        {
            data: 'COURSE',

        },
        {
            data: 'GRADES',
            name: 'GRADES' + semesterValue2 + 'SEM' + startyearValue - 1 + endyearValue - 1
        },
        {
            data: 'SummerREG',

        },
        {
            data: 'REGFORMS',

        },
        {
            data: 'REMARKS',

        },
        {
            data: 'STATUSENDORSEMENT',

        },
        {
            data: 'STATUSENDORSEMENT2',

        },
        {
            data: 'STATUS',

        },
        {
            data: 'NOTATIONS',

        },
        {
            data: 'SUMMER',

        },
        {
            data: 'FARELEASEDTUITION',

        },
        {
            data: 'FARELEASEDTUITIONBOOKSTIPEND',

        },
        {
            data: 'LVDCAccount',

        },
        {
            data: 'HVCNotes',

        },
        {
            data: 'startyear',

        },
        {
            data: 'endyear',

        },
        {
            data: 'semester',

        }



        ],
        columnDefs: [{
            targets: 'action-column', // Use a class to target the specific column
            className: 'text-center',
        },
        {
            targets: [0, 2], // Index of the "No" column
            orderable: false,
            searchable: false,
        },
        {
            targets: [0, 3, 5, 19, 4],
            orderable: false,
        },

        ],

    });


});
