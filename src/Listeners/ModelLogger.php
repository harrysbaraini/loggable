<?php
namespace Harrysbaraini\Loggable\Listeners;

use Request;
use Auth;
use Illuminate\Database\Eloquent\Model;

class ModelLogger
{
    public function handle($event)
    {
        $user = null;

        if (Auth::user()) {
            $user = Auth::user()->getKey();
        }

        $metadata = [
            'ip' => Request::ip(),
            'useragent' => Request::header('User-Agent'),
            'action' => null
        ];

        $log = [
            'user_id' => $user,
            'metadata' => $metadata
        ];

        $handleFunc = 'log' . str_replace('Harrysbaraini\Loggable\Events\ModelWas', '', get_class($event));
        $this->$handleFunc($event->record, $log);
    }

    protected function logCreated(Model $record, array $log)
    {
        $log['metadata']['action'] = 'created';
        $record->logs()->create($log);
    }

    protected function logUpdated(Model $record, array $log)
    {
        $log['metadata']['action'] = 'updated';
        $record->logs()->create($log);
    }

    protected function logDeleted(Model $record, array $log)
    {
        $log['metadata']['action'] = 'deleted';
        $record->logs()->create($log);
    }

    protected function logRestored(Model $record, array $log)
    {

        $log['metadata']['action'] = 'restored';
        $record->logs()->create($log);
    }
}
