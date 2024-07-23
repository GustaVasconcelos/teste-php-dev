$(document).ready(function() {
    var $typeSelect = $('#type');
    var $invoiceNumberDiv = $('#invoice_number_div');
    var $supplierDiv = $('#supplier_div');
    var $controlNumberDiv = $('#control_number_div');
    var $destinationDiv = $('#destination_div');

    $typeSelect.on('change', function() {
        var selectedType = $(this).val();

        if (selectedType === 'entry') {
            $invoiceNumberDiv.show();
            $supplierDiv.show();
            $controlNumberDiv.hide();
            $destinationDiv.hide();
        } else if (selectedType === 'exit') {
            $invoiceNumberDiv.hide();
            $supplierDiv.hide();
            $controlNumberDiv.show();
            $destinationDiv.show();
        } else {
            $invoiceNumberDiv.hide();
            $supplierDiv.hide();
            $controlNumberDiv.hide();
            $destinationDiv.hide();
        }
    });

    // Trigger the change event on page load
    $typeSelect.trigger('change');
});
