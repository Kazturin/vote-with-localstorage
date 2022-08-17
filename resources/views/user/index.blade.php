<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Қолданушылар
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- component -->
                    <div class="bg-white p-8 rounded-md w-full">
                        <div class=" flex items-center justify-between pb-6">
                            <div>
                                <h2 class="text-gray-600 font-semibold">Қолданушылар</h2>
                                <span class="text-xs">Барлық қолданушылар</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex bg-gray-50 items-center p-2 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                              clip-rule="evenodd" />
                                    </svg>
                                    <input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id="" placeholder="search...">
                                </div>
                                <div class="lg:ml-40 ml-10 space-x-8">
                                    <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Енгізу</button>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                    <table class="min-w-full leading-normal">
                                        <thead>
                                        <tr>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Аты-жөні
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Email
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Тіркелген күні
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Роль
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 w-16 h-10">
                                                            <img class="w-full h-full"
                                                                 src="/img/user.png"
                                                                 alt="user" />
                                                        </div>
                                                        <div class="ml-3">
                                                            <p class="text-gray-900 whitespace-no-wrap">
                                                                {{$user->name}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{$user->email}}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{$user->created_at}}
                                                    </p>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<span
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight text-gray-600">
                                        <span aria-hidden
                                              class="absolute inset-0 opacity-50 rounded-full {{ $user->is_admin ? 'bg-green-400 ' : 'bg-amber-400' }}"></span>
									<span class="relative">{{ $user->is_admin ? 'Админ' : 'Қолданушы' }}</span>
									</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="p-4">
                                        {{$users->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
