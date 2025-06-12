<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chamado;

class ChamadoComponent extends Component
{
    public $titulo, $descricao, $status = 'aberto', $chamadoId;
    public $editMode = false;

    public function render()
    {
        return view('livewire.chamado-component', [
            'chamados' => Chamado::all()
        ]);
    }

    public function create()
    {
        $this->validate([
            'titulo' => 'required|min:3',
        ]);

        Chamado::create([
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'status' => $this->status,
        ]);

        $this->resetFields();
    }

    public function edit($id)
    {
        $chamado = Chamado::findOrFail($id);
        $this->titulo = $chamado->titulo;
        $this->descricao = $chamado->descricao;
        $this->status = $chamado->status;
        $this->chamadoId = $chamado->id;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate([
            'titulo' => 'required|min:3',
        ]);

        if ($this->chamadoId) {
            $chamado = Chamado::find($this->chamadoId);
            $chamado->update([
                'titulo' => $this->titulo,
                'descricao' => $this->descricao,
                'status' => $this->status,
            ]);
        }

        $this->resetFields();
    }

    public function delete($id)
    {
        Chamado::destroy($id);
    }

    public function resetFields()
    {
        $this->titulo = '';
        $this->descricao = '';
        $this->status = 'aberto';
        $this->chamadoId = null;
        $this->editMode = false;
    }
}
