<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalExample">Est&aacute;s seguro de eliminar el registro?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Selecione <strong>"ELIMINAR"</strong> si realmente desea eliminar el registro.</div>
            <div class="modal-footer">
                <button class="btn btn-outline-success" type="button" data-dismiss="modal"><i class="fas fa-times"></i> CANCELAR</button>
                <a class="btn btn-outline-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('expedicion_ci-delete-form').submit();">
                    <i class="fas fa-trash"></i>
                    ELIMINAR
                </a>
                <form id="expedicion_ci-delete-form" method="POST" action="{{ route('expedicion_cis.destroy', ['expedicion_ci' => $expedicion_ci->id]) }}">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>