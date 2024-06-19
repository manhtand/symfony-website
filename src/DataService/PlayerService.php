<?php

namespace App\DataService;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class PlayerService
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client) {
        $this->client = $client;
    }

    public function getAllPlayerData(): array {
        $players = [];

        for ($i = 1; $i < 31; $i++) {
            $url = "https://api.balldontlie.io/v1/players?team_ids[]=$i";
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                [
                    'Authorization: d5644906-54bf-4923-a81f-47ea838407e4',
                ]
            );

            $response = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($response, true);
            if (isset($data['data']) && is_array($data['data'])) {
                foreach ($data['data'] as $player) {
                    $players[] = $player;
                }
            }
        }

        return $players;
    }

    public function getSeasonAverageWithId(string $playerId) {
        $season = date('Y', strtotime('-1 year'));
        $url = "https://api.balldontlie.io/v1/season_averages?season=$season&player_ids[]=$playerId";
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            [
                'Authorization: d5644906-54bf-4923-a81f-47ea838407e4',
            ]
        );

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        if (isset($data['data']) && is_array($data['data'])) {
            return $data['data'][0];
        }

        return null;
    }
}