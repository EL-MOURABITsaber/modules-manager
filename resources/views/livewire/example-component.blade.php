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
      @if ($module["downloaded"])
        <p class="bg-emerald-600 rounded-md px-2 text-white text-sm  w-fit text-right ">Downloaded</p>
      @else
        <p class="bg-rose-600 rounded-md px-2 text-white text-sm  w-fit text-right">Not downloaded</p>
      @endif

    

      
      @if ($module["enabled"])
        <p class="bg-indigo-600 rounded-md px-2 text-white text-sm  w-fit text-left">Enabled</p>
      @else
      <p class="bg-amber-600 rounded-md px-2 text-white text-sm  w-fit text-left">Disabled</p>
      @endif


    </div>
     <div class="px-6 text-center mt-2 text-gray-500 text-sm">
       <p>
         {{ $module["description"] }}
       </p>
     </div>
     <div class="pt-6 pb-3 px-1 w-full flex flex-col gap-3">


      @foreach ( $module["features"] as $featureName => $value )
        
      <label class="flex items-center justify-between">
        <div class="flex flex-col">
          <span class="ml-3 text-md font-semibold  text-gray-900 ">{{ $featureName  }}</span>
          <span class="ml-3 text-sm font-light  text-gray-400 ">Some description detailing the feature</span>
        </div>
        <div class="relative inline-flex items-center cursor-pointer pr-2">
          <input @change="$wire.switchFeature('{{ $key }}','{{ $featureName }}')" @checked($value) type="checkbox" value="" class="sr-only peer">
          <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-0  rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-green-600"></div>
        </div>
      </label>
      
      @endforeach

     </div>

     
     <div class="flex mt-2 items-center gap-2 p-2">
      @if ($module['enabled'])        
      <button wire:click='disableModule' class="w-1/2 p-2 rounded-md text-center hover:text-white font-semibold hover:bg-amber-600 transition-colors duration-200 cursor-pointer">
        Disable
      </button>
      @elseif (!$module['enabled'] )
      <button wire:click='enableModule' @disabled(!$module["downloaded"]) class="w-1/2 p-2 rounded-md disabled:cursor-not-allowed text-center hover:text-white font-semibold hover:bg-blue-600 transition-colors duration-200 cursor-pointer">
        Enable
      </button>
      @endif
       <div class="w-0 border h-6 border-gray-300">
         
       </div>
       @if ($module["downloaded"]) 
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
