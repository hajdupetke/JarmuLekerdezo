<x-app-layout>
  <div class="p-6 w-8/12 mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Felhasználók listája</h1>
    <div class="grid gap-6">
      @foreach ($users as $user)
      @php
        $role = $user->is_admin ? 'Admin' : ($user->is_premium ? 'Prémium' : 'Normál');
      @endphp
      
      <div class="border shadow-sm rounded-lg p-4 flex items-center space-x-6 bg-white dark:bg-zinc-900 dark:text-white">
        <span class="relative flex shrink-0 overflow-hidden rounded-full h-12 w-12">
          <span class="flex h-full w-full items-center justify-center rounded-full bg-muted ">{{$user->id}}</span>
        </span>
        <div class="flex-1 space-y-1">
          <div class="font-medium text-gray-900 dark:text-white">{{$user->name}}</div>
          <div class="text-zinc-500 dark:text-zinc-300">{{$user->email}}</div>
          <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-primary/80 text-xs bg-gray-200 dark:bg-zinc-700 text-gray-900 dark:text-white">
            
            {{$role}}
          </div>
        </div>
        @if (!$user->is_admin)
        <form method="POST" action={{route('users.update', $user)}}>
        @csrf
        @method('PUT')
        <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-primary/90 h-10 px-4 py-2  bg-gray-900 dark:bg-white text-white dark:text-gray-900">
          {{$user->is_premium ? 'Változtatás normál felhasználóra' : 'Változtatás prémium felhasználóra'}}
        </button>
        </form>
        @endif 
      </div>
      @endforeach
    </div>
    {{$users->links()}}
  </div>
</x-app-layout>