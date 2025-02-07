<div>
    <h2 class="font-bold text-lg mb-2">Payment Signups</h2>
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Reg ID</th>
                <th class="border p-2">Adult Guests</th>
                <th class="border p-2">Child Guests</th>

                <th class="border p-2">Total Fee</th>
                <th class="border p-2">Payment Method</th>
                <th class="border p-2">Trx</th>
                <th class="border p-2">Ref</th>
                <th class="border p-2">bKash Trx</th>
                <th class="border p-2">Verification</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paymentSignups as $signup)
                <tr>
                    <td class="border p-2">{{ $signup->user->reg_id }}</td>
                    <td class="border p-2">{{ $signup->adult_guest_count }}</td>
                    <td class="border p-2">{{ $signup->child_guest_count }}</td>
                    <td class="border p-2">{{ $signup->reg_fee }}</td>
                    <td class="border p-2">{{ $signup->payment_method }}</td>
                    <td class="border p-2">{{ $signup->trx_id }}</td>
                    <td class="border p-2">{{ $signup->Ref_id }}</td>
                    <td class="border p-2">{{ $signup->trx_id_bkash }}</td>
                    <td class="border p-2">
                        <span class="{{ $signup->verified === 'paymentverified' ? 'text-green-500' : 'text-red-500' }}">
                            {{ ucfirst($signup->verified) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $paymentSignups->links() }}
    </div>
</div>
