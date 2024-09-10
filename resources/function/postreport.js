$(document).ready(function () {
    let tableId = 'dynamic-postreport-table';
    let postreportId;

    let headers = ['Type', 'Address', 'Photo', 'Description', 'Status', 'Action'];
    headers.forEach(header => {
        $(`#${tableId}-headers`).append(`<th class="px-5">${header}</th>`);
    });

    // Initialize DataTable
    var postreportDataTable = $(`#${tableId}`).DataTable({
        ajax: {
            url: '/postreport/create',
            dataSrc: 'data'
        },
        columns: [
            {
                data: 'type',
                class: 'px-5'
            },
            {
                data: 'address',
                class: 'px-5',
                render: function (data, type, row) {
                    return data == null ? '--' : data
                }
            },
            {
                data: 'photo',
                render: function (data, type, row) {
                    if (data) {
                        return `
                            <div class="d-flex align-items-center">
                                <img src="${data}" alt="Report Photo" class="avatar avatar-lg">
                            </div>
                                `;
                    } else {
                        return `
                        <picture>
                            <source srcset="assets/back/images/brand/logo/noimage.jpg" type="image/webp">
                            <img src="assets/back/images/brand/logo/noimage.jpg" style="width:100px;">
                        </picture>
                        `;
                    }
                }
            },
            {
                data: 'description',
                class: 'px-5',
            },
            {
                data: 'status',
                class: 'px-5',
            },
            {
                data: 'actions',
                class: 'px-5',
                render: function (data) {
                    return data;
                }
            }
        ],
        autoWidth: false,
        responsive: {
            breakpoints: [
                { name: 'desktop', width: Infinity },
                { name: 'tablet', width: 1024 },
                { name: 'phone', width: 768 }
            ]
        },
        paging: true,
        searching: true,
        ordering: false,
        info: true,
        pageLength: 10,
        dom: '<lf<t>ip>',
        language: {
            search: 'Filter',
            paginate: {
                first: '<i class="bi bi-chevron-double-left"></i>',
                previous: '<i class="bi bi-chevron-left"></i>',
                next: '<i class="bi bi-chevron-right"></i>',
                last: '<i class="bi bi-chevron-double-right"></i>'
            }
        },
        fixedHeader: {
            header: true,
        },
        scrollCollapse: true,
        scrollX: true,
        scrollY: 600,
    });

    $(document).on('click', '#add-btn', function () {
        $('#postreportModal').modal('show');
        $('#postreport-form').attr('action', '/postreport');
        $('#postreport-form').attr('method', 'POST');
        $('#postreport-form')[0].reset();

        showPostReportModal($(this).data('modaltitle'));
    });

    // // Handle editing an existing animal type
    $(document).on('click', '.edit-btn', function () {
        postreportId = $(this).data('id');
        $('#type').val($(this).data('type'))
        $('#address').val($(this).data('address'))

        if ($(this).data('type') == 'Garbage') {
            $('#garbage_container').removeClass('d-none').show();
            $('#recycled_container').addClass('d-none').hide();
            tinymce.get('description').setContent($(this).data('description'));
        } else {
            $('#recycled_container').removeClass('d-none').show();
            $('#garbage_container').addClass('d-none').hide();
            tinymce.get('re_description').setContent($(this).data('description'));
        }

        $('#postreportModal').modal('show');
        $('#postreport-form').attr('action', `/postreport/${postreportId}`);
        $('#postreport-form').attr('method', 'POST');
        $('#postreport-form').find('input[name="_method"]').remove();
        $('#postreport-form').append('<input type="hidden" name="_method" value="PUT">');

        showPostReportModal($(this).data('modaltitle'));
    });

    $(document).on('click', '.delete-btn', function () {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#000',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            allowOutsideClick: false,
            allowEscapeKey: false,
        }).then((result) => {
            if (result.isConfirmed) {
                removePostReport(id)
            }
        })

    });


    function toggleContainers() {
        var selectedType = $('#type').val();
        if (selectedType === 'Garbage') {
            $('#garbage_container').removeClass('d-none').show();
            $('#recycled_container').addClass('d-none').hide();
        } else if (selectedType === 'Recycled') {
            $('#recycled_container').removeClass('d-none').show();
            $('#garbage_container').addClass('d-none').hide();
        } else {
            // Hide both containers if no valid type is selected
            $('#garbage_container').addClass('d-none').hide();
            $('#recycled_container').addClass('d-none').hide();
        }
    }

    toggleContainers();

    $('#type').change(function () {
        toggleContainers();
    });

    $('#postreportModal').on('hide.bs.modal', function () {
        $('#garbage_container').addClass('d-none').hide();
        $('#recycled_container').addClass('d-none').hide();
        $('#type').val('');
    });

    // // Handle form submission
    $(document).on('click', '#savePostReport', function () {
        let form = $('#postreport-form')[0];
        let formData = new FormData(form);

        let descriptionContent;
        let photoReport;

        if ($('#type').val() === 'Garbage') {
            descriptionContent = tinymce.get('description').getContent();
            photoReport = $('#photo')[0].files[0];  // Get the file object
        } else {
            descriptionContent = tinymce.get('re_description').getContent();
            photoReport = $('#re_photo')[0].files[0];
        }

        formData.append('description', descriptionContent);
        formData.append('photo', photoReport);

        if (postreportId) {
            formData.append('postreport_id', postreportId);
        }

        showLoader('.savePostReport');

        $('#savePostReport').prop('disabled', true)

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {

                hideLoader('.savePostReport');
                $('#savePostReport').prop('disabled', false)
                toast(data.type, data.message)
                $('#postreport-form')[0].reset();
                $('#postreportModal').modal('hide');
                postreportDataTable.ajax.reload();

            },
            error: function (response) {
                if (response.status === 422) {

                    hideLoader('.savePostReport');
                    $('#savePostReport').prop('disabled', false)

                    var errors = response.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $('#' + key).addClass('border-danger is-invalid');
                        $('#' + key + '_error').html('<strong>' + value[0] + '</strong>');
                    });
                } else {
                    console.log(response);
                }
            }
        });
    });

    function showPostReportModal(modalTitle) {
        $('#postreportModal').modal('show');
        $('#postreportModal .modal-title').text(modalTitle);
    }

    function removePostReport(id) {

        $.ajax({
            type: 'DELETE',
            url: `/postreport/${id}`,
            dataType: 'json',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            }
        }).done(function (data) {
            toast(data.type, data.message)
            $('#postreportModal').modal('hide');
            postreportDataTable.ajax.reload();
        }).fail(function (data) {
            console.log(data)
        });

    }

});
