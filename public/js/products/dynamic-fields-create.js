$(document).ready(function () {
    var $categorySelect = $('#category-id');
    var $subCategorySelect = $('#sub-category-id');
    var $defaultOption = $subCategorySelect.find('option').first();

    $categorySelect.on('change', function () {
        var selectedCategoryId = $(this).val();

        $subCategorySelect.find('option').each(function () {
            var $option = $(this);
            if ($option !== $defaultOption) {
                $option.toggle($option.data('category') == selectedCategoryId);
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
    });

    $categorySelect.trigger('change');
});