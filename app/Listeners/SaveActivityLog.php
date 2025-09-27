<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\GeneralSettings\App\Models\ActivityLog;

class SaveActivityLog
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
  
  
  public function handle(Login $event)
{
    $user = $event->user; // Authenticated user

    if (!$user || !$user->id) {
        Log::warning('Login activity log skipped: user not properly authenticated.');
        return;
    }

    try {
        // Check if the user's role is 'student'
        if ($user->role !== 'student') {
            Log::info('Activity log skipped: user is not a student.', ['user_id' => $user->id]);
            return;
        }

        // Get browser and IP details
        $browser = $this->getUserBrowser();
        $ip = request()->getClientIp();
        $time = now()->toDateTimeString();

        // Save activity log
        ActivityLog::create([
            'student_id' => $user->id, 
            'browser' => $browser,
            'ip' => $ip,
            'time' => $time,
        ]);

        Log::info('Activity log saved successfully.', ['user_id' => $user->id]);
    } catch (\Exception $e) {
        Log::error('Failed to save activity log.', [
            'error' => $e->getMessage(),
            'user_id' => $user->id ?? null,
        ]);
    }
}

protected function getUserBrowser()
{
    // You can customize this to get more details about the browser.
    return $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown Browser';
}


}
