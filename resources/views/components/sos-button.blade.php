<div x-data="{ 
        triggered: false,
        triggerSOS() {
            if(!confirm('Are you sure you want to trigger an SOS alert? This will notify emergency services and contacts.')) return;
            
            this.triggered = true;
            
            fetch('{{ route('sos.trigger') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    lat: 0, // In a real app, we'd use geolocation
                    lng: 0
                })
            })
            .then(response => response.json())
            .then(data => {
                alert('SOS Alert Sent! Emergency services have been notified.');
                setTimeout(() => this.triggered = false, 5000);
            })
            .catch(error => {
                console.error('SOS Failed:', error);
                this.triggered = false;
            });
        }
    }" class="fixed bottom-24 right-6 z-[100] sm:bottom-10 sm:right-10">

    <button @click="triggerSOS()" :class="triggered ? 'scale-150 bg-white text-red-600' : 'bg-red-600 text-white'"
        class="w-16 h-16 rounded-full flex flex-col items-center justify-center shadow-2xl transition-all duration-300 hover:scale-110 active:scale-95 animate-pulse group">
        <span class="text-2xl font-bold leading-none">SOS</span>
        <span class="text-[8px] font-bold mt-1 group-hover:block hidden">HELP</span>
    </button>
</div>