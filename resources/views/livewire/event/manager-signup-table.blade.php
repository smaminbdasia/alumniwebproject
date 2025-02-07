<div>
    <h2 class="font-bold text-lg mb-2">Manager Signups</h2>
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Reg ID</th>
                <th class="border p-2">Photo</th>
                <th class="border p-2">Name</th>
                <th class="border p-2">Phone</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Reg Fee</th>
                <th class="border p-2">T-Shirt Size</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($managerSignups as $signup)
                <tr>
                    <td class="border p-2">{{ $signup->id }}</td>
                    <td class="border p-2">
                        <img src="{{ asset('storage/' . $signup->user->profile_photo_path) }}" class="w-10 h-10 rounded-full">
                    </td>
                    <td class="border p-2">{{ $signup->user->name }}</td>
                    <td class="border p-2">{{ $signup->user->phone }}</td>
                    <td class="border p-2">{{ $signup->user->email }}</td>
                    <td class="border p-2">{{ $signup->reg_fee }}</td>
                    <td class="border p-2">{{ $signup->user->tshirt_size }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $managerSignups->links() }}
    </div>
</div>

<table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
    <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
            <th scope="col" class="p-4">
                <div class="flex items-center">
                    <input id="checkbox-all" aria-describedby="checkbox-1" type="checkbox" class="w-4 h-4 bg-gray-50 rounded border-gray-300 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-all" class="sr-only">checkbox</label>
                </div>
            </th>
            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                Name
            </th>
            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                Position
            </th>
            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                Country
            </th>
            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                Status
            </th>
            <th scope="col" class="p-4">
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
            <td class="p-4 w-4">
                <div class="flex items-center">
                    <input id="checkbox-1" aria-describedby="checkbox-1" type="checkbox" class="w-4 h-4 bg-gray-50 rounded border-gray-300 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-1" class="sr-only">checkbox</label>
                </div>
            </td>
            <td class="flex items-center p-4 mr-12 space-x-6 whitespace-nowrap lg:mr-0">
                <img class="w-10 h-10 rounded-full" src="../../images/users/neil-sims.png" alt="Neil Sims avatar">
                <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    <div class="text-base font-semibold text-gray-900 dark:text-white">Neil Sims</div>
                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">neil.sims@flowbite.com</div>
                </div>
            </td>
            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">Front-end developer</td>
            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">United States</td>
            <td class="p-4 text-base font-normal text-gray-900 whitespace-nowrap dark:text-white">
                <div class="flex items-center">
                     <div class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></div>  Active
                </div>
            </td>
            <td class="p-4 space-x-2 whitespace-nowrap">
                <button type="button" data-modal-toggle="user-modal" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                    Edit user
                </button>
                <button type="button" data-modal-toggle="delete-user-modal" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                    <svg class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    Delete user
                </button>
            </td>
        </tr>


