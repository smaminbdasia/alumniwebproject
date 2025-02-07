<div>
    <h2 class="font-bold text-lg mb-2">Public Signups</h2>
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Photo</th>
                <th class="border p-2">Reg ID</th>
                <th class="border p-2">Name</th>
                <th class="border p-2">Dakhil Batch</th>
                <th class="border p-2">Alim Batch</th>
                <th class="border p-2">District</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($publicSignups as $signup)
                <tr>
                    <td class="border p-2">
                        <img src="{{ asset('storage/' . $signup->user->profile_photo_path) }}" class="w-10 h-10 rounded-full">
                    </td>
                    <td class="border p-2">{{ $signup->user->reg_id}}</td>
                    <td class="border p-2">{{ $signup->user->name }}</td>
                    <td class="border p-2">{{ $signup->user->dakhilBatch }}</td>
                    <td class="border p-2">{{ $signup->user->alimBatch }}</td>
                    <td class="border p-2">{{ $signup->user->district }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $publicSignups->links() }}
    </div>
</div>
