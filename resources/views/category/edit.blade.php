<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Сауалнама категориясын өңдеу') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- component -->
                    <div class="bg-white p-8 rounded-md w-full">
                        <div class=" flex items-center justify-between pb-6">
                            {{--                            <div>--}}
                            {{--                                <h2 class="text-gray-600 font-semibold">Сауалнама категориялары</h2>--}}
                            {{--                            </div>--}}
                        </div>
                        <div>
                            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">

                                    <div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li class="bg-red-500 text-white my-2 p-2 rounded">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

                                    <form class="p-4" action="{{ route('categories.update',$category->id) }}" method="POST">
                                        @csrf
                                        @method('patch')

                                        <div class="">
                                            <label for="name" class="block text-sm font-medium text-gray-700">Названия</label>
                                            <input type="text" name="name" id="name" value="{{$category->name}}" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="px-4 py-3 text-right sm:px-6">
                                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Изменит
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
