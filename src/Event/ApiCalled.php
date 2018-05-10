<?php

namespace jocoonopa\MPosWebService\Event;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApiCalled implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $log = [];

    /**
     * Api Called Init
     *
     * @param string $url
     * @param array  $httpRequestParams
     * @param array  $apiRequestParams
     * @param array  $response
     */
    public function __construct($url, array $httpRequestParams, array $apiRequestParams, array $response)
    {
        foreach (['httpRequestParams', 'apiRequestParams', 'response'] as $filedName) {
            if (array_key_exists('data', $$filedName)) {
                $$filedName['data'] = is_null(json_decode($$filedName['data'])) ? 
                    $$filedName['data'] : 
                    json_decode($$filedName['data'])
                ;
            }
        }

        $this->log = [
            'url' => $url,
            'laravel_url' => \Request::method() . '@' . \Request::url(),
            'httpRequestParams' => $httpRequestParams,
            'apiRequestParams' => $apiRequestParams,
            'response' => $response,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channels = [];
        $channelNames = array_get(config('mpos-ws'), 'channels');

        foreach ($channelNames as $channelName) {
            $channels[] = new PrivateChannel($channelName);
        }

        return $channels;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return $this->log;
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'mpos-api-call';
    }
}