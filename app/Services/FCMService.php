<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Support\Facades\Log;

class FCMService
{
    protected $messaging = null;

    public function __construct()
    {
        try {
            $credentialsPath = base_path(env('FIREBASE_CREDENTIALS', 'storage/app/firebase/firebase_credentials.json'));

            if (!file_exists($credentialsPath) || is_dir($credentialsPath)) {
                Log::error('Invalid Firebase credentials path.', [
                    'path' => $credentialsPath,
                    'exists' => file_exists($credentialsPath),
                    'is_directory' => is_dir($credentialsPath),
                ]);
                return;
            }

            $factory = (new Factory)->withServiceAccount($credentialsPath);
            $this->messaging = $factory->createMessaging();

            Log::info('Firebase messaging service initialized successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to initialize Firebase messaging service.', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function sendToTokens(array $tokens, string $title, string $body, array $data = [])
    {
        if (!$this->messaging) {
            Log::warning('Attempted to send FCM but messaging service not initialized.');
            return;
        }
    
        foreach ($tokens as $token) {
            try {
                $message = CloudMessage::withTarget('token', $token)
                    ->withNotification(Notification::create($title, $body))
                    ->withData($data); // ✅ add this line to support custom data payload
    
                $this->messaging->send($message);
    
                Log::info('FCM sent to token.', ['token' => $token, 'data' => $data]);
    
            } catch (\Exception $e) {
                Log::error('Failed to send FCM to token.', [
                    'token' => $token,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

}
