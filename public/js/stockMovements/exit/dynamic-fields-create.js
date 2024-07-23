$(document).ready(function() {
    let entryIndex = 1;

    $('#add-entry').click(function() {
        let productOptionsHtml = '<option value="" disabled selected>Selecione um produto</option>';

        productsOptions.forEach(product => {
            productOptionsHtml += `<option value="${product.id}">${product.name}</option>`;
        });

        const entryHtml = `
            <div class="row mb-3">
                <div class="d-flex flex-column col-6">
                    <label for="productId${entryIndex}" class="form-label text-dark font-weight-bold mt-2">Produto ${entryIndex + 1}</label>
                    <select id="productId${entryIndex}" class="form-control" name="entries[${entryIndex}][product_id]">
                        ${productOptionsHtml}
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label for="quantity${entryIndex}" class="form-label text-dark font-weight-bold mt-2">Quantidade:</label>
                    <input type="number" id="quantity${entryIndex}" name="entries[${entryIndex}][quantity]" class="form-control" placeholder="Digite a quantidade" min="1" required>
                </div>
                <div class="col-6 mb-3">
                    <label for="control_number${entryIndex}" class="form-label text-dark font-weight-bold mt-2">Número de Controle:</label>
                    <input type="text" id="control_number${entryIndex}" name="entries[${entryIndex}][control_number]" class="form-control" placeholder="Digite o número de controle">
                </div>
                <div class="col-6 mb-3">
                    <label for="destination${entryIndex}" class="form-label text-dark font-weight-bold mt-2">Destino:</label>
                    <input type="text" id="destination${entryIndex}" name="entries[${entryIndex}][destination]" class="form-control" placeholder="Digite o destino">
                </div>
                <hr>
            </div>
        `;

        $('#entries-container').append(entryHtml);

        entryIndex++;
    });
});
