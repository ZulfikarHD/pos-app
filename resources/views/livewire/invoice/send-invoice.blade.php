<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Send Invoice #{{ $invoice->invoice_id }}</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="sendInvoice">
        <div class="mb-4">
            <label class="block text-gray-700">Recipient Email</label>
            <input type="email" wire:model="recipientEmail" class="border border-gray-300 p-2 rounded w-full">
            @error('recipientEmail') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Subject</label>
            <input type="text" wire:model="subject" class="border border-gray-300 p-2 rounded w-full">
            @error('subject') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Message Body</label>
            <textarea wire:model="messageBody" class="border border-gray-300 p-2 rounded w-full" rows="5"></textarea>
            @error('messageBody') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Send Invoice</button>
    </form>
</div>
