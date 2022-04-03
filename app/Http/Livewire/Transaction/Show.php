<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public $count = 10;
    public $search = '';
    public $itemModal = false;
    public $item;
    protected $rules = [
        'item.name' => 'required|string|min:4',
        'item.price' => 'required',
    ];
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->item = new Transaction();
    }

    public function render()
    {
        $data = Transaction::when($this->search,function ($query){
                $query->where('good_id',$this->search)
                    ->orWhere('csgo_empire_item_id',$this->search)
                    ->orWhere('status',$this->search);
            })
            ->orderBy('id','desc')
            ->paginate($this->count);
        return view('livewire.transaction.show',compact('data'));
    }

    public function edit($id = null){
        $this->itemModal = true;
        $this->item = $id ? Transaction::find($id) : new Transaction();
    }

    public function save(){
        $this->item->save();
        $this->itemModal = false;
    }

    public function delete($id){
        Transaction::where('id',$id)->delete();
    }
}
