<x-app-layout>
  <div class="space-y-8 w-6/12 mx-auto mt-8">
    <div class="space-y-2">
      <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Káresemény információk</h2>
      <p class="text-gray-500 dark:text-gray-200">Töltse ki az alábbi űrlapot a káresemény adatainak rögzítéséhez.</p>
    </div>
    <form class="space-y-4" action={{route('incidents.update', $incident)}} method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="location"
        >
          Helyszín
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
          id="location"
          name="location"
          placeholder="Adja meg a helyszínt"
          type='text'
          value="{{old('location', $incident->location) ?? null}}"
          
        />
        @error('location')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Helyszín hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="time"
        >
          Időpont
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
          id="time"
          name='time'
          placeholder="Adja meg az időpontot"
          type='datetime-local'
          value="{{old('time', $incident->time) ?? null}}"
        />
        @error('time')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Időpont:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="desc"
        >
          Leírás
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
          id="desc"
          name='desc'
          placeholder="Írja le a balesetet."
          value="{{old('desc', $incident->desc) ?? null}}"
          type='textbox'
        />
        @error('desc')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Leírás hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <div class="space-y-2 flex flex-col">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="vehicles"
        >
          Járművek
        </label>
        @php
          $licenses = $incident->vehicles->pluck('license')->toArray();
        @endphp
        @foreach ($vehicles as $vehicle)
        
        <div class="flex items-center gap-2">
          <input type='checkbox' value={{$vehicle->license}} name='vehicles[]' id="vehicle-{{$vehicle->id}}" @checked(in_array($vehicle->license, old('vehicles', $licenses) ?? []))>
          <label for="vehicle-{{$vehicle->id}}" class='dark:text-white text-gray-800'>{{$vehicle->license}}</label>
        </div>
        @endforeach
        @error('vehicles')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Járművek hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <button type="submit" class ="inline-flex my-3 items-center justify-center text-sm shadow-lg border border-gray-300 dark:border-gray-700 font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary h-10 px-4 py-2 rounded-full transition-all duration-500 hover:bg-gray-600  dark:bg-gray-800 dark:text-white cursor-pointer">Káresemény elmentése</button>

    </form>
  </div>
</x-app-layout>