$(document).ready(function() {
    $('.btn-danger').click(function() {
        var subCategoryId = $(this).data('id');
        var categoryId = $(this).data('category-id');

        $('#confirmDeleteBtn').data('subCategoryId', subCategoryId);
        $('#confirmDeleteBtn').data('categoryId', categoryId);

        $('#confirmDeleteModal').modal('show');
    });

    $('#confirmDeleteBtn').click(function(event) {
        event.preventDefault();

        var subCategoryId = $(this).data('subCategoryId');
        var categoryId = $(this).data('categoryId');

        $('#id').val(subCategoryId);
        $('#category_id').val(categoryId);

        $('#deleteSubCategoryForm').submit();
    });
    
});