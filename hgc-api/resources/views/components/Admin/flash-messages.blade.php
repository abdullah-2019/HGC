{{-- Auto-dismiss after 5 seconds using Alpine.js --}}
<div 
    x-data="{ messages: [] }"
    x-init="
        @if(session('success')) messages.push({type: 'success', text: '{{ addslashes(session('success')) }}'}); @endif
        @if(session('error')) messages.push({type: 'error', text: '{{ addslashes(session('error')) }}'}); @endif
        @if(session('warning')) messages.push({type: 'warning', text: '{{ addslashes(session('warning')) }}'}); @endif
        @if(session('info')) messages.push({type: 'info', text: '{{ addslashes(session('info')) }}'}); @endif
        
        messages.forEach((msg, index) => {
            setTimeout(() => {
                messages.splice(index, 1);
            }, 5000);
        });
    "
    class="fixed top-5 right-5 z-50 space-y-2 w-full max-w-sm"
>
    <template x-for="(message, index) in messages" :key="index">
        <div 
            x-data="{ show: true }"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-4"
            x-init="setTimeout(() => show = false, 5000)"
        >
            <x-admin.alert 
                ::type="message.type" 
                ::message="message.text" 
            />
        </div>
    </template>
</div>