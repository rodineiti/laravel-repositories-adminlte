<!-- MODAL Exclusão-->
<div class="modal modal-danger fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
      </div>
      <div class="modal-body" id="confirm-body">
        <p>Você está prestes a excluir este cadastro, esse procedimento é irreversível.</p>
        <p>Você quer prosseguir?</p>
        <form>
          @csrf
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="confirm-remove-btn">Deletar</button>
      </div>
    </div>
  </div>
</div>
