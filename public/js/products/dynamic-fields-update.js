$(document).ready(function () {
    var $categorySelect = $('#category-id');
    var $subCategorySelect = $('#sub-category-id');
    var $defaultOption = $subCategorySelect.find('option:first');

    function updateSubCategories() {
        var selectedCategoryId = $categorySelect.val();

        $subCategorySelect.find('option').each(function () {
            if ($(this).val() !== $defaultOption.val()) {
                $(this).toggle($(this).data('category') == selectedCategoryId);
            }
        });

        if (!selectedCategoryId) {
            $defaultOption.text("Selecione uma categoria");
            $subCategorySelect.val('');
            $subCategorySelect.prop('disabled', true);
        } else {
            $defaultOption.text("Selecione uma subcategoria");
            $subCategorySelect.val('');
            $subCategorySelect.prop('disabled', false);
        }
    }

    $categorySelect.on('change', function () {
        updateSubCategories();
        $subCategorySelect.val(''); 
    });

    updateSubCategories();

    if ($categorySelect.val()) {
        var selectedSubCategoryId = $subCategorySelect.find('option[selected]');
        if (selectedSubCategoryId.length) {
            $subCategorySelect.val(selectedSubCategoryId.val());
        }
    }
});
