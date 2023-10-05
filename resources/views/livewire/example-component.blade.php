<div class="bg-gray-50">
  <div class="flex gap-2 flex-col ">


    @foreach (config('modules-manager.available_modules') as $module )
    
    <div class=" bg-white rounded-lg shadow-md p-8">
            {{ $module['name'] }}
    </div>
    
@endforeach

  </div>

</div>