<?php

namespace App\DataService;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TeamService
{
    private HttpClientInterface $client;
    private string $apiKey;

    public function __construct(HttpClientInterface $client, string $apiKey) {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function getAllTeamData(): array {
        $url = "https://api.balldontlie.io/v1/teams";
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
        $teams = [];

        if (isset($data['data']) && is_array($data['data'])) {
            foreach ($data['data'] as $team) {
                if ($team['city'] != "") {
                    $teams[] = $team;
                }
            }
        }

        return $teams;
    }
}