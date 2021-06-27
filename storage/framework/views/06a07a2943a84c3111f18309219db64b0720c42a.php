<?php $__env->startSection('content'); ?>
<div class="container-fluid pt-3" style="min-height: 600px">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center p-1">Submitted for Quote</h3><hr/>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="quote_table">
                    <thead>
                    <tr class="text-center">
                        <th>Request No</th><th>Reference</th><th>Client Name</th><th>Contact No</th><th>Make</th><th>Model</th><th>Area</th><th>Received date</th><th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $__currentLoopData = $quoteOngoing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($quote->claim_no); ?></td>
                            <td><?php echo e($quote->reference_cn); ?></td>
                            <td><?php echo e($quote->client_name); ?></td>
                            <td><?php echo e($quote->contact_no); ?></td>
                            <td><?php echo e($quote->MakeInfo->vehiclemake); ?></td>
                            <td><?php echo e($quote->make_model); ?></td>
                            <td><?php echo e($quote->AreaInfo->areaname); ?></td>
                            <td><?php echo e(AppDateFormat($quote->received_date)); ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning" onclick="viewQuote(<?php echo e($quote->claim_no); ?>)">View</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                    <div id="buttons" class="btn btn"></div>
                </div>
                <h3 class="text-center p-1">Submitted to Buy</h3><hr/>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="order_table">
                    <thead>
                    <tr class="text-center">
                        <th>Request No</th><th>Reference</th><th>Order No</th><th>Client Name</th><th>Contact No</th><th>Make</th><th>Model</th><th>Area</th><th>Received date</th><th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $__currentLoopData = $orderedQuote; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($order->claim_no); ?></td>
                            <td><?php echo e($order->reference_cn); ?></td>
                            <td><?php echo e(getOrderNoByClaimId($order->id)); ?></td>
                            <td><?php echo e($order->client_name); ?></td>
                            <td><?php echo e($order->contact_no); ?></td>
                            <td><?php echo e($order->MakeInfo->vehiclemake); ?></td>
                            <td><?php echo e($order->make_model); ?></td>
                            <td><?php echo e($order->AreaInfo->areaname); ?></td>
                            <td><?php echo e(AppDateFormat($order->received_date)); ?></td>
                            <td class="text-center">
                                <button class="btn btn-warning" onclick="viewQuote(<?php echo e($order->claim_no); ?>)">View</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                    <div id="buttons2"></div>
                </div>
            </div>

            <div id="mySupplierModal" class="modal fade modal-top" role="dialog">
                <div class="modal-dialog  modal-dialog-centered">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div id="mySupModal_body"></div>
                        </div>
                    </div>

                </div>
            </div>

            <div id="myImageModal" class="modal fade modal-top" role="dialog">
                <div class="modal-dialog  modal-dialog-centered">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div id="myImgModal_body"></div>
                        </div>
                    </div>

                </div>
            </div>

            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div id="myModal_body"></div>
                        </div>
                    </div>

                </div>
            </div>
            <script src="<?php echo e(asset('/plugins/datatables/dataTables.buttons.min.js')); ?>"></script>
            <script src="<?php echo e(asset('/plugins/datatables/buttons.flash.min.js')); ?>"></script>
            <script src="<?php echo e(asset('/plugins/datatables/jszip.min.js')); ?>"></script>
            <script src="<?php echo e(asset('/plugins/datatables/pdfmake.min.js')); ?>"></script>
            <script src="<?php echo e(asset('/plugins/datatables/vfs_fonts.js')); ?>"></script>
            <script src="<?php echo e(asset('/plugins/datatables/buttons.html5.min.js')); ?>"></script>
            <script src="<?php echo e(asset('/plugins/datatables/buttons.print.min.js')); ?>"></script>
            <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                function viewQuote(claimNo){
                    $.ajax({
                        beforeSend: function(){
                            //$.blockUI();
                        },
                        success: function(data){
                            var html = $(data).find('#output');
                            $("#myModal_body").children().remove();
                            $("#myModal_body").append(html);
                            $("#myModal").modal('show');
                        },
                        complete: function () {
                            $('.bootbox.modal').on('hidden.bs.modal', function () {
                                if($(".modal").hasClass('in')){
                                    $('body').addClass('modal-open');
                                }
                            });
                        },
                        type: 'POST',
                        url: "admin/viewQuote",
                        data: {
                            claimNo:claimNo
                        },
                        cache: false,
                        dataType: 'html'
                    });
                }

                function viewSupplier(id, quote_no){
                    $.ajax({
                        beforeSend: function(){
                            //$.blockUI();
                        },
                        success: function(data){
                            var html = $(data).find('#output');
                            $("#mySupModal_body").children().remove();
                            $("#mySupModal_body").append(html);
                            $("#mySupplierModal").modal('show');
                        },
                        complete: function () {
                            $('.bootbox.modal').on('hidden.bs.modal', function () {
                                if($(".modal").hasClass('in')){
                                    $('body').addClass('modal-open');
                                }
                            });
                        },
                        type: 'POST',
                        url: "admin/viewSupplier",
                        data: {
                            supplier_id:id, quote_no:quote_no
                        },
                        cache: false,
                        dataType: 'html'
                    });
                }

                $(document).ready( function(){

                    var table = $('#quote_table').DataTable({
                        "order": [[ 6, "desc" ]],
                        "columnDefs": [
                            {
                                "targets": 7,
                                "orderable": false
                            },
                            { type: 'natural', targets: '_all' }
                        ],
                        "language": {
                            "emptyTable": "No data available in table"
                        },
                        "paging": true
                    });

                    var buttons = new $.fn.dataTable.Buttons(table, {
                        "buttons": [
                            {
                                text: 'Export as PDF',
                                extend: 'pdfHtml5',
                                className: 'btn btn-info',
                                filename: function(){
                                    var title =  'quote_ongoing';
                                    var d = new Date();
                                    var n = d.getTime();
                                    return title+'_'+n;
                                },
                                orientation: 'landscape', //portrait
                                pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                                },
                                customize: function(doc){
                                    doc.content.splice(0,1);
                                    doc.pageMargins = [30,100,50,30];
                                    doc.defaultStyle.fontSize = 10;

                                    doc['header']=(function() {
                                        var title =  "Ongoing Quote List";
                                        return {
                                            columns: [
                                                {
                                                    alignment: 'left',
                                                    fontSize: 13,
                                                    text: title
                                                },
                                                {
                                                    alignment: 'left',
                                                    fontSize: 16,
                                                    text: 'Parts Finder',
                                                }
                                            ],
                                            margin: [30, 10]
                                        }
                                    });
                                    doc['footer']=(function(page, pages) {
                                        return {
                                            columns: [
                                                {
                                                    alignment: 'left',
                                                    text: ['Printed By : ', { text: "<?php echo e(getUserName()); ?>"},', User Type : ' +"<?php echo e(getUserType()); ?>"]
                                                },
                                                {
                                                    alignment: 'center',
                                                    text: [
                                                        'Page: ',
                                                        { text: page.toString(), italics: false },
                                                        ' of ',
                                                        { text: pages.toString(), italics: false }
                                                    ],
                                                    margin:[40]
                                                },
                                                {
                                                    alignment: 'right',
                                                    text: [
                                                        'Print date: <?php echo e(AppDateFormat(getCurrentDateTime())); ?>'
                                                    ]
                                                }
                                            ],
                                            margin: [50, 0]
                                        }
                                    });

                                    var objLayout = {};
                                    objLayout['hLineWidth'] = function (i) {
                                        return 1;
                                    };
                                    objLayout['vLineWidth'] = function (i) {
                                        return 1;
                                    };
                                    objLayout['hLineColor'] = function (i) {
                                        return '#aaa';
                                    };
                                    objLayout['vLineColor'] = function (i) {
                                        return '#aaa';
                                    };
                                    objLayout['paddingLeft'] = function (i) {
                                        return 10;
                                    };
                                    objLayout['paddingRight'] = function (i) {
                                        return 10;
                                    };
                                    doc.content[0].layout = objLayout;
                                    doc.content[0].table.widths = ["*", "*", "*", "*", "*", "*", "*"];
                                }

                            },
                            {
                                text: 'Export as Excel',
                                title: '',
                                extend: 'excelHtml5',
                                className: 'btn btn-primary',
                                filename: function(){
                                    var title =  "quote_ongoing";
                                    var d = new Date();
                                    var n = d.getTime();
                                    return title+'_'+n;
                                },
                                orientation: 'landscape', //portrait
                                pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                                },

                                messageTop: function () {
                                    var title =  "Ongoing Quote List";
                                    return title;
                                }
                            }
                        ]
                    }).container().appendTo($('#buttons'));

                    var table2 = $('#order_table').DataTable({
                        "order": [[ 7, "asc" ]],
                        "columnDefs": [
                            {
                                "targets": 8,
                                "orderable": false
                            },
                            { type: 'natural', targets: '_all' }
                        ],
                        "language": {
                            "emptyTable": "No data available in table"
                        },
                        "paging": true
                    });

                    var buttons2 = new $.fn.dataTable.Buttons(table2, {
                        "buttons": [
                            {
                                text: 'Export as PDF',
                                extend: 'pdfHtml5',
                                className: 'btn btn-info',
                                filename: function(){
                                    var title =  'order_ongoing';
                                    var d = new Date();
                                    var n = d.getTime();
                                    return title+'_'+n;
                                },
                                orientation: 'landscape', //portrait
                                pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                                },
                                customize: function(doc){
                                    doc.content.splice(0,1);
                                    doc.pageMargins = [30,100,50,30];
                                    doc.defaultStyle.fontSize = 10;

                                    doc['header']=(function() {
                                        var title =  "Submitted for buy";
                                        return {
                                            columns: [
                                                {
                                                    alignment: 'left',
                                                    fontSize: 13,
                                                    text: title
                                                },
                                                {
                                                    alignment: 'left',
                                                    fontSize: 16,
                                                    text: 'Parts Finder',
                                                }
                                            ],
                                            margin: [30, 10]
                                        }
                                    });
                                    doc['footer']=(function(page, pages) {
                                        return {
                                            columns: [
                                                {
                                                    alignment: 'left',
                                                    text: ['Printed By : ', { text: "<?php echo e(getUserName()); ?>"},', User Type : ' +"<?php echo e(getUserType()); ?>"]
                                                },
                                                {
                                                    alignment: 'center',
                                                    text: [
                                                        'Page: ',
                                                        { text: page.toString(), italics: false },
                                                        ' of ',
                                                        { text: pages.toString(), italics: false }
                                                    ],
                                                    margin:[40]
                                                },
                                                {
                                                    alignment: 'right',
                                                    text: [
                                                        'Print date: <?php echo e(AppDateFormat(getCurrentDateTime())); ?>'
                                                    ]
                                                }
                                            ],
                                            margin: [50, 0]
                                        }
                                    });

                                    var objLayout = {};
                                    objLayout['hLineWidth'] = function (i) {
                                        return 1;
                                    };
                                    objLayout['vLineWidth'] = function (i) {
                                        return 1;
                                    };
                                    objLayout['hLineColor'] = function (i) {
                                        return '#aaa';
                                    };
                                    objLayout['vLineColor'] = function (i) {
                                        return '#aaa';
                                    };
                                    objLayout['paddingLeft'] = function (i) {
                                        return 10;
                                    };
                                    objLayout['paddingRight'] = function (i) {
                                        return 10;
                                    };
                                    doc.content[0].layout = objLayout;
                                    doc.content[0].table.widths = ["*", "*", "*", "*", "*", "*", "*", "*"];
                                }

                            },
                            {
                                text: 'Export as Excel',
                                title: '',
                                extend: 'excelHtml5',
                                className: 'btn btn-primary',
                                filename: function(){
                                    var title =  "order_ongoing";
                                    var d = new Date();
                                    var n = d.getTime();
                                    return title+'_'+n;
                                },
                                orientation: 'landscape', //portrait
                                pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                                },

                                messageTop: function () {
                                    var title =  "Submitted for buy";
                                    return title;
                                }
                            }
                        ]
                    }).container().appendTo($('#buttons2'));

                    $(document).on("click", "a.view_image", function () {
                        let imgUrl = $(this).data('url');
                        let imgElement = "<img src='"+imgUrl+"' class='img-fluid'/>";
                        $("#myImgModal_body").children().remove();
                        $("#myImgModal_body").append(imgElement);
                        $("#myImageModal").modal('show');
                    });

                });
            </script>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>