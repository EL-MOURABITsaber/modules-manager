<div class="bg-gray-200 min-h-screen p-5" x-data>
{{-- 

  <!-- component -->
<div class=" font-sans  w-full flex  gap-5 ">
  @foreach (config('modules-manager.available_modules') as $key => $module )

  <div class="relative card w-96 h-fit  bg-white flex flex-col  shadow-xl rounded-md">
   
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
     <div class="flex mt-2 items-center gap-2 p-2 bg-gray-50 rounded-md">
      @if (Module::has($module["name"]) && Module::isEnabled($module["name"]))     
      <button wire:click='disableModule("{{ $module["name"] }}")' class="w-1/2 p-2 rounded-md text-center hover:text-white font-semibold hover:bg-amber-600 transition-colors duration-200 cursor-pointer">
         <span wire:loading.remove wire:target='disableModule("{{ $module["name"] }}")'>Disable</span>
        <span wire:loading wire:target='disableModule("{{ $module["name"] }}")'>Disabling ...</span>
      </button>
      @else
      <button wire:click='enableModule("{{ $module["name"] }}")' @disabled(! Module::has($module["name"])) class="w-1/2 p-2 rounded-md disabled:cursor-not-allowed text-center hover:text-white font-semibold hover:bg-blue-600 transition-colors duration-200 cursor-pointer">
        <span wire:loading.remove wire:target='enableModule("{{ $module["name"] }}")'>Enable</span>
        <span wire:loading wire:target='enableModule("{{ $module["name"] }}")'>Enabling ...</span>
      </button>
      @endif
       <div class="w-0 border h-6 border-gray-300">
         
       </div>
       @if (Module::has($module["name"])) 
       <button class="w-1/2 p-2 rounded-md text-center hover:text-white font-semibold hover:bg-rose-600 transition-colors duration-200 h-full cursor-pointer" wire:click='deletModule("{{ $module['name'] }}")'>
        <span wire:loading.remove wire:target='deletModule("{{ $module['name'] }}")'>Delete</span>
        <span wire:loading wire:target='deletModule("{{ $module['name'] }}")'>Deleting ...</span>
       </button>
       @else
       <button class="w-1/2 p-2 rounded-md text-center  hover:text-white font-semibold hover:bg-emerald-600 transition-colors duration-200 cursor-pointer" wire:click='installModule("{{ $module['name'] }}","{{ $module['link'] }}")'>
        <span wire:loading.remove wire:target='installModule("{{ $module['name'] }}","{{ $module['link'] }}")'>Download</span>
        <span wire:loading wire:target='installModule("{{ $module['name'] }}","{{ $module['link'] }}")'>Downloading ...</span>
      </button>
       @endif
     </div>
  </div>
  @endforeach
</div> --}}
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet" />
<style>
  * {
  font-family: 'Source Sans Pro';
  }
</style>

<div class="mx-4 min-h-screen max-w-screen-xl pb-24 sm:mx-8 xl:mx-auto" x-data="{module:''}">
  <h1 class="border-b py-6 text-4xl font-semibold">Modules</h1>
  <div class="grid grid-cols-8 pt-3 sm:grid-cols-10">
    <div class="relative my-4 w-full col-span-8 bg-white rounded-lg sm:hidden">
      <input class="peer hidden" type="checkbox" name="select-1" id="select-1" />
      <label for="select-1" class="flex w-full cursor-pointer select-none rounded-lg border p-2 px-3 text-sm text-gray-700 ">Notifications </label>
      <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute right-0 top-3 ml-auto mr-5 h-4 text-slate-700 transition peer-checked:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
      </svg>
      <ul class="max-h-0 select-none flex-col overflow-hidden rounded-b-lg shadow-md transition-all duration-300 peer-checked:max-h-56 peer-checked:py-3">
        <li class="cursor-pointer px-3 py-2 text-sm text-slate-600 hover:bg-blue-700 hover:text-white">Notifications</li>
        <li class="cursor-pointer px-3 py-2 text-sm text-slate-600 hover:bg-blue-700 hover:text-white">Team</li>
        <li class="cursor-pointer px-3 py-2 text-sm text-slate-600 hover:bg-blue-700 hover:text-white">Others</li>
      </ul>
    </div>

    <div class="col-span-2 hidden sm:block">
      <ul>
        @foreach (config('modules-manager.available_modules') as $key => $module )
        <li @click="module='{{ $module['name'] }}'" :class="{ 'border-l-blue-700 text-blue-700':  module == '{{ $module['name'] }}' }" class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700">{{ $module['name'] }}</li>

        @endforeach
        <li class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700">Teams</li>
        <li class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700">Accounts</li>
        <li class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700">Users</li>
        <li class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700">Profile</li>
        <li class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700">Billing</li>
        <li class="mt-5 cursor-pointer border-l-2 border-l-blue-700 px-2 py-2 font-semibold text-blue-700 transition hover:border-l-blue-700 hover:text-blue-700">Notifications</li>
        <li class="mt-5 cursor-pointer border-l-2 border-transparent px-2 py-2 font-semibold transition hover:border-l-blue-700 hover:text-blue-700">Integrations</li>
      </ul>
    </div>

    <div class="col-span-8 overflow-hidden rounded-xl bg-gray-50 px-8 shadow" x-cloak x-show="module==''">
      
    </div>

    @foreach (config('modules-manager.available_modules') as $key => $module )
    <div class="col-span-8 overflow-hidden rounded-xl bg-gray-50 px-8 shadow" x-cloak x-show="module=='{{ $module['name'] }}'">
      <div class="border-b pt-4 pb-8">
        <h1 class="py-2 text-2xl font-semibold">{{ $module['name'] }} module settings</h1>
        <p class="font- text-slate-600">{{ $module['description'] }}</p>
      </div>
        <div>
          @if (Module::has($module["name"]) && Module::isEnabled($module["name"]))   

            @php
              $moduleName=strtolower($module["name"]);
              $current=$moduleName . '::' . $moduleName . '-module-settings-handler';
            @endphp
          <div >

            <livewire:is :component="$current" />
          </div>
          @elseif ( ! Module::has($module["name"]) )
          <div class="relative w-full py-8 my-8 flex justify-center font-semibold bg-gray-100   text-gray-900">
            <button wire:click='installModule("{{ $module['name'] }}","{{ $module['link'] }}")' class="underline text-blue-600 pr-1">Download</button> module to gain acess to its settings
          </div>
          @elseif ( ! Module::has($module["name"]) )
          <div class="relative w-full py-8 my-8 flex justify-center font-semibold bg-gray-100   text-gray-900">
            <button wire:click='enableModule("{{ $module["name"] }}")' class="underline text-blue-600 pr-1">Enable</button> module to gain acess to its settings
          </div>
          @endif
          
        </div>
          
          
          
        </div>
        @endforeach
  </div>
</div>

</div>
