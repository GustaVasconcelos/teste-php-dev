<div id="confirmDeleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmar Exclusão</h4>
            </div>
            <div class="modal-body">
                <p>Você tem certeza que deseja excluir está categoria? Ela pode está associada há um produto, cuidado!!</p>
            </div>
            <div class="modal-footer">
                <form id="deleteCategoryForm" action="{{ route('categories.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="category_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="confirmDeleteBtn" type="button" class="btn btn-danger">Confirmar Exclusão</button>
                </form>
            </div>
        </div>
    </div>
</div>