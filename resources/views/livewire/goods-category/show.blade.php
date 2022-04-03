<div>
    <div class="p-6">
        <div class="text-2xl flex justify-between">
            <div>
                <input wire:model.debounce.500ms="search" type="search" placeholder="Search" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
            </div>
            <div class="mr-2">
                <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-base" wire:click="edit()">
                    Add New Item
                </button>
            </div>
        </div>
        <table class="table-fixed w-full mt-4">
            <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2 w-16">Id</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2 w-48">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $index => $row)
                <tr>
                    <td class="border px-4 py-2">{{$row->id}}</td>
                    <td class="border px-4 py-2">{{$row->name}}</td>
                    <td class="border px-4 py-2">{{$row->status}}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $row->id }})" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded">Edit</button>
                        <div style="display: inline-block">
                            <x-jet-dropdown align="right" width="48" style="display: inline-block">
                                <x-slot name="trigger">
                                    <button class="bg-red-700 hover:bg-red-500 text-white font-bold py-2 px-4 rounded" wire:loading.attr="disabled">Xóa</button>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="p-6">
                                        <div class="mb-4">
                                            {{ __('Chắc chắn xóa? ') }}
                                        </div>
                                        <x-jet-secondary-button class="text-sm">
                                            {{ __('NO') }}
                                        </x-jet-secondary-button>

                                        <x-jet-danger-button class="ml-2 text-sm" wire:click="delete({{ $row->id }})">
                                            {{ __('OK') }}
                                        </x-jet-danger-button>
                                    </div>
                                </x-slot>
                            </x-jet-dropdown>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pt-4">{{$data->links()}}</div>
    </div>
    <x-jet-dialog-modal wire:model="itemModal">
        <x-slot name="title">
            {{ $item->id ? __('Cập nhật') : __('Thêm Mới') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-12">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="item.name"/>
                <x-jet-input-error for="item.name" class="mt-2" />
            </div>
            <div class="col-span-12">
                <x-jet-label for="status" value="{{ __('Status') }}" />
                <x-jet-input id="status" type="text" class="mt-1 block w-full" wire:model.defer="item.status"/>
                <x-jet-input-error for="item.status" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('itemModal', false)" wire:loading.attr="disabled">
                {{ __('Hủy bỏ') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="save()" wire:loading.attr="disabled">
                {{ __('Lưu') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
