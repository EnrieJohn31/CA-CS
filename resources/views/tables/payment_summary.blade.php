<style>
    /* Custom CSS to set the modal background color to white */
    .custom-modal {
        background-color: white;
        /* Set the background color to white */
    }

    .custom-modal-content {
        color: black;
        /* Set the text color to black */
    }

    hr {
        height: 1.5px;
        /* Itaas ang taas para sa makakapal na linya */
        background-color: #D51B1B;
        /* Itakda ang kulay ng linya */
        border: none;
        /* Alisin ang border, kung gusto mo */
        margin: 20px 0;
        /* Magdagdag ng margin para sa espasyo */
    }

    th {
        text-align: center;
    }

    @media print {
        .custom-modal-content {
            padding: 1rem;
            /* Add padding for better readability */
        }

        img {
            max-width: 100%; /* Ensure the image fits within the printable area */
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            /* Add margin for better separation */
        }

        th,
        td {
            border: 10px solid #e2e8f0;
            /* Add borders for better visibility */
            padding: 0.5rem;
            text-align: right;
        }

        th {
            background-color: #f7fafc;
            /* Background color for headers */
        }


    }
</style>

<div class="modal history_payment fade" id="modal-summary">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Payment Summary</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="container printable" id='printable_div_id'>

                <!-- <div class="container printable" id='printable_div_id'> -->
                <div class="modal-body custom-modal custom-modal-content" id=forPrint>
                    <!-- Your image tag inside the modal content -->
                    <div class="container d-flex justify-content-center">
                        <img  src="{{ asset('assets/img/system/header.png') }}" alt="header" width="765.5" height="240" class="header-image"class="d-flex justify-content-start p-4">
                    </div><br><br>
                    <div style="display: flex; align-items: center;">
                        <label for="student-id" class="col-form-label">LRN: </label> &nbsp;&nbsp;
                        <h6 id="student-id" style="margin: 0;"></h6>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <label for="student-name" class="col-form-label">Student Name: </label> &nbsp;&nbsp;
                        <h6 id="student-name" style="margin: 0;"></h6>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <label for="" class="col-form-label">Year Level & Section: </label> &nbsp;&nbsp;
                        <h6 id="student-section" style="margin: 0;"></h6>
                    </div>
                    <hr>

                    <table class="table table-bordered table-striped " style="width:100%;border-collapse: collapse;font-family:arial;" id="payment-table">
                    <thead style="border: 1px solid #dddddd;">

                                    <th style="background-color: #f2f2f2;color: #333;font-weight: bold;padding: 5px;text-align: center;
                                    border: 2px solid #ddd;">OR Number</th>
                                    <th style="background-color: #f2f2f2;color: #333;font-weight: bold;padding: 5px;text-align: center;
                                    border: 2px solid #ddd;">Date Paid</th>
                                    <th style="background-color: #f2f2f2;color: #333;font-weight: bold;padding: 5px;text-align: center;
                                    border: 2px solid #ddd;">Fees</th>
                                    <th style="background-color: #f2f2f2;color: #333;font-weight: bold;padding: 5px;text-align: center;
                                    border: 2px solid #ddd;">Amount Paid</th>
                                    <th style="background-color: #f2f2f2;color: #333;font-weight: bold;padding: 5px;text-align: center;
                                    border: 2px solid #ddd;">Remaining Balance</th>
                                    {{-- <th >updated_at</th>
                                    <th>created_at</th> --}}
                                     </th>
                    </thead>
                    <tbody id="payment-table-body">

                    </tbody>
                    </table>
                </div>
            </div>
            <!-- </div> -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="printModal() "hidden>Print</button>
                <button class="btn btn-dark"><i class="fa fa-print fa-lg"></i><a
                                                        onClick="printdiv('printable_div_id');"> Print</a></button>
            </div>
        </div>
    </div>
</div>

<script>
    function printdiv(elem) {
        var header_str = '<html><head><title>' + document.title + '</title>';

        // Add style for dark text
        header_str += '<style type="text/css">';
            header_str += '@media print { body { color: #000 !important; } yourImageID { display: block !important; margin: 0 auto !important;}}';
            header_str += '</style>';

        header_str += '</head><body>';

        var footer_str = '</body></html>';
        var new_str = document.getElementById(elem).innerHTML;
        var new_st = `
            <div class="container">
                <section class="m-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 text-center mb-4 px-4" style="padding-top: 100px;">
                            <div class="d-flex justify-content-center">
                                <p><strong>Prepared By:</strong></p>
                            </div>
                            <div class="d-flex justify-content-center">
                                <p>JENNIFER S. DISPO<br>Cashier</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            `;


            document.body.innerHTML = header_str + new_str + footer_str+new_st;


        window.print();

        document.body.innerHTML = old_str;

        return false;
    }
</script>
