<div class="modal editIncome fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Income</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form action="<?= route('update.income') ?>" method="post" id="update-income-payment">

                    <input type="hidden" id="id" name="sid" />

                    <div class="form-group">

                        <div class="row">

                            <div class="col-sm-4">
                                <label>CA Paper</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="ca_papers" name="ca_paper" class="form-control" onInput="calculateBalance()">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label>Yellow Book:</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="green_books" name="green_book" class="form-control" onInput="calculateBalance()">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label>Mass Card:</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="mass_cards" name="mass_card" class="form-control" onInput="calculateBalance()">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label>Total:</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="total" name="total" class="form-control" onInput="calculateBalance()" readonly>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnUpdate" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>


        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>

    function calculateBalance() {

        var ca_paper_quantity = parseInt(document.getElementById('ca_papers').value) || 0;
        var green_book_quantity = parseInt(document.getElementById('green_books').value) || 0;
        var mass_card_quantity = parseInt(document.getElementById('mass_cards').value) || 0;

        var ca_paper_multiplier = 1;
        var green_book_multiplier = 4;
        var mass_card_multiplier = 3;

        var totalFee = (ca_paper_quantity * ca_paper_multiplier) +
                        (green_book_quantity * green_book_multiplier) +
                        (mass_card_quantity * mass_card_multiplier);

        document.getElementById('total').value = totalFee.toFixed(2);
    }

    function allowOnlyNumbersWithDecimal(inputId) {
                var input = document.getElementById(inputId);
                input.addEventListener('input', function() {
                    // Remove non-numeric and non-decimal characters
                    this.value = this.value.replace(/[^0-9.]/g, '');

                    // Remove leading zeros
                    this.value = this.value.replace(/^0+(?=\d)/, '');

                    // Allow only one decimal point
                    if (this.value.split('.').length > 2) {
                        this.value = this.value.slice(0, this.value.lastIndexOf('.'));
                    }
                });
            }

            // Call the function for each input field
            allowOnlyNumbersWithDecimal('ca_papers');
            allowOnlyNumbersWithDecimal('green_books');
            allowOnlyNumbersWithDecimal('mass_cards');
</script>
