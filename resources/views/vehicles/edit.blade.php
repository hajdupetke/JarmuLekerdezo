<x-app-layout>
  <div class="space-y-8 w-6/12 mx-auto mt-8">
    <div class="space-y-2">
      <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Autó szerkesztés</h2>
      <p class="text-gray-500 dark:text-gray-200">Töltse ki az alábbi űrlapot az autó adatainak módosításahoz.</p>
    </div>
    <form class="space-y-4" action={{route('vehicles.update', $vehicle)}} method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="license_plate"
        >
          Rendszám
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
          id="license_plate"
          name="license_plate"
          placeholder="Adja meg a rendszámot"
          value={{old('license', $vehicle->license)}}
          disabled
          type='text'
        />
        @error('license_plate')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Rendszám hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="brand"
        >
          Márka
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
          id="brand"
          name='brand'
          placeholder="Adja meg a márka nevét"
          value={{old('brand', $vehicle->brand)}}
          type='text'
        />
        @error('brand')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Márka hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="model"
        >
          Model
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
          id="model"
          name='model'
          placeholder="Adja meg a modelt"
          value={{old('model', $vehicle->model)}}
          type='text'
        />
        @error('model')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Model hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <div class="space-y-2">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="year"
        >
          Évjárat
        </label>
        <input
          class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200"
          id="year"
          name='year'
          placeholder="Adja meg az évjáratot"
          value={{old('year', $vehicle->year)}}
          type='number'
        />
        @error('year')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Évjárat hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <div class="grid w-full max-w-sm items-center gap-1.5">
        <label
          class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800 dark:text-white"
          for="image"
        >
          Kép feltöltése
        </label>
        <input
          class="flex w-full rounded-md py-2 text-sm ring-offset-background file:border-0 file:bg-gray-800 file:cursor-pointer file:hover:bg-gray-600 file:duration-150 file:text-white file:px-4 file:py-2 file:mr-2 file:rounded-lg  file:text-md file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50  text-gray-800 dark:text-gray-200"
          id="image"
          type="file"
          name='image'
        />
        @error('license_plate')
          <div class="bg-red-400 border-red-500 border-2 text-white p-4 my-4 rounded-md">
            <p class="font-semibold">Kép hiba:</p>
            <p>{{$message}}</p>
          </div>
        @enderror
      </div>
      <button type="submit" class ="inline-flex my-3 items-center justify-center text-sm shadow-lg border border-gray-300 dark:border-gray-700 font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary h-10 px-4 py-2 rounded-full transition-all duration-500 hover:bg-gray-600  dark:bg-gray-800 dark:text-white cursor-pointer">Autó szerkesztése</button>

    </form>
  </div>
</x-app-layout>