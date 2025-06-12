<div class="container mt-5">
    <h2>Cadastro de Chamados</h2>

    <form wire:submit.prevent="{{ $editMode ? 'update' : 'create' }}">
        <input type="text" wire:model="titulo" placeholder="Título" class="form-control mb-2">
        <textarea wire:model="descricao" placeholder="Descrição" class="form-control mb-2"></textarea>
        <select wire:model="status" class="form-control mb-2">
            <option value="aberto">Aberto</option>
            <option value="em andamento">Em andamento</option>
            <option value="concluído">Concluído</option>
        </select>
        <button class="btn btn-primary">{{ $editMode ? 'Atualizar' : 'Salvar' }}</button>
    </form>

    <hr>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Título</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chamados as $chamado)
                <tr>
                    <td>{{ $chamado->titulo }}</td>
                    <td>{{ $chamado->status }}</td>
                    <td>
                        <button wire:click="edit({{ $chamado->id }})" class="btn btn-sm btn-warning">Editar</button>
                        <button wire:click="delete({{ $chamado->id }})" class="btn btn-sm btn-danger">Excluir</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
