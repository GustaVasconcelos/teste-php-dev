$(document).ready(function() {
    $('.btn-danger').click(function() {
        var categoryId = $(this).data('id');
        
        $('#confirmDeleteBtn').data('categoryId', categoryId);
        
        $('#confirmDeleteModal').modal('show');
    });

    $('#confirmDeleteBtn').click(function(event) {
        event.preventDefault();

        var categoryId = $(this).data('categoryId');

        $('#category_id').val(categoryId);

        $('#deleteCategoryForm').submit();
    });
    
});