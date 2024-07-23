$(document).ready(function() {
    $('.btn-danger').click(function() {
        var productId = $(this).data('id');
        
        $('#confirmDeleteBtn').data('productId', productId);
        
        $('#confirmDeleteModal').modal('show');
    });

    $('#confirmDeleteBtn').click(function(event) {
        event.preventDefault();
        var productId = $(this).data('productId');
        
        $('#id').val(productId);

        $('#deleteProductForm').submit();
    });
    
});