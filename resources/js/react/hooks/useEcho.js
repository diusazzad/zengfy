import { useEffect } from 'react';

/**
 * Hook to listen to a public or presence channel via Laravel Echo.
 */
export function useChannel(channelName, eventName, callback) {
    useEffect(() => {
        if (!window.Echo || !channelName || !eventName) return;

        const channel = window.Echo.channel(channelName);
        channel.listen(eventName, callback);

        return () => {
            channel.stopListening(eventName, callback);
        };
    }, [channelName, eventName, callback]);
}

/**
 * Hook to listen to a private channel via Laravel Echo.
 */
export function usePrivateChannel(channelName, eventName, callback) {
    useEffect(() => {
        if (!window.Echo || !channelName || !eventName) return;

        const channel = window.Echo.private(channelName);
        channel.listen(eventName, callback);

        return () => {
            channel.stopListening(eventName, callback);
        };
    }, [channelName, eventName, callback]);
}
