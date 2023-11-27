<x-app-layout>
  <div class="flex flex-col items-center justify-center p-6">
    <div class="w-full max-w-2xl">
      @if (auth()->user()->is_admin == 1) 
        <a 
        class="inline-flex my-3 items-center justify-center text-sm shadow-lg border border-gray-300 dark:border-gray-700 bg-white hover:bg-gray-500 font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary h-10 px-4 py-2 rounded-sm transition-all duration-500 dark:text-black hover:text-white cursor-pointer"
        href={{route('vehicles.edit', $vehicle)}}
        >
          Jármű szerkeztése
        </a>
      @endif
      <img
        src={{$imageSrc}}
        alt="Vehicle"
        width="500"
        height="300"
        class="rounded-lg object-cover w-full"
        style="aspect-ratio: 500 / 300; object-fit: cover;"
      />
      <div class="mt-4 space-y-2 text-black dark:text-white">
        <h1 class="text-2xl font-semibold">{{$vehicle->brand}} - {{$vehicle->model}}</h1>
        <p>{{$vehicle->license}}</p>
        <p class="text-base font-medium text-gray-500 dark:text-gray-400">{{$vehicle->year}}</p>
      </div>
      <div class="mt-6 text-black dark:text-white">
        <h2 class="text-xl font-bold">Káresemények:</h2>
        <ul class="list-disc list-inside space-y-1 mt-2">
          @foreach ($incidents as $incident)
            <li><a href={{route('incidents.show', $incident)}}>{{$incident->time}} - {{$incident->location}}</a></li> 
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</x-app-layout>