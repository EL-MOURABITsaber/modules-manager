<div class="bg-gray-200 min-h-screen p-5" x-data>


  <!-- component -->
<div class=" font-sans  w-full flex  gap-5 ">
  @foreach (config('modules-manager.available_modules') as $key => $module )

  <div class="card w-96 h-fit  bg-white flex flex-col  shadow-xl rounded-md">
    <div class="flex  bg-gray-50 items-center rounded-t-md">
      <div class="p-3 text-3xl font-semibold text-gray-800">
        <p>{{ $module["name"] }}</p>
        <p class="pl-1 font-normal text-base">{{ $module["category"] ?? '--' }}</p>
      </div>
    </div>
     <div class="text-center font-normal text-lg flex py-2  justify-center items-center gap-3">
      @if (Module::has($module["name"]))
        <p class="bg-emerald-600 rounded-md px-2 text-white text-sm  w-fit text-right ">Downloaded</p>
      @else
        <p class="bg-rose-600 rounded-md px-2 text-white text-sm  w-fit text-right">Not downloaded</p>
      @endif
      
      @if (Module::has($module["name"]) && Module::isEnabled($module["name"]))
        <p class="bg-indigo-600 rounded-md px-2 text-white text-sm  w-fit text-left">Enabled</p>
      @else
        @if (Module::has($module["name"]))
          <p class="bg-amber-600 rounded-md px-2 text-white text-sm  w-fit text-left">Disabled</p>
        @endif
      @endif


    </div>
     <div class="px-6 text-center mt-2 text-gray-500 text-sm">
       <p>
         {{ $module["description"] }}
       </p>
     </div>
     <div class="pt-6 pb-3 px-1 w-full flex flex-col gap-3">

      @if (Module::has($module["name"]) && Module::isEnabled($module["name"]))   

      @php
        $current='posts::posts-module-settings-handler';
      @endphp
      <livewire:is :component="$current" />

      @else

      <div class="relative w-full p-5 font-semibold bg-gray-100   text-gray-900">
        Download and enable module to gain acess to its settings
      </div>

      @endif



     </div>

     
     <div class="flex mt-2 items-center gap-2 p-2 bg-gray-50">
      @if (Module::has($module["name"]) && Module::isEnabled($module["name"]))     
      <button wire:click='disableModule' class="w-1/2 p-2 rounded-md text-center hover:text-white font-semibold hover:bg-amber-600 transition-colors duration-200 cursor-pointer">
        Disable
      </button>
      @else
      <button wire:click='enableModule' @disabled(! Module::has($module["name"])) class="w-1/2 p-2 rounded-md disabled:cursor-not-allowed text-center hover:text-white font-semibold hover:bg-blue-600 transition-colors duration-200 cursor-pointer">
        Enable
      </button>
      @endif
       <div class="w-0 border h-6 border-gray-300">
         
       </div>
       @if (Module::has($module["name"])) 
       <div class="w-1/2 p-2 rounded-md text-center hover:text-white font-semibold hover:bg-rose-600 transition-colors duration-200 h-full cursor-pointer" wire:click='deletModule("{{ $module['name'] }}")'>
         Delete
       </div>
       @else
       <div class="w-1/2 p-2 rounded-md text-center  hover:text-white font-semibold hover:bg-emerald-600 transition-colors duration-200 cursor-pointer" wire:click='installModule("{{ $module['name'] }}","{{ $module['link'] }}")'>
        Download
      </div>
       @endif
     </div>
  </div>
  @endforeach
</div>
</div>
