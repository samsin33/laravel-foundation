<?php

namespace Samsin33\Foundation\Traits;

use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

trait NotificationTrait
{
    public static function logs($value, $array = [])
    {
        try {
            Log::info($value, $array);
        } catch (Exception $exception) {}
    }

    public static function exc($cmd)
    {
        self::logs("Executing command: ". $cmd);
        exec($cmd." 2>&1", $output);
        self::logs("Command output: ", $output);
        return $output;
    }

    /**
     * @throws GuzzleException
     */
    public function notifyMsg($msg): void
    {
        self::logs($msg);
        $this->slack($msg);
    }

    //----------------------------Slack Variables and Functions-------------------
    private mixed $slack_hook = null;
    private mixed $slack_channel = null;
    private mixed $slack_from = null;

    public function setSlackHook(string $value = ''): void
    {
        $this->slack_hook = $value;
    }

    public function getSlackHook()
    {
        return !empty($this->slack_hook) ? $this->slack_hook : config('notifications.slack.webhook');
    }

    public function setSlackChannel(string $value = ''): void
    {
        $this->slack_channel = $value;
    }

    public function getSlackChannel()
    {
        return !empty($this->slack_channel) ? $this->slack_channel : config('notifications.slack.channel');
    }

    public function setSlackFrom(string $value = ''): void
    {
        $this->slack_from = $value;
    }

    public function getSlackFrom()
    {
        return $this->slack_from ? $this->slack_from : config('notifications.slack.from');
    }

    /**
     * @param string $text
     * @param array $array
     * @param array $attachments
     * @return void
     * @throws GuzzleException
     */
    public function slack(string $text, array $array = [], array $attachments = []): void
    {
        $array_data =  (empty($array)) ? "" : json_encode($array);
        if (trim($text.$array_data)) {
            $payload = $this->preparePayload($text. "\n". $array_data, $this->getSlackChannel(), $attachments);

            try {
                $client = new HttpClient();
                $client->request('POST', $this->getSlackHook(),[
                    'json' => $payload
                ]);
            } catch (Exception $e) {
                self::logs("Slack Exception: ". $e->getMessage());
            }
        }
    }

    /**
     * @param string $text
     * @param string $channel
     * @param array $attachments
     * @return array
     */
    private function preparePayload(string $text, string $channel, array $attachments): array
    {
        $payload = ['text' => '['.config('app.env').'] '.$text, 'attachments' => [$attachments], 'channel' => $channel, 'username' => $this->getSlackFrom()];
        return $payload;
    }
}
