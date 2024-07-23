$(document).ready(function () {
    const $addEntryButton = $('#add-entry');
    const $entriesContainer = $('#entries-container');
    let entryIndex = 1;

    $addEntryButton.on('click', function () {
        let productOptionsHtml = '<option value="" disabled selected>Selecione um produto</option>';
        
        productsOptions.forEach(product => {
            productOptionsHtml += `<option value="${product.id}">${product.name}</option>`;
        });

        const entryHtml = `
            <div class="row mb-3">
                <div class="d-flex flex-column col-6">
                    <label for="productId${entryIndex}" class="form-label text-dark font-weight-bold mt-2">Produto</label>
                    <select id="productId${entryIndex}" class="form-control" name="entries[${entryIndex}][product_id]">
                        ${productOptionsHtml}
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label for="quantity${entryIndex}" class="form-label text-dark font-weight-bold mt-2">Quantidade:</label>
                    <input type="number" id="quantity${entryIndex}" name="entries[${entryIndex}][quantity]" class="form-control" placeholder="Digite a quantidade" min="1" required>
                </div>
                <div class="col-6 mb-3">
                    <label for="invoice_number${entryIndex}" class="form-label text-dark font-weight-bold mt-2">Número da Nota Fiscal:</label>
                    <input type="text" id="invoice_number${entryIndex}" name="entries[${entryIndex}][invoice_number]" class="form-control" placeholder="Digite o número da nota fiscal" required>
                </div>
                <div class="col-6 mb-3">
                    <label for="supplier${entryIndex}" class="form-label text-dark font-weight-bold mt-2">Fornecedor:</label>
                    <input type="text" id="supplier${entryIndex}" name="entries[${entryIndex}][supplier]" class="form-control" placeholder="Digite o nome do fornecedor" required>
                </div>
                <hr>
            </div>
        `;

        $entriesContainer.append(entryHtml);

        entryIndex++;
    });
});
