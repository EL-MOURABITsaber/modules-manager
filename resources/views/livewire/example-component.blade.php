<div class="bg-gray-100 min-h-screen">
  <div class="flex gap-4 flex-col ">


    @foreach (config('modules-manager.available_modules') as $module )
    
    <div class=" bg-white rounded-lg shadow-md p-8 flex justify-between items-center ">
      <div class="">
        {{ $module['name'] }}
      </div>
      <div class="flex gap-2 text-white">
        <button class="p-2 bg-blue-500 " wire:click='installModule("{{ $module['name'] }}","{{ $module['link'] }}")'>
          Install
        </button>
        <button class="p-2 bg-red-600" wire:click='deletModule("{{ $module['name'] }}")'>
          Delete
        </button>
      </div>
    </div>
    
@endforeach

  </div>

</div>