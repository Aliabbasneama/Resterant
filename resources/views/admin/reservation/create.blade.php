<x-admin-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12" style="background-color: whitesmoke;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="flex m-2 p-2 ">
        <a href="{{route('admin.reservation.index')}}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
        Reservation index</a>
      </div>
      <div class="m-2 p-2">
        <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
          <form method="POST" action="{{route('admin.reservation.store')}}">
            @csrf


            <div class="sm:col-span-6">
              <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
              <div class="mt-1">
                <input type="text" id="first_name" name="first_name" class="block w-full transition duration-150 ease-in-out appearance-none big-white border border-gray-400">
              </div>
            </div>

            <div class="sm:col-span-6">
              <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
              <div class="mt-1">
                <input type="text" id="last_name" name="last_name" class="block w-full transition duration-150 ease-in-out appearance-none big-white border border-gray-400">
              </div>
            </div>

            <div class="sm:col-span-6">
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <div class="mt-1">
                <input type="email" id="email" name="email" class="block w-full transition duration-150 ease-in-out appearance-none big-white border border-gray-400">
              </div>
            </div>

            <div class="sm:col-span-6">
              <label for="tel_number" class="block text-sm font-medium text-gray-700">Phon number</label>
              <div class="mt-1">
                <input type="text" id="tel_number" name="tel_number" class="block w-full transition duration-150 ease-in-out appearance-none big-white border border-gray-400">
              </div>
              @error('tel_number')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
            </div>

            <div class="sm:col-span-6">
              <label for="res_date" class="block text-sm font-medium text-gray-700">Reservation Date</label>
              <div class="mt-1">
                <input type="datetime-local" id="res_date" name="res_date" class="block w-full transition duration-150 ease-in-out appearance-none big-white border border-gray-400">
              </div>
              @error('res_date')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
            </div>
            <div class="sm:col-span-6">
              <label for="guest_number" class="block text-sm font-medium text-gray-700">Guest Number</label>
              <div class="mt-1">
                <input type="number" id="guest_number" name="guest_number" class="block w-full transition duration-150 ease-in-out appearance-none big-white border border-gray-400">
              </div>
            </div>

            <div class="sm:col-span-6 pt-5">
              <label for="table" class="block text-sm font-medium text-gray-700">Table</label>
              <div class="mt-1">
                <select id="table_id" name="table_id" class="form-multiselect block w-full mt-1">
                  @foreach ($tables as $table)
                  <option value="{{$table->id}}">{{$table->name}} 
                    ({{$table->guest_number}} Guests)</option>

                  @endforeach
                </select>
              </div>
            </div>



            <div class="mt-6 p-4">
              <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">store</button>

            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</x-admin-layout>






